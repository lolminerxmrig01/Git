@php
  $banner2 = \Modules\Staff\Slider\Models\Slider::find(2);
@endphp

@extends('layouts.front.master')

@section('head')
<title>سبد خرید | {{ $fa_store_name }}</title>
<link rel="canonical" href="{{ route('front.cart') }}"/>
<meta name="robots" content="noindex, nofollow"/>
<script src="{{ asset('assets/js/sentry.js') }}"></script>
<script src="{{ asset('assets/js/CartIndexAction.js') }}"></script>

<style>
  @media screen and (-ms-high-contrast: none) {
    .c-shipment-page__to-payment-sticky, .c-checkout__to-shipping-sticky {
      position: relative !important;
    }

    .c-checkout-aside {
      position: relative !important;
    }
  }

  /* all edge versions */
  @supports (-ms-ime-align:auto) {
    .c-shipment-page__to-payment-sticky, .c-checkout__to-shipping-sticky {
      position: relative !important;
    }

    .c-checkout-aside {
      position: relative !important;
    }
  }

  /*.o-page__content {*/
  /*  padding-left: 10px !important;*/
  /*}*/

  /*.o-page__aside {*/
  /*  padding-right: 10px !important;*/
  /*}*/

  /*body.has-top-banner.c-checkout-pages {*/
  /*   padding-top: 0 !important;*/
  /*}*/

  body {
    padding-top: 190px !important;
  }

</style>
@endsection

@section('content')

<main id="main">
  <div id="HomePageTopBanner"></div>
  <div id="content">
    <section class="o-page c-cart-page">
      <div class="container">
        <div class="c-checkout__tab">
          <div class="c-checkout__tab-pill c-checkout__tab-pill--main-cart c-checkout__tab-pill--active js-cart-tab" data-type="main">
            سبد خرید
            <span class="c-checkout__tab-counter">
              {{ persianNum($first_carts->count()) }}
            </span>
          </div>
          <div class="c-checkout__tab-pill c-checkout__tab-pill--sfl  js-cart-tab" data-type="sfl">
            لیست خرید بعدی
            <span class="c-checkout__tab-counter">
            {{ persianNum($second_carts->count()) }}
          </span>
          </div>
        </div>
        <div id="cart-data" class="o-page__row">
          <div class="js-cart-tab-main c-checkout__tab-container--full-width ">
            <div class="c-checkout__tab-container">
              @if (!is_null($first_carts) && count($first_carts))
                <?php $has_changed = false; ?>
                @foreach ($first_carts as $item)
                    @if (defualtCartOldPrice($item) !== defualtCartNewPrice($item))
                      @php $has_changed = true; @endphp
                    @endif
                @endforeach
                <section class=" {{ (auth()->guard('customer')->check())? 'c-checkout-empty__container' : 'o-page__content    ' }}  ">
                  @if ($has_changed == true)
                    <div class="c-message-light-small c-message-light-small--info c-message-light-small--cart">
                      <h6>توجه : قیمت یا موجودی بعضی از کالاهای سبد خرید شما تغییر کرده است:</h6>
                      <ul>
                        @foreach ($first_carts as $item)
                          @if (defualtCartOldPrice($item) !== defualtCartNewPrice($item))
                            <li>قیمت {{ $item->product_variant()->first()->product->title_fa }} به {{ persianNum(number_format(toman(defualtCartNewPrice($item)))) }} تومان تغییر کرده است.</li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  @endif
                  <div class="c-checkout js-checkout">
                    <div class="c-checkout__group">
                      <ul class="c-checkout__items">

                        @foreach($first_carts as $cart)
                          <?php
                            $product = $cart->product_variant()->first()->product;
                            $product_variant = $cart->product_variant()->first();
                            $has_count = ($cart->product_variant()->first()->stock_count) ? true : false;
                          ?>
                          <li class="c-checkout__item">
                            <div class="c-cart-item" data-price-change="0" data-min-price-badge="">
                              <div class="c-cart-item__thumb">
                                <a class="c-cart-item__thumb-img {{ (!$has_count)? 'c-cart-item__thumb--inactive' : '' }}" href="{{ route('front.productPage', $product->product_code) }}" target="_blank">
                                  @foreach($product->media as $image)
                                    @if($product->media && ($image->pivot->is_main == 1))
                                      <img alt="{{ $product->title_fa }}" src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60">
                                    @endif
                                  @endforeach
                                </a>
                              </div>
                              <div class="c-cart-item__data">

                                @if ($has_count)
                                  @if (defualtCartOldPrice($cart) !== defualtCartNewPrice($cart))
                                    @if (defualtCartOldPrice($cart) > defualtCartNewPrice($cart))
                                      <div class="c-cart-notification c-cart-notification--success c-cart-notification--arrow-down">
                                        قیمت این کالا {{ persianNum(number_format(toman(defualtCartOldPrice($cart) - defualtCartNewPrice($cart)))) }} تومان کاهش یافته است.
                                      </div>
                                    @else
                                      <div class="c-cart-notification c-cart-notification--warning c-cart-notification--arrow-up">
                                        قیمت این کالا {{ persianNum(number_format(toman(defualtCartNewPrice($cart) - defualtCartOldPrice($cart)))) }} تومان افزایش یافته است.
                                      </div>
                                    @endif
                                  @endif
                                @endif

                                @if (!$has_count)
                                  <div class="c-cart-item__product-notice-container">
                                    <div class="c-cart-notification c-cart-notification--error c-cart-notification--info">
                                      کالا ناموجود شده و به صورت خودکار از سبد حذف می‌شود.
                                    </div>
                                  </div>
                                @endif

                                <div class="c-cart-item__title {{ (!$has_count)? 'c-cart-item__title--inactive' : '' }}">
                                  {{ $product->title_fa }}
                                </div>

                                @if (!is_null($cart->product_variant()->first()->variant->value))
                                  <div class="c-cart-item__product-data c-cart-item__product-data--color {{ (!$has_count)? 'c-cart-item__product-data--inactive' : '' }}">
                                  <span style="background-color:{{ $cart->product_variant()->first()->variant->value }};"></span>
                                    {{ $cart->product_variant()->first()->variant->name }}
                                  </div>
                                @else
                                  <div class="c-cart-item__product-data c-cart-item__product-data--size {{ (!$has_count)? 'c-cart-item__product-data--inactive' : '' }}">
                                    {{ $cart->product_variant()->first()->variant->name }}
                                  </div>
                                @endif

                                <div class="c-cart-item__product-data c-cart-item__product-data--warranty {{ (!$has_count)? 'c-cart-item__product-data--inactive' : '' }}">
                                  {{ $cart->product_variant()->first()->warranty->name }}
                                </div>

                                @if ($has_count)
                                  <div class="c-cart-item__product-data c-cart-item__product-data--no-lead-time">
                                    موجود در انبار {{ $fa_store_name }}
                                    <span class="c-cart-item__product-sender-row">
                                      <span class="c-cart-item__product-sender-item c-cart-item__product-sender-item--digikala-no-leadtime">
                                          ارسال {{ $fa_store_name }} از {{ persianNum($cart->product_variant()->first()->post_time) }} روز کاری دیگر
                                      </span>
                                    </span>
                                  </div>
                                @endif


                                @if (!is_null($cart->new_promotion_price) && (($cart->new_sale_price - $cart->new_promotion_price) > 0) && $has_count)
                                  <div class="c-cart-item__discount">
                                    تخفیف
                                    <span>
                                      {{ persianNum(number_format(toman($cart->new_sale_price - $cart->new_promotion_price))) }}
                                    </span>
                                    تومان
                                  </div>
                                @endif

                                <div class="c-cart-item__spacer"></div>
                                @if ($has_count)
                                  <div class="c-cart-item__price-row">
                                    <div class="c-cart-item__quantity-row">
                                      <div class="c-quantity-selector ">
                                        @if ($cart->product_variant()->first()->max_order_count < $cart->product_variant()->first()->stock_count)
                                          @php $max_count = $cart->product_variant()->first()->max_order_count @endphp
                                        @else
                                          @php $max_count = $cart->product_variant()->first()->stock_count @endphp
                                        @endif
                                        <button type="button" class="c-quantity-selector__add js-quantity-selector-add {{ ($cart->count == $max_count)? 'c-quantity-selector__add--disabled' : '' }}"></button>
                                        <div class="c-quantity-selector__number js-quantity-selector-count" data-max="{{ ($cart->product_variant()->first()->max_order_count < $cart->product_variant()->first()->stock_count)? $cart->product_variant()->first()->max_order_count : $cart->product_variant()->first()->stock_count }}" data-id="{{ $cart->product_variant()->first()->id }}">
                                          {{ persianNum($cart->count) }}
                                        </div>
                                        <button type="button" class="c-quantity-selector__remove {{ ($cart->count == 1)? 'c-quantity-selector__add--disabled' : '' }} js-quantity-selector-remove"></button>
                                      </div>

                                      <a class="c-cart-item__delete js-remove-from-cart"
                                         href="/cart/remove/{{ $cart->product_variant()->first()->id }}/"
                                         data-id="{{ $cart->product_variant()->first()->id }}"
                                         data-product="{{ $cart->product_variant()->first()->product->id }}"
                                         data-variant="{{ $cart->product_variant()->first()->id }}"
                                         data-event="remove_from_cart"
                                      >
                                        حذف
                                      </a>
                                      <a class="c-cart-item__save-for-later js-add-to-sfl"
                                         data-id="{{ $cart->product_variant()->first()->id }}"
                                         data-product="{{ $cart->product_variant()->first()->product->id }}"
                                         data-variant="{{ $cart->product_variant()->first()->id }}"
                                      >
                                        ذخیره در لیست خرید بعدی
                                      </a>
                                    </div>
                                    <div class="c-cart-item__product-price">
                                      {{ persianNum(number_format(toman(defualtCartNewPrice($cart)))) }}
                                      <span>
                                    تومان
                                    </span>
                                    </div>
                                  </div>
                                @endif

                                @if (!$has_count)
                                  <div class="c-cart-item__price-row">
                                    <div class="c-cart-item__inactive-text">
                                      ناموجود
                                    </div>
                                  </div>
                                @endif

                                @if ($product_variant->stock_count == 1)
                                  <div class="c-cart-item__price-row">
                                    <div>
                                      <div class="c-cart-item__stock-info js-product-warehouse-stock">
                                        <span>
                                            ۱                                           عدد در انبار باقیست - پیش از اتمام بخرید
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                @endif


                              </div>
                            </div>
                          </li>
                        @endforeach

                      </ul>
                    </div>
                  </div>
                </section>

                <aside class="o-page__aside">
                  <div class="c-checkout-aside js-checkout-aside ">
                    <div class="c-checkout-bill">
                      <ul class="c-checkout-bill__summary">

                        <li>
                          <span class="c-checkout-bill__item-title">
                              قیمت کالاها({{ persianNum($first_carts->sum('count')) }})
                          </span>
                          <span class="c-checkout-bill__price">
                            <?php $sum_sale_price = 0; ?>
                            @foreach($first_carts as $priceItem)
                              <?php $sum_sale_price += ($priceItem->new_sale_price * $priceItem->count); ?>
                            @endforeach
                            {{ persianNum(number_format(toman($sum_sale_price))) }}
                            <span class="c-checkout-bill__currency">
                              تومان
                            </span>
                          </span>
                        </li>

                        @if($first_carts->sum('new_promotion_price') > 0)

                          <?php $sum_promotion_price = 0; ?>
                          @foreach($first_carts as $priceItem)
                            @if ($priceItem->new_sale_price > $priceItem->new_promotion_price)
                              <?php $sum_promotion_price += (($priceItem->new_sale_price - $priceItem->new_promotion_price) * $priceItem->count); ?>
                            @endif
                          @endforeach

                          <li>
                            <span class="c-checkout-bill__item-title">
                                تخفیف کالاها
                            </span>
                            <span class="c-checkout-bill__price c-checkout-bill__price--discount">
                              <span>
                                ({{ persianNum(number_format(($sum_promotion_price / $sum_sale_price) * 100)) }}٪)
                              </span>
                               {{ persianNum(number_format(toman($sum_promotion_price))) }}
                              <span class="c-checkout-bill__currency">
                                 تومان
                              </span>
                            </span>
                          </li>
                        @endif

                        <li class="c-checkout-bill__sum-price">
                          <span class="c-checkout-bill__item-title"> جمع سبد خرید </span>
                            <span class="c-checkout-bill__price">
                              @if (isset($sum_promotion_price))
                                {{ persianNum(number_format(toman($sum_sale_price - $sum_promotion_price))) }}
                              @else
                                {{ persianNum(number_format(toman($sum_sale_price))) }}
                              @endif
                            <span class="c-checkout-bill__currency">تومان</span>
                          </span>
                        </li>

                        <li class="c-checkout-bill__additional-shipping-cost">
                          هزینه‌ی ارسال در ادامه بر اساس آدرس، زمان و
                          نحوه‌ی ارسال انتخابی شما‌ محاسبه و به این مبلغ اضافه خواهد شد
                        </li>
                        <li class="c-checkout-bill__to-forward-button">
                          <a href="/shipping/"
                             class="o-btn o-btn--full-width o-btn--contained-red-lg selenium-next-step-shipping">
                            ادامه فرآیند خرید
                          </a>
                        </li>
                      </ul>
                    </div>
                    <p class="c-checkout-bill__reserve-note">
                      کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش مراحل بعدی را تکمیل کنید.
                    </p>
                  </div>
                </aside>
              @else
                <div class="c-tab-checkout-empty">
                  <div class="c-tab-checkout-empty__cart">
                    <section class="{{ (auth()->guard('customer')->check())? 'c-checkout-empty__container' : 'o-page__content    ' }}">
                      <div class="c-checkout-empty">
                        <div class="c-checkout-empty__empty-cart-icon"></div>
                        <div class="c-checkout-empty__title">
                          سبد خرید شما خالی است!
                        </div>
                        <div class="c-checkout-empty__links"><p>
                            می‌توانید برای مشاهده محصولات بیشتر به صفحه زیر بروید
                          </p>
                          <div class="c-checkout-empty__link-urls">
                            <a href="{{ route('front.indexPage') }}">
                              صفحه اصلی
                            </a>
                          </div>
                        </div>
                      </div>
                    </section>
                    @if (!auth()->guard('customer')->check())
                      <aside class="o-page__aside">
                        <a href="{{ route('customer.regLoginPage') }}">
                          <div class="c-checkout-aside c-checkout-aside--login">
                            <div class="c-checkout-aside__login-header">
                              ورود به حساب کاربری
                            </div>
                            <div class="c-checkout-aside__login-dsc">
                              برای مشاهده محصولاتی که پیش‌تر به سبد خود اضافه کرده‌اید لطفا وارد شوید.
                            </div>
                          </div>
                        </a>
                      </aside>
                    @endif
                  </div>
                </div>
              @endif
            </div>
          </div>
          <div class="c-checkout__tab-container js-cart-tab-sfl u-hidden">
            @if (is_null($second_carts) || !count($second_carts))
            <section class="c-checkout-empty__container">
              <div class="c-checkout-empty">
                <div class="c-checkout-empty__empty-sfl-icon"></div>
                <div class="c-checkout-empty__title">
                  لیست خرید بعدی شما خالی است!
                </div>
                <p class="c-checkout-empty__sfl-content">
                  شما می‌توانید محصولاتی که به سبد خرید خود افزوده‌اید
                  و فعلا قصد خرید آن‌ها را ندارید، در لیست خرید بعدی قرار داده
                  و هر زمان مایل بودید آن‌ها را به سبد خرید اضافه کرده و خرید آن‌ها را تکمیل کنید.
                </p>
              </div>
            </section>
            @else
              <?php $second_has_changed = false; ?>
              @foreach ($second_carts as $item)
                @if (defualtCartOldPrice($item) !== defualtCartNewPrice($item))
                  @php $second_has_changed = true; @endphp
                @endif
              @endforeach

              <section class=" {{ (auth()->guard('customer')->check())? 'c-checkout-empty__container' : 'o-page__content    ' }}  ">
                @if ($second_has_changed == true)
                  <div class="c-message-light-small c-message-light-small--info c-message-light-small--cart">
                    <h6>توجه : قیمت یا موجودی بعضی از کالاهای سبد خرید شما تغییر کرده است:</h6>
                    <ul>
                      @foreach ($second_carts as $item)
                        @if (defualtCartOldPrice($item) !== defualtCartNewPrice($item))
                          <li>قیمت {{ $item->product_variant()->first()->product->title_fa }} به {{ persianNum(number_format(toman(defualtCartNewPrice($item)))) }} تومان تغییر کرده است.</li>
                        @endif
                      @endforeach
                    </ul>
                  </div>
                @endif
                <div class="c-checkout js-checkout">
                  <div class="c-checkout__group">
                    <ul class="c-checkout__items">

                      @foreach($second_carts as $cart)
                        <?php
                          $product = $cart->product_variant()->first()->product;
                          $product_variant = $cart->product_variant()->first();
                          $has_count = ($cart->product_variant()->first()->stock_count) ? true : false;
                        ?>
                        <li class="c-checkout__item">
                          <div class="c-cart-item" data-price-change="0" data-min-price-badge="">
                            <div class="c-cart-item__thumb">
                              <a class="c-cart-item__thumb-img" href="{{ route('front.productPage', $product->product_code) }}" target="_blank">
                                @foreach($product->media as $image)
                                  @if($product->media && ($image->pivot->is_main == 1))
                                    <img alt="{{ $product->title_fa }}" src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60">
                                  @endif
                                @endforeach
                              </a>
                            </div>
                            <div class="c-cart-item__data">
                              @if ($has_count)
                                <?php
                                  $defualtCartOldPrice = defualtCartOldPrice($cart);
                                  $defualtCartNewPrice = defualtCartNewPrice($cart);
                                ?>
                                @if ($defualtCartOldPrice !== $defualtCartNewPrice)
                                  @if ($defualtCartOldPrice < $defualtCartNewPrice)
                                    <div class="c-cart-notification c-cart-notification--success c-cart-notification--arrow-down">
                                      قیمت این کالا {{ persianNum(number_format(toman($defualtCartOldPrice - $defualtCartNewPrice))) }} تومان کاهش یافته است.
                                    </div>
                                  @else
                                    <div class="c-cart-notification c-cart-notification--warning c-cart-notification--arrow-up">
                                      قیمت این کالا {{ persianNum(number_format(toman($defualtCartNewPrice - $defualtCartOldPrice))) }} تومان افزایش یافته است.
                                    </div>
                                  @endif
                                @endif
                              @endif

                              @if (!$has_count)
                                <div class="c-cart-item__product-notice-container">
                                  <div class="c-cart-notification c-cart-notification--error c-cart-notification--info">
                                    موجودی این کالا پایان یافته است.
                                  </div>
                                </div>
                              @endif

                              <div class="c-cart-item__title">
                                {{ $product->title_fa }}
                              </div>

                              @if (!is_null($cart->product_variant()->first()->variant->value))
                                <div class="c-cart-item__product-data c-cart-item__product-data--color {{ (!$has_count)? 'c-cart-item__product-data--inactive' : '' }}">
                                  <span style="background-color:{{ $cart->product_variant()->first()->variant->value }};"></span>
                                  {{ $cart->product_variant()->first()->variant->name }}
                                </div>
                              @else
                                <div class="c-cart-item__product-data c-cart-item__product-data--size">
                                  {{ $cart->product_variant()->first()->variant->name }}
                                </div>
                              @endif

                              <div class="c-cart-item__product-data c-cart-item__product-data--warranty">
                                {{ $cart->product_variant()->first()->warranty->name }}
                              </div>

                              @if ($has_count)
                                <div class="c-cart-item__product-data c-cart-item__product-data--no-lead-time">
                                  موجود در انبار {{ $fa_store_name }}
                                </div>
                              @endif


                              @if (!is_null($cart->new_promotion_price) && (($cart->new_sale_price - $cart->new_promotion_price) > 0) && $has_count)
                                <div class="c-cart-item__discount">
                                  تخفیف
                                  <span>
                                      {{ persianNum(number_format(toman($cart->new_sale_price - $cart->new_promotion_price))) }}
                                    </span>
                                  تومان
                                </div>
                              @endif

                              <div class="c-cart-item__spacer"></div>
                              @if ($has_count)
                                <div class="c-cart-item__price-row">
                                  <div class="c-cart-item__sfl-row">
                                    <a class="c-cart-item__move-to-cart js-add-to-cart-from-sfl" data-variant-id="{{ $product_variant->id }}">
                                      افزودن به سبد خرید
                                    </a>
                                      <a class="c-cart-item__delete js-remove-from-save"
                                         href="/ajax/save-for-later/variant/remove/{{ $product_variant->id }}/"
                                         data-id="{{ $product_variant->id }}"
                                         data-product="{{ $product->id }}"
                                         data-variant="{{ $product_variant->id }}"
                                         data-event="remove_from_cart"
                                      >
                                          حذف محصول
                                      </a>
                                  </div>
                                  <div class="c-cart-item__product-price">
                                    {{ persianNum(number_format(toman(defualtCartNewPrice($cart)))) }}
                                    <span>
                                    تومان
                                    </span>
                                  </div>
                                </div>
                              @endif

                              @if (!$has_count)
                                <div class="c-cart-item__price-row">
                                  <div class="c-cart-item__sfl-row">
                                    <a class="c-cart-item__remove-from-sfl js-remove-from-save" data-event="remove_from_cart" data-evnet-category="funnel" data-product-id="{{ $product->id }}" data-variant-id="{{ $product_variant->id }}" data-token="" style="padding-right: 0px !important;">حذف محصول</a>
                                  </div>
                                  <div class="c-cart-item__inactive-text">
                                    ناموجود
                                  </div>
                                </div>
                              @endif

                              @if ($product_variant->stock_count == 1)
                                <div class="c-cart-item__price-row">
                                  <div>
                                    <div class="c-cart-item__stock-info js-product-warehouse-stock">
                                        <span>
                                            ۱                                           عدد در انبار باقیست - پیش از اتمام بخرید
                                        </span>
                                    </div>
                                  </div>
                                </div>
                              @endif


                            </div>
                          </div>
                        </li>
                      @endforeach

                    </ul>
                  </div>
                </div>
              </section>

              <aside class="o-page__aside">
                  <div class="c-checkout-aside">
                    <div class="c-checkout-summary c-checkout-summary--sfl"
{{--                           data-gtm-vis-recent-on-screen-9070001_92="1885"--}}
{{--                           data-gtm-vis-first-on-screen-9070001_92="1885"--}}
{{--                           data-gtm-vis-total-visible-time-9070001_92="100"--}}
{{--                           data-gtm-vis-has-fired-9070001_92="1"--}}
                    >
                      <header>
                        لیست خرید بعدی چیست؟
                      </header>
                      <p>
                        شما می‌توانید محصولاتی که به سبد خرید
                        خود افزوده اید و موقتا قصد خرید آن‌ها را ندارید، در لیست خرید بعدی خود قرار داده و
                        هر زمان مایل بودید آن‌ها را مجدداً به سبد خرید اضافه کرده و خرید آن‌ها را تکمیل کنید.
                      </p>
                      <div class="c-checkout-summary__sfl-count-info">
                        <span>
                            {{ persianNum($second_carts->count()) }} کالا
                        </span>
                        در لیست خرید بعدی شماست
                      </div>
                      <button class="c-checkout-summary__sfl-add-all-button js-move-all-from-sfl-to-cart">
                        افزودن همه به سبد خرید
                      </button>
                    </div>
                  </div>
                </aside>

            @endif

            @if (!auth()->guard('customer')->check())
              <aside class="o-page__aside">
                <a href="{{ route('customer.regLoginPage') }}">
                  <div class="c-checkout-aside c-checkout-aside--login">
                    <div class="c-checkout-aside__login-header">
                      ورود به حساب کاربری
                    </div>
                    <div class="c-checkout-aside__login-dsc">
                      برای مشاهده محصولاتی که پیش‌تر به سبد خود اضافه کرده‌اید لطفا وارد شوید.
                    </div>
                  </div>
                </a>
              </aside>
            @endif

          </div>
        </div>
      </div>
    </section>
  </div>
</main>

@endsection

@section('source')
<div class="remodal-wrapper remodal-is-closed" style="display: none;">
  <div class="remodal c-remodal-general-alert remodal-is-initialized remodal-is-closed" data-remodal-id="alert" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc" tabindex="-1">
    <div class="c-remodal-general-alert__main">
      <div class="c-remodal-general-alert__content">
        <p class="js-remodal-general-alert__text">آیا مایل به حذف این کالا هستید؟</p>
        <p class="c-remodal-general-alert__description js-remodal-general-alert__description" style="display: none;"></p>
      </div>
      <div class="c-remodal-general-alert__actions">
        <button class="c-remodal-general-alert__button c-remodal-general-alert__button--approve js-remodal-general-alert__button--approve">
          انتقال به لیست خرید بعدی
        </button>
        <button class="c-remodal-general-alert__button c-remodal-general-alert__button--cancel js-remodal-general-alert__button--cancel">
          حذف
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  $("body").addClass('c-checkout-pages');
  $("body").removeClass('has-top-banner');
</script>
@endsection

