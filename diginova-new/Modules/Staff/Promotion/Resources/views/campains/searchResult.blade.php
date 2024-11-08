<div class="js-table-container" id="product-list-items">
    <br>
    <div class="c-ui-paginator js-paginator">
        @if(!is_null($campains) && count($campains))
            <div class="c-ui-paginator__total" data-rows="">
                تعداد نتایج: <span>{{ persianNum($campains->total()) }} مورد</span>
            </div>
        @else
            <div class="c-ui-paginator__total" data-rows="۰">
                جستجو نتیجه‌ای نداشت
            </div>
        @endif
    </div>

    <div class="c-grid__row c-promo__row--m-sm">
        <table class="c-ui-table c-join__table  js-search-table js-table-fixed-header" data-sort-column="created_at" data-sort-order="desc" data-search-url="{{ route('staff.campains.searchCampain') }}" data-auto-reload-seconds="0" data-new-ui="1" data-is-header-floating="1" data-has-checkboxes="">
            <thead>
            <tr class="c-ui-table__row">
                <th class="c-ui-table__header  ">
                    <span class="js-search-table-column">نام کمپین</span>
                </th>
                <th class="c-ui-table__header  ">
                    <span class="js-search-table-column">تعداد کالاهای موجود</span>
                </th>
                {{-- <th class="c-ui-table__header c-ui-table__header--nowrap ">
                    <span class="js-search-table-column">لینک صفحه سفارشی</span>
                </th> --}}
                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                    <span class="js-search-table-column-sortable table-header-searchable" data-sort-column="start_end_at" data-sort-order="desc">تاریخ نمایش کمپین</span>
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
            @if(!is_null($campains) && count($campains))
                @foreach($campains as $campain)
                    <tr class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                        <td class="c-ui-table__cell">
                            <div style="font-weight: bold;">{{ $campain->name }}</div>
                            <div class="c-join__landing-state c-ui-table__cell--text-warning">
                                @if(!is_null($campain->end_at) && $campain->end_at < now())
                                    <span class="c-join__has-icon c-join__has-icon--clock"  style="padding-right: 25px;">پایان یافته</span>
                                @endif
                            </div>
                        </td>
                        <td class="c-ui-table__cell">
                            {{ ($campain->promotions()->exists())? persianNum(count($campain->promotions)) : persianNum(0) }}
                        </td>
                        {{-- <td class="c-ui-table__cell c-ui-table__cell--text-blue">
                            @if($campain->landing()->exists())
                                <a class="c-join__promotion-link" href="{{ $site_url . '/product-list/' . $campain->slug }}" target="_blank">{{ $site_url . '/product-list/' . $campain->slug }}</a>
                                <a class="c-join__promotion-copy-btn js-copy-btn" href="#" data-link="{{ $site_url . '/product-list/' . $campain->slug }}">کپی لینک</a>
                            @else
                                ندارد
                            @endif
                        </td> --}}
                        <td class="c-ui-table__cell c-join-promotion__date-range">
                            <span class="c-ui-table__date-f rom span-time" data-value="{{ $campain->start_at }}" data-type="شروع"></span>
                            <br>
                            <span class="c-ui-table__date-to span-time" data-value="{{ $campain->end_at }}" data-type="پایان"></span>
                        </td>
                        <td class="c-ui-table__cell">
                            <div class="c-join__status-cell">
                                <span class="c-join__status"><span class="c-join__status-counter c-join__status-counter--approved"></span>موجود</span>
                                <span class="c-join__status"><span class="c-join__status-counter c-join__status-counter--approving"></span>ناموجود</span>
                            </div>
                        </td>
                        <td class="c-ui-table__cell c-ui-table__cell--small-text">
                            <div class="c-ui-tooltip__anchor">
                                <div class="c-ui-toggle__group">
                                    <label class="c-ui-toggle">
                                        <input class="c-ui-toggle__origin js-toggle-active-product" type="checkbox" data-id="{{ $campain->id }}" name="status" {{ ($campain->status)? 'checked' : '' }}>
                                        <span class="c-ui-toggle__check"></span>
                                    </label>
                                </div>
                                <input type="hidden" value="0" class="js-active-input">
                            </div>
                        </td>
                        <td class="c-ui-table__cell">
                            <div class="c-promo__actions">
                                <a class="c-join__btn c-join__btn--icon-left c-join__btn--icon-edit c-join__btn--secondary-greenish" href="{{ route('staff.campains.manage', ['id' => $campain->id]) }}">ویرایش</a>
                                <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete c-join__btn--primary js-remove-plp js-remove-product-list" data-url="{{ route('staff.campains.removeCampain', ['id' => $campain->id]) }}">حذف کمپین</button>
                                <button class="c-join__btn c-join__btn--icon-right c-join__btn--primary
                                js-tool-tip-archive js-stop-promotion" style="margin-top: 1px;width: 30px;"
                                 data-promotion="3856494" data-variant="1"
                                  data-promotion-variant-id="{{ $campain->id }}" aria-expanded="false">
                                    <img src="{{ asset('mehdi/staff/icon/archive.svg') }}">
                                </button>
                                <div class="c-rating-chart__description-tooltip
                                c-mega-campaigns-join-list__container-table-btn-tooltip uk-text-nowrap
                                 uk-dropdown uk-dropdown-stack" uk-dropdown="boundary: .js-tool-tip-archive;
                                 pos: bottom-center;delay-hide: 0;offset: 10;" style="left: 128.172px; top: 80px;">
                                    پایان دادن
                                </div>
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

        {{ $campains->links('staffpromotion::campains.custom-pagination') }}

        <div class="c-ui-paginator js-paginator">
            <div class="c-ui-paginator js-paginator">
                @if(count($campains))
                    <div class="c-ui-paginator__total" data-rows="">
                        تعداد نتایج: <span>{{ persianNum($campains->total()) }} مورد</span>
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
