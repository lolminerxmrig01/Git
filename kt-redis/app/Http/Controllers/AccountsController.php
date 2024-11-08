<?php

namespace App\Http\Controllers;

use App\Account;
use App\Carrier;
use App\Outbound;
use App\DeliveryReport;
use DB;
use App\Http\Requests\AccountsControllerStoreRequest;
use App\Http\Requests\AccountStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class AccountsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		if(isset($request->filter) && $request->filter == "Today"){
			$accounts = team()->accounts()->with('messageGroup')->withCount(['numbers', 'accounts', 'replies' => function ($query) {
				$query->where('created_at', '>=', date('Y-m-d 00:00:00'));
			  }, 'outbounds' => function ($query) {
				$query->where('processed','1')->where('sent_at', '>=', date('Y-m-d 00:00:00'));
			  },'delivered' => function ($query) {
				$query->where('status', 'Delivered')->where('delivered_at', '>=', date('Y-m-d 00:00:00')); 
			  }, 'failed' => function ($query) {
				$query->where('status' ,'!=', 'Delivered')->where('delivered_at', '>=', date('Y-m-d 00:00:00'));
			  }])->get(); 
			
		}elseif(isset($request->filter) && $request->filter == "Yesterday"){
			$accounts = team()->accounts()->with('messageGroup')->withCount(['numbers', 'accounts', 'replies' => function ($query) {
				$query->where('created_at', '>=', Carbon::now()->subDays(1));
			  }, 'outbounds' => function ($query) {
				$query->where('processed','1')->where('sent_at', '>=', Carbon::now()->subDays(1));
			  },'delivered' => function ($query) {
				$query->where('status', 'Delivered')->where('delivered_at', '>=', Carbon::now()->subDays(1)); 
			  }, 'failed' => function ($query) {
				$query->where('status' ,'!=', 'Delivered')->where('delivered_at', '>=', Carbon::now()->subDays(1));
			  }])->get();
		}elseif(isset($request->filter) && $request->filter == "Week"){
			$accounts = team()->accounts()->with('messageGroup')->withCount(['numbers', 'accounts', 'replies' => function ($query) {
				$query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
			  }, 'outbounds' => function ($query) {
				$query->where('processed','1')->whereBetween('sent_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
			  },'delivered' => function ($query) {
				$query->where('status', 'Delivered')->whereBetween('delivered_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]); 
			  }, 'failed' => function ($query) {
				$query->where('status' ,'!=', 'Delivered')->whereBetween('delivered_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
			  }])->get();
		}elseif(isset($request->filter) && $request->filter == "24 Hours"){
			$accounts = team()->accounts()->with('messageGroup')->withCount(['numbers', 'accounts', 'replies' => function ($query) {
				$query->where('created_at', '>=', Carbon::now()->subDay());
			  }, 'outbounds' => function ($query) {
				$query->where('processed','1')->where('sent_at', '>=', Carbon::now()->subDay());
			  },'delivered' => function ($query) {
				$query->where('status', 'Delivered')->where('delivered_at', '>=', Carbon::now()->subDay()); 
			  }, 'failed' => function ($query) {
				$query->where('status' ,'!=', 'Delivered')->where('delivered_at', '>=', Carbon::now()->subDay());
			  }])->get();
		}elseif(isset($request->filter) && $request->filter == "7 days"){
			$accounts = team()->accounts()->with('messageGroup')->withCount(['numbers', 'accounts', 'replies' => function ($query) {
				$query->where('created_at', '>=', Carbon::now()->subDays(7));
			  }, 'outbounds' => function ($query) {
				$query->where('processed','1')->where('sent_at', '>=', Carbon::now()->subDays(7));
			  },'delivered' => function ($query) {
				$query->where('status', 'Delivered')->where('delivered_at', '>=', Carbon::now()->subDays(7)); 
			  }, 'failed' => function ($query) {
				$query->where('status' ,'!=', 'Delivered')->where('delivered_at', '>=', Carbon::now()->subDays(7));
			  }])->get();
		}elseif(isset($request->filter) && $request->filter == "Month"){
			$accounts = team()->accounts()->with('messageGroup')->withCount(['numbers', 'accounts', 'replies' => function ($query) {
				$query->whereMonth('created_at', Carbon::now()->month);
			  }, 'outbounds' => function ($query) {
				$query->where('processed','1')->whereMonth('sent_at', Carbon::now()->month);
			  },'delivered' => function ($query) {
				$query->where('status', 'Delivered')->whereMonth('delivered_at', Carbon::now()->month); 
			  }, 'failed' => function ($query) {
				$query->where('status' ,'!=', 'Delivered')->whereMonth('delivered_at', Carbon::now()->month);
			  }])->get();
		}else{
			$accounts = team()->accounts()->with('messageGroup')->withCount(['numbers', 'accounts', 'replies'
			, 'outbounds' => function ($query) {
				$query->where('processed','1'); 
			},'delivered' => function ($query) {
				$query->where('status', 'Delivered'); 
			}, 'failed' => function ($query) {
				$query->where('status' ,'!=', 'Delivered');
			}])->get(); 
		}
		
		//dd($accounts);
		
        return view('accounts.index', compact('accounts'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Account $account
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Account $account)
    {
        $numbers = $account->numbers()->withCount('outbounds')->take(20)->paginate();
        $account->loadCount('numbers');

        $attachedAccounts = $account->accounts()->with('provider')->withCount('numbers')->get();

        $except = array_merge($account->accounts()->get()->map->id->all(), [$account->id]);
        $availableAccounts = $account->team->accounts()->singular()->whereNotIn('id', $except)->with('provider')->withCount('numbers')->get();

        $logs = $account->activityLogs()->latest()->get();

        if ($account->is_group) {
            $attachedAccounts->loadCount([
                'replies' => fn($query) => $query->after(now()->subHours(24)),
                'badReplies' => fn($query) => $query->after(now()->subHours(24)),
            ]);
        }

        return view('accounts.show', compact('account', 'numbers', 'attachedAccounts', 'availableAccounts', 'logs'));
    }
	
	public function failed(Request $request, Account $account)
    {
       // $accounts = $account->with(['outbounds', 'failed' => function ($query) {
			//	$query->where('status' ,'!=', 'Delivered');
			  //}])->take(20)->paginate();
			  
		$headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',   
			'Content-type'        => 'text/csv',
			'Content-Disposition' => 'attachment; filename=failedMessages.csv',   
			'Expires'             => '0',   
			'Pragma'              => 'public'
		];	  
			  
		/* $failed = DeliveryReport::join('outbounds', 'delivery_reports.account_id', '=', 'outbounds.account_id')
            ->where('delivery_reports.account_id', $account->id)
            ->where('delivery_reports.status' ,'!=', 'Delivered')
			->get(['outbounds.from', 'outbounds.to', 'outbounds.content']);	   */
		$failed = DeliveryReport::where('account_id', $account->id)->where('status' ,'!=', 'Delivered')->get();	 	
			
		$columns = array('FROM', 'TO');

		$callback = function() use ($failed, $columns) 
		{
			$FH = fopen('php://output', 'w');
			fputcsv($FH, $columns);
			foreach ($failed as $row) { 
				
				$outbound = Outbound::where('id' , $row['outbound_id'])->first();
			
				fputcsv($FH, array($outbound->from, $outbound->to));
				//fputcsv($FH, array($row['id']));
			}
			fclose($FH);
		};

		return response()->stream($callback, 200, $headers);	
    }

    public function create()
    {
        return view('accounts.create');
    }

    /**
     * @param \App\Http\Requests\AccountsControllerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountStoreRequest $request)
    {
        $account = team()->accounts()->make($request->all());
        $account->send_rate = $account->getDefaultSendRate();
        $account->save();

        return redirect()->route('accounts.index');
    }

    public function attachSubaccount(Account $account)
    {
        foreach (request('accounts') as $accountId) {
            $account->attachAccount(Account::find($accountId));
        }

        return back();
    }

    public function detachSubaccount(Account $account, Account $subAccount)
    {
        $account->detachAccount($subAccount);

        return back();
    }
	
	public function showCarrierStats()
    {
		$carriers = Carrier::get();
		
		$stats = array();
		foreach($carriers as $carrier){
			
			$carrier_stat = DB::table('outbounds')
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
			->where('outbounds.team_id', '=', team()->id)
            ->first();
			
			$outbound_stat = DB::table('outbounds')
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
			->where('outbounds.team_id', '=', team()->id)
            ->first();
			
			$stats[] = array(
				"carrier" => $carrier->name,
				"total" => intval($outbound_stat->total),
				"delivered" => intval($carrier_stat->delivered),
				"rejected" => intval($carrier_stat->rejected),
				"failed" => intval($carrier_stat->failed + $outbound_stat->outboundfailed)
			);			
		}
		
		//echo"<pre/>";print_r($stats);die;
		
        return view('carriers.index', compact('stats'));
    }
}
