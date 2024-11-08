@php
  $banner2 = \Modules\Staff\Slider\Models\Slider::find(2);
@endphp

@extends('layouts.front.master')

@section('head')
<title>تعیین مجدد وضعیت ارسال و پرداخت | {{ $fa_store_name }}</title>
<meta name="robots" content="noindex, nofollow">
<script>
  var supernova_mode = "production";
  var supernova_tracker_url = "https:\/\/etrackerd.digikala.com\/tracker\/events\/";
  var payablePrice = 4750000;
  var userId = 9735394;
  var adroRCActivation = true;
  var loginRegisterUrlWithBack = "\/users\/login-register\/?_back=https:\/\/www.digikala.com\/reselect\/109626663\/";
  var isNewCustomer = false;
  var digiclubLuckyDrawEndTime = "2021-06-23 15:30:28";
  var activateUrl = "\/digiclub\/activate\/";
</script>
<script src="{{ asset('assets/js/sentry.js') }}"></script>
<script src="{{ asset('assets/js/paymentResponseAction.js') }}"></script>
@endsection


@section('content')

<main id="main">
  <div id="HomePageTopBanner"></div>
  <div id="content">
    <div class="container">
      <form method="post" action="{{ route('front.reselectPaymant') }}" class="o-page c-thank-you__page js-thank-you-page">
        @csrf
        <input name="order_code" type="hidden" value="{{ $order->order_code }}">

        <section class="c-thank-you__main-container">
          <div class="c-payment__payment-types">
            <div class="c-payment__header">
              <span>
                 شیوه پرداخت
              </span>
            </div>

            <ul class="c-payment__paymethod js-paymethod-container">
              <input class="js-bank-id-input" type="hidden" name="bank_id" value="">

              <li data-event="change_payment_method" data-event-category="funnel" data-event-label="addresses: default: , province: تهران, shipping: normal, cart_payable: 1132665000">
                <div class="c-payment__paymethod-item u-hidden js-wallet-container">
                  <label class="c-outline-radio js-wallet-option c-payment__paymethod-item-radio selenium-payment-pos">
                    <input type="radio" data-bank-id="316" name="payment_method" value="wallet" id="payment-option-wallet">
                    <span class="c-outline-radio__check"></span>
                    <span class="c-payment__paymethod-icon c-payment__paymethod-icon--wallet"></span>
                  </label>
                  <label class="c-payment__paymethod-title-row" for="payment-option-wallet">
                    <div class="c-payment__paymethod-title">
                      <span class="js-paymethod-title">افزایش اعتبار و پرداخت از کیف پول</span>
                      <div class="c-wiki c-wiki__holder">
                        <div class="c-wiki__info-sign"></div>
                        <div class="c-wiki__container js-dk-wiki ">
                          <div class="c-wiki__arrow"></div>
                          <p class="c-wiki__text">
                            شما می‌توانید مبلغ سفارش را با استفاده از اعتبار کیف پول خود پرداخت نمایید. در صورت لغو، مبلغ سفارش به کیف پول شما بازمی‌گردد.
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="c-payment__paymethod-dsc" data-amount="">
                      <span>موجودی:</span>
                      <span class="js-wallet-amount"></span>
                      <span class="c-checkout-paymethod__currency">تومان</span>
                    </div>
                  </label>
                </div>
              </li>

              @if (!is_null($peyment_methods))
                @foreach($peyment_methods as $key => $peyment_method)
                  @if ($peyment_method->en_name == 'cod')
                    <div class="c-payment__more-paymethod js-more-paymethod c-payment__more-paymethod--border-bottom">
                      پرداخت در محل
                    </div>
                  @endif
                  <li data-event="change_payment_method" data-event-category="funnel" data-event-label="addresses: default: , province: تهران, shipping: normal, cart_payable: 1132665000">
                    <div class="c-payment__paymethod-item {{ ($peyment_method->en_name == 'cod')? 'js-credit-paymethod-container' : '' }}">
                      <label class="c-outline-radio js-online-option c-payment__paymethod-item-radio selenium-payment-pos">
                        <input type="radio" data-bank-id="{{ $peyment_method->id }}" name="payment_method" value="{{ ($peyment_method->en_name == 'cod')? 'cod' : 'online' }}" id="payment-option-online" {{ ($key == 0)? 'checked' : '' }}>
                        <span class="c-outline-radio__check"></span>
                        <span class="c-payment__paymethod-icon {{ ($peyment_method->en_name !== 'cod')? 'c-payment__paymethod-icon--online' : 'c-payment__paymethod-icon--credit'  }}"></span>
                      </label>
                      <label class="c-payment__paymethod-title-row" for="payment-option-online">
                        <div class="c-payment__paymethod-title">
                          <span class="js-paymethod-title">{{ $peyment_method->name }}</span>
                          @if ($peyment_method->en_name !== 'cod')
                            <div class="c-wiki c-wiki__holder">
                              <div class="c-wiki__info-sign"></div>
                              <div class="c-wiki__container js-dk-wiki ">
                                <div class="c-wiki__arrow"></div>
                                <p class="c-wiki__text">
                                  با پرداخت اینترنتی، سفارش شما با اولویت بیشتری نسبت به پرداخت در محل پردازش و ارسال می‌شود. در صورت پرداخت ناموفق هزینه کسر شده حداکثر طی ۷۲ ساعت به حساب شما بازگردانده می‌شود.
                                </p>
                              </div>
                            </div>
                          @endif
                        </div>
                        @if ($peyment_method->description !== null || $peyment_method->description !== '')
                          <div class="c-payment__paymethod-dsc" data-amount="">
                            {{ persianNum($peyment_method->description) }}
                          </div>
                        @endif
                      </label>
                    </div>
                  </li>
                @endforeach
              @endif

            </ul>


          </div>
          <div class="c-payment__box c-payment__order-details">
            <div class="c-payment__order-details-header">کد سفارش: DKC-{{ persianNum($order->order_code) }}</div>
            <div class="c-payment__order-details-row">
              <div class="c-payment__order-details-item">
                <div class="c-payment__order-details-item-title">تحویل گیرنده:</div>
                <div class="c-payment__order-details-item-value ">{{ $order->address->firstname . ' ' . $order->address->lastname }}</div>
              </div>
              <div class="c-payment__order-details-item">
                <div class="c-payment__order-details-item-title">شماره تماس:</div>
                <div class="c-payment__order-details-item-value ">{{ !is_null($order->address->mobile)? persianNum(0 . $order->address->mobile) : '' }}</div>
              </div>
            </div>
            <div class="c-payment__order-details-row">
              <div class="c-payment__order-details-item">
                <div class="c-payment__order-details-item-title">ارسال به:</div>
                <div class="c-payment__order-details-item-value ">{{ !is_null($order->address->address)? persianNum($order->address->address) : '' }} {{ !is_null($order->address->plaque)? '، پلاک ' . persianNum($order->address->plaque) : '' }}  {{ !is_null($order->address->unit)? '، واحد ' . persianNum($order->address->unit) : '' }}</div>
              </div>
            </div>
            <div class="c-payment__order-details-row">
              <div class="c-payment__order-details-item">
                <div class="c-payment__order-details-item-title">تعداد مرسوله:</div>
                <div class="c-payment__order-details-item-value ">{{ persianNum(count($order->consignments)) }}</div>
              </div>
              <div class="c-payment__order-details-item">
                <div class="c-payment__order-details-item-title">مبلغ قابل پرداخت:</div>
                <div class="c-payment__order-details-item-value c-payment__order-details-item-value--currency">{{ persianNum(toman($order->cost)) }}</div>
              </div>
            </div>
          </div>
          <div class="c-payment__box">
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
                <div class="c-thank-you__payments-history-column  c-thank-you__payments-history-column--time">
                  <span>زمان</span>
                  <span class="span-time" data-value="{{ $peyment_record->updated_at }}"></span>
                </div>
                <div class="c-thank-you__payments-history-column  c-thank-you__payments-history-column--date">
                  <span>تاریخ</span>
                  <span class="span-date" data-value="{{ $peyment_record->updated_at }}"></span>
                </div>
              </div>
              @endforeach
            </section>
          </div>
          <div class="c-shipment-page__to-payment-sticky">
            <div class="c-shipment-page__to-payment-sticky-container">
              <button type="submit" class="c-checkout__to-shipping-link js-save-payment-data selenium-next-step-shipping">
                پرداخت و ثبت نهایی سفارش
              </button>
              <div class="c-shipment-page__to-payment-price-report">
                <p>مبلغ قابل پرداخت</p>
                <div class="c-shipment-page__to-payment-price-report--price" id="cartPayablePrice">
                  <span class="js-price" data-current-amount="{{ $order->cost }}" data-amount="{{ $order->cost }}">
                     {{ persianNum(number_format(toman($order->cost))) }}
                  </span>
                  <span class="c-shipment-page__to-payment-price-report--currency">تومان</span>
                </div>
              </div>
            </div>
          </div>
        </section>
      </form>
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
