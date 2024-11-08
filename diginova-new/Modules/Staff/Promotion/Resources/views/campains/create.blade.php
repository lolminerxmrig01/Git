@extends('layouts.staff.master')
@section('title') ایجاد کمپین | {{ $fa_store_name }}  @endsection
@section('head')
<script src="{{ asset('mehdi/staff/js/promotions.js') }}"></script>
<style>
    .c-grid__col--gap-lg {
        padding-left: 5px !important;
        padding-right: 5px !important;
    }
</style>
@endsection

@section('content')
    <main class="c-content-layout">
        <div class="uk-container uk-container-large">
            <div class="c-grid c-join__grid">
                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card c-card--transparent">
                            <h1 class="c-card__title c-card__title--dark c-card__title--desc">
                                            ایجاد کمپین
                                <span class="c-card__title-sub c-card__title-sub--no-spacing">
                                    از این صفحه می‌توانید کمپین خود را ایجاد کنید.
                                </span>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="c-grid__row js-table-container" id="table-view-container">
                    <div class="c-grid__col">
                        <div class="c-card c-card--padding">
                            <div class="c-card__wrapper">
                                <div class="c-add-products__header-section" style="border:none;">
                                    <h3 class="c-add-products__title" style="margin-bottom: 25px !important;">ایجاد کمپین</h3>
                                    <form class="js-create-plp-form">
                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial
                                         c-grid__col--sm-6" style="width: 400px !important;float: right;">
                                            <label class="c-ui-form__label" for="product_page_title">نام کمپین</label>
                                            <label>
                                                <div class="c-ui-input">
                                                    <input type="text" name="name" value="" class="c-ui-input__field c-ui-input__field--order 
                                                        c-ui-input__field--has-btn js-form-clearable" id="product_page_title" placeholder="نام کمپین">
                                                </div>
                                            </label>
                                        </div>

                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6"
                                         style="width: 215px;float: right;">
                                            <label for="form-field-productList[start_at]" class="c-ui-form__label">تاریخ و زمان شروع</label>
                                            <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker
                                             pwt-datepicker-input-element" data-format="LLLL" data-time="1" data-from-today="1"
                                              data-date="1" data-name="productList_start_at_" value="" id="form-field-dt-26888" autocomplete="off">
                                            <input name="start_at" id="productList_start_at_" type="hidden" value="2021-03-11 20:06:48">
                                        </div>

                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6" 
                                            style="width: 215px;float: right;">
                                            <label for="form-field-productList[end_at]" class="c-ui-form__label">تاریخ و زمان پایان</label>
                                            <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker 
                                            pwt-datepicker-input-element" data-format="LLLL" data-time="1" data-from-today="1"
                                             data-date="1" data-name="productList_end_at_" value="" id="form-field-dt-93319" autocomplete="off">
                                            <input name="end_at" id="productList_end_at_" type="hidden" value="2021-03-10 20:06:48">
                                        </div>

                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial 
                                        c-grid__col--sm-6" style="float: right;width: 166px;">
                                            <label class="c-ui-form__label" for="status">وضعیت</label>
                                            <select id="product-status" class="dropdown-control c-ui-select c-ui-select--common 
                                            c-ui-select--small select2-hidden-accessible" name="status" tabindex="-1" aria-hidden="true" 
                                            style="width: 150px ​!important;">
                                                <option class="option-control" value="1"selected>فعال</option>
                                                <option class="option-control" value="0">غیرفعال</option>
                                            </select>
                                        </div>

                                        {{-- <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr
                                         c-grid__col--flex-initial c-grid__col--sm-6" style="width: 166px;float: right;"s>
                                            <label class="c-ui-form__label" for="product_page_title">ایجاد صفحه سفارشی</label>
                                            <select id="has_landing" class="dropdown-control c-ui-select c-ui-select--common
                                             c-ui-select--small select2-hidden-accessible" name="has_landing" 
                                             data-select2-id="has_landing" tabindex="-1" aria-hidden="true">
                                                <option class="option-control" value="0" selected>خیر</option>
                                                <option class="option-control" value="1">بله</option>
                                            </select>
                                        </div> --}}

                                        <div class="product-form slug-section" style="display: none;">
                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                                <label class="uk-form-label uk-flex uk-flex-between">
                                                    نامک
                                                </label>
                                                <div class="field-wrapper" style="width: 605px;">
                                                    <input type="text" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn 
                                                    js-form-clearable url-inputs js-form-clearable" name="slug" dir="ltr">
                                                    <input type="button" id="button-urls" style="width: auto;" class="c-ui-tag__submit
                                                     js-tag-submit-btn button-urls" value="{{ '/' . $site_url . '/product-list' }}" disabled="">
                                                </div>
                                                <div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr
                                         c-grid__col--flex-initial c-grid__col--sm-6 div-space"></div>

                                    </form>

                                    <div class="c-join__buttons">
                                        <button class="c-join__btn c-join__btn--secondary c-join__btn--secondary-greenish 
                                        c-join__btn--icon-left js-save-list-page-button">تایید و ایجاد کمپین جدید</button>
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
            </div>

            <div id="js-select-products" uk-modal="esc-close: true; bg-close: true;" class="uk-modal-container
                uk-modal-container--message uk-modal-container--relative-height uk-modal">
                <div class="uk-modal-dialog uk-modal-dialog--flex">
                    <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close="">
                        <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" ratio="1">
                            <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line>
                            <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line>
                        </svg>
                    </button>

                    <div class="uk-modal-body">
                        <div class="c-modal-notification c-join-promotion__modal">
                            <div class="c-card__header">
                                <h2 class="c-card__title">انتخاب کالا از لیست</h2>
                            </div>
                            <div class="c-card__body">
                                <form action="" class="c-ui-form" id="select-search-form">
                                    <div class="c-ui-form__row">
                                        <div class="c-ui-form__col c-ui-form__col-4">
                                            <label class="c-ui-form__label" for="search_input">جستجو:</label>
                                            <div class="c-ui-input">
                                                <input type="search" name="query" class="c-ui-input__field c-ui-input__field--order 
                                                js-form-clearable c-join__input" id="search_input" placeholder="جستجوی کد کالا، کد تنوع و ..."
                                                 style="width: 400px;">
                                                <button class="uk-icon-button c-join__search-btn uk-icon" uk-icon="icon: search"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-join__sort-products">
                                        <div>مرتب‌سازی بر اساس:</div>
                                        <div class="c-join__sort-options c-join__filter-container js-search-sort">
                                            <label class="c-join__radio-label">
                                                <input class="c-join__radio" type="radio" name="sort" value="latest" checked="">
                                                <span class="c-join__radio-option">جدیدترین</span>
                                            </label>
                                            <label class="c-join__radio-label">
                                                <input class="c-join__radio" type="radio" name="sort" value="price_low">
                                                <span class="c-join__radio-option">ارزان‌ترین</span>
                                            </label>
                                            <label class="c-join__radio-label">
                                                <input class="c-join__radio" type="radio" name="sort" value="price_high">
                                                <span class="c-join__radio-option">گرانترین</span>
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="js-products-content">
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
// اضافه کردن توکن به درخواست های ایجکس
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// $("#has_landing").on('change', function (){
//     if ($(this).val() == 1){
//         $(".slug-section").show();
//         $(".div-space").hide();

//         var buttonWidth = $('#button-urls').width() + 20;
//         $(".url-inputs").css({
//             'padding-left': buttonWidth,
//             'padding-top' : '2px',
//         });
//     } else if ($(this).val() == 0){
//         $(".slug-section").hide();
//         $(".div-space").show();
//         $(".url-inputs").val('');
//     }
// });

    $(".slug-section").hide();
    $(".div-space").show();
    $(".url-inputs").val('');
</script>
@endsection

