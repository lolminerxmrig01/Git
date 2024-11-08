<?php

namespace Modules\Staff\Order\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\Staff\Order\Models\Order;
use Modules\Staff\Order\Models\OrderHasConsignment;
use Modules\Staff\Setting\Models\Setting;
use Modules\Staff\Shiping\Models\OrderStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class StaffOrderController extends Controller
{

  public function index()
  {
    $orders = Order::where('order_status_id', '!=', 1)
      ->where('order_status_id', '!=', 7)
      ->paginate(10);

    $send_today_only = Order::whereHas('consignments', function (Builder $query){
      $query->where('delivery_at','<=' , Carbon::today());
    })->count();

    $send_tomorrow_only = Order::whereHas('consignments', function (Builder $query){
      $query->where('delivery_at','>' , Carbon::today());
    })->count();

    $consignments = OrderHasConsignment::all();
    return view('stafforder::index', compact('orders', 'send_today_only', 
    'send_tomorrow_only', 'consignments'));
  }

  public function details($id)
  {
    $order = Order::find($id);
    return view('stafforder::details', compact('order'));
  }

  public function invoice($id)
  {
    $settings = Setting::all();

    if(count($settings->where('name', 'invoice_stamp')->first()->media)){
      $stamp_image = $settings->where('name', 'invoice_stamp')->first()->media()->first();
    }
    else {
      $stamp_image = null;
    }

    $order = Order::find($id);

    return view('stafforder::invoice', compact('order', 'settings', 'stamp_image'));
  }

  public function search(Request $request, Order $orders)
  {
    (!$request->paginatorNum) ? $request->paginatorNum = 10 : '';

    $orders = $this->searchFilter($request, $orders);

    return view('stafforder::ajax.searchResult', compact('orders'));
  }

  public function searchFilter($request, $orders)
  {
    $orders = $orders->newQuery();

      if ($request->search_order_status == 'awaiting_peyment') {
        $orders->where('order_status_id', 1);
      }

      if ($request->search_order_status == 'confirmed') {
        $orders->where('order_status_id', 2);
      }

      if ($request->search_order_status == 'processing') {
        $orders->where('order_status_id', 3);
      }

      if ($request->search_order_status == 'delivered') {
        $orders->where('order_status_id', 4);
      }

    if (isset($request->searchـsend_today_only) && $request->searchـsend_today_only == 1) {
      $orders->whereHas('consignments', function (Builder $query){
        $query->where('delivery_at','<=' , Carbon::today());
      });
    }

    if (isset($request->search_send_tomorrow_only) && $request->search_send_tomorrow_only == 2) {
      $orders->whereHas('consignments', function (Builder $query){
        $query->where('delivery_at','>' , Carbon::today());
      });
    }
    return $orders->paginate($request->paginatorNum);

  }

  public function updateDetail(Request $request)
  {
    $order = Order::find($request->order_id);

    if ($request->consignment_id == 'order_detail')
    {
      $order->update([
        'description' => $request->description,
      ]);
    }
    else
    {
      $order_status_id = OrderStatus::where('en_name', $request->consignment_status_id)->first()->id;

      OrderHasConsignment::find($request->consignment_id)->update([
        'tracking_code' => $request->tracking_code,
        'order_status_id' => $order_status_id,
      ]);

      if (!$order->peyment_records->where('method_type', 'PeymentMethod')->count()) {
        $order_status_id = OrderStatus::where('en_name', 'confirmed')->first()->id;
      }

      if ($order->consignments()->where('order_status_id', 9)->orWhere('order_status_id', 10)
        ->orWhere('order_status_id', 11)->count()) {
        $order_status_id = OrderStatus::where('en_name', 'processing')->first()->id;
      }

      if ($order->consignments()->where('order_status_id', 4)->count() == $order->consignments->count()) {
        $order_status_id = OrderStatus::where('en_name', 'delivered')->first()->id;
      }

      $order->update([
        'order_status_id' => $order_status_id,
      ]);

      foreach ($order->consignments as $consignment) {
        if ($consignment->order_status_id == 8 || $consignment->order_status_id == 9 ||
          $consignment->order_status_id == 10 || $consignment->order_status_id == 11) {
          foreach ($consignment->consignment_variants as $variant)
          {
            $variant->update([
              'order_status_id' => 12,
            ]);
          }
        }
      }

    }

    return response()->json([
      'status' => true,
    ]);

  }

}
