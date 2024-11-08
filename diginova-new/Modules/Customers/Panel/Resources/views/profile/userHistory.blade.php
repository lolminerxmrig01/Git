@extends('layouts.customer.master')
@section('head')
<script>
  var supernova_mode = "production";
  var supernova_tracker_url = "https:\/\/etrackerd.digikala.com\/tracker\/events\/";
  var activeMenu = "userHistory";
  var faqPageTitle = "profile_section";
  var skipWalletRequest = true;
  var userId = 9735394;
  var adroRCActivation = true;
  var loginRegisterUrlWithBack = "\/users\/login-register\/?_back=https:\/\/www.digikala.com\/profile\/user-history\/";
  var isNewCustomer = false;
  var digiclubLuckyDrawEndTime = "2021-06-27 15:30:28";
  var activateUrl = "\/digiclub\/activate\/";
</script>
@endsection
@section('o-page__content')
<section class="o-page__content">
    <div class="o-box c-profile-user-history">
      <div class="o-box__header">
        <span class="o-box__title">بازدید‌های اخیر</span>
      </div>
      <ul class="c-profile-user-history__listing">
        @foreach($customer->histories as $history)
          <li class="c-profile-user-history__list-item js-history-container ">
          <div class="c-profile-user-history__list-item-thumb">
            <a href="{{ route('front.productPage', $history->product->product_code) }}" class="c-profile-user-history__list-item-img" target="_blank">
              @foreach($history->product->media as $image)
                @if($history->product->media && ($image->pivot->is_main == 1))
                  <img data-src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60" alt="{{ $history->product->title_fa }}" src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60" loading="lazy">
                @endif
              @endforeach
            </a>
          </div>
          <div class="c-profile-user-history__list-item-content">
            <div class="c-profile-user-history__list-item-content__container">
              <a href="{{ route('front.productPage', $history->product->product_code) }}" target="_blank">
                <h4>{{ $history->product->title_fa }}</h4>
              </a>
              <div class="c-ui-more">
                <div class="o-btn o-btn--icon-gray-md o-btn--l-more js-ui-see-more"></div>
                <div class="c-ui-more__options js-ui-more-options">
                  <div class="c-ui-more__option c-ui-more__option--red js-remove-item-profile-history" data-product-id="{{ $history->product->product_code }}">
                    حذف
                  </div>
                </div>
              </div>
            </div>
            <div class="c-profile-user-history__list-item-content__container">
              <div class="c-new-price">
                <?php
                  $variant_defualt = variant_defualt($history->product);
                ?>
                <div class="c-new-price__old-value">
                  @if (!is_null($variant_defualt) && $variant_defualt->promotions()->exists() && $variant_defualt->promotions()->min('promotion_price') < $variant_defualt->sale_price)
                  <del>{{ persianNum(number_format(toman($variant_defualt->sale_price))) }}</del>
                  <span class="c-new-price__discount">{{ persianNum(round(100 - (product_price($history->product)/(variant_defualt($history->product)->sale_price/100)))) }}٪</span>
                  @endif
                </div>
                <div class="c-new-price__value">
                  @if (!is_null($variant_defualt))
                    {{ persianNum(number_format(toman(product_price($history->product)))) }}
                    <span class="c-new-price__toman-icon"></span>
                  @endif
                </div>
              </div>
{{--              <div class="c-profile-user-history__list-item-button-group">--}}
{{--                <a class="o-btn o-btn--outlined-blue-md js-history-same-product-modal" data-product-id="1492772">--}}
{{--                  کالاهای مشابه--}}
{{--                </a>--}}
{{--              </div>--}}
            </div>
          </div>
        </li>
        @endforeach
      </ul>
      <div class="c-pager"></div>
    </div>
  </section>
@endsection
