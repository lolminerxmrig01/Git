@extends('layouts.customer.master')
@section('head')
<script>
  var supernova_mode = "production";
  var supernova_tracker_url = "https:\/\/etrackerd.digikala.com\/tracker\/events\/";
  var activeMenu = "profile";
  var faqPageTitle = "profile_section";
  var skipWalletRequest = true;
  var userId = 9735394;
  var adroRCActivation = true;
  var loginRegisterUrlWithBack = "\/users\/login-register\/?_back=https:\/\/www.digikala.com\/profile\/";
  var isNewCustomer = false;
  var digiclubLuckyDrawEndTime = "2021-06-27 15:30:28";
  var activateUrl = "\/digiclub\/activate\/";
</script>
@endsection
@section('o-page__content')
  <section class="o-page__content">
    <div class="u-hidden js-ml-profile-ab-test"></div>
    <div class="o-grid">
      <div class="row">
        <div class="{{ ($customer->favorites()->exists())? 'col-6' : 'col-12' }}">
          <div class="o-headline o-headline--profile">
            <span>اطلاعات شخصی</span>
          </div>
          <div class="c-profile-stats">
            <div class="c-profile-stats__row">
              <div class="c-profile-stats__col">
                <p>
                  <span>نام و نام خانوادگی:</span>
                  {{ !is_null($customer->first_name)? $customer->first_name : '' }} {{ !is_null($customer->last_name)? $customer->last_name : '' }}
                </p>
              </div>
              <div class="c-profile-stats__col">
                <p>
                  <span>پست الکترونیک :</span>
                  <span class="c-profile-stats__value">{{ !is_null($customer->email)? $customer->email : '-' }}</span>
                </p>
              </div>
            </div>
            <div class="c-profile-stats__row">
              <div class="c-profile-stats__col">
                <p>
                  <span>شماره تلفن همراه:</span>
                  {{ !is_null($customer->mobile)? persianNum(0 . $customer->mobile) : '' }}
                </p>
              </div>
              <div class="c-profile-stats__col">
                <p>
                  <span>کد ملی:</span>
                  {{ !is_null($customer->national_code)? persianNum($customer->national_code) : '' }}
                </p>
              </div>
            </div>
            <div class="c-profile-stats__row">
              <div class="c-profile-stats__col">
                <p>
                  <span>دریافت خبرنامه:</span>
                  {{ ($customer->newsletters)? 'بله' : 'خیر' }}
                </p>
              </div>
              <div class="c-profile-stats__col">
                <p>
                  <span>روش بازگشت وجه:</span>
                  <span class="c-profile-stats__value">
                      {{ !is_null($customer->return_money_method)? ($customer->return_money_method == 'wallet' ? 'کیف پول' : 'حساب بانکی' ) : '-' }}
                  </span>
                </p>
              </div>
            </div>
            <div class="c-profile-stats__action">
              <a href="{{ route('customer.panel.personalInfo') }}" class="btn-link-spoiler btn-link-spoiler--edit">ویرایش
                اطلاعات شخصی</a>
            </div>
          </div>
        </div>
        @if ($customer->favorites()->exists())
          <div class="col-6">
            <div class="o-headline o-headline--profile">
              <span>لیست آخرین علاقه‌مندی‌ها</span>
            </div>
            <div class="c-profile-recent-fav">
              <div class="c-profile-recent-fav__content">
                @foreach ($customer->favorites()->orderBy('created_at', 'desc')->get() as $key => $item)
                  <div class="c-profile-recent-fav__row js-favorite-product">
                    <a href="{{ route('front.productPage', $item->product->product_code) }}" class="c-profile-recent-fav__col c-profile-recent-fav__col--thumb">
                      @foreach($item->product->media as $image)
                        @if($item->product->media && ($image->pivot->is_main == 1))
                          <img data-src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_fill,h_150,w_150/quality,q_60" alt="{{ $item->product->title_fa }}">
                        @endif
                      @endforeach
                    </a>
                    <div class="c-profile-recent-fav__col c-profile-recent-fav__col--title">
                      <a href="{{ route('front.productPage', $item->product->product_code) }}">
                        <h4 class="c-profile-recent-fav__name">{{ $item->product->title_fa }}</h4>
                      </a>
                      <div class="c-profile-recent-fav__price"> {{ ($item->product->variants()->exists())? persianNum(number_format(toman(product_price($item->product)))) . ' تومان' : '' }} &nbsp;</div>
                    </div>
                    <div class="c-profile-recent-fav__col c-profile-recent-fav__col--actions">
                      <button class="btn-action btn-action--remove js-remove-favorite-product" data-product-id="{{ $item->product->product_code }}"></button>
                    </div>
                  </div>
                  @if ($key == 2)
                    @break
                  @endif
                @endforeach
              </div>
              <div class="c-profile-recent-fav__action">
                <a href="{{ route('customer.panel.favorites') }}" class="btn-link-spoiler btn-link-spoiler--edit">مشاهده و
                  ویرایش لیست مورد علاقه</a>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
    <div class="o-headline o-headline--profile">
      <span>آخرین سفارش‌ها </span>
    </div>
    <div class="c-table-orders">
      <div class="c-table-orders__head c-table-orders__head--highlighted">
        <div class="c-table-orders__row">
          <div class="c-table-orders__cell c-table-orders__cell--hash">#</div>
          <div class="c-table-orders__cell c-table-orders__cell--id">شماره سفارش</div>
          <div class="c-table-orders__cell c-table-orders__cell--date">تاریخ ثبت سفارش</div>
          <div class="c-table-orders__cell c-table-orders__cell--price">مبلغ قابل پرداخت</div>
          <div class="c-table-orders__cell c-table-orders__cell--price">مبلغ کل</div>
          <div class="c-table-orders__cell c-table-orders__cell--payment">عملیات پرداخت</div>
          <div class="c-table-orders__cell c-table-orders__cell--detail"> جزییات</div>
        </div>
      </div>
      <div class="c-table-orders__body">

        @foreach ($customer->orders()->orderBy('created_at', 'desc')->get() as $key => $order)
          <div class="c-table-orders__row">
            <div class="c-table-orders__cell c-table-orders__cell--hash">{{ persianNum($key+1) }}</div>
            <div class="c-table-orders__cell c-table-orders__cell--id">DKC-{{ $order->order_code }}</div>
            <div class="c-table-orders__cell c-table-orders__cell--date span-date" data-value="{{ $order->created_at }}"></div>
            <div class="c-table-orders__cell c-table-orders__cell--price">
              <div>
                  @if ($order->status->en_name !== 'awaiting_payment' || $order->status->en_name !== 'canceled' || $order->status->en_name !== 'returned' && $order->peyment_records()->where('method_type', 'PeymentMethod')->where('status', 'successful')->where('method_id', '!==',\Modules\Staff\Peyment\Models\PeymentMethod::where('en_name', 'cod')->first()->id)->exists())
                    {{ persianNum(0) }}
                  @elseif($order->status->en_name == 'canceled')
                    {{ persianNum(0) }}
                  @elseif($order->status->en_name == 'returned')
                    {{ persianNum(0) }}
                  @else
                    {{ persianNum(number_format(toman($order->cost))) }}
                  @endif
              </div>
            </div>
            <div class="c-table-orders__cell c-table-orders__cell--price">{{ persianNum(number_format(toman($order->cost))) }} تومان</div>
            <div class="c-table-orders__cell c-table-orders__cell--payment">
              @if ($order->status->en_name !== 'awaiting_payment' || $order->status->en_name !== 'canceled' || $order->status->en_name !== 'returned' && $order->peyment_records()->where('method_type', 'PeymentMethod')->where('status', 'successful')->where('method_id', '!==',\Modules\Staff\Peyment\Models\PeymentMethod::where('en_name', 'cod')->first()->id)->exists())
                <span class="c-table-orders__payment-status c-table-orders__payment-status--ok">پرداخت شده</span>
              @elseif($order->status->en_name == 'canceled')
                <span class="c-table-orders__payment-status c-table-orders__payment-status--error">لغو شده</span>
              @elseif($order->status->en_name == 'returned')
                <span class="c-table-orders__payment-status c-table-orders__payment-status--error">مرجوعی</span>
              @else
                <a href="{{ route('orderCheckout', $order->order_code) }}" class="btn-primary">پرداخت</a>
              @endif
            </div>
            <div class="c-table-orders__cell c-table-orders__cell--detail">
              <a href="{{ route('customer.panel.orderDetails', $order->order_code) }}" class="btn-order-more"></a>
            </div>
          </div>
          @if ($key == 9)
            @break
          @endif
        @endforeach


        <a href="{{ route('customer.panel.myOrders') }}" class="c-table-orders__show-more">مشاهده لیست سفارش‌ها</a>
      </div>
    </div>
  </section>
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
  persianNum();
  convertDate();
</script>
@endsection
