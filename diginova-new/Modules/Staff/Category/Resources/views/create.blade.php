@extends('layouts.staff.master')

@section('title') ایجاد دسته‌بندی | {{ $fa_store_name }}  @endsection
@section('head')
  <script src="{{ asset('mehdi/staff/js/create-category-validation.js') }}"></script>
  <script src="{{ asset('mehdi/staff/js/tags.js') }}"></script>
@endsection

@section('content')
  <main class="c-content-layout">
      <div class="uk-container uk-container-large">
          <div class="c-grid">
              <div class="c-content-page c-content-page--plain c-grid__row">
                  <div class="c-grid__col">
                      <div class="c-content-page__header">
                          <span class="c-content-page__header-action">ایجاد دسته‌بندی</span>
                          <span
                              class="c-content-page__header-desc">برای محصولات فروشگاه دسته و زیر دسته ایجاد کنید</span>
                      </div>
                  </div>
              </div>
              <div class="c-grid__row">
                  <div class="c-grid__col">
                      <div class="c-card">
                          <form id="category_form">
                              <div class="c-grid__col">
                                  <div class="product-form">
                                      <div class="c-content-accordion js-accordion uk-accordion">
                                          <section class="c-content-accordion__row js-content-section uk-open"
                                                   id="stepCategoryAccordion">
                                              <h2 style="font-size: 18px; margin-right: 33px; margin-top: -8px;">
                                                  <div style="color: #606265;">ایجاد دسته‌بندی</div>
                                              </h2>

                                              <div style="width: 100%;margin: -7px 0px 50px 0px !important;padding: 0px !important;background: #e2dddd;height: 1px;"></div>

                                              <div class="c-content-accordion__content c-content-accordion__content--small" id="stepTitleContainer" aria-hidden="false" style="margin-right: -25px;">

                                                  <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr" style="margin: 0 0 0 0; width: 100%;">

                                                      <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                                          <label class="uk-form-label uk-flex uk-flex-between">
                                                              نام فارسی دسته:
                                                              <span class="uk-form-label__required"></span>
                                                          </label>

                                                          <div class="field-wrapper">
                                                              <input type="text" class="c-content-input__origin js-attribute-old-value" name="name">
                                                          </div>

                                                          <div></div>
                                                      </div>
                                                      <div
                                                          class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                                          <label class="uk-form-label uk-flex uk-flex-between">
                                                              نام انگلیسی دسته:
                                                              <span class="uk-form-label__required"></span>
                                                          </label>
                                                          <div class="field-wrapper">
                                                              <input type="text" class="c-content-input__origin js-attribute-old-value" name="en_name">
                                                          </div>

                                                          <div></div>
                                                      </div>
                                                  </div>


                                                  <div class="c-grid__row c-grid__row--gap-lg" style="margin-right: 0px; width: 100%; margin-bottom: 40px;">
                                                      <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                                          <label for="" class="uk-form-label">توضیحات دسته:</label>
                                                          <div class="field-wrapper field-wrapper--textarea">
                                                              <textarea name="description" placeholder="" class="c-content-input__origin c-content-input__origin--textarea js-textarea-words" rows=""></textarea>
                                                          </div>
                                                      </div>
                                                  </div>


                                                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-4 c-grid__col--xs-gap" style="margin-top: 15px;margin-bottom: 25px;">
                                                      <div class="field-wrapper field-wrapper--justify field-wrapper--background" style="
                              width: 201px;
                              ">
                                                          <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto" id="productIsFakeLabel">
                                                              <input type="checkbox" class="c-ui-checkbox__origin" name="is_main" id="is_main" value="1" onchange="valueChanged()"  {{ ($categories->where('parent_id', 0)->count() == 0)? 'disabled checked' : '' }}>
                                                              <span class="c-ui-checkbox__check"></span>
                                                              <span class="c-ui-checkbox__label">دسته اصلی</span>
                                                              <div class="c-wiki c-wiki__holder">
                                                              <span class="c-wiki-sign js-tooltip" data-tooltip="اگر دسته ای که قصد ایجاد آن را دارید زیر مجموعه دسته دیگری نیست و خود جزو دسته اصلی می‌باشد این گزینه را انتخاب کنید."></span>
                                                              </div>
                                                          </label>
                                                      </div>
                                                  </div>

                                                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                                      <label class="uk-form-label uk-flex uk-flex-between">
                                                          نامک:
                                                          <span class="uk-form-label__required"></span>
                                                      </label>
                                                      <div class="field-wrapper">
                                                          <input type="text" class="c-content-input__origin js-attribute-old-value url-inputs" name="slug" dir="ltr">
                                                          <input type="button" id="button-urls" style="width: auto;" class="c-ui-tag__submit js-tag-submit-btn button-urls" value="-{{ $site_url }}/search/category" disabled>
                                                      </div>
                                                      <div></div>
                                                  </div>

                                                  @if($categories->where('parent_id', 0)->count())
                                                  <div class="c-card__body c-card__body--content category-box">
                                                      <label for="" class="search-form__action-label">جستجو در میان دسته‌ها</label>
                                                      <div class="search-form__autocomplete-container">
                                                          <div class="search-form__autocomplete js-autosuggest-box">
                                                              <input id="searchKeyword" class="c-content-input__origin js-prevent-submit" type="text" placeholder="دسته‌بندی و یا کد دسته‌بندی مورد نظر خود را بنویسید، مثال: گوشی موبایل">
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="c-card__body  c-card__body--content category-box" id="stepTitleContent" style="margin-top: -20px;"></div>
                                                  <div class="c-card__body c-card__body--content category-box">
                                                      <!-- category a -->
                                                      <div id="categoriesContainer" class="c-content-categories">
                                                          <div class="c-content-categories__container" id="categoriesContainerContent">
                                                              <div class="c-content-categories__wrapper js-category-column cat-box" id="cat-box" data-id="0">
                                                                  <ul class="c-content-categories__list" style="list-style: none;">
                                                                      @foreach($categories->where('parent_id', 0) as $category)
                                                                          <li class="c-content-categories__item {{ (count($category->children) > 0) ? 'has-children' : '' }}">
                                                                              <label class="c-content-categories__link js-category-link">
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
                                                          <div class="c-content-categories__summary-breadcrumbs" id="bread-box">
                                                              <span class="">دسته انتخابی شما:</span>
                                                              <ul class="js-selected-category c-content-categories__selected-list" id="breadcrumbs">
                                                                  <!-- ajax -->
                                                              </ul>
                                                          </div>

                                                          <div class="c-content-accordion__step-controls c-content-accordion__step-controls--category">
                                                              <button type="button" class="c-content-categories__search-reset reset-box" id="categoryReset"></button>
                                                          </div>
                                                      </div>
                                                      <div id="error-cat" class="field-wrapper has-error"></div>
                                                  </div>
                                                  <div class="c-content-loader c-content-loader--fixed category-box">
                                                      <div class="c-content-loader__logo"></div>
                                                      <div class="c-content-loader__spinner"></div>
                                                  </div>
                                                  @endif

                                              </div>
                                          </section>

                                          <section id="stepImagesAccordion">
                                              <div
                                                  class="c-content-accordion__content c-content-accordion__content--last"
                                                  id="stepImagesContainer" style="
                        margin-right: -25px; display: block !important;
                        ">
                                                  <div class="c-card__body c-card__body--content marketplace-redesign"
                                                       id="stepImagesContent">
                                                      <div id="imagesSelfServiceContainer"
                                                           class="c-grid__row c-grid__row--gap-lg">
                                                          <div class="c-grid__col">
                                                              <fieldset class="c-content-upload">
                                                                  <legend class="c-content-upload__title">برای دسته
                                                                      تصویر انتخاب کنید
                                                                  </legend>
                                                                  <div>
                                                                      <label class="c-content-upload__trigger"
                                                                             id="uploadGalleryContainer">
                                                                          <div uk-form-custom=""
                                                                               class="uk-form-custom">
                                                                              <input name="image" type="file"
                                                                                     id="uploadImage"
                                                                                     onchange="document.getElementById('preview_uploading').src = window.URL.createObjectURL(this.files[0])"
                                                                                     style="visibility: hidden;"
                                                                                     data-id="0">
                                                                          </div>
                                                                          <span class="c-content-upload__ui-btn">بارگذاری تصویر</span>
                                                                          <ul class="c-content-upload__list c-content-upload__list--tooltips">
                                                                              <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                                                                  تصویر شما بهتر است مربعی باشد یا ابعاد
                                                                                  یک در یک داشته باشد
                                                                              </li>
                                                                              <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                                                              حداقل ابعاد عکس بهتر است ۱۲۵ * ۱۲۵ پیکسل باشد
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
                                                                                  کلید<i></i> تصویر مورد نظرتان را به
                                                                                  عنوان تصویر اصلی کالا انتخاب کنید.
                                                                              </div>
                                                                          </div>
                                                                      </div>

                                                                      <div id="imagesSection"
                                                                           class="c-content-upload__uploads js-uploaded-section"
                                                                           style="display: none;">
                                                                          <h3 class="product-form__section-title product-form__section-title--gap">
                                                                              تصویر در حال بارگذاری
                                                                          </h3>

                                                                          <ul id="imagesContainer"
                                                                              class="c-content-upload__gallery-list js-uploaded-list js-sortable-list uk-sortable">
                                                                              <li class="c-content-upload__gallery-row js-uploads-row  li-error"
                                                                                  id="1dsWB">
                                                                                  <div
                                                                                      class="c-content-upload__img-container">
                                                                                      <img name="uploaded" data-id="0"
                                                                                           src="" alt=""
                                                                                           id="preview_uploading"
                                                                                           class="c-content-upload__img js-upload-thumb uploadImage"/>

                                                                                      <div
                                                                                          class="c-content-upload__img-loader">
                                                                                          <div
                                                                                              class="progress__wrapper">
                                                                                            <span
                                                                                                class="progress"></span>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div
                                                                                          class="c-content-upload__img-error"></div>
                                                                                  </div>
                                                                                  <div
                                                                                      class="c-content-upload__mid-container">
                                                                                      <div
                                                                                          class="c-content-upload__mid-container c-content-upload__mid-container--top">
                                                                                          <div
                                                                                              class="c-content-upload__desc">
                                                                                              <div
                                                                                                  class="c-content-upload__desc--top">
                                                                                                  <div class="right">
                                                                                                      <div
                                                                                                          class="c-content-upload__name js-upload-name"></div>
                                                                                                      <div
                                                                                                          class="c-content-upload__size js-upload-size"></div>
                                                                                                  </div>
                                                                                                  <div
                                                                                                      class="c-content-upload__select"></div>
                                                                                              </div>
                                                                                          </div>
                                                                                          <ul
                                                                                              class="c-content-upload__list c-content-upload__list--errors js-upload-error-list">
                                                                                              <li class="error-image"></li>
                                                                                          </ul>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div
                                                                                      class="c-content-upload__controls">
                                                                                      <button type="button"
                                                                                              class="c-content-upload__btn c-content-upload__btn--remove js-remove-upload"></button>
                                                                                  </div>
                                                                      </div>

                                                                      </li>
                                                                      </ul>
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
                                                  <button class="c-ui-btn c-ui-btn--next mr-a" id="submit-form">افزودن
                                                      دسته
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

// تغییر پدینگ فیلد نامک
$(function () {
    var buttonWidth = $('#button-urls').width() + 20;
    $(".url-inputs").css({
        'padding-left': buttonWidth
    });

});

// پنهان کردن دسته‌بندی وقتی روی چک باکس کلیک شد
function valueChanged() {
    if ($("#is_main").is(":checked")) {
        $(".category-box").hide();
        $("#stepImagesAccordion").hide();
    } else {
        $(".category-box").show();
        $("#stepImagesAccordion").show();
    }
}

// تغییر آدرس دسته‌بندی در راهنمای فیلد نامک
$(document).on('click', "#is_main", function (e) {
    if ($("#is_main").is(":checked")) {
        $(".button-urls").val('/{{ $site_url }}' + '/main');
    } else {
        $(".button-urls").val('-{{ $site_url }}' + '/search/category');
    }
    var buttonWidth = $('#button-urls').width() + 20;
    $(".url-inputs").css({
        'padding-left': buttonWidth
    });
});

// اضافه کردن توکن به درخواست های ایجکس
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// ایجکس فرم اصلی
$('#category_form').on('submit', function (e) {
    e.preventDefault();

    if ($("input:checked[type='checkbox']").val()) {
        var selectedCategory = 0;
    } else {
        var selectedCategory = $("input:checked[type='radio']").val();
    }

    if ($("#stepImagesAccordion").is(":hidden")) {
        var image = 'not_required';
    } else {
        var image = $("img[name='uploaded']").attr('data-id');
    }

    var name = $("input[name='name']").val();
    var slug = $("input[name='slug']").val();
    var en_name = $("input[name='en_name']").val();
    var description = $("textarea[name='description']").val();


    // if (name && slug && en_name && ((image > 0) || (image == 'not_required'))) {
    if (name && slug && en_name) {
        $('#submit-form').prop('disabled', true);

        $.ajax({
            method: "post",
            url: '{{route('staff.categories.store')}}',
            data: {
                name: name,
                slug: slug,
                en_name: en_name,
                image: image,
                parent_id: selectedCategory,
                description: description,
            },
            success: function (response) {
                $('#submit-form').prop('disabled', false);

                $('#category_form').trigger("reset");

                window.location.href = "{{ route('staff.categories.index') }}";

                $(".appended-box").each(function () {
                    $(this).remove();
                });

                $(".error").each(function () {
                    $(this).remove();
                });

                $("#stepImagesAccordion").show();
                $("#imagesSection").hide();
                $('#preview_uploading').attr('data-id', 0);
                $("img[name='uploaded']").attr('data-id', 0);


                $.ajax({
                    type: 'post',
                    url: '{{route('staff.categories.mainCatLoader')}}',
                    success: function (response) {
                        $('.c-content-categories__wrapper').replaceWith(response);
                    }
                });
                $(".category-box").show();
            },
            error: function (){
                $('#submit-form').prop('disabled', false);
            }
        });
    }
});

// تابع تبدیل بایت
function formatBytes(bytes, decimals = 0) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

// نمایش نام و حجم عکس در فرانت
$(document).on("change", "#uploadImage", function () {
    $('.js-upload-size').text(formatBytes(this.files[0].size));
    var filename = $("#uploadImage").val().split('\\').pop();
    $('.js-upload-name').text(filename);
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
        console.log(form_data);
    }

    $.ajax({
        url: '{{route('staff.categories.ajaxupload')}}',
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

            $.ajax({
                url: '{{route('staff.categories.ajaxdelete')}}',
                type: 'post',
                data: {
                    id: $("img[name='uploaded']").attr('data-id'),
                },
                success: function (data) {
                    $("input[name='image']").val('');
                    // $("#imagesSection").hide();
                    $('#preview_uploading').attr('data-id', 0);
                    $("img[name='uploaded']").attr('data-id', 0);
                },
            });
        }
    });

});

// ایجکس حذف عکس
$(document).on("click", ".js-remove-upload", function () {

    $.ajax({
        url: '{{route('staff.categories.ajaxdelete')}}',
        type: 'post',
        data: {
            id: $("img[name='uploaded']").attr('data-id'),
        },
        success: function (data) {
            $("input[name='image']").val('');
            $("#imagesSection").hide();
        },
        error: function () {
            $("input[name='image']").val('');
            $("#imagesSection").hide();
            $('.uploadImage').attr('data-id', 0);
        }
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

// ایجکس سرچ
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
