<?php

namespace App\Http\Controllers;

use App\Account;
use App\Carrier;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CarriersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {		
        $carriers = Carrier::get();
		
		$stats = array();
			
		foreach($carriers as $carrier){
			
			if(isset($request->filter) && $request->filter == "Today"){
				//$carrier_stat->whereNotNull('delivery_reports.delivered_at')->where('delivery_reports.delivered_at', '>=', date('Y-m-d 00:00:00'));
				
				$all = team()->outbounds()->where('processed','1')->where('sent_at', '>=', date('Y-m-d 00:00:00'))
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->count();
				
				$delivered = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', 'Delivered')->where('delivered_at', '>=', date('Y-m-d 00:00:00')))
					->count();
					
				$failed = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', '!=', 'Delivered')->where('delivered_at', '>=', date('Y-m-d 00:00:00')))
					->count();
				
				
			}elseif(isset($request->filter) && $request->filter == "Yesterday"){
				
				$all = team()->outbounds()->where('processed','1')->where('sent_at', '>=', Carbon::now()->subDays(1))
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->count();
				
				$delivered = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', 'Delivered')->where('delivered_at', '>=', Carbon::now()->subDays(1)))
					->count();
					
				$failed = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', '!=', 'Delivered')->where('delivered_at', '>=', Carbon::now()->subDays(1)))
					->count();
				
			}elseif(isset($request->filter) && $request->filter == "Week"){
				
				$all = team()->outbounds()->where('processed','1')->whereBetween('sent_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->count();
				
				$delivered = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', 'Delivered')->whereBetween('delivered_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]))
					->count();
					
				$failed = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', '!=', 'Delivered')->whereBetween('delivered_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]))
					->count();				
				
			}elseif(isset($request->filter) && $request->filter == "24 Hours"){
				
				$all = team()->outbounds()->where('processed','1')->where('sent_at', '>=', Carbon::now()->subDay())
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->count();
				
				$delivered = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', 'Delivered')->where('delivered_at', '>=', Carbon::now()->subDay()))
					->count();
					
				$failed = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', '!=', 'Delivered')->where('delivered_at', '>=', Carbon::now()->subDay()))
					->count();
				
			}elseif(isset($request->filter) && $request->filter == "7 days"){
				
				$all = team()->outbounds()->where('processed','1')->where('sent_at', '>=', Carbon::now()->subDays(7))
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->count();
				
				$delivered = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', 'Delivered')->where('delivered_at', '>=', Carbon::now()->subDays(7)))
					->count();
					
				$failed = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', '!=', 'Delivered')->where('delivered_at', '>=', Carbon::now()->subDays(7)))
					->count();
				
			}elseif(isset($request->filter) && $request->filter == "Month"){
				
				$all = team()->outbounds()->where('processed','1')->where('sent_at', Carbon::now()->month)
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->count();
				
				$delivered = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', 'Delivered')->where('delivered_at', Carbon::now()->month))
					->count();
					
				$failed = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', '!=', 'Delivered')->where('delivered_at', Carbon::now()->month))
					->count();
			}else{
				$all = team()->outbounds()->where('processed','1')->where('sent_at', '>=', date('Y-m-d 00:00:00'))
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->count();
				
				$delivered = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', 'Delivered')->where('delivered_at', '>=', date('Y-m-d 00:00:00')))
					->count();
					
				$failed = team()->outbounds()
					->whereHas('lead', fn($query) => $query->where('carrier_id', $carrier->id))
					->whereHas('deliveryReport', fn($subQuery) => $subQuery->where('status', '!=', 'Delivered')->where('delivered_at', '>=', date('Y-m-d 00:00:00')))
					->count();
			}
			//echo $all;die;
			
			//echo $carrier->name." - ".$all." - ".$delivered." - ".$failed."<br/>";
			
			//echo"<pre/>";print_r($all);
			/* $carrier_stat = team()->outbounds()->deliveryReport()->withCount(['delivered' => function ($query) {
				$query->where('delivered_at', '>=', date('Y-m-d 00:00:00'));
			  }])->get(); */
			
			
			
			/* $carrier_stat = DB::table('outbounds')
            ->join('leads', 'outbounds.lead_id', '=', 'leads.id')
            ->join('delivery_reports', 'outbounds.id', '=', 'delivery_reports.outbound_id')
            ->select(
				DB::raw(
				"SUM(
					CASE
					WHEN delivery_reports.status = 'Delivered' THEN 1 ELSE 0 END
					) AS delivered
				"),
				DB::raw(
				"SUM(
					CASE
					WHEN delivery_reports.status = 'Rejected' THEN 1 ELSE 0 END
					) AS rejected
				"),
				DB::raw(
				"SUM(
					CASE
					WHEN delivery_reports.status != 'Delivered' AND delivery_reports.status != 'Rejected' THEN 1 ELSE 0 END
					) AS failed
				"))
			->where('leads.carrier_id', '=', $carrier->id)
			->where('outbounds.team_id', '=', team()->id); */
			
			/* if(isset($request->filter) && $request->filter == "Today"){
				$carrier_stat->whereNotNull('delivery_reports.delivered_at')->where('delivery_reports.delivered_at', '>=', date('Y-m-d 00:00:00'));
			}elseif(isset($request->filter) && $request->filter == "Yesterday"){
				$carrier_stat->whereNotNull('delivery_reports.delivered_at')->where('delivery_reports.delivered_at', '>=', Carbon::now()->subDays(1));
				
			}elseif(isset($request->filter) && $request->filter == "Week"){
				$carrier_stat->whereNotNull('delivery_reports.delivered_at')->whereBetween('delivery_reports.delivered_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
			}elseif(isset($request->filter) && $request->filter == "24 Hours"){
				
				$carrier_stat->whereNotNull('delivery_reports.delivered_at')->where('delivery_reports.delivered_at', '>=', Carbon::now()->subDay());
				
			}elseif(isset($request->filter) && $request->filter == "7 days"){
				
				$carrier_stat->whereNotNull('delivery_reports.delivered_at')->where('delivery_reports.delivered_at', '>=', Carbon::now()->subDays(7));
				
			}elseif(isset($request->filter) && $request->filter == "Month"){
				
				$carrier_stat->whereNotNull('delivery_reports.delivered_at')->whereMonth('delivery_reports.delivered_at', Carbon::now()->month);
			}else{
				$carrier_stat->whereNotNull('delivery_reports.delivered_at')->where('delivery_reports.delivered_at', '>=', date('Y-m-d 00:00:00'));
			} */
			
            //$carrier_stat->first();
			//echo"<pre/>";print_r($carrier_stat);
			/* $outbound_stat = DB::table('outbounds')
			->join('leads', 'outbounds.lead_id', '=', 'leads.id')
            ->select(
				DB::raw(
				"SUM(
					CASE
					WHEN outbounds.success = 0 THEN 1 ELSE 0 END
					) AS outboundfailed
				"),
				DB::raw(
				"SUM(
					CASE
					WHEN outbounds.processed = 1 THEN 1 ELSE 0 END
					) AS total
				"))
			->where('leads.carrier_id', '=', $carrier->id)
			->where('outbounds.team_id', '=', team()->id); */
			
			/* if(isset($request->filter) && $request->filter == "Today"){
				$outbound_stat->whereNotNull('outbounds.sent_at')->where('outbounds.sent_at', '>=', date('Y-m-d 00:00:00'));
			}elseif(isset($request->filter) && $request->filter == "Yesterday"){
				$outbound_stat->whereNotNull('outbounds.sent_at')->where('outbounds.sent_at', '>=', Carbon::now()->subDays(1));
				
			}elseif(isset($request->filter) && $request->filter == "Week"){
				$outbound_stat->whereNotNull('outbounds.sent_at')->whereBetween('outbounds.sent_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
			}elseif(isset($request->filter) && $request->filter == "24 Hours"){
				
				$outbound_stat->whereNotNull('outbounds.sent_at')->where('outbounds.sent_at', '>=', Carbon::now()->subDay());
				
			}elseif(isset($request->filter) && $request->filter == "7 days"){
				
				$outbound_stat->whereNotNull('outbounds.sent_at')->where('outbounds.sent_at', '>=', Carbon::now()->subDays(7));
				
			}elseif(isset($request->filter) && $request->filter == "Month"){
				
				$outbound_stat->whereNotNull('outbounds.sent_at')->whereMonth('outbounds.sent_at', Carbon::now()->month);
			}else{
				$outbound_stat->whereNotNull('outbounds.sent_at')->where('outbounds.sent_at', '>=', date('Y-m-d 00:00:00'));
			} */
			
            //$outbound_stat->first();
			//dd($outbound_stat);
			/* if(isset($outbound_stat->total)){
				$outbound_total = $outbound_stat->total;
			}

			if(isset($outbound_stat->outboundfailed)){
				$outbound_outboundfailed = $outbound_stat->outboundfailed;
			}			
				
			if(isset($carrier_stat->delivered)){
				$carrier_delivered = $carrier_stat->delivered;
			}			
				
			if(isset($carrier_stat->rejected)){
				$carrier_rejected = $carrier_stat->rejected;
			}			
				
			if(isset($carrier_stat->failed)){
				$carrier_failed = $carrier_stat->failed;
			}	 */		
				
				//echo $carrier->name." - ".$all." - ".$delivered." - ".$failed."<br/>";
				
			$stats[] = array(
				"carrier" => $carrier->name,
				"total" => intval($all),
				"delivered" => intval($delivered),
				"failed" => intval($failed)
			);			
		}
		
        return view('carriers.index', compact('stats'));
    }
}