<?php

namespace Modules\Staff\Customer\Http\Controllers;

use App\Models\Media;
use App\Models\State;
use App\Models\StoreAddress;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\Customers\Panel\Models\CustomerLegal;
use Modules\Staff\Category\Models\Category;
use Modules\Customers\Auth\Models\Customer;
use Modules\Staff\Customer\Models\CustomerAddress;

class StaffCustomerController extends Controller
{

    public function index() {
        $customers = Customer::paginate(10);

        return view('staffcustomer::index', compact('customers'));
    }

    public function profile($id) {
        $customer = Customer::findOrFail($id);
        $customers = Customer::all();
        $states = State::all();
        $store_addresses = StoreAddress::all();

        return view('staffcustomer::profile',
        compact('customer', 'states', 'store_addresses', 'customers'));
    }

    public function update(Request $request)
    {
        if ($request->active_tab == 'general') {
          return $this->updateGeneral($request);
        }
        if ($request->active_tab == 'addresses') {
          return $this->updateAddresses($request);
        }
    }

    public function updateGeneral($request)
    {

        $messages = [
          'email.required_if' => 'وارد کردن فیلد ایمیل یا شماره موبایل اجباری است.',

          'company_name.required_if' => 'در وضعیت انتخابی وارد کردن نام سازمان اجباری است.',
          'economic_number.required_if' => 'در وضعیت انتخابی وارد کردن کد اقتصادی اجباری است.',
          'registration_number.required_if' => 'در وضعیت انتخابی وارد کردن شناسه ثبت اجباری است.',
          'nationalـidentity.required_if' => 'در وضعیت انتخابی وارد کردن شناسه ملی اجباری است.',
          'phone.required_if' => 'در وضعیت انتخابی وارد کردن شماره تلفن سازمان اجباری است.',
          'city.required_if' => 'در وضعیت انتخابی وارد کردن شهر محل دفتر مرکزی اجباری است.',
          'economic_number.integer' => 'مقدار فیلد کد اقتصادی باید عددی باشد',
          'registration_number.integer' => 'مقدار فیلد کد ثبت باید عددی باشد',
          'nationalـidentity.integer' => 'مقدار فیلد کد شناسه ملی باید عددی باشد',
        ];

        $validator = Validator::make($request->all(), [
          'status' => 'required',
          'email' => "nullable|required_if:mobile,null",
          'has_legal_info' => 'required',
          'company_name' => 'nullable|required_if:has_legal_info,active',
          'economic_number' => 'nullable|integer|required_if:has_legal_info,active',
          'registration_number' => 'nullable|integer|required_if:has_legal_info,active',
          'nationalـidentity' => 'nullable|integer|required_if:has_legal_info,active',
          'city' => 'nullable|required_if:has_legal_info,active',
          'phone' => 'nullable|required_if:has_legal_info,active',
        ], $messages);


      if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
              'status' => false,
              'data' => [
                'errors' => $errors,
              ]
            ], 400);
        }

      $customer = Customer::find($request->customer_id);

      $customer->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'birthdate' => date_create($request->birthdate),
        'national_code' => $request->national_code,
        'mobile' => $request->mobile,
        'email' => $request->email,
        'status' => $request->status,
        'bank_card_number' => $request->bank_card_number,
      ]);

      if ($request->has_legal_info == 'active') {
          CustomerLegal::updateOrCreate(['customer_id' => $request->customer_id],[
            'company_name' => $request->company_name,
            'economic_number' => $request->economic_number,
            'registration_number' => $request->registration_number,
            'nationalـidentity' => $request->nationalـidentity,
            'phone' => $request->phone,
            'city_id' => $request->city,
          ]);
      }
      else {
        if ($customer->legal()->exists()) {
          $customer->legal->delete();
        }
      }
    }

    public function updateAddresses($request)
    {

      if (filled($request->address_district_refrence)) {
        foreach ($request->address_district_refrence as $k => $i) {
          $address_district[$i] = $request->address_district_id[$k];
        }
      }

      foreach ($request->address_id as $key => $id)
      {

          if (filled($address_district[$id])) {
            $state_id = $address_district[$id];
          }
          else {
            $state_id = intval($request->address_city_id[$key]);
          }

          CustomerAddress::find($id)->update([
            'address' => $request->address[$key],
            'plaque' => $request->plaque[$key],
            'unit' => $request->unit[$key],
            'postal_code' => $request->postal_code[$key],
            'recipient_firstname' => $request->recipient_firstname[$key],
            'recipient_lastname' => $request->recipient_lastname[$key],
            'recipient_national_code' => $request->recipient_national_code[$key],
            'recipient_mobile' => $request->recipient_mobile[$key],
            'is_recipient_self' => $request->recipient_status,
            'state_id' => $state_id,
          ]);
      }
    }

    public function remove($id)
    {
      Customer::findOrFail($id)->delete();

      return response()->json([
        'status' => true,
        'data' => true,
      ]);
    }

    public function search(Request $request, Customer $customers)
    {
      $request->paginatorNum = $request->paginatorNum ?? 10;
      $customers = $this->Customerfilter($request, $customers);

      return view('staffcustomer::searchResult', compact('customers'));
    }

    public function Customerfilter($request, $customers)
    {
      $customers = $customers->newQuery();

      if (!is_null($request->title)) {
        $request->title = ltrim($request->title, 0);
        $customers->where("first_name", "LIKE", "%{$request->title}%");
        $customers->orWhere("last_name", "LIKE", "%{$request->title}%");
        $customers->orWhere("mobile", "LIKE", "%{$request->title}%");
        $customers->orWhere("email", "LIKE", "%{$request->title}%");
      }

      if (!is_null($request->status)) {
        if ($request->status == 'active') {
          $customers->where('status', 'active');
        }

        if ($request->status == 'inactive') {
          $customers->where('status', 'inactive');
        }
      }

      return $customers->paginate($request->paginatorNum);
  }

    public function cities(Request $request)
    {
      $cities = State::where('state_id', $request->state_id)
        ->where('type', 'city')->get();
      $type = $request->type;

      return view('staffcustomer::layouts.ajax.citySelect',
       compact('cities', 'type'));
    }

    public function district(Request $request)
    {
      $districts = State::where('state_id', $request->city_id)
        ->where('type', 'district')->get();
      $type = $request->type;

      return view('staffcustomer::layouts.ajax.districtSelect',
       compact('districts', 'type'));
    }
}
