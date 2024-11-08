<div class="c-modal-notification c-join-promotion__modal">
    <div class="js-sub-table-container">
        <div class="c-card__header">
            <h2 class="c-card__title">انتخاب کالا از لیست</h2>
        </div>
        <div class="c-card__body">
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <div class="c-card">
                        <div class="c-card__body">
                            <form class="c-ui-form" method="POST" id="searchForm">
                                <form class="c-ui-form" method="POST" id="searchForm">
                                    <div class="uk-flex">
                                        <div class="uk-width-1-2 c-mega-campaigns-join-list__container-filters-search c-mega-campaigns-join-list__container-filters-search--large">
                                            <div class="uk-width-1-1 c-ui-form__col c-ui-form__col--xs-12 c-ui-form__col--small-gap uk-padding-remove-left uk-padding-remove-right">
                                                <label class="c-ui-form__label uk-text-right">جستجو در</label>
                                                <div class="c-ui-form__row c-ui-form__row--group c-ui-form__row--nowrap c-ui-form__row--wrap-xs">
                                                    <div class="c-ui-form__col c-ui-form__col--group-item c-ui-form__col--xs-12 c-ui-form__col--wrap-xs c-ui-form__col--xs-full c-mega-campaigns-join-list__container-filters-search-type">
                                                        <select class="js-form-clearable js-re-init-select2-after-ajax c-ui-select c-ui-select--common c-ui-select--small c-ui-select--search" name="type"                                                                >
                                                            <option value="all" {{ (isset($type) && ($type == 'all'))? 'selected' : ''  }}  {{ (!isset($type))? 'selected' : '' }}>همه موارد</option>
                                                            <option value="product_name" {{ (isset($type) && ($type == 'product_name'))? 'selected' : ''  }}>نام محصول</option>
                                                            <option value="product_id" {{ (isset($type) && ($type == 'product_id'))? 'selected' : ''  }}>کد محصول</option>
                                                            <option value="product_variant_id" {{ (isset($type) && ($type == 'product_variant_id'))? 'selected' : ''  }}>کد تنوع</option>
                                                        </select>
                                                    </div>
                                                    <div class="uk-width-1-1 c-ui-form__col c-ui-form__col--xs-6 c-ui-form__col--group-item c-ui-form__col--wrap-xs c-ui-form__col--xs-full">
                                                        <label>
                                                            <div class="c-ui-input">
                                                                <input type='text' name='query' class='c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable c-mega-campaigns--light-border' id='questions-search' value='{{ $query }}' placeholder='عبارت جستجو ...'>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <div class="c-ui-form__col c-ui-form__col--xs-12 c-ui-form__col--group-item c-ui-form__col--wrap-xs">
                                                        <button class="c-ui-btn c-ui-btn--xs-block c-ui-btn--active c-ui-btn--search-form js-ga-click" id="submitButton">
                                                            <span>جستجو</span>
                                                        </button>
                                                        <input type="submit" style="display: none" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="uk-width-1-4 c-ui-form__col c-ui-form__col--group-item c-ui-form__col--xs-12 c-ui-form__col--wrap-xs c-ui-form__col--xs-full c-mega-campaigns-join-list__container-filters-select c-mega-campaigns--mr-30">
                                            <label class="c-ui-form__label uk-text-right">مرتب‌‌سازی کالاها بر اساس:</label>
                                            <select class="js-form-clearable js-re-init-select2-after-ajax c-ui-select c-ui-select--common c-ui-select--small" name="sort">
                                                <option value="desc" selected>جدیدترین</option>
                                                <option value="price_low">ارزان‌ترین</option>
                                                <option value="price_high">گرانترین</option>
                                            </select>
                                        </div>
                                    </div>

                                </form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-join-promotion__table">
                <table class="c-ui-table js-sub-search-table js-table-fixed-header" data-sort-column="created_at" data-sort-order="desc" data-search-url="/periodic-prices/0/load-product-variants/" data-auto-reload-seconds="0" data-new-ui="1" data-is-header-floating="1" data-has-checkboxes="">
                    <thead>
                    <tr class="c-ui-table__row">
                        <th class="c-ui-table__header c-ui-table__header--nowrap ">
                            <span class="js-search-table-column"></span>
                        </th>
                        <th class="c-ui-table__header c-ui-table__header--nowrap ">
                            <span class="js-search-table-column"></span>
                        </th>
                        <th class="c-ui-table__header c-ui-table__header--nowrap ">
                            <span class="js-search-table-column">کد کالا ({{ $product_code_prefix }})</span>
                        </th>
                        <th class="c-ui-table__header  ">
                            <span class="js-search-table-column">عنوان و کد تنوع ({{ $product_code_prefix }}C)</span>
                        </th>
                        <th class="c-ui-table__header  ">
                            <span class="js-search-table-column">قیمت خرید شما (ریال)</span>
                        </th>
                        <th class="c-ui-table__header  ">
                            <span class="js-search-table-column">قیمت فروش شما (ریال)</span>
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
                        <th class="c-ui-table__header  ">
                            <span class="js-search-table-column">تعداد فروش ۷ روز گذشته</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($product_variants)
                    @foreach($product_variants as $product_variant)
                      <tr data-variant-id="{{ $product_variant->id  }}" class="c-ui-table__row c-ui-table__row--body c-ui-table__row--with-hover c-join__table-row ">
                        <td class="c-ui-table__cell">
                            <label class="c-ui-checkbox js-checkbox-{{ $product_variant->id  }}">
                                <input type="checkbox"  value="{{ $product_variant->id  }}" class="js-selected-item c-ui-checkbox__origin all-checkbox">
                                <span class="c-ui-checkbox__check"></span>
                            </label>
                        </td>
                        <td class="c-ui-table__cell c-ui-table__cell--img">
                            <img src="{{ $site_url . '/' . $product_variant->product->media()->first()->path . '/' . $product_variant->product->media()->first()->name }}"  alt="">
                        </td>
                        <td class="c-ui-table__cell">
                            {{ $product_code_prefix . '-' . $product_variant->product->product_code }}
                        </td>
                        <td class="c-ui-table__cell " style="text-align: right;">
                              {{ $product_variant->product->title_fa }} | {{ $product_variant->variant->name }} | گارانتی
                              {{ $product_variant->warranty && $product_variant->warranty->month ? persianNum($product_variant->warranty->month) . ' ماهه' : '' }}
                              {{ $product_variant->warranty ? $product_variant->warranty->name : '' }}
                              <span class="c-join-promotion__dkpc-number">{{ $product_code_prefix }}C-{{ $product_variant->variant_code  }}</span>
                          </td>
                        <td class="c-ui-table__cell">{{ (!is_null($product_variant->buy_price)? persianNum(number_format($product_variant->buy_price)) : '') }}</td>
                        <td class="c-ui-table__cell">{{ persianNum(number_format($product_variant->sale_price)) }}</td>
                        <td class="c-ui-table__cell">-</td>
                        <td class="c-ui-table__cell">
                          @if(!is_null($product_variant->variant->value))
                              <span class="c-join__color-variant" style="background-color: {{ $product_variant->variant->value }}"></span>
                          @endif
                          {{ $product_variant->variant->name }}
                      </td>
                        <td class="c-ui-table__cell">
                          @if(isset($product_variant->warranty->month))
                              گارانتی {{ persianNum($product_variant->warranty->month) }} ماهه {{ $product_variant->warranty->name }}
                          @elseif(isset($product_variant->warranty->name))
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
        <div class="c-card__footer c-join__table-footer" style="width: 95%;">
            <div class="c-grid__row c-grid__row--align-center">
                <button class="js-add-variant-to-promotion c-join__btn c-join__btn--secondary c-join__btn c-join__btn--icon-left c-join__btn--icon-plus">
                    افزودن به لیست تخفیف‌ها
                </button>
                <p class="c-join-promotion__selected-products-text">
                    <span class="c-join-promotion__selected-products-number">
                        <span class="js-selected-variants-count" data-count="0">۰</span>
                        کالا
                    </span>
                    @if(!is_null($product_variants) && count($product_variants))
                    از {{ persianNum($product_variants->total()) }} کالا انتخاب شده اند
                    @endif
                </p>
                <div class="c-card__paginator">
                    <div class="c-ui-paginator">
                        @if(!is_null($product_variants) && count($product_variants))
                        <div class="c-ui-paginator__total" data-rows="{{ persianNum($product_variants->total()) }}">
                            تعداد نتایج: <span>{{ persianNum($product_variants->total()) }} مورد</span>
                        </div>
                        @endif
                        @if(!is_null($product_variants) && count($product_variants))
                            {{ $product_variants->links('staffpromotion::periodic-prices.custom-pagination') }}
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="c-card__loading js-modal-loading"></div>
</div>
