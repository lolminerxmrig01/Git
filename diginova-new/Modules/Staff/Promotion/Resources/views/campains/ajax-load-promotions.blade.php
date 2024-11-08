<div class="c-mega-campaigns-join-list__container-table c-promo--width-controller js-table-container"
     id="product-list-items">
    <div class="c-mega-campaigns-join-list__container">
        <div class="uk-flex uk-flex-between">
            <div class="uk-flex">
                <div class="c-mega-campaigns__btns-green-plus uk-margin-remove-top js-empty-layout-add-btn">
                    افزودن کالای جدید به لیست تخفیف‌ها
                </div>
            </div>
        </div>

        <input id="join-promotions-container" hidden>

        <div class="c-promo__row--m-sm">
            <table class="c-ui-table c-periodic-prices__table c-join__table js-search-table js-table-fixed-header"
             data-sort-column="created_at" data-sort-order="desc"
              data-search-url="{{ ($paginate_type == 'active')
                ? route('staff.campains.search')
                : route('staff.campains.endedSearch') }}"
                 data-auto-reload-seconds="0" data-new-ui="1"
                  data-is-header-floating="1" data-has-checkboxes="">
                <thead>
                <tr class="c-ui-table__row">
                    <th class="c-ui-table__header  ">
                        <span class="js-search-table-column"></span>
                    </th>
                    <th class="c-ui-table__header  ">
                        <span class="js-search-table-column">عنوان و‌ کد تنوع کالا ({{ strtoupper($product_code_prefix) }}C)</span>
                    </th>
                    <th class="c-ui-table__header  ">
                        <span class="js-search-table-column">قیمت فروش (ریال)</span>
                    </th>
                    <th class="c-ui-table__header  ">
                        <span class="js-search-table-column">٪ تخفیف از قیمت شما</span>
                    </th>
                    <th class="c-ui-table__header  ">
                        <span class="js-search-table-column">قیمت پس  از تخفیف (ریال)</span>
                    </th>
                    <th class="c-ui-table__header  ">
                        <span class="js-search-table-column">وضعیت</span>
                    </th>
                    <th class="c-ui-table__header  ">
                        <span class="js-search-table-column">موجودی فعلی کالا</span>
                    </th>
                    <th class="c-ui-table__header  ">
                        <span class="js-search-table-column">تعداد در تخفیف</span>
                    </th>
                    <th class="c-ui-table__header  ">
                        <span class="js-search-table-column">تعداد در سبد</span>
                    </th>
                    <th class="c-ui-table__header c-ui-table__header--nowrap ">
                        <span class="js-search-table-column"></span>
                    </th>
                    <th class="c-ui-table__header c-ui-table__header--nowrap ">
                        <span class="js-search-table-column"></span>
                    </th>
                </tr>
                </thead>
                <tbody>

                <tr class="c-ui-table__row c-ui-table__row--body c-join__table-row c-join__group-edit">
                    <td class="c-ui-table__cell" colspan="3">
                        ویرایش قیمت و تعداد همه کالاها
                    </td>
                    <td class="c-ui-table__cell c-ui-table__cell--has-input">
                        <div class="c-join__has-more-info">
                            <div class="c-join-promotion__table-input c-join-promotion__discount 
                            c-join-promotion__discount--all js-number-input-wrapper">
                                <input type="number" min="0" class="c-join-promotion__discount-input 
                                js-all-variants-discount-percent js-number-input" placeholder="≠">
                            </div>
                        </div>
                    </td>
                    <td class="c-ui-table__cell"></td>
                    <td class="c-ui-table__cell"></td>
                    <td class="c-ui-table__cell"></td>
                    <td class="c-ui-table__cell"></td>
                    <td class="c-ui-table__cell"></td>
                    <td class="c-ui-table__cell c-ui-table__cell--has-input">
                        <div class="c-join-promotion__table-input js-number-input-wrapper">
                            <input type="number" min="0" class="c-join-promotion__discount-input
                             js-all-variants-promotion-limit js-number-input" placeholder="≠">
                        </div>
                    </td>
                    <td class="c-ui-table__cell c-ui-table__cell--has-input">
                        <div class="c-join-promotion__table-input js-number-input-wrapper">
                            <input type="number" min="0" class="c-join-promotion__discount-input 
                            js-all-variants-order-limit js-number-input" placeholder="≠">
                        </div>
                    </td>
                    <td class="c-ui-table__cell"></td>
                    <td class="c-ui-table__cell"></td>
                </tr>

                @foreach($promotions as $promotion)
                    <tr class="c-ui-table__row c-ui-table__row--body js-edit-row 
                    added-by-js-{{ $promotion->id }}" data-id="{{ $promotion->id }}">
                        <td class="c-ui-table__cell">
                            <img src="{{ $site_url . '/' . $promotion->productVariants()->first()->product->media()->first()->path . '/' . $promotion->productVariants()->first()->product->media()->first()->name }}" alt="{{ $promotion->productVariants()->first()->product->title_fa . '|' . $promotion->productVariants()->first()->warranty->name }}" class="c-mega-campaigns-join-list__container-table-image">
                        </td>
                        <td class="c-ui-table__cell" style="text-align: right;">
                            {{ $promotion->productVariants()->first()->product->title_fa . '|' . $promotion->productVariants()->first()->warranty->name }}
                            <span class="c-mega-campaigns-join-list__container-table-dkpc">{{ $product_code_prefix }}C-{{ $promotion->productVariants()->first()->variant_code }}</span>
                            <div class="c-mega-campaigns-join-list__container-table-error uk-text-nowrap uk-hidden added-by-js-messages-{{ $promotion->id }}">
                            </div>
                        </td>
                        <td class="c-ui-table__cell">
                            <span class="c-mega-campaigns-join-list__container-table-row-item">
                                {{ persianNum(number_format($promotion->productVariants()->first()->sale_price)) }}
                            </span>
                        </td>
                        <td class="c-ui-table__cell uk-padding-remove">
                            <div class="c-mega-campaigns--mh-105 uk-flex">
                                <div class="c-mega-campaigns--mt-25 uk-flex">
                                    <div class="uk-flex uk-flex-column">
                                        <div class="c-mega-campaigns-join-modal__body-table-input 
                                            c-mega-campaigns-join-modal__body-table-input--xs js-number-input-wrapper">
                                            <input name="variant[promotion_percent]" type="number" min="0"
                                             max="100" class="js-discount-value js-number-input" value="{{ $promotion->percent }}">
                                        </div>
                                        <span class="c-mega-campaigns-join-modal__body-table-input-sub-title">
                                        </span>
                                    </div>
                                    <span class="c-mega-campaigns-join-modal__body-table-input-link c-mega-campaigns--mr-5"></span>
                                </div>
                            </div>
                        </td>
                        <td class="c-ui-table__cell uk-padding-remove">
                            <div class="uk-flex uk-flex-column c-mega-campaigns--mh-105 uk-flex-center">
                                <div class="c-mega-campaigns--mt-12">
                                    <div class="c-mega-campaigns-join-modal__body-table-input 
                                    c-mega-campaigns-join-modal__body-table-input--medium js-number-input-wrapper">
                                        <input type="text" name="variant[promotion_price]" 
                                        class="js-promotion-price js-numeric-input" value="{{ $promotion->promotion_price }}"
                                         data-selling_price="{{ $promotion->productVariants()->first()->sale_price }}"
                                          data-crossed_price="{{ $promotion->productVariants()->first()->sale_price }}">
                                    </div>
                                    <span class="c-mega-campaigns-join-modal__body-table-input-sub-title" style="visibility: hidden;">
                                        حداکثر قیمت مجاز:۴۸۰,۲۰۰ریال
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="c-ui-table__cell uk-padding-remove">
                            <div class="c-ui-tooltip__anchor">
                                <div class="c-ui-toggle__group">
                                    <label class="c-ui-toggle">
                                        <input class="c-ui-toggle__origin js-toggle-active-product variant_status"
                                         type="checkbox" data-group-id="" name="variant[status]"
                                          data-reset="{{ ($promotion->status)? 'checked' : 'not_checked' }}"
                                           {{ ($promotion->status)? 'checked' : '' }}>
                                        <span class="c-ui-toggle__check"></span>
                                    </label>
                                </div>
                                <input type="hidden" value="0" class="js-active-input">
                            </div>
                        </td>
                        <td class="c-ui-table__cell">
                            <div class="c-join-smart-products--middle-item-height uk-flex uk-flex-column uk-flex-center">
                                <span class="c-mega-campaigns-join-list__container-table-row-item">
                                    {{ persianNum($promotion->productVariants()->first()->stock_count) }}
                                </span>
                            </div>
                        </td>
                        <td class="c-ui-table__cell uk-padding-remove" style="text-align: center;">
                            <div class="c-join-smart-products--middle-item-height uk-flex uk-flex-middle uk-flex-center">
                                <div class="c-mega-campaigns-join-modal__body-table-input 
                                    c-mega-campaigns-join-modal__body-table-input--small-container
                                    c-mega-campaigns-join-modal__body-table-input--small js-number-input-wrapper uk-flex">
                                    <input type="number" name="variant[promotion_limit]" min="1" 
                                    class="js-number-input js-input-promotion-limit" value="{{ $promotion->promotion_limit }}">
                                </div>
                            </div>
                        </td>
                        <td class="c-ui-table__cell uk-padding-remove">
                            <div class="c-join-smart-products--middle-item-height uk-flex uk-flex-middle uk-flex-center">
                                <div class="c-mega-campaigns-join-modal__body-table-input 
                                c-mega-campaigns-join-modal__body-table-input--small-container 
                                c-mega-campaigns-join-modal__body-table-input--small js-number-input-wrapper uk-flex">
                                    <input type="number" name="variant[promotion_order_limit]" 
                                    min="1" class="js-number-input js-input-order-limit"
                                     value="{{ $promotion->promotion_order_limit }}">
                                </div>
                            </div>
                        </td>
                        <td class="c-ui-table__cell uk-padding-remove">
                            <div class="uk-flex uk-flex-between uk-flex-middle c-join-smart-products--middle-item-height js-edit-actions">
                                <div class=" c-mega-campaigns-join-modal__body-table-btn-separator c-mega-campaigns--ml-10">
                                    <button class="c-mega-campaigns-join-list__container-table-btn 
                                    c-mega-campaigns-join-list__container-table-btn--save c-mega-campaigns--ml-10 
                                    c-mega-campaigns--mr-10 js-edit-button button js-save-promotion-price-record-changes"
                                      data-product-variant-id="{{ $promotion->id }}"
                                      data-promotion-variant-id="{{ $promotion->id }}" disabled=""></button>
                                    <button class="c-mega-campaigns-join-list__container-table-btn
                                     c-mega-campaigns-join-list__container-table-btn--cancle
                                      c-mega-campaigns--ml-10 js-edit-cancel-button js-table-swap-row-handle"
                                       disabled=""></button>
                                </div>
                                <button class="c-mega-campaigns-join-list__container-table-btn
                                 c-mega-campaigns-join-list__container-table-btn--delete js-remove-variant"
                                    data-variant="{{ $promotion->id }}"
                                    data-promotion-variant-id="{{ $promotion->id }}"></button>
                            </div>
                        </td>
                        <td class="c-ui-table__cell c-ui-table__cell--operations c-ui-table__cell--text-error">
                            <div class="uk-hidden js-undo-remove">
                                <div class="c-join__flex-end">
                                    <span>کالا حذف شد</span>
                                </div>
                                <div class="c-join__flex-end">
                                    <a href="#" class="c-promo__table-action c-promo__table-action--undo js-undo-remove-button"
                                     data-promotion-variant-id="{{ $promotion->id }}">لغو حذف</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="c-card__loading"></div>
        </div>

        <div class="c-card__footer" style="width: auto;">
            <a href="#" style="visibility: hidden;">
                <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                </div>
            </a>
            {{ $promotions->links('staffpromotion::pagination.custom-modal-pagination') }}
            <div class="c-ui-paginator js-paginator">
                <div class="c-ui-paginator js-paginator">
                    @if(count($promotions))
                        <div class="c-ui-paginator__total" data-rows="">
                            تعداد نتایج: <span>{{ persianNum($promotions->total()) }} مورد</span>
                        </div>
                    @else
                        <div class="c-ui-paginator__total" data-rows="۰">
                            جستجو نتیجه‌ای نداشت
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    Promotion.initDatePickers();
</script>
