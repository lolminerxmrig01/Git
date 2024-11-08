<?php

namespace App\Http\Controllers\User;

use App\functions;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Morilog\Jalali;
use DB;
use Session;
use Auth;
use App\Settings;
use SoapClient;

class DashboardController extends Controller
{
    public function index(Request $request){


        $result = (object)array();


        $result->CountBuy = $Orders = \App\Orders::where('id_user',Auth::user()->id)->where('status','!=','معلق')->where('status','!=','معلق,عودت')->
            whereRaw('(type = "buy" or type = "buy-product")')->count();
        $result->CountSell = $Orders = \App\Orders::where('id_user',Auth::user()->id)->where('status','!=','معلق')->where('status','!=','معلق,عودت')->
            whereRaw('(type = "sell")')->count();

        $result->TotalAmount = $Orders = \App\Orders::where('id_user',Auth::user()->id)->where('status','!=','معلق')->where('status','!=','معلق,عودت')->sum('amount');

        $Finances = \App\UserFinance::select('stock','created_at')->where('id_user',Auth::user()->id)->orderBy('id','desc')->limit(10)->get()->reverse();
        $result->ChartFinance = $Finances;

        $result->CountFinance = \App\UserFinance::where('id_user',Auth::user()->id)->count();
        $result->CountFinanceIncrement = \App\UserFinance::where('id_user',Auth::user()->id)->where('type','واریز')->count();
        $result->CountFinanceDecrement = \App\UserFinance::where('id_user',Auth::user()->id)->where('type','برداشت')->count();

        $result->CountTicket = \App\Ticket::where('id_user',Auth::user()->id)->count();
        $result->CountInvitation = User::where('invitationID',Auth::user()->id)->count();




        $dateString = Jalali\Jalalian::forge('now')->format('Y-m-01');
        $FristDayMonth = Jalali\CalendarUtils::createCarbonFromFormat('Y-m-d', $dateString)->format('Y-m-d');
        $dateString =  Jalali\Jalalian::forge('now')->addMonths(1)->format('Y-m-01');
        $LastDayMonth = Jalali\CalendarUtils::createCarbonFromFormat('Y-m-d', $dateString)->format('Y-m-d');
        $result->Month = Jalali\Jalalian::forge('now')->format('F');


        $result->CountBuyMonth = $Orders = \App\Orders::where('id_user',Auth::user()->id)->where('status','!=','معلق')->where('status','!=','معلق,عودت')->
        whereRaw('(type = "buy" or type = "charge") and created_at > ? and created_at < ?',[$FristDayMonth,$LastDayMonth])->sum('amount');
        $result->CountSellMonth = $Orders = \App\Orders::where('id_user',Auth::user()->id)->where('status','!=','معلق')->where('status','!=','معلق,عودت')->
        whereRaw('(type = "sell") and created_at > ? and created_at < ?',[$FristDayMonth,$LastDayMonth])->sum('amount');


        $result->SumOrderDay = \App\Orders::where('id_user', Auth::user()->id)->where('created_at', '>', date('Y-m-d'))
            ->where('created_at', '<', date('Y-m-d',strtotime("+1 days")))
            ->whereIn('type', ['buy','buy-product'])->whereIn('status',['پرداخت شده','در حال بررسی پرداخت','در دست اقدام','در حال پردازش'])->sum('amount');



        $result->notification = \App\Notification::select('id','title','message','notification','head_fix','head_close','color')
            ->get();
        foreach ($result->notification as $Notif ) {

        }

        $result->cardbank = \App\CardBank::where('id_user',Auth::user()->id)->where('confirm',1)->count();

        $Cookie = json_decode(\Cookie::get('alertID'));
        if(isset($Cookie))
            foreach ($result->notification as $key=>$notification){
                if(in_array($notification->id,$Cookie))
                    unset($result->notification[$key]);
            }


        //$Currencys = array('PSVouchers','PerfectMoney','WebMoney');
        $Currencys = array();
        $cryptocurrency = \App\Cryptocurrency::all()->pluck('name')->toArray();
        $result->Currencys = (object)array_merge($Currencys,$cryptocurrency);

        $result->InvitationAmount = \App\UserInvitation::where('id_user',Auth::user()->id)->orderBy('created_at','desc')->sum('amount');

        return view('user.dashboard',['result'=>$result]);

    }

    public function check_stock()
    {
        $result = array();

        $cryptocurrency = \App\Cryptocurrency::all()->pluck('symbol')->toArray();
        $Controller = 'App\Http\Controllers\User\CryptoController';
        $fees =  app($Controller)->price($cryptocurrency);
        $balances =  app($Controller)->balances();
        foreach ($fees->coins as $fee){
            $coin = \App\Cryptocurrency::where('symbol',$fee->symbol)->first()->name;
            foreach ($balances as $balance)
                if($balance->symbol == $fee->symbol)
                     $result['stock_'.$coin] = $balance->stock.$fee->symbol;
            $result['fee_buy_'.$coin] = number_format($fee->buy);
            $result['fee_sell_'.$coin] = number_format($fee->sell);
        }

        return response()->json((object)$result);

    }

    public function RemoveNotification(Request $request){
        $Cookie = \Cookie::get('alertID');
        $Cookie = json_decode($Cookie);
        if(isset($Cookie)){
            if(!in_array($request->id,$Cookie))
                array_push($Cookie,$request->id);
        }
        else
            $Cookie = array($request->id);
        \Cookie::queue('alertID', json_encode($Cookie), 600000);
    }


    public function insert_token(Request $request){
        if($request->token != Auth::user()->firebase_token){
            $user = User::find(Auth::user()->id);
            $user->firebase_token = $request->token;
            $user->save();
        }

        define('API_ACCESS_KEY', env('FirebaseToken'));

        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $curlUrl = "https://iid.googleapis.com/iid/v1:batchAdd";
        $mypush = array("to"=>"/topics/all", "registration_tokens"=>array($request->token));
        $myjson = json_encode($mypush);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curlUrl);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, True);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $myjson);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        return response()->json($response);

    }


    protected function redirectForm(Request $request){
        //dd($request);

        if($request->type == 'true'){
            $amount = str_replace(',','',$request->amount);
            return redirect($request->coin.'?amount='.$amount);
        }else{
            $amount = str_replace(',','',$request->amount);
            return redirect($request->coin.'/sell?amount='.$amount);
        }
        return redirect()->back();
        //return response()->json($request);
    }



    public function RemoveAllNotifications(){
        $Cookie = \Cookie::get('NTime');
        $Cookie = json_decode($Cookie);
        if(!isset($Cookie))
            $Cookie = (object) array();

        $Cookie->order = time();
        $Cookie->wallet = time();
        $Cookie->invitation = time();
        \Cookie::queue('NTime', json_encode($Cookie), 43200);

        \App\Ticket::where('id_user',Auth::user()->id)->where('seen_user',0)->update(['seen_user'=>1]);


        return redirect()->back();
    }

    public function maxSale(Request $request)
    {
        $ticket = new \App\Ticket;
        $ticket->title = 'افزایش سقف خرید روزانه';
        $ticket->unit = 'مالی';
        $ticket->status = 0;
        $ticket->seen_admin = 0;
        $ticket->id_user = Auth::user()->id;
        $ticket->save();

        $ticket_message = new \App\TicketMessage;
        $ticket_message->id_ticket = $ticket->id;
        $ticket_message->author = 'user';
        $ticket_message->message = ' اینجانب '. Auth::user()->name.' '. Auth::user()->family .' درخواست افزایش سقف خرید روزانه به مبلغ '.$request->max
                                    .' تومان را دارم و لطفا درخواست من را بررسی و اعمال نمایید.
                                    <small>این یک درخواست اتوماتیک است</small> ';
        $ticket_message->save();

        return array('status'=>true,'messege'=>'درخواست شما با موفقیت ثبت شد.','id'=>$ticket->id);
    }
}

