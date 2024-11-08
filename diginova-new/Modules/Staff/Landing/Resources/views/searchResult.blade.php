<div class="js-table-container" id="product-list-items">
    <br>
    <div class="c-ui-paginator js-paginator">
        @if(count($landings))
            <div class="c-ui-paginator__total" data-rows="{{ persianNum($landings->total()) }}" style="margin-left: 25px;">
                تعداد نتایج: <span>{{ persianNum($landings->total()) }} مورد</span>
            </div>
        @else
            <div class="c-ui-paginator__total" data-rows="۰">
                جستجو نتیجه‌ای نداشت
            </div>
        @endif
    </div>

    <div class="c-grid__row c-promo__row--m-sm">
        <table class="c-ui-table c-join__table  js-search-table js-table-fixed-header" data-sort-column="created_at" data-sort-order="desc" data-search-url="{{ route('staff.landings.searchLanding') }}" data-auto-reload-seconds="0" data-new-ui="1" data-is-header-floating="1" data-has-checkboxes="">
            <thead>
            <tr class="c-ui-table__row">
                <th class="c-ui-table__header  ">
                    <span class="js-search-table-column">عنوان صفحه فرود</span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                    <span class="js-search-table-column">لینک صفحه فرود</span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                    <span class="js-search-table-column-sortable table-header-searchable" data-sort-column="start_end_at" data-sort-order="desc">تاریخ نمایش صفحه فرود</span>
                </th>
                <th class="c-ui-table__header  ">
                    <span class="js-search-table-column">وضعیت کالاها</span>
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
            @if(count($landings))
                @foreach($landings as $landing)
                    <tr class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                        <td class="c-ui-table__cell">
                            <div>{{ $landing->name }}</div>
                            {{--                                                            <div class="c-join__landing-state ">--}}
                            {{--                                                                <span class="c-join__has-icon c-join__has-icon--clock">پایان یافته</span>--}}
                            {{--                                                            </div>--}}
                        </td>
                        <td class="c-ui-table__cell c-ui-table__cell--text-blue">
                            <a class="c-join__promotion-link" href="{{ $site_url . '/product-list/' . $landing->slug }}" target="_blank">{{ $site_url . '/product-list/' . $landing->slug }}</a>
                            <a class="c-join__promotion-copy-btn js-copy-btn" href="#" data-link="{{ $site_url . '/product-list/' . $landing->slug }}">کپی لینک</a>
                        </td>
                        <td class="c-ui-table__cell c-join-promotion__date-range">
                            <span class="c-ui-table__date-f rom span-time" data-value="{{ $landing->start_at }}" data-type="شروع"></span>
                            <br>
                            <span class="c-ui-table__date-to span-time" data-value="{{ $landing->end_at }}" data-type="پایان"></span>
                        </td>
                        <td class="c-ui-table__cell">
                            <div class="c-join__status-cell">
                                @php
                                    $ziro_count = $landing->productVariants()->where('stock_count', 0)->get();
                                    $true_count = $landing->productVariants()->where('stock_count', '>' , 0)->get();
                                @endphp
                                @if(!is_null($ziro_count) && count($ziro_count))
                                    <span class="c-join__status"><span class="c-join__status-counter c-join__status-counter--approving"></span>ناموجود</span>
                                @endif
                                @if(!is_null($true_count) && count($true_count))
                                    <span class="c-join__status"><span class="c-join__status-counter c-join__status-counter--approved"></span>موجود</span>
                                @endif
                            </div>
                        </td>
                        <td class="c-ui-table__cell c-ui-table__cell--small-text">
                            <div class="c-ui-tooltip__anchor">
                                <div class="c-ui-toggle__group">
                                    <label class="c-ui-toggle">
                                        <input class="c-ui-toggle__origin js-toggle-active-product" type="checkbox" data-id="{{ $landing->id }}" name="status" {{ ($landing->status)? 'checked' : '' }}>
                                        <span class="c-ui-toggle__check"></span>
                                    </label>
                                </div>
                                <input type="hidden" value="0" class="js-active-input">
                            </div>
                        </td>
                        <td class="c-ui-table__cell">
                            <div class="c-promo__actions">
                                <a class="c-join__btn c-join__btn--icon-left c-join__btn--icon-edit c-join__btn--secondary-greenish" href="{{ route('staff.landings.manage', ['id' => $landing->id]) }}">ویرایش</a>
                                <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete c-join__btn--primary js-remove-plp js-remove-product-list" data-url="/product-list/delete/3871629/">حذف صفحه</button>
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

        {{ $landings->links('stafflanding::layouts.pagination.custom-pagination') }}
        <div class="c-ui-paginator js-paginator">
            <div class="c-ui-paginator js-paginator">
                @if(count($landings))
                <div class="c-ui-paginator__total" data-rows="{{ persianNum($landings->total()) }}">
                    تعداد نتایج: <span>{{ persianNum($landings->total()) }} مورد</span>
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

<script>
    persianNum();
    convertDate();
</script>
