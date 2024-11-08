@php
    $banner2 = \Modules\Staff\Slider\Models\Slider::find(2);
    $banner3 = \Modules\Staff\Slider\Models\Slider::find(3);
    $banner4 = \Modules\Staff\Slider\Models\Slider::find(4);
    $slider1 = \Modules\Staff\Slider\Models\Slider::find(5);
    $bannerGroup1 = \Modules\Staff\Slider\Models\Slider::find(6);
    $bannerGroup2 = \Modules\Staff\Slider\Models\Slider::find(7);
    $bannerGroup3 = \Modules\Staff\Slider\Models\Slider::find(8);
    $bannerGroup4 = \Modules\Staff\Slider\Models\Slider::find(9);
    $banner5 = \Modules\Staff\Slider\Models\Slider::find(10);
@endphp

@extends('layouts.front.master')

@section('head')
    <title>{{ $site_title }}</title>
    <!-- SEO -->
    <meta name="keywords" content="{{ $index_meta_keywords }}"/>
    <meta name="description" content="{{ $index_meta_description }}"/>

    <style>
        @media screen and (-ms-high-contrast: none) {

            .c-shipment-page__to-payment-sticky,
            .c-checkout__to-shipping-sticky {
                position: relative !important;
            }

            .c-checkout-aside {
                position: relative !important;
            }
        }

        /* all edge versions */
        @supports (-ms-ime-align:auto) {

            .c-shipment-page__to-payment-sticky,
            .c-checkout__to-shipping-sticky {
                position: relative !important;
            }

            .c-checkout-aside {
                position: relative !important;
            }
        }

        .c-navi-new-list__sublist--promotion .c-navi-new-list__sublist-option {
            width: 40% !important;
        }

        .c-navi-new-list__category--main::before {
            content: unset !important;
        }

        .menu-icons {
            float: right;
            width: 22px !important;
            height: 24px !important;
            margin-left: 4px;
            margin-top: 0px !important;
            background-size: 20px !important;
        }

    </style>

    <!-- page js variables -->
    <script src="{{ asset('assets/js/sentry-customer.js') }}"></script>
    <script src="{{ asset('assets/js/indexAction.js') }}"></script>
@endsection

@section('content')
    <main id="main">
        <div id="HomePageTopBanner"></div>
        <div id="content">
            <article class="container container--home">
                <div class="o-page">
                    <div class="o-page__row o-page__row--main-top">
                        <aside class="c-adplacement c-adplacement__margin-bottom">
                            @if ($banner2 && $banner2->status == 'active' && $banner2->images()->exists() && $banner2->images()->first()->media()->exists())
                                <a href="{{ $banner2->images()->first()->link }}" class="c-adplacement__item"
                                   target="_blank" title="{{ $banner2->images()->first()->alt }}">
                                    <img src="{{ $banner2->images()->first()->media()->exists()
                                        ? $site_url . '/' . $banner2->images()->first()->media->first()->path . '/' . $banner2->images()->first()->media->first()->name : '' }}"
                                         alt="{{ $banner2->images()->first()->media()->exists() ? $banner2->images()->first()->alt : '' }}"
                                         loading="lazy"/>
                                </a>
                            @endif
                        </aside>

                        <?php
                        $banner3_exists = $banner3 && $banner3->status == 'active' &&
                            $banner3->images()->exists() && $banner3->images()->first()->media()->exists();

                        $banner4_exists = $banner4 && $banner4->status == 'active' &&
                            $banner4->images()->exists() && $banner4->images()->first()->media()->exists();
                        ?>

                        <div
                            class="{{ $banner3_exists && $banner4_exists ? 'o-page__two-thirds o-page__two-thirds--right' : 'o-page__fullsize' }}">
                            <section class="c-adplacement-head-slider c-adplacement-head-slider--home">
                                <div class="c-swiper c-swiper--promo-box c-main-slider-container ">
                                    <div
                                        class="swiper-container swiper-container-horizontal js-main-page-slider swiper-container-fade swiper-container-rtl">
                                        <div class="swiper-wrapper dkms-placement-slider c-adplacement"
                                             style="transition-duration: 0ms;">
                                            @if ($has_slider = !is_null($slider1) && $slider1->images()->exists() && $slider1->images()->first()->media()->exists())
                                                @foreach ($slider1->images()->active()->orderBy('position', 'asc')->get() as $image)
                                                    <a href="{{ $image->media()->exists() ? $image->link : '' }}"
                                                       class="c-main-slider__slide swiper-slide js-main-page-slider-image"
                                                       title="{{ $image->media()->exists() ? $image->alt : '' }}"
                                                       data-is-trackable="" target="_blank" style="background-image: url({{ $site_url . '/' . $image->media()->first()->path . '/' . $image->media()->first()->name }});
                                                         width: 875px; transition-duration: 0ms; opacity: 1; transform: translate3d(1750px, 0px, 0px); background-size:cover;"></a>
                                                @endforeach
                                            @endif
                                        </div>

                                        @if ($has_slider && $slider1->images()->active()->count() > 1)
                                            <div
                                                class="swiper-pagination c-main-slider__actions swiper-pagination-clickable swiper-pagination-bullets"></div>
                                            <div class="swiper-button-prev"></div>
                                            <div class="swiper-button-next"></div>
                                        @endif
                                    </div>
                                </div>
                            </section>
                        </div>

                        @if ($banner3_exists && $banner4_exists)
                            <div class="o-page__one-thirds o-page__one-thirds--left">
                                <aside class="c-adplacement c-adplacement__container-column">
                                    @if ($banner3_exists)
                                        <a href="{{ $banner3->images()->first()->link }}"
                                           class="c-adplacement__item js-ad-placement-column-item c-adplacement__item--column"
                                           target="_blank" data-is-trackable=""
                                           title="{{ $banner3->images()->first()->alt }}">
                                            <div class="c-adplacement__sponsored_box">
                                                <img
                                                    src="{{ $banner3->images()->first()->media()->exists() ? $site_url . '/' . $banner3->images()->first()->media->first()->path . '/' . $banner3->images()->first()->media->first()->name : '' }}"
                                                    alt="{{ $banner3->images()->first()->media()->exists()
                                                    ? $banner3->images()->first()->alt
                                                    : '' }}" loading="lazy"/>
                                            </div>
                                        </a>
                                    @endif
                                    @if ($banner4_exists)
                                        <a href="{{ $banner4->images()->first()->link }}"
                                           class="c-adplacement__item js-ad-placement-column-item c-adplacement__item--column"
                                           target="_blank" data-is-trackable=""
                                           title="{{ $banner4->images()->first()->alt }}">
                                            <div class="c-adplacement__sponsored_box">
                                                <img
                                                    src="{{ $banner4->images()->first()->media()->exists() ? $site_url .'/' . $banner4->images()->first()->media->first()->path . '/' . $banner4->images()->first()->media->first()->name : '' }}"
                                                    alt="{{ $banner4->images()->first()->media()->exists() ? $banner4->images()->first()->alt : '' }}"
                                                    loading="lazy"/>
                                            </div>
                                        </a>
                                    @endif
                                </aside>
                            </div>
                        @endif
                    </div>
                </div>
            </article>


            @if(!is_null($amazing_offer_products) && count($amazing_offer_products))
                <div class="c-swiper-specials c-swiper-specials--incredible">
                    <section class="container container--home" id="sn-carousels-incredible-offer">
                        <a href="/incredible-offers/"
                           class="c-swiper-specials__title c-swiper-specials__title--incredible"
                           title="پیشنهاد شگفت‌انگیز">
                            <img src="{{ asset('assets\new\image\promotion_box.png') }}" alt="پیشنهاد شگفت‌انگیز">
                            <div class="o-btn c-swiper-specials__btn">مشاهده همه</div>
                        </a>
                        <div class="c-swiper c-swiper--products c-swiper--specials">
                            <div class="c-box">
                                <div class="swiper-container swiper-container-horizontal js-swiper-specials">
                                    <div class="swiper-wrapper">
                                        @foreach ($amazing_offer_products as $product)
                                            <div class="swiper-slide" data-carousel="sn-carousels-incredible-offer">
                                                <li>
                                                    <a href=""
                                                       class="c-product-box__box-link js-product-url js-carousel-ga-product-box"></a>
                                                    <div class="js-product-cart c-product-box c-product-box--product-card c-product-box--has-overflow
                                               c-product-box--card-macro c-product-box--plus-badge " title="">
                                                        <div class="c-product-box__img js-url js-snt-carousel_product"
                                                             title="{{ $product->title_fa }}">
                                                            <img alt="{{ $product->title_fa }}"
                                                                 src="{{ g_product_image_main_src($product) }}?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60"
                                                                 class="swiper-lazy swiper-lazy-loaded" loading="lazy"/>
                                                        </div>
                                                        <div class="c-product-box__title">
                                                            {{ $product->title_fa }}
                                                        </div>
                                                        <div class="c-product-box__row c-product-box__row--price">
                                                            <div class="c-price">
                                                                <div
                                                                    class="c-price__value c-price__value--plp js-price-complete-details">
                                                                    @if(!is_null(variantPromotionDefault(variant_defualt($product))))
                                                                        <del>{{ persianNum(number_format(toman(variant_defualt($product)->sale_price))) }}</del>
                                                                        <div class="c-price__discount-oval">
                                                                            <span>{{ persianNum(variantPromotionDefault(variant_defualt($product))->percent) }}٪</span>
                                                                        </div>
                                                                    @endif
                                                                    <div class="c-price__value-wrapper">
                                                                        {{ persianNum(number_format(toman(product_price($product)))) }}
                                                                        <span class="c-price__currency">تومان</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(!is_null(variantPromotionDefault(variant_defualt($product))))
                                                            <div class="c-product-box__amazing">
                                                                <div class="c-product-box__timer   js-counter"
                                                                     data-countdown="{{ variantPromotionDefault(variant_defualt($product))->end_at }}"></div>
                                                                <div class="c-product-box__remained"></div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </li>
                                            </div>
                                        @endforeach

                                        <div class="swiper-slide c-swiper__show-more-cart--auto-height">
                                            <a href="/incredible-offers/" class="c-swiper__show-more-cart"><span></span>
                                                <p>
                                                    مشاهده همه
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-button-prev js-swiper-button-prev"></div>
                                    <div class="swiper-button-next js-swiper-button-next"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endif
            <article class="container container--home">
                <div class="o-page">
                    <div class="o-page__row"></div>
                    <aside class="c-adplacement c-adplacement__container-row">
                        @if (!is_null($bannerGroup1) && $bannerGroup1->images()->exists())
                            @foreach ($bannerGroup1->images as $image)
                                @if ($image->media()->exists())
                                    <a href="{{ $image->link }}" class="c-adplacement__item js-banner-impression-adro"
                                       data-observed="1" target="_blank" data-is-trackable="" title="{{ $image->alt }}">
                                        <div class="c-adplacement__sponsored_box">
                                            <img src="{{ full_media_path($image->media->first()) }}"
                                                 alt="{{ $image->alt }}" loading="lazy">
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    </aside>
                </div>
            </article>
            @if(!is_null($special_offer_products) && count($special_offer_products))
                <div class="c-swiper-specials c-swiper-specials--incredible">
                    <section class="container container--home" id="sn-carousels-incredible-offer">
                        <a href="/incredible-offers/"
                           class="c-swiper-specials__title c-swiper-specials__title--incredible"
                           title="پیشنهاد شگفت‌انگیز">
                            <img src="{{ asset('assets\new\image\promotion_box.png') }}" alt="پیشنهاد شگفت‌انگیز">
                            <div class="o-btn c-swiper-specials__btn">مشاهده همه</div>
                        </a>
                        <div class="c-swiper c-swiper--products c-swiper--specials">
                            <div class="c-box">
                                <div class="swiper-container swiper-container-horizontal js-swiper-specials">
                                    <div class="swiper-wrapper">
                                        @foreach ($special_offer_products as $product)
                                            <div class="swiper-slide" data-carousel="sn-carousels-incredible-offer">
                                                <li>
                                                    <a href="{{ route('front.productPage', $product->product_code) }}"
                                                       class="c-product-box__box-link js-product-url js-carousel-ga-product-box"></a>
                                                    <div class="js-product-cart c-product-box c-product-box--product-card c-product-box--has-overflow
                                               c-product-box--card-macro c-product-box--plus-badge "
                                                         title="{{ $product->title_fa }}">
                                                        <div class="c-product-box__img js-url js-snt-carousel_product"
                                                             title="{{ $product->title_fa }}">
                                                            <img alt="{{ $product->title_fa }}"
                                                                 src="{{ g_product_image_main_src($product) }}?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60"
                                                                 class="swiper-lazy swiper-lazy-loaded" loading="lazy"/>
                                                        </div>
                                                        <div class="c-product-box__title">
                                                            {{ $product->title_fa }}
                                                        </div>

                                                        <div class="c-product-box__row c-product-box__row--price">
                                                            <div class="c-price">
                                                                <div
                                                                    class="c-price__value c-price__value--plp js-price-complete-details">
                                                                    @if(!is_null(variantPromotionDefault(variant_defualt($product))))
                                                                        <del>{{ persianNum(number_format(toman(variant_defualt($product)->sale_price))) }}</del>
                                                                        <div class="c-price__discount-oval">
                                                                            <span>{{ persianNum(variantPromotionDefault(variant_defualt($product))->percent) }}٪</span>
                                                                        </div>
                                                                    @endif
                                                                    <div class="c-price__value-wrapper">
                                                                        {{ persianNum(number_format(toman(product_price($product)))) }}
                                                                        <span class="c-price__currency">تومان</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(!is_null(variantPromotionDefault(variant_defualt($product))))
                                                            <div class="c-product-box__amazing">
                                                                <div class="c-product-box__timer   js-counter"
                                                                     data-countdown="{{ variantPromotionDefault(variant_defualt($product))->end_at }}"></div>
                                                                <div class="c-product-box__remained"></div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </li>
                                            </div>
                                        @endforeach

                                        <div class="swiper-slide c-swiper__show-more-cart--auto-height">
                                            <a href="/incredible-offers/" class="c-swiper__show-more-cart"><span></span>
                                                <p>
                                                    مشاهده همه
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-button-prev js-swiper-button-prev"></div>
                                    <div class="swiper-button-next js-swiper-button-next"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endif
            <article class="container container--home">

                <div class="o-page">
                    <aside class="c-adplacement">
                        @if (!is_null($bannerGroup2) && $bannerGroup2->images()->exists())
                            @foreach ($bannerGroup2->images as $image)
                                @if ($image->media()->exists())
                                    <a href="{{ $image->media()->exists() ? $image->link : '' }}"
                                       class="js-banner-impression-adro c-adplacement__item c-adplacement__item--b"
                                       data-observed="0" target="_blank"
                                       title="{{ $image->media()->exists() ? $image->alt : '' }}" data-is-trackable="">
                                        <div class="c-adplacement__sponsored_box">
                                            <img src="{{ full_media_path($image->media->first()) }}"
                                                 alt="{{ $image->media()->exists() ? $image->alt : '' }}"
                                                 loading="lazy"/>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    </aside>
                </div>


                <?php
                $second = 0;
                $default = 0;
                $avg = count($primary) / (count($secondary) ? count($secondary) : 1);
                $avg = floor($avg);
                ?>

                @foreach ($primary as $item)

                    @if ($primaryType == 'productSwiper')
                        @include('front::layouts.productSwiper',['item' => $item])
                    @else
                        @include('front::layouts.slider',['item' => $item])
                    @endif

                    <?php  $default++; ?>
                    @if ($default >= $avg)
                        @if (isset($secondary[$second]))
                            @if ($primaryType == 'productSwiper')
                                @include('front::layouts.slider',['item' => $secondary[$second]])
                            @else
                                @include('front::layouts.productSwiper',['item' => $secondary[$second]])
                            @endif
                            <?php
                            $second++;
                            $default = 0;
                            ?>
                        @endif
                    @endif
                @endforeach

                <div class="o-page">
                    <aside class="c-adplacement">
                        @if (!is_null($bannerGroup4) && $bannerGroup4->images()->exists())
                            @foreach ($bannerGroup4->images as $image)
                                @if ($image->media()->exists())
                                    <a href="{{ $image->media()->exists() ? $image->link : '' }}"
                                       class="js-banner-impression-adro c-adplacement__item c-adplacement__item--b"
                                       data-observed="0" target="_blank"
                                       title="{{ $image->media()->exists() ? $image->alt : '' }}" data-is-trackable="">
                                        <div class="c-adplacement__sponsored_box">
                                            <img src="{{ full_media_path($image->media->first()) }}"
                                                 alt="{{ $image->media()->exists() ? $image->alt : '' }}"
                                                 loading="lazy"/>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    </aside>
                </div>

                <div id="sidebar">
                    <aside>
                        @if ($banner5 && $banner5->status  == 'active' && $banner5->images()->exists() && $banner5->images()->first()->media()->exists())
                            <a href="{{ $banner5->images()->first()->link }}" class="c-adplacement__item"
                               target="_blank" title="{{ $banner5->images()->first()->alt }}">
                                <img src="{{ $banner5->images()->first()->media()->exists()
                                        ? $site_url . '/' . $banner5->images()->first()->media->first()->path . '/' . $banner5->images()->first()->media->first()->name : '' }}"
                                     alt="{{ $banner5->images()->first()->media()->exists() ? $banner5->images()->first()->alt : '' }}"
                                     loading="lazy"/>
                            </a>
                        @endif
                    </aside>
                </div>
            </article>
        </div>
    </main>
@endsection

@section('source')
    <div class="remodal c-remodal-account" data-remodal-id="login" role="dialog"
         aria-labelledby="modal1Title" aria-describedby="modal1Desc">

        <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>

        <div class="c-remodal-account__headline">
            ورود به {{ $fa_store_name }}
        </div>

        <div class="c-remodal-account__content">
            <form class="c-form-account" id="loginFormModal">
                <div class="c-message-light c-message-light--info" id="login-form-msg"></div>

                <div class="c-form-account__title">
                    پست الکترونیک یا شماره موبایل
                </div>

                <div class="c-form-account__row">
                    <div class="c-form-account__col">
                        <label class="c-ui-input c-ui-input--account-login">
                            <input class="c-ui-input__field" type="text" name="login[email_phone]"
                                   autocomplete="current-email" placeholder="info@diginova.com">
                        </label>
                    </div>
                </div>

                <div class="c-form-account__title">کلمه عبور</div>

                <div class="c-form-account__row">
                    <div class="c-form-account__col">
                        <label class="c-ui-input c-ui-input--account-password">
                            <input class="c-ui-input__field" name="login[password]" type="password"
                                autocomplete="current-password" placeholder="">
                        </label>
                    </div>
                </div>

                <div class="c-form-account__agree">
                    <label class="c-ui-checkbox c-ui-checkbox--primary">
                        <input type="checkbox" value="1" name="login[remember]" id="accountAutoLogin">
                        <span class="c-ui-checkbox__check"></span>
                    </label>
                    <label for="accountAutoLogin">
                        مرا به خاطر داشته باش
                    </label>
                </div>

                <div class="c-form-account__row c-form-account__row--submit">
                    <div class="c-form-account__col">
                        <button class="btn-login login-button-js">ورود به {{ $fa_store_name }}</button>
                    </div>
                </div>

                <div class="c-form-account__link">
                    <a data-snt-event="dkLoginClick" data-snt-params='{"type":"forgetPassword","site":"login-modal"}'
                       href="/users/password/forgot/" class="btn-link-spoiler">
                        رمز عبور خود را فراموش کرده‌ام
                    </a>
                </div>

                <div class="c-message-light c-message-light--error has-oneline" id="loginFormError">
                    نام کاربری یا کلمه عبور اشتباه است.
                </div>
            </form>
        </div>
        <div class="c-remodal-account__footer is-highlighted"><span>کاربر جدید هستید؟</span>
            <a data-snt-event="dkLoginClick" data-snt-params='{"type":"signup","site":"login-modal"}'
               href="/users/login-register/" class="btn-link-spoiler">
                ثبت‌نام در {{ $fa_store_name }}
            </a>
        </div>
    </div>

    <div class="remodal c-remodal-loader" data-remodal-id="loader"
         data-remodal-options="hashTracking: false, closeOnOutsideClick: false" role="dialog"
         aria-labelledby="modal1Title"
         aria-describedby="modal1Desc">
        <div class="c-remodal-loader__icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="115" height="30" viewBox="0 0 115 30">
                <path fill="#EE384E" fill-rule="evenodd"
                      d="M76.916 19.024h6.72v-8.78h-6.72c-1.16 0-2.24 1.061-2.24 2.195v4.39c0 1.134 1.08 2.195 2.24 2.195zm26.883 0h6.72v-8.78h-6.72c-1.16 0-2.24 1.061-2.24 2.195v4.39c0 1.134 1.08 2.195 2.24 2.195zM88.117 6.951v15.366c0 .484-.625 1.098-1.12 1.098l-2.24.023c-.496 0-1.12-.637-1.12-1.12v-.733l-1.017 1.196c-.31.413-1.074.634-1.597.634h-4.107c-3.604 0-6.721-3.063-6.721-6.586v-4.39c0-3.523 3.117-6.585 6.72-6.585h10.082c.495 0 1.12.613 1.12 1.097zm26.883 0v15.366c0 .484-.624 1.098-1.12 1.098l-2.24.023c-.496 0-1.12-.637-1.12-1.12v-.733l-1.017 1.196c-.31.413-1.074.634-1.597.634h-4.107c-3.604 0-6.721-3.063-6.721-6.586v-4.39c0-3.523 3.117-6.585 6.72-6.585h10.082c.495 0 1.12.613 1.12 1.097zm-74.675 3.293h-6.721c-1.16 0-2.24 1.061-2.24 2.195v4.39c0 1.134 1.08 2.195 2.24 2.195h6.72v-8.78zm4.48-3.293V23.78c0 3.523-3.117 6.22-6.72 6.22H34.62c-.515 0-1-.236-1.311-.638l-1.972-2.55c-.327-.424-.144-1.202.399-1.202h6.347c1.16 0 2.24-.696 2.24-1.83v-.365h-6.72c-3.604 0-6.72-3.063-6.72-6.586v-4.39c0-3.523 3.116-6.585 6.72-6.585h4.107c.514 0 1.074.405 1.437.731l1.177 1.098V6.95c0-.483.625-1.097 1.12-1.097h2.24c.496 0 1.12.613 1.12 1.097zM4.481 16.83c0 1.134 1.08 2.195 2.24 2.195h6.72v-8.78h-6.72c-1.16 0-2.24 1.061-2.24 2.195v4.39zM16.8 0c.497 0 1.121.613 1.121 1.098v21.22c0 .483-.624 1.097-1.12 1.097h-2.24c-.496 0-1.12-.613-1.12-1.098v-.732l-1.175 1.232c-.318.346-.932.598-1.44.598H6.722C3.117 23.415 0 20.352 0 16.829v-4.356c0-3.523 3.117-6.62 6.72-6.62h6.722V1.099c0-.485.624-1.098 1.12-1.098h2.24zm46.3 14.634L69.336 6.9c.347-.421.04-1.048-.513-1.048h-3.566c-.27 0-.525.119-.696.323l-6.314 7.727V1.098c0-.485-.625-1.098-1.12-1.098h-2.24c-.496 0-1.12.613-1.12 1.098v21.22c0 .483.624 1.097 1.12 1.097h2.24c.495 0 1.12-.614 1.12-1.098v-6.951l6.317 7.744c.17.207.428.328.7.328h3.562c.554 0 .86-.627.514-1.048l-6.24-7.756zM48.166 0c-.496 0-1.12.613-1.12 1.098v2.195c0 .484.624 1.097 1.12 1.097h2.24c.495 0 1.12-.613 1.12-1.097V1.098c0-.485-.625-1.098-1.12-1.098h-2.24zm0 5.854c-.496 0-1.12.613-1.12 1.097v15.366c0 .484.8 1.12 1.295 1.12l2.065-.022c.495 0 1.12-.614 1.12-1.098V6.951c0-.484-.625-1.097-1.12-1.097h-2.24zM21.282 0c-.495 0-1.12.613-1.12 1.098v2.195c0 .484.625 1.097 1.12 1.097h2.24c.496 0 1.12-.613 1.12-1.097V1.098c0-.485-.624-1.098-1.12-1.098h-2.24zm0 5.854c-.495 0-1.12.613-1.12 1.097v15.366c0 .484.625 1.098 1.12 1.098h2.24c.496 0 1.12-.614 1.12-1.098V6.951c0-.484-.624-1.097-1.12-1.097h-2.24zm73.556-4.756v21.22c0 .483-.625 1.097-1.12 1.097h-2.24c-.496 0-1.12-.614-1.12-1.098V1.097c0-.484.624-1.097 1.12-1.097h2.24c.495 0 1.12.613 1.12 1.098z"/>
            </svg>
        </div>
        <div class="c-remodal-loader__bullets">
            <i class="c-remodal-loader__bullet c-remodal-loader__bullet--1"></i>
            <i class="c-remodal-loader__bullet c-remodal-loader__bullet--2"></i>
            <i class="c-remodal-loader__bullet c-remodal-loader__bullet--3"></i>
            <i class="c-remodal-loader__bullet c-remodal-loader__bullet--4"></i>
        </div>
    </div>

    <div class="remodal c-remodal-general-alert" data-remodal-id="alert" role="dialog" aria-labelledby="modal1Title"
         aria-describedby="modal1Desc">
        <div class="c-remodal-general-alert__main">
            <div class="c-remodal-general-alert__content">
                <p class="js-remodal-general-alert__text"></p>
                <p class="c-remodal-general-alert__description js-remodal-general-alert__description"></p>
            </div>
            <div class="c-remodal-general-alert__actions">
                <button
                    class="c-remodal-general-alert__button c-remodal-general-alert__button--approve
                        js-remodal-general-alert__button--approve"></button>
                <button
                    class="c-remodal-general-alert__button c-remodal-general-alert__button--cancel
                        js-remodal-general-alert__button--cancel"></button>
            </div>
        </div>
    </div>

    <div class="remodal c-remodal-general-information" data-remodal-id="information" role="dialog"
         aria-labelledby="modal1Title" aria-describedby="modal1Desc">
        <div class="c-remodal-general-information__main">
            <div class="c-remodal-general-information__content">
                <p class="js-remodal-general-information__text"></p>
            </div>
            <div class="c-remodal-general-information__actions">
                <button class="c-remodal-general-information__button c-remodal-general-information__button--approve
                    js-remodal-general-information__button--approve"></button>
            </div>
        </div>
    </div>

    <div class="remodal c-remodal c-remodal-quick-view" data-remodal-id="quick-view" role="dialog"
         aria-labelledby="modal1Title" aria-describedby="modal1Desc">
        <button data-remodal-action="close" class="remodal-close c-remodal__close" aria-label="Close"></button>
        <div class="c-quick-view__content js-quick-view-section"></div>
    </div>

    <div class="c-toast__container js-toast-container">
        <div class="c-toast js-toast" style="display: none">
            <div class="c-toast__text js-toast-text"></div>
            <div class="c-toast__btn-container">
                <button type="button" class="js-toast-btn o-link o-link--sm o-link--no-border o-btn">
                    متوجه شدم
                </button>
            </div>
        </div>
    </div>

    <div class="remodal c-remodal-location js-general-location" data-remodal-id="general-location" role="dialog"
         aria-labelledby="modal1Title" aria-describedby="modal1Desc">
        <div class="c-remodal-location__header">
            <span class="js-general-location-title">انتخاب استان</span>
            <div class="c-remodal-location__close js-close-modal"></div>
        </div>
        <div class="c-remodal-location__content js-states-container">
            <div class="c-general-location__row c-general-location__row--your-location js-your-location">
                مکان‌یابی خودکار
            </div>
        </div>
        <div class="c-remodal-location__content js-cities-container">
            <div class="c-general-location__row c-general-location__row--back js-back-to-states">
                بازگشت به لیست استان‌ها
            </div>
        </div>
    </div>

    <div class="remodal c-remodal-location c-remodal-location--addresses js-general-location-addresses"
         data-remodal-id="general-location" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
        <div class="c-remodal-location__header">
            <span class="js-general-location-title">
                انتخاب آدرس
            </span>
            <div class="c-remodal-location__close js-close-modal"></div>
        </div>
        <div class="c-remodal-location__content js-addresses-container">
            <div class="c-ui-radio-wrapper c-ui-radio--general-location js-sample-address u-hidden">
                <label class="c-filter__label" for="generalLocationAddress"></label>
                <label class="c-ui-radio">
                    <input type="radio" value="" name="generalLocationAddress" id="generalLocationAddress">
                    <span class="c-ui-radio__check"></span>
                </label>
            </div>
            <a href="/addresses/add/" class="c-general-location__add-address js-general-location-add-address">
                افزودن آدرس جدید
            </a>
        </div>
    </div>
@endsection
