<?php

namespace Modules\Customers\Panel\Http\Controllers;

use App\Models\State;
use App\Models\VerifyAccount;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Customers\Front\Http\Controllers\FrontController;
//use Modules\Customers\Panel\Models\Customer;
use Modules\Customers\Panel\Models\CustomerLegal;
use Modules\Staff\Order\Http\Controllers\StaffOrderController;
use Modules\Staff\Order\Models\Order;
use Modules\Staff\Peyment\Models\PeymentRecord;
use Modules\Staff\Shiping\Models\OrderStatus;
use Modules\Customers\Auth\Models\Customer;


class CustomerProfileController extends Controller
{

  protected $frontController;
  public function __construct(FrontController $frontController, StaffOrderController $staffOrderController)
  {
    $this->frontController = $frontController;
    $this->staffOrderController = $staffOrderController;
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index()
  {
    $customer = Auth::guard('customer')->user();
    $this->updateAwaitingPaymentStatus($customer);

    return view('customerpanel::profile.index', compact('customer'));
  }

  public function updateAwaitingPaymentStatus($customer)
  {
    if (Auth::guard('customer')->check() && $customer->orders()->where('order_status_id', OrderStatus::awaiting()->first()->id)->exists()) {
      foreach ($customer->orders()->where('order_status_id', OrderStatus::where('en_name', 'awaiting_payment')->first()->id)->get() as $order) {
        if (Carbon::make($order->created_at)->addHour() < Carbon::now() && PeymentRecord::where('order_id', $order->id)->successfulPeyment()->doesntExist())
        {
          $this->frontController->updateStatusAfterUnsuccessfulPayment($order);
        }
      }
    }
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function personalInfo()
  {
    $customer = Auth::guard('customer')->user();
    $states = State::all();

    is_null($states)? $states = [] : '';

    if (!is_null($customer->birthdate)) {
      $date = date_create($customer->birthdate);
      $date = gregorian_to_jalali($date->format('Y'),$date->format('m'),$date->format('d'));
    } else {
        $date = [];
    }
    return view('customerpanel::profile.personalInfo', compact('customer', 'date', 'states'));
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
//  public function orders()
//  {
//    $customer = Auth::guard('customer')->user();
//    return view('customerpanel::profile.favorites', compact('customer'));
//  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function personalInfoUpdate(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        if(isset($request->additionalinfo['first_name'])) {
          $validator = Validator::make($request->all(), [
            "*.first_name" => "required",
            "*.last_name" => "required",
          ]);
        }

        if(isset($request->additionalinfo['mobile_phone'])) {
            $validator = Validator::make($request->all(), [
              '*.mobile_phone' => 'required|unique:customers,mobile',
            ]);
        }

        if(isset($request->additionalinfo['email'])) {
            $validator = Validator::make($request->all(), [
              '*.email' => 'required',
            ]);
        }

        if(isset($request->additionalinfo['company_name'])) {
            $validator = Validator::make($request->all(), [
                '*.company_name' => 'required',
                '*.company_economic_number' => 'required',
                '*.company_national_identity_number' => 'required',
                '*.company_registration_number' => 'required',
                '*.company_state_id' => 'required',
                '*.company_city_id' => 'required',
                '*.company_phone' => 'required',
            ]);
        }

        if (isset($request->additionalinfo['national_identity_number'])) {
           $validator = Validator::make($request->all(), [
            '*.national_identity_number' => 'required|integer',
          ]);
        }

        if (isset($request->additionalinfo['is_wallet_preferred_for_refund'])) {
          $validator = Validator::make($request->all(), [
            '*.is_wallet_preferred_for_refund' => 'required',
          ]);
        }

        if (isset($request->additionalinfo['birth_year']) || isset($request->additionalinfo['birth_month']) || isset($request->additionalinfo['birth_day'])) {
             $validator = Validator::make($request->all(), [
                '*.birth_year' => 'required|integer',
                '*.birth_month' => 'required|integer',
                '*.birth_day' => 'required|integer',
            ]);
        }


        if ($validator->fails()) {
          $errors = $validator->errors();
          return response()->json([
            'status' => false,
            'data' => [
              'errors' => $errors,
            ]
          ]);
        }

        if(isset($request->additionalinfo['first_name'])) {
            Customer::find($customer->id)->update([
              'first_name' => $request->additionalinfo['first_name'],
              'last_name' => $request->additionalinfo['last_name'],
            ]);
        }

        if(isset($request->additionalinfo['mobile_phone'])) {
            $mobile_phone = ltrim($request->additionalinfo['mobile_phone'], 0);

            VerifyAccount::updateOrCreate(['mobile' => $mobile_phone],
                ['account_type' => 'customer',
                  'token' => rand(10000, 99999),
                ]);

            return response()->json([
                  'status' => true,
                  'data' => [
                      'phone' => false,
                      'email' => true,
                      'phoneCodeTtl' => 180,
                      'cryptFields' => '<input type="hidden" name="rc" value="' . $mobile_phone . '"/><input type="hidden" name="rd" value="ditJczZRVDFBQlQ2Qmc0V3B0RUZvdmYweTQ4aUpqUC9BUEo5K1lvcU9JajBidDk1MG40QkE1SnBXdFhVUjE2QXI2K2hMOWtGeUxpamxqZWFEWi8zbUE9PQ~~"/>',
                  ],
            ]);

        }

        if(isset($request->additionalinfo['national_identity_number'])) {
            Customer::find($customer->id)->update([
              'national_code' => $request->additionalinfo['national_identity_number'],
            ]);
        }

        if(isset($request->additionalinfo['email'])) {
            Customer::find($customer->id)->update([
              'email' => $request->additionalinfo['email'],
            ]);
        }

        if(isset($request->additionalinfo['is_wallet_preferred_for_refund'])) {
          Customer::find($customer->id)->update([
            'return_money_method' => 'wallet',
          ]);
        }

        if (isset($request->additionalinfo['birth_year'])) {
            $date = jalali_to_gregorian($request->additionalinfo['birth_year'], $request->additionalinfo['birth_month'], $request->additionalinfo['birth_day'], '-');
            $date = date_create($date);
            Customer::find($customer->id)->update([
              'birthdate' => $date,
            ]);
        }

        if(isset($request->additionalinfo['company_name'])) {
            CustomerLegal::create([
              'company_name' => $request->additionalinfo['company_name'],
              'economic_number' => $request->additionalinfo['company_economic_number'],
              'nationalـidentity' => $request->additionalinfo['company_national_identity_number'],
              'registration_number' => $request->additionalinfo['company_registration_number'],
              'phone' => $request->additionalinfo['company_phone'],
              'city_id' => $request->additionalinfo['company_city_id'],
              'customer_id' => $customer->id,
            ]);
        }

        return response()->json([
          'status' => true,
          'data' => true,
        ]);

    }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function ChangePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            '*.password_old' => 'required|integer',
            '*.password' => 'required|integer',
            '*.password2' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
              'status' => false,
            ]);
        }

        $customer = Auth::guard('customer')->user();

        if (!Hash::check($request->changepassword['password_old'], $customer->password))
        {
            return response()->json([
              'status' => false,
              'data' => [
                'errors' => [
                  'password_old' => 'رمز عبور فعلی را درست وارد نمایید'
                ]
              ]
            ]);
        }
        elseif ($request->changepassword['password'] == $request->changepassword['password2']) {
            Customer::find($customer->id)->update([
                'password' => Hash::make($request->changepassword['password']),
            ]);

            return response()->json([
              'status' => true,
              'data' => true,
            ]);
        }
        else {
            return response()->json([
              'status' => false,
            ]);
        }
    }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function confirmPhone(Request $request)
    {
        $mobile = VerifyAccount::where('mobile', $request->rc)->first();
        $token = VerifyAccount::where('mobile', $request->rc)->first()->token;

        if($mobile->created_at->addMinutes(3) < now())
        {
            if(enNum($request->confirm['code']) == $token ) {
                $customer = Auth::guard('customer')->user();

                Customer::find($customer->id)->update([
                  'mobile' => $request->rc,
                ]);

                return response()->json([
                  'status' => true,
                  'data' => true,
                ]);

            } else {
                return response()->json([
                  'status' => false,
                  'data' => [
                    'errors' => [
                      'code' => 'کد وارد شده اشتباه است',
                    ]
                  ]
                ]);
            }
        } else {
            return response()->json([
              'status' => false,
              'data' => [
                'errors' => [
                  'code' => 'کد ارسالی منقضی شذه است',
                ]
              ]
            ]);
        }

    }

  /**
   * @param Request $request
   */
  public function sendConfirmCode(Request $request)
    {
        $mobile_phone = ltrim($request->rc, 0);

        VerifyAccount::updateOrCreate(['mobile' => $mobile_phone],
          ['account_type' => 'customer',
            'token' => rand(10000, 99999),
          ]);
    }

  /**
   * @return \Illuminate\Http\JsonResponse
   */
  public function wallet()
    {
        return response()->json([
          'status' => true,
          'data' => [
            'amount' => null,
            'activationUrl' => '',
          ]
        ]);
    }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function cardToIban(Request $request)
    {

      $customer = Auth::guard('customer')->user();
      Customer::find($customer->id)->update([
          'return_money_method' => 'bank_card',
          'bank_card_number' => $request->card_number,
      ]);

      return response()->json([
        'status' => true,
        'data' => true,
      ]);

    }

  /**
   * @param $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function cityLoader($id)
    {

        $cities = State::where('parent_id', $id)->get();

        foreach ($cities as $city) {
          $cityArray[] = ['id' => $city->id, 'name' => $city->name, 'state_id' => $city->state_id];
        }

        return response()->json([
            'status' => true,
            'data' =>
              $cityArray,
        ]);
    }

  /**
   * @param $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function districtLoader($id)
    {
        $districts = State::where('parent_id', $id)->get();

        foreach ($districts as $district) {
            $districtArray[] = ['id' => $district->id, 'name' => $district->name, 'city_id' => $district->state_id];
        }

        return response()->json([
          'status' => true,
          'data' =>
            $districtArray,
        ]);
    }

  /**
   * @param $id
   */
  public function test($id)
    {
      $cities = State::where('parent_id', $id)->get();


      foreach ($cities as $city) {

        $citys[] = [
          'id' => $city->id,
          'name' => $city->name,
          'state_id' => $city->state_id
        ];
      }

      dd($citys);


    }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function userHistory()
    {
      $customer = Auth::guard('customer')->user();
      return view('customerpanel::profile.userHistory', compact('customer'));
    }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function notification()
    {
      $customer = Auth::guard('customer')->user();
      return view('customerpanel::profile.notification', compact('customer'));
    }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function giftcards()
    {
      $customer = Auth::guard('customer')->user();
      return view('customerpanel::profile.giftcards', compact('customer'));
    }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function addresses()
  {
    $customer = Auth::guard('customer')->user();
    $states = State::all();
    return view('customerpanel::profile.addresses', compact('customer', 'states'));
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function comments()
    {
      $customer = auth()->guard('customer')->user();
      $sold_status_id = OrderStatus::where('en_name', 'sold')->first()->id;
      $returned_status_id = OrderStatus::where('en_name', 'returned')->first()->id;

      return view('customerpanel::profile.comments',
          compact('customer', 'sold_status_id', 'returned_status_id'));
    }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function favorites()
  {
    $customer = Auth::guard('customer')->user();
    return view('customerpanel::profile.favorites', compact('customer'));
  }

  /**
   * customer orders page
   *
   * @param null $activeTab
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function myOrders($activeTab = null)
  {

    $customer = Auth::guard('customer')->user();


    $this->updateAwaitingPaymentStatus($customer);

//    if ($customer->orders()->where('order_status_id', OrderStatus::where('en_name', 'awaiting_payment')->first()->id)->exists()) {
//      foreach ($customer->orders()->where('order_status_id', OrderStatus::where('en_name', 'awaiting_payment')->first()->id)->get() as $order) {
//        // اگه یه ساعت از ایجاد سفارش گذشته بود و پرداخت موفق از بخش روش پرداخت نداشت
//        if (Carbon::make($order->created_at)->addHour() < Carbon::now() && PeymentRecord::where('order_id', $order->id)->successfulPeyment()->doesntExist())
//        {
//          // تغییر وضعیت بعد از پرداخت ناموفق
//          $this->frontController->updateStatusAfterUnsuccessfulPayment($order);
//        }
//      }
//    }

    switch ($activeTab) {
      case "wait-for-payment":
        $orders = Order::where('order_status_id', OrderStatus::where('en_name', 'awaiting_payment')->first()->id)->get();
        $activeTab = "wait-for-payment";
        break;
      case "paid-in-progress":
        $orders = Order::where('order_status_id', OrderStatus::where('en_name', 'processing')->first()->id)->get();
        $activeTab = "paid-in-progress";
        break;
      case "delivered":
        $orders = Order::where('order_status_id', OrderStatus::where('en_name', 'delivered')->first()->id)->get();
        $activeTab = "delivered";
        break;
      case "returned":
        $orders = Order::where('order_status_id', OrderStatus::where('en_name', 'returned')->first()->id)->get();
        $activeTab = "returned";
        break;
      case "canceled":
        $orders = Order::where('order_status_id', OrderStatus::where('en_name', 'canceled')->first()->id)->get();
        $activeTab = "canceled";
        break;
      default:
        $orders = Order::where('order_status_id', OrderStatus::where('en_name', 'awaiting_payment')->first()->id)->get();
        $activeTab = "wait-for-payment";
    }

    return view('customerpanel::profile.myOrders', compact('customer', 'orders', 'activeTab'));

  }

  /**
   * order invoice
   *
   * @param $order_code
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function orderInvoice($order_code)
  {
    if (Order::where('order_code', $order_code)->doesntExist()) {
        abort(404);
    }

    $order_id = Order::where('order_code', $order_code)->first()->id;
    return $this->staffOrderController->invoice($order_id);
  }

  public function orderDetails($order_code)
  {

    if (Order::where('order_code', $order_code)->doesntExist()) {
      abort(404);
    }

    $order = Order::where('order_code', $order_code)->first();
    $customer = Auth::guard('customer')->user();

    return view('customerpanel::profile.orderDetails', compact('order', 'customer'));

  }

  public function orderCheckout($order_code)
  {
    return $this->frontController->orderStatus($order_code);
  }



}
