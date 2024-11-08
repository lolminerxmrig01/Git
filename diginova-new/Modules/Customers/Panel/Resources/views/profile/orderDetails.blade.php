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
@section('head')@endsection
@section('o-page__content')
<section class="o-page__content">
    <div class="o-box">
      <div class="c-profile-order__details-top-bar">
        <div class="c-profile-order__details-header">
          <a href="https://www.digikala.com/profile/my-orders/?activeTab=canceled" class="o-btn o-btn--back"></a>
          <div class="c-profile-order__details-title">جزئیات سفارش</div>
          <div class="c-profile-order__list-item-detail span-date" data-value="{{ $order->created_at }}"></div>
          <div class="c-profile-order__list-item-detail">DKC-{{ persianNum($order->order_code) }}</div>
        </div>
      </div>
      <div class="c-profile-order__list-item-details">
        <div class="c-profile-order__list-item-details-row">
          <div class="c-profile-order__list-item-detail"><span class="c-profile-order__list-item-detail-title">تحویل گیرنده:</span>
            {{ $order->address->firstname . ' ' . $order->address->lastname }}
          </div>
          <div class="c-profile-order__list-item-detail"><span class="c-profile-order__list-item-detail-title">شماره تماس:</span>
            {{ (isset($customer->mobile) && !is_null($customer->mobile))? persianNum(0 . $customer->mobile) : '' }}
          </div>
        </div>
        <div class="c-profile-order__list-item-details-row c-profile-order__list-item-details-row--space-between">
          <div class="c-profile-order__list-item-detail"><span class="c-profile-order__list-item-detail-title">ارسال به:</span>
            {{ !is_null($order->address->address)? persianNum($order->address->address) : '' }} {{ !is_null($order->address->plaque)? '، پلاک ' . persianNum($order->address->plaque) : '' }}  {{ !is_null($order->address->unit)? '، واحد ' . persianNum($order->address->unit) : '' }}
          </div>
        </div>
      </div>
      <div class="c-profile-order__list-item-details c-profile-order__list-item-details--between">
        <div class="c-profile-order__list-item-details-row">
          <div class="c-profile-order__list-item-detail c-profile-order__list-item-detail--currency">
            <span class="c-profile-order__list-item-detail-title">مبلغ کل:</span>
            {{ persianNum(number_format(toman($order->cost))) }}
          </div>
          <div class="c-profile-order__list-item-detail c-profile-order__list-item-detail--currency">
            <span class="c-profile-order__list-item-detail-title">تخفیف:</span>
            {{ persianNum(number_format(toman($order->discount))) }}
          </div>
        </div>
        <div class="o-btn o-btn--link-gray-md o-btn--black o-btn--l-expand-more js-payment-records-btn">
          تاریخچه تراکنش
        </div>
      </div>
      <div class="c-profile-order__payment-records js-payment-records">
        <div class="c-profile-order__payment-records-row">
          <div class="c-profile-order__payment-record c-profile-order__payment-record--title">تاریخ</div>
          <div class="c-profile-order__payment-record c-profile-order__payment-record--title">توضیحات</div>
          <div class="c-profile-order__payment-record c-profile-order__payment-record--title">وضعیت</div>
          <div class="c-profile-order__payment-record c-profile-order__payment-record--title">مبلغ</div>
        </div>

        @if ($order->peyment_records()->exists())
          @foreach($order->peyment_records as $payment_record)
            <div class="c-profile-order__payment-records-row">
              <div class="c-profile-order__payment-record span-date" data-value="{{ $payment_record->created_at }}"></div>
              <div class="c-profile-order__payment-record">
                <div>پرداخت مبلغ سفارش</div>
                <div>{{ ($payment_record->method_type == 'PeymentMethod')? $payment_record->peymentMethod->name : (($payment_record->method_type == 'Voucher')? 'کد تخفیف' : '') }}</div>
              </div>
              <div class="c-profile-order__payment-record c-profile-order__payment-record-status {{ ($payment_record->status == 'successful')? 'c-profile-order__payment-record-status--positive' : 'c-profile-order__payment-record-status--negative' }} "></div>
              <div class="c-profile-order__payment-record">{{ persianNum(number_format(toman($payment_record->price))) }}</div>
            </div>
          @endforeach
        @endif


      </div>
      <div class="o-box__separator"></div>
      @foreach($order->consignments as $key => $consignment)
        <div class="c-profile-order__list-item">
        <div class="c-profile-order__list-item-details">
          <div class="c-profile-order__list-item-details-top">
            <div>
              <div class="c-profile-order__list-item-details-row">
                <div class="c-profile-order__list-item-detail u-ml-4">
                 مرسوله {{ persianNum($key+1) }} از {{ persianNum(count($order->consignments)) }}
                </div>
                @if ($consignment->delivery_method->media()->doesntExist())
                  <div class="c-checkout-time-table__shipping-type c-checkout-time-table__shipping-type--express">
                    {{ $consignment->delivery_method->name }}
                  </div>
                @else
                  <span style="background-image: url({{ $site_url . '/' .  $consignment->delivery_method->media()->first()->path . '/' . $consignment->delivery_method->media()->first()->name }});width: 25px !important;height: 19px !important;float: right;background-repeat: no-repeat;background-size: 20px;background-position: right bottom;margin-left: 0px;margin-top: -5px !important;"></span>
                  {{ $consignment->delivery_method->name }}
                @endif
              </div>
            </div>
            <div class="c-order-status-bar">
              <div class="c-order-status-bar__status">
                <div class="c-order-status-bar__current-status" style="color: #2e7b32;">
                  @if ($consignment->order_status->en_name == 'canceled')
                    لغو شده
                  @elseif($consignment->order_status->en_name == 'awaiting_payment')
                    در انتظار پرداخت
                  @elseif($consignment->order_status->en_name == 'awaiting_review')
                    در انتظار بررسی
                  @elseif($consignment->order_status->en_name == 'preparation')
                    آماده سازی مرسوله
                  @elseif($consignment->order_status->en_name == 'sending')
                    در حال ارسال
                  @elseif($consignment->order_status->en_name == 'bounced')
                    برگشت خورده
                  @elseif($consignment->order_status->en_name == 'delivered')
                    تحویل مرسوله به مشتری
                  @elseif($consignment->order_status->en_name == 'returned')
                    مرجوعی
                  @elseif($consignment->order_status->en_name == 'canceled')
                    لغو شده
                  @endif
                </div>
              </div>
              <div class="c-order-status-bar__progress">
                @if ($consignment->order_status->en_name == 'canceled')
                  <div class="c-order-status-bar__progress-bar" style="background-color: #4caf50; width: 12%;"></div>
                @elseif($consignment->order_status->en_name == 'awaiting_payment')
                  <div class="c-order-status-bar__progress-bar" style="background-color: #4caf50; width: 12%;"></div>
                @elseif($consignment->order_status->en_name == 'awaiting_review')
                  <div class="c-order-status-bar__progress-bar" style="background-color: #4caf50; width: 12%;"></div>
                @elseif($consignment->order_status->en_name == 'preparation')
                  <div class="c-order-status-bar__progress-bar" style="background-color: #4caf50; width: 12%;"></div>
                @elseif($consignment->order_status->en_name == 'sending')
                  <div class="c-order-status-bar__progress-bar" style="background-color: #4caf50; width: 12%;"></div>
                @elseif($consignment->order_status->en_name == 'bounced')
                  <div class="c-order-status-bar__progress-bar" style="background-color: #4caf50; width: 12%;"></div>
                @elseif($consignment->order_status->en_name == 'delivered')
                  <div class="c-order-status-bar__progress-bar" style="background-color: #4caf50; width: 100%;"></div>
                @elseif($consignment->order_status->en_name == 'returned')
                  <div class="c-order-status-bar__progress-bar" style="background-color: #4caf50; width: 12%;"></div>
                @elseif($consignment->order_status->en_name == 'canceled')
                  <div class="c-order-status-bar__progress-bar" style="background-color: #4caf50; width: 12%;"></div>
                @endif
              </div>
            </div>
          </div>

          <?php $sum_variants_price = 0; ?>
          @foreach ($consignment->consignment_variants as $item)
            @if (!is_null($item->promotion_price))
              <?php $sum_variants_price += ($item->promotion_price * $item->count); ?>
            @else
              <?php $sum_variants_price += ($item->variant_price * $item->count); ?>
            @endif
          @endforeach

          <div class="c-profile-order__list-item-details-row ">
            <div class="c-profile-order__list-item-detail c-profile-order__list-item-detail--currency">
              <span class="c-profile-order__list-item-detail-title">جمع قیمت کالاهای مرسوله:</span>
              {{ persianNum(number_format(toman($sum_variants_price))) }}
            </div>
            <div class="c-profile-order__list-item-detail c-profile-order__list-item-detail--currency">
              <span class="c-profile-order__list-item-detail-title">هزینه ارسال:</span>
              {{ persianNum(number_format(toman($consignment->shiping_cost))) }}
            </div>
            @if (!is_null($consignment->tracking_code))
              <div class="c-profile-order__post-code">
                <span class="c-profile-order__list-item-detail-title">کد رهگیری پست:</span>
                {{ persianNum($consignment->tracking_code) }}
              </div>
            @endif
          </div>
        </div>
        <div class="c-profile-order__list-item-products">
          @foreach ($consignment->consignment_variants as $item)
            <div class="c-profile-order__list-item-product">
              <a href="{{ route('front.productPage', ['product_code' => $item->product_variant->product->product_code]) }}" class="c-profile-order__list-item-product-img">
                @if ($item->product_variant->product->media()->exists())
                  @foreach($item->product_variant->product->media as $image)
                    @if($item->product_variant->product->media && ($image->pivot->is_main == 1))
                      <img src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80" alt="{{ $item->product_variant->product->title_fa }}">
                    @endif
                  @endforeach
                @endif
                <span class="c-profile-order__list-item-parcel-product-qty">{{ persianNum($item->count) }}</span>
              </a>
              <div class="c-profile-order__list-item-product-content">
                <div class="c-profile-order__list-item-product-top-bar">
                  <div class="c-profile-order__list-item-product-title">
                    {{ $item->product_variant->product->title_fa }}
                  </div>
                  <div class="c-ui-more">
                    <div class="o-btn o-btn--icon-gray-md o-btn--l-more js-ui-see-more"></div>
                    <div class="c-ui-more__options js-ui-more-options">
                      <a class="c-ui-more__option " href="{{ route('front.createComment', $item->product_variant->product->product_code) }}">ثبت نظر</a>
                    </div>
                  </div>
                </div>
                <div class="c-profile-order__list-item-product-detail">
                  @if (!is_null($item->product_variant->variant->value))
                    <span class="c-profile-order__list-item-product-detail-color"
                     style="background-color: {{ $item->product_variant->variant->value }}"></span>
                  @endif
                  {{ $item->product_variant->variant->name }}
                </div>
                <div class="c-profile-order__list-item-product-detail c-profile-order__list-item-product-detail--guarantee">
                  {{ $item->product_variant->warranty->name }}
                </div>
                <div class="c-profile-order__list-item-product-detail c-profile-order__list-item-product-detail--seller">
                  {{ $fa_store_name }}
                </div>
                <div class="c-profile-order__list-item-details-row c-profile-order__list-item-details-row--justify-end">
                  <div class="c-profile-order__list-item-detail c-profile-order__list-item-detail--currency">
                    <span class="c-profile-order__list-item-detail-title">قیمت واحد:</span>
                    @if (!is_null($item->promotion_price))
                      {{ persianNum(number_format(toman($item->promotion_price))) }}
                    @else
                      {{ persianNum(number_format(toman($item->variant_price))) }}
                    @endif
                  </div>
                </div>
              </div>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
    </div>
</section>
@endsection

@section('source')
<script>
  $('.js-payment-records-btn').on('click', function () {
    $(this).toggleClass('is-open');
    $(this).parent().siblings('.js-payment-records').toggle();
  });
</script>
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
