@extends('layouts.staff.master')
@section('head')
<script src="{{ asset('mehdi/staff/js/dk.price.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/jalali-moment.browser.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/bundle.min.js') }}"></script>
<style>
    .select2-search--dropdown{
        display: none !important;
    }
</style>

<script>
    var supernova_mode = "production";
    var supernova_tracker_url = "";
    var isCollectiveModuleActive = true;
    var showRejectedMessage = 0;
    var rejectedMessage = "";
    var isLoggedSeller = 1;
    var walkthroughSteps = [];
    var showPriceModal = 0;
    var newSeller = 1;
    var is_yalda = 0;
</script>
@endsection
@section('content')
<main class="c-main">
    <div class="uk-container uk-container-large">
        <div class="page-layout layout-ended c-grid c-join__grid" style="">
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <div class="c-card">
                        <div class="">
                            <div class="c-join-smart-products__header">کالاهای دارای تخفیف شگفت‌انگیز</div>
                            <div class="c-mega-campaigns-join-list__options">
                                <a href="{{ route('staff.periodic-prices.index') }}" class="c-mega-campaigns-join-list__options-item ">تخفیف‌های شگفت‌انگیز فعال / آغاز نشده</a>
                                <a href="{{ route('staff.periodic-prices.ended') }}" class="c-mega-campaigns-join-list__options-item c-mega-campaigns-join-list__options-item--active">تخفیف‌های شگفت‌انگیز پایان‌یافته</a>
                            </div>
                        </div>
                        <div class="c-mega-campaigns-join-list__container" data-tab="1">
                            <div class="uk-flex uk-flex-bottom">
                                <form class="uk-flex" id="searchForm">
                                    <div class="c-mega-campaigns-join-list__container-filters-search c-join-smart-list--medium-search">
                                        <div class="c-ui-form__col c-ui-form__col--xs-12 c-ui-form__col--small-gap uk-padding-remove-left uk-width-1-1">
                                            <label class="c-ui-form__label">جستجو:</label>
                                            <div class="c-ui-form__row c-ui-form__row--group c-ui-form__row--nowrap c-ui-form__row--wrap-xs">
                                                <div class="c-ui-form__col c-ui-form__col--group-item c-ui-form__col--xs-12 
                                                    c-ui-form__col--wrap-xs c-ui-form__col--xs-full
                                                     c-mega-campaigns-join-list__container-filters-search-type">
                                                    <select class="js-form-clearable c-ui-select c-ui-select--common
                                                     c-ui-select--small c-ui-select--search select2-hidden-accessible"
                                                      name="search[type]" tabindex="-1" aria-hidden="true">
                                                        <option value="all" selected>همه موارد</option>
                                                        <option value="product_name">نام محصول</option>
                                                        <option value="product_id">کد محصول</option>
                                                        <option value="product_variant_id">کد تنوع</option>
                                                    </select>
                                                </div>
                                                <div class="uk-width-1-1 c-ui-form__col c-ui-form__col--xs-6 c-ui-form__col--group-item
                                                    c-ui-form__col--wrap-xs c-ui-form__col--xs-full">
                                                    <label>
                                                        <div class="c-ui-input">
                                                            <input type="text" name="search[title]" class="c-ui-input__field
                                                             c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable
                                                              c-mega-campaigns--light-border" id="search_input" value=""
                                                               placeholder="عبارت جستجو ...">
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="c-ui-form__col c-ui-form__col--xs-12 c-ui-form__col--group-item c-ui-form__col--wrap-xs">
                                                    <button class="c-ui-btn c-ui-btn--xs-block c-ui-btn--active c-ui-btn--search-form" id="submitButton">
                                                        <span>جستجو</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="c-ui-form__col c-ui-form__col--xs-12 c-ui-form__col--wrap-xs uk-padding-remove-right c-mega-campaigns--mr-10">
                                        <label class="c-ui-form__label">بازه زمانی تخفیف:</label>
                                        <div class="c-mega-campaigns-join-list__container-filters-date">
                                        <span>
                                            <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker
                                             pwt-datepicker-input-element" data-format="LLLL" data-time="1" data-from-today="0" 
                                             data-date="1" data-name="search_start_from_" value="" id="form-field-dt-{{ rand(10000, 99999) }}"
                                              autocomplete="off" placeholder="از تاریخ">
                                            <input name="search[start_from]" id="search_start_from_" type="hidden" value="">
                                        </span>
                                            <span>
                                                <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker
                                                 pwt-datepicker-input-element" data-format="LLLL" data-time="1" data-from-today="0"
                                                  data-date="1" data-name="search_end_to_" value="" id="form-field-dt-{{ rand(10000, 99999) }}"
                                                   autocomplete="off" placeholder="تا تاریخ">
                                                <input name="search[end_to]" id="search_end_to_" type="hidden" value="">
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <ul class="c-mega-campaigns__select-product-warning c-mega-campaigns--ml-15 c-mega-campaigns--mr-15 
                            c-mega-campaigns--mt-20 uk-hidden js-show-on-add">
                                <li>
                                    قیمت پس از تخفیف هر کالا باید از حداکثر قیمت مجاز تعیین شده آن کالا پایین‌تر باشد.
                                </li>
                                <li>
                                    حداکثر قیمت مجاز هر کالا بر اساس دسته‌بندی و میانگین قیمت 
                                    آن کالا (یا کالاهای مشابه آن) در چند روز گذشته محاسبه می‌شود.
                                </li>
                            </ul>

                            <div class="c-join-smart-list__type uk-hidden">
                                <div class="uk-flex">
                                    <div class="c-join-smart-list__type-des">
                                        دایره‌های روبروی بخش تخفیف در جدول زیر نمایان‌گر کیفیت تخفیف تعیین شده برای آن کالا می‌باشد.
                                    </div>

                                    <div class="uk-flex uk-flex-middle c-join-smart-list--mr-30">
                                        <div class="c-join-smart-list__type-eleman">
                                            <span class="c-join-smart-list__type-eleman-filing c-join-smart-list__type-eleman-filing--normal"></span>
                                        </div>

                                        <div class="c-join-smart-list--mr-15 uk-flex uk-flex-column uk-flex-start">
                                        <span class="c-join-smart-list__type-title c-join-smart-list__type-title--normal">
                                            تخفیف عادی
                                        </span>
                                            <span class="c-join-smart-list__type-sub-title">
                                            نمایش به صورت تخفیف‌خورده
                                        </span>
                                        </div>
                                    </div>

                                    <div class="uk-flex uk-flex-middle c-join-smart-list--mr-30">
                                        <div class="c-join-smart-list__type-eleman">
                                            <span class="c-join-smart-list__type-eleman-filing c-join-smart-list__type-eleman-filing--good"></span>
                                        </div>

                                        <div class="c-join-smart-list--mr-15 uk-flex uk-flex-column uk-flex-start">
                                        <span class="c-join-smart-list__type-title c-join-smart-list__type-title--good">
                                            تخفیف خوب
                                        </span>
                                            <span class="c-join-smart-list__type-sub-title">
                                            شانس نمایش در لیست فروش ویژه
                                        </span>
                                        </div>
                                    </div>

                                    <div class="uk-flex uk-flex-middle c-join-smart-list--mr-30">
                                        <div class="c-join-smart-list__type-eleman">
                                            <span class="c-join-smart-list__type-eleman-filing c-join-smart-list__type-eleman-filing--excellent"></span>
                                        </div>

                                        <div class="c-join-smart-list--mr-15 uk-flex uk-flex-column uk-flex-start">
                                        <span class="c-join-smart-list__type-title c-join-smart-list__type-title--excellent">
                                            تخفیف عالی
                                        </span>
                                            <span class="c-join-smart-list__type-sub-title">
                                            شانس شرکت در کمپین‌های {{ $fa_store_name }}
                                        </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-join-smart-select__notif-link js-show-active-campaign-list">
                                    لیست همه پروموشن‌های فعال
                                </div>

                            </div>

                            <div class="c-mega-campaigns-join-list__container-table 
                                c-promo--width-controller js-table-container" id="product-list-items">
                                <div class="c-mega-campaigns-join-list__container">
                                    <div class="uk-flex uk-flex-between">
                                        <div class="uk-flex">
                                        </div>
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
                                    <div class="c-promo__row--m-sm">
                                        <table class="c-ui-table c-periodic-prices__table c-join__table  
                                        js-search-table js-table-fixed-header" data-sort-column="created_at" 
                                        data-sort-order="desc" data-search-url="{{ route('staff.periodic-prices.endedSearch') }}"
                                         data-auto-reload-seconds="0" data-new-ui="1"
                                          data-is-header-floating="1" data-has-checkboxes="">
                                            <thead>
                                            <tr class="c-ui-table__row">
                                                <th class="c-ui-table__header  ">
                                                    <span class="js-search-table-column"></span>
                                                </th>
                                                <th class="c-ui-table__header  " style="width: 28%;">
                                                    <span class="js-search-table-column">عنوان و‌ کد تنوع کالا ({{ $product_code_prefix }}C)</span>
                                                </th>
                                                <th class="c-ui-table__header  ">
                                                    <span class="js-search-table-column-sortable table-header-searchable" data-sort-column="buy_price" data-sort-order="desc">قیمت خرید (ریال)</span>
                                                </th>
                                                <th class="c-ui-table__header  ">
                                                    <span class="js-search-table-column-sortable table-header-searchable" data-sort-column="selling_price" data-sort-order="desc">قیمت فروش (ریال)</span>
                                                </th>
                                                <th class="c-ui-table__header  ">
                                                    <span class="js-search-table-column">تعداد فروش در این پروموشن</span>
                                                </th>

                                                <th class="c-ui-table__header  ">
                                                    <span class="js-search-table-column">٪ تخفیف از قیمت شما</span>
                                                </th>
                                                <th class="c-ui-table__header  ">
                                                    <span class="js-search-table-column">قیمت پس  از تخفیف (ریال)</span>
                                                </th>
                                                <th class="c-ui-table__header  ">
                                                    <span class="js-search-table-column">بازه زمانی تخفیف</span>
                                                </th>
                                                <th class="c-ui-table__header  ">
                                                    <span class="js-search-table-column">تعداد در تخفیف</span>
                                                </th>
                                                <th class="c-ui-table__header  ">
                                                    <span class="js-search-table-column">تعداد در سبد</span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($promotions as $promotion)
                                                <tr class="c-ui-table__row c-ui-table__row--body js-edit-row  added-by-js-{{ $promotion->id }}"
                                                 data-id="{{ $promotion->id }}">
                                                    <td class="c-ui-table__cell">
                                                        <img src="{{ $site_url . '/' . $promotion->productVariants()->first()->product->media()->first()->path . '/' . $promotion->productVariants()->first()->product->media()->first()->name }}" alt="{{ $promotion->productVariants()->first()->product->title_fa . '|' . $promotion->productVariants()->first()->warranty->name }}" class="c-mega-campaigns-join-list__container-table-image">
                                                    </td>
                                                    <td class="c-ui-table__cell" style="text-align: right">
                                                        {{ $promotion->productVariants()->first()->product->title_fa . '|' . $promotion->productVariants()->first()->warranty->name }}
                                                        <span class="c-mega-campaigns-join-list__container-table-dkpc">
                                                            {{ $product_code_prefix }}C-{{ $promotion->productVariants()->first()->variant_code }}
                                                        </span>
                                                        <div class="c-mega-campaigns-join-list__container-table-error
                                                         uk-text-nowrap uk-hidden added-by-js-messages-{{ $promotion->id }}">
                                                        </div>
                                                    </td>
                                                    <td class="c-ui-table__cell">
                                                        {{ persianNum(number_format($promotion->productVariants()->first()->buy_price)) }}
                                                    </td>
                                                    <td class="c-ui-table__cell">
                                                        {{ persianNum(number_format($promotion->productVariants()->first()->sale_price)) }}
                                                    </td>
                                                    <td class="c-ui-table__cell">-</td>
                                                    <td class="c-ui-table__cell uk-padding-remove">
                                                        <div class="c-mega-campaigns--mh-105 uk-flex">
                                                            <div class="c-mega-campaigns--mt-25 uk-flex">
                                                                <div class="uk-flex uk-flex-column">
                                                                    <div class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--xs 
                                                                        js-number-input-wrapper" style="margin-top: 4px !important;">
                                                                        <input readonly="" type="number" class="js-discount-value js-number-input"
                                                                         value="{{ $promotion->percent }}">
                                                                    </div>
                                                                    <span class="c-mega-campaigns-join-modal__body-table-input-sub-title" style="visibility: hidden;">
                                                                        حداقل تخفیف:۲%
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
                                                                 c-mega-campaigns-join-modal__body-table-input--medium 
                                                                 js-number-input-wrapper" style="margin-top: 7px !important;">
                                                                    <input readonly="" type="text" name="variant[promotion_price]" 
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
                                                    <td class="c-ui-table__cell c-join-promotion__price-cell c-join-promotion__price-cell--date c-join-promotion__price-cell--date-picker">
                                                        <div class="c-mega-campaigns--mt-16" style="margin-top: 0px !important;">
                                                            <div class="uk-flex">
                                                                <span class="c-mega-campaigns-join-list__container-table-date span-time" data-value="{{ $promotion->start_at }}" data-type="از"></span>
                                                            </div>
                                                            <div class="uk-flex">
                                                                <span class="c-mega-campaigns-join-list__container-table-date span-time" data-value="{{ $promotion->end_at }}" data-type="تا"></span>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td class="c-ui-table__cell uk-padding-remove">
                                                        <div class="c-join-smart-products--middle-item-height uk-flex uk-flex-middle uk-flex-center">
                                                            <div class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--small-container c-mega-campaigns-join-modal__body-table-input--small js-number-input-wrapper uk-flex">
                                                                <input readonly="" type="text" name="variant[promotion_limit]" class="js-number-input js-input-promotion-limit" value="{{ $promotion->promotion_limit }}">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="c-ui-table__cell uk-padding-remove">
                                                        <div class="c-join-smart-products--middle-item-height uk-flex uk-flex-middle uk-flex-center">
                                                            <div class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--small-container c-mega-campaigns-join-modal__body-table-input--small js-number-input-wrapper uk-flex">
                                                                <input readonly="" type="text" name="variant[promotion_order_limit]" class="js-number-input js-input-order-limit" value="{{ $promotion->promotion_order_limit }}">
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

                                        @if(count($promotions))
                                         {{ $promotions->links('staffpromotion::layouts.pagination.custom-pagination') }}
                                        @endif

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

                            <div class="c-mega-campaigns--p-30 uk-flex uk-flex-right uk-padding-remove-bottom uk-hidden js-show-on-add">
                                <button class="c-join__btn c-join__btn--primary js-back-to-campaign-list">بازگشت به صفحه مدیریت تخفیف‌ها</button>
                                <button class="c-mega-campaigns__btns-green js-confirm-promotion">تایید و اعمال تخفیف‌ها</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="js-select-products" uk-modal="esc-close: true; bg-close: true;"
         class="uk-modal-container uk-modal-container--message uk-modal">
            <div class="uk-modal-dialog uk-modal-dialog--flex">
                <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""></button>

                <div class="uk-modal-body">

                    <div class="c-modal-notification c-join-promotion__modal">
                        <div>
                            <div class="c-card__header">
                                <h2 class="c-card__title">انتخاب کالا از لیست</h2>
                            </div>
                            <div class="c-card__body">
                                <div class="c-join-promotion__table">
                                </div>
                            </div>
                            <div class="c-card__footer c-join__table-footer">
                            </div>
                        </div>
                        <div class="c-card__loading js-modal-loading"></div>
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

$(document).on('change', 'input[name="variant[time_status]"]', function (){
    if ($(this).is(":checked")) {
        $(this).closest('.c-ui-table__row').find('.start_at').removeAttr('disabled');
        $(this).closest('.c-ui-table__row').find('.start_at').removeClass('disabled');
        $(this).closest('.c-ui-table__row').find('.end_at').removeAttr('disabled');
        $(this).closest('.c-ui-table__row').find('.end_at').removeClass('disabled');
    } else {
        $(this).closest('.c-ui-table__row').find('.start_at').attr('disabled', true);
        $(this).closest('.c-ui-table__row').find('.start_at').addClass('disabled');
        $(this).closest('.c-ui-table__row').find('.end_at').attr('disabled', true);
        $(this).closest('.c-ui-table__row').find('.end_at').addClass('disabled');

        $(this).closest('.c-ui-table__row').find('.start_at').val('');
        $(this).closest('.c-ui-table__row').find('.start_at_hidden').val('');
        $(this).closest('.c-ui-table__row').find('.end_at_hidden').val('');
        $(this).closest('.c-ui-table__row').find('.end_at').val('');

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

$(document).ready(function (){
    persianNum();
    convertDate();
});

</script>
@endsection
