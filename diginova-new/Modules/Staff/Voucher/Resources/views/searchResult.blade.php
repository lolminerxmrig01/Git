<div class="js-table-container" id="product-list-items">
    <br>
    <div class="c-ui-paginator js-paginator">
        @if(count($vouchers))
            <div class="c-ui-paginator__total" data-rows="">
                تعداد نتایج: <span>{{ persianNum($vouchers->total()) }} مورد</span>
            </div>
        @else
            <div class="c-ui-paginator__total" data-rows="۰">
                جستجو نتیجه‌ای نداشت
            </div>
        @endif
    </div>

    <div class="c-grid__row c-promo__row--m-sm">
        <table class="c-ui-table c-join__table  js-search-table js-table-fixed-header" data-sort-column="created_at" data-sort-order="desc"
               data-search-url="{{ route('staff.vouchers.searchVoucher') }}" data-auto-reload-seconds="0" data-new-ui="1"
               data-is-header-floating="1" data-has-checkboxes="" style="text-align: right !important; display: rtl !important;">
            <thead>
            <tr class="c-ui-table__row">
                <th class="c-ui-table__header  ">
                    <span class="js-search-table-column">عنوان</span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--nowrap  ">
                    <span class="js-search-table-column">میزان تخفیف</span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                    <span class="js-search-table-column">کد تخفیف</span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                    <span class="js-search-table-column-sortable table-header-searchable"
                     data-sort-column="start_end_at"
                     data-sort-order="desc">مهلت استفاده</span>
                </th>
                <th class="c-ui-table__header  ">
                    <span class="js-search-table-column">جزئیات بیشتر</span>
                </th>
                <th class="c-ui-table__header  ">
                    <span class="js-search-table-column">تعداد استفاده شده</span>
                </th>
                <th class="c-ui-table__header  ">
                    <span class="js-search-table-column">فعال / غیرفعال</span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                    <span class="js-search-table-column">عملیات</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @if(count($vouchers))
                @foreach($vouchers as $voucher)
                    <tr class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                        <td class="c-ui-table__cell">
                            <div style="font-weight: bold;">{{ $voucher->name }}</div>
                            @if((($voucher->end_at < now()) || ($voucher->status == 'ended')) && (!is_null($voucher->end_at)))
                                <div class="c-join__landing-state c-ui-table__cell--text-warning">
                                    <span class="c-join__has-icon c-join__has-icon--clock"  style="padding-right: 25px;">پایان یافته</span>
                                </div>
                            @elseif(($voucher->end_at > now() || is_null($voucher->end_at)) && $voucher->status == 'active')
                                <div class="c-join__landing-state c-ui-table__cell--text-greenish">
                                    <span class="c-join__has-icon c-join__has-icon--clock"  style="padding-right: 25px;">فعال</span>
                                </div>
                            @else
                                <div class="c-join__landing-state c-ui-table__cell--text-error">
                                    <span class="c-join__has-icon c-join__has-icon--clock"  style="padding-right: 25px;">غیرفعال</span>
                                </div>
                            @endif
                        </td>
                        <td class="c-ui-table__cell" style="">
                            {{ persianNum($voucher->percent) }} درصد تخفیف
                            {{ (!is_null($voucher->max_usable))? 'تا سقف ' . persianNum(number_format($voucher->up_to)) . ' ریال' : '' }} <br>
                            {{ (!is_null($voucher->max_usable))? 'برای خرید بالای ' . persianNum(number_format($voucher->min_product_price)) . ' ریال' : '' }}
                        </td>
                        <td class="c-ui-table__cell c-ui-table__cell--text-blue">
                            <a class="c-join__promotion-link" href="" target="_blank" style="font-weight: bold">{{ $voucher->code }}</a>
                            <a class="c-join__promotion-copy-btn js-copy-btn" href="#" data-link="{{ $voucher->code }}">کپی کد</a>
                        </td>
                        <td class="c-ui-table__cell c-join-promotion__date-range">
                            @if(!is_null($voucher->start_at))
                                <span class="c-ui-table__date-f rom span-time" data-value="{{ $voucher->start_at }}" data-type="شروع"></span>
                                <br>
                                <span class="c-ui-table__date-to span-time" data-value="{{ $voucher->end_at }}" data-type="پایان"></span>
                            @else
                                دائمی
                            @endif
                        </td>
                        <td class="c-ui-table__cell">
                            <div class="c-join__status-cell">
                                <span style="text-align: right">{{ (!is_null($voucher->max_usable))? 'قابل استفاده: ' . persianNum($voucher->max_usable) . ' نفر' : '' }}</span>
                                <span style="text-align: right">{{ (!is_null($voucher->type) && ($voucher->type == 'first_purchase'))? 'فقط برای خرید اول' : '' }}</span>
                                <span style="text-align: right">{{ (!is_null($voucher->freeـshipping) && ($voucher->freeـshipping == 'true'))? 'با هزینه ارسال رایگان' : '' }}</span>
                                @if($voucher->categories()->exists())
                                    <span style="text-align: right"> فعال برای دسته: {{ $voucher->categories()->first()->name }} </span>
                                @endif
                            </div>
                        </td>
                        <td class="c-ui-table__cell c-ui-table__cell--small-text">
                            -
                        </td>
                        <td class="c-ui-table__cell c-ui-table__cell--small-text">
                            <div class="c-ui-tooltip__anchor">
                                <div class="c-ui-toggle__group">
                                    <label class="c-ui-toggle">
                                        <input class="c-ui-toggle__origin js-toggle-active-product" type="checkbox"
                                         data-id="{{ $voucher->id }}" name="status"
                                          {{ (($voucher->end_at > now() || is_null($voucher->end_at)) )? '' : 'disabled' }}
                                           {{ ((($voucher->end_at > now() || is_null($voucher->end_at) && ($voucher->status == 'active')) ) )? 'checked' : '' }}>
                                        <span class="c-ui-toggle__check"></span>
                                    </label>
                                </div>
                                <input type="hidden" value="0" class="js-active-input">
                            </div>
                        </td>
                        <td class="c-ui-table__cell">
                            <div class="c-promo__actions">
                                <a class="c-join__btn c-join__btn--icon-left c-join__btn--icon-edit c-join__btn--secondary-greenish"
                                    href="{{ route('staff.vouchers.edit', ['id' => $voucher->id]) }}">ویرایش</a>
                                <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete c-join__btn--primary
                                    js-remove-plp js-remove-product-list" data-url="{{ route('staff.vouchers.removeVoucher', ['id' => $voucher->id]) }}">
                                    حذف
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <div class="c-card__loading"></div>
    </div>
    <br>


    <div class="c-card__footer" style="width: auto;">
        <a href="#" style="visibility: hidden;">
            <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
            </div>
        </a>

        {{ $vouchers->links('staffvoucher::layouts.pagination.custom-pagination') }}
        <div class="c-ui-paginator js-paginator">
            <div class="c-ui-paginator js-paginator">
                @if(count($vouchers))
                    <div class="c-ui-paginator__total" data-rows="">
                        تعداد نتایج: <span>{{ persianNum($vouchers->total()) }} مورد</span>
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
