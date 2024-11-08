
<div class="c-add-products__info-bar">
    <div class="c-add-products__product-count">
        <span class="c-add-products__product-count-value">{{ persianNum(count($product_variants)) }} کالا</span>برای قرارگیری در صفحه کالای اختصاصی انتخاب شده‌اند.
    </div>
    <div class="c-add-products__delete-products">
        <a class="c-add-products__delete-products-btn js-remove-all-added-product" href="#">حذف همه کالاها</a>
        <a class="c-add-products-item__undo-delete uk-hidden js-undo-remove-all" href="#">لغو حذف همه کالاها</a>
    </div>
</div>
<ul class="c-add-products__list">
    @foreach($product_variants as $product_variant)
      <li class="c-add-products-item js-product-item">
        <div class="c-add-products-item__promotion" style="visibility: hidden;">تخفیف و حراج</div>
        <a class="c-add-products-item__image-link" href="#" target="_blank">
            <img class="c-add-products-item__image" src="{{ $site_url . '/' . $product_variant->product->media()->first()->path . '/' . $product_variant->product->media()->first()->name }}"  alt="">
        </a>
        <span class="c-add-products-item__brand">{{ $product_variant->product->category()->first()->name }}</span>
        <div class="c-add-products-item__details">
            <a class="c-add-products-item__title" href="#">
                {{ $product_variant->product->title_fa }}
            </a>
            <div class="c-add-products-item__variants">
                <span class="c-add-products-item__dkp">{{ $product_code_prefix }}C-{{ $product_variant->variant_code }}</span>
                <span class="c-add-products-item__color">
                    @if(!is_null($product_variant->variant->value))
                        <span class="c-add-products-item__color-square" style="background: {{ $product_variant->variant->value }}"></span>
                    @endif
                </span>
                {{ $product_variant->variant->name }}
            </div>
            <div class="c-add-products-item__guarantee">
                @if(!is_null($product_variant->warranty->month))
                    گارانتی {{ persianNum($product_variant->warranty->month) }} ماهه {{ $product_variant->warranty->name }}
                @else
                    گارانتی {{ $product_variant->warranty->name }}
                @endif
            </div>
        </div>
        <div class="c-add-products-item__price">
            <span class="c-add-products-item__new-price">
                <span class="c-add-products-item__new-price-value">{{ persianNum(number_format($product_variant->sale_price/10)) }}</span>
                تومان
            </span>
        </div>
        <div class="c-add-products-item__action">
            <button class="c-add-products-item__delete-btn js-remove-product" data-variant_id="{{ $product_variant->id }}"
                    data-promotion_variant_id="{{ $product_variant->id }}"></button>
{{--            <div class="c-join__has-more-info">--}}
{{--                <div class="c-join__has-floating-box c-join__more-info c-join__more-info--details c-join__more-info--shown c-add-products-item__more-info">--}}
{{--                    <div class="c-join__floating-box c-add-products-item__floating-box">--}}
{{--                        <div class="c-joiFn__floating-content">--}}
{{--                                <span>--}}
{{--                                    کد کالا ({{ $product_code_prefix }}): {{ $product_variant->product->product_code }}--}}
{{--                                </span>--}}
{{--                        </div>--}}
{{--                        <div class="c-join__floating-content">--}}
{{--                                <span>--}}
{{--                                    بازدید ۷ روز گذشته: ۴۳--}}
{{--                                </span>--}}
{{--                            <span>--}}
{{--                                    فروش ۷ روز گذشته: ۰--}}
{{--                                </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="uk-hidden js-remove-overlay">
            <div class="c-add-products-item__overlay">

            </div>
            <div class="c-add-products-item__action c-add-products-item__action--overlay">
                <span class="c-add-products-item__deleted">کالا حذف شد</span>
                <a href="#" class="c-add-products-item__undo-delete js-undo-remove-button" data-promotion_variant_id="{{ $product_variant->id }}">لغو حذف</a>
            </div>
        </div>
    </li>
    @endforeach
</ul>
