<div class="js-table-container" id="product-list-items">
    <br>
    <div class="c-ui-paginator js-paginator">
        @if(!is_null($campains) && count($campains))
            <div class="c-ui-paginator__total" data-rows="" style="margin-left: 25px;">
                تعداد نتایج: <span>{{ persianNum($campains->total()) }} مورد</span>
            </div>
        @else
            <div class="c-ui-paginator__total" data-rows="۰">
                جستجو نتیجه‌ای نداشت
            </div>
        @endif
    </div>

    <div class="c-grid__row c-promo__row--m-sm">
        <table class="c-ui-table c-join__table  js-search-table js-table-fixed-header" 
        data-sort-column="created_at" data-sort-order="desc"
         data-search-url="{{ route('staff.campains.endedCampainSearch') }}"
          data-auto-reload-seconds="0" data-new-ui="1" 
          data-is-header-floating="1" data-has-checkboxes="">
            <thead>
            <tr class="c-ui-table__row">
                <th class="c-ui-table__header  ">
                    <span class="js-search-table-column">نام کمپین</span>
                </th>
                <th class="c-ui-table__header  ">
                    <span class="js-search-table-column">تعداد کالاها</span>
                </th>
                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                    <span class="js-search-table-column-sortable table-header-searchable" 
                    data-sort-column="start_end_at" data-sort-order="desc">تاریخ نمایش کمپین</span>
                </th>
                <th class="c-ui-table__header  ">
                    <span class="js-search-table-column">مجموع تعداد فروش</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @if(!is_null($campains) && count($campains))
                @foreach($campains as $campain)
                    <tr class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                        <td class="c-ui-table__cell">
                            <div style="font-weight: bold !important;">{{ $campain->name }}</div>
                            <div class="c-join__landing-state c-ui-table__cell--text-warning">
                                @if(!is_null($campain->end_at) && $campain->end_at < now())
                                    <span class="c-join__has-icon c-join__has-icon--clock"  
                                    style="padding-right: 25px;">پایان یافته</span>
                                @endif
                            </div>
                        </td>
                        <td class="c-ui-table__cell">
                            @if($campain->promotions()->exists())
                                {{ persianNum(count($campain->promotions)) }}
                            @else
                                {{ persianNum(0) }}
                            @endif
                        </td>
                        <td class="c-ui-table__cell c-join-promotion__date-range">
                            <span class="c-ui-table__date-f rom span-time" data-value="{{ $campain->start_at }}" 
                            data-type="شروع"></span>
                            <br>
                            <span class="c-ui-table__date-to span-time" data-value="{{ $campain->end_at }}"
                             data-type="پایان"></span>
                        </td>
                        <td class="c-ui-table__cell c-join-promotion__date-range">
                            {{ persianNum(0) }}
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

        @if(count($campains))
            {{ $campains->links('stafflanding::layouts.pagination.custom-pagination') }}
        @endif

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
