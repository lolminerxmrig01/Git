@extends('layouts.staff.master')
@section('title') مدیریت کد تخفیف | {{ $fa_store_name }}  @endsection
@section('head')
<script>
    var supernova_mode = "production";
    var supernova_tracker_url = "";
    var showRejectedMessage = 0;
    var rejectedMessage = "";
    var isLoggedSeller = 1;
    var walkthroughSteps = [];
    var showPriceModal = 0;
    var newSeller = 1;
    var is_yalda = 0;
</script>
<script src="{{ asset('mehdi/staff/js/tableView.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/jalali-moment.browser.js') }}"></script>
<style>
.c-ui-table__cell {
    text-align: right !important;
}

.c-ui-table__header {
    text-align: right !important;
}
</style>
@endsection
@section('content')
<main class="c-main">
        <div class="uk-container uk-container-large">
            <div class="c-grid c-join__grid">
                <div class="c-grid__row c-join__top-details c-join__top-details--sm">
                    <div class="c-grid__col c-join__flex-space-between">
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc c-add-products__title">
                            کد تخفیف
                            <span class="c-card__title-sub c-card__title-sub--no-spacing">کد تخفیف جدید بسازید و یا کد های تخفیف ساخته شده را ویرایش کنید.</span></h1>
                            <a href="{{ route('staff.vouchers.create') }}" class="c-join__btn c-join__btn--secondary-greenish c-join__btn--icon-left c-join__btn--icon-plus">
                            ساخت کد تخفیف
                        </a>
                    </div>
                </div>

                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card">
                            <div class="c-card__header">
                                <div class="c-grid__col">
                                    <h2 class="c-card__title">کد های تخفیف ساخته‌شده</h2>
                                </div>
                            </div>
                            <div class="c-card__body">
                                <div class="c-grid__col">
                                    <div class="c-grid__col c-promo__tab-container c-promo__tab-container--is-visible" data-tab="1">

                                        <div class="c-grid__row c-promo__has-divider">
                                            <form class="c-ui-form c-join__manage-filters" id="searchForm">
                                                <div class="c-ui-form__row">
                                                    <div class="c-ui-form__col c-ui-form__col-4">
                                                        <label class="c-ui-form__label">جستجو:</label>
                                                        <div class="c-ui-input">
                                                            <input type="search" name="title" class="c-ui-input__field c-ui-input__field--order js-form-clearable c-join__input" id="search_input" placeholder="جستجوی عنوان تخفیف" style="width: 400px;">
                                                            <button class="uk-icon-button c-join__search-btn uk-icon" uk-tooltip="title: جستجو;" uk-icon="icon: search" id="submitButton" title="" aria-expanded="false"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" ratio="1"> <circle fill="none" stroke="#000" stroke-width="1.1" cx="9" cy="9" r="7"></circle> <path fill="none" stroke="#000" stroke-width="1.1" d="M14,14 L18,18 L14,14 Z"></path></svg></button>
                                                        </div>
                                                    </div>

                                                    <span class="c-ui-form__col c-ui-form__col--group-item" style="width: 215px">
                                                        <label for="form-field-start_at" class="c-ui-form__label">تاریخ و زمان شروع</label>
                                                        <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker pwt-datepicker-input-element" data-format="LLLL" data-time="1" data-from-today="0" data-date="1" data-name="start_at" value="" id="form-field-dt-36491" autocomplete="off">
                                                        <input name="start_at" id="start_at" type="hidden" value="">
                                                    </span>

                                                    <span class="c-ui-form__col c-ui-form__col--group-item" style="width: 215px">
                                                        <label for="form-field-end_at" class="c-ui-form__label">تاریخ و زمان پایان</label>
                                                        <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker pwt-datepicker-input-element" data-format="LLLL" data-time="1" data-from-today="0" data-date="1" data-name="end_at" value="" id="form-field-dt-25286" autocomplete="off">
                                                        <input name="end_at" id="end_at" type="hidden" value="">
                                                    </span>

                                                    <div class="c-ui-form__col c-ui-form__col-2" style="width: 215px">
                                                        <label class="c-ui-form__label">وضعیت
                                                        </label>
                                                        <select name="status" class="dropdown-control c-ui-select c-ui-select--common c-ui-select--small select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                            <option class="option-control" value="all">نمایش همه</option>
                                                            <option class="option-control" value="active">فعال</option>
                                                            <option class="option-control" value="inactive">غیرفعال</option>
                                                            <option class="option-control" value="ended">پایان یافته</option>
                                                            <option class="option-control" value="has_time">زمان دار</option>
                                                            <option class="option-control" value="without_time">بدون زمان</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>

                                        <div class="js-table-container" id="product-list-items">
                                            <br>
                                            <div class="c-ui-paginator js-paginator">
                                                @if($vouchers)
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
                                                        <th class="c-ui-table__header  ">
                                                            <span class="js-search-table-column">میزان تخفیف</span>
                                                        </th>
                                                        <th class="c-ui-table__header c-ui-table__header--nowrap ">
                                                            <span class="js-search-table-column">کد تخفیف</span>
                                                        </th>
                                                        <th class="c-ui-table__header c-ui-table__header--nowrap ">
                                                            <span class="js-search-table-column-sortable table-header-searchable" data-sort-column="start_end_at" data-sort-order="desc">مهلت استفاده</span>
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
                                                            <a class="c-join__promotion-link" href="javascript:void(0);" style="font-weight: bold">{{ $voucher->code }}</a>
                                                            <a class="c-join__promotion-copy-btn js-copy-btn" href="javascript:void(0);" data-link="{{ $voucher->code }}">کپی کد</a>
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
                                                                <span style="text-align: center">{{ (!is_null($voucher->max_usable))? 'قابل استفاده: ' . persianNum($voucher->max_usable) . ' نفر' : '' }}</span>
                                                                <span style="text-align: center">{{ (!is_null($voucher->type) && ($voucher->type == 'first_purchase'))? 'فقط برای خرید اول' : '' }}</span>
                                                                <span style="text-align: center">{{ (!is_null($voucher->freeـshipping) && ($voucher->freeـshipping == 'true'))? 'با هزینه ارسال رایگان' : '' }}</span>
                                                                @if($voucher->categories()->exists())
                                                                <span style="text-align: center"> فعال برای دسته: {{ $voucher->categories()->first()->name }} </span>
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
                                                                        <input class="c-ui-toggle__origin js-toggle-active-product" type="checkbox" data-id="{{ $voucher->id }}"
                                                                         name="status" {{ (($voucher->end_at > now() || is_null($voucher->end_at)) )? '' : 'disabled' }}
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
                                                                js-remove-plp js-remove-product-list" data-url="{{ route('staff.vouchers.removeVoucher', ['id' => $voucher->id]) }}">حذف</button>
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
                                                {{-- <div class="c-ui-paginator js-paginator">
                                                    <div class="c-ui-paginator js-paginator">
                                                        @if($vouchers)
                                                            <div class="c-ui-paginator__total" data-rows="">
                                                            تعداد نتایج: <span>{{ persianNum($vouchers->total()) }} مورد</span>
                                                            </div>
                                                        @else
                                                            <div class="c-ui-paginator__total" data-rows="۰">
                                                                جستجو نتیجه‌ای نداشت
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div> --}}
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
        url: "{{ route('staff.vouchers.statusVoucher') }}",
        data: {
            'status': status,
            'id' : data_id,
        }
    });
});

</script>
@endsection
