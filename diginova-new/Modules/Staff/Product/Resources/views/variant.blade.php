@extends('layouts.staff.master')
@section('title') مدیریت تنوع ها | {{ $fa_store_name }}  @endsection
@section('head')
<script src="{{ asset('mehdi/staff/js/variantIndexAction.js') }}"></script>


<script>
var supernova_mode = "production";
var supernova_tracker_url = "";
var readOnly = false;
var variationPairs = [];
var maxVariantsCount = 139;
var isShipBySellerModuleActive = false;
var dimensionLevel = "product";
var dimension = {"length":{"min":1,"max":20000},"width":{"min":1,"max":20000},"height":{"min":1,"max":20000},"weight":{"min":1,"max":9999000}};
var hasDimensionConfig = false;
var showRejectedMessage = 0;
var rejectedMessage = "";
var isLoggedSeller = 1;
var walkthroughSteps = [];
var showPriceModal = 0;
var newSeller = 1;
var is_yalda = 0;

@if(isset($product->category()->first()->variantGroup()->first()->type)
    && $product->category()->first()->variantGroup()->first()->type !== 0)
  var coloredMode = true;
@else
  var noColorNoSizeMode = true;
@endif
</script>

@endsection

@section('content')

@php
    $product_code_prefix = $settings->where('name', 'product_code_prefix')->first()->value;
    $product_title_prefix = $settings->where('name', 'product_title_prefix')->first()->value;
@endphp

<main class="c-content-layout">
    <div class="uk-container uk-container-large">
        <div class="c-grid">
            <div class="c-content-page c-content-page--plain c-grid__row">
                <div class="c-grid__col">
                    <div class="c-content-page__header">
                        <span class="c-content-page__header-action">ایجاد تنوع برای محصول</span>
                        <span class="c-content-page__header-desc">برای محصولات تنوع کالایی ایجاد کنید.</span>
                    </div>
                </div>
            </div>
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <div class="c-card">
                        <div class="c-grid__row">
                            <div class="c-grid__col">
                                <div class="c-variant">
                                    <form class="c-variant__form" id="productVariantsForm" data-max-variants=""
                                          novalidate="novalidate">
                                        <input type="hidden" name="product_variants[product_id]" value="{{ $product->id }}">
                                        <input type="hidden" name="product_variants[variation_theme]" value="sized">
                                        <div class="c-content-modal__notes">
                                            <span class="c-content-modal__notes-title">توجه:</span>
                                            <ul class="c-content-modal__notes-list">
                                                <li>لطفاً قبل از درج تنوع، مشخصات فنی کالا (مانند: رنگ، ابعاد، اقلام
                                                    همراه کالا، جنس کالا، تصویر بسته‌بندی و ...) را چک کرده
                                                    و اطمینان حاصل کنید که تنوع شما با مشخصات فنی کالا
                                                    مطابقت داشته باشد.
                                                </li>
                                                <li style="margin-top:10px;">
                                                    منظور از <u>قیمت خرید</u> قیمتی است که شما آن محصول را خریداری کرده‌اید.
                                                </li>

                                                <li>
                                                    منظور از <u>قیمت فروش</u> قیمتی است که شما برای فروش محصول در نظر گرفتید.
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="c-variant-error c-variant-error__box mt-20 mb-20 hidden">

                                        </div>
                                        <div class="c-variant__header">
                                            <div class="c-variant__img-container">
                                              @if(count($product->media))
                                                @foreach($product->media as $image)
                                                  @if($product->media && ($image->pivot->is_main == 1))
                                                    <img src="{{ full_media_path($image) }}" width="75" height="75">
                                                  @endif
                                                @endforeach
                                              @else
                                                <img src="{{ asset('mehdi/staff/images/default-picture.png') }}"  class="c-variant__img">
                                              @endif
                                            </div>
                                            <div class="c-variant__descr">
                                                <h2 class="c-variant__title">
                                                    {{ $product->title_fa }}
                                                </h2>
                                                <div class="c-variant__sub-title"></div>
                                                <div
                                                    class="c-variant__secondary-info c-variant__secondary-info--top">
                                                    <ul class="c-variant__secondary-info--table">
                                                        <li class="c-variant__secondary-info--table-row">
                                                            <div class="c-variant__secondary-info--table-cell">
                                                                <span class="c-variant__info">دسته‌بندی:</span>
                                                                <span class="c-variant__info--main">
                                                                    {{ $product->category()->first()->name }}
                                                                </span>
                                                            </div>

                                                            <div class="c-variant__secondary-info--table-cell">
                                                                <span class="c-variant__info">تنوع مجاز این کالا:</span>
                                                                <span class="c-variant__info--main">
                                                                    {{ $product->category()->first()->variantGroup()->first()->name }}
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li class="c-variant__secondary-info--table-row">
                                                            <div class="c-variant__secondary-info--table-cell">
                                                                <span class="c-variant__info">ابعاد بسته‌بندی محصول (ارتفاع×عرض×طول):</span>
                                                                <span
                                                                    class="c-variant__info--main">{{ persianNum($product->length) }}x{{ persianNum($product->width) }}x{{ persianNum($product->height) }} سانتیمتر</span>
                                                            </div>
                                                            <div class="c-variant__secondary-info--table-cell">
                                                                <span class="c-variant__info">وزن بسته‌بندی محصول:</span>
                                                                <span class="c-variant__info--main">{{ persianNum($product->weight) }} گرم</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-variant__body">
                                            @if($product->category()->first()->variantGroup()->first()->type !== 0)
                                            <div class="c-grid__row c-grid__row--gap-lg">
                                                <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                                    <label for="" class="uk-form-label uk-flex uk-flex-between">
                                                        انتخاب  {{ $product->category()->first()->variantGroup()->first()->name }} کالا:
                                                        <span class="uk-form-label__required"></span>
                                                        <a target="_blank" href="{{ route('staff.variants.edit', ['id' => $product->category()->first()->variantGroup()->first()->id ]) }}" class="search-link" id="newSizeRequestModalBtn">ایجاد
                                                            {{ $product->category()->first()->variantGroup()->first()->name }} جدید</a>
                                                    </label>
                                                    <div class="field-wrapper" id="attributesContainer">
                                                        <div class="c-variant__attributes-container">
                                                            @foreach($product->category()->first()->variantGroup()->first()->variants->where('status', 1) as $variant)
                                                            <button type="button" class="c-variant-btn js-add-variant" id="attribute_{{ $variant->id }}" data-attribute-value="{{ $variant->name }}" data-attribute-id="{{ $variant->id }}" data-hex="{{ (!is_null($variant->value))? $variant->value : '' }}" data-title="{{ $variant->name }}">
                                                                <span class="c-variant-btn__label">
                                                                @if(!is_null($variant->value))
                                                                <span class="c-variant-btn__color js-variant-hex" style="background-color: {{ $variant->value }};"></span>
                                                                @endif
                                                                <span class="c-variant-btn__text">{{ $variant->name }}</span>
                                                                    <span class="c-variant-btn__counter hidden">
                                                                        (<span class="js-variant-count"></span>)
                                                                    </span>
                                                                </span>
                                                            </button>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="c-variant-error c-variant-error__box mt-20 mb-20 hidden"
                                                 id="ajaxErrorsList">
                                            </div>
                                            <div class="c-variant-success c-variant-success__box mt-20 mb-20 hidden"
                                                 id="ajaxSuccessList">
                                                <div>تنوع‌های شما با موفقیت ذخیره شدند</div>
                                            </div>
                                            <div class="c-grid__row c-grid__row--gap-lg mt-30">
                                                <div id="variantsContainer" class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial relative">
                                                    <div class="c-content-loader">
                                                        <div class="c-content-loader__logo"></div>
                                                        <div class="c-content-loader__spinner"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="c-grid__row c-grid__row--gap-lg">
                                                <div class="c-grid__col c-grid__col--gap-lg">
                                                    <button type="button" class="c-ui-btn c-ui-btn--dkpc hidden" id="saveNewVariantsButton">
                                                        افزودن به لیست تنوع
                                                    </button>
                                                    @if($product->category()->first()->variantGroup()->first()->type == 0)
                                                        <button type="button" class="c-ui-btn c-ui-btn--add c-ui-btn--dkpc js-add-variant">
                                                            افزودن تنوع جدید
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="c-variant__form {{ (count($product->variants) == 0)? 'hidden' : '' }}" id="productVariantsContainer">
                                        <input type="hidden" class="js-static-form-data" name="search[product_id]" value="{{ $product->id }}">

                                        <div class="c-grid__row js-table-container">
                                            <div class="c-grid__col">
                                                <div class="c-variation-diversity">
                                                    <div class="c-variation-diversity__header">
                                                        <div class="c-variation-diversity__title">لیست تنوع‌ها</div>

                                                        <div class="c-card__paginator">
                                                            <div class="c-ui-paginator js-paginator">
                                                                <div class="c-ui-paginator__total" data-rows="۱">
                                                                    تعداد نتایج: <span>{{ persianNum(count($product->variants)) }} مورد</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="c-variation-diversity__list">
                                                        <table class="c-ui-table   js-search-table " data-sort-column="product_variant_id" data-sort-order="desc"
                                                               data-search-url="{{ route('staff.products.ajaxVariantsList') }}"
                                                               data-auto-reload-seconds="0" data-new-ui="1" data-is-header-floating="1" data-has-checkboxes="">
                                                            <thead>
                                                            <tr class="c-ui-table__row">
                                                                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                                                                    <span class="js-search-table-column">ردیف</span>
                                                                </th>
                                                                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                                                                    <span class="js-search-table-column">عنوان تنوع کالا</span>
                                                                </th>
                                                                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                                                                    <span class="js-search-table-column">عنوان گارانتی</span>
                                                                </th>
                                                                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                                                                    <span class="js-search-table-column">کد تنوع ({{ $product_code_prefix }}C)</span>
                                                                </th>
                                                                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                                                                    <span class="js-search-table-column">ارسال توسط</span>
                                                                </th>
                                                                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                                                                    <span class="js-search-table-column">وضعیت</span>
                                                                </th>
                                                                <th class="c-ui-table__header c-ui-table__header--nowrap">
                                                                    <span class="js-search-table-column">عملیات</span>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @php
                                                                $product_variants = $product->variants()->paginate(10000000);
                                                            @endphp

                                                            @foreach($product_variants as $key => $product_variant)
                                                                <tr class="c-variation-diversity__item c-variation-diversity__item--top js-variant-row"
                                                                    id="productVariantViewRow_{{ $product_variant->id }}" style="text-align: center;">
                                                                    <td class="c-variation-diversity__count">{{ persianNum($product_variants->firstItem() + $key) }}</td>
                                                                    <td class="c-variation-diversity__title">
                                                                        @if(isset($product_variant->variant->value) && !is_null($product_variant->variant->value))
                                                                            <span class="c-variant-checkbox__color" style="background-color: {{ $product_variant->variant->value }};"></span>
                                                                        @endif
                                                                        @if(isset($product_variant->variant))
                                                                            <span class="js-variant-attribute-title">{{ $product_variant->variant->name }}</span>
                                                                        @endif
                                                                    </td>
                                                                    @if(!is_null($product_variant->warranty->month))
                                                                        <td class="c-variation-diversity__warranty"> گارانتی {{ persianNum($product_variant->warranty->month) }} ماهه {{ $product_variant->warranty->name }} </td>
                                                                    @else
                                                                        <td class="c-variation-diversity__warranty"> گارانتی {{ $product_variant->warranty->name }} </td>
                                                                    @endif
                                                                    <td class="c-variation-diversity__code">{{ $product_variant->variant_code }}</td>
                                                                    <td>
                                                                        <span>{{ ($product_variant->shipping_type == 'site')? $fa_store_name : 'فروشنده'  }}</span>
                                                                    </td>
                                                                    <td class="status_lable">
                                                                        <center>
                                                                            @if($product_variant->status == 1)
                                                                                <span id="span_{{ $product_variant->id }}" class="status_lable c-wallet__body-card-status-no-circle c-wallet__body-card-status-no-circle--active uk-text-nowrap">فعال</span>
                                                                            @else
                                                                                <span id="span_{{ $product_variant->id }}" class="status_lable c-wallet__body-card-status-no-circle c-wallet__body-card-status-no-circle--danger uk-text-nowrap">غیرفعال</span>
                                                                            @endif
                                                                        </center>
                                                                    </td>
                                                                    <td class="c-variation-diversity__status js-view-active" style="">
                                                                        <div style="margin:auto;">
                                                                            <button type="button" class="c-ui-btn c-ui-btn--delete js-variant-remove-btn delete-btn" data-id="{{ $product_variant->id }}" style="float: right;border-color: #e6eaef;background-color: #f9fafc;width: 35px;height: 34px;">
                                                                                <span class="c-variant__tooltip c-variant__tooltip--btn" style="margin-left: -9px;">حدف تنوع</span>
                                                                            </button>
                                                                            <button type="button" class="c-ui-btn c-ui-btn--edit js-variant-edit-btn" data-id="{{ $product_variant->id }}" style="float: right;margin-right: 11px;">
                                                                                <span class="c-variant__tooltip c-variant__tooltip--btn" style="margin-left: -9px;">ویرایش تنوع</span>
                                                                            </button>
                                                                            @include('staffproduct::layouts.modal')
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="c-variation-diversity__item c-variation-diversity__item--bottom js-variant-row" id="productVariantEditRow_{{ $product_variant->id }}" data-size="">
                                                                    <td colspan="9">
                                                                        <form id="editVariant_{{ $product_variant->id }}">
                                                                            <input type="hidden" name="product_variant[product_id]" value="{{ $product->id }}">
                                                                            <input type="hidden" name="product_variant[product_variant_id]" value="{{ $product_variant->id }}">
                                                                            <div class="c-variation-diversity__separator">
                                                                                <div class="c-variant__secondary-info">

                                                                                    <div class="c-variant__secondary-item">
                                                                                        <span class="c-variant__info">قیمت خرید (ریال):</span>
                                                                                        <span type="text" class="c-variant__info--main js-view-buy-price">
                                                                                            <span dir="ltr" data-debug="{{ persianNum($product_variant->buy_price) }}">{{ persianNum($product_variant->buy_price) }}</span>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="c-variant__secondary-item">
                                                                                        <span class="c-variant__info">قیمت فروش (ریال):</span>
                                                                                        <span class="c-variant__info--main js-view-price">
                                                                                            <span dir="ltr" data-debug="{{ persianNum($product_variant->sale_price) }}">{{ persianNum($product_variant->sale_price) }}</span>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="c-variant__secondary-item">
                                                                                        <span class="c-variant__info">بازه زمانی ارسال (روز):</span>
                                                                                        <span class="c-variant__info--main js-view-lead-time">{{ persianNum($product_variant->post_time) }}</span>
                                                                                    </div>
                                                                                    <div class="c-variant__secondary-item">
                                                                                        <span class="c-variant__info">حداکثر سفارش در سبد (عدد):</span>
                                                                                        <span class="c-variant__info--main js-view-order-limit">{{ persianNum($product_variant->max_order_count) }}</span>
                                                                                    </div>
                                                                                    <div class="c-variant__secondary-item">
                                                                                        <span class="c-variant__info">موجودی نزد شما (عدد):</span>
                                                                                        <span class="c-variant__info--main js-view-marketplace-seller-stock">{{ persianNum($product_variant->stock_count) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="c-variation-diversity__warning js-save-warning"></div>
                                                                                <div class="c-variant__secondary-info c-variant__secondary-info--edit"
                                                                                     id="metaEditFormVariant_{{ $product_variant->id }}">
                                                                                    <div class="c-grid__row c-grid__row--gap-lg">
                                                                                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--flex-initial">
                                                                                            <label class="uk-form-label">ارسال توسط:
                                                                                                <span class="uk-form-label__required"></span>
                                                                                            </label>
                                                                                            <div class="field-wrapper field-wrapper--background uk-flex uk-flex-middle js-checkbox-group-container">
                                                                                                <label class="c-ui-checkbox c-ui-checkbox--gap-sm disabled">
                                                                                                    <input type="checkbox" class="c-ui-checkbox__origin js-checkbox-group js-shipping-type-digikala" name="product_variant[shipping_type_digikala]" data-default-value="1" value="1" {{ ($product_variant->shipping_type == 'site')? 'checked' : '' }}>
                                                                                                    <span class="c-ui-checkbox__check c-ui-checkbox__check--small"></span>
                                                                                                    <span class="c-ui-checkbox__label">{{ $fa_store_name }}</span>
                                                                                                </label>
                                                                                                <label class="c-ui-checkbox c-ui-checkbox--gap-sm disabled">
                                                                                                    <input type="checkbox" class="c-ui-checkbox__origin js-checkbox-group js-shipping-type-seller" name="product_variant[shipping_type_seller]" data-default-value="0" value="1" disabled>
                                                                                                    <span class="c-ui-checkbox__check c-ui-checkbox__check--small"></span>
                                                                                                    <span class="c-ui-checkbox__label">فروشنده</span>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--flex-initial">
                                                                                            <label class="uk-form-label">فعال / غیرفعال:
                                                                                                <span class="uk-form-label__required"></span>
                                                                                            </label>
                                                                                            <div class="field-wrapper field-wrapper--background uk-flex uk-flex-middle">
                                                                                                <label class="c-ui-checkbox">
                                                                                                    <input type="checkbox" id="status_{{ $product_variant->id }}" class="c-ui-checkbox__origin " name="product_variant[active]" data-default-value="0"
                                                                                                           data-id="{{ $product_variant->id }}" {{ ($product_variant->status)? 'checked' : '' }}>
                                                                                                    <span class="c-ui-checkbox__check c-ui-checkbox__check--small"></span>
                                                                                                    <span class="c-ui-checkbox__label">فعال / غیرفعال</span>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="uk-flex uk-flex-wrap mt-30 w-100">
                                                                                        <div class="c-grid__col c-ui--mt-20 c-grid__col--sm-2 c-grid__col--flex-initial">
                                                                                            <span class="uk-form-label"> بازه زمانی ارسال (روز):
                                                                                                <span class="uk-form-label__required"></span>
                                                                                            </span>
                                                                                            <div class="field-wrapper">
                                                                                                <input type="text" class="uk-input js-variant-post-time" name="product_variant[lead_time]" value="{{ $product_variant->post_time }}">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="c-grid__col c-ui--mt-20 c-grid__col--sm-2 c-grid__col--flex-initial">
                                                                                            <span class="uk-form-label"> حداکثر سفارش در سبد (عدد):
                                                                                                <span class="uk-form-label__required"></span>
                                                                                            </span>
                                                                                            <div class="field-wrapper">
                                                                                                <input type="text" name="product_variant[order_limit]" class="uk-input js-edit-order-limit" data-default-value="" value="{{ $product_variant->max_order_count }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="c-grid__col c-ui--mt-20 c-grid__col--sm-2 c-grid__col--flex-initial">
                                                                                            <span class="uk-form-label"> موجودی نزد شما (عدد):
                                                                                                <span class="uk-form-label__required"></span>
                                                                                            </span>
                                                                                            <div class="field-wrapper">
                                                                                                <input type="text" name="product_variant[marketplace_seller_stock]" class="uk-input js-edit-marketplace-seller-stock"
                                                                                                       value="{{ $product_variant->stock_count }}" data-default-value="1">
                                                                                                <input type="hidden" name="product_variant[marketplace_seller_old_stock]" class="uk-input js-edit-marketplace-seller-old-stock"
                                                                                                       value="{{ $product_variant->stock_count }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="c-grid__col c-ui--mt-20 c-grid__col--sm-2 c-grid__col--flex-initial">
                                                                                            <label class="uk-form-label">
                                                                                                قیمت خرید (ریال):
                                                                                            </label>
                                                                                            <div class="field-wrapper">
                                                                                                <input type="text" name="product_variant[buy_price]" data-editable="true" class="uk-input dk-currency js-edit-buy-price js-gold-final-price"
                                                                                                       data-default-value="{{ $product_variant->buy_price }}" value="{{ $product_variant->buy_price }}">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="c-grid__col c-ui--mt-20 c-grid__col--sm-2 c-grid__col--flex-initial">
                                                                                            <span class="uk-form-label"> قیمت فروش (ریال):
                                                                                                <span class="uk-form-label__required"></span>
                                                                                            </span>
                                                                                            <div class="field-wrapper">
                                                                                                <input type="text" name="product_variant[price]" data-editable="true" class="uk-input dk-currency js-edit-price js-gold-final-price"
                                                                                                    data-default-value="{{ $product_variant->sale_price }}" value="{{ $product_variant->sale_price }}">
                                                                                            </div>
                                                                                        </div>


                                                                                        <div class="c-variant__btn-controls">
                                                                                            <div class="has-error has-error--footer js-edit-error hidden"></div>
                                                                                            <button class="c-ui-btn c-ui-btn--next mr-a js-variant-save-edit"
                                                                                                    data-id="{{ $product_variant->id }}">
                                                                                                ذخیره سازی
                                                                                            </button>
                                                                                            <button type="button" class="c-content-categories__search-reset js-variant-cancel-edit" data-id="{{ $product_variant->id }}"></button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="c-content-loader">
                                                                                        <div class="c-content-loader__logo"></div>
                                                                                        <div class="c-content-loader__spinner"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="c-variation-diversity__footer">

                                                        <div class="c-card__paginator">
                                                            <div class="c-ui-paginator js-paginator">
                                                                <div class="c-ui-paginator__total" data-rows="۱">
                                                                    تعداد نتایج: <span>{{ persianNum(count($product->variants)) }} مورد</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="c-card__loading"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="c-content-loader">
                                            <div class="c-content-loader__logo"></div>
                                            <div class="c-content-loader__spinner"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="productVariantTemplate" class="hidden">
            <div class="c-variant-box js-new-variant-container" data-max_lead_time="3">
                <input type="hidden" class="js-variant-iterator" name="product_variants[variants][]" value="">
                <input type="hidden" class="js-variant-attribute-id" name="" value="">
                <div class="c-variant-box__main">
                    <button type="button"
                            class="c-ui-btn c-ui-btn--clear-form c-variant-box__clear-form c-variant-box__clear-form--absolute js-remove-variant"
                            data-attribute-id=""></button>

                    <div class="c-grid__row c-grid__row--gap-lg">
                        @if($product->category()->first()->variantGroup()->first()->type !== 0)
                            <div class="c-grid__col c-grid__col--sm-2 c-grid__col--flex-initial">
                                <label class="uk-form-label">
                                    {{ $product->category()->first()->variantGroup()->first()->name }} کالا:
                                </label>
                                <div class="field-wrapper">
                                    <div class="uk-input uk-flex uk-flex-middle readonly">
                                        @if(isset($variant->value) && !is_null($variant->value))
                                        <span class="c-variant-checkbox__color js-variant-color-hex"></span>
                                        @endif
                                        <span class="js-variant-attribute-title"></span>
                                    </div>
                                </div>
           +                 </div>
                        @endif
                        <div class="c-grid__col c-grid__col--flex-initial c-grid__col--sm-10">
                            <label class="uk-form-label uk-flex uk-flex-between">
                                گارانتی کالا:
                                <span class="uk-form-label__required"></span>
                                <a href="{{ route('staff.warranties.create') }}" target="_blank" class="search-link">ایجاد گارانتی جدید</a>
                            </label>
                            <div class="field-wrapper ui-select ui-select__container">
                                <select name="" class="uk-input uk-input--select js-variant-warranty" data-placeholder="لطفا گارانتی را انتخاب کنید">
                                    <option></option>
                                    <option value="1">
                                        {{ \Modules\Staff\Warranty\Models\Warranty::find(1)->name }}
                                    </option>
                                    @if(count($warranties))
                                        @foreach($warranties->where('id', '!==', 1) as $warranty)
                                            @if(!is_null($warranty->month))
                                                <option value="{{ $warranty->id }}">گارانتی {{ persianNum($warranty->month) }} ماهه {{ $warranty->name }}</option>
                                            @else
                                                <option value="{{ $warranty->id }}">گارانتی {{ $warranty->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                <div class="js-select-options"></div>
                            </div>
                        </div>
                    </div>
                    <div class="c-grid__row c-grid__row--gap-lg">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--flex-initial">
                            <label class="uk-form-label">ارسال توسط:
                                <span class="uk-form-label__required"></span>
                            </label>
                            <div
                                class="field-wrapper field-wrapper--background uk-flex uk-flex-middle js-checkbox-group-container">
                                <label class="c-ui-checkbox c-ui-checkbox--gap-sm disabled">
                                    <input type="checkbox"
                                           class="c-ui-checkbox__origin js-variant-shipping-type-digikala js-checkbox-group"
                                           name="" value="1" checked="">
                                    <span class="c-ui-checkbox__check c-ui-checkbox__check--small"></span>
                                    <span class="c-ui-checkbox__label">{{ $fa_store_name }}</span>
                                </label>
                                <label class="c-ui-checkbox c-ui-checkbox--gap-sm disabled">
                                    <input type="checkbox"
                                           class="c-ui-checkbox__origin js-variant-shipping-type-seller js-checkbox-group"
                                           name="">
                                    <span class="c-ui-checkbox__check c-ui-checkbox__check--small"></span>
                                    <span class="c-ui-checkbox__label">فروشنده</span>
                                </label>
                            </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--flex-initial">
                            <label class="uk-form-label">فعال / غیرفعال:
                                <span class="uk-form-label__required"></span>
                            </label>
                            <div class="field-wrapper field-wrapper--background uk-flex uk-flex-middle">
                                <label class="c-ui-checkbox">
                                    <input type="checkbox" class="c-ui-checkbox__origin js-variant-active" name=""
                                           value="1" checked="">
                                    <span class="c-ui-checkbox__check c-ui-checkbox__check--small"></span>
                                    <span class="c-ui-checkbox__label">فعال / غیرفعال</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="c-grid__row c-grid__row--gap-lg">
                        <div class="c-grid__col c-ui--mt-20 c-grid__col--sm-2 c-grid__col--flex-initial">
                            <label class="uk-form-label">بازه زمانی ارسال (روز):
                                <span class="uk-form-label__required"></span>
                            </label>
                            <div class="field-wrapper">
                                <input type="text" class="uk-input js-variant-post-time" name="" value="">
                            </div>
                        </div>
                        <div class="c-grid__col c-ui--mt-20 c-grid__col--sm-2 c-grid__col--flex-initial">
                            <label class="uk-form-label">حداکثر سفارش در سبد (عدد):
                                <span class="uk-form-label__required"></span>
                            </label>
                            <div class="field-wrapper">
                                <input type="text" class="uk-input js-variant-order-limit" name="" value="">
                            </div>
                        </div>
                        <div class="c-grid__col c-ui--mt-20 c-grid__col--sm-2 c-grid__col--flex-initial">
                            <label class="uk-form-label">موجودی نزد شما (عدد):
                                <span class="uk-form-label__required"></span>
                            </label>
                            <div class="field-wrapper">
                                <input type="text" class="uk-input js-variant-marketplace-seller-stock" name=""
                                       value="">
                            </div>
                        </div>
                        <div class="c-grid__col c-ui--mt-20 c-grid__col--sm-2 c-grid__col--flex-initial">
                            <label class="uk-form-label">
                                قیمت خرید (ریال):
                            </label>
                            <div class="field-wrapper">
                                <input type="text" class="uk-input js-variant-buy-price" name="" value="">
                            </div>
                        </div>
                        <div class="c-grid__col c-ui--mt-20 c-grid__col--sm-2 c-grid__col--flex-initial">
                            <label class="uk-form-label">قیمت فروش (ریال):
                                <span class="uk-form-label__required"></span>
                            </label>
                            <div class="field-wrapper">
                                <input type="text" data-editable="false"
                                       class="uk-input  js-gold-final-price dk-currency js-variant-price" value="">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="measuringRequestModal" class="marketplace-redesign uk-modal" uk-modal="">
            <div class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body">
                <button class="uk-modal-close uk-modal-close--search uk-close uk-icon" type="button" uk-close=""></button>

                <div class="modal-product modal-product--confirm modal-product--small">
                    <p class="modal-message--center">
                        آیا درخواست اندازه‌گیری مجدد از این کالا را دارید؟
                    </p>
                </div>

                <div class="modal-footer modal-footer--center">
                    <div class="uk-flex">
                        <button
                            class="modal-footer__btn modal-footer__btn--confirm modal-footer__btn--wide js-accept"
                            type="button">
                            اندازه‌گیری مجدد
                        </button>
                        <button class="modal-footer__btn modal-footer__btn--wide uk-modal-close js-decline"
                                type="button">انصراف
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="newSizeRequestModal" class="marketplace-redesign uk-modal c-variant" uk-modal="">
            <div class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body c-content-modal"
                 id="newSizeRequestModalContent">
                <button class="uk-modal-close uk-modal-close--search uk-close uk-icon" type="button" uk-close="">
                </button>
                <form id="newSizeRequestForm" novalidate="novalidate">
                    <input type="hidden" name="size[product_id]" value="{{ $product->id }}">
                    <div class="c-content-modal__header">
                        <h3 class="c-content-modal__title"> درخواست ایجاد سایز جدید</h3>
                    </div>
                    <div class="c-content-modal__body">
                        <div class="c-content-modal__body-container">
                            <div class="c-content-modal__intro">
                                می‌توانید با تکمیل و ارسال فرم زیر، درخواست ایجاد سایز جدید برای محصول خود را ثبت
                                نمایید.
                            </div>
                            <div
                                class="c-variant-error c-variant-error__box c-variant-error__box--modal mt-20 mb-20 hidden"
                                id="ajaxSizeErrorsList">
                            </div>
                            <div class="c-grid__row c-grid__row--gap-lg mt-30">
                                <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                    <label for="" class="uk-form-label">
                                        عنوان سایز:
                                        <span class="uk-form-label__required"></span>
                                    </label>
                                    <div class="field-wrapper">
                                        <input type="text" placeholder="عنوان سایز را وارد کنید …" class="uk-input"
                                               value="" name="size[title]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="c-content-modal__footer">
                        <button class="modal-footer__btn modal-footer__btn--confirm modal-footer__btn--wide"
                                type="button" id="saveSizeRequestButton">
                            ارسال درخواست
                        </button>
                        <button class="modal-footer__btn modal-footer__btn--wide uk-modal-close" type="button"
                                id="cancelSizeRequestButton">انصراف
                        </button>
                    </div>
                </form>
                <div class="c-content-loader">
                    <div class="c-content-loader__logo"></div>
                    <div class="c-content-loader__spinner"></div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
@section('script')
<script>
// تبدیل اعداد انگلیسی به فارسی
function ConvertNumberToPersion() {
    persian = {0: '۰', 1: '۱', 2: '۲', 3: '۳', 4: '۴', 5: '۵', 6: '۶', 7: '۷', 8: '۸', 9: '۹'};

    function traverse(el) {
        if (el.nodeType == 3) {
            var list = el.data.match(/[0-9]/g);
            if (list != null && list.length != 0) {
                for (var i = 0; i < list.length; i++)
                    el.data = el.data.replace(list[i], persian[list[i]]);
            }
        }
        for (var i = 0; i < el.childNodes.length; i++) {
            traverse(el.childNodes[i]);
        }
    }

    traverse(document.body);
}

// توکن csrf
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.delete-btn', function () {
    $(this).closest('.c-variation-diversity__status').find('.uk-modal-container').addClass('uk-open');
    $(this).closest('.c-variation-diversity__status').find('.uk-modal-container').css('display', 'block');
    $('.c-header__nav').hide();

    $(document).on('click', '.yes', function () {

        $('.c-header__nav').show();


        var variant_id = $(this).closest('.c-variation-diversity__status').find('.delete-btn').attr('data-id');
        console.log('ee');
        console.log(variant_id);
        console.log('vvv');

        var product_id = $("input[name='product_variants[product_id]']").val();
        console.log(product_id);


            $.ajax({
            method: 'post',
            url: "{{route('staff.products.variantDelete')}}",
            data: {
                id: variant_id,
                product_id: product_id,
            },
            success: function (result) {
                $('.js-table-container').replaceWith(result);
            },
        });

    });

    $(document).on('click', '.uk-modal-close-default', function () {
        $('.c-header__nav').show();
    });

    $(document).on('click', '.no', function () {
        $('.c-header__nav').show();
    });


});
</script>
@endsection
