<?php

namespace App\Http\Controllers\user;

use App\functions;
use App\Http\Controllers\Controller;
use App\Orders;
use App\OrdersCryptocurrency;
use App\Settings;
use Illuminate\Http\Request;
use App\Cryptocurrency;
use Binance;
use Auth;
use Session;
use Morilog\Jalali;
use DB;

class CryptoController extends Controller
{
    public $Crypto ;

    public function __construct(Request $request)
    {
        $this->Crypto = (object)array();
        $arr = explode("/", $request->path(), 2);
        $this->Crypto = Cryptocurrency::where('name',$arr[0])->first();
    }

    public function BuyIndex(Request $request){

        $data = (object)array();
        //$data->transfer_fee = getSetting('transfer_fee_'.$this->Crypto->name);
        //$data->transfer_fee = self::withdrawFee($this->Crypto->symbol);

        // Min Buy for Trade
        $Crypto = (object)array();
        $Crypto =  $this->Crypto;
        $Crypto->min_buy = self::MinBuyForTrade();

        $result = \App\Wallet::where('id_user', Auth::user()->id)
            ->where('confirm',1)
            ->orderBy('updated_at','desc')
            ->select('wallet','coin_name')
            ->get();

        $networks = $this->getFee();

        return view('user.cripto.buy', [
            'Crypto' => $Crypto,
            'data' => $data,
            'networks' => $networks,
            'network' => $networks[0] ?? false,
            'result' => $result
        ]);
    }

    function calculate(Request $request)
    {
        $result = array();
        if ($request->model == 'buy')
            $result['fee'] = $this->price()->buy;
        elseif ($request->model == 'sell')
            $result['fee'] = $this->price()->sell;

        //$result['transfer_fee'] = getSetting('transfer_fee_'.$this->Crypto->name);
        $result['transfer_fee'] = self::withdrawFee($this->Crypto->symbol);

        $result['transfer_fee_amount'] = round($result['transfer_fee'] *  $result['fee']);

        if (isset($request->amount)) {
            $result['amount'] = str_replace(',', '', $request->amount);
            $result['coin'] = round($result['amount'] / $result['fee'], $this->Crypto->percent);
            $result['payment'] = $result['amount'] + $result['transfer_fee_amount'];
            $result['amount'] = $result['amount'];

        } elseif (isset($request->coin)) {

            if($request->model == 'buy')
                $result['payment'] = $request->coin * $result['fee'] + $result['transfer_fee_amount'];
            elseif ($request->model == 'sell')
                $result['payment'] = $request->coin * $result['fee'];

            $result['amount'] = round($request->coin * $result['fee']);
            $result['coin'] = $request->coin;
        }


        /*
        if (str_replace(',', '', $result['amount']) > 50000000)
            $result['message'] = "با توجه به محدودیت درگاه بانکی حداکثر مبلغ قابل پرداخت 50,000,000 تومان است.";
        else
            $result['message'] = "";
        */
        $result['message'] = "";
        return response()->json($result);
    }

    function buy(Request $request)
    {
        $minBuy = self::MinBuyForTrade();
        if($minBuy > $request->coin){
            $result = array('status' => false, 'message' => "حداقل مجاز مقدار ".$this->Crypto->name_fa.' '.$minBuy.' است.');
            return response()->json($result);
        }

        if (!isset($request->amount) || !isset($request->destination) ) {
            $result = array('status' => false, 'message' => "مقادیر نا معتبر است!");
            return response()->json($result);
        }
        //$transfer_fee = getSetting('transfer_fee_'.$this->Crypto->name);
        $transfer_fee = self::withdrawFee($this->Crypto->symbol);


        $amount = str_replace(',', '', $request->amount);
        $fee = $this->price()->buy;
        $dollar = ($amount / $fee);
        $amount = $amount + ($transfer_fee * $fee);

        $order_fee = getSetting('buy_order_fee', 0)->value;
        $calc_order_fee = $amount * ( $order_fee / 100 );
        $amount = $amount + $calc_order_fee;


        $default_exchanger = getSetting('default_exchanger');
        if(in_array($default_exchanger, ['binance', 'coinex'])){
            $functions = new functions;
            $CheckBeforeBuy = $functions->CheckBeforeBuy($amount,$request->buy_method,null,$this->Crypto->name,$dollar);
            if($CheckBeforeBuy->status == false)
                return response()->json($CheckBeforeBuy);
        }

        $order = new Orders;
        $order->id_user = Auth::user()->id;
        $order->amount = $amount;
        $order->buy_order_fee = $calc_order_fee;
        $order->description = $request->description;
        $order->type = 'buy';
        $order->ip = $request->ip();
        $order->orders_model = $this->Crypto->name;
        if ($request->buy_method == 1)
            $order->wallet = $amount;
        $order->save();

        Session::put('buy_method',$request->buy_method);

        Session::put('destination',$request->destination);
        Session::put('destination_tag',$request->destination_tag);

        $result = array('status' => true, 'message' => "", 'id' => $order->id);
        return response()->json($result);
    }

    function buy_payment(Request $request)
    {
        $order = Orders::where('id', $request->route('id'))->where('id_user', Auth::user()->id)->
        where('type', 'buy')->where('orders_model', $this->Crypto->name)->whereNull('payment')->
        where('created_at', '>', date('Y-m-d H:i:s', strtotime('-2 minute')))->first();
        if ($order) {
            $functions = new functions;

            //$transfer_fee = getSetting('transfer_fee_'.$this->Crypto->name);

            if(!isset($order->wallet)){
                $functions->payment_order($order->id);
            }else{
                //درخواست از کیف پول
                $result_callback = $functions->payment_wallet_order($order->id);
                if($result_callback->status == true){
                    $fee = $this->price()->buy;
                    $amount = $order->amount;
                    //$dollar = round((($amount - ($transfer_fee * $fee)) / $fee) ,  $this->Crypto->percent);
                    $dollar = round(($amount / $fee) ,  $this->Crypto->percent);

                    $address = Session::get('destination');
                    $destination_tag = Session::get('destination_tag');
                    $result_callback = self::payment_success($dollar,$address,$amount,$fee,$order->id,$order->updated_at,$destination_tag);
                    return view('user.callback', ['result' => $result_callback]);

                }else
                    return view('user.callback', ['result' => $result_callback]);
            }
        } else
            return redirect()->route($this->Crypto->name);
    }


    function buy_payment_callback(Request $request)
    {
        $order = Orders::where('id', $request->route('id'))->where('id_user', Auth::user()->id)->
        where('type', 'buy')->whereNull('payment')->where('orders_model', $this->Crypto->name)->first();
        if ($order) {
            $functions = new functions;
            $result_callback = $functions->payment_order_callback($order->id, $request);
            if ($result_callback->status == true) {
                //$transfer_fee = getSetting('transfer_fee_'.$this->Crypto->name);

                $fee = $this->price()->buy;
                $amount = $order->amount;
                //$dollar = round((($amount - ($transfer_fee * $fee)) / $fee) ,  $this->Crypto->percent);
                $dollar = round(($amount / $fee) ,  $this->Crypto->percent);

                $address = Session::get('destination');
                $destination_tag = Session::get('destination_tag');
                $result_callback = self::payment_success($dollar, $address, $amount, $fee, $order->id, $order->updated_at, $destination_tag);

                return view('user.callback', ['result' => $result_callback]);
            } else {
                return view('user.callback', ['result' => $result_callback]);
            }
        } else
            return redirect()->route($this->Crypto->name);
    }

    protected function payment_success($dollar , $address ,$amount , $fee , $id_order ,$updated_at,$destination_tag){
        $functions = new functions;

        $default_exchanger = getSetting('default_exchanger');
        if(in_array($default_exchanger, ['binance', 'coinex'])){
            self::Trade($this->Crypto->symbol,$dollar);
        }
        self::balances();

        // Send Money
        if(!isset($destination_tag) || $destination_tag == '' || $this->Crypto->destination_tag != 1)
            $destination_tag = null;

        $network = null;
        if($this->Crypto->symbol == 'USDT'){
            if(preg_match('/^T/', $address)){
                $network = 'TRX';
            }else{
                $network = 'ETH';
            }
        }

        if($default_exchanger == 'binance'){
            $api_key = getSetting('binance_apikey');
            $api_secret = getSetting('binance_seckey');
            $api = new Binance\API($api_key, $api_secret);

            $response = $api->withdraw($this->Crypto->symbol, $address, $dollar,$destination_tag, '', false, $network);
            $status = isset($response['success']) && $response['success'] == true;
        }elseif($default_exchanger == 'coinex'){
            $url = "https://api.coinex.com/v1/balance/coin/withdraw";
            $params = array(
                "access_id" => getSetting('coinex_apikey'),
                "tonce" => round(microtime(true) * 1000),
                "actual_amount" => $dollar,
                "coin_type" => $this->Crypto->symbol,
                "coin_address" => $address,
                "transfer_method" => "onchain"
            );
            $sign = self::get_sign($params, getSetting('coinex_seckey'));
            $response = \json_decode(self::send_request_post($url, $params, $sign),true);
            $status = isset($response['message']) && $response['message'] == 'Success';
        }else{
            $status = true;
        }

        if ($status) {
            //$transfer_fee = getSetting('transfer_fee_'.$this->Crypto->name);
            $transfer_fee = self::withdrawFee($this->Crypto->symbol);

//            $order_fee = getSetting('sell_order_fee', 0)->value;
//            $amount = $request->coin * $fee;
//            $calc_order_fee = $amount * ( $order_fee / 100 );
//            $amount = $amount + $calc_order_fee;

            $Crypto = new OrdersCryptocurrency();
            $Crypto->amount_ir = $amount;
            $Crypto->coin = $this->Crypto->name;
            $Crypto->amount_coin = $dollar - $transfer_fee;
            $Crypto->fee = $fee;
            $Crypto->transfer_fee = $transfer_fee;
            $Crypto->transfer_fee_amount = $fee * $transfer_fee;
            $Crypto->type = 'buy';
            $Crypto->destination = $address;
            $Crypto->destination_tag = $destination_tag;
            $Crypto->id_order = $id_order;
            $Crypto->save();

            // بازاریابی و پورسانت
            $functions->CheckInvitation($id_order);

            $result_callback = (object)array();
            $result_callback->date = Jalali\CalendarUtils::strftime('d F Y  ساعت H:i', strtotime($updated_at));
            $result_callback->status = true;
            $result_callback->id_order = $id_order;
            $result_callback->message = 'پرداخت و انتقال '.$this->Crypto->name_fa .' با موفقیت انجام شد! ';


            $rowData = array();
            $rowData[0] = (object)array('name'=>'ارز معادل پرداختی' , 'value'=> $Crypto->amount_coin.$this->Crypto->symbol);
            $rowData[1] = (object)array('name'=>'مبلغ پرداختی' , 'value'=> number_format($amount));
            $result_callback->rowData = $rowData;
            // کاهش موجودی
            $stock_bitcoin = getSetting('stock_'.$this->Crypto->name);
            getSetting('stock_'.$this->Crypto->name, false)->update(['value'=> (float) $stock_bitcoin - $dollar]);
        } else {

            $date = Jalali\Jalalian::forge('today')->format('%d %B %Y');
            $data = array('date'=>$date, 'title'=>'خطا در انتتقال کریپتوکارنسی', 'body'=>$this->Crypto->symbol.''.json_encode($response));
            $email='info@heydari.co';
            if(isset($user->email)){
                \Mail::send('emails.notification', $data, function($message) use ($email)
                {$message->to($email, $email)->subject('اطلاعیه از طرف '.env('APP_NAME_FARSI'));});
            }

            $BackStock = $functions->payment_order_BackStock($id_order);
            if($BackStock->status == true)
                $result_callback = (object)array('status' => false, 'message' => "مبلغ از حساب شما کسر گردید اما سفارش با موفقیت انجام نشد و مبلغ به کیف پول شما واریز گشت و از قسمت سفارشات قابل پیگیری میباشد!");
            else
                $result_callback = (object)array('status' => false, 'message' => "مبلغ از حساب شما کسر گردید اما سفارش انجام نشد و لطفا با پشتیبانی در تماس باشید!");
            //return response()->json($CreateVouchers);
        }

        return $result_callback;
    }

    //sell
    function sellIndex()
    {
        $result = array();

        $default_exchanger = getSetting('default_exchanger');

        if(in_array($default_exchanger, ['binance', 'manual_binance'])){
            $api_key = getSetting('binance_apikey');
            $api_secret = getSetting('binance_seckey');
            $api = new \Binance\API($api_key, $api_secret);
            $address = $api->depositAddress($this->Crypto->symbol);


            $result['address_id'] = $address['address'] ?? 'تماس با پشتیبانی';
            $result['addressTag'] = $address['addressTag'] ?? null;
        }else{
            $url = "https://api.coinex.com/v1/balance/deposit/address/"  . $this->Crypto->symbol;
            $params = array(
                "access_id" => getSetting('coinex_apikey'),
                "tonce" => round(microtime(true) * 1000),
            );
            $sign = self::get_sign($params, getSetting('coinex_seckey'));
            $address = \json_decode(self::send_request($url, $params, $sign),true);
            $address = $address['data'];

            $result['address_id'] = $address['coin_address'] ?? 'تماس با پشتیبانی';
            $result['addressTag'] = $address['addressTag'] ?? null;
        }

        if($result['address_id'] != 'تماس با پشتیبانی'){
            $renderer = new \BaconQrCode\Renderer\ImageRenderer(
                new \BaconQrCode\Renderer\RendererStyle\RendererStyle(300),
                new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
            );
            $writer = new \BaconQrCode\Writer($renderer);
            $result['qr_image'] = $writer->writeString($result['address_id']);
//            $result['qr_image'] = 'data:image/svg;base64,'.$result['qr_image'];
        }

        $result['cardbank'] = \App\CardBank::where('id_user',Auth::user()->id)->where('confirm',1)->orderBy('updated_at','desc')->get();
        return view('user.cripto.sell',['result'=>(object)$result,'Crypto'=>$this->Crypto]);
    }

    function sell(Request $request)
    {
        $functions = new \App\functions;

        if (!isset($request->coin) || !isset($request->transaction_link)) {
            $result = array('status' => false, 'message' => "مقادیر نامعتبر است!");
            return response()->json($result);
        }

        $cardbank = \App\CardBank::where('id',$request->cardbank)->where('confirm',1)->first();
        if ($request->sell_method == 0 && !isset($cardbank)) {
            $result = array('status' => false, 'message' => "کارت بانکی خود را انتخاب کنید");
            return response()->json($result);
        }

        DB::beginTransaction();
        try {
            //Trade To USDT
            $trade = self::Trade($this->Crypto->symbol,$request->coin,'SELL');

            $fee = $this->price()->sell;

            $order_fee = getSetting('sell_order_fee', 0)->value;
            $amount = $request->coin * $fee;
            $calc_order_fee = $amount * ( $order_fee / 100 );
            $amount = $amount - $calc_order_fee;

            $order = new Orders;
            $order->id_user = Auth::user()->id;
            $order->amount = $amount;
            $order->sell_order_fee = $calc_order_fee;
            $order->description = $request->description;
            $order->type = 'sell';
            $order->orders_model = $this->Crypto->name;
            $order->status = 'در حال پردازش';
            $order->id_cardbank = $request->cardbank;
            $order->save();

            if ($request->sell_method == 1 ) {
                $order->wallet = $amount;
            }elseif ($request->sell_method == 2){
                $OtherBank = $functions->SaveCardOther($request,$order->id);
                $order->id_cardother = $OtherBank->id;
            }
            $order->save();


            $Crypto = new OrdersCryptocurrency();
            $Crypto->amount_ir = $amount;
            $Crypto->coin = $this->Crypto->name;
            $Crypto->amount_coin = $request->coin;
            $Crypto->fee = $fee;
            $Crypto->TxID = $request->transaction_link;
            $Crypto->type = 'sell';
            $Crypto->id_order = $order->id;
            $Crypto->save();

            DB::commit();
            $result = array('status' => true, 'message' => "", 'id' => $order->id);


        } catch (\Exception $e) {
            DB::rollback();
            $result = array('status' => false, 'message' => 'عملیات دچار مشکل شد'.$e);
        }
        return response()->json($result);
    }


    function sell_callback(Request $request)
    {
        $order = Orders::where('id',$request->route('id'))->where('id_user',Auth::user()->id)->where('type','sell')->
        where('created_at', '>', date('Y-m-d H:i:s', strtotime('-3 minute')))->first();

        if ($order) {
            $dollar = OrdersCryptocurrency::where('id_order',$order->id)->first()->amount_coin;
            $TxID = OrdersCryptocurrency::where('id_order',$order->id)->first()->TxID;

            $result = (object)array();
            $result->date = Jalali\CalendarUtils::strftime('d F Y  ساعت H:i', strtotime($order->created_at));
            $result->status = true;
            $result->sell = true;
            $result->wallet = $order->wallet;
            $result->amount = $order->amount;
            $result->color = 'warning';

            if(isset($order->wallet))
                $result->walletMessage = "سفارش شما با موفقیت ثبت شد و <b>در دست بررسی</b> میباشد و بعد از تایید و صحت تراکنش، مبلغ به کیف پول شما واریز میگردد.";
            elseif(isset($order->id_cardbank))
                $result->walletMessage = "سفارش شما با موفقیت ثبت شد و <b>در دست بررسی</b> میباشد و بعد از تایید و صحت تراکنش، مبلغ به حساب شما واریز میگردد.";
            else
                $result->walletMessage = "سفارش شما با موفقیت ثبت شد و <b>در دست بررسی</b> میباشد و بعد از تایید و صحت تراکنش، مبلغ به حسابی که معرفی مرده اید واریز میگردد.";

            $rowData = array();
            $rowData[0] = (object)array('name'=>'مقدار ارز' , 'value'=> $dollar);
            $rowData[1] = (object)array('name'=>'لینک تراکنش' , 'value'=> $TxID);
            $result->rowData = $rowData;

            return view('user.callback', ['result' => $result]);
        }else
            return redirect()->route($this->Crypto->name.'Sell');
    }



    public function price($coins = array())
    {
        $result = array();
        $result['buy'] = getSetting('USDT_price_buy');
        $result['sell'] = getSetting('USDT_price_sell');

        $default_exchanger = getSetting('default_exchanger');
        if(in_array($default_exchanger, ['binance', 'manual_binance'])){
            $api_key = getSetting('binance_apikey');
            $api_secret = getSetting('binance_seckey');
            $api = new Binance\API($api_key, $api_secret);

            if (!isset($coins) || count($coins) <= 0) {
                if ($this->Crypto->name != 'tether') {
                    $price = $api->price($this->Crypto->symbol . "USDT");
                    $result['buy'] = round($result['buy'] * $price);
                    $result['sell'] = round($result['sell'] * $price);
                }
                // All coin Price
            } else {
                $Cryptocurrency = Cryptocurrency::whereIn('symbol', $coins)->where('symbol', '!=', 'USDT')->get();
                $result['coins'] = array();
                foreach ($Cryptocurrency as $Crypto) {
                    if ($Crypto->name != 'tether') {
                        $array = (object)array();
                        $price = $api->price($Crypto->symbol . 'USDT');
                        $array->symbol = $Crypto->symbol;
                        $array->buy = round($result['buy'] * $price);
                        $array->sell = round($result['sell'] * $price);
                        array_push($result['coins'], $array);
                    }
                }
                //Tether
                $array = (object)array();
                $array->symbol = 'USDT';
                $array->buy = round($result['buy']);
                $array->sell = round($result['sell']);
                array_push($result['coins'], $array);

                unset($result['buy']);
                unset($result['sell']);
            }
        }else{
            if(!isset($coins) || count($coins) <=0) {
                if ($this->Crypto->name != 'tether') {
                    $avgPrice = file_get_contents('https://api.coinex.com/v1/market/ticker?market='. $this->Crypto->symbol .'USDT');
                    $price = \json_decode($avgPrice, true)['data']['ticker']['sell'];
                    $result['buy'] = round($result['buy'] * $price);
                    $result['sell'] = round($result['sell'] * $price);
                }
                // All coin Price
            }else {
                $Cryptocurrency = Cryptocurrency::whereIn('symbol', $coins)->where('symbol','!=','USDT')->get();
                $result['coins'] = array();
                foreach ($Cryptocurrency as $Crypto) {
                    if ($Crypto->name != 'tether') {
                        $array = (object)array();
                        $avgPrice = file_get_contents('https://api.coinex.com/v1/market/ticker?market='. $Crypto->symbol .'USDT');
                        $price = \json_decode($avgPrice, true)['data']['ticker']['sell'];
    //                    $price = $api->price($Crypto->symbol . 'USDT');
                        $array->symbol = $Crypto->symbol;
                        $array->buy = round($result['buy'] * $price);
                        $array->sell = round($result['sell'] * $price);
                        array_push($result['coins'], $array);
                    }
                }

                //Tether
                $array = (object)array();
                $array->symbol = 'USDT';
                $array->buy = round($result['buy']);
                $array->sell = round($result['sell']);
                array_push($result['coins'],$array);

                unset($result['buy']);
                unset($result['sell']);
            }
        }

        return (object)$result;
    }


    function balances(){
        $default_exchanger = getSetting('default_exchanger');
        if(in_array($default_exchanger, ['binance', 'manual_binance'])){
            $api_key = getSetting('binance_apikey');
            $api_secret = getSetting('binance_seckey');
            $apiBinance = new \Binance\API($api_key, $api_secret);
            $balances = $apiBinance->balances();
            $stockTheter = $balances['USDT']['available'];

            //return response()->json($balances['BTC']['available']);
            $Cryptocurrency = Cryptocurrency::all();
            $result = array();
            foreach ($Cryptocurrency as $Crypto) {
                $array = (object)array();
                $array->symbol = $Crypto->symbol;
                $api = getSetting('stock_' . $Crypto->name . '_api');
                if ($api == 'off')
                    $array->stock = getSetting('stock_' . $Crypto->name);
                else {
                    //$array->stock = round($balances[$Crypto->symbol]['available'] , 4);
                    if ($Crypto->symbol != 'USDT')
                        $stock = $stockTheter / $apiBinance->price($Crypto->symbol . 'USDT');
                    else
                        $stock = $stockTheter;

                    if ($Crypto->symbol == 'USDT' || $Crypto->symbol == 'XRP')
                        $array->stock = round($stock);
                    else
                        $array->stock = round($stock, $Crypto->percent);


                    if ($Crypto->symbol == 'BTC')
                        $array->stock = round($stock, 4);

                    if ($Crypto->symbol == 'ETH')
                        $array->stock = round($stock, 3);

                }
                array_push($result, $array);
            }
        }else{
            $url = "https://api.coinex.com/v1/balance/info";
            $params = array(
                "access_id" => getSetting('coinex_apikey'),
                "tonce" => round(microtime(true) * 1000),
            );
            $sign = self::get_sign($params, getSetting('coinex_seckey'));
            $balances = \json_decode(self::send_request($url, $params, $sign),true);

            $stockTheter = $balances['data']['USDT']['available'];

            $Cryptocurrency = Cryptocurrency::all();
            $result = array();
            foreach ($Cryptocurrency as $Crypto) {
                $array = (object)array();
                $array->symbol = $Crypto->symbol;
                $api = Settings::where('name','stock_'.$Crypto->name.'_api')->first()->value;
                if($api == 'off')
                    $array->stock = Settings::where('name','stock_'.$Crypto->name)->first()->value;
                else{
                    //$array->stock = round($balances[$Crypto->symbol]['available'] , 4);
                    if($Crypto->symbol != 'USDT'){
                        $avgPrice = file_get_contents('https://api.coinex.com/v1/market/ticker?market='. $Crypto->symbol .'USDT');
                        $avgPrice = \json_decode($avgPrice, true)['data']['ticker']['sell'];
                        $stock = $stockTheter / $avgPrice;
                    }else
                        $stock = $stockTheter;

                    if ($Crypto->symbol == 'USDT' || $Crypto->symbol == 'XRP' )
                        $array->stock = round($stock);
                    else
                        $array->stock = round($stock, $Crypto->percent);


                    if ($Crypto->symbol == 'BTC')
                        $array->stock = round($stock,4);

                    if ($Crypto->symbol == 'ETH')
                        $array->stock = round($stock,3);

                }
                array_push($result,$array);
            }
        }

        return (object)$result;
    }



    function MinBuyForTrade(){
        if($this->Crypto->symbol != 'USDT'){
            $default_exchanger = getSetting('default_exchanger');
            if(in_array($default_exchanger, ['binance', 'manual_binance'])){
                $api_key = getSetting('binance_apikey');
                $api_secret = getSetting('binance_seckey');
                $api = new \Binance\API($api_key, $api_secret);

                $avgPrice = file_get_contents('https://api.binance.com/api/v3/avgPrice?symbol=' . $this->Crypto->symbol . 'USDT');
                $avgPrice = json_decode($avgPrice)->price;

                $exchangeInfo = $api->exchangeInfo($this->Crypto->symbol . 'USDT');
                $min = $exchangeInfo['symbols'][$this->Crypto->symbol . 'USDT']['filters'][3]['minNotional'];
                $min = round($min / $avgPrice, $this->Crypto->percent, PHP_ROUND_HALF_UP);
            }else{
                $market_info = file_get_contents('https://api.coinex.com/v1/market/detail?market='.$this->Crypto->symbol.'USDT');
                $min = \json_decode($market_info, true)['data']['min_amount'];
            }

            if($this->Crypto->min_buy < $min)
                return $min;
            else
                return $this->Crypto->min_buy;
        }else
            return $this->Crypto->min_buy;

    }

    protected function Trade($symbol,$coin,$model = 'BUY'){
        $default_exchanger = getSetting('default_exchanger');
        if($default_exchanger == 'binance') {
            $api_key = getSetting('binance_apikey');
            $api_secret = getSetting('binance_seckey');
            $api = new \Binance\API($api_key, $api_secret);

            if ($symbol != 'USDT'):
                //LOT_SIZE Error
                $LOT_SIZE = $api->exchangeInfo($this->Crypto->symbol . 'USDT');
                $LOT_SIZE = $LOT_SIZE['symbols'][$this->Crypto->symbol . 'USDT']['filters'][2]['minQty'];
                $LOT_SIZE = (explode('1', $LOT_SIZE));
                $LOT_SIZE = strlen(substr(strrchr($LOT_SIZE[0], "."), 1)) + 1;

                if ($model == 'Buy')
                    $coin = $coin + ($coin * 0.002); //کارمزد ترید
                $coin = round($coin, $LOT_SIZE);
            endif;

            $balances = $api->balances();
            $stock = $balances[$symbol]['available'];
            if ($stock < $coin || $model == 'SELL'):

                if ($symbol != 'USDT') {
                    if ($model == 'BUY')
                        $result = $api->marketBuy($symbol . 'USDT', $coin);
                    else
                        $result = $api->marketSell($symbol . 'USDT', $coin);

                    self::balances();
                    //$result = $api->order($model,$symbol.'USDT',$coin,0,"MARKET",[]);
                    if (isset($result['symbol']) && $result['symbol'] == $symbol . 'USDT')
                        return true;
                    else
                        return false;//dd($result);

                } else
                    return true;
            else:
                return true;
            endif;
        }else{
            $model = strtoupper($model);

            $coin_rate = 1;
            if($symbol != 'USDT'):
                $market_info = file_get_contents('https://api.coinex.com/v1/market/ticker?market='.$this->Crypto->symbol.'USDT');
                $market_info = \json_decode($market_info, true)['data']['ticker'];
                $coin_rate = $market_info['sell'];
            endif;


            $url = "https://api.coinex.com/v1/balance/info";
            $params = array(
                "access_id" => getSetting('coinex_apikey'),
                "tonce" => round(microtime(true) * 1000),
            );
            $sign = self::get_sign($params, getSetting('coinex_seckey'));
            $balances = \json_decode(self::send_request($url, $params, $sign),true);

            if(isset($balances['data'][$this->Crypto->symbol])){
                $stock = $balances['data'][$this->Crypto->symbol]['available'];
            }else{
                $stock = 0;
            }

            if($stock < $coin || $model == 'SELL'):
                if($symbol != 'USDT'){
                    if($model == 'BUY')
                        $type = 'buy';
                    else
                        $type = 'sell';

                    $fee = self::withdrawFee($this->Crypto->symbol);

                    $url = "https://api.coinex.com/v1/order/market";
                    $params = array(
                        "access_id" => getSetting('coinex_apikey'),
                        "tonce" => round(microtime(true) * 1000),
                        "type" => $type,
                        "market" => $this->Crypto->symbol.'USDT',
                        "amount" => sprintf('%0.6f', ($coin + $fee) * $coin_rate)
                    );

                    $sign = self::get_sign($params, getSetting('coinex_seckey'));
                    $result = \json_decode(self::send_request_post($url, $params, $sign),true);
                    if (isset($result['market']) && $result['market'] == $symbol.'USDT')
                        return true;
                    else
                        return false;
                }else
                    return true;
            else:
                return true;
            endif;
        }
    }

    public function withdrawFee($coinSymbol,$coinName = null){
        $coinName = isset($coinName) ? $coinName : $this->Crypto->name;
        $transfer_fee = getSetting('transfer_fee_'.$coinName);
        if ($transfer_fee != '' && isset($transfer_fee)){
            return $transfer_fee;
        }

        $default_exchanger = getSetting('default_exchanger');

        if(in_array($default_exchanger, ['binance', 'manual_binance'])){
            $api_key = getSetting('binance_apikey');
            $api_secret = getSetting('binance_seckey');
            $apiBinance = new \Binance\API($api_key, $api_secret);
            $withdrawFee = $apiBinance->withdrawFee($coinSymbol);
            return (string)$withdrawFee['withdrawFee'];
        }else{
            $fees = file_get_contents('https://api.coinex.com/v1/common/asset/config?coin_type=' . strtoupper($coinSymbol));
            $fees = \json_decode($fees, true);
            $fee = 0.0;
            foreach ($fees['data'] as $item){
                if($item['withdraw_tx_fee'] > $fee){
                    $fee = $item['withdraw_tx_fee'];
                }
            }

            return (string)$fee;
        }
    }

    static function get_sign($params, $secret_key){
        ksort($params);
        $pre_sign_ls = array();
        foreach ($params as $key => $val){
            array_push($pre_sign_ls, "$key=$val");
        }
        array_push($pre_sign_ls, "secret_key=$secret_key");
        $pre_sign_str =  join("&", $pre_sign_ls);
        return strtoupper(md5($pre_sign_str));
    }

    static function send_request($url, $params, $sign){
        $query = http_build_query($params);
        $url = "$url?$query";
        $headers = [
            'authorization:'. $sign,
        ];
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }

    static function send_request_post($url, $params, $sign){
        $headers = [
            'authorization:' . $sign,
            'Content-type: application/json'
        ];
        $params = json_encode($params);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
        return curl_exec($ch);
    }

    function getFee()
    {
        $result = array();

        $default_exchanger = getSetting('default_exchanger');
        $symbol = strtoupper($this->Crypto->symbol);
        if(in_array($default_exchanger, ['binance', 'manual_binance'])){
            $api_key = getSetting('binance_apikey');
            $api_secret = getSetting('binance_seckey');
            $api = new \Binance\API($api_key, $api_secret);
            $fee = $api->coins();
            $coin = collect($fee)->filter(function($q) use($symbol) {
                    return $q['coin'] == $symbol;
                })
                ->first();

            $networks = [];
            if(isset($coin) && isset($coin['networkList'])){
                $i = 0;
                foreach($coin['networkList'] as $network){
                    $networks[$i] = [];
                    $networks[$i]['fee'] = $network['withdrawFee'];
                    $networks[$i]['network'] = $network['network'];
                    $i++;
                }
            }

            return $networks;
        }else{
            $url = "https://api.coinex.com/v1/common/asset/config";
            $params = array(
                "access_id" => getSetting('coinex_apikey'),
                "tonce" => round(microtime(true) * 1000),
            );
            $sign = self::get_sign($params, getSetting('coinex_seckey'));
            $assets = \json_decode(self::send_request($url, $params, $sign),true);

            $coin = collect($assets['data'])->filter(function($q, $key) use($symbol) {
                return preg_match('/' . $symbol . '\-/', $key);
            });

            $networks = [];
            if(isset($coin)){
                $i = 0;
                foreach($coin as $network){
                    $networks[$i] = [];
                    $networks[$i]['fee'] = $network['withdraw_tx_fee'];
                    $networks[$i]['network'] = $network['chain'];
                    $i++;
                }
            }

            return $networks;
        }

    }

}
