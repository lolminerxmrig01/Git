<?php

namespace Modules\Staff\Shiping\Http\Controllers;

use Modules\Staff\Setting\Models\Setting;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\Staff\Product\Models\ProductWeight;
use Modules\Staff\Shiping\Models\DeliveryCostDetType;
use Modules\Staff\Shiping\Models\DeliveryMethodGroup;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Shiping\Models\DeliveryMethod;
use Modules\Staff\Shiping\Models\DeliveryMethodLocation;
use App\Models\Media;
use Illuminate\Support\Facades\View;
use Modules\Staff\Shiping\Models\DeliveryMethodValue;

class StaffDeliveryMethodController extends Controller
{

    public function index()
    {
      $delivery_methods = DeliveryMethod::paginate(100);
      return view('staffdelivery::deliveryMethod.index', compact('delivery_methods'));
    }

    public function edit($id)
    {
      $delivery_method = DeliveryMethod::find($id);
      $deliveryCostDetTypes = DeliveryCostDetType::all();
      $weights = ProductWeight::all();
      $states = State::all();
      $values = $delivery_method->values()->orderBy('type', 'desc')->paginate();

      return view('staffdelivery::deliveryMethod.edit', 
        compact('delivery_method', 'deliveryCostDetTypes', 'states', 'values', 'weights'));
    }

    public function storeDeliveryMethod(Request $request)
    {
        $messages = [
          'weights.required' => 'فیلد نوع کالا اجباری است',
          'delivery_cost.required_if' => 'در وضعیت انتخابی وارد کردن هزینه ارسال اجباری است',
          'min_card_cost.required_if' => 'در وضعیت انتخابی وارد کردن حداقل ارزش سبد خرید اجباری است',
          'states.required_if' => 'در وضعیت انتخابی وارد کردن حداقل یک شهر اجباری است',
        ];

        $validator = Validator::make($request->all(),[
          'name' => 'required',
          'weights' => 'required',
          'cost__det_type' => 'required',
          'delivery_cost' => 'nullable|required_if:cost__det_type,2,3',
          'has_free_delivery' => 'nullable',
          'min_card_cost' => 'nullable|required_if:has_free_delivery, 1',
          'has_state_limit' => 'nullable',
          'states' => 'nullable|required_if:has_state_limit, 1',
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

        $deliveryMethod = DeliveryMethod::find($request->method_id);

        $deliveryMethod->update([
          'name' => $request->name,
          'cost_det_type_id' => $request->cost__det_type,
        ]);

        if ($request->cost__det_type == 2 || $request->cost__det_type == 3) {
          $deliveryMethod->update([
            'delivery_cost' => $request->delivery_cost,
          ]);
        }

        if (isset($request->has_free_delivery) && ($request->has_free_delivery == 1) ) {
          $deliveryMethod->update([
            'free_shipping_min_cost' => $request->min_card_cost,
          ]);
        } else {
          $deliveryMethod->update([
            'free_shipping_min_cost' => null,
          ]);
        }

        if (isset($request->intra_provinces) && count($request->intra_provinces)) {
          $deliveryMethodValues = DeliveryMethodValue::where('delivery_method_id', $request->method_id)
            ->orderBy('type', 'desc')->get();
          foreach ($deliveryMethodValues as $key => $deliveryMethodValue) {
            $deliveryMethodValue->update([
              'intra_province' => isset($request->intra_provinces[$key])
                ? $request->intra_provinces[$key] 
                : null,
              'extra_province' => isset($request->extra_provinces[$key])
                ? $request->extra_provinces[$key] 
                : null,
              'neighboring_provinces' => isset($request->neighboring_provinces[$key])
                ? $request->neighboring_provinces[$key] 
                : null,
            ]);
          }
        }

        $deliveryMethod->weights()->detach();
        
        foreach ($request->weights as $weight) {
          $methodWeight = ProductWeight::find(intval($weight));
          $deliveryMethod->weights()->attach($methodWeight);
        }

        if (isset($request->has_state_limit) && ($request->has_state_limit == 1) && isset($request->states)) {
          $deliveryMethod->states()->detach();
          foreach ($request->states as $state) {
            $methodState = ProductWeight::find($state);
            $deliveryMethod->states()->attach($methodState);
          }
        }
        else {
          $deliveryMethod->states()->detach();
        }
    }

    public function status(Request $request)
    {
      DeliveryMethod::where('id', $request->delivery_id)->update([
        'status' => $request->status,
      ]);
    }

}
