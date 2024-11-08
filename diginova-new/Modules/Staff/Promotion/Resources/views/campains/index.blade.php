@extends('layouts.staff.master')
@section('title')  مدیریت کمپین ها | {{ $fa_store_name }}  @endsection
@section('head')
<script src="{{ asset('mehdi/staff/js/campainTableView.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/jalali-moment.browser.js') }}"></script>
@endsection
@section('content')
<main class="c-main">
        <div class="uk-container uk-container-large">
            <div class="c-grid c-join__grid">
                <div class="c-grid__row c-join__top-details c-join__top-details--sm">
                    <div class="c-grid__col c-join__flex-space-between">
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc c-add-products__title">
                            مدیریت کمپین
                            <span class="c-card__title-sub c-card__title-sub--no-spacing">
                                کمپین جدید بسازید و یا کمپین‌های ساخته شده را ویرایش کنید.
                            </span>
                        </h1>
                            <a href="{{ route('staff.campains.create') }}"
                             class="c-join__btn c-join__btn--secondary-greenish
                              c-join__btn--icon-left c-join__btn--icon-plus">
                            ایجاد کمپین جدید
                        </a>
                    </div>
                </div>

                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card">
                            <div class="c-card__header" style="border-bottom: unset !important;">
                                <div class="c-grid__col">
                                    <h2 class="c-card__title">کمپین‌های ایجاد شده</h2>
                                </div>
                            </div>

                            <div class="c-mega-campaigns-join-list__options js-remove-in-add-form">
                                <a href="{{ route('staff.campains.index') }}" class="c-mega-campaigns-join-list__options-item
                                 c-mega-campaigns-join-list__options-item--active">
                                 کمپین‌های فعال / آغاز نشده
                                </a>
                                <a href="{{ route('staff.campains.ended') }}"
                                class="c-mega-campaigns-join-list__options-item">کمپین‌های پایان‌یافته</a>
                            </div>

                            <div class="c-card__body">
                                <div class="c-grid__col">
                                    <div class="c-grid__col c-promo__tab-container
                                    c-promo__tab-container--is-visible" data-tab="1">

                                        <div class="c-grid__row c-promo__has-divider">
                                            <form class="c-ui-form c-join__manage-filters" id="searchForm">
                                                <div class="c-ui-form__row">
                                                    <div class="c-ui-form__col c-ui-form__col-4">
                                                        <label class="c-ui-form__label">جستجو:</label>
                                                        <div class="c-ui-input">
                                                            <input type="search" name="title" class="c-ui-input__field c-ui-input__field--order
                                                            js-form-clearable c-join__input" id="search_input" placeholder="جستجوی نام کمپین"
                                                            style="width: 400px;">
                                                            <button class="uk-icon-button c-join__search-btn uk-icon" uk-tooltip="title: جستجو;"
                                                             uk-icon="icon: search" id="submitButton" title="" aria-expanded="false">
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <span class="c-ui-form__col c-ui-form__col--group-item" style="width: 215px">
                                                        <label for="form-field-start_at" class="c-ui-form__label">تاریخ و زمان شروع</label>
                                                        <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker
                                                         pwt-datepicker-input-element" data-format="LLLL" data-time="1" data-from-today="0"
                                                         data-date="1" data-name="start_at" value="" id="form-field-dt-36491" autocomplete="off">
                                                        <input name="start_at" id="start_at" type="hidden" value="">
                                                    </span>

                                                    <span class="c-ui-form__col c-ui-form__col--group-item" style="width: 215px">
                                                        <label for="form-field-end_at" class="c-ui-form__label">تاریخ و زمان پایان</label>
                                                        <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker
                                                         pwt-datepicker-input-element" data-format="LLLL" data-time="1" data-from-today="0"
                                                         data-date="1" data-name="end_at" value="" id="form-field-dt-25286" autocomplete="off">
                                                        <input name="end_at" id="end_at" type="hidden" value="">
                                                    </span>

                                                </div>
                                            </form>
                                        </div>

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
                                                <table class="c-ui-table c-join__table  js-search-table js-table-fixed-header"
                                                data-sort-column="created_at" data-sort-order="desc"
                                                data-search-url="{{ route('staff.campains.searchCampain') }}"
                                                data-auto-reload-seconds="0" data-new-ui="1"
                                                data-is-header-floating="1" data-has-checkboxes="">
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
                                                            <span class="js-search-table-column-sortable table-header-searchable"
                                                             data-sort-column="start_end_at" data-sort-order="desc">تاریخ نمایش کمپین</span>
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
                                                                <span class="c-join__has-icon c-join__has-icon--clock"
                                                                 style="padding-right: 25px;">پایان یافته</span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="c-ui-table__cell">
                                                            {{ ($campain->promotions()->exists())? persianNum(count($campain->promotions)) : persianNum(0) }}
                                                        </td>
                                                        {{-- <td class="c-ui-table__cell {{ ($campain->landing()->exists())? 'c-ui-table__cell--text-blue' : '' }}">
                                                            @if($campain->landing()->exists())
                                                            <a class="c-join__promotion-link" href="{{ $site_url . '/product-list/' . $campain->slug }}"
                                                             target="_blank">{{ $site_url . '/product-list/' . $campain->slug }}</a>
                                                            <a class="c-join__promotion-copy-btn js-copy-btn" href="#"
                                                            data-link="{{ $site_url . '/product-list/' . $campain->slug }}">کپی لینک</a>
                                                            @else
                                                                ندارد
                                                            @endif
                                                        </td> --}}
                                                        <td class="c-ui-table__cell c-join-promotion__date-range">
                                                            <span class="c-ui-table__date-f rom span-time" data-value="{{ $campain->start_at }}"
                                                                data-type="شروع"></span>
                                                            <br>
                                                            <span class="c-ui-table__date-to span-time" data-value="{{ $campain->end_at }}"
                                                             data-type="پایان"></span>
                                                        </td>
                                                        <td class="c-ui-table__cell">
                                                            <div class="c-join__status-cell">
                                                                <span class="c-join__status">
                                                                    <span class="c-join__status-counter c-join__status-counter--approved">
                                                                    </span>موجود</span>
                                                                <span class="c-join__status">
                                                                    <span class="c-join__status-counter c-join__status-counter--approving"></span>
                                                                    ناموجود
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="c-ui-table__cell c-ui-table__cell--small-text">
                                                            <div class="c-ui-tooltip__anchor">
                                                                <div class="c-ui-toggle__group">
                                                                    <label class="c-ui-toggle">
                                                                        <input class="c-ui-toggle__origin js-toggle-active-product" type="checkbox"
                                                                        data-id="{{ $campain->id }}" name="status" {{ ($campain->status)? 'checked' : '' }}>
                                                                        <span class="c-ui-toggle__check"></span>
                                                                    </label>
                                                                </div>
                                                                <input type="hidden" value="0" class="js-active-input">
                                                            </div>
                                                        </td>
                                                        <td class="c-ui-table__cell">
                                                            <div class="c-promo__actions">
                                                                <a class="c-join__btn c-join__btn--icon-left c-join__btn--icon-edit c-join__btn--secondary-greenish"
                                                                 href="{{ route('staff.campains.manage', ['id' => $campain->id]) }}">ویرایش</a>
                                                                <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete c-join__btn--primary
                                                                     js-remove-plp js-remove-product-list"
                                                                     data-url="{{ route('staff.campains.removeCampain', ['id' => $campain->id]) }}">حذف کمپین</button>

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

                                                {{ $campains->links('stafflanding::layouts.pagination.custom-pagination') }}
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
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
</main>
@endsection
@section('script')
<script>
// توکن csrf
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.js-stop-promotion', function (e) {
    e.preventDefault();

    var self = $(this),
        promotionVariantId = self.data('promotion-variant-id');
    if (typeof promotionVariantId == 'undefined' || promotionVariantId.length === 0) {
        return;
    }
    var promotionId = !!window.promotionId ? window.promotionId : (self.data('promotion') || 0);
    setTimeout(function () {
        Services.ajaxPOSTRequestJSON(
            'campains/moveToEnds',
            {
                promotionVariantId: promotionVariantId
            },
            function (response) {
                self.closest('tr').remove();
                self.closest('tr').hide('slow', function(){
                    self.closest('tr').remove();
                });

            },
            function (error) {
                UIkit.notification({
                    message: error.errors,
                    status: 'danger',
                    pos: 'bottom-right',
                    timeout: 8000
                });
            }
        );
    }, 50);
});

$(document).on('change', 'input[name="status"]', function () {
    if($(this).is(':checked'))
    {
        var status = 1;
    }
    else{
        var status = 0;
    }
    var data_id = $(this).attr('data-id');

    $.ajax({
        method: 'post',
        url: "{{ route('staff.campains.campainStatus') }}",
        data: {
            'status': status,
            'id' : data_id,
        }
    });
});

function persianNum() {
    String.prototype.toPersianDigits= function(){
        var id= ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        return this.replace(/[0-9]/g, function(w){
            return id[+w]
        });
    }
}

function convertDate() {
    $(".span-time").each(function (){
        var output="";
        var input = $(this).attr('data-value');
        var m = moment(input);
        if(m.isValid()){
            m.locale('fa');
            output = $(this).attr('data-type') + ' ' + m.format("YYYY/M/D HH:mm");
        }
        $(this).text(output.toPersianDigits());
    });
}

persianNum();
convertDate();

</script>
@endsection
