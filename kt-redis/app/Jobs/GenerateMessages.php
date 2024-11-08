<?php

namespace App\Jobs;

ini_set('memory_limit', '2048M');
use App\Outbound;
use App\Jobs\Sending\CreatePendingOutboundFromLead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class GenerateMessages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $campaign;

    public $timeout = 1200;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($campaign, $filters = [])
    {
        $this->campaign = $campaign;
        $this->onQueue('generate-messages');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $limit = $this->campaign->limit ?: 10000000;

        $leads = $this->campaign->catalog
            ->leads()
            ->active()
            ->take($limit)
            ->skip($this->campaign->skip)
            ->when($this->campaign->hasLimitedCarriers(), fn($query) => $query->whereIn('carrier_id', $this->campaign->carriers))
            ->get(['id', 'phone']);

        $this->campaign->update(['status' => 'paused']);

        foreach ($leads as $lead) {
            CreatePendingOutboundFromLead::dispatch(
                $lead,
                $this->campaign,
                $this->campaign->account->sending_price,
                $this->campaign->getLink(),
            );
			//Outbound::create($this->createPendingOutbound($lead,$this->campaign,$this->campaign->account->sending_price,$this->campaign->getLink()));
            // GenerateOutboundsFromLeads::dispatch($leads, $this->campaign);
        }

        // $this->campaign->update(['status' => 'waiting']);
    }
	
	public function createPendingOutbound($lead,$campaign,$sendingPrice,$link)
    {
        $hash = $campaign->usesHash() ? Str::random(6) : null;
        $domainGroupId = $campaign->usesAmazonLinks() ? null : $campaign->domain_group_id;

        return [
            'to' => number($lead->phone),
            'cost' => $sendingPrice,
            'hash' => $hash,
            'link' => $link,
            'processed' => false,
            'send_at' => now(),
            'campaign_id' => $campaign->id,
            'offer_id' => $campaign->offer_id,
            'lead_id' => $lead->id,
            'account_id' => $campaign->account_id,
            'message_group_id' => $campaign->message_group_id,
            'domain_group_id' => $domainGroupId,
            'team_id' => $campaign->team_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function tags()
    {
        return ['GenerateMessages'];
    }
}
