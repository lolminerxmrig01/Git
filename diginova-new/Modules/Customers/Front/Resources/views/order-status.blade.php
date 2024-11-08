@php
  $banner2 = \Modules\Staff\Slider\Models\Slider::find(2);
@endphp

@extends('layouts.front.master')

@section('head')
  <title>سفارش {{ ($order->status->en_name == 'accepted')? 'موفق' : 'ناموفق' }} | {{ $fa_store_name }}</title>
  <meta name="robots" content="noindex, nofollow">
  <script src="{{ asset('assets/js/sentry.js') }}"></script>
  <script src="{{ asset('assets/js/paymentResponseAction.js') }}"></script>

@endsection

@section('content')
<main id="main">
    <div id="HomePageTopBanner"></div>
    <div id="content">
      <div class="container">
        <section class="c-thank-you__main-container">
          <div class="c-thank-you__container c-thank-you__container--general">
            <div class="c-thank-you__row">
              <div class="c-thank-you__order-data">
                @if ($order->status->en_name == 'accepted')
                  <div class="c-thank-you__order-result-title js-thank-you-payment-status c-thank-you__order-result-title--success" data-status="success">
                    سفارش شما با موفقیت ثبت گردید.
                  </div>
                @elseif($order->status->en_name == 'awaiting_payment')
                  <div class="c-thank-you__order-result-title js-thank-you-payment-status c-thank-you__order-result-title--error" data-status="error">
                    متاسفانه پرداخت شما ناموفق بود!
                  </div>
                @endif
                <div class="c-thank-you__order-result-data">
                  <span>شماره سفارش:</span>
                  DKC-{{ $order->order_code }}
                </div>

                @if($order->status->en_name !== 'awaiting_payment')
                  <div class="c-thank-you__order-result-data">
                    <span>شیوه پرداخت:</span>
                    @if ($order->peyment_records()->where('method_type', 'PeymentMethod')->first()->peymentMethod->en_name == 'cod')
                      پرداخت در محل
                    @else
                      پرداخت اینترنتی
                    @endif
                  </div>
                @else
                  <p class="c-thank-you__failed-payment-text c-thank-you__failed-payment-text--error">
                    برای جلوگیری از حذف خودکار سفارش، لطفا مبلغ آن را تا ۵۹ دقیقه آینده پرداخت نمایید.
                  </p>
                @endif


              </div>
              <div class="c-thank-you__order-status-image">
                @if($order->status->en_name !== 'awaiting_payment')
                  <img src="{{ asset('assets/images/png/order-success.png') }}">
                @else
                  <img src="{{ asset('assets/images/png/order-error.png') }}">
                @endif
              </div>
            </div>
            <div class="c-thank-you__row">
              <div class="c-thank-you__order-status-actions">
                @if($order->status->en_name !== 'awaiting_payment')
                  <a class="o-btn o-btn--contained-red-lg" href="{{ route('front.profileOrders', $order->order_code) }}">پیگیری سفارش</a>
                  <a class="o-btn o-btn--link-red-lg" href="{{ $site_url }}">بازگشت به صفحه اصلی سایت</a>
                @else
                  <form method="post">
                    <input type="hidden" name="payment_method" value="online">
                    <input type="hidden" name="bank_id" value="304" checked="checked">
                    <a href="{{ route('front.repaymentOrder', [$order->order_code]) }}" class="o-btn o-btn--contained-red-lg">
                      پرداخت مجدد
                    </a>
                  </form>
                  <a class="o-btn o-btn--link-red-lg" href="{{ route('front.reselectGateway', [$order->order_code]) }}">تغییر روش پرداخت</a>
                @endif
              </div>
            </div>

            @if ($order->peyment_records()->where('method_type', 'PeymentMethod')->first()->peymentMethod->en_name == 'cod')
              <p class="c-thank-you__online-payment-dsc">
                مبلغ {{ persianNum(number_format(toman($order->cost))) }} تومان در هنگام تحویل سفارش دریافت می‌گردد.
                <br>
                چنانچه مایل هستید همچنان میتوانید مبلغ سفارش را هم‌اکنون به‌صورت اینترنتی پرداخت نمایید.
              </p>
              <a class="o-btn o-btn--outlined-red-lg" href="{{ route('front.repaymentOrder', $order->order_code) }}">پرداخت اینترنتی</a>
            @endif

            @if ($order->peyment_records()->where('method_type', 'PeymentMethod')->first()->status == 'unsuccessful')
              <div class="c-thank-you__row--border-top">
                <section class="c-thank-you__payments-history">
                  <p>
                    چنانچه مبلغی از حساب شما کسر شده است، تا ۲۴ ساعت آینده به حساب شما باز خواهد گشت.
                  </p>
                  <div class="c-thank-you__payments-history-header">
                    جزئیات پرداخت
                  </div>
                  @foreach($order->peyment_records()->where('method_type', 'PeymentMethod')->get() as $key => $peyment_record)
                  <div class="c-thank-you__payments-history-row">
                    <div class="c-thank-you__payments-history-column c-thank-you__payments-history-column--index">
                      <span>ردیف</span>
                      <span>{{ persianNum($key+1) }}</span>
                    </div>
                    <div class="c-thank-you__payments-history-column c-thank-you__payments-history-column--gateway">
                      <span>درگاه پرداخت</span>
                      <span>{{ $peyment_record->peymentMethod->name }}</span>
                    </div>
                    <div class="c-thank-you__payments-history-column c-thank-you__payments-history-column--id">
                      <span>شماره پیگیری</span>
                      <span>{{ !is_null($peyment_record->tracking_code)? persianNum($peyment_record->tracking_code) : '-' }}</span>
                    </div>
                    <div class="c-thank-you__payments-history-column c-thank-you__payments-history-column--time">
                      <span>زمان</span>
                      <span class="span-time" data-value="{{ $peyment_record->updated_at }}"></span>
                    </div>
                    <div class="c-thank-you__payments-history-column c-thank-you__payments-history-column--date">
                      <span>تاریخ</span>
                      <span class="span-date" data-value="{{ $peyment_record->updated_at }}"></span>
                    </div>
                  </div>
                  @endforeach

                </section>
              </div>
            @endif
          </div>
        </section>
      </div>
    </div>
</main>
@endsection





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

    function convertTime() {
      $(".span-time").each(function (){
        var output="";
        var input = $(this).data('value');
        var m = moment(input);
        if(m.isValid()){
          m.locale('fa');
          output = m.format("HH:mm");
        }
        $(this).text(output.toPersianDigits());
      });
    }

    persianNum();
    convertDate();
    convertTime();

  </script>

@endsection
