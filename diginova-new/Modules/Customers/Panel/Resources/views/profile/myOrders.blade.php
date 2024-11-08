<?php
  $awaiting_id = \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'awaiting_payment')->first()->id;
  $accepted_id = \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'accepted')->first()->id;
  $processing_id = \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'processing')->first()->id;
  $delivered_id = \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'delivered')->first()->id;
  $preparation_id = \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'preparation')->first()->id;
  $sending_id = \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'sending')->first()->id;

  $count_wait_for_payment = \Modules\Staff\Order\Models\Order::where('order_status_id', \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'awaiting_payment')->first()->id)->count();
  $count_paid_in_progress = \Modules\Staff\Order\Models\Order::where('order_status_id', \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'processing')->first()->id)->count();
  $count_delivered = \Modules\Staff\Order\Models\Order::where('order_status_id', \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'delivered')->first()->id)->count();
  $count_returned = \Modules\Staff\Order\Models\Order::where('order_status_id', \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'returned')->first()->id)->count();
  $count_canceled = \Modules\Staff\Order\Models\Order::where('order_status_id', \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'canceled')->first()->id)->count();
?>
@extends('layouts.customer.master')
@section('o-page__content')
  <section class="o-page__content">
    <div class="o-box">
      <div class="o-box__header">
        <span class="o-box__title">تاریخچه سفارشات</span>
      </div>
      <div class="o-box__tabs  js-order-search-container">
        <div class="o-box__tab {{ ($activeTab == 'wait-for-payment')? 'is-active' : '' }}" data-tab-pill-id="0">
          <a href="{{ route('customer.panel.myOrders', ['activeTab' => 'wait-for-payment']) }}">
            در انتظار پرداخت
            <span class="o-box__tab-counter">{{ persianNum($count_wait_for_payment) }}</span>
          </a>
        </div>
        <div class="o-box__tab {{ ($activeTab == 'paid-in-progress')? 'is-active' : '' }}" data-tab-pill-id="1">
          <a href="{{ route('customer.panel.myOrders', ['activeTab' => 'paid-in-progress']) }}">
            در حال پردازش
            <span class="o-box__tab-counter">{{ persianNum($count_paid_in_progress) }}</span>
          </a>
        </div>
        <div class="o-box__tab {{ ($activeTab == 'delivered')? 'is-active' : '' }}" data-tab-pill-id="2">
          <a href="{{ route('customer.panel.myOrders', ['activeTab' => 'delivered']) }}">
            تحویل شده
            <span class="o-box__tab-counter">{{ persianNum($count_delivered) }}</span>
          </a>
        </div>
        <div class="o-box__tab {{ ($activeTab == 'returned')? 'is-active' : '' }}" data-tab-pill-id="3">
          <a href="{{ route('customer.panel.myOrders', ['activeTab' => 'returned']) }}">
            مرجوعی
            <span class="o-box__tab-counter">{{ persianNum($count_returned) }}</span>
          </a>
        </div>
        <div class="o-box__tab {{ ($activeTab == 'canceled')? 'is-active' : '' }}" data-tab-pill-id="4">
          <a href="{{ route('customer.panel.myOrders', ['activeTab' => 'canceled']) }}">
            لغو شده
            <span class="o-box__tab-counter">{{ persianNum($count_canceled) }}</span>
          </a>
        </div>
      </div>
      @if ($orders->count())
        <div class="c-profile-order__content js-ui-tab-content">
          @foreach($orders as $order)
            <div class="c-profile-order__list-item">
            <div class="c-profile-order__list-item-details">
              <div class="c-profile-order__list-item-details-top ">
                <div class="c-profile-order__list-item-details-row">

                  <div class="c-profile-order__list-item-detail span-date" data-value="{{ $order->created_at }}"></div>
                  <div class="c-profile-order__list-item-detail">DKC-{{ persianNum($order->order_code) }}</div>
                  <div class="c-profile-order__list-item-detail">{{ $order->status->name }}</div>
                </div>
                <a class="o-link o-link--has-arrow" href="{{ route('customer.panel.orderDetails', ['order_code' => $order->order_code]) }}">مشاهده سفارش</a>
              </div>
              <div class="c-profile-order__list-item-details-row">
                <div class="c-profile-order__list-item-detail c-profile-order__list-item-detail--currency">
                  <span class="c-profile-order__list-item-detail-title">مبلغ کل:</span>
                  {{ persianNum(number_format($order->cost)) }}
                </div>
              </div>
            </div>
            <div class="c-profile-order__list-item-parcels">
              @foreach($order->consignments as $key => $consignment)
                <div class="c-profile-order__list-item-parcel">
                <div class="c-profile-order__list-item-parcel-top">
                  <div class="c-profile-order__list-item-parcel-details">
                    <div class="c-profile-order__list-item-parcel-title">مرسوله {{ persianNum($key+1) }} از {{ persianNum(count($order->consignments)) }}</div>
                    <div class="c-profile-order__list-item-parcel-date-time"></div>
                  </div>
                </div>

                <div class="c-profile-order__list-item-parcel-products">
                  @foreach ($consignment->consignment_variants as $item)
                    <a href="{{ route('front.productPage', ['product_code' => $item->product_variant->product->product_code]) }}" class="c-profile-order__list-item-parcel-product">
                      @if ($item->product_variant->product->media()->exists())
                        @foreach($item->product_variant->product->media as $image)
                          @if($item->product_variant->product->media && ($image->pivot->is_main == 1))
                            <img src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80" alt="{{ $item->product_variant->product->title_fa }}">
                          @endif
                        @endforeach
                      @endif
                    </a>
                  @endforeach
                </div>
              </div>
              @endforeach
            </div>

            @if ($order->order_status_id == $awaiting_id)
              <div class="c-profile-order__list-item-actions c-profile-order__list-item-actions--between">
                <a href="{{ route('orderCheckout', ['order_code' => $order->order_code]) }}" class="o-btn o-btn--contained-red-md">پرداخت</a>
                <div class="c-profile-order__warning">در صورت عدم پرداخت تا ۱ ساعت پس از ایجاد سفارش، این سفارش به‌ صورت خودکار لغو خواهد شد.</div>
              </div>
            @elseif($order->order_status_id == $accepted_id || $order->order_status_id == $processing_id || $order->order_status_id == $delivered_id || $order->order_status_id == $preparation_id || $order->order_status_id == $sending_id)
              <div class="c-profile-order__list-item-actions c-profile-order__list-item-actions--has-separator">
                <a href="{{ route('customer.panel.orderInvoice', ['order_code' => $order->order_code]) }}" class="o-btn o-btn--link-blue-md">مشاهده فاکتور</a>
              </div>
            @endif

          </div>
          @endforeach
        </div>
      @else
      <div class="c-profile-order__content js-ui-tab-content">
        <div class="c-profile-empty-temporary">
          <div class="c-profile-empty-temporary__img"><img src="https://www.digikala.com/static/files/d4fa2ec1.svg">
          </div>
          <div class="c-profile-empty-temporary__desc">
            سفارش فعالی در این بخش وجود ندارد.
          </div>
        </div>
      </div>
      @endif
      <div class="c-pager js-pagination"></div>
      <div class="js-search-results"></div>
    </div>
  </section>
@endsection


{{--@section('page-content')--}}
{{--@endsection--}}

@section('source')

<script src="{{ asset('mehdi/staff/js/jalali-moment.browser.js') }}"></script>

<script>
  function persianNum() {
    String.prototype.toPersianDigits = function () {
      var id = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
      return this.replace(/[0-9]/g, function (w) {
        return id[+w]
      });
    }
  }

  function convertDate() {
    $(".span-date").each(function (){
      var output="";
      var input = $(this).data('value');
      var m = moment(input);
      if(m.isValid()){
        m.locale('fa');
        output = m.format("YYYY/M/D");
      }
      $(this).text(output.toPersianDigits());
    });
  }
  persianNum();
  convertDate();
</script>

@endsection
