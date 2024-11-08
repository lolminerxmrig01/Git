@extends('layouts.staff.master')
@section('title') گزینه‌های امتیازدهی | {{ $fa_store_name }}  @endsection
@section('head')
<script src="{{ asset('mehdi/staff/js/tags.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/dragsort') }}"></script>
<link rel="stylesheet" href="{{ asset('mehdi/staff/css/dragsort.css') }}"
    media="print" onload="this.media='all'">
@endsection

@section('content')
<main class="c-content-layout">
    <div class="uk-container uk-container-large">
        <div class="c-grid" data-select2-id="137">
            <div class="c-content-page c-content-page--plain c-grid__row">
                <div class="c-grid__col">
                    <div class="c-content-page__header">
                        <span class="c-content-page__header-action">مدیریت گزینه‌های امتیازدهی</span>
                        <span
                            class="c-content-page__header-desc">از این صفحه می‌توانید گزینه‌های امتیازدهی کالا ها را مدیریت، ویرایش و حذف کنید</span>
                    </div>
                </div>
            </div>
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <div class="c-card" data-select2-id="136">
                        <form id="category_form">
                            <div class="c-grid__col">
                                <div class="product-form">
                                    <div class="c-content-accordion js-accordion uk-accordion">
                                        <section class="c-content-accordion__row js-content-section uk-open"
                                                 id="stepCategoryAccordion">
                                            <h2 style="font-size: 18px;margin-right: 33px;margin-top: -8px;">
                                                <div style="color: #606265;">
                                                    مدیریت گزینه‌های امتیازدهی
                                                </div>
                                            </h2>
                                            <div style="width: 100%;margin: -7px 0px 20px 0px !important;padding: 0px !important;
                                                background: #e2dddd;height: 1px;">
                                            </div>
                                            <div class="c-content-accordion__content c-content-accordion__content--small"
                                                id="stepTitleContainer" aria-hidden="false" style=" margin-right: -25px;">
                                                <div class="c-card__body c-card__body--content category-box">
                                                    <label for="" class="search-form__action-label">جستجو در میان
                                                        دسته‌ها</label>
                                                    <div class="search-form__autocomplete-container">
                                                        <div class="search-form__autocomplete js-autosuggest-box">
                                                            <input name="search" id="searchKeyword"
                                                                   class="c-content-input__origin js-prevent-submit"
                                                                   type="text" placeholder="دسته مورد نظرتان را جستجو کنید">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="c-card__body  c-card__body--content category-box"
                                                     id="stepTitleContent" style="margin-top: -20px;">
                                                </div>
                                                <div class="c-card__body c-card__body--content category-box">
                                                    <!-- category a -->
                                                    <div id="categoriesContainer" class="c-content-categories">
                                                        <div class="c-content-categories__container"
                                                             id="categoriesContainerContent">
                                                            <div class="c-content-categories__wrapper js-category-column cat-box" id="cat-box">
                                                                <ul class="c-content-categories__list" style="list-style: none;">
                                                                    @foreach($categories->where('parent_id', 0) as $category)
                                                                        <li class="c-content-categories__item {{ (count($category->children) > 0) ? 'has-children' : '' }}">
                                                                            <label
                                                                                class="c-content-categories__link js-category-link">
                                                                                <input type="radio" name="category"
                                                                                       value="{{ $category->id }}"
                                                                                       class="js-category-data radio uk-hidden"
                                                                                       data-id="{{ $category->id }}"
                                                                                       data-theme=""
                                                                                       style="visibility: hidden;">
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
                                                        <div
                                                            class="c-content-accordion__step-controls c-content-accordion__step-controls--category">
                                                            <a class="c-ui-btn c-ui-btn--next mr-a js-continue-btn disabled"
                                                               id="categoryStepNext" disabled="true">
                                                                انتخاب دسته
                                                            </a>
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

                                                <div class="editable-section">
                                                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial
                                                     c-grid__col--sm-6 edit-form-section">

                                                        <div class="field-wrapper" style="margin-right: 15px;">
                                                            <label for="type-field" class="uk-form-label" style="margin-right: 10px; margin-top: 30px;">
                                                                افزودن گزینه
                                                            </label>
                                                            <input type="text" class="c-content-input__origin js-attribute-old-value" id="type-field"
                                                                name="type-field" style="width: 61%;margin-right: 10px;float: right;">

                                                            <a class="c-ui-btn c-ui-btn--next mr-a js-continue-btn create-field "
                                                                style="margin-right: 10px;">ایجاد گزینه</a>

                                                        </div>
                                                        <div>
                                                        </div>
                                                    </div>

                                                    <label class="uk-form-label edit-form-section" 
                                                        style="margin-bottom: 15px;margin-top: 40px;margin-right: 40px;">لیست گزینه‌ها:</label>

                                                    <div id="dragable_section" class="ui-sortable">
                                                        <div class="fields-box edit-form-section connectedSortable"
                                                         id="sortable1" style="margin-top: 30px;">
                                                            <!-- append -->
                                                        </div>
                                                    </div>

                                                    <div class="deleted-fields"></div>

                                                    <div uk-modal="esc-close: true; bg-close: true;" 
                                                        class="uk-modal-container uk-modal-container--message js-common-modal-notification uk-modal" 
                                                        style="display: none;">
                                                        <div class="uk-modal-dialog uk-modal-dialog--flex">
                                                            <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""></button>

                                                            <div class="uk-modal-body">
                                                                <div class="c-modal-notification">
                                                                    <div class="c-modal-notification__content c-modal-notification__content--limited">
                                                                        <h2 class="c-modal-notification__header">هشدار</h2>

                                                                        <p class="c-modal-notification__text">
                                                                            با حذف گزینه مورد نظر ، این گزینه از نمودار امتیازدهی محصولات 
                                                                            دسته انتخابی به صورت کامل حذف شده و قابل بازیابی نمی‌باشد.
                                                                             آیا از حذف کامل آن اطمینان دارید؟
                                                                        </p>
                                                                        <div class="c-modal-notification__actions">
                                                                            <button class="c-modal-notification__btn no uk-modal-close">خیر</button>
                                                                            <button class="c-modal-notification__btn c-modal-notification__btn--secondary yes uk-modal-close">بله</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <input name="selected-cat" hidden>
                                    <div class="edit-form-section c-card__footer c-card__footer--products">
                                        <div class="c-grid__row">
                                            <div class="c-grid__col c-grid__col--flex-initial">
                                                <div class="uk-flex uk-flex-right" style="width: 97%;">
                                                    <a class="c-ui-btn c-ui-btn--next mr-a"
                                                            style="margin-right: 13px;" id="submit-form">ذخیره
                                                    </a>
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
</main>
@endsection

@section('script')
<script>

$(".edit-form-section").hide();

// اضافه کردن توکن به درخواست های ایجکس
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// ایجکس فرم اصلی
$('#submit-form').on('click', function (e) {
    // e.preventDefault();

    var type_fields = [];
    type_fields.length = 0;
    $("input[name='type_field']").each(function(i, element) {
        var id = $(element).val();
        var i = $(element).data('id');
        type_fields[i] = id;
    });

    var database_data = [];
    database_data.length = 0;
    $("input[name='database_data']").each(function(i, element) {
        var id = $(element).val();
        var i = $(element).data('id');
        database_data[i] = id;
    });

    var sort_data = $("#sortable1").sortable('serialize');

    var category_id = $("input[name='selected-cat']").val();;

    $.ajax({
        method: "post",
        url: '{{route('staff.ratings.store')}}',
        data: {
            sort_data: sort_data,
            category: category_id,
            type_fields: type_fields,
            database_data: database_data,
        },
        success: function () {
            window.location.href = "{{ route('staff.ratings.index') }}";
        },
    });

});

// ایجکس دسته‌ها
$(document).on('change', "input[name='category']", function (e) {

    $(this).closest("div").nextAll().remove();
    $(this).closest(".c-content-categories__list").find('li').removeClass('is-active');
    $(this).closest("li").addClass("is-active");

    var categorySelected = $("input[name='category']:checked").val();

    $.ajax({
        method: "POST",
        url: '{{route('staff.ratings.childCatsLoader')}}',
        data: {
            id: categorySelected,
        },
        success: function (response) {
            $('#categoriesContainerContent').append(response);
        },
    });

});

// ایجکس breadcrumb
$(document).on('change', "input[type='radio']", function (e) {

    var bread_id = $("input[type='radio']:checked").val();

    $.ajax({
        method: "POST",
        url: '{{route('staff.ratings.breadcrumbLoader')}}',
        data: {
            id: bread_id,
        },
        success: function (response) {
            $('#breadcrumbs').replaceWith(response);
        },
    });

    if ($("input[type='radio']:checked").closest('li').hasClass('has-children')){
        $(".js-continue-btn").attr("disabled", true);
        $(".js-continue-btn").addClass('disabled');
    } else {
        $(".js-continue-btn").attr("disabled", false);
        $(".js-continue-btn").removeClass('disabled');
    }

});

$('#searchKeyword').on('keyup', function () {

    var searchValue = $(this).val();

    if (searchValue.length > 2) {
        $.ajax({
            type: 'post',
            url: '{{route('staff.ratings.ajaxsearch')}}',
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
            url: '{{route('staff.ratings.mainCatLoader')}}',
            success: function (response) {
                $('.c-content-categories__wrapper').replaceWith(response);
            }
        });
    }

});

$(document).on('click', ".reset-box", function (e) {

    $.ajax({
        type: 'post',
        url: '{{route('staff.ratings.mainCatLoader')}}',
        success: function (response) {
            $('.c-content-categories__wrapper').replaceWith(response);
        }
    });

   $("#categoryStepNext").addClass('disabled');
   $(".edit-form-section").hide();
   $(".appended-box").each(function () {
       $(this).remove();
   });

});

$(document).on('click', "#categoryStepNext", function (e) {

    if (!$(".js-continue-btn").hasClass('disabled'))
    {
        $(".type-field-box").each(function () {
            $(this).remove();
        });

        var category_id = $("input[type='radio']:checked").val();

        $.ajax({
            method: "post",
            url: '{{route('staff.ratings.getData')}}',
            data: {
                category_id: category_id,
            },
            success: function (result) {
                // $(".ajax-append").replaceWith(result);
                $(".fields-box").append(result);
                var selected_cat = $("input:checked[type='radio']").val();
                $("input[name='selected-cat']").val(selected_cat);
            },
        });

        $(".edit-form-section").show(100);
    }

});

$(".create-field").on('click', function (){

    var type_field = $("#type-field").val();
    var new_id = Math.floor((Math.random() * 100) + 900);

    var field = '<div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr type-field-box appended-box" id="item-' + new_id + '">';
    field += '<div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer ui-sortable-handle" style="margin-right: 0px;"> <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up ui-sortable-handle" style="margin-top: -23px;"></span> <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg ui-sortable-handle" style="padding-top: 2px;padding-bottom: 2px;"></span> <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down ui-sortable-handle"></span></div>';
    field += '<div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">';
    field += '<div class="field-wrapper"><input type="text" data-id="' + new_id + '" value="' + type_field + '" class="c-content-input__origin c-ui-input--deactive js-suggested-title-fa js-edit-mode-suggested-title-fa type_field" name="type_field" style="margin-left: 10px;" disabled>';
    field +='<a class="c-ui-btn c-ui-btn--outline-blue edit-field-btn">ویرایش گزینه</a><a type="button" class="c-content-categories__search-reset remove-field-btn" style="min-height: 39px !important;height: 39px;"></a></div></div></div>';

    if(type_field.length > 1){
        $(".fields-box").append(field);
        $("#type-field").val('');
    }

});

$(document).on('click', '.remove-field-btn', function () {

    $(".uk-modal-container").addClass('uk-open');
    $(".uk-modal-container").css('display', 'block');
    $(this).closest('.c-grid__row').addClass('selected-group');
    $('.c-header__nav').hide();

    $(document).on('click', '.yes', function (){
        $(".remove-field-btn").closest('.selected-group').find('input').val('deleted');
        $(".remove-field-btn").closest('.selected-group').hide();
        $('.c-header__nav').show();
    });

    $(document).on('click', '.uk-modal-close-default', function (){
        $('.c-header__nav').show();
    });

    $(document).on('click', '.no', function (){
        $('.c-header__nav').show();
        $(document).removeClass('selected-group');
        $(".c-grid__row").each(function () {
            $(this).removeClass('selected-group');
        });
    });

});

$(document).on('click', '.uk-modal-close-default', function (){
    $(document).removeClass('selected-group');
    $(".c-grid__row").each(function () {
        $(this).removeClass('selected-group');
    });
});

$(document).on('click', '.edit-field-btn', function () {

    var input_val = $(this).closest('.field-wrapper').find('input').val();
    $(this).closest('.field-wrapper').find('input').attr('data-old', input_val);
    $(this).closest('.field-wrapper').find('input').removeAttr('disabled');
    $(this).closest('.field-wrapper').find('input').removeClass('c-ui-input--deactive');

    var chenge_btn = '<button class="c-ui-btn c-ui-btn--outline-blue confirm-btn ok-btn">تایید</button>' +
        '<button class="c-ui-btn c-ui-btn--outline-blue cancell-btn black-btn">لغو</button>';

    $(this).closest('.field-wrapper').find('.edit-field-btn').replaceWith(chenge_btn);

});

$(document).on('click', '.confirm-btn', function (){
    $(this).closest('.field-wrapper').find('input').attr('disabled', true);
    $(this).closest('.field-wrapper').find('input').addClass('c-ui-input--deactive');


    var chenge_btn = '<a class="c-ui-btn c-ui-btn--outline-blue edit-field-btn">ویرایش گزینه</a>';
    $(this).closest('.field-wrapper').find(".cancell-btn").remove();
    $(this).closest('.field-wrapper').find(".confirm-btn").replaceWith(chenge_btn);
});

$(document).on('click', '.cancell-btn', function (){

    $(this).closest('.field-wrapper').find('input').attr('disabled', true);
    $(this).closest('.field-wrapper').find('input').addClass('c-ui-input--deactive');

    var confirm_btn_val = $(this).closest('.field-wrapper').find('input').attr('data-old');
    $(this).closest('.field-wrapper').find('input').val(confirm_btn_val);

    var chenge_btn = '<a class="c-ui-btn c-ui-btn--outline-blue edit-field-btn">ویرایش گزینه</a>';
    $(this).closest('.field-wrapper').find(".confirm-btn").replaceWith(chenge_btn);
    $(this).remove();

});

$("#sortable1").sortable({
    connectWith: ".connectedSortable",
});

</script>
@endsection
