@extends('layouts.staff.master')

@section('head')
    <script src="{{ asset('mehdi/staff/js/edit-brand-validation.js') }}"></script>
    <script src="{{ asset('mehdi/staff/js/tags.js') }}"></script>
    <style>
        .hide-div{
            display: none;
        }
    </style>
@endsection

@section('content')

<?php
    $brand->name = persianNum($brand->name);
?>

<main class="c-content-layout">
    <div class="uk-container uk-container-large">
        <div class="c-grid" data-select2-id="137">
            <div class="c-content-page c-content-page--plain c-grid__row">
                <div class="c-grid__col">
                    <div class="c-content-page__header">
                        <span class="c-content-page__header-action">  ویرایش برند {{ $brand->name }}  </span>
                        <span class="c-content-page__header-desc"> از این صفحه می‌توانید برند  {{ $brand->name }} را ویرایش کنید</span>
                    </div>
                </div>
            </div>
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <div class="c-card" data-select2-id="136">
                        <form id="brand_form">
                            <div class="c-grid__row">
                                <div class="c-grid__col">
                                    <div class="product-form">
                                        <div class="c-content-accordion js-accordion uk-accordion">
                                            <section id="top-fields" class="c-content-accordion__row js-content-section uk-open"
                                                     id="stepCategoryAccordion">
                                                <h2 style="
                          font-size: 18px;
                          margin-right: 33px;
                          margin-top: -8px;
                          ">
                                                    <div style="
                            color: #606265;
                            ">
                                                        ویرایش برند {{ $brand->name }}
                                                    </div>
                                                </h2>

                                                <div style="width: 100%;margin: -7px 0px 50px 0px !important;padding: 0px !important;background: #e2dddd;height: 1px;"></div>
                                                <div class="c-content-accordion__content c-content-accordion__content--small"
                                                    id="stepTitleContainer" aria-hidden="false" style="
                          margin-right: -25px;
                          ">

                                                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr"
                                                        style="
                            margin: 0 0 0 0;
                            width: 100%;
                            ">
                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr
                                                        c-grid__col--flex-initial c-grid__col--sm-6">
                                                            <label class="uk-form-label uk-flex uk-flex-between">
                                                                نام برند
                                                                <span class="uk-form-label__required"></span>
                                                            </label>
                                                            <div class="field-wrapper">
                                                                <input type="text" class="c-content-input__origin js-attribute-old-value"
                                                                       name="name" value="{{ old('name')?? $brand->name }}">
                                                            </div>
                                                            <div>
                                                            </div>
                                                        </div>
                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial
                              c-grid__col--sm-6">
                                                            <label class="uk-form-label uk-flex uk-flex-between">
                                                                نام انگلیسی
                                                              <span class="uk-form-label__required"></span>
                                                            </label>
                                                            <div class="field-wrapper">
                                                                <input type="text"
                                                                       class="c-content-input__origin js-attribute-old-value"
                                                                       name="en_name"  value="{{ old('en_name')?? $brand->en_name }}">
                                                            </div>
                                                            <div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="c-grid__row c-grid__row--gap-lg"
                                                         style="margin-right: 0px; width: 100%; margin-bottom: 40px;">
                                                        <div
                                                            class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                                            <label for="" class="uk-form-label">
                                                                شرح برند:
                                                            </label>
                                                            <div class="field-wrapper field-wrapper--textarea">
                                                                <textarea name="description"
                                                                          placeholder="توضیحات برند بهتر است بین ۷۰ تا ۱۰۰ کلمه درباره‌ی تاریخچه و محصولات برند باشد …"
                                                                          class="c-content-input__origin c-content-input__origin--textarea js-textarea-words"
                                                                          rows="" maxlength="500">{{ old('description')?? $brand->description }}</textarea>
                                                                <span class="textarea__wordcount">
                                            <span class="js-wordcount-target">0</span>/500
                                        </span>
                                                            </div>
                                                        </div>
                                                    </div>

{{--                                                    <div--}}
{{--                                                        class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-4 c-grid__col--xs-gap"--}}
{{--                                                        style="margin-top: 15px;margin-bottom: 15px;">--}}

{{--                                                        <label for="" class="search-form__action-label">نوع--}}
{{--                                                            برند</label>--}}

{{--                                                        <div--}}
{{--                                                            class="field-wrapper field-wrapper--justify field-wrapper--background"--}}
{{--                                                            style="--}}
{{--                              width: 201px;--}}
{{--                              ">--}}
{{--                                                            <label--}}
{{--                                                                class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto"--}}
{{--                                                                id="type" class="type">--}}
{{--                                                                <input type="checkbox" class="c-ui-checkbox__origin"--}}
{{--                                                                       name="type" id="type" class="type"--}}
{{--                                                                       data-status="0" {{ old('type') == 1 ? 'checked' : ($brand->type == 1 ? 'checked' : '')  }}>--}}
{{--                                                                <span class="c-ui-checkbox__check"></span>--}}
{{--                                                                <span class="c-ui-checkbox__label">ویژه</span>--}}
{{--                                                                <div class="c-wiki c-wiki__holder">--}}
{{--                                  <span class="c-wiki-sign js-tooltip"--}}
{{--                                        data-tooltip="اگر قصد دارید نوع این برند، ویژه شود این گزینه را انتخاب کنید"></span>--}}
{{--                                                                </div>--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

                                                    <div
                                                        class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                                        <label class="uk-form-label uk-flex uk-flex-between">
                                                            نامک
                                                            <span class="uk-form-label__required"></span>
                                                        </label>
                                                        <div class="field-wrapper">
                                                            <input type="text"
                                                                   class="c-content-input__origin js-attribute-old-value url-inputs"
                                                                   name="slug" dir="ltr"  value="{{ old('slug')?? $brand->slug }}">
                                                            <input type="button" id="button-urls"
                                                                   style="width: auto;"
                                                                   class="c-ui-tag__submit js-tag-submit-btn button-urls"
                                                                   value="/{{ config('app.url') }}/brand" disabled>
                                                        </div>
                                                        <div>
                                                        </div>
                                                    </div>

                                                    <div class="c-card__body c-card__body--content category-box">
                                                        <label for="" class="search-form__action-label">گروه کالایی
                                                            فعال در برندتان را انتخاب کنید</label>
                                                    </div>

                                                    <div class="c-card__body  c-card__body--content category-box"
                                                         id="stepTitleContent" style="margin-top: -20px;">
                                                    </div>
                                                    <div class="c-card__body c-card__body--content category-box">
                                                        <!-- category a -->
                                                        <div id="categoriesContainer" class="c-content-categories">
                                                            <div class="c-content-categories__container"
                                                                 id="categoriesContainerContent">
                                                                <div
                                                                    class="c-content-categories__wrapper js-category-column cat-box">
                                                                    <ul class="c-content-categories__list">
                                                                        @foreach($categories->where('parent_id', 0) as $category)
                                                                            <li class="c-content-categories__item">
                                                                                <label
                                                                                    data-cat-id="{{ $category->id }}"
                                                                                    class="c-content-categories__link js-category-link">
                                                                                    <input type="radio"
                                                                                           name="category"
                                                                                           value="{{ $category->id }}"
                                                                                           class="js-category-data radio"
                                                                                           data-cat-id="{{ $category->id }}"
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
                                                        <div class="c-content-categories__summary">
                                                            <div class="c-content-categories__summary-breadcrumbs">
                                                                <span class="">دسته‌های انتخابی شما:</span>
                                                                <ul class="js-selected-category c-content-categories__selected-list"
                                                                    id="breadcrumbs">
                                                                    <!-- ajax -->
                                                                    @foreach($brand->categories as $category)
                                                                        <li class="select2-selection__choice" data-cat-id="{{ $category->id }}" style="background: #889098;
                                                                        color: #ffffff;height: 25px;border-radius: 33px;font-size: 12px;
                                                                        padding: 5px 11px 0px 11px;margin-left: 5px;">
                                                                            <span class="select2-selection__choice__remove" role="presentation">{{ $category->name }}</span>
                                                                            <a class="select2-selection__choice__remove remove-breadcrumb" data-cat-id="{{ $category->id }}"
                                                                               role="presentation" style="margin-right: 5px; font-weight: bold; padding-right: 2px;
                                                                                color: white;">×</a>
                                                                        </li>
                                                                    @endforeach

                                                                </ul>
                                                            </div>

                                                            <div
                                                                class="c-content-accordion__step-controls c-content-accordion__step-controls--category">
                                                                <a class="c-ui-btn c-ui-btn--next mr-a disabled js-continue-btn"
                                                                   id="categoryStepNext">
                                                                    انتخاب دسته
                                                                </a>
                                                                {{--                                        <button type="button" class="c-content-categories__search-reset reset-box" id="categoryReset">--}}
                                                                {{--                                        </button>--}}
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div
                                                        class="c-content-loader c-content-loader--fixed category-box">
                                                        <div class="c-content-loader__logo"></div>
                                                        <div class="c-content-loader__spinner"></div>
                                                    </div>
                                                </div>

                                                @foreach($brand->categories as $category)
                                                    <input type="text" name="category_group" class="category_group"
                                                           value="{{ $category->id }}"  style="visibility: hidden">
                                                @endforeach

                                            </section>


                                            <section id="stepImagesAccordion">
                                                <div
                                                    class="c-content-accordion__content c-content-accordion__content--last"
                                                    id="stepImagesContainer" aria-hidden="false" style="
                        margin-right: -25px; display: block !important;
                        ">
                                                    <div
                                                        class="c-card__body c-card__body--content marketplace-redesign"
                                                        id="stepImagesContent">
                                                        <div id="imagesSelfServiceContainer"
                                                             class="c-grid__row c-grid__row--gap-lg">
                                                            <div class="c-grid__col">
                                                                <fieldset class="c-content-upload">
                                                                    <legend class="c-content-upload__title">برای
                                                                        برند
                                                                        لوگو انتخاب کنید
                                                                    </legend>
                                                                    <div id="image-container">
                                                                        <label class="c-content-upload__trigger"
                                                                               id="uploadGalleryContainer">
                                                                            <div uk-form-custom=""
                                                                                 class="uk-form-custom">
                                                                                <input name="image" type="file"
                                                                                       id="uploadImage"
                                                                                       accept="image/*"
                                                                                       onchange="loadFile(event)">
                                                                            </div>
                                                                            <span class="c-content-upload__ui-btn">بارگذاری تصویر</span>
                                                                            <ul class="c-content-upload__list c-content-upload__list--tooltips">
                                                                                <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                                                                    تصویر شما بهتر است مربعی باشد یا
                                                                                    ابعاد
                                                                                    یک در یک داشته باشد
                                                                                </li>
                                                                                <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                                                                    فرمت تصاویر بایستی JPG باشد
                                                                                </li>
                                                                                <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                                                                    حداکثر حجم فایل 2 مگابایت باشد
                                                                                </li>
                                                                                <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                                                                    حداقل ابعاد عکس 125 * 125 پیکسل
                                                                                    باشد
                                                                                </li>
                                                                            </ul>
                                                                        </label>
                                                                        <div id="imagesLoadingSection"
                                                                             class="c-content-upload__uploads loading js-uploading-section hidden">
                                                                            <h3 class="product-form__section-title product-form__section-title--gap">
                                                                                تصاویر درحال بارگذاری
                                                                            </h3>
                                                                            <ul id="imagesUploadList"
                                                                                class="c-content-upload__gallery-list"></ul>
                                                                        </div>
                                                                        <div
                                                                            class="c-content-upload__error-container hidden"
                                                                            id="ajaxErrorImages">
                                                                            <div class="c-content-upload__error">
                                                                                <div class="hidden"
                                                                                     id="imageErrorsContainer"></div>
                                                                                <div
                                                                                    class="hidden c-content-upload__error-msg"
                                                                                    id="mainImageErrorContainer">
                                                                                    می‌توانید با استفاده از
                                                                                    کلید<i></i> تصویر مورد نظرتان را
                                                                                    به
                                                                                    عنوان تصویر اصلی کالا انتخاب
                                                                                    کنید.
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div id="imagesSection" class="c-content-upload__uploads js-uploaded-section imagesSection2 {{ ($brand->media)?: 'hide-div' }}"
                                                                        >
                                                                            <h3 class="product-form__section-title product-form__section-title--gap">
                                                                                تصویر بارگذاری شده
                                                                            </h3>

                                                                            <ul id="imagesContainer" class="c-content-upload__gallery-list js-uploaded-list js-sortable-list uk-sortable">
                                                                                <li class="c-content-upload__gallery-row js-uploads-row li-error" id="1dsWB">
                                                                                    <div class="c-content-upload__img-container">
                                                                                        @if(count($brand->media))
                                                                                        <img name="uploaded" id="preview_uploading" src="{{ $site_url . '/' . $brand->media()->first()->path . '/'.$brand->media()->first()->name }}"
                                                                                             data-id="{{ ($brand->media()->first()->id)? $brand->media()->first()->id : 0 }}" class="c-content-upload__img js-upload-thumb upload-image">
                                                                                        @else
                                                                                            <img name="uploaded" id="preview_uploading" src=""
                                                                                                 data-id="0" class="c-content-upload__img js-upload-thumb upload-image" hidden>
                                                                                        @endif
                                                                                        <div class="c-content-upload__img-loader" style="display: none;">
                                                                                            <div class="progress__wrapper">
                                                                                                <span class="progress"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="c-content-upload__img-error"></div>
                                                                                    </div>

                                                                                    <div class="c-content-upload__mid-container">
                                                                                        <div class="c-content-upload__mid-container c-content-upload__mid-container--top">
                                                                                            <div class="c-content-upload__desc">
                                                                                                <div class="c-content-upload__desc--top">
                                                                                                    <div class="right">
                                                                                                        <div class="c-content-upload__name js-upload-name">
{{--                                                                                                            @if($brand->media)--}}
{{--                                                                                                                {{ $brand->media->name }}--}}
{{--                                                                                                            @endif--}}
                                                                                                        </div>
                                                                                                        <div class="c-content-upload__size js-upload-size"></div>
                                                                                                    </div>
                                                                                                    <div class="c-content-upload__select"></div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <ul class="c-content-upload__list c-content-upload__list--errors js-upload-error-list">
                                                                                                <li class="error-image"></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="c-content-upload__controls">
                                                                                        <button type="button" class="c-content-upload__btn c-content-upload__btn--remove js-remove-upload"></button>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>

                                                                    </div>


                                                            </div>

                                                        </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <span></span>
                                        </div>
                                    </div>
                                    <ul id="uploadingTemplate" class="hidden">
                                        <li class="c-content-upload__gallery-row js-uploads-row">
                                            <input type="hidden" class="js-image-id-input">
                                            <div class="c-content-upload__img-container">
                                                <img src="" alt=""
                                                     class="c-content-upload__img js-upload-thumb">
                                                <div class="c-content-upload__img-loader">
                                                    <div class="progress__wrapper">
                                                        <span class="progress"></span>
                                                    </div>
                                                </div>
                                                <div class="c-content-upload__img-error"></div>
                                            </div>
                                            <div class="c-content-upload__mid-container">
                                                <div
                                                    class="c-content-upload__mid-container c-content-upload__mid-container--top">
                                                    <div class="c-content-upload__desc">
                                                        <div class="c-content-upload__desc--top">
                                                            <div class="right">
                                                                <div
                                                                    class="c-content-upload__name js-upload-name"></div>
                                                                <div
                                                                    class="c-content-upload__size js-upload-size"></div>
                                                            </div>
                                                            <div class="c-content-upload__select">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="c-content-upload__list c-content-upload__list--errors js-upload-error-list"></ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    </section>
                                </div>

                                <div class="c-card__footer c-card__footer--products">
                                    <div class="c-grid__row">
                                        <div class="c-grid__col c-grid__col--flex-initial">
                                            <div class="c-content-error c-content-error--list hidden"
                                                 id="saveAjaxErrors">
                                            </div>
                                            <div class="uk-flex uk-flex-left">
                                                <button class="c-ui-btn c-ui-btn--next mr-a submit-form-cu"
                                                        id="submit-form">ویراش برند
                                                </button>
                                            </div>
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
</main>

@endsection

@section('script')
<script src="{{ asset('mehdi/staff/js/brands.js') }}"></script>

{{--<script>--}}
{{--    $(".imagesSection2").show();--}}
{{--</script>--}}

<script>

// // اضافه کردن توکن به درخواست های ایجکس
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// ایجکس آپلود عکس
$(document).on("change", "#uploadImage", function () {
    $("#imagesSection").show();
    $(".li-error").removeClass('has-error');
    $(".error-image").html('');


    var form_data = new FormData();
    var input_image = $("#uploadImage").prop("files")[0];

    form_data.append("image", input_image);

    var old_img = $("img[name='uploaded']").attr('data-id');

    if (old_img) {
        form_data.append("old_img", old_img);
    }

    $.ajax({
        url: '{{route('staff.brands.uploadUpdate')}}',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            $("#imagesSection").replaceWith(data);
            $(".c-content-upload__title").find('.error-text').remove();
        },
        error: function (data) {
            $(".li-error").addClass('has-error');
            $(".error-image").html('تصویری که انتخاب کرید شرایط لازم را ندارد');
        }
    });

});

//  حذف عکس
$(document).on("click", ".js-remove-upload", function () {
    $("#imagesSection").hide();
});

// ایجکس فرم اصلی
$('#brand_form').on('submit', function (e) {
    e.preventDefault();
    // Collect the new orderings
    var categories = [];
    categories.length = 0;
    $("input[name='category_group']").each(function (i, element) {
        var id = $(element).attr('value');
        var i = i;
        categories[i] = id;
    });

    var name = $("input[name='name']").val();
    var en_name = $("input[name='en_name']").val();
    var description = $("textarea[name='description']").val();
    var type = $("input[name='type']").attr('data-status');
    var slug = $("input[name='slug']").val();
    var image = $('#preview_uploading').attr('data-id');

    // if (name && en_name && slug && image && (image !== '0') )
    // {
    $.ajax({
        method: "POST",
        url: '{{ route('staff.brands.update') }}',
        data: {
            name: name,
            en_name: en_name,
            description: description,
            type: type,
            slug: slug,
            image: image,
            categories: categories,
            id: {{ $brand->id }},

        },
        success: function () {
            window.location.href = "{{ route('staff.brands.index') }}";
        },
        error: function ()
        {
            //
        }
    });
    // }

});

</script>
@endsection
