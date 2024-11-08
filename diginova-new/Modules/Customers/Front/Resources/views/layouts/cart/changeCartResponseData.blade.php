<?php $has_changed = false; ?>
<section class=" {{ (auth()->guard('customer')->check())? 'c-checkout-empty__container' : 'o-page__content    ' }}  ">
    @if ($has_changed == true)
        <div class="c-message-light-small c-message-light-small--info c-message-light-small--cart">
            <h6>توجه : قیمت یا موجودی بعضی از کالاهای سبد خرید شما تغییر کرده است:</h6>
            <ul>
                @foreach ($first_carts as $item)
                    @if (defualtCartOldPrice($item) !== defualtCartNewPrice($item))
                        <li>قیمت {{ $item->product_variant()->first()->product->title_fa }}
                            به {{ persianNum(number_format(toman(defualtCartNewPrice($item)))) }} تومان تغییر کرده است.
                        </li>
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
                                <a class="c-cart-item__thumb-img {{ (!$has_count)? 'c-cart-item__thumb--inactive' : '' }}"
                                   href="{{ route('front.productPage', $product->product_code) }}" target="_blank">
                                    @foreach($product->media as $image)
                                        @if($product->media && ($image->pivot->is_main == 1))
                                            <img alt="{{ $product->title_fa }}"
                                                 src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60">
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
                                            <div
                                                class="c-cart-notification c-cart-notification--success c-cart-notification--arrow-down">
                                                قیمت این
                                                کالا {{ persianNum(number_format(toman($defualtCartOldPrice - $defualtCartNewPrice))) }}
                                                تومان کاهش یافته است.
                                            </div>
                                        @else
                                            <div
                                                class="c-cart-notification c-cart-notification--warning c-cart-notification--arrow-up">
                                                قیمت این
                                                کالا {{ persianNum(number_format(toman($defualtCartNewPrice - $defualtCartOldPrice))) }}
                                                تومان افزایش یافته است.
                                            </div>
                                        @endif
                                    @endif
                                @endif

                                @if (!$has_count)
                                    <div class="c-cart-item__product-notice-container">
                                        <div
                                            class="c-cart-notification c-cart-notification--error c-cart-notification--info">
                                            کالا ناموجود شده و به صورت خودکار از سبد حذف می‌شود.
                                        </div>
                                    </div>
                                @endif

                                <div
                                    class="c-cart-item__title {{ (!$has_count)? 'c-cart-item__title--inactive' : '' }}">
                                    {{ $product->title_fa }}
                                </div>

                                @if (!is_null($cart->product_variant()->first()->variant->value))
                                    <div
                                        class="c-cart-item__product-data c-cart-item__product-data--color {{ (!$has_count)? 'c-cart-item__product-data--inactive' : '' }}">
                                        <span
                                            style="background-color:{{ $cart->product_variant()->first()->variant->value }};"></span>
                                        {{ $cart->product_variant()->first()->variant->name }}
                                    </div>
                                @else
                                    <div
                                        class="c-cart-item__product-data c-cart-item__product-data--size {{ (!$has_count)? 'c-cart-item__product-data--inactive' : '' }}">
                                        {{ $cart->product_variant()->first()->variant->name }}
                                    </div>
                                @endif

                                <div
                                    class="c-cart-item__product-data c-cart-item__product-data--warranty {{ (!$has_count)? 'c-cart-item__product-data--inactive' : '' }}">
                                    {{ $cart->product_variant()->first()->warranty->name }}
                                </div>

                                @if ($has_count)
                                    <div class="c-cart-item__product-data c-cart-item__product-data--no-lead-time">
                                        موجود در انبار {{ $fa_store_name }}
                                        <span class="c-cart-item__product-sender-row">
                                        <span
                                            class="c-cart-item__product-sender-item c-cart-item__product-sender-item--digikala-no-leadtime">
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
                                                <button type="button"
                                                        class="c-quantity-selector__add js-quantity-selector-add {{ ($cart->count == $max_count)? 'c-quantity-selector__add--disabled' : '' }}"></button>
                                                <div class="c-quantity-selector__number js-quantity-selector-count"
                                                     data-max="{{ ($cart->product_variant()->first()->max_order_count < $cart->product_variant()->first()->stock_count)? $cart->product_variant()->first()->max_order_count : $cart->product_variant()->first()->stock_count }}"
                                                     data-id="{{ $cart->product_variant()->first()->id }}">
                                                    {{ persianNum($cart->count) }}
                                                </div>
                                                <button type="button"
                                                        class="c-quantity-selector__remove {{ ($cart->count == 1)? 'c-quantity-selector__add--disabled' : '' }} js-quantity-selector-remove"></button>
                                            </div>


                                            <a class="c-cart-item__delete js-remove-from-cart"
                                               href="/cart/remove/{{ $cart->product_variant()->first()->id }}/"
                                               data-id="{{ $cart->product_variant()->first()->id }}"
                                               data-product="{{ $cart->product_variant()->first()->product->id }}"
                                               data-variant="{{ $cart->product_variant()->first()->id }}"
                                               data-event="remove_from_cart"
                                                {{--                                           data-evnet-category="funnel"--}}
                                                {{--                                           data-enhanced-ecommerce="{&quot;id&quot;:4826524,&quot;name&quot;:&quot;درزگیر ترک سطوح نیپون مدل S100 وزن 1 کیلوگرم&quot;,&quot;category&quot;:&quot;TC&quot;,&quot;category_id&quot;:8265,&quot;brand&quot;:&quot;nippon-paint&quot;,&quot;variant&quot;:{{ $cart->product_variant()->first()->id }},&quot;price&quot;:415000,&quot;discount_percent&quot;:0,&quot;quantity&quot;:1}"--}}
                                                {{--                                           data-event-label="price: 415000, category: رنگ, items: 0"--}}
                                                {{--                                           data-gtm-vis-first-on-screen-9070001_346="2524"--}}
                                                {{--                                           data-gtm-vis-total-visible-time-9070001_346="100"--}}
                                                {{--                                           data-gtm-vis-has-fired-9070001_346="1"--}}
                                            >
                                                حذف
                                            </a>
                                            <a class="c-cart-item__save-for-later js-add-to-sfl"
                                               data-id="{{ $cart->product_variant()->first()->id }}"
                                               data-product="{{ $cart->product_variant()->first()->product->id }}"
                                               data-variant="{{ $cart->product_variant()->first()->id }}"
                                                {{--                                           data-gtm-vis-first-on-screen-9070001_346="2532"--}}
                                                {{--                                           data-gtm-vis-total-visible-time-9070001_346="100"--}}
                                                {{--                                           data-gtm-vis-has-fired-9070001_346="1"--}}
                                            >
                                                ذخیره در لیست خرید بعدی
                                            </a>
                                        </div>
                                        <div class="c-cart-item__product-price">
                                            {{ persianNum(number_format(toman($defualtCartNewPrice))) }}
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

                <?php $sum_promotion_price = 0; ?>
                @foreach($first_carts as $priceItem)
                    @if ($priceItem->new_sale_price > $priceItem->new_promotion_price)
                        <?php $sum_promotion_price += (($priceItem->new_sale_price - $priceItem->new_promotion_price) * $priceItem->count); ?>
                    @endif
                @endforeach

                @if($first_carts->sum('new_promotion_price') > 0)
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
          <span class="c-checkout-bill__item-title">
              جمع سبد خرید
          </span>
            <span class="c-checkout-bill__price">
              {{ persianNum(number_format(toman($sum_sale_price - $sum_promotion_price))) }}
            <span class="c-checkout-bill__currency">
                تومان
            </span>
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
