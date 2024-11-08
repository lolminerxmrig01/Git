{{--@php--}}
{{--    $product_code_prefix = $settings->where('name', 'product_code_prefix')->first()->value;--}}
{{--    $fa_store_name = $settings->where('name', 'site_name')->first()->value;--}}
{{--@endphp--}}
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
                                        <span class="c-variant__tooltip c-variant__tooltip--btn" style="margin-left: -9px;">حذف تنوع</span>
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
