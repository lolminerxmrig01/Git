<?php
    // meta keywords
    if ($product->seo()->exists() &&  $product->seo->keyword) {
        $keywords_array = json_decode($product->seo->keyword, true);
        $keywords = [];
        foreach ($keywords_array as $keyword) {
            $keywords[] = $keyword['value'];
        }
    }

    $product_variants = $product->variants()
        ->where('stock_count', '>', 0)
        ->whereStatus(1)
        ->get();

    $variantGroup = $product->categories()
        ->first()
        ->variantGroup()
        ->first();
?>
@extends('layouts.front.master')

@section('head')
  <title>{{ $product_title_prefix . ' ' . $product->title_fa . '  '  }}</title>
  <!-- SEO -->
  <meta name="description" content="{{ $product->seo()->exists() ? $product->seo->description : '' }}"/>
  <meta name="keywords" content="{{ isset($keywords) ? implode(', ', $keywords) : '' }}"/>
  <link rel="canonical" href="{{ route('front.productPage', ['product_code' => $product->product_code]) }}"/>

  @include('front::layouts.product.head-script', compact('product','product_variants', 'variantGroup'))

  <script src="{{ asset('assets/js/sentry.js') }}"></script>
  <script src="{{ asset('assets/js/jwplayer.js') }} "></script>
  <script src="{{ asset('assets/js/jwpsrv.js') }} "></script>
  <script src="{{ asset('assets/js/jwplayer.core.controls.js') }} "></script>
  <script src="{{ asset('assets/js/jwplayer.core.controls.html5.js') }} "></script>
  <script src="{{ asset('assets/js/provider.hlsjs.js') }} "></script>
  <script src="{{ asset('assets/js/video-js.min.js') }} "></script>
  <script src="{{ asset('assets/js/videojs-contrib-quality-levels.min.js') }} "></script>
  <script src="{{ asset('assets/js/videojs-hls-quality-selector.min.js') }} "></script>
  <script src="{{ asset('assets/js/url.min.js') }}"></script>

  <style>
      body {
        background-color: #fff !important;
      }

      .dislike-style.is-active {
        color: #ee434e !important;
      }
  </style>
@endsection

@section('content')
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
  </style>

  <main id="main">
    <div id="HomePageTopBanner"></div>
    <div id="content">
      <div class="o-page js-product-page c-product-page" data-product-id="{{ $product->id }}">
        <div class="container">
          <div class="c-product__nav-container">
            <nav class="js-breadcrumb ">
              <ul vocab="https://schema.org/" typeof="BreadcrumbList" class="c-breadcrumb">
                <li property="itemListElement" typeof="ListItem">
                  <a property="item" typeof="WebPage" href="/">
                    <span property="name">{{ $fa_store_name }}</span>
                  </a>
                  <meta property="position" content="1">
                </li>
                @foreach($product_categories as $key => $item)
                  <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="{{ route('front.categoryPage', $item->slug) }}">
                      <span property="name">{{ $item->name }}</span>
                    </a>
                    <meta property="position" content="{{ $key+1 }}">
                  </li>
                @endforeach
                <li>
                  <span property="name">{{ $product->title_fa }}</span>
                </li>
              </ul>
            </nav>
            <div class="c-product__ext-links"></div>
          </div>


          <article data-product-id="{{ $product->id }}" class="c-product js-product">
            <section class="c-product__info">
              <div class="c-product__title-container">
                <div>
                  <div class="u-flex u-items-center">
                    <div class="c-product__title-container--brand">
                      <a class="c-product__title-container--brand-link" href="">
                        {{ ($product->brand()->exists())? $product->brand->name : 'متفرقه' }}
                      </a>
                      <span> / </span>
                      <a class="c-product__title-container--brand-link"
                         href="">{{  $product->category->first()->name . ' ' }} {{ ($product->brand()->exists())? $product->brand->name : 'متفرقه' }}
                      </a>
                    </div>
                  </div>
                  <h1 class="c-product__title">
                    {{ $product->title_fa }}
                  </h1>
                </div>
              </div>
              <div class="c-product__attributes js-product-attributes u-relative">
                <div id="zoom-box"></div>
                <div class="c-product__config">
                  @if(!is_null($product->title_en))
                    <span class="c-product__title-en">{{ $product->title_en }}</span>
                  @endif
                  <div class="c-product__engagement">
                    <div class="c-product__engagement-item js-scroll-to-tab" data-id="comments"
                         data-gtm-vis-first-on-screen-9070001_346="7756"
                         data-gtm-vis-total-visible-time-9070001_346="100" data-gtm-vis-has-fired-9070001_346="1">
                      <div class="c-product__engagement-link" data-activate-tab="comments">
                        {{ persianNum($product->comments->count()) }}
                        دیدگاه کاربران
                      </div>
                    </div>
                  </div>

                  <div class="c-product__config-wrapper">

                      @if ($product->variants()->exists()
                          && $product->categories()->first()->variantGroup()->exists()
                          && $product->categories()->first()->variantGroup->first()->type == 2)
                          <div class="c-product__circle-variants">
                              <div class="c-product__circle-variants__title">
                                  <header>رنگ :</header>
                                  <span class="js-color-title"></span>
                              </div>
                              <ul class="js-product-variants">
                                  @foreach($variant_ids as $id)
                                      <?php $variant = \Modules\Staff\Variant\Models\Variant::find($id); ?>
                                      <li class="js-c-ui-variant c-circle-variant__item" data-event="config_change"
                                          data-event-category="product_page" data-event-label="change: color">
                                          <label class="js-circle-variant-color c-circle-variant c-circle-variant--color"
                                                 data-code="{{ $variant->value }}" data-snt-event="dkProductPageClick"
                                                 data-snt-params='{"item":"change-color","item_option":"{{ $variant->name }}"}'>
                                              <input class="js-variant-selector js-color-filter-item"
                                                     data-title="{{ $variant->name }}" data-type="color" id="variant" name="color"
                                                     type="radio"
                                                     value="{{ $variant->id }}" {{ ($variant_defualt->variant->id == $id)? 'checked' : '' }}>
                                              <span class="c-circle-variant__border"></span>
                                              <span
                                                  class="c-tooltip c-tooltip--small-bottom c-tooltip--short">{{ $variant->name }}</span>
                                              <span class="c-circle-variant__shape" style="background-color: {{ $variant->value }}"></span>
                                          </label>
                                      </li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif


                  @if ($product->variants()->exists()
                      && $product->categories()->first()->variantGroup()->exists()
                      && $product->categories()->first()->variantGroup->first()->type == 1)
                        <div class="c-product__size-wrapper">
                            <div class="c-product__size-label">
                                اندازه :
                            </div>
                            <div class="c-product__product-size-wrapper">
                                <div class="selectric-wrapper selectric-c-product__size-dropdown
                             selectric-js-size-selector selectric-js-variant-selector">
                                    <select class="c-product__size-dropdown js-size-selector js-variant-selector " data-type="size" name="size">
                                        @foreach($variant_ids as $id)
                                            <?php $variant = \Modules\Staff\Variant\Models\Variant::find($id); ?>
                                            <option value="{{ $variant->id }}"  {{ ($variant_defualt->variant->id == $id)? 'selected' : '' }}>
                                                {{ $variant->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input class="u-hidden" tabindex="0"></div>
                            </div>
                        </div>
                    @endif

                    @if ($product->attributes()->exists())
                      <div class="c-product__params js-is-expandable" data-collapse-count="3">
                        <ul data-title="ویژگی‌های کالا">
                          @foreach ($product->attributes()->where('is_favorite', 1)->get()->unique('name') as $key => $attribute)
                            @if($key > 4)
                              @continue
                            @endif
                            <li>
                              <span>{{ $attribute->name }}:</span>
                              @if ($attribute->type == 1 || $attribute->type == 2)
                                <span>{{ $product->attributes->find($attribute->id)->pivot->value }}</span>
                              @elseif ($attribute->type == 3)
                                <span>
                                   @foreach($attribute->values as $value)
                                    {{ ($product->attributes->find($attribute->id)->pivot->value_id == $value->id)? $value->value : ''  }}
                                  @endforeach
                                </span>
                              @elseif ($attribute->type == 4)

                                @php $arrays = null @endphp
                                @foreach($product->attributes as $pAttr)
                                  @if (!is_null($pAttr->pivot->value_id) && ($pAttr->pivot->attribute_id == $attribute->id))
                                    <?php $pArray[] = $pAttr->pivot->value_id; ?>
                                  @endif
                                @endforeach

                                <span>
                                  @foreach($attribute->values as $key => $value)
                                    {{ in_array($value->id, $pArray) ? $value->value :  '' }} {{ (in_array($value->id, $pArray) && count($attribute->values) !== $key+1)? '، ' : '' }}
                                  @endforeach
                                </span>

                                @elseif ($attribute->type == 5)
                                  <span>{{ $product->attributes->find($attribute->id)->pivot->value . ' ' . (isset($attribute->unit)? $attribute->unit->name : '')  }}</span>
                                @endif
                            </li>
                          @endforeach

                          @foreach ($product->attributes()->where('is_favorite', 1)->get()->unique('name') as $key => $attribute)
                            @if($key < 5)
                              @continue
                            @endif
                            <li class="js-more-attrs c-product__params-more">
                              <span>{{ $attribute->name }}:</span>
                              @if ($attribute->type == 1 || $attribute->type == 2)
                                <span>{{ $product->attributes->find($attribute->id)->pivot->value }}</span>
                              @elseif ($attribute->type == 3)
                                <span>
                                   @foreach($attribute->values as $value)
                                    {{ ($product->attributes->find($attribute->id)->pivot->value_id == $value->id)? $value->value : ''  }}
                                  @endforeach
                                </span>
                              @elseif ($attribute->type == 4)

                                @php $arrays = null @endphp
                                @foreach($product->attributes as $pAttr)
                                  @if (!is_null($pAttr->pivot->value_id) && ($pAttr->pivot->attribute_id == $attribute->id))
                                    <?php $pArray[] = $pAttr->pivot->value_id; ?>
                                  @endif
                                @endforeach

                                <span>
                                    @foreach($attribute->values as $key => $value)
                                    {{ in_array($value->id, $pArray) ? $value->value :  '' }} {{ (in_array($value->id, $pArray) && count($attribute->values) !== $key+1)? '، ' : '' }}
                                  @endforeach
                                  </span>

                              @elseif ($attribute->type == 5)
                                <span>{{ $product->attributes->find($attribute->id)->pivot->value . ' ' . (isset($attribute->unit)? $attribute->unit->name : '')  }}</span>
                              @endif
                            </li>
                          @endforeach

                          @if ($product->attributes()->where('is_favorite', 1)->exists() && count($product->attributes()->where('is_favorite', 1)->get()) > 5)
                            <li class="c-product__params-more-handler" data-sign="+">
                              <button data-snt-event="dkProductPageClick"
                                      data-snt-params="{&quot;item&quot;:&quot;more-attributes&quot;,&quot;item_option&quot;:null}"
                                      class="btn-link-spoiler js-more-attr-button c-product__show-more-btn">موارد بیشتر
                              </button>
                            </li>
                          @endif
                        </ul>
                      </div>
                    @endif
                  </div>

                </div>

                @if($product->variants()->where('stock_count', '>', 0)->exists())
                  <div class="c-product__summary js-product-summary" style="opacity: 1;">
                    <div class="c-box" style="margin-bottom: 20px;">
                      <div class="c-product__seller-info js-seller-info">
                        <div class="js-seller-info-changable c-product__seller-box">
                          <div class="c-product__seller-row c-product__seller-row--seller js-seller-variant">
                            <i
                              class="c-product__seller-row--trusted-seller js-mini-not-digikala-seller js-mini-is-trusted u-hidden"></i>
                            <i
                              class="c-product__seller-row--official-seller js-mini-not-digikala-seller js-mini-is-official u-hidden"></i>
                            <div class="c-product__seller-row-main  ">
                              <div class="c-product__seller-first-line">
                                <span class="c-product__seller-name js-seller-name">{{ $fa_store_name }}</span>
                              </div>
                            </div>
                          </div>
                          <div class="c-product-info-box js-seller-info-expand">
                            <div class="c-product-info-box__header">
                              <div class="c-product-info-box__header-back-btn js-product-info-box-back-btn"></div>
                              <div>
                                <label>اطلاعات تکمیلی فروشنده</label>
                                <span class="c-product-info-box__seller-info-modal js-seller-rate-info-modal"></span>
                              </div>
                            </div>
                            <div class="c-product-info-box__body-wrapper">
                              <div class="c-product-info-box__body">
                                <div class="u-p-16 c-product-info-box__seller-detail-box">
                                  <div class="c-seller-rating js-buyBox-seller-info">
                                    <div class="c-seller-rating__title c-seller-rating__title--inBuyBox">
                                      <div class="js-sellerName">{{ $fa_store_name }}</div>
                                    </div>
                                    <div class="c-seller-rating__text">
                                      <div class="c-seller-rating__thin-text">عملکرد:</div>
                                      <div class="c-seller-rating__bold-text js-finalScore">۵</div>
                                    </div>
                                    <div
                                      class="c-seller-rating__ratings js-round-progress-holder c-seller-rating__ratings--buy-box">
                                      <div class="c-round-progress__container">
                                        <div class="c-round-progress js-round-progress js-shipOnTimePer green"
                                            data-value="100" data-level-1="98" data-level-2="96">
                                          <div
                                            class="c-round-progress__half c-round-progress__half--left js-round-progress-left"
                                            style="transform: unset;"></div>
                                          <div
                                            class="c-round-progress__half c-round-progress__half--right js-round-progress-right"
                                            style="transform: rotate(0deg);"></div>
                                          <div class="c-round-progress__value js-round-progress-text">۱۰۰٪</div>
                                        </div>
                                        <div class="c-round-progress__label">تامین به موقع</div>
                                      </div>
                                      <div class="c-round-progress__container">
                                        <div class="c-round-progress js-round-progress js-cancelPer green"
                                            data-value="99.8" data-level-1="98" data-level-2="96">
                                          <div
                                            class="c-round-progress__half c-round-progress__half--left js-round-progress-left"
                                            style="transform: unset;"></div>
                                          <div
                                            class="c-round-progress__half c-round-progress__half--right js-round-progress-right"
                                            style="transform: rotate(0.72deg);"></div>
                                          <div class="c-round-progress__value js-round-progress-text">۹۹.۸٪</div>
                                        </div>
                                        <div class="c-round-progress__label">تعهد ارسال</div>
                                      </div>
                                      <div class="c-round-progress__container">
                                        <div class="c-round-progress js-round-progress js-returnPer green"
                                            data-value="99.9" data-level-1="98" data-level-2="96">
                                          <div
                                            class="c-round-progress__half c-round-progress__half--left js-round-progress-left"
                                            style="transform: unset;"></div>
                                          <div
                                            class="c-round-progress__half c-round-progress__half--right js-round-progress-right"
                                            style="transform: rotate(0.36deg);"></div>
                                          <div class="c-round-progress__value js-round-progress-text">۹۹.۹٪</div>
                                        </div>
                                        <div class="c-round-progress__label">بدون ثبت مرجوعی</div>
                                      </div>
                                    </div>
                                    <div class="c-seller-rating__bottom u-hidden js-rateStats-holder">
                                      <div class="c-seller-rating__text">
                                        <div class="c-seller-rating__bold-text"><label class="js-total-rate"></label>٪
                                        </div>
                                        <div class="c-seller-rating__thin-text">رضایت از کالا</div>
                                      </div>
                                      <div class="c-seller-rating__subtitle c-seller-rating__subtitle--center">از
                                        مجموع<label class="u-mx-4 js-total-count"></label>نفر
                                      </div>
                                      <div class="c-seller-rating__row-rating">
                                        <div class="c-line-graph__container">
                                          <div class="c-line-graph js-line-graph-holder"></div>
                                          <div class="c-line-graph__labels">
                                            <div class="c-line-graph__label js-line-graph-right-label"></div>
                                            <div class="c-line-graph__label js-line-graph-left-label"></div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="c-product__seller-row c-product__seller-row--guarantee c-product__seller-row--clickable js-seller-info-guarantee"
                            style="pointer-events: none;">
                            <div class="c-product__seller-row-main js-guarantee-text"></div>
                            <div class="c-product__seller-extra js-guarantee-extra-toggle u-hidden"></div>
                          </div>
                          <div class="c-product-info-box js-guarantee-info-expand">
                            <div class="c-product-info-box__header">
                              <div class="c-product-info-box__header-back-btn js-product-info-box-back-btn"></div>
                              جزئیات گارانتی
                            </div>
                            <div class="c-product-info-box__body-wrapper">
                              <div class="c-product-info-box__body">
                                <div class="c-guarantee-info-box__row">
                                  <div class="u-text-bold m-b-md js-guarantee-text"></div>
                                  <div class="u-text-spaced js-guarantee-description"></div>
                                </div>
                              </div>
                            </div>
                          </div>


                          <div
                            class="c-product__seller-row c-product__seller-row--column js-seller-info-shipment c-product__seller-row--clickable">
                            <div class="c-product__seller-row-main c-product__seller-row-main--arrow-left"><span
                                class="c-product__delivery-warehouse js-provider-main-title c-product__delivery-warehouse--no-lead-time">موجود در انبار {{ $fa_store_name }}</span>
                            </div>
                            <ul class="c-line-bullet-list c-product__sender-list js-provider-list">
                              <li class=""><span
                                  class="c-line-bullet-list__item  c-line-bullet-list__item--digikala no-lead-time">ارسال {{ $fa_store_name }}</span><span
                                  class="js-ab-shipment-free-badge u-hidden free-badge">رایگان</span></li>
                            </ul>
                          </div>


                          <div class="c-product-info-box js-shipment-info-expand">
                            <div class="c-product-info-box__header">
                              <div class="c-product-info-box__header-back-btn js-product-info-box-back-btn"></div>
                              جزئیات ارسال
                            </div>
                            <div class="c-product-info-box__body-wrapper">
                              <div class="c-product-info-box__body">
                                <div class="c-shipment-info-box__row js-shipment-info-main-container">
                                  <div class="c-shipment-info-box__row--title">
                                    ارسال توسط {{ $fa_store_name }}
                                    <span class="js-ab-shipment-free-badge u-hidden">رایگان</span></div>
                                  <div class="c-shipment-info-box__row--content">
                                    این کالا در انبار {{ $fa_store_name }} موجود و آماده پردازش است و امکان ارسال مستقیم
                                    توسط {{ $fa_store_name }}
                                    را دارد.
                                    <p class="free-badge js-ab-shipment-free-badge u-hidden">کالا‌هایی با قیمت بیش از ۳۰۰
                                      هزار تومان به صورت رایگان ارسال خواهند شد.</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="c-product__seller-row c-product__seller-row--gift c-product__seller-row--clickable js-seller-info-gift u-hidden"
                            style="pointer-events: none;">
                            <div class="c-product__seller-row-main js-gift-text js-single-gift "></div>
                            <div class="c-product__seller-row-main js-gift-text js-multi-gift u-hidden"><span
                                class="js-gift-count">۰</span>
                              هدیه
                            </div>
                            <div class="c-product__seller-extra js-gift-extra-toggle "></div>
                          </div>
                          <div class="c-product-info-box js-gift-info-expand">
                            <div class="c-product-info-box__header">
                              <div class="c-product-info-box__header-back-btn js-product-info-box-back-btn"></div>
                              لیست هدیه‌ها
                            </div>
                            <div class="c-product-info-box__body-wrapper">
                              <div class="c-product-info-box__body">
                                <div>
                                  <div class="c-product__gift-title">
                                    لیست هدیه ها
                                  </div>
                                  <div class="c-product__gift-content js-gift-items"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="c-product__seller-row c-product__seller-row--price">
                            <div class="c-product__seller-price-info">
                              <div class="c-product__seller-price-label">
                                قیمت محصول
                                <span class="js-dk-wiki-trigger c-wiki c-wiki__holder">
                                  <span class="c-wiki-sign"></span>
                                  <div class="c-wiki__container js-dk-wiki is-right">
                                    <div class="c-wiki__arrow"></div>
                                    <p class="c-wiki__text">
                                          این کالا توسط فروشنده آن، {{ $fa_store_name }}، قیمت‌گذاری شده‌ است.
                                      </p>
                                  </div>
                                </span>
                              </div>
                              <div class="c-product__seller-price-prev js-rrp-price u-hidden">

                              </div>
                              <div class="c-product__seller-price-off js-discount-value u-hidden">
                                ۰٪
                              </div>
                            </div>
                            <div class="c-product__seller-price-real">
                              <div class="c-product__seller-price-pure js-price-value"></div>
                              تومان
                            </div>
                            <div
                              class="c-product__additional-item c-product__additional-item--no-icon js-price-discount-osm u-hidden">
                              <span class="js-discount-osm-value"></span>&nbsp; تومان
                              تخفیف سازمانی کسر گردیده است.
                            </div>
                          </div>
                        </div>
                        <div class="c-product__seller-row c-product__seller-row--add-to-cart">
                          <a
                            class="js-ab-product-action btn-add-to-cart btn-add-to-cart--full-width js-add-to-cart js-cart-page-add-to-cart js-btn-add-to-cart"
                            data-product-id="{{ $product->product_code  }}"
                            data-variant="{{ !is_null($variant_defualt)? $variant_defualt->variant_code : '' }}"
                            href="/cart/add/{{ !is_null($variant_defualt)? $variant_defualt->variant_code : '' }}/1/"
                            data-event="add_to_cart" data-event-category="ecommerce"
                            data-event-label="price: 495900000 - seller: marketplace - seller_name: {{ $fa_store_name }} - seller_rating: 81 - multiple_configs: True - position: 0"><span
                              class="btn-add-to-cart__txt">افزودن به سبد خرید</span></a></div>
                      </div>
                    </div>
                  </div>
                @else
                  <div class="c-product__summary js-product-summary">
                    <div class="c-product__stock-status c-product__stock-status--out-of-stock">
                      <div class="c-product-stock__title">
                        ناموجود
                      </div>
                      <div class="c-product-stock__body">
                        متاسفانه این کالا در حال حاضر موجود نیست. لطفا در روز های آینده دوباره بررسی کنید.
                      </div>
                       <button data-snt-event="dkProductPageClick"
                      type="button"
                        data-snt-params="{&quot;item&quot;:&quot;main-alarm-for-instock&quot;,&quot;item_option&quot;:&quot;out-of-stock&quot;}"
                        class="o-btn o-btn--full-width o-btn--contained-red-lg c-product-stock__action js-add-to-notify-button" disabled>
                        <i class="c-product-stock__action--alarm-icon"></i>
                        <label>ناموجود</label>
                      </button>
                    </div>
                  </div>
                @endif


              </div>
              <div class="c-product__usp">
                <aside class="c-product__feature">
                  <div class="o-grid">
                    <div class="row">
                    </div>
                  </div>
                </aside>
              </div>
            </section>

            <section class="c-product__gallery">
              <div style="" class="c-product__headline--gallery u-hidden">
                فروش ویژه
              </div>
              <div class="c-product-gallery__offer js-amazing-offer u-hidden">
                <img class="c-product-gallery__offer-img" src="https://www.digikala.com/static/files/6fbe3569.svg">
                <div class="c-product-gallery__timer js-counter"></div>
              </div>

              <div class="c-gallery ">

                <div class="c-gallery__item">
                  <ul class="c-gallery__options">
                    <li>
                      <button data-snt-event="dkProductPageClick"
                              data-snt-params="{&quot;item&quot;:&quot;gallery-option&quot;,&quot;item_option&quot;:&quot;add-to-favorites&quot;}"
                              id="add-to-favorite-button"
                              class="btn-option btn-option--wishes {{ ($product->favorite()->exists())? 'is-active' : '' }}"
                              data-token=""></button>
                      <span class="c-tooltip c-tooltip--left c-tooltip--short">افزودن به علاقه‌مندی</span>
                    </li>
{{--                    <li>--}}
{{--                      <button class="btn-option btn-option--stats" id="price-chart-button"--}}
{{--                              data-snt-event="dkProductPageClick"--}}
{{--                              data-snt-params="{&quot;item&quot;:&quot;gallery-option&quot;,&quot;item_option&quot;:&quot;price-chart&quot;}"--}}
{{--                              data-event="price_chart" data-event-category="product_page"--}}
{{--                              data-event-label="category: گوشی موبایل, available:True"></button>--}}
{{--                      <span class="c-tooltip c-tooltip--left c-tooltip--short">نمودار قیمت</span>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                      <a data-snt-event="dkProductPageClick"--}}
{{--                         data-snt-params="{&quot;item&quot;:&quot;gallery-option&quot;,&quot;item_option&quot;:&quot;compare&quot;}"--}}
{{--                         href="/compare/dkp-{{ $product->id }}/" class="btn-option btn-option--compare"></a><span--}}
{{--                        class="c-tooltip c-tooltip--left c-tooltip--short">مقایسه</span>--}}
{{--                    </li>--}}
                  </ul>
                  <div class="c-gallery__img">
                    @foreach($product->media as $image)
                      @if($product->media && ($image->pivot->is_main == 1))
                        <img class="js-gallery-img"
                             data-src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_600,w_600/quality,q_80"
                             title="{{ $product->title_fa }}" alt="{{ $product->title_fa }}"
                             data-zoom-image="{{ full_media_path($image) }}?x-oss-process=image/resize,w_1280/quality,q_80"
                             src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_600,w_600/quality,q_80"
                             loading="lazy">
                      @endif
                    @endforeach
                    <div class="c-gallery__main-img-badges-container"></div>
                  </div>
                </div>

                <ul class="c-gallery__items">
                  @if($product->media()->exists())
                    @foreach($product->media as $key => $image)
                      <li class="js-product-thumb-img" data-slide-index="{{ $key+1 }}" data-event="album_usage"
                          data-event-category="product_page" data-event-label="3555626-num of pics:14">
                        <div class="thumb-wrapper">
                          <img
                            data-src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_115,w_115/quality,q_60"
                            title="" data-snt-event="dkProductPageClick"
                            data-snt-params="{&quot;item&quot;:&quot;gallery-option&quot;,&quot;item_option&quot;:&quot;thumbnail-image&quot;}"
                            alt="{{ $product->title_fa }} thumb 1 {{ $key+1 }}" data-type=""
                            src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_115,w_115/quality,q_60"
                            loading="lazy">
                          <div class="c-gallery__images-count">
                          <span class="c-gallery__count-circle">
                            <div class="c-gallery__three-bullets"></div>
                          </span>
                          </div>
                        </div>
                      </li>
                    @endforeach
                  @endif
                </ul>

              </div>

            </section>

          </article>


          <div class="js-c-box-suppliers c-box-suppliers" id="suppliers" xmlns="http://www.w3.org/1999/html">
            <div class="c-box-suppliers__headline-container">
              <div class="o-box__header">
                <span class="o-box__title">انتخاب گارانتی برای تنوع انتخابی</span>
              </div>
            </div>
            <div class="c-box">
              <div class="c-table-suppliers js-c-table-suppliers--summary">
                <div class="c-table-suppliers__body">
                  @if ($product->variants()->where('stock_count', '>', 0)->exists())
                    @foreach ($product->variants()->where('stock_count', '>', 0)->get() as $key => $item)
                      <?php
                      $promotion_price = null;
                      if ($item->promotions()->exists()) {
                        $promotion_price = $item->promotions()->active()->min('promotion_price');
                        if ($item->promotions()->whereDate('start_at', '<=', now())->whereDate('end_at', '>=', now())->where('promotion_price', $promotion_price)->where('status', 'active')->orWhere('status', 1)->exists()) {
                          $promotion_timer = $item->promotions()->whereDate('start_at', '<=', now())->whereDate('end_at', '>=', now())->where('promotion_price', $promotion_price)->where('status', 'active')->orWhere('status', 1)->first()->end_at;
                          $promotion = $item->promotions()->whereDate('start_at', '<=', now())->whereDate('end_at', '>=', now())->where('promotion_price', $promotion_price)->where('status', 'active')->orWhere('status', 1)->first();
                        } else {
                          $promotion_timer = null;
                        }

                      }
                      if ($promotion_price == null) {
                        $promotion_price = $item->sale_price;
                        $promotion_timer = 'false';
                        $promotion = null;
                      }

                      ?>

                      {{--                      c-table-suppliers__row--active--}}
                      <div class="c-table-suppliers__row js-supplier in-filter"
                           data-variant="{{ $item->variant_code }}">
                        <div class="c-table-suppliers__cell c-table-suppliers__cell--title"><span
                            class="c-table-suppliers__seller-icon   "></span>
                          <div class="c-table-suppliers__seller-wrapper">
                            <p class="c-table-suppliers__seller-name">
                              <a data-snt-event="dkProductPageClick"
                                 data-snt-params="{&quot;item&quot;:&quot;seller-in-list&quot;,&quot;item_option&quot;:&quot;{{ $fa_store_name }}&quot;}">
                                {{ $fa_store_name }}
                              </a>
                            </p>
                            <p></p>
                          </div>
                        </div>

                        <div class="c-table-suppliers__cell c-table-suppliers__cell--conditions">
                          <div class="c-table-suppliers__sender c-table-suppliers__sender--digikala ">
                            ارسال {{ $fa_store_name }} از {{ persianNum($item->post_time) }} روز کاری دیگر
                          </div>
                        </div>

                        <div class="c-table-suppliers__cell c-table-suppliers__cell--guarantee">
                          <span>{{ $item->warranty->name }}</span>
                        </div>

                        <div class="c-table-suppliers__cell c-table-suppliers__cell--price ">
                          <div class="c-price">
                            <div class="c-price__value">
                              {{ persianNum($promotion_price) }}
                            </div>
                          </div>
                        </div>
                        <div class="c-table-suppliers__cell c-table-suppliers__cell--action">
                          <a class=" o-btn o-btn--outlined-red-md js-variant-add-to-cart js-btn-add-to-cart"
                             data-event="add_to_cart" data-event-category="ecommerce"
                             data-event-label="items: price: {{ $promotion_price }} - seller: marketplace - multiple_configs: True - position: 0"
                             data-snt-event="dkProductPageClick"
                             data-snt-params='{"item":"seller-add-to-cart","item_option":null}'
                             data-variant="{{ $item->variant_code }}"
                             href="{{ route('front.addToCart', $item->variant_code) }}">
                            افزودن به سبد
                          </a>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
              </div>
              <div class="c-table-suppliers-less c-table-suppliers-hidden js-table-suppliers-less">
                <button
                  class="o-btn o-btn--link-blue-sm o-btn--remove-padding o-btn--l-expand-more is-open js-less-supplier-button"
                  data-is-open="0" data-snt-event="dkProductPageClick"
                  data-snt-params="{&quot;item&quot;:&quot;show-fewer-supplier&quot;,&quot;item_option&quot;:null}">
                  تنها نمایش ۳ نتوع اول
                </button>
              </div>
              <div class="c-table-suppliers-more js-table-suppliers-more">
                <button
                  class="o-btn o-btn--link-blue-sm o-btn--l-expand-more o-btn--remove-padding js-more-supplier-button"
                  data-event="more_sellers" data-event-category="product_page"
                  data-event-label="3186052-category: دسته بازی, sellers: 6 - default_seller: marketplace"
                  data-is-open="0" data-snt-event="dkProductPageClick"
                  data-snt-params="{&quot;item&quot;:&quot;show-more-supplier&quot;,&quot;item_option&quot;:null}">
                  نمایش همه
                  {{--  <span class="u-ml-4 u-mr-4 js-more-suppliers-count">۳</span>  --}}
                  {{--  فروشنده دیگر این کالا  --}}
                </button>
              </div>
            </div>
          </div>


          @if($product->category()->first()->count >= 4)
            <?php
            $slider_category = $product->category()->first();
            ?>
            <div class="c-carousel c-carousel--horizontal-general ">
              <div class="c-carousel__header">
                <div class="c-title ">
                  <div class="c-title__content-right c-title__content-right--has-underline">
                    <div class="c-title__title-container">
                      <h4 class="c-title__title">محصولات مرتبط</h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="c-carousel__content">
                <div
                  class="swiper-container swiper-container-horizontal c-carousel__container js-swiper-products swiper-container-rtl">
                  <div class="swiper-wrapper">
                    @foreach ($slider_category->products as $key => $item)
                      <div
                        class="swiper-slide c-carousel__slide {{ ($key == 0)? 'swiper-slide-active' : '' }} {{ ($key == 1)? 'swiper-slide-next' : '' }}"
                        data-id="{{ $item->product_code }}" data-position="{{ $key+1 }}" style="width: 316px;">
                        <li>
                          <a href="{{ route('front.productPage', $product->product_code) }}"
                             data-id="{{ $item->product_code }}"
                             class="c-product-box__box-link js-product-url js-carousel-ga-product-box">
                          </a>
                          <div
                            class="js-product-cart c-product-box c-product-box--product-card c-product-box--has-overflow c-product-box--card-macro c-product-box--plus-badge "
                            title="{{ $item->title_fa }}">
                            <div class="c-product-box__img js-url js-snt-carousel_product"
                                 title="{{ $item->title_fa }}">
                            <span class="u-hidden c-product-box__title-special js-ab-app-incredible-product">
                            شگفت‌انگیز اخـتـصـاصـی اپـلیـکیـشـن
                            </span>
                              @foreach($product->media as $image)
                                @if($product->media && ($image->pivot->is_main == 1))
                                  <img alt="{{ $item->title_fa }}"
                                       src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60"
                                       class=" js-ab-not-app-incredible-product swiper-lazy swiper-lazy-loaded"
                                       loading="lazy">
                                @endif
                              @endforeach
                            </div>
                            <div
                              class="u-hidden c-product-box__title c-product-box__title--app-incredible js-ab-app-incredible-product">
                            <span class="c-product-box__title-special-sub">
                                مشاهده و خرید این کالا تنها با اپلیکیشن {{ $fa_store_name }} امکان‌پذیر می‌باشد
                            </span>
                            </div>
                            <div class="c-product-box__title  js-ab-not-app-incredible-product">
                              {{ $item->title_fa }}
                            </div>
                            <div class="c-product-box__digiplus c-product-box__digiplus--full u-invisible">
                            <span class="c-product-box__digiplus-data c-digiplus-sign--before">
                                ۰ تومان هدیه نقدی
                            </span>
                            </div>
                            <div class="c-product-box__row c-product-box__row--price">
                              <div class="c-price">
                                <div class="c-price__value c-price__value--plp js-price-complete-details">
                                  <div class="c-price__value-wrapper">
                                    {{ persianNum(number_format(product_price($item))) }} <span
                                      class="c-price__currency">تومان</span></div>
                                </div>
                              </div>
                            </div>
                            <div class="c-product-box__amazing">
                              <div class="c-product-box__remained"></div>
                            </div>
                          </div>
                        </li>
                      </div>
                    @endforeach
                  </div>
                  <div class="swiper-button-prev js-swiper-button-prev swiper-button-disabled"></div>
                  <div class="swiper-button-next js-swiper-button-next"></div>
                </div>
              </div>
            </div>
          @endif


          <div class="c-product__bottom-section u-mt-12 has-mini-buybox">
            <div class="o-box o-box--no-border o-box--grow c-product__tabs-container" id="tabs">
              <ul
                class="o-box__tabs o-box__tabs--sticky js-c-box-tabs {{ ($product->attributes()->exists())? '' : 'u-hidden' }}">
                <li class="js-product-params-tab o-box__tab js-product-tab "
                    data-fetchFromService=""
                    data-method="params" data-product-id="{{ $product->id }}"
                    id="tab-params">
                  <a data-snt-event="dkProductPageClick"
                     data-snt-params='{"item":"product-tab","item_option":"1-مشخصات"}'
                     data-tab-name="params"
                     href="">مشخصات</a>
                </li>
                <li class="js-product-comments-tab o-box__tab js-product-tab " data-fetchFromService="1"
                    data-items-count="17" data-method="comments" data-product-id="{{ $product->id }}"
                    id="tab-comments"
                >
                  <a data-snt-event="dkProductPageClick"
                     data-snt-params='{"item":"product-tab","item_option":"2-دیدگاه کاربران"}'
                     data-tab-name="comments"
                     href="">دیدگاه کاربران</a></li>
              </ul>
              <div>

                <div class="c-params js-product-tab-content" data-method="params" id="params" style=" {{ ($product->attributes()->exists())? '' : 'display: none;' }}">
                  <article class="c-params__border-bottom">
                    <div class="o-box__header">
                      <span class="o-box__title">مشخصات کالا</span>
                      <span class="o-box__header-desc">{{ $product->title_en }}</span>
                    </div>



                      @foreach($product->category[0]->attributeGroups as $key => $attrGroup)
{{--                        @if ($key > 0)--}}
{{--                          @continue--}}
{{--                        @endif--}}
                        <?php $filledAttrG = null; ?>

                        @foreach($attrGroup->attributes as $attribute)
                          @if(isset($product->attributes()->find($attribute->id)->pivot->product_id))
                            <?php $filledAttrG = true; ?>
                          @endif
                        @endforeach

                        @if (!is_null($filledAttrG))
                          <section>

                            <h3 class="c-params__title">{{ $attrGroup->name }}</h3>

                            <ul class="c-params__list">
                              @foreach($attrGroup->attributes->sortBy('position') as $attribute)
                                <li>
                                  @if(isset($product->attributes()->find($attribute->id)->pivot->value) && !is_null($attribute->name))
                                    <div class="c-params__list-key"><span class="block">{{ $attribute->name }}</span>
                                    </div>
                                  @endif

                                  @if (($attribute->type == 1 || $attribute->type == 2) && isset($product->attributes()->find($attribute->id)->pivot->value))
                                    <div class="c-params__list-value">
                                      <span class="block">
                                        {{ $product->attributes()->find($attribute->id)->pivot->value }}
                                      </span>
                                    </div>
{{--                                  @elseif ($attribute->type == 3 && isset($product->attributes->find($attribute->id)->pivot->value_id) && ($product->attributes->find($attribute->id)->pivot->value_id == $value->id))--}}
                                  @elseif ($attribute->type == 3 && isset($product->attributes->find($attribute->id)->pivot->value_id))
                                    <div class="c-params__list-value">
                                      <span class="block">
                                         @foreach($attribute->values as $value)
                                          {{ ($product->attributes->find($attribute->id)->pivot->value_id == $value->id)? $value->value : ''  }}
                                        @endforeach
                                      </span>
                                    </div>
                                  @elseif ($attribute->type == 4)
                                    @php $arrays = null @endphp
                                    @foreach($product->attributes as $pAttr)
                                      @if (!is_null($pAttr->pivot->value_id) && ($pAttr->pivot->attribute_id == $attribute->id))
                                        <?php $pArray[] = $pAttr->pivot->value_id; ?>
                                      @endif
                                    @endforeach

                                    <?php $has_value = false; ?>
                                    @foreach($attribute->values as $key => $value)
                                      @if ($has_value == true)
                                        @continue
                                      @endif
                                      @if(in_array($value->id, $pArray))
                                        <?php $has_value = true; ?>
                                      @endif
                                    @endforeach

                                    @if($has_value == true)
                                      <div class="c-params__list-value">
                                          <span class="block">
                                            @foreach($attribute->values as $key => $value)
                                              {{ in_array($value->id, $pArray) ? $value->value :  '' }} {{ (in_array($value->id, $pArray) && count($attribute->values) !== $key+1)? '، ' : '' }}
                                            @endforeach
                                          </span>
                                      </div>
                                    @endif

                                  @elseif ($attribute->type == 5 && isset($product->attributes->find($attribute->id)->pivot->value))
                                    <div class="c-params__list-value">
                                      <span class="block">
                                        {{ $product->attributes->find($attribute->id)->pivot->value }} {{ ' ' . (isset($attribute->unit)? $attribute->unit->name : '')  }}
                                      </span>
                                    </div>
                                  @endif
                                </li>
                              @endforeach
                            </ul>
                          </section>
                        @endif
                      @endforeach


                  </article>
                </div>

                <div class="c-comments js-product-tab-content" data-fetch-from-service="1" data-method="comments"
                     id="comments">
                  <div class="o-box__header"><span class="o-box__title">امتیاز و دیدگاه کاربران</span>
                  </div>
                  <div class="js-content"></div>
                  <div class="c-content-expert__separator"></div>
                </div>
              </div>
            </div>


            @if($product->variants()->where('stock_count', '>', 0)->exists())
              <div class="c-mini-buy-box-fixed">
                <div class="c-mini-buy-box js-mini-buy-box">
                  <div style="" class="c-mini-buy-box__amazing-text  u-hidden">
                    فروش ویژه
                  </div>
                  <div class="c-mini-buy-box__product-info">
                    <img class="c-mini-buy-box__product-info--img"
                        src="{{ g_product_image_main_src($product) }}?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80"
                        alt="{{ $product->title_fa }}">
                    <div class="c-mini-buy-box__product-info--info">
                      <div class="title">{{ $product->title_fa }}</div>
                      @if($product_variants && $product_variants->first()->variant()->exists() && !is_null($product_variants->first()->variant->value))
                        <div class="colors">
                            <label class="js-variant-color"></label>
                            <span class="js-color-title"></span>
                        </div>
                      @elseif($product_variants && $product_variants->first()->variant()->exists())
                      <div class="sizes">
                          <span class="js-size-title"></span>
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="c-mini-buy-box__row c-mini-buy-box__seller-digikala u-hidden js-mini-digikala-seller">
                    {{ $fa_store_name }}
                  </div>
                  <div class="c-mini-buy-box__row c-mini-buy-box__seller js-mini-not-digikala-seller">
                    <i class="green-verified js-mini-is-trusted u-hidden"></i>
                    <i class="blue-verified js-mini-is-official u-hidden"></i>
                    <label class="js-mini-seller-name">{{ $fa_store_name }}</label>
                  </div>
                  <div class="c-mini-buy-box__row c-mini-buy-box__warranty js-guarantee-text">

                  </div>
                  <div class="c-product__seller-row c-product__seller-row--price c-mini-buy-box__price-row">
                    <div class="c-product__seller-price-info">
                      <del class="c-product__mini-seller-price-prev js-rrp-price u-hidden">

                      </del>
                      <div class="c-product__seller-price-off js-discount-value u-hidden">
                        ٪
                      </div>
                    </div>
                    <div class="c-product__mini-seller-price-real">
                      <div class="c-product__mini-seller-price-pure js-price-value"></div>
                      <span class="c-mini-buy-box__toman">تومان</span></div>
                  </div>
                  <div class="c-mini-buy-box__btn-row">
                    <a
                      class="o-btn o-btn--contained-red-lg c-product__add-to-cart-btn js-add-to-cart js-btn-add-to-cart js-mini-add-to-cart js-ab-product-action"
                      data-product-id="1" data-variant="" href="/cart/add/15488759/1/" data-event="add_to_cart"
                      data-event-category="ecommerce"
                      data-event-label="price: 509900000 - seller: marketplace - seller_name: {{ $fa_store_name }} - seller_rating: 81 - multiple_configs: True - position: 0">
                      افزودن به سبد خرید
                    </a>
                  </div>
                </div>

              </div>
            @endif

          </div>


        </div>
      </div>
      <div aria-describedby="modal1Desc" aria-labelledby="modal1Title" class="remodal c-remodal-notification"
           data-remodal-id="observed" role="dialog">
        <button aria-label="Close" class="remodal-close" data-remodal-action="close"></button>
        <div class="c-remodal-notification__main">
          <div class="c-remodal-notification__aside">
            <div class="c-remodal-notification__title-ilu">به من اطلاع بده</div>
            <div class="c-remodal-notification__ilu"></div>
          </div>
          <div class="c-remodal-notification__content">
            <form class="c-form-notification" id="observed-form">
              <div class="c-form-notification__title">اطلاع به من در زمان:</div>
              <div class="c-form-notification__row">
                <div class="c-form-notification__col">
                  <div class="c-form-notification__status">
                    موجود شدن
                  </div>
                </div>
              </div>
              <div class="c-form-notification__row js-observe-modal-errors u-hidden-visually">
                <div class="c-form-notification__col">
                  <div class="c-message-light c-message-light--error js-form-error-items"></div>
                </div>
              </div>
              <div class="c-form-notification__title">از طریق:</div>
              <div class="c-form-notification__row">
                <div class="c-form-notification__col">
                  <ul class="c-form-notification__params">
                    <li><label class="c-form-notification__label" for="notification-param-1">ایمیل به
                        <span class="js-observed-user-email"></span></label><label
                        class="c-ui-checkbox"><input id="notification-param-1" name="observed[email]"
                                                     type="checkbox"
                                                     value="1"><span
                          class="c-ui-checkbox__check"></span></label></li>
                    <li><label class="c-form-notification__label" for="notification-param-2">پیامک به
                        <span class="js-observed-user-number"></span></label><label
                        class="c-ui-checkbox"><input checked id="notification-param-2" name="observed[sms]"
                                                     type="checkbox" value="1"><span
                          class="c-ui-checkbox__check"></span></label></li>
                    <li><label class="c-form-notification__label" for="notification-param-3">سیستم پیام
                        شخصی {{ $fa_store_name }}</label><label class="c-ui-checkbox"><input checked
                                                                                             id="notification-param-3"
                                                                                             name="observed[notification]"
                                                                                             type="checkbox"
                                                                                             value="1"><span
                          class="c-ui-checkbox__check"></span></label></li>
                  </ul>
                </div>
              </div>
              <div class="c-form-notification__row c-form-notification__row--submit">
                <div class="c-form-notification__col">
                  <button class="btn-remodal-primary" id="add-to-observed" type="button">ثبت</button>
                  <button class="btn-remodal-secondary" data-remodal-action="cancel">بازگشت</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div aria-describedby="modal1Desc" aria-labelledby="modal1Title" class="remodal c-remodal-gallery"
           data-remodal-id="gallery" role="dialog">
        <div class="c-remodal-gallery__main js-level-one-gallery">
          <div class="c-remodal-gallery__top-bar">
            <div class="c-remodal-gallery__tabs js-top-bar-tabs">
              <div class="c-remodal-gallery__tab c-remodal-gallery__tab--selected js-gallery-tab" data-id="1">
                تصاویر رسمی
              </div>
            </div>
            <button aria-label="Close" class="c-remodal-gallery__close" data-remodal-action="close"></button>
          </div>

          <div class="c-remodal-gallery__content js-gallery-tab-content is-active" id="gallery-content-1">
            @foreach($product->media as $key => $image)
              @if($product->media()->exists())
                <div
                  class="c-remodal-gallery__main-img js-gallery-main-img js-img-main-{{ $key+1 }} {{ ($key == 0)? 'is-active js-img-main-1' : '' }}"
                  data-slide-title="Slide {{ $key+1 }}">
                  <img
                    data-src="{{ full_media_path($image) }}?x-oss-process=image/resize,h_1600/quality,q_80/watermark,image_ZGstdy8xLnBuZw==,t_90,g_nw,x_15,y_15"
                    data-high-res-src="{{ full_media_path($image) }}?x-oss-process=image/resize,h_1600/quality,q_80/watermark,image_ZGstdy8xLnBuZw==,t_90,g_nw,x_15,y_15"
                    class="pannable-image" title="{{ $product->title_fa }}" alt="{{ $product->title_fa }}" data-type=""
                    src="{{ full_media_path($image) }}?x-oss-process=image/resize,h_1600/quality,q_80/watermark,image_ZGstdy8xLnBuZw==,t_90,g_nw,x_15,y_15"
                    loading="lazy">
                </div>
              @endif
            @endforeach
            <div class="c-remodal-gallery__info">
              <div class="c-remodal-gallery__title">{{ $product->title_fa }}</div>
              <div class="c-remodal-gallery__thumbs js-official-thumbs">
                @if($product->media()->exists())
                  @foreach($product->media as $key => $image)
                    <div class="c-remodal-gallery__thumb js-image-thumb" data-order="{{ $key+1 }}">
                      <img
                        data-src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_115,w_115/quality,q_60"
                        title="{{ $product->title_fa }}" alt="{{ $product->title_fa }}" data-type=""
                        src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_115,w_115/quality,q_60"
                        loading="lazy">
                    </div>
                  @endforeach
                @endif
              </div>
              <div class="c-remodal-gallery__other-imgs js-comments-files-thumbnails-summary js-see-more-imgs"></div>
            </div>
          </div>

          <div
            class="c-remodal-gallery__content c-remodal-gallery__content--comments js-gallery-tab-content js-comments-with-thumbnails"
            id="gallery-content-2"></div>
        </div>


        <div class="c-remodal-gallery__main js-level-two-gallery js-comments"></div>
        <div class="c-remodal-gallery__main js-answers">
          <div class="c-remodal-gallery__top-bar">
            <div class="c-remodal-gallery__head-title">
              پاسخ فروشنده
            </div>
            <button aria-label="Close" class="c-remodal-gallery__close" data-remodal-action="close"></button>
          </div>
        </div>
      </div>
      <div class="u-hidden" id="product-template">
        <div class="swiper-slide c-carousel__slide" data-id="{id}">
          <div class="c-product-box c-product-box--no-shadow"><a
              class="c-product-box__img js-url js-carousel-ga-product-box" data-id="{id}"
              href="https://www.digikala.com/product/dkp-{{ $product->id }}/{url}">
                  <img alt="{title}" class="swiper-lazy js-template-img" data-img="{image}" loading="lazy">
                  <img class="c-product-box__fmcg-symbol {isFMCG}" loading="lazy" src="../../static/files/31a78819.svg">
              </a>
            <div class="c-product-box__title">
                <a class="js-carousel-ga-product-box" data-id="{id}" href="https://www.digikala.com/product/dkp-{{ $product->id }}/{url}">
                {title}
              </a>
            </div>
            <div class="c-product-box__price-row">
              <div class="c-product-box__price-item">
                <div class="c-new-price">
                  <div class="c-new-price__old-value {hasDiscount}">
                    <del>{oldValue}</del>
                    <span class="c-new-price__discount">٪{discount}</span></div>
                  <div class="c-new-price__value">
                    {price}
                    <span class="c-new-price__currency">تومان</span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="sidebar">
      <aside></aside>
    </div>
  </main>

@endsection
