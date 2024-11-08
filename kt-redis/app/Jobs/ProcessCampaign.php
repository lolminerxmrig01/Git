<?php

namespace App\Jobs;

use App\Campaign;
use App\Account;
use App\Jobs\ProcessPendingOutbound;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCampaign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $campaign;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($campaign = null)
    {
        $this->onQueue($this->getCampaignQueue($campaign));
        $this->campaign = $campaign;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->campaign) {
            return $this->dispatchCampaignJobs();
        }

        $amountToPick = (int) $this->campaign->sendPerHourCampaign() / 60;

        $amountToPick = $amountToPick >= 1 ? $amountToPick : 1;

        $outbounds = $this->campaign
            ->outbounds()
			->pending()
			->pastSendTime()
            ->notReply()
            ->take($amountToPick)
            ->inRandomOrder()
            ->with('account')
            ->get();

        $provider = $this->campaign->account->provider;

        $numbers = $this->campaign->account->getNumbers();

        // first, let's send a message of each type so we can wait for DLRs.

        foreach ($outbounds->unique('message_group_id') as $outbound) {
            ProcessPendingOutbound::dispatch($outbound, $this->campaign->account, $provider->provider, $numbers->random());
        }

        // now let's wait 15 seconds before sending the rest.

        sleep(10);

        // Here we calculate the amount of sends per second and divide the
        // outbounds in batches, adding a delay for each batch. That way
        // we do not overload our message provider and ensure DLRs
        // are delivered within the needed timeframe.
        $outboundsCount = $outbounds->count() > 0 ? $outbounds->count() : 1;
        $amountPerSecond = ceil($outboundsCount / 40);

        foreach ($outbounds->chunk($amountPerSecond) as $index => $chunkedOutbounds) {
            foreach ($chunkedOutbounds as $outbound) {
                ProcessPendingOutbound::dispatch($outbound, $outbound->account, $provider->provider, $numbers->random())
                    ->delay(now()->addSeconds($index));
            }
        }

        $this->campaign->finishProcessing();
    }

    public function dispatchCampaignJobs()
    {
        $campaigns = Campaign::sending()->regular()->whereNotNull('hourly_limit')->whereHas('outbounds', fn($query) =>
            $query->pending()->notReply()
        )->get()->reject(fn($account) => $account->beingProcessed());

        foreach ($campaigns as $campaign) {
            $campaign->startProcessing();
            dispatch(new self($campaign));
        }
    }

    public function getCampaignQueue($campaign)
    {
        if ($campaign) {
            return 'process-campaign';
        }

        return 'dispatch-campaign-jobs';
    }

    public function tags()
    {
        if ($this->campaign) {
            return [
                'ProcessCampaign', 'campaign:' . $this->campaign->id ? 'true' : 'false',
            ];
        }

        return [
            'ProcessCampaigns',
        ];
    }
}
