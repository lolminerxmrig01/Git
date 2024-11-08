@extends('layouts.staff.master')

@section('title') مدیریت دسته‌ها | {{ $fa_store_name }}  @endsection
@section('head')
<script src="{{ asset('mehdi/staff/js/create-category-validation.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/category-tags.js') }}"></script>
@endsection

@section('content')
<main class="c-content-layout">
        <div class="uk-container uk-container-large">
            <div class="c-grid">
                <div class="c-content-page c-content-page--plain c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-content-page__header">
                            <span class="c-content-page__header-action">مدیریت دسته‌ها</span>
                            <span class="c-content-page__header-desc">از این صفحه می‌توانید دسته‌هایتان را مدیریت کنید</span>
                        </div>
                    </div>
                </div>
                @if ($categories->count())
                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card" data-select2-id="136">
                            <form id="category_form">
                                <div class="c-grid__col">
                                    <div class="product-form">
                                        <div class="c-content-accordion js-accordion uk-accordion">
                                            <section class="c-content-accordion__row js-content-section uk-open" id="stepCategoryAccordion">
                                                <h2 style="font-size: 18px; margin-right: 33px;margin-top: -8px;">
                                                    <div id="defualt-postion" style="color: #606265;">مدیریت دسته‌ها</div>
                                                    <a href="{{ route('staff.categories.create') }}" target="_blank"
                                                       style="float: left;margin-top: -37px;margin-left: 6px;">
                                                        <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                            ایجاد دسته جدید
                                                        </div>
                                                    </a>
                                                </h2>
                                                <div style="width: 100%;margin: -7px 0px 20px 0px !important;padding: 0px !important;
                                                    background: #e2dddd;height: 1px;"></div>
                                                <div class="c-content-accordion__content c-content-accordion__content--small" 
                                                id="stepTitleContainer" aria-hidden="false" style=" margin-right: -25px;">
                                                    <div class="c-card__body c-card__body--content category-box">
                                                        <label for="" class="search-form__action-label">جستجو در میان دسته‌ها</label>
                                                        <div class="search-form__autocomplete-container">
                                                            <div class="search-form__autocomplete js-autosuggest-box">
                                                                <input name="search" id="searchKeyword" class="c-content-input__origin js-prevent-submit"
                                                                 type="text" placeholder="دسته مورد نظرتان را جستجو کنید">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="c-card__body  c-card__body--content category-box" id="stepTitleContent" style="margin-top: -20px;">
                                                    </div>
                                                    <div class="c-card__body c-card__body--content category-box">
                                                        <!-- category a -->
                                                        <div id="categoriesContainer" class="c-content-categories">
                                                            <div class="c-content-categories__container" id="categoriesContainerContent">
                                                                <div class="c-content-categories__wrapper js-category-column cat-box" id="cat-box" data-id="0">
                                                                    <ul class="c-content-categories__list" style="list-style: none;">
                                                                        @foreach($categories->where('parent_id', 0) as $category)
                                                                            <li class="c-content-categories__item 
                                                                                {{ $categories->where('parent_id', $category->id)->count() > 0 ? 'has-children' : '' }}">
                                                                                <label class="c-content-categories__link js-category-link">
                                                                                    <input type="radio" name="category" value="{{ $category->id }}"
                                                                                     class="js-category-data radio uk-hidden" data-id="{{ $category->id }}" data-theme=""
                                                                                      data-status="ziro_parent" style="visibility: hidden;">
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
                                                                <a class="c-ui-btn c-ui-btn--next mr-a js-continue-btn disabled" id="categoryStepNext">
                                                                    انتخاب دسته
                                                                </a>
                                                                <button type="button" class="c-content-categories__search-reset reset-box" id="categoryReset"></button>
                                                            </div>

                                                        </div>
                                                        <div id="error-cat" class="field-wrapper has-error"></div>
                                                    </div>
                                                    <div class="c-content-loader c-content-loader--fixed category-box">
                                                        <div class="c-content-loader__logo"></div>
                                                        <div class="c-content-loader__spinner"></div>
                                                    </div>
                                                    <div class="edit-form-section edit-form-section-first c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr"
                                                     style="margin: 40px 0 0 0;width: 100%;" id="edit-form-section-first">
                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                                            <label class="uk-form-label uk-flex uk-flex-between">نام
                                                                فارسی دسته:
                                                                <span class="uk-form-label__required"></span>
                                                            </label>
                                                            <div class="field-wrapper">
                                                                <input type="text" class="c-content-input__origin js-attribute-old-value" name="name">
                                                            </div>
                                                            <div></div>
                                                        </div>

                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                                            <label class="uk-form-label uk-flex uk-flex-between">نام
                                                                انگلیسی دسته:
                                                                <span class="uk-form-label__required"></span>
                                                            </label>

                                                            <div class="field-wrapper">
                                                                <input type="text" class="c-content-input__origin js-attribute-old-value" name="en_name">
                                                            </div>
                                                            <div></div>
                                                        </div>
                                                    </div>

                                                    <div class="c-grid__row c-grid__row--gap-lg edit-form-section" style="margin-right: 0px; width: 100%; margin-bottom: 40px;">
                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                                            <label for="" class="uk-form-label">توضیحات دسته:</label>
                                                            <div class="field-wrapper field-wrapper--textarea">
                                                                <textarea name="description" placeholder="" class="c-content-input__origin c-content-input__origin--textarea js-textarea-words" rows=""></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="edit-form-section c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
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
                                                </div>
                                        </div>
                                        </section>

                                        <section class="edit-form-section" id="stepImagesAccordion">
                                            <div class="c-content-accordion__content c-content-accordion__content--last" id="stepImagesContainer" aria-hidden="false" style="margin-right: -25px; display: block !important;">
                                                <div class="c-card__body c-card__body--content marketplace-redesign" id="stepImagesContent">
                                                    <div id="imagesSelfServiceContainer" class="c-grid__row c-grid__row--gap-lg">
                                                        <div class="c-grid__col">
                                                            <fieldset class="c-content-upload">
                                                                <legend class="c-content-upload__title">برای دسته
                                                                    تصویر انتخاب کنید
                                                                </legend>
                                                                <div>
                                                                    <label class="c-content-upload__trigger" id="uploadGalleryContainer">
                                                                        <div uk-form-custom="" class="uk-form-custom">
                                                                            <input name="image" type="file" id="uploadImage" onchange="document.getElementById('preview_uploading').src = window.URL.createObjectURL(this.files[0])" style="visibility: hidden;" data-id="0">
                                                                        </div>
                                                                        <span class="c-content-upload__ui-btn">بارگذاری تصویر</span>
                                                                        <ul class="c-content-upload__list c-content-upload__list--tooltips">
                                                                            <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                                                                تصویر شما بهتر است مربعی باشد یا ابعاد یک در یک داشته باشد
                                                                            </li>
                                                                            <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                                                                حداقل ابعاد عکس بهتر است ۱۲۵ * ۱۲۵ پیکسل باشد
                                                                            </li>
                                                                        </ul>
                                                                    </label>
                                                                    <div id="imagesLoadingSection" class="c-content-upload__uploads loading js-uploading-section hidden">
                                                                        <h3 class="product-form__section-title product-form__section-title--gap">
                                                                            تصاویر درحال بارگذاری
                                                                        </h3>
                                                                        <ul id="imagesUploadList" class="c-content-upload__gallery-list"></ul>
                                                                    </div>
                                                                    <div class="c-content-upload__error-container hidden" id="ajaxErrorImages">
                                                                        <div class="c-content-upload__error">
                                                                            <div class="hidden" id="imageErrorsContainer"></div>
                                                                            <div class="hidden c-content-upload__error-msg" id="mainImageErrorContainer">
                                                                                می‌توانید با استفاده از
                                                                                کلید<i></i> تصویر مورد نظرتان را به
                                                                                عنوان تصویر اصلی کالا انتخاب کنید.
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="imagesSection" class="c-content-upload__uploads js-uploaded-section" style="display: none;">
                                                                        <h3 class="product-form__section-title product-form__section-title--gap">
                                                                            تصویر در حال بارگذاری
                                                                        </h3>

                                                                        <ul id="imagesContainer" class="c-content-upload__gallery-list js-uploaded-list js-sortable-list uk-sortable">
                                                                            <li class="c-content-upload__gallery-row js-uploads-row  li-error" id="1dsWB">
                                                                                <div class="c-content-upload__img-container">
                                                                                    <img name="uploaded" data-id="0" src="" alt="" id="preview_uploading" class="c-content-upload__img js-upload-thumb uploadImage"/>

                                                                                    <div class="c-content-upload__img-loader">
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
                                                                                                    <div class="c-content-upload__name js-upload-name"></div>
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
                                    </section>
                                </div>

                                <div class="edit-form-section c-card__footer c-card__footer--products">
                                    <div class="c-grid__row">
                                        <div class="c-grid__col c-grid__col--flex-initial">
                                            <div class="uk-flex uk-flex-right" style="width: 96%;">
                                                <a class="c-ui-btn c-ui-btn--next mr-a" id="delete-btn"
                                                   style="background: #EF5661;border: none;">حذف
                                                    دسته
                                                </a>
                                                @include('staffcategory::layouts.modal')
                                                <input name="selected-cat" hidden>
                                                <button class="c-ui-btn c-ui-btn--next mr-a" style="margin-right: 13px;"
                                                        id="submit-form">ذخیره
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                @else
                    <div class="c-grid c-join__grid">
                        <div class="c-grid__row">
                            <div class="c-grid__col">
                                <div class="c-card">
                                    <div class="c-card__body">
                                        <div class="c-grid__col">
                                            <div class="c-grid__col c-promo__tab-container c-promo__tab-container--is-visible" data-tab="1">
                                                <div class="c-join__promotion-info-box c-join__promotion-info-box--empty">
                                                    <img class="c-join__promotion-info-img" src="{{ asset('mehdi/staff/images/no-content.svg') }}" alt="Empty">
                                                        <p class="c-join__promotion-info-statement c-join__promotion-info-statement--bg">شما تا به حال هیچ دسته ای ایجاد نکرده‌اید</p>
                                                        <p class="c-join__promotion-info-statement">
                                                            برای ایجاد دسته جدید روی دکمه زیر کلیک کنید.
                                                        </p>
                                                        <a class="c-join__btn c-join__btn--info-box c-join__btn--secondary-greenish"
                                                           href="{{ route('staff.categories.create') }}">ایجاد دسته جدید</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
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

// تغییر پدینگ فیلد نامک
$(function () {
    var buttonWidth = $('#button-urls').width() + 20;
    $(".url-inputs").css({
        'padding-left': buttonWidth
    });

});

// تغییر آدرس دسته‌بندی در راهنمای فیلد نامک
$(document).on('click', "#categoryStepNext", function (e) {
    if ($("input[type='radio']:checked").attr('data-status') == 'ziro_parent') {
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

$(document).on('click', '#delete-btn', function () {

  $('.c-header__nav').hide();
  $(".uk-modal-container").addClass('uk-open');
  $(".uk-modal-container").css('display', 'block');

  $(document).on('click', '.uk-close', function () {
    $('.c-header__nav').show();
  });

  $(document).on('click', '.no', function () {
    $('.c-header__nav').show();
  });

});


$(document).on('click', '.yes', function () {

  var cat_id = $("input[name='selected-cat']").val();

  $('.c-header__nav').show();

  $.ajax({
    method: 'post',
    url: "{{route('staff.categories.destroy')}}",
    data: {
      'id': cat_id,
    },
    success: function () {
      $(".edit-form-section").hide();

      $.toast({
        heading: 'موفق!',
        text: "دسته با موفقیت حذف شد",
        bgColor: '#3DC3A1',
        textColor: '#fff',
      });

      $.ajax({
        type: 'post',
        url: '{{route('staff.categories.mainCatLoader')}}',
        success: function (response) {
          $('.c-content-categories__wrapper').replaceWith(response);
          $('.edit-form-section').each(function () {
            $(this).hide();
          });
        }
      });

      $(".category-box").show();
      $(".appended-box").each(function () {
        $(this).remove();
      });

      $(".category-box").show();


    },
  });

});

// ایجکس فرم اصلی
$('#category_form').on('submit', function (e) {
    e.preventDefault();

    var name = $("input[name='name']").val();
    var slug = $("input[name='slug']").val();
    var en_name = $("input[name='en_name']").val();
    var old_img = $("img[name='uploaded']").attr('data-id');
    var description = $("textarea[name='description']").val();

    var selectedCat = $("input[name='selected-cat']").val();

    if ($("#imagesSection").is(":hidden")) {
      var image = null;
    } else {
        var image = $("img[name='uploaded']").attr('data-id');
    }

    if (name && slug && en_name) {
        $.ajax({
            method: "post",
            url: '{{route('staff.categories.update')}}',
            data: {
                name: name,
                slug: slug,
                en_name: en_name,
                image_id: image,
                id: selectedCat,
                description: description,
            },
            success: function (response) {
                $(".category-box").show();
                $(".appended-box").each(function () {
                    $(this).remove();
                });
                $(".edit-form-section").hide();
                $.toast({
                    heading: 'موفق!',
                    text: "دسته با موفقیت ویرایش شد",
                    bgColor: '#3DC3A1',
                    textColor: '#fff',
                });
                $('#category_form').trigger("reset");

                $(".appended-box").each(function () {
                    $(this).remove();
                });

                $("#imagesSection").hide();
                $('#preview_uploading').attr('data-id', 0);
                $("img[name='uploaded']").attr('data-id', 0);

                $.ajax({
                    type: 'post',
                    url: '{{route('staff.categories.mainCatLoader')}}',
                    success: function (response) {
                        $('.c-content-categories__wrapper').replaceWith(response);
                        $('.edit-form-section').each(function () {
                            $(this).hide();
                        });
                        $('html, body').animate({
                            scrollTop: $("#defualt-postion").offset().top
                        }, 600);
                    }
                });

                $(".category-box").show();
            },
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
    var selectedCat = $("input[name='selected-cat']").val();

    form_data.append("image", input_image);

    var old_img = $("img[name='uploaded']").attr('data-id');

    if (old_img) {
        form_data.append("old_img", old_img);
    }

    form_data.append("category_id", selectedCat);

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
        }
    });

});

//  حذف عکس
$(document).on("click", ".js-remove-upload", function () {
    $("#imagesSection").hide();
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
            $('.edit-form-section').each(function () {
                $(this).hide();
            });
        }
    });
    $(".category-box").show();
    $(".appended-box").each(function () {
        $(this).remove();
    });
});

$(document).on('click', "input[type='radio']", function (e) {
    if ($("input:checked[type=radio]")) {

        $("#categoryStepNext").removeClass('disabled');
    } else {
        $("#categoryStepNext").addClass('disabled');
    }

});

$(document).on('click', "#categoryStepNext", function (e) {
    var selectedCat = $("input:checked[type='radio']").val();
    $.ajax({
        type: 'post',
        url: '{{route('staff.categories.getData')}}',
        data: {
            'id': selectedCat,
        },
        success: function (data) {

            $("#stepImagesContent").show();

            // تغییر پدینگ فیلد نامک
            $(function () {
                var buttonWidth = $('#button-urls').width() + 20;
                $(".url-inputs").css({
                    'padding-left': buttonWidth
                });
            });

            $("input[name='name']").val(data.category.name);
            $("input[name='en_name']").val(data.category.en_name);
            $("input[name='slug']").val(data.category.slug);
            $("textarea[name='description']").html(data.category.description);
            $(".appended-options").each(function () {
                $(this).remove();
            });

            var selected_cat = $("input:checked[type='radio']").val();
            $("input[name='selected-cat']").val(selected_cat);

            $("#parent_category").append(data.options);

            if (data.image) {
                $("#imagesSection").show();
                $("#imagesSection").replaceWith(data.image);
            } else {
                $("#imagesSection").hide();
                $('#preview_uploading').attr('data-id', 0);
                $("img[name='uploaded']").attr('data-id', 0);
            }

            if ($("input:checked[type='radio']").attr('data-status') == 'ziro_parent') {
                $("#stepImagesContent").hide();
            }
        }
    });
    $(".edit-form-section").show(100);
    $('html, body').animate({
        scrollTop: $("#categoryStepNext").offset().top
    }, 600);
});


</script>
@endsection
