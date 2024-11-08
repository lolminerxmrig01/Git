<div class="c-card__body">

    <div class="c-join-promotion__table">
        <table class="c-ui-table">
            <thead>
            <tr class="c-ui-table__row">
                <th class="c-ui-table__header c-ui-table__header--smaller c-ui-table__header--nowrap ">
                    <label class="c-ui-checkbox">
                        <input type="checkbox" class="c-ui-checkbox__origin all-checkbox js-select-all-products">
                        <span class="c-ui-checkbox__check"></span>
                    </label>
                </th>
                <th class="c-ui-table__header c-ui-table__header--smaller c-ui-table__header--nowrap ">
                    <span class="js-search-table-column"></span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--smaller c-ui-table__header--nowrap ">
                    <span class="js-search-table-column">کد کالا ({{ $product_code_prefix }})</span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--smaller c-ui-table__header--nowrap ">
                    <span class="js-search-table-column">عنوان و کد تنوع ({{ $product_code_prefix }}C)</span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--smaller">
                    <span class="js-search-table-column">قیمت خرید شما</span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--smaller">
                    <span class="js-search-table-column">قیمت فروش شما</span>
                </th>
                <th class="c-ui-table__header  ">
                    <span class="js-search-table-column">قیمت پروموشن فعال (ریال)</span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--smaller c-ui-table__header--nowrap ">
                    <span class="js-search-table-column">رنگ/سایز</span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--smaller c-ui-table__header--nowrap ">
                    <span class="js-search-table-column">گارانتی</span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--smaller">
                    <span class="js-search-table-column">فروش ۷ روز گذشته</span>
                </th>
            </tr>
            </thead>
            <tbody>
                @if(count($product_variants))
                    @foreach($product_variants as $product_variant)
                        <tr class="c-ui-table__row c-ui-table__row--body c-ui-table__row--with-hover c-join__table-row ">
                    <td class="c-ui-table__cell">
                        <label class="c-ui-checkbox js-checkbox-{{ $product_variant->id }}">
                            <input type="checkbox" class="c-ui-checkbox__origin all-checkbox js-selected-item" {{ (!is_null($landing->productVariants->find($product_variant)))? 'checked disabled' : '' }} value="{{ $product_variant->id }}">
                            <span class="c-ui-checkbox__check"></span>
                        </label>
                    </td>
                    <td class="c-ui-table__cell c-ui-table__cell--img">
                        <img src="{{ $site_url . '/' . $product_variant->product->media()->first()->path . '/' . $product_variant->product->media()->first()->name }}"  alt="">
                    </td>
                    <td class="c-ui-table__cell">
                        {{ $product_code_prefix . '-' . $product_variant->product->product_code }}
                    </td>
                    <td class="c-ui-table__cell">
                        {{ $product_variant->product->title_fa }} | {{ $product_variant->variant->name }} | گارانتی
                        {{ (!is_null($product_variant->warranty->month))? persianNum($product_variant->warranty->month) . ' ماهه' : '' }}
                        {{ $product_variant->warranty->name }}
                        <span class="c-join-promotion__dkpc-number">{{ $product_code_prefix }}C-{{ $product_variant->variant_code  }}</span>
                    </td>
                    <td class="c-ui-table__cell">{{ persianNum(number_format($product_variant->buy_price)) }}</td>
                    <td class="c-ui-table__cell">{{ persianNum(number_format($product_variant->sale_price)) }}</td>
                    <td class="c-ui-table__cell">-</td>
                    <td class="c-ui-table__cell">
                        @if(!is_null($product_variant->variant->value))
                        <span class="c-join__color-variant" style="background-color: {{ $product_variant->variant->value }}"></span>
                        @endif
                        {{ $product_variant->variant->name }}
                    </td>
                    <td class="c-ui-table__cell">
                        @if(!is_null($product_variant->warranty->month))
                            گارانتی {{ persianNum($product_variant->warranty->month) }} ماهه {{ $product_variant->warranty->name }}
                        @else
                            گارانتی {{ $product_variant->warranty->name }}
                        @endif
                    </td>
                    <td class="c-ui-table__cell">-</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="c-card__footer c-join__table-footer" style="width: unset;">
    <div class="c-grid__row c-grid__row--align-center">
        <button class="js-add-variant-to-promotion c-join__btn c-join__btn--secondary c-join__btn--icon-left c-join__btn--icon-plus uk-disabled js-submit-selected-items">افزودن به صفحه کالا</button>
        <p class="c-join-promotion__selected-products-text">
            <span class="c-join-promotion__selected-products-number"><span class="js-selected-variants-count" data-count="0">۰</span> کالا </span>
            از {{ persianNum(count($product_variants)) }} کالا انتخاب شده اند
        </p>
        <div class="c-card__paginator">
            <div class="c-ui-paginator">
                @if(!is_null($product_variants) && count($product_variants))
                    <div class="c-ui-paginator__total" data-rows="{{ persianNum($product_variants->total()) }}">
                        تعداد نتایج: <span>{{ persianNum($product_variants->total()) }} مورد</span>
                    </div>
                @endif
                @if(!is_null($product_variants) && count($product_variants))
                    {{ $product_variants->links('stafflanding::layouts.pagination.modal-pagination') }}
                @endif

            </div>
        </div>
    </div>
</div>
