<?php

namespace Modules\Staff\Peyment\Http\Controllers;

use Modules\Staff\Setting\Models\Setting;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\Staff\Product\Models\ProductWeight;
use Modules\Staff\Peyment\Models\PeymentCostDetType;
use Modules\Staff\Peyment\Models\PeymentMethodGroup;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Peyment\Models\PeymentMethod;
use Modules\Staff\Peyment\Models\PeymentMethodLocation;
use App\Models\Media;
use Illuminate\Support\Facades\View;
use Modules\Staff\Peyment\Models\PeymentMethodValue;

class StaffPeymentMethodController extends Controller
{
    public function index()
    {
      $peyment_methods = PeymentMethod::orderBy('status')->paginate(100);
      return view('staffpeyment::peymentMethod.index', compact('peyment_methods'));
    }

    public function edit($en_name)
    {
      $peyment_method = PeymentMethod::where('en_name', $en_name)->first();
      return view('staffpeyment::peymentMethod.edit', compact('peyment_method'));
    }

    public function storePeymentMethod(Request $request)
    {

        $messages = [
          'name.required' => 'وارد کردن فیلد عنوان اجباری است',
          'description.required' => 'وارد کردن فیلد توضیحات اجباری است',

          'iv.required_if' => 'وارد کردن فیلد شناسه پیکربندی اجباری است',
          'key.required_if' => 'وارد کردن فیلد کلید رمزنگاری اجباری است',
          'username.required_if' => 'وارد کردن فیلد نام کاربری اجباری است',
          'password.required_if' => 'وارد کردن فیلد کلمه عبور اجباری است',
          'terminalId.required_if' => 'وارد کردن فیلد ترمینال آیدی اجباری است',
          'merchantId.required_if' => 'وارد کردن فیلد مرچنت کد اجباری است',
        ];

        $validator = Validator::make($request->all(),[
          'en_name' => 'required',
          'name' => 'required',
          'status' => 'required',
          'description' => 'required',

          'iv' => 'required_if:en_name,asanpardakht',
          'key' => 'required_if:en_name,asanpardakht,irankish,sadad',
          'username' => 'required_if:en_name,behpardakht,asanpardakht',
          'password' => 'required_if:en_name,behpardakht,asanpardakht',
          'terminalId' => 'required_if:en_name,behpardakht,sepehr',
          'certificate' => 'nullable', //pasargad
          'merchantId' => 'required_if:en_name,asanpardakht,idpay,irankish,nextpay,parsian,pasargad,payir,payping,paystar,poolam,sadad,saman,yekpay,zarinpal,zibal',
          'zarin_gate_status' => 'required_if:en_name,zarinpal',
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

      $peymentMethod = PeymentMethod::where('en_name', $request->en_name)->first();

      if ($request->status == 'active' && PeymentMethod::where('status', 'active')->count() >= 3
         && $peymentMethod->status !== 'active') {
          return response()->json([
            'status' => false,
            'data' => [
              'errors' => [
                'status' => 'امکان فعال کردن بیشتر از ۳ درگاه همزمان ممکن نیست. لطفا وضعیت را به غیرفعال تغییر دهید',
              ],
            ]
          ], 400);
        }


        $peymentMethod->update([
          'name' => $request->name,
          'status' => $request->status,
          'description' => $request->description,

          'iv' => isset($request->iv)? $request->iv : null,
          'key' => isset($request->key)? $request->key : null,
          'username' => isset($request->username)? $request->username : null,
          'password' => isset($request->password)? $request->password : null,
          'terminalId' => isset($request->terminalId)? $request->terminalId : null,
          'merchantId' => isset($request->merchantId)? $request->merchantId : null,
          'paymentIdentity' => isset($request->paymentIdentity)? $request->paymentIdentity : null,
          'certificate' => isset($request->certificate)? $request->certificate : null,
          'options' => (isset($request->zarin_gate_status) && ($request->zarin_gate_status == 'active'))
            ? 'zarin_gate'
            : null,
        ]);

    }

    public function status(Request $request)
    {

      if ($request->status == 'active' && PeymentMethod::where('status', 'active')->count() >= 3) {
        return response()->json([
          'status' => false,
          'data' => [
            'errors' => [
              'status' => 'امکان فعال کردن بیشتر از ۳ درگاه همزمان ممکن نیست.',
            ],
          ]
        ], 400);
      }

      PeymentMethod::where('id', $request->peyment_id)->update([
        'status' => $request->status,
      ]);

    }

}
