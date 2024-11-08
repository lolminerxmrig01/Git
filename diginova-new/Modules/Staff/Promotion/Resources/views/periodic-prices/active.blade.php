@section('title') مدیریت پروموشن ها | {{ $fa_store_name }}  @endsection
@extends('layouts.staff.master')
@section('head')
<script src="{{ asset('mehdi/staff/js/dk.price.js') }}"></script>
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
        <div class="page-layout layout-empty c-grid c-join__grid" style="display: none">
            <div class="c-grid__row c-join__top-details c-join__top-details--sm">
                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card c-card--transparent">
                            <h1 class="c-card__title c-card__title--dark c-card__title--desc">
                                تخفیف‌های شگفت‌انگیز
                                <span class="c-card__title-sub c-card__title-sub--no-spacing">
                                    در این قسمت می‌توانید برای کالاهای خود تخفیف تعیین کنید. کالاها بر مبنای میزان
                                    تخفیف تعیین شده به پروموشن‌های مختلف {{ $fa_store_name }} اضافه می‌شوند.
                                </span>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="c-grid__row js-empty-smart-promotion">
                    <div class="c-grid__col">
                        <div class="c-card c-join-smart-emty__container">
                            <div class="c-join-smart-emty__des">
                                <img src="https://seller.digikala.com/static/files/7c0b3151.svg" alt="">
                                <div class="c-join-smart-emty__des-title">شما هیچ کالایی را در لیست تخفیف‌های شگفت‌انگیز قرار
                                    نداده‌اید
                                </div>

                                <div class="c-join-smart-emty__des-sub-title">با قرار دادن کالاهای خود در این لیست و اعمال تخفیف
                                    بر روی آن‌ها بازدید و فروش کالاهای خود را افزایش دهید.
                                </div>
                                <div class="c-mega-campaigns__btns-green-plus js-empty-layout-add-btn">افزودن
                                    کالای جدید به لیست تخفیف‌ها
                                </div>
                            </div>
                            <img class="c-card c-join-smart-emty__img-container" src="{{ asset('mehdi/staff/images/promotion.jpg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-layout layout-add c-grid c-join__grid" style="display: none;">
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <div class="c-card c-card--transparent">
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc">تخفیف‌های شگفت‌انگیز
                            <span class="c-card__title-sub c-card__title-sub--no-spacing">
                                در این قسمت می‌توانید برای کالاهای خود تخفیف تعیین کنید.
                                کالاها بر مبنای میزان تخفیف تعیین شده به پروموشن‌های
                                مختلف {{ $fa_store_name }} اضافه می‌شوند.
                            </span>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="c-grid__row js-guide-container">
                <div class="c-grid__col">
                    <div class="c-card c-join-smart-emty--p-20">
                        <div class="uk-flex uk-flex-between c-join-smart-emty__guide">
                            <div class="c-join-smart-emty__guide-title">
                                راهنمای تخفیف‌های شگفت‌انگیز
                            </div>
                            <div class="c-join-smart-emty__guide-close js-close-guide"></div>
                        </div>
                        <ul class="c-join-smart-emty__guide-item">
                            <li>
                                شما می‌توانید برای هر یک از کالاهای موجود خود به میزان دلخواه تخفیف تعیین کنید.
                            </li>

                            <li>
                                کالاها پس از اضافه شدن به پروموشن‌ها و کمپین‌های مختلف به یکی از شکل‌های زیر در سایت
                                نمایش داده می‌شوند:
                            </li>
                        </ul>
                        <div class="c-join-smart-emty__guide-type">
                            <div class="c-join-smart-emty__guide-type-off uk-width-1-3">
                                <div class="c-join-smart-emty__guide-type-off-title">
                                    تخفیف عادی
                                </div>

                                <div class="c-join-smart-emty__guide-type-off-des">
                                    - نمایش قیمت به صورت خط خورده با درصد تخفیف
                                </div>
                            </div>

                            <div class="c-join-smart-emty__guide-type-promotion uk-width-1-3">
                                <div class="c-join-smart-emty__guide-type-promotion-title">
                                    پروموشن فروش ویژه
                                </div>

                                <div class="c-join-smart-emty__guide-type-off-des">
                                    - نمایش قیمت به صورت خط خورده با درصد تخفیف
                                </div>

                                <div class="c-join-smart-emty__guide-type-off-des">
                                    - امکان قرارگیری پشت بنرهای {{ $fa_store_name }}
                                </div>
                            </div>

                            <div class="c-join-smart-emty__guide-type-campaign uk-width-1-3">
                                <div class="c-join-smart-emty__guide-type-campaign-title">
                                    کمپین‌های {{ $fa_store_name }}
                                </div>
                                <div class="c-join-smart-emty__guide-type-off-des">
                                    - نمایش قیمت به صورت خط خورده با درصد تخفیف
                                </div>
                                <div class="c-join-smart-emty__guide-type-off-des">
                                    - امکان قرارگیری پشت بنرهای {{ $fa_store_name }} و در صفحات پروموشن
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="c-grid__row" id="table-view-container">
                <div class="c-grid__col">
                    <div class="c-card c-card--padding">
                        <div class="c-card__wrapper">
                            <div class="c-join__product-selection">
                                <div class="c-join__product-select c-join__product-select--manual">
                                    <div class="c-join__select-area">
                                        <div class="c-join__select-image c-join__select-image--list"></div>
                                        <span class="c-join__select-title">روش اول: انتخاب کالاها از طریق پنل</span>
                                        <span class="c-join__select-subtitle">کالاها را به صورت دستی از میان کالاهای مجاز انتخاب و قیمت‌گذاری کنید.</span>
                                        <div>
                                            <button class="c-join__btn c-join__btn--secondary c-join__btn--icon-right
                                                c-join__btn--icon-list js-select-products">
                                                انتخاب کالاها از لیست
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <span class="c-join__select-separator"></span>

                                <div class="c-join__product-select c-join__product-select--upload">
                                    <div class="c-join__select-area">
                                        <div class="c-join__select-image c-join__select-image--excel"></div>
                                        <span class="c-join__select-title">روش دوم: بارگذاری گروهی کالاها با فایل اکسل</span>
                                        <span class="c-join__select-subtitle">فایل اکسل حاوی محصولات مورد نظرتان را بارگذاری کنید.</span>                                        <label class="c-join__btn c-join__btn--deactive c-join__btn--icon-right" style="color: #606265 !important;">
                                            <input type="file" class="c-join-promotion__upload-input js-products-file js-import-excel-file">
                                            &nbsp;&nbsp; به زودی... &nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-right">
                                <button class="c-join__btn c-join__btn--primary js-back-to-products-list" disabled="">بازگشت به
                                    صفحه مدیریت تخفیف‌ها
                                </button>
                            </div>
                            <div class="c-join__loading c-loading c-loading--hidden">
                                <div class="c-loading__container">
                                    <div class="loading"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-layout layout-active c-grid c-join__grid" style="">
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <div class="c-card">
                        <div class="c-mega-campaigns-join-empty__body-card ">
                            <div class="c-join-smart-products__header">کالاهای دارای تخفیف شگفت‌انگیز</div>
                            <div class="c-mega-campaigns-join-list__options js-remove-in-add-form">
                                <a href="{{ route('staff.periodic-prices.index') }}"
                                   class="c-mega-campaigns-join-list__options-item c-mega-campaigns-join-list__options-item--active">
                                    تخفیف‌های شگفت‌انگیز فعال / آغاز نشده
                                </a>
                                <a href="{{ route('staff.periodic-prices.ended') }}"
                                   class="c-mega-campaigns-join-list__options-item">
                                    تخفیف‌های شگفت‌انگیز پایان‌یافته
                                </a>
                            </div>
                            <div class="c-mega-campaigns-join-list__container">
                                <div class="uk-flex uk-flex-bottom">
                                    <form class="uk-flex" id="searchForm">
                                        <div class="c-mega-campaigns-join-list__container-filters-search c-join-smart-list--medium-search">
                                            <div class="c-ui-form__col c-ui-form__col--xs-12 c-ui-form__col--small-gap uk-padding-remove-left uk-width-1-1">
                                                <label class="c-ui-form__label">جستجو:</label>

                                                <div class="c-ui-form__row c-ui-form__row--group c-ui-form__row--nowrap c-ui-form__row--wrap-xs">
                                                    <div class="c-ui-form__col c-ui-form__col--group-item c-ui-form__col--xs-12
                                                        c-ui-form__col--wrap-xs c-ui-form__col--xs-full c-mega-campaigns-join-list__container-filters-search-type">
                                                        <select class="js-form-clearable c-ui-select c-ui-select--common c-ui-select--small
                                                         c-ui-select--search select2-hidden-accessible" name="search[type]" tabindex="-1" aria-hidden="true">
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
                                                                <input type="text" name="search[title]" class="c-ui-input__field c-ui-input__field--order
                                                                    c-ui-input__field--has-btn js-form-clearable c-mega-campaigns--light-border"
                                                                       id="search_input" value="" placeholder="عبارت جستجو ...">
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

                                        <div class="c-ui-form__col c-ui-form__col--group-item c-ui-form__col--xs-12 c-ui-form__col--wrap-xs
                                            c-ui-form__col--xs-full c-mega-campaigns-join-list__container-filters-select c-mega-campaigns--mr-10">
                                            <label class="c-ui-form__label">وضعیت کالا</label>
                                            <select name="search[status]" class="dropdown-control c-ui-select c-ui-select--common
                                                c-ui-select--small select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                <option class="option-control" value="all" selected>نمایش همه</option>
                                                <option class="option-control" value="active">فعال</option>
                                                <option class="option-control" value="deactive">غیرفعال</option>
                                            </select>
                                        </div>

                                        <div class="c-ui-form__col c-ui-form__col--xs-12 c-ui-form__col--wrap-xs uk-padding-remove-right c-mega-campaigns--mr-10">
                                            <label class="c-ui-form__label">بازه زمانی تخفیف:</label>
                                            <div class="c-mega-campaigns-join-list__container-filters-date">
                                        <span>
                                            <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker pwt-datepicker-input-element"
                                                   data-format="LLLL" data-time="1" data-from-today="0" data-date="1" data-name="search_start_from_" value=""
                                                   id="form-field-dt-59517" autocomplete="off" placeholder="از تاریخ">
                                        <input name="search[start_from]" id="search_start_from_" type="hidden" value="">
                                        </span>
                                        <span>
                                            <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker pwt-datepicker-input-element"
                                                   data-format="LLLL" data-time="1" data-from-today="0" data-date="1" data-name="search_end_to_" value=""
                                                   id="form-field-dt-20335" autocomplete="off" placeholder="تا تاریخ">
                                                <input name="search[end_to]" id="search_end_to_" type="hidden" value="">
                                        </span>
                                            </div>
                                        </div>


                                    </form>
                                </div>
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

                                <div class="c-mega-campaigns-join-list__container-table c-promo--width-controller js-table-container"
                                     id="product-list-items">

                                    <div class="c-mega-campaigns-join-list__container">

                                        <div class="uk-flex uk-flex-between">
                                            <div class="uk-flex">
                                                <div class="c-mega-campaigns__btns-green-plus uk-margin-remove-top js-empty-layout-add-btn">
                                                    افزودن کالای جدید به لیست تخفیف‌ها
                                                </div>
                                            </div>
                                            <div class="c-ui-paginator js-paginator" style="margin-left: 25px;">
                                                <div class="c-ui-paginator js-paginator">
                                                    @if($promotions)
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
                                            <table class="c-ui-table c-periodic-prices__table c-join__table  js-search-table js-table-fixed-header"
                                             data-sort-column="created_at" data-sort-order="desc" data-search-url="{{ route('staff.periodic-prices.search') }}"
                                              data-auto-reload-seconds="0" data-new-ui="1" data-is-header-floating="1" data-has-checkboxes="">
                                                <thead>
                                                <tr class="c-ui-table__row">
                                                    <th class="c-ui-table__header  ">
                                                        <span class="js-search-table-column"></span>
                                                    </th>
                                                    <th class="c-ui-table__header  ">
                                                        <span class="js-search-table-column">عنوان و‌ کد تنوع کالا ({{ $product_code_prefix }}C)</span>
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
                                                        <span class="js-search-table-column">زمان دار</span>
                                                    </th>
                                                    <th class="c-ui-table__header  ">
                                                        <span class="js-search-table-column">بازه زمانی تخفیف</span>
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
                                                            <div class="c-join-promotion__table-input c-join-promotion__discount c-join-promotion__discount--all js-number-input-wrapper">
                                                                <input type="number" min="0" class="c-join-promotion__discount-input js-all-variants-discount-percent js-number-input" placeholder="≠">
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
                                                            <input type="number" min="0" class="c-join-promotion__discount-input js-all-variants-promotion-limit js-number-input" placeholder="≠">
                                                        </div>
                                                    </td>
                                                    <td class="c-ui-table__cell c-ui-table__cell--has-input">
                                                        <div class="c-join-promotion__table-input js-number-input-wrapper">
                                                            <input type="number" min="0" class="c-join-promotion__discount-input js-all-variants-order-limit js-number-input" placeholder="≠">
                                                        </div>
                                                    </td>
                                                    <td class="c-ui-table__cell"></td>
                                                    <td class="c-ui-table__cell"></td>
                                                </tr>

                                                @if($promotions)
                                                    @foreach($promotions as $promotion)
                                                        <?php $product = $promotion->productVariants()->first()->product; ?>
                                                        <tr class="c-ui-table__row c-ui-table__row--body js-edit-row  added-by-js-{{ $promotion->id }}" data-id="{{ $promotion->id }}">
                                                            <td class="c-ui-table__cell">
                                                                @if ($product->media()->exists())
                                                                    <img src="{{ $site_url . '/' . $product->media()->first()->path . '/' . $product->media()->first()->name }}"
                                                                        class="c-mega-campaigns-join-list__container-table-image">
                                                                @endif
                                                            </td>
                                                            <td class="c-ui-table__cell" style="text-align: right;">
                                                                {{ $product->title_fa . '|' . $promotion->productVariants()->first()->warranty->name }}
                                                                <span class="c-mega-campaigns-join-list__container-table-dkpc">
                                                                    {{ $product_code_prefix }}C-{{ $promotion->productVariants()->first()->variant_code }}
                                                                </span>
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
                                                                            <div class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--xs js-number-input-wrapper">
                                                                                <input name="variant[promotion_percent]" type="number" min="0" max="100" class="js-discount-value js-number-input" value="{{ $promotion->percent }}">
                                                                            </div>
                                                                            <span class="c-mega-campaigns-join-modal__body-table-input-sub-title"></span>
                                                                        </div>
                                                                        <span class="c-mega-campaigns-join-modal__body-table-input-link c-mega-campaigns--mr-5"></span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="c-ui-table__cell uk-padding-remove">
                                                                <div class="uk-flex uk-flex-column c-mega-campaigns--mh-105 uk-flex-center">
                                                                    <div class="c-mega-campaigns--mt-12">
                                                                        <div class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--medium js-number-input-wrapper">
                                                                            <input type="text" name="variant[promotion_price]" class="js-promotion-price js-numeric-input" value="{{ $promotion->promotion_price }}" data-selling_price="{{ $promotion->productVariants()->first()->sale_price }}" data-crossed_price="{{ $promotion->productVariants()->first()->sale_price }}">
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
                                                                            <input class="c-ui-toggle__origin js-toggle-active-product time_status" type="checkbox" data-group-id="" name="variant[time_status]" data-reset="{{ (!is_null($promotion->start_at))? 'checked' : 'not_checked' }}" {{ (!is_null($promotion->start_at))? 'checked' : '' }}>
                                                                            <span class="c-ui-toggle__check"></span>
                                                                        </label>
                                                                    </div>
                                                                    <input type="hidden" value="0" class="js-active-input">
                                                                </div>
                                                            </td>

                                                            <td class="c-ui-table__cell c-join-promotion__price-cell c-join-promotion__price-cell--date c-join-promotion__price-cell--date-picker">
                                                                <span class="c-ui-form__col c-ui-form__col--group-item" style="width: 215px">
                                                                    <label for="form-field-variant[start_at][{{ $promotion->id }}]" class="c-ui-form__label">از</label>
                                                                    <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker pwt-datepicker-input-element start_at time-section {{ is_null($promotion->start_at)? 'disabled' : '' }}" data-format="YYYY/MM/DD" data-time="1" data-from-today="1" data-date="1" data-name="variant_start_at__{{ $promotion->id }}_" value="{{ $promotion->start_at }}" id="form-field-dt-{{ rand(10000, 99999) }}" autocomplete="off" {{ is_null($promotion->start_at)? 'disabled' : '' }}>
                                                                    <input name="variant[start_at][{{ $promotion->id }}]" id="variant_start_at__{{ $promotion->id }}_" class="start_at_hidden time-section" type="hidden" value="{{ $promotion->start_at }}">
                                                                </span>

                                                                <span class="c-ui-form__col c-ui-form__col--group-item" style="width: 215px">
                                                                    <label for="form-field-variant[end_at][{{ $promotion->id }}]" class="c-ui-form__label">تا</label>
                                                                    <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker pwt-datepicker-input-element end_at time-section  {{ is_null($promotion->end_at)? 'disabled' : '' }}" data-format="YYYY/MM/DD" data-time="1" data-from-today="1" data-date="1" data-name="variant_end_at__{{ $promotion->id }}_" value="{{ $promotion->end_at }}" id="form-field-dt-{{ rand(10000, 99999) }}" autocomplete="off" {{ is_null($promotion->end_at)? 'disabled' : '' }}>
                                                                    <input name="variant[end_at][{{ $promotion->id }}]" id="variant_end_at__{{ $promotion->id }}_" class="end_at_hidden time-section" type="hidden" value="{{ $promotion->end_at }}">
                                                                </span>
                                                            </td>

                                                            <td class="c-ui-table__cell uk-padding-remove">
                                                                <div class="c-ui-tooltip__anchor">
                                                                    <div class="c-ui-toggle__group">
                                                                        <label class="c-ui-toggle">
                                                                            <input class="c-ui-toggle__origin js-toggle-active-product variant_status" type="checkbox" data-group-id="" name="variant[status]" data-reset="{{ ($promotion->status)? 'checked' : 'not_checked' }}" {{ ($promotion->status)? 'checked' : '' }}>
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
                                                                    <div class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--small-container c-mega-campaigns-join-modal__body-table-input--small js-number-input-wrapper uk-flex">
                                                                        <input type="number" name="variant[promotion_limit]" min="1" class="js-number-input js-input-promotion-limit" value="{{ $promotion->promotion_limit }}">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="c-ui-table__cell uk-padding-remove">
                                                                <div class="c-join-smart-products--middle-item-height uk-flex uk-flex-middle uk-flex-center">
                                                                    <div class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--small-container c-mega-campaigns-join-modal__body-table-input--small js-number-input-wrapper uk-flex">
                                                                        <input type="number" name="variant[promotion_order_limit]" min="1" class="js-number-input js-input-order-limit" value="{{ $promotion->promotion_order_limit }}">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="c-ui-table__cell uk-padding-remove">
                                                                <div class="uk-flex uk-flex-between uk-flex-middle c-join-smart-products--middle-item-height js-edit-actions">
                                                                    <div class=" c-mega-campaigns-join-modal__body-table-btn-separator c-mega-campaigns--ml-10">
                                                                        <button class="c-mega-campaigns-join-list__container-table-btn
                                                                         c-mega-campaigns-join-list__container-table-btn--save c-mega-campaigns--ml-10
                                                                          c-mega-campaigns--mr-10 js-edit-button button js-save-promotion-price-record-changes"
                                                                           data-promotion="{{ $promotion->id }}" data-product-variant-id="{{ $promotion->id }}"
                                                                            data-promotion-variant-id="{{ $promotion->id }}" disabled=""></button>
                                                                        <button class="c-mega-campaigns-join-list__container-table-btn
                                                                         c-mega-campaigns-join-list__container-table-btn--cancle c-mega-campaigns--ml-10 js-edit-cancel-button
                                                                          js-table-swap-row-handle" disabled=""></button>
                                                                    </div>

                                                                    <button class="c-mega-campaigns-join-list__container-table-btn  js-stop-promotion js-tool-tip-archive" style="margin-top: 7px;" data-promotion="3856494" data-variant="{{ $promotion->id }}" data-promotion-variant-id="{{ $promotion->id }}">
                                                                        <img src="{{ asset('mehdi/staff/icon/archive.svg') }}">
                                                                    </button>
                                                                    <div class="c-rating-chart__description-tooltip c-mega-campaigns-join-list__container-table-btn-tooltip uk-text-nowrap uk-dropdown uk-dropdown-stack" uk-dropdown="boundary: .js-tool-tip-archive; pos: bottom-center;delay-hide: 0;offset: 10;" style="left: 128.172px; top: 80px;">
                                                                        پایان دادن
                                                                    </div>
                                                                    <button class="c-mega-campaigns-join-list__container-table-btn c-mega-campaigns-join-list__container-table-btn--delete js-remove-variant"
                                                                     style="margin-right: 10px; margin-top: 7px;" data-promotion="{{ $promotion->id }}" data-variant="{{ $promotion->id }}"
                                                                      data-promotion-variant-id="{{ $promotion->id }}" data-product-id="{{ $promotion->id }}"></button>
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
                                                @endif

                                                </tbody>
                                            </table>
                                            <div class="c-card__loading"></div>
                                        </div>

                                        <div class="c-card__footer" style="width: auto;">
                                            <a href="#" style="visibility: hidden;">
                                                <div class="c-mega-campaigns__btns-green-plus uk-margin-remove"></div>
                                            </a>
                                            @if($promotions)
                                                {{ $promotions->links('staffpromotion::layouts.pagination.custom-pagination') }}
                                            @endif
                                            <div class="c-ui-paginator js-paginator">
                                                <div class="c-ui-paginator js-paginator">
                                                    @if($promotions)
                                                        <div class="c-ui-paginator__total" data-rows="">
                                                            تعداد نتایج:
                                                            <span>
                                                                {{ persianNum($promotions->total()) }} مورد
                                                            </span>
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
                                    <button class="c-join__btn c-join__btn--primary js-back-to-campaign-list">
                                        بازگشت به صفحه مدیریت تخفیف‌ها
                                    </button>
                                    <button class="c-mega-campaigns__btns-green js-confirm-promotion">
                                        تایید و اعمال تخفیف‌ها
                                    </button>
                                </div>
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
                                <div class="c-join-promotion__table"></div>
                            </div>
                            <div class="c-card__footer c-join__table-footer"></div>
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

$(document).on('click', '.js-stop-promotion', function (e) {
    e.preventDefault();
    console.log('dddff');
    var self = $(this),
        promotionVariantId = self.data('promotion-variant-id');
    if (typeof promotionVariantId == 'undefined' || promotionVariantId.length === 0) {
        return;
    }
    var promotionId = !!window.promotionId ? window.promotionId : (self.data('promotion') || 0);

    setTimeout(function () {
        Services.ajaxPOSTRequestJSON(
            'moveToEnds',
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
    $(".time-section").each(function (){
        var output="";
        var m = moment(input);
        if(m.isValid()){
            m.locale('fa');
            output = m.format("YYYY/M/D HH:mm");
        }
        $(this).value(output.toPersianDigits());
    });
}

persianNum();
convertDate();

</script>
@endsection
