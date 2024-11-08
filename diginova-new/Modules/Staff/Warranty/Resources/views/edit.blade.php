
@extends('layouts.staff.master')

@section('title') ویرایش گارانتی‌ | {{ $fa_store_name }}  @endsection

@section('head')
  <script src="{{ asset('mehdi/staff/js/create-warranty-validation.js') }}"></script>
  <script src="{{ asset('mehdi/staff/js/tags.js') }}"></script>
@endsection

@section('content')
<?php
  $warranty->name = persianNum($warranty->name);
?>
<main class="c-content-layout">
  <div class="uk-container uk-container-large">
    <div class="c-grid">
      <div class="c-content-page c-content-page--plain c-grid__row">
        <div class="c-grid__col">
          <div class="c-content-page__header">
            <span class="c-content-page__header-action">ویرایش گارانتی</span>
            <span class="c-content-page__header-desc"> از این صفحه می‌توانید گارانتی "{{ $warranty->name }}" را ویرایش کنید.</span>
          </div>
        </div>
      </div>
      <div class="c-grid__row">
        <div class="c-grid__col">
          <div class="c-card">
              <form id="warranty_form">
              <div class="c-grid__row">
                  <div class="c-grid__col">
                      <div class="product-form">
                        <div class="c-content-accordion js-accordion uk-accordion">
                          <section id="top-fields" class="c-content-accordion__row js-content-section uk-open" id="stepCategoryAccordion">
                            <h2 style="font-size: 18px;margin-right: 33px;margin-top: -8px;">
                              <div style="color: #606265;">ویرایش گارانتی</div>
                            </h2>

                            <div style="width: 100%;margin: -7px 0px 50px 0px !important;padding: 0px !important;background: #e2dddd;height: 1px;"></div>
                            <div class="c-content-accordion__content c-content-accordion__content--small" id="stepTitleContainer" aria-hidden="false" style="
                              margin-right: -25px;">

                              <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr" style="margin: 0 0 0 0;
                                width: 100%;">
                                <div class="c-join__warning-box uk-margin-remove-top" style="margin-bottom: 40px; margin-right: 15px;margin-left: 15px; width: 100%">
                                  <p class="c-join__warning-row c-join__warning-row--has-icon">کلمه "گارانتی" به صورت خودکار به اول نام گارانتی‌ها اضافه می‌گردد، لطفا نام تامین‌کننده گارانتی را وارد کنید.</p>
                                </div>
                                <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial
                                  c-grid__col--sm-6">
                                  <label class="uk-form-label uk-flex uk-flex-between">
                                      نام گارانتی:
                                      <span class="uk-form-label__required"></span>
                                  </label>
                                  <div class="field-wrapper">
                                    <input name="name" type="text" class="c-content-input__origin js-attribute-old-value" value="{{ old('name')?? $warranty->name }}">
                                  </div>
                                  <div>
                                  </div>
                                </div>
                                <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial
                                  c-grid__col--sm-6">
                                  <label class="uk-form-label uk-flex uk-flex-between">
                                      مدت گارانتی:
                                  </label>
                                    <div class="field-wrapper">
                                        <label class="c-content-input">
                                            <input type="text" name="time" placeholder="" class="c-content-input__origin js-required-attribute" value="{{ old('time')?? $warranty->month }}">
                                            <span class="c-content-input__text c-content-input__text--overlay" style="left: 0 !important;right: unset !important;">بر حسب ماه</span>
                                        </label>
                                    </div>
                                  <div>
                                  </div>
                                </div>
                              </div>

                                <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-4 c-grid__col--xs-gap" style="margin-top: 15px;margin-bottom: 25px;">
                                    <div class="field-wrapper field-wrapper--justify field-wrapper--background" style="width: 201px;">
                                        <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto" id="productIsFakeLabel">
                                            <input type="checkbox" class="c-ui-checkbox__origin" name="has_insurance" id="has_insurance" {{ ($warranty->has_insurance)? 'checked' : '' }}>
                                            <span class="c-ui-checkbox__check"></span>
                                            <span class="c-ui-checkbox__label">بیمه دارد</span>
                                            <div class="c-wiki c-wiki__holder">
                                                <span class="c-wiki-sign js-tooltip" data-tooltip="اگر گارانتی شامل بیمه می‌باشد این گزینه را انتخاب کنید"></span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                              <div class="c-card__body c-card__body--content category-box">
                                <label for="" class="search-form__action-label">گروه کالایی فعال در گارانتی را انتخاب کنید                                          <span class="uk-form-label__required"></span>
                                </label>
                              </div>

                              <div class="c-card__body  c-card__body--content category-box"
                                id="stepTitleContent" style="margin-top: -20px;">
                              </div>
                              <div class="c-card__body c-card__body--content category-box">
                                <!-- category a -->
                                <div id="categoriesContainer" class="c-content-categories">
                                  <div class="c-content-categories__container"
                                    id="categoriesContainerContent">
                                    <div class="c-content-categories__wrapper js-category-column cat-box">
                                      <ul class="c-content-categories__list">
                                        @foreach($categories->where('parent_id', 0) as $category)
                                        <li class="c-content-categories__item">
                                          <label data-cat-id="{{ $category->id }}"
                                            class="c-content-categories__link js-category-link">
                                          <input type="radio" name="category"
                                            value="{{ $category->id }}"
                                            class="js-category-data radio uk-hidden"
                                            data-cat-id="{{ $category->id }}"
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
                                    <ul class="js-selected-category c-content-categories__selected-list" id="breadcrumbs" style="margin-right: 10px;">
                                        @foreach($warranty->categories as $category)
                                            <li class="select2-selection__choice" data-cat-id="{{ $category->id }}" style="background: #889098;
                                                                        color: #ffffff;height: 25px;border-radius: 33px;font-size: 12px;
                                                                        padding: 5px 11px 0px 11px;margin-left: 5px;">
                                                <span class="select2-selection__choice__remove" role="presentation">{{ $category->name }}</span>
                                                <a class="select2-selection__choice__remove remove-breadcrumb" data-cat-id="{{ $category->id }}"
                                                   role="presentation" style="margin-right: 5px; font-weight: bold; padding-right: 2px;color: white;">×</a>
                                            </li>
                                        @endforeach
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
                              @foreach($warranty->categories as $category)
                                  <input type="text" name="category_group" class="category_group" value="{{ $category->id }}"  style="visibility: hidden">
                              @endforeach
                          </section>
                        </div>

                        <div class="c-card__footer c-card__footer--products">
                          <div class="c-grid__row">
                            <div class="c-grid__col c-grid__col--flex-initial">
                              <div class="c-content-error c-content-error--list hidden"
                                id="saveAjaxErrors">
                              </div>
                              <div class="uk-flex uk-flex-left" style="width: 98%">
                                <button class="c-ui-btn c-ui-btn--next mr-a submit-form-cu" id="submit-form">ویرایش گارانتی</button>
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
<script src="{{ asset('mehdi/staff/js/warranties.js') }}"></script>

<script>

// // اضافه کردن توکن به درخواست های ایجکس
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// ایجکس فرم اصلی
$('#warranty_form').on('submit', function(e){
    e.preventDefault();

    var categories = [];
    categories.length = 0;

    $("input[name='category_group']").each(function(i, element) {
        var id = $(element).attr('value');
        var i = i;
        categories[i] = id;
    });

    if($("input[name='has_insurance']").is(':checked')){
        var has_insurance = 1 ;
    } else {
        var has_insurance = 0 ;
    }


    var name = $("input[name='name']").val();
    var time = $("input[name='time']").val();

    if (name)
    {
        $.ajax({
            method: "POST",
            url: '{{ route('staff.warranties.update') }}',
            data: {
                name: name,
                time: time,
                has_insurance: has_insurance,
                categories: categories,
                id: {{ $warranty->id }},
            },
            success: function() {
                $('#warranty_form').trigger("reset");
                window.location.href = "{{ route('staff.warranties.index') }}";
            },
            error: function () {
                var error = '<div id="hidden_cat_group-error" class="error error-text cat_group-error">انتخاب حداقل یک دسته اجباری است</div>';
                if (!$(document).hasClass("cat_group-error")){
                    $("#breadcrumbs").append(error);
                }
            }
        });
    }
});

if ($('.select2-selection__choice').length > 5) {
    $(".select2-selection__choice__remove").each(function (){
        var value = $(this).html();
        $(this).html(TextAbstract(value, 8));
    });
}

if ($('.select2-selection__choice').length > 8) {
    $(".select2-selection__choice__remove").each(function (){
        var value = $(this).html();
        $(this).html(TextAbstract(value, 5));
    });
}

</script>
@endsection

