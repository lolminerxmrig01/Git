<?php

namespace App\Services;

use App\Campaign;
use App\Carrier;
use App\Catalog;
use App\Services\OutboundFilteringService;

class CarrierBreakdownService
{
    public function fromList(Catalog $catalog)
    {
        return Carrier::all()->map(function ($carrier) use ($catalog) {
            return ['carrier' => $carrier, 'count' => $catalog->leads()->where('carrier_id', $carrier->id)->count()];
        });
    }

    public function fromCampaign(Campaign $campaign, $filter = null)
    {
        return Carrier::all()->map(function ($carrier) use ($campaign) {
            return ['carrier' => $carrier, 'count' => $this->countOuboundsForCarrierFromCampaign($carrier, $campaign)];
        });
    }

    public function countOuboundsForCarrierFromCampaign($carrier, $campaign)
    {
        $all = resolve(OutboundFilteringService::class)->filter($campaign->outbounds())
            ->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
            ->count();
		
		$delivered = resolve(OutboundFilteringService::class)->filter($campaign->outbounds())
            ->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
			->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', 'Delivered'))
            ->count();
			
		$replies = resolve(OutboundFilteringService::class)->filter($campaign->outbounds())
            ->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
			->reply()
            ->count();	
			
		$failed = resolve(OutboundFilteringService::class)->filter($campaign->outbounds())
            ->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
			->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', '!=', 'Delivered'))
            ->count();

		return ['all' => $all, 'delivered' => $delivered, 'replies' => $replies, 'failed' => $failed];		

    }
}
