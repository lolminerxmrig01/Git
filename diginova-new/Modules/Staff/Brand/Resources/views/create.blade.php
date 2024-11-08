@extends('layouts.staff.master')

@section('title') ایجاد برند | {{ $fa_store_name }}  @endsection

@section('head')
<script src="{{ asset('mehdi/staff/js/create-brand-validation.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/tags.js') }}"></script>
@endsection

@section('content')
<main class="c-content-layout">
  <div class="uk-container uk-container-large">
    <div class="c-grid">
      <div class="c-content-page c-content-page--plain c-grid__row">
        <div class="c-grid__col">
          <div class="c-content-page__header">
            <span class="c-content-page__header-action">ایجاد برند</span>
            <span class="c-content-page__header-desc">برای فروشگاه برند ایجاد کنید</span>
          </div>
        </div>
      </div>
      <div class="c-grid__row">
        <div class="c-grid__col">
          <div class="c-card">
              <form id="brand_form">
                <div class="c-grid__row">
                  <div class="c-grid__col">
                    <div class="product-form">
                      <div class="c-content-accordion js-accordion uk-accordion">
                        <section id="top-fields" class="c-content-accordion__row js-content-section uk-open" id="stepCategoryAccordion">
                          <h2 style="font-size: 18px;margin-right: 33px;margin-top: -8px;">
                            <div style="color: #606265;">ایجاد برند</div>
                          </h2>
                          <div style="width: 100%;margin: -7px 0px 50px 0px !important;padding: 0px !important;background: #e2dddd;height: 1px;"></div>
                          <div class="c-content-accordion__content c-content-accordion__content--small" id="stepTitleContainer" aria-hidden="false" style="margin-right: -25px;">
                            <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr" style="margin: 0 0 0 0;width: 100%;">
                              <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                <label class="uk-form-label uk-flex uk-flex-between">
                                  نام فارسی برند:
                                  <span class="uk-form-label__required"></span>
                                </label>
                                <div class="field-wrapper">
                                  <input type="text" class="c-content-input__origin js-attribute-old-value" name="name">
                                </div>
                                <div></div>
                              </div>
                              <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                <label class="uk-form-label uk-flex uk-flex-between">
                                  نام انگلیسی برند:
                                  <span class="uk-form-label__required"></span>
                                </label>
                                <div class="field-wrapper">
                                  <input type="text" class="c-content-input__origin js-attribute-old-value" name="en_name">
                                </div>
                                <div></div>
                              </div>
                            </div>
                              <div class="c-grid__row c-grid__row--gap-lg"  style="margin-right: 0px; width: 100%; margin-bottom: 40px;">
                                <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                  <label for="" class="uk-form-label">شرح برند:</label>
                                  <div class="field-wrapper field-wrapper--textarea">
                                    <textarea name="description"
                                              placeholder="توضیحات برند بهتر است بین ۷۰ تا ۱۰۰ کلمه درباره‌ی تاریخچه و محصولات برند باشد …"
                                              class="c-content-input__origin c-content-input__origin--textarea js-textarea-words"
                                              rows="" maxlength="500"></textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                <label class="uk-form-label uk-flex uk-flex-between">
                                  نامک
                                 <span class="uk-form-label__required"></span>
                                </label>
                                <div class="field-wrapper">
                                  <input type="text" class="c-content-input__origin js-attribute-old-value url-inputs" name="slug" dir="ltr">
                                  <input type="button" id="button-urls" style="width: auto;"
                                         class="c-ui-tag__submit js-tag-submit-btn button-urls"
                                         value="/{{ $site_url }}/brand" disabled>
                                </div>
                                <div></div>
                              </div>
                              <div class="c-card__body c-card__body--content category-box">
                                <label for="" class="search-form__action-label">گروه کالایی فعال در برندتان را انتخاب کنید</label>
                              </div>
                              <div class="c-card__body  c-card__body--content category-box" id="stepTitleContent" style="margin-top: -20px;"></div>
                              <div class="c-card__body c-card__body--content category-box">
                                <!-- category a -->
                                <div id="categoriesContainer" class="c-content-categories">
                                  <div class="c-content-categories__container" id="categoriesContainerContent">
                                    <div class="c-content-categories__wrapper js-category-column cat-box">
                                      <ul class="c-content-categories__list">
                                        @foreach($categories->where('parent_id', 0) as $category)
                                          <li class="c-content-categories__item">
                                            <label data-cat-id="{{ $category->id }}" class="c-content-categories__link js-category-link">
                                              <input type="radio" name="category" value="{{ $category->id }}"
                                                     class="js-category-data radio uk-hidden" data-cat-id="{{ $category->id }}"
                                                     data-theme="" style="visibility: hidden;">
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
                                    <ul class="js-selected-category c-content-categories__selected-list" id="breadcrumbs">
                                      <!-- ajax -->
                                    </ul>
                                  </div>

                                  <div class="c-content-accordion__step-controls c-content-accordion__step-controls--category">
                                      <a class="c-ui-btn c-ui-btn--next mr-a disabled js-continue-btn" id="categoryStepNext">
                                        انتخاب دسته
                                      </a>
                                  </div>
                                </div>
                              </div>
                              <div class="c-content-loader c-content-loader--fixed category-box">
                                <div class="c-content-loader__logo"></div>
                                <div class="c-content-loader__spinner"></div>
                              </div>
                          </div>
                          <input type="text" name="category_group" class="category_group"
                                 id="hidden_cat_group" style="visibility: hidden">
                        </section>
                        <section id="stepImagesAccordion">
                          <div class="c-content-accordion__content c-content-accordion__content--last"
                               id="stepImagesContainer" aria-hidden="false" style="margin-right: -25px; display: block !important;">
                            <div class="c-card__body c-card__body--content marketplace-redesign" id="stepImagesContent">
                              <div id="imagesSelfServiceContainer" class="c-grid__row c-grid__row--gap-lg">
                                <div class="c-grid__col">
                                  <fieldset class="c-content-upload">
                                    <legend class="c-content-upload__title">برای برند لوگو انتخاب کنید</legend>
                                    <div id="image-container">
                                      <label class="c-content-upload__trigger" id="uploadGalleryContainer">
                                        <div uk-form-custom="" class="uk-form-custom">
                                          <input name="image" type="file" id="uploadImage"  accept="image/*" onchange="loadFile(event)">
                                        </div>
                                        <span class="c-content-upload__ui-btn">بارگذاری تصویر</span>
                                        <ul class="c-content-upload__list c-content-upload__list--tooltips">
                                          <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                            تصویر شما بهتر است مربعی باشد یا ابعاد یک در یک داشته باشد
                                          </li>
                                          <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                            حداقل ابعاد عکس 125 * 125 پیکسل باشد
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
                                          می‌توانید با استفاده از کلید<i></i> تصویر مورد نظرتان را به عنوان تصویر اصلی کالا انتخاب کنید.
                                          </div>
                                        </div>
                                      </div>
                                      <div id="imagesSection" class="c-content-upload__uploads js-uploaded-section" style="display: none;">
                                        <div class="upload-box">
                                          <h3 class="product-form__section-title product-form__section-title--gap">تصویر در حال بارگذاری</h3>
                                          <ul id="imagesContainer" class="c-content-upload__gallery-list js-uploaded-list js-sortable-list uk-sortable">
                                            <li class="c-content-upload__gallery-row js-uploads-row  li-error">
                                              <div class="c-content-upload__img-container">
                                                <img name="uploaded" data-id="0" id="preview_uploading" class="c-content-upload__img js-upload-thumb upload-image" />
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
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </fieldset>
                                </div>
                              </div>
                            </div>
                          </div>
                        </section>
                      </div>
                    </div>
                    <ul id="uploadingTemplate" class="hidden">
                      <li class="c-content-upload__gallery-row js-uploads-row">
                        <input type="hidden" class="js-image-id-input">
                        <div class="c-content-upload__img-container">
                          <img src="" alt="" class="c-content-upload__img js-upload-thumb">
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
                            <ul class="c-content-upload__list c-content-upload__list--errors js-upload-error-list"></ul>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="c-card__footer c-card__footer--products">
                    <div class="c-grid__row">
                      <div class="c-grid__col c-grid__col--flex-initial">
                        <div class="c-content-error c-content-error--list hidden" id="saveAjaxErrors"></div>
                        <div class="uk-flex uk-flex-left">
                          <button class="c-ui-btn c-ui-btn--next mr-a submit-form-cu" id="submit-form">افزودن برند</button>
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
<script src="{{ asset('mehdi/staff/js/brands.js') }}"></script>

<script>

// // اضافه کردن توکن به درخواست های ایجکس
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// ایجکس آپلود عکس
$(document).on("change", "#uploadImage", function() {
    $("#imagesSection").show();
    $(".li-error").removeClass('has-error');
    $(".error-image").html('');


    var form_data = new FormData();
    var input_image = $("#uploadImage").prop("files")[0];

    form_data.append("image", input_image);

    var old_img = $("img[name='uploaded']").attr('data-id');

    if(old_img)
    {
        form_data.append("old_img", old_img);
        console.log(form_data);
    }

    $.ajax({
        url: "ajaxupload",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(data) {
            $("#imagesSection").replaceWith(data);
        },
        error: function(data) {
            $("#imagesSection").show();

            $(".li-error").addClass('has-error');
            $(".error-image").html('تصویری که انتخاب کرید شرایط لازم را ندارد');
        }
    });

});

// ایجکس حذف عکس
$(document).on("click", ".js-remove-upload", function() {
    $.ajax({
        url: "ajaxdelete",
        type: 'post',
        data: {
            id: $('#preview_uploading').attr('data-id'),
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

// ایجکس فرم اصلی
$('#brand_form').on('submit', function(e){
    e.preventDefault();

    var categories = [];
    categories.length = 0;

    $("input[name='category_group']").each(function(i, element) {
        var id = $(element).attr('value');
        var i = i;
        categories[i] = id;
    });

    var name = $("input[name='name']").val();
    var en_name = $("input[name='en_name']").val();
    var description = $("textarea[name='description']").val();
    var slug = $("input[name='slug']").val();
    var image = $('#preview_uploading').attr('data-id');

    if (name && en_name && slug)
    {
        $.ajax({
            method: "POST",
            url: '{{ route('staff.brands.store') }}',
            data: {
                name: name,
                en_name: en_name,
                description: description,
                slug: slug,
                image: image,
                categories: categories,
            },
            success: function(response) {
                $('#brand_form').trigger("reset");
                window.location.href = "{{ route('staff.brands.index') }}";
            }
        });
    }

});

</script>
@endsection

