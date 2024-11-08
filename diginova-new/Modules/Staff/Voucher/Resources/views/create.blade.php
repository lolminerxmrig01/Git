@extends('layouts.staff.master')
@section('title') ایجاد کد تخفیف | {{ $fa_store_name }}  @endsection
@section('head')
    <script src="{{ asset('mehdi/staff/js/promotions.js') }}"></script>
@endsection

@section('content')
    <main class="c-content-layout">
        <div class="uk-container uk-container-large">
            <div class="c-grid">
                <div class="c-content-page c-content-page--plain c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-content-page__header">
                            <span class="c-content-page__header-action">ایجاد کد تخفیف</span>
                            <span class="c-content-page__header-desc">برای محصولات فروشگاه کد تخفیف ایجاد کنید</span>
                        </div>
                    </div>
                </div>
                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card">
                            <form id="voucher_form">
                                <div class="c-grid__col">
                                    <div class="product-form">
                                        <div class="c-content-accordion js-accordion uk-accordion">
                                            <section class="c-content-accordion__row js-content-section uk-open" id="stepCategoryAccordion">
                                                <h2 style="font-size: 18px; margin-right: 33px; margin-top: -8px;">
                                                    <div style="color: #606265;">ایجاد کد تخفیف</div>
                                                </h2>

                                                <div style="width: 100%;margin: -7px 0px 50px 0px !important;padding: 0px !important;background: #e2dddd;height: 1px;"></div>

                                                <div class="c-content-accordion__content c-content-accordion__content--small" id="stepTitleContainer" aria-hidden="false" style="margin-right: -25px;">

                                                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr" style="margin: 0 0 0 0; width: 100%;">
                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-5">
                                                            <label class="uk-form-label uk-flex uk-flex-between">
                                                                عنوان کد تخفیف:
                                                                <span class="uk-form-label__required"></span>
                                                            </label>
                                                            <div class="field-wrapper">
                                                                <input type="text" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable" name="name">
                                                            </div>
                                                        </div>

                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6" style="float: right;width: 166px;">
                                                            <label class="c-ui-form__label" for="product_page_title">وضعیت</label>
                                                            <select id="product-status" class="dropdown-control c-ui-select c-ui-select--common c-ui-select--small select2-hidden-accessible" name="status" data-select2-id="product-status" tabindex="-1" aria-hidden="true" style="width: 150px ​!important;">
                                                                <option class="option-control" value="1" selected>فعال</option>
                                                                <option class="option-control" value="0">غیرفعال</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-5" style="margin-top: 10px;">
                                                        <label class="uk-form-label uk-flex uk-flex-between">
                                                            کد تخفیف:
                                                            <span class="uk-form-label__required"></span>
                                                        </label>
                                                        <div class="field-wrapper">
                                                            <input type="text" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable url-inputs" name="code" dir="ltr" style="padding-left: 165.578px;padding-top: 3px;letter-spacing: 3px !important;  text-transform:uppercase;">
                                                            <input type="button" id="button-urls" style="width: auto;background-image: url('{{ asset('./staff/icon/Ticket.svg') }}');background-repeat: no-repeat;background-size: 15%;padding-right: 43px;padding-left: 12px;background-position-x: 120px !important;background-position-y: center;font-family: 'IRANSans';" class="c-ui-tag__submit js-tag-submit-btn button-urls" value="تولید کد تصادفی">
                                                        </div>
                                                    </div>


                                                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr" style="margin: 0 0 0 0; width: 100%;">


                                                        <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr" style="margin: 0 0 0 0; width: 100%;">
                                                            <div class="c-mega-campaigns--mh-105 uk-flex">
                                                                <div class="c-mega-campaigns--mt-25 uk-flex" style="margin-right: 10px;">
                                                                    <div class="uk-flex uk-flex-column">
                                                                        <div class=" c-grid__col c-grid__col--gap-small c-grid__col--flex-initial c-grid__col--xs-gap">
                                                                            <div class="field-wrapper">
                                                                                <label class="uk-form-label uk-flex uk-flex-between">درصد تخفیف:<span class="uk-form-label__required"></span>
                                                                                </label>
                                                                                <label class="c-content-input">
                                                                                    <input type="number" placeholder="" class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--xs js-number-input-wrapper" value="" name="percent" style="max-width: 110px !important;">
                                                                                    <span class="c-content-input__text c-content-input__text--overlay" style="left: 0 !important;right: unset !important;">درصد</span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <span class="c-mega-campaigns-join-modal__body-table-input-link c-mega-campaigns--mr-5" style="margin: 27px 5px 0 5px;"></span>
                                                                    <div class="uk-flex uk-flex-column">
                                                                        <div class=" c-grid__col c-grid__col--gap-small c-grid__col--flex-initial c-grid__col--xs-gap">
                                                                            <div class="field-wrapper">
                                                                                <label class="uk-form-label uk-flex uk-flex-between">تا سقف:
                                                                                </label>
                                                                                <label class="c-content-input">
                                                                                    <input type="number" placeholder="" class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--xs js-number-input-wrapper" value="" name="up_to" style="max-width: 110px !important;">
                                                                                    <span class="c-content-input__text c-content-input__text--overlay" style="left: 0 !important;right: unset !important;">ریال</span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <span class="c-mega-campaigns-join-modal__body-table-input-link c-mega-campaigns--mr-5" style="margin: 27px 5px 0 5px;"></span>
                                                                    <div class="uk-flex uk-flex-column">
                                                                        <div class=" c-grid__col c-grid__col--gap-small c-grid__col--flex-initial c-grid__col--xs-gap">
                                                                            <div class="field-wrapper">
                                                                                <label class="uk-form-label uk-flex uk-flex-between">برای خرید بالای:</label>
                                                                                <label class="c-content-input">
                                                                                    <input type="number" placeholder="" class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--xs js-number-input-wrapper" value="" name="min_product_price" style="max-width: 121px !important;">
                                                                                    <span class="c-content-input__text c-content-input__text--overlay" style="left: 0 !important;right: unset !important;">ریال</span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr" style="margin-right: 15px;">
                                                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-4 c-grid__col--xs-gap" style="width: 26%;">
                                                        <label for="productIsFake" class="uk-form-label">مهلت استفاده:</label>
                                                        <div class="field-wrapper field-wrapper--justify field-wrapper--background">
                                                            <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto" id="productIsFakeLabel">
                                                                <input type="checkbox" class="c-ui-checkbox__origin" name="has_limit_time" id="productIsFake" value="1">
                                                                <span class="c-ui-checkbox__check"></span>
                                                                <span class="c-ui-checkbox__label">زمان استفاده از کد تخفیف محدود باشد</span>
                                                            </label>
                                                        </div>
                                                    </div>


                                                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6" style="width: 194px;float: right;">
                                                        <label for="form-field-productList[start_at]" class="c-ui-form__label">تاریخ و زمان شروع</label>
                                                        <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker pwt-datepicker-input-element time-input start_at c-ui-input--disabled disabled" data-format="LLLL" data-time="1" data-from-today="1" data-date="1" data-name="productList_start_at_" value="" id="form-field-dt-26888" autocomplete="off" style="border: 1px solid #e6e9ed !important;" disabled>
                                                        <input name="start_at" id="productList_start_at_" class="start_at_hidden" type="hidden" value="">
                                                    </div>
                                                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6" style="width: 194px;float: right;">
                                                        <label for="form-field-productList[end_at]" class="c-ui-form__label">تاریخ و زمان پایان</label>
                                                        <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker pwt-datepicker-input-element time-input start_at end_at c-ui-input--disabled disabled" data-format="LLLL" data-time="1" data-from-today="1" data-date="1" data-name="productList_end_at_" value="" id="form-field-dt-26881" autocomplete="off" style="border: 1px solid #e6e9ed !important;" disabled>
                                                        <input name="end_at" name="end_at" class="end_at_hidden" id="productList_end_at_" type="hidden" value="">
                                                    </div>
                                                </div>


                                                <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr" style="margin-right: 15px; margin-top: 45px !important;">
                                                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-4 c-grid__col--xs-gap" style="width: 26%;">
                                                        <label for="productIsFake" class="uk-form-label">حداکثر تعداد استفاده:</label>
                                                        <div class="field-wrapper field-wrapper--justify field-wrapper--background">
                                                            <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto" id="productIsFakeLabel">
                                                                <input type="checkbox" class="c-ui-checkbox__origin" name="has_max_usable" id="productIsFake" value="1">
                                                                <span class="c-ui-checkbox__check"></span>
                                                                <span class="c-ui-checkbox__label">تعداد استفاده از این کد تخفیف محدود باشد</span>
                                                            </label>
                                                        </div>
                                                    </div>


                                                    <div class="uk-flex uk-flex-column">
                                                        <div class=" c-grid__col c-grid__col--gap-small c-grid__col--flex-initial c-grid__col--xs-gap">
                                                            <div class="field-wrapper" style="margin-right: 10px;">
                                                                <label class="uk-form-label uk-flex uk-flex-between">حداکثر تعداد استفاده:</label>
                                                                <label class="c-content-input">
                                                                    <input type="number" placeholder="" class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--xs js-number-input-wrapper c-ui-input--disabled disabled maximum_usable" value="" name="maximum_usable" style="max-width: 141px !important;margin-left: -10px;" disabled>
                                                                    <span class="c-content-input__text c-content-input__text--overlay" style="left: 0 !important;right: unset !important;">عدد</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr" style="margin-right: 15px; margin-top: 45px !important;">
                                                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-5 c-grid__col--xs-gap">
                                                        <label for="productIsFake" class="uk-form-label">مشتریان جدید:</label>
                                                        <div class="field-wrapper field-wrapper--justify field-wrapper--background">
                                                            <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto" id="productIsFakeLabel">
                                                                <input type="checkbox" class="c-ui-checkbox__origin" name="for_new_users" value="1" id="productIsFake">
                                                                <span class="c-ui-checkbox__check"></span>
                                                                <span class="c-ui-checkbox__label">استفاده از این کد تخفیف فقط برای مشتریانی که خرید اولی هستند مجاز باشد</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr uk-hidden" style="margin-right: 15px; margin-top: 45px !important;">
                                                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-5 c-grid__col--xs-gap">
                                                        <label for="productIsFake" class="uk-form-label">هزینه ارسال:</label>
                                                        <div class="field-wrapper field-wrapper--justify field-wrapper--background">
                                                            <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto" id="productIsFakeLabel">
                                                                <input type="checkbox" class="c-ui-checkbox__origin" name="has_freeـshipping" value="1">
                                                                <span class="c-ui-checkbox__check"></span>
                                                                <span class="c-ui-checkbox__label">با استفاده از این کد تخفیف هزینه ارسال رایگان محاسبه شود</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr" style="margin-right: 15px; margin-top: 45px !important;">
                                                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-5 c-grid__col--xs-gap">
                                                        <label for="productIsFake" class="uk-form-label">محدودیت در گروه کالایی:</label>
                                                        <div class="field-wrapper field-wrapper--justify field-wrapper--background">
                                                            <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto" id="productIsFakeLabel">
                                                                <input type="checkbox" class="c-ui-checkbox__origin" name="has_category_limit" id="productIsFake" value="1">
                                                                <span class="c-ui-checkbox__check"></span>
                                                                <span class="c-ui-checkbox__label">استفاده از کد تخفیف فقط برای دسته‌بندی مشخص قابل استفاده باشد</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>




                                                <div class="c-card__body c-card__body--content category-box" style="margin-top: 45px; display: none;">
                                                    <label for="" class="search-form__action-label">جستجو در میان
                                                        دسته‌ها</label>
                                                    <div class="search-form__autocomplete-container">
                                                        <div class="search-form__autocomplete js-autosuggest-box">
                                                            <input id="searchKeyword" class="c-content-input__origin js-prevent-submit" type="text" placeholder="دسته‌بندی مورد نظر خود را بنویسید، مثال: گوشی موبایل">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="c-card__body  c-card__body--content category-box" id="stepTitleContent" style="margin-top: -20px; display: none;">
                                                </div>
                                                <div class="c-card__body c-card__body--content category-box" style="display: none">
                                                    <!-- category a -->
                                                    <div id="categoriesContainer" class="c-content-categories">
                                                        
                                                        <div class="c-content-categories__container" id="categoriesContainerContent">
                                                            <div class="c-content-categories__wrapper js-category-column cat-box" id="cat-box" data-id="0">
                                                                <ul class="c-content-categories__list" style="list-style: none;">
                                                                    @foreach($categories->where('parent_id', 0) as $category)
                                                                        <li class="c-content-categories__item {{ (count($category->children) > 0) ? 'has-children' : '' }}">
                                                                            <label class="c-content-categories__link js-category-link">
                                                                                <input type="radio" name="category" value="{{ $category->id }}" class="js-category-data radio uk-hidden" data-id="{{ $category->id }}" data-theme="" style="visibility: hidden;">
                                                                                {{ $category->name }}
                                                                            </label>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="c-content-loader">
                                                            <div class="c-content-loader__logo"></div>
                                                            <div class="c-content-loader__spinner"></div>
                                                        </div>
                                                    </div>
                                                    <div id="breadcrumb" class="c-content-categories__summary">
                                                        <div class="c-content-categories__summary-breadcrumbs"
                                                             id="bread-box">
                                                            <span class="">دسته انتخابی شما:</span>
                                                            <ul class="js-selected-category c-content-categories__selected-list"
                                                                id="breadcrumbs">
                                                                <!-- ajax -->
                                                            </ul>
                                                        </div>

                                                        <div class="c-content-accordion__step-controls c-content-accordion__step-controls--category">
                                                            <button type="button" class="c-content-categories__search-reset reset-box" id="categoryReset">
                                                            </button>
                                                        </div>

                                                    </div>
                                                    <div id="error-cat" class="field-wrapper has-error"></div>
                                                </div>
                                                <div class="c-content-loader c-content-loader--fixed category-box">
                                                    <div class="c-content-loader__logo"></div>
                                                    <div class="c-content-loader__spinner"></div>
                                                </div>
                                        </div>
                                        </section>
                                    </div>
                                </div>
                                <div class="c-card__footer c-card__footer--products">
                                    <div class="c-grid__row">
                                        <div class="c-grid__col c-grid__col--flex-initial">
                                            <div class="c-content-error c-content-error--list hidden"
                                                 id="saveAjaxErrors">
                                            </div>
                                            <div class="uk-flex uk-flex-left" style="width: 96%;margin-top: 40px;margin-bottom: 20px;">
                                                <button class="c-ui-btn c-ui-btn--next mr-a" id="submit-form">
                                                    ایجاد کد تخفیف
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>
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

// اضافه کردن توکن به درخواست های ایجکس
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#voucher_form').on('submit', function (e) {
    e.preventDefault();

    var name = $("input[name='name']").val();
    var status = $("select[name='status']").val();
    var code = $("input[name='code']").val();
    var percent = $("input[name='percent']").val();
    var up_to = $("input[name='up_to']").val();
    var min_product_price = $("input[name='min_product_price']").val();
    var has_limit_time = $("input:checked[name='has_limit_time']").val();
    var start_at = $("input[name='start_at']").val();
    var end_at = $("input[name='end_at']").val();
    var has_max_usable = $("input:checked[name='has_max_usable']").val();
    var maximum_usable = $("input[name='maximum_usable']").val();
    var for_new_users = $("input:checked[name='for_new_users']").val();
    var has_freeـshipping = $("input:checked[name='has_freeـshipping']").val();
    var has_category_limit = $("input:checked[name='has_category_limit']").val();
    var selectedCategory = $("input:checked[type='radio']").val();


    $.ajax({
        method: "post",
        url: '{{route('staff.vouchers.store')}}',
        data: {
            name: name,
            status: status,
            code: code,
            percent: percent,
            up_to: up_to,
            min_product_price: min_product_price,
            has_limit_time: has_limit_time,
            start_at: start_at,
            end_at: end_at,
            has_max_usable: has_max_usable,
            maximum_usable: maximum_usable,
            for_new_users: for_new_users,
            has_freeـshipping: has_freeـshipping,
            has_category_limit: has_category_limit,
            category_id: selectedCategory,
        },
        success: function (response) {
            $('#voucher_form').trigger("reset");
            $(window).scrollTop(0);
            UIkit.notification({
                message: 'تغییرات شما ثبت گردید',
                status: 'success',
                pos: 'top-left',
                timeout: 3000
            });
            setTimeout(function(){
                window.location.href = "{{ route('staff.vouchers.index') }}";
            }, 2000);
        },
        error: function (errors) {
            Promotion.displayError(errors.responseJSON.data.errors);
        }
    });

});


$(document).on('change', "input[name='has_limit_time']", function (){
    if ($(this).is(":checked")) {
        $(".time-input").removeAttr('disabled');
        $(".time-input").removeClass('disabled');
        $(".time-input").removeClass('c-ui-input--disabled');
    } else {
        $(".time-input").attr('disabled', true);
        $(".time-input").addClass('disabled');
        $(".time-input").addClass('c-ui-input--disabled');
        $(".time-input").val('');
        $(".start_at_hidden").val('');
        $(".end_at_hidden").val('');
    }
});

$(document).on('change', "input[name='has_max_usable']", function (){
    if ($(this).is(":checked")) {
        $(".maximum_usable").removeAttr('disabled');
        $(".maximum_usable").removeClass('disabled');
        $(".maximum_usable").removeClass('c-ui-input--disabled');
    } else {
        $(".maximum_usable").attr('disabled', true);
        $(".maximum_usable").addClass('disabled');
        $(".maximum_usable").addClass('c-ui-input--disabled');
        $(".maximum_usable").val('');
    }
});

$(document).on('change', "input[name='has_category_limit']", function (){
    if ($(this).is(":checked")) {
        $(".category-box").each(function (){
            $(this).show();
        });
    } else {
        $(".category-box").each(function (){
            $(this).hide();
        });
    }
});

// تغییر پدینگ فیلد نامک
$(function () {
    var buttonWidth = $('#button-urls').width() + 65;
    $(".url-inputs").css({
        'padding-left': buttonWidth,
    });
});


$(document).ready(function (){
    $(document).on('click',".button-urls" , function () {
        var rand_voucher = generateCode(5);
        $(".url-inputs").val(rand_voucher);
    });
});


function generateCode(length) {
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    var generated = [];
    var text = "";

    for (var i = 0; i < length; i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    return text;
}

// ایجکس دسته‌ها
$(document).on('change', "input[name='category']", function (e) {

    $(this).closest("div").nextAll().remove();
    $(this).closest(".c-content-categories__list").find('li').removeClass('is-active');
    $(this).closest("li").addClass("is-active");

    var categorySelected = $("input[name='category']:checked").val();

    $.ajax({
        method: "POST",
        url: '{{route('staff.categories.childCatsLoader')}}',
        data: {
            id: categorySelected,
        },
        success: function (response) {
            $('.c-content-categories__container').append(response);
        },
    });


});

// ایجکس breadcrumb
$(document).on('change', "input[type='radio']", function (e) {

    var bread_id = $("input[type='radio']:checked").val();

    $.ajax({
        method: "POST",
        url: '{{route('staff.categories.breadcrumbLoader')}}',
        data: {
            id: bread_id,
        },
        success: function (response) {
            $('#breadcrumbs').replaceWith(response);
        },
    });

});

// ایجکس سرچ دسته‌بندی
$('#searchKeyword').on('keyup', function () {

    var searchValue = $(this).val();

    if (searchValue.length > 2) {
        $.ajax({
            type: 'post',
            url: '{{route('staff.categories.ajaxsearch')}}',
            data: {
                'search': searchValue
            },
            success: function (response) {
                $(".c-content-categories__wrapper").each(function () {
                    $(this).remove();
                });
                $('.c-content-categories__container').append(response);
            }
        });
    }

    if (searchValue.length == 0) {
        $.ajax({
            type: 'post',
            url: '{{route('staff.categories.mainCatLoader')}}',
            success: function (response) {
                $('.c-content-categories__wrapper').replaceWith(response);
            }
        });
    }
});

// ریست کامل لیست دسته‌بندی‌ها
$(document).on('click', ".reset-box", function (e) {
    $.ajax({
        type: 'post',
        url: '{{route('staff.categories.mainCatLoader')}}',
        success: function (response) {
            $('.c-content-categories__wrapper').replaceWith(response);
        }
    });
    $(".category-box").show();
    $(".appended-box").each(function () {
        $(this).remove();
    });

});

</script>
@endsection
