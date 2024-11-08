@extends('layouts.customer.master')
@section('head')
  <script>
    var supernova_mode = "production";
    var supernova_tracker_url = "https:\/\/etrackerd.digikala.com\/tracker\/events\/";
    var activeMenu = "favorites";
    var faqPageTitle = "profile_section";
    var skipWalletRequest = true;
    var userId = 9735394;
    var adroRCActivation = true;
    var loginRegisterUrlWithBack = "\/users\/login-register\/?_back=https:\/\/www.digikala.com\/profile\/favorites\/";
    var isNewCustomer = false;
    var digiclubLuckyDrawEndTime = "2021-06-27 15:30:28";
    var activateUrl = "\/digiclub\/activate\/";
  </script>
@endsection
@section('o-page__content')
<section class="o-page__content">
    <div class="c-profile-list">
      <div class="o-box__tabs">
        <div class="o-box__tab js-ui-tab-pill is-active" data-tab-pill-id="favorites" data-current-page="1">
          کالاهای موردعلاقه
        </div>
{{--        <div class="o-box__tab js-ui-tab-pill " data-tab-pill-id="observed" data-current-page="1">--}}
{{--          اطلاع‌رسانی‌ها--}}
{{--        </div>--}}
      </div>

      <div class="c-profile-list__content js-ui-tab-content " data-tab-content-id="favorites">
        @if ($customer->favorites()->exists())
          <div class="c-profile-list__container">
            @foreach($customer->favorites as $item)
              <div class="c-profile-list__item-cart js-favorite-container">
                <div class="c-profile-list__item-card-thumb">
                  <a href="{{ route('front.productPage', $item->product->product_code) }}" target="_blank">
                    @foreach($item->product->media as $image)
                      @if($item->product->media && ($image->pivot->is_main == 1))
                        <img src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_fill,h_150,w_150/quality,q_60" alt="{{ $item->product->title_fa }}">
                      @endif
                    @endforeach
                  </a>
                </div>
                <div class="c-profile-list__item-card-content">
                  <div class="c-profile-list__item-card-title">
                    <a href="{{ route('front.productPage', $item->product->product_code) }}" target="_blank">
                      {{ substrwords($item->product->title_fa, 75) }}
                    </a>
                    <div class="c-ui-more">
                      <div class="o-btn o-btn--icon-gray-md o-btn--l-more js-ui-see-more"></div>
                      <div class="c-ui-more__options js-ui-more-options">
                        <div class="c-ui-more__option c-ui-more__option--red js-remove-favorite-btn" data-product-id="{{ $item->product->product_code }}">حذف کالا</div>
                      </div>
                    </div>
                  </div>
                  <div class="c-profile-list__item-cart-price">
                    <div class="c-new-price">
                      @if ($item->product->variants()->exists() && variant_defualt($item->product)->sale_price > product_price($item->product))
                      <div class="c-new-price__old-value">
                        <del>{{ ($item->product->variants()->exists())? persianNum(number_format(toman(variant_defualt($item->product)->sale_price))) : '' }}</del>
                        <span class="c-new-price__discount">
                          {{ ($item->product->variants()->exists())? persianNum(round(100 - (product_price($item->product)/(variant_defualt($item->product)->sale_price/100)))) : '' }}٪
                        </span>
                      </div>
                      @endif
                      <div class="c-new-price__value">
                        {{ ($item->product->variants()->exists())? persianNum(number_format(toman(product_price($item->product)))) : '' }}
                        @if ($item->product->variants()->exists())
                          <span class="c-new-price__currency">تومان</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <a href="{{ route('front.productPage', $item->product->product_code) }}" target="_blank" class="c-profile-list__item-cart-link">مشاهده محصول</a>
                </div>
              </div>
            @endforeach
          </div>
          <div class="c-pager"></div>
        @else
          <div class="c-profile-list__empty-container">
            <img src="https://www.digikala.com/static/files/363d4676.svg" alt="لیست علاقه‌مندی‌های شما خالی است.">
            <p>
              لیست علاقه‌مندی‌های شما خالی است.
            </p>
          </div>
        @endif
      </div>



{{--      <div class="c-profile-list__content js-ui-tab-content u-hidden" data-tab-content-id="observed">--}}
{{--        <div class="c-profile-list__container">--}}
{{--          <div class="c-profile-list__item-cart js-notifier-container">--}}
{{--            <div class="c-profile-list__item-card-thumb"><a--}}
{{--                href="/product/dkp-1065482/%DA%A9%D9%81%D8%B4-%D9%86%D9%88%D8%B2%D8%A7%D8%AF%DB%8C-%DA%A9%D8%A7%D8%B1%D8%A7%D9%85%D9%84-%D9%85%D8%AF%D9%84-67793"--}}
{{--                target="_blank"><img--}}
{{--                  src="https://dkstatics-public.digikala.com/digikala-products/5039995.jpg?x-oss-process=image/resize,m_fill,h_150,w_150/quality,q_60"--}}
{{--                  alt="کفش نوزادی کارامل مدل 67793"></a></div>--}}
{{--            <div class="c-profile-list__item-card-content">--}}
{{--              <div class="c-profile-list__item-card-title"><a--}}
{{--                  href="/product/dkp-1065482/%DA%A9%D9%81%D8%B4-%D9%86%D9%88%D8%B2%D8%A7%D8%AF%DB%8C-%DA%A9%D8%A7%D8%B1%D8%A7%D9%85%D9%84-%D9%85%D8%AF%D9%84-67793"--}}
{{--                  target="_blank">--}}
{{--                  کفش نوزادی کارامل مدل 67793--}}
{{--                </a>--}}
{{--                <div class="c-ui-more">--}}
{{--                  <div class="o-btn o-btn--icon-gray-lg o-btn--l-more js-ui-see-more"></div>--}}
{{--                  <div class="c-ui-more__options js-ui-more-options">--}}
{{--                    <div class="c-ui-more__option js-remove-observation-btn" data-observed-product-id="32710014"--}}
{{--                         data-token="">--}}
{{--                      حذف اطلاع رسانی--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="c-profile-list__item-notification-type">--}}
{{--                موجود شدن--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="c-pager"></div>--}}
{{--      </div>--}}


    </div>
  </section>
@endsection

@section('page-content')
@endsection
