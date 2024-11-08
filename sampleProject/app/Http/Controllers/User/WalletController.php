<?php

namespace App\Http\Controllers\User;

use App\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Morilog\Jalali;
use DB;
use Session;
use Auth;
use App\UserFinance;
use App\User;

class WalletController extends Controller
{
    public function index_increase(){
        $result = array();
        $result['count_card'] = \App\CardBank::where('id_user',Auth::user()->id)->where('confirm',1)->count();
        return view('user.wallet.wallet-increase',['result'=>(object)$result]);
    }

    function increase(Request $request)
    {
        if(\App\CardBank::where('id_user',Auth::user()->id)->where('confirm',1)->count() <= 0){
            $request->session()->flash('Error', 'هنوز کارت بانکی تایید شده ای ندارید!');
            return redirect()->back();
        }
        if(Auth::user()->auth_img_confirm != 1 || Auth::user()->selfie_img_confirm != 1){
            $request->session()->flash('Error', 'برای پرداخت از درگاه بانکی لازم است اطلاعات شما تکمیل گردد');
            return redirect()->back();
        }

        if(\App\CardBank::where('id_user',Auth::user()->id)->where('confirm',1)->count() <= 0){
            $request->session()->flash('Error', 'هنوز کارت بانکی تایید شده ای ندارید!');
            return redirect()->back();
        }

        if (!isset($request->amount)) {
            $request->session()->flash('Error', 'مبلغ را درج کنید');
            return redirect()->back();
        }
        $functions = new \App\functions;

        $payment_gateway = getSetting('payment_gateway');
        $amount = str_replace(',', '', $request->amount);

        Session::put('amount',$amount);
        Session::put('description',$request->description);

        $id = self::SaveMoalagh(Auth::user()->id,$amount,$payment_gateway,$request->description,$request->ip());

        $CallbackURL = asset('')."wallet/callback/".$id;

        if($payment_gateway=='pay') {
            $PayIrToken = getSetting('PayIrToken');
            $params = array(
                'api' => $PayIrToken,
                'amount' => $amount*10,
                'name' => Auth::user()->name .' '. Auth::user()->family,
                'mobile' => Auth::user()->mobile,
                'factorNumber' => $id,
                'description' => 'شارژ کیف پول ',
                'redirect' => $CallbackURL,
            );
            $authorization = null;
            $result = $functions->Curl('https://pay.ir/pg/send',$params,$authorization);
            if($result->status) {
                $go = "https://pay.ir/pg/$result->token";
                return redirect($go);
            } else {
                echo $result->errorMessage;
            }

        }elseif($payment_gateway=='idpay'){
            $IdpayToken = getSetting('IdpayToken');
            $params = array(
                'order_id' => time(),
                'amount' => $amount*10,
                'name' => Auth::user()->name .' '. Auth::user()->family,
                'phone' => Auth::user()->mobile,
                'mail' => Auth::user()->email,
                'desc' => 'شارژ کیف پول ',
                'callback' => $CallbackURL,
            );
            $authorization = 'X-API-KEY: '.$IdpayToken;
            $result = $functions->Curl('https://api.idpay.ir/v1.1/payment',$params,$authorization);
            //dd($result);
            header("Location: $result->link");

        }elseif($payment_gateway=='zarinpal'){
            $Token = Settings::where('name','ZarinpalToken')->first()->value;
            $data = array(
                "merchant_id" => $Token,
                "amount" => $amount*10,
                "callback_url" => $CallbackURL,
                "description" => 'شارژ کیف پول ',
                "metadata" => [ "email" => Auth::user()->email, "mobile" => Auth::user()->mobile],
            );
            $jsonData = json_encode($data);
            $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
            curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData)
            ));

            $result = curl_exec($ch);
            $err = curl_error($ch);
            $result = json_decode($result, true, JSON_PRETTY_PRINT);
            curl_close($ch);
            //dd($result);
            header("Location: https://www.zarinpal.com/pg/StartPay/" . $result['data']["authority"]);

        }elseif($payment_gateway=='zibal'){
            $ZibalToken = Settings::where('name','ZibalToken')->first()->value;
            $parameters = array(
                "merchant"=> $ZibalToken,//required
                "callbackUrl"=> $CallbackURL,//required
                "amount"=> $amount*10,//required

                "orderId"=> time(),//optional
                "mobile"=> Auth::user()->mobile
            );

            $url = 'https://gateway.zibal.ir/v1/request';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response  = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);


            if ($response->result == 100)
            {
                $startGateWayUrl = "https://gateway.zibal.ir/start/" . $response->trackId;
                header('location: '.$startGateWayUrl);
            }
            else{
                echo "errorCode: ".$response->result."<br>";
                echo "message: ".$response->message;
            }

        }

    }

    function increase_callback(Request $request)
    {
        $UserFinance = UserFinance::find($request->id);
        $functions = new \App\functions;
        $payment_gateway = getSetting('payment_gateway');
        if($payment_gateway=='pay') {
            if($request->status != 0 ){
                $PayIrToken = getSetting('PayIrToken');
                $params = array(
                    'api' => $PayIrToken,
                    'token' => $request->token,
                );
                $result = $functions->Curl('https://pay.ir/pg/verify',$params,null);
                if(isset($result->status)){
                    if($result->status == 1){
                        $result = self::payment_success($UserFinance->id,$result->transId,'پی آی آر',$request->ip());
                    } else {
                        $result = array('status' => false, 'message' => $result->errorMessage);
                    }
                } else {
                    if($_GET['status'] == 0){
                        $result = array('status' => false, 'message' => "خطا در پرداخت!");
                    }
                }
            }else
                $result = array('status' => false, 'message' => "پرداخت لغو شد!");
        }
        elseif($payment_gateway=='idpay'){
            //return response()->json($request);
            $IdpayToken = getSetting('IdpayToken');
            if($request->status == 10){
                $CheckCardBank = self::CheckCardBank($UserFinance->id,$UserFinance->amount,$request->card_no,$request->hashed_card_no,'hash');
                if($CheckCardBank == true) {
                    $params = array(
                        'id' =>  $request->id,
                        'order_id' => $request->order_id,
                    );
                    $authorization = 'X-API-KEY: '.$IdpayToken;
                    $res = $functions->Curl('https://api.idpay.ir/v1.1/payment/verify',$params,$authorization);
                    if(isset($res->status) && $res->status == 100){
                        $result = self::payment_success($UserFinance->id,$res->track_id,'زیبال',$request->ip());
                    }else
                        $result = array('status' => false, 'message' => "پرداخت با شکست مواجه شد!");
                }else
                    $result = array('status' => false, 'message' => "کارتی که پرداخت کرده اید در پنل کاربری ثبت نشده است و مبلغ پرداخت شده حداکثر تا یک ساعت آینده به کارت پرداخت کننده به صورت اتوماتیک عودت میشود و تیکتی در این خصوص برای شما ثبت شده است که آن را بررسی و پیگیری نمایید.");
            }else{
                $result = array('status' => false, 'message' => "پرداخت کنسل شد!");
            }

        }
        elseif($payment_gateway=='zarinpal'){
            $Token = Settings::where('name','ZarinpalToken')->first()->value;

            if($request->Status == 'OK'){
                $data = array("merchant_id" => $Token, "authority" => $request->Authority, "amount" => $UserFinance->amount * 10);
                $jsonData = json_encode($data);
                $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
                curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($jsonData)
                ));

                $result = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($result, true);
                if(isset($result['data']['code']) && $result['data']['code'] == 100){
                    $result = self::payment_success($UserFinance->id, $result['data']['ref_id'], 'زرین‌پال', $request->ip());
                }else
                    $result = array('status' => false, 'message' => "پرداخت با شکست مواجه شد!");
            }else{
                $result = array('status' => false, 'message' => "پرداخت کنسل شد!");
            }
        }
        elseif($payment_gateway=='zibal'){
            $ZibalToken = Settings::where('name','ZibalToken')->first()->value;

            if($request->success == 1){
                $parameters = array(
                    "merchant"=> $ZibalToken,//required
                    "trackId"=> $request->trackId
                );

                $url = 'https://gateway.zibal.ir/v1/verify';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response  = curl_exec($ch);
                curl_close($ch);
                $response = json_decode($response);
                if(isset($response->result) && $response->result == 100){
                    $result = self::payment_success($UserFinance->id, $response->refNumber,'زیبال', $request->ip());
                }else
                    $result = array('status' => false, 'message' => "پرداخت با شکست مواجه شد!");
            }else{
                $result = array('status' => false, 'message' => "پرداخت کنسل شد!");
            }
        }

        return view('user.wallet.callback',['result' => (object)$result]);

    }


    public function index_decrement(){
        $result = array();
        $result['cardbank'] = \App\CardBank::where('id_user',Auth::user()->id)->where('confirm',1)->orderBy('updated_at','desc')->get();
        $result['Withdraw_value_min'] = getSetting('Withdraw_value_min');
        $result['count_card'] = \App\CardBank::where('id_user',Auth::user()->id)->where('confirm',1)->count();
        return view('user.wallet.wallet-decrement',['result'=>(object)$result]);
    }

    function decrement(Request $request)
    {
        if (!isset($request->amount) || !isset($request->cardbank)) {
            $request->session()->flash('Error', 'مبلغ را درج کنید');
            return redirect()->back();
        }

        $amount = str_replace(',', '', $request->amount);
        $Withdraw_value_min = getSetting('Withdraw_value_min');

        if ($amount < $Withdraw_value_min || $amount > Auth::user()->wallet) {
            $result = array('status' => false, 'message'=> 'مبلغ از موجودی شما بیشتر است');
            return response()->json($result);
        }


        User::find(Auth::user()->id)->decrement('wallet',$amount);
        $user_finance = new UserFinance;
        $user_finance->type = 'برداشت';
        $user_finance->status = 'در دست اقدام';
        $user_finance->description = 'در انتظار پرداخت';
        $user_finance->user_description = $request->description;
        $user_finance->id_user = Auth::user()->id;
        $user_finance->amount = $amount;
        $user_finance->id_cardbank = $request->cardbank;
        $user_finance->stock = Auth::user()->wallet - $amount;
        $user_finance->ip = $request->ip();
        $user_finance->save();

        $functions = new \App\functions;
        $sendMoney = $functions->FinotechSendMoney($user_finance->id_cardbank,$user_finance->amount,$user_finance->id_user,null,$user_finance->id);
        if($sendMoney->status == true){
            $user_finance->status = 'واریز شده';
            $user_finance->description = 'از طریق شبا واریز شد';
            $user_finance->save();
        }

        $result = array('status' => true, 'url'=> asset('').'wallet/withdraw/'.$user_finance->id,'id'=>$user_finance->id);
        return response()->json($result);

    }

    public function decrementCallback(Request $request){
        $user_finance = UserFinance::find($request->id);
        $date = Jalali\CalendarUtils::strftime('d F Y  ساعت H:i', strtotime($user_finance->created_at));
        if(!isset($user_finance->payment) && $user_finance->status == 'در دست اقدام')
            $result = array('status' => true, 'message' => "درخواست شما با موفقیت ثبت شد و 'در دست اقدام' میباشد و از لیست تراکنش ها قابل پیگیری و مشاهده است!",'date'=>$date,'user_finance'=>$user_finance);
        else
            $result = array('status' => true, 'message' => "مبلغ مورد نظر از کیف پول شما کسر شد و به حساب بانکی شما با موفقیت واریز گردید و از لیست تراکنش ها قابل پیگیری و مشاهده است!",'date'=>$date,'user_finance'=>$user_finance);

        return view('user.wallet.callback-decrement',['result' => (object)$result]);
    }

    public function finance_index(){
        $result = array();

        $Finances = UserFinance::select('stock','created_at')->where('id_user',Auth::user()->id)->where('status','!=','معلق')->orderBy('id','desc')->limit(20)->get()->reverse();
        foreach($Finances as $finance):
            $finance->date =  Jalali\CalendarUtils::strftime('Y/m/d H:i', strtotime($finance->created_at));
        endforeach;
        $result['finance'] = $Finances;

        $result['count_card'] = \App\CardBank::where('id_user',Auth::user()->id)->where('confirm',1)->count();
        return view('user.wallet.wallet-list',['result'=>(object)$result]);
    }

    public function list_deposit() {
        $functions = new \App\functions;
        $Finances = \App\UserFinance::select('id','type','status','description','amount','created_at','updated_at')
            ->where('id_user',Auth::user()->id)
            ->where('type', 'واریز')
            ->get();

        foreach ($Finances as $Finance) {
            $Finance->created_at = Jalali\CalendarUtils::strftime('H:i Y/m/d', strtotime($Finance->created_at));
            $Finance->updated_at = Jalali\CalendarUtils::strftime('H:i Y/m/d', strtotime($Finance->updated_at));
        }

        return view('user.history.wallet-deposit-list',['Finances' => $Finances]);
    }

    public function list_withdraw() {
        $functions = new \App\functions;
        $Finances = \App\UserFinance::select('id','type','status','description','amount','created_at','updated_at')
            ->where('id_user',Auth::user()->id)
            ->where('type', 'برداشت')
            ->get();

        foreach ($Finances as $Finance) {
            $Finance->created_at = Jalali\CalendarUtils::strftime('H:i Y/m/d', strtotime($Finance->created_at));
            $Finance->updated_at = Jalali\CalendarUtils::strftime('H:i Y/m/d', strtotime($Finance->updated_at));
        }

        return view('user.history.wallet-withdraw-list',['Finances' => $Finances]);
    }

    public function single_finance(Request $request){
        $result = (object)array();
        $finance = UserFinance::where('id',$request->id)->first();
        $user = User::find($finance->id_user);
        $provinces = isset($user->id_province) ? \App\provinces::find($user->id_province)->title : '';
        $city = isset($user->id_city) ? \App\cities::find($user->id_city)->title : '';
        $user->address = isset($user->address) ? $provinces . ' - ' . $city . ' - ' . $user->address : '';
        $result->user = $user;
        $result->finance = $finance;
        $result->cardbank = \App\CardBank::find($finance->id_cardbank);

        return view('user.wallet.finance-single',['result'=>$result]);

    }

    protected function CheckCardBank($id_UserFinance, $amount, $maskCard, $HashCardNumber = null, $model = null)
    {
        $UserCardBank = \App\CardBank::select('card_number')->where('confirm','1')->where('id_user',Auth::user()->id)->get();
        if(isset($HashCardNumber)&& $HashCardNumber !=''){
            foreach($UserCardBank as $card){
                $hash = strtoupper(hash('sha256', $card->card_number));
                if($hash == $HashCardNumber)
                    return true;
            }
        }else{
            foreach($UserCardBank as $card){
                $CardNumberFrist = substr($maskCard,0,6);
                $CardFrist = substr($card->card_number,0,6);
                $CardNumberLast = substr($maskCard,-4);
                $CardLast = substr($card->card_number,-4);
                if($CardNumberFrist == $CardFrist && $CardNumberLast == $CardLast)
                    return true;
            }
        }


        $UserFinance = UserFinance::find($id_UserFinance);
        $UserFinance->status = 'ناموفق';
        $UserFinance->save();


        $ticket = new \App\Ticket;
        $ticket->title = 'عدم انجام افزایش موجودی';
        $ticket->unit = 'مالی';
        $ticket->status = 1;
        $ticket->seen_admin = 1;
        $ticket->id_user = Auth::user()->id;
        $ticket->save();

        $ticket_message = new \App\TicketMessage;
        $ticket_message->id_ticket = $ticket->id;
        $ticket_message->author = 'admin';
        $ticket_message->message = '        شما افزایش موجودی به مبلغ '. number_format($amount) .' تومان را توسط کارت '.'<span dir="ltr">' .$maskCard .'</span>' .' انجام داده اید که هنوز در پنل کاربری ثبت یا تایید نشده است. مبلغ پرداخت شده حداکثر تا یک ساعت دیگر به صورت اتوماتیک به کارت عودت میگردد.

<a href="'.asset('profile/financial').'" class="typo_link text-warning">جهت افزودن کارت کلیک کنید</a>
        ';
        $ticket_message->save();

        return false;
    }



    protected function payment_success($id_UserFinance,$trans_id,$nameGatway,$ip){

        User::find(Auth::user()->id)->increment('wallet',Session::get('amount'));
        $user_finance = UserFinance::find($id_UserFinance);
        $user_finance->type = 'واریز';
        $user_finance->status = 'موفق';
        $user_finance->description = $nameGatway;
        //$user_finance->user_description = Session::get('description');
        $user_finance->id_user = Auth::user()->id;
        //$user_finance->amount = Session::get('amount');
        $user_finance->stock = Auth::user()->wallet + $user_finance->amount;
        $user_finance->traceNumber = $trans_id;
        $user_finance->ip = $ip;
        $user_finance->save();

        $date = Jalali\CalendarUtils::strftime('d F Y  ساعت H:i', strtotime($user_finance->created_at));
        $result = array('status' => true, 'message' => "پرداخت با موفقیت انجام شد!",'RefID'=>$trans_id,'date'=>$date,'user_finance'=>$user_finance);

        return $result;
    }



    public function SaveMoalagh($id_user,$amount,$nameGatway,$user_description,$ip){
        $user = User::find($id_user);
        $user_finance = new UserFinance;
        $user_finance->type = 'واریز';
        $user_finance->status = 'معلق';
        $user_finance->description = $nameGatway;
        $user_finance->user_description = $user_description;
        $user_finance->id_user = $id_user;
        $user_finance->amount = $amount;
        $user_finance->stock = $user->wallet;
        $user_finance->traceNumber = null;
        $user_finance->ip = $ip;
        $user_finance->save();

        return $user_finance->id;
    }

    public function check_stock2()
    {
        $result = array();

        $cryptocurrency = \App\Cryptocurrency::all()->pluck('symbol')->toArray();
        $Controller = 'App\Http\Controllers\User\CryptoController';
        $fees =  app($Controller)->price($cryptocurrency);
        $balances =  app($Controller)->balances();
        foreach ($fees->coins as $fee){
            $coin = \App\Cryptocurrency::where('symbol', $fee->symbol)->first()->name;
            foreach ($balances as $balance)
                if($balance->symbol == $fee->symbol)
                    $result['stock_' . $coin] = $balance->stock . $fee->symbol;
            $result['fee_buy_' . $coin] = number_format($fee->buy);
            $result['fee_sell_'.  $coin] = number_format($fee->sell);
        }

        $functions = new \App\functions;
        $cryptocurrencies = \App\Cryptocurrency::select('id','name','name_fa','symbol')->get();

        foreach($cryptocurrencies as $cryptocurrency) {

        }

        return view('user.cripto.wallet', compact(['cryptocurrencies','result']));
    }
}
