<?php
$category = $product->category->first();

do {
    $product_categories[] = $category;
    $category = $category->parent;
} while (isset($category->parent));

$product_categories[] = $category;
$product_categories = array_reverse($product_categories, true);
?>

@extends('layouts.front.master')

@section('head')
    <title>{{ 'ارسال نظر' . ' | ' . $fa_store_name  }}</title>
    <!-- SEO -->
    <meta name="description" content="{{ $product->seo()->exists() ? $product->seo->description : '' }}"/>
    <link rel="canonical" href="{{ route('front.createComment', ['product_code' => $product->product_code]) }}"/>

    <script>
        var supernova_mode = "production";
        var supernova_tracker_url = "https:\/\/etrackerd.digikala.com\/tracker\/events\/";
        var ratings = [];
        var factors = {
            @foreach($ratings as $rating)
            "{{ $rating->id }}": "{{ $rating->name }}",
            @endforeach
        };
        var productId = {{ $product->product_code }};
        var nowTimeInUTC = "2021-10-19 17:55:36";
        var productPageUrl = "{{ route('front.productPage', $product->product_code) }}";
        var userId = 9735394;
        var adroRCActivation = true;
        var loginRegisterUrlWithBack = "\/users\/login-register\/?_back=https:\/\/www.digikala.com\/product\/comment\/dkp-4877214";
        var isNewCustomer = false;
        var digiclubLuckyDrawEndTime = "2021-12-28 23:59:28";
        var activateUrl = "\/digiclub\/activate\/";
    </script>

    <script src="{{ asset('assets/js/sentry.js') }}"></script>
    <script src="{{ asset('assets/js/AddCommentAction.js') }}"></script>

    <style>
        body {
            background-color: #fff !important;
        }

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
@endsection

@section('content')
    <main id="main">
        <div id="HomePageTopBanner"></div>
        <div id="content">
            <div class="container">
                <section class="o-page">
                    <nav class="js-breadcrumb ">
                        <ul vocab="https://schema.org/" typeof="BreadcrumbList" class="c-breadcrumb">
                            <li property="itemListElement" typeof="ListItem">
                                <a property="item" typeof="WebPage" href="https://www.digikala.com">
                                    <span property="name">{{ $fa_store_name }}</span>
                                </a>
                                <meta property="position" content="1">
                            </li>

                            @foreach($product_categories as $key => $item)
                                <li property="itemListElement" typeof="ListItem">
                                    <a property="item" typeof="WebPage"
                                       href="{{ route('front.categoryPage', ['slug' => $item->slug]) }}">
                                        <span property="name">{{ $item->name }}</span>
                                    </a>
                                    <meta property="position" content="{{ $key+1 }}">
                                </li>
                            @endforeach

                            <li><span property="name">ارسال نظر</span></li>
                        </ul>
                    </nav>
                    <form id="addCommentForm" method="post">
                        <input type="hidden" name="rc" value="Nllhd0pFNmJkSEtvL3ZBSEYrSFpCZz09"/>
                        <input
                            type="hidden" name="rd"
                            value="Y2IzSG1CU3MwbXAvUEZtbWNIQ3NiTTlGUEg5Rkh3bC9GT0VNOERZTGRwcjkzYTFIOWxGM1lteFdhOVRNT0R1dA~~"/>
                        <div class="c-box">
                            <div class="c-comments-product">
                                <div class="c-comments-product__row js-valid-row">
                                    <div class="c-comments-product__col c-comments-product__col--gallery">
                                        <img src="" title="" alt="">
                                        @foreach($product->media as $image)
                                            @if($product->media && ($image->pivot->is_main == 1))
                                                <a href="">
                                                    <img src="{{ full_media_path($image) }}">
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="c-comments-product__col c-comments-product__col--info">
                                        <div class="c-comments-product__headline">
                                            <h3 class="c-comments-product__title">
                                                {{ $product->title_fa }}
                                                <span>{{ $product->title_fa }}</span>
                                            </h3>
                                        </div>

                                        <div class="c-comments-product__attributes">
                                            @foreach ($ratings as $key => $item)
                                                @if($key % 2)
                                                    @continue
                                                @endif
                                                @if ($key % 2 == 0)
                                                    <div class="c-comments-product__attributes-row">
                                                        @if ($key % 2 == 0)
                                                            @include('front::layouts.comment.rating-child-item', compact('item'))
                                                        @endif
                                                        @if (array_key_exists($key+1, $ratings->toArray()))
                                                            <?php $item = $ratings[$key + 1]; ?>
                                                            @include('front::layouts.comment.rating-child-item', compact('item'))
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="c-box">
                            <div class="c-comments-add">
                                <div class="c-comments-add__row">
                                    <div class="c-comments-add__col c-comments-add__col--form">
                                        <div class="c-form-comment">
                                            <div class="c-form-comment__row">
                                                <div class="c-form-comment__col ">
                                                    <div class="c-form-comment__title">عنوان نظر شما</div>
                                                    <label class="c-ui-input">
                                                        <input class="c-ui-input__field" type="text" name="title"
                                                               value=""
                                                               placeholder="عنوان نظر خود را بنویسید">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="c-form-comment__row">
                                                <div id="advantages"
                                                     class="c-form-comment__col c-form-comment__col--point">
                                                    <div class="c-form-comment__title c-form-comment__title--positive">
                                                        نقاط قوت
                                                    </div>
                                                    <div class="c-ui-input c-ui-input--add-point">
                                                        <input title="advantages" class="c-ui-input__field" type="text"
                                                               id="advantage-input"
                                                               value="">
                                                        <button class="c-ui-input__point js-icon-form-add" type="button"
                                                                style="display: none;"></button>
                                                    </div>
                                                    <div
                                                        class="c-form-comment__dynamic-labels js-advantages-list"></div>
                                                </div>
                                                <div id="disadvantages"
                                                     class="c-form-comment__col c-form-comment__col--point">
                                                    <div class="c-form-comment__title c-form-comment__title--negative">
                                                        نقاط
                                                        ضعف
                                                    </div>
                                                    <div class="c-ui-input c-ui-input--add-point">
                                                        <input title="disadvantages" class="c-ui-input__field"
                                                               type="text" id="disadvantage-input"
                                                               value="">
                                                        <button class="c-ui-input__point js-icon-form-add" type="button"
                                                                style="display: none;"></button>
                                                    </div>
                                                    <div
                                                        class="c-form-comment__dynamic-labels js-disadvantages-list"></div>
                                                </div>
                                            </div>
                                            <div class="c-form-comment__row js-valid-row">
                                                <div class="c-form-comment__col">
                                                    <div class="c-form-comment__title">متن نظر شما (اجباری)</div>
                                                    <label class="c-ui-textarea js-comment">
                            <textarea class="c-ui-textarea__field" name="text"
                                      placeholder="متن نظر خود را بنویسید"></textarea>
                                                    </label>
                                                </div>
                                            </div>
                                            @if(is_buyed($product))
                                                <div class="c-form-comment__row">
                                                    <div class="c-form-comment__col">
                                                        <div class="c-form-comment__questions"><p>آیا خرید این محصول را
                                                                به دوستانتان پیشنهاد می
                                                                کنید؟</p>
                                                            <ul>
                                                                <li>
                                                                    <label for="add-comment_question_1">پیشنهاد
                                                                        می‌کنم</label>
                                                                    <label class="c-ui-radio">
                                                                        <input type="radio" name="recommend"
                                                                               value="recommended"
                                                                               id="add-comment_question_1">
                                                                        <span class="c-ui-radio__check"></span>
                                                                    </label>
                                                                </li>
                                                                <li>
                                                                    <label for="add-comment_question_2">خیر ، پیشنهاد
                                                                        نمی‌کنم</label>
                                                                    <label class="c-ui-radio">
                                                                        <input type="radio" name="recommend"
                                                                               value="not_recommended"
                                                                               id="add-comment_question_2">
                                                                        <span class="c-ui-radio__check"></span>
                                                                    </label>
                                                                </li>
                                                                <li>
                                                                    <label for="add-comment_question_3">نظری
                                                                        ندارم</label>
                                                                    <label class="c-ui-radio">
                                                                        <input type="radio" name="recommend"
                                                                               value="no_idea"
                                                                               id="add-comment_question_3">
                                                                        <span class="c-ui-radio__check"></span>
                                                                    </label>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="c-form-comment__row">
                                                <div class="c-form-comment__col c-comments-anonymous">
                                                    <label class="c-ui-checkbox">
                                                        <input type="checkbox" name="is_anonymous" value=""
                                                               id="add_comment_anonymous">
                                                        <span class="c-ui-checkbox__check"></span>
                                                    </label>
                                                    <label for="add_comment_anonymous">
                                                        ارسال دیدگاه به صورت ناشناس
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="c-form-comment__row">
                                                <div class="c-form-comment__col c-form-comment__col--half-width">
                                                    <button data-id="{{ $product->id }}"
                                                            class="btn-default js-comment-submit-button"
                                                            type="submit">
                                                        ثبت نظر
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-comments-add__col c-comments-add__col--content">
                                        <h3>دیگران را با نوشتن نظرات خود، برای انتخاب این محصول راهنمایی کنید.</h3>
                                        <p>
                                        <span style="color:#2980b9">
                                            <strong>لطفا پیش از ارسال نظر، خلاصه قوانین زیر را مطالعه کنید:</strong>
                                        </span>
                                        </p>
                                        <ul>
                                            <li>لازم است محتوای ارسالی منطبق برعرف و شئونات جامعه و با بیانی رسمی و عاری
                                                از
                                                لحن تند، تمسخرو توهین باشد.
                                            </li>
                                            <li>از ارسال لینک&zwnj;های سایت&zwnj;های دیگر و ارایه&zwnj;ی اطلاعات شخصی
                                                خودتان
                                                مثل شماره تماس، ایمیل و آی&zwnj;دی شبکه&zwnj;های اجتماعی پرهیز کنید.
                                            </li>
                                            <li>
                                                <strong>در نظر داشته باشید هدف نهایی از ارائه&zwnj;ی نظر درباره&zwnj;ی
                                                    کالا
                                                    ارائه&zwnj;ی اطلاعات مشخص و دقیق برای راهنمایی سایر کاربران در
                                                    فرآیند
                                                    خرید یک محصول توسط ایشان است.</strong>
                                            </li>
                                            <li>با توجه به ساختار بخش نظرات، از پرسیدن سوال یا درخواست راهنمایی در این
                                                بخش
                                                خودداری کرده و سوالات خود را در بخش &laquo;پرسش و پاسخ&raquo; مطرح کنید.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
            <div class="remodal c-remodal-confirm" data-remodal-id="add-comment-success-modal" role="dialog"
                 aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
                <div class="c-remodal-confirm__icon c-remodal-confirm__icon--comment-success"></div>
                <div class="c-remodal-confirm__title">نظر شما ثبت گردید و پس از تایید، نمایش داده خواهد شد</div>
            </div>
        </div>
    </main>
@endsection
