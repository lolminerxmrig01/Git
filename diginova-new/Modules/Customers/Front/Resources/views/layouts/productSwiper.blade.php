<?php
$products = $productSwipers->first()->category->products()
              ->whereHas('variants', function ($q){
                  $q->where('stock_count', '>', 0)->where('status', 1);
              })->whereStatus(1)->take(24)->get();
?>

<div class="swiper-products-container" data-type="homepagelatest">
    <section class="c-swiper c-swiper--products js-sntracker-carousel" id="sn-carousels-2">
        <div class="o-headline">
            <span class="o-headline__title-box">
                <div class="o-headline__title-content">
                    <h3>{{ $item->title }}</h3>
                    <p>{{ $item->description }}</p>
                </div>
            </span>
            <a href="{{ route('front.categoryPage', ['slug' => $item->category->slug ]) }}" class="c-swiper__show-more">مشاهده همه</a>
        </div>
        <div class="c-box" id="sn-carousels-2">
            <div class="swiper-container swiper-container-horizontal js-swiper-products">
                <div class="swiper-wrapper">
                  @foreach ($products as $product)
                    <div class="swiper-slide js-sntracker-carousel-item" data-carousel="sn-carousels-2" data-id="4504481"
                    data-position="2">
                        <div class="c-product-box">
                          <a data-id="4504481" class="c-product-box__img js-url js-product-url js-carousel-ga-product-box"
                           href="{{ route('front.productPage', $product->product_code) }}">
                            <img data-src-swiper="{{ g_product_image_main_src($product) }}?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60"
                             alt="{{ $product->title_fa }}" class="swiper-lazy">
                          </a>
                          <div class="c-product-box__title">
                            <a data-id="{{ $product->product_code }}" class="js-product-url js-carousel-ga-product-box"
                               href="{{ route('front.productPage', $product->product_code) }}">
                                {{ $product->title_fa }}
                            </a>
                          </div>
                          <div class="c-product-box__price-row">
                              <div class="c-product-box__price-item">
                                <a data-id="4504481" class="js-product-url js-carousel-ga-product-box" href="">
                                    <div class="c-new-price">
                                        @if(!is_null(variantPromotionDefault(variant_defualt($product))))
                                          <div class="c-new-price__old-value">
                                            <del>{{ persianNum(number_format(toman(variant_defualt($product)->sale_price))) }}</del>
                                            <div class="c-new-price__discount">
                                              <span>{{ persianNum(variantPromotionDefault(variant_defualt($product))->percent) }}٪</span>
                                            </div>
                                          </div>
                                        @endif
                                        <div class="c-new-price__value">
                                            {{ persianNum(number_format(toman(product_price($product)))) }}
                                            <span class="c-new-price__currency">تومان</span>
                                        </div>
                                    </div>
                                </a>
                              </div>
                          </div>
                        </div>
                    </div>
                  @endforeach
                    <!-- count: 24 -->
                </div>
                <div class="swiper-button-prev js-swiper-button-prev"></div>
                <div class="swiper-button-next js-swiper-button-next"></div>
            </div>
        </div>
    </section>
</div>
