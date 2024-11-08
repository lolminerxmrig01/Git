@extends('layouts.staff.master')
@section('title') ویرایش محصول | {{ $fa_store_name }}  @endsection
@section('head')
<style>
    .o-spacing-m-t-4 {
        margin-top: 0px !important;
    }
</style>
{{-- <script src="{{ asset('seller/js/tags5.js') }}"></script> --}}
<script src="{{ asset('mehdi/staff/js/product-tags.js') }}"></script>

<script src="{{ asset('mehdi/staff/js/jquery-ui.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('mehdi/staff/css/tagify.css') }}">
<script src="{{ asset('mehdi/staff/js/jQuery.tagify.min.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/tagify.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('mehdi/staff/css/dragsort.css') }}" media="print" onload="this.media='all'">
<script src="{{ asset('mehdi/staff/css/dragsort.css') }}"></script>
@endsection

@section('content')

<main class="c-content-layout">
    <div class="uk-container uk-container-large">
        <div class="c-grid">
            <div class="c-content-page c-content-page--plain c-grid__row">
                <div class="c-grid__col">
                    <div class="c-content-page__header">
                        <span class="c-content-page__header-action">
                            درج محصول
                        </span>
                        <span class="c-content-page__header-desc">
                            اطلاعات محصول‌تان را در این صفحه وارد کنید
                        </span>
                    </div>
                </div>
            </div>
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <div class="c-card">
                        <div class="c-grid__row">
                            <div class="c-grid__col">
                                <div class="product-form">
                                    <div class="c-content-accordion js-accordion">
                                        <section class="c-content-accordion__row js-content-section uk-open disabled"
                                            id="stepCategoryAccordion">
                                            <h2 class="c-content-accordion__title ">
                                                <div class="c-content-accordion__title-text">
                                                    گام اول: انتخاب گروه کالا
                                                </div>
                                            </h2>
                                            <div class="c-content-accordion__content" id="stepCategoryContainer">
                                                <div class="c-card__body c-card__body--content">
                                                    <div id="ajaxErrorCategory"
                                                         class="c-content-error hidden">
                                                    </div>
                                                    <h3 class="search-form__search-heading">برای درج کالای جدید
                                                        ابتدا گروه کالای خود را انتخاب کنید:</h3>
                                                    <label for="" class="search-form__action-label">جستجوی گروه
                                                        کالای شما:</label>
                                                    <div class="search-form__autocomplete-container">
                                                        <div class="search-form__autocomplete js-autosuggest-box">
                                                            <input id="searchKeyword"
                                                                   class="c-content-input__origin js-prevent-submit"
                                                                   type="text"
                                                                   placeholder="نام کالا،  دسته‌بندی و یا کد دسته‌بندی مورد نظر خود را بنویسید، مثال: گوشی موبایل"
                                                                   disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="c-card__body c-card__body--content">
                                                    <div id="categoriesContainer" class="c-content-categories">
                                                        <div class="c-content-categories__container"
                                                             id="categoriesContainerContent">
                                                            @foreach($all_parent as $parent)
                                                                @if($categories->where('parent_id', $parent)->count() > 0)
                                                                    <div
                                                                        class="c-content-categories__wrapper js-category-column">
                                                                        <ul class="c-content-categories__list">
                                                                            @foreach($categories->where('parent_id',$parent) as $category)
                                                                                <li class="c-content-categories__item
                                                                                 {{ $categories->where('parent_id', $category->id)->count() > 0 ? 'has-children' : '' }}
                                                                                {{ in_array($category->id, $all_parent) ? 'is-active' : '' }}">
                                                                                    <label
                                                                                        class="c-content-categories__link js-category-link">
                                                                                        <input type="radio"
                                                                                               class="uk-hidden js-category-data"
                                                                                               data-id="{{ $category->id }}"
                                                                                               value="{{ $category->name }}"
                                                                                               data-theme="">
                                                                                        {{ $category->name }}
                                                                                    </label>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            @endforeach

                                                        </div>
                                                        <div class="c-content-loader">
                                                            <div class="c-content-loader__logo"></div>
                                                            <div class="c-content-loader__spinner"></div>
                                                        </div>
                                                    </div>

                                                    <div class="c-content-categories__summary">
                                                        <div class="c-content-categories__summary-breadcrumbs">
                                                            <span class="">گروه کالایی انتخابی شما:</span>
                                                            <ul class="js-selected-category c-content-categories__selected-list">
                                                                @foreach($all_parent as $parent)
                                                                    @if($parent !== 0)
                                                                        <li class="c-content-categories__selected-category">
                                                                            {{ $categories->find($parent)->name }}
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                        <div
                                                            class="c-content-accordion__step-controls c-content-accordion__step-controls--category">
                                                            <button
                                                                class="c-ui-btn c-ui-btn--next mr-a disabled js-continue-btn"
                                                                id="categoryStepNext">
                                                                انتخاب گروه کالا
                                                            </button>
                                                            <button type="button"
                                                                    class="c-content-categories__search-reset"
                                                                    id="categoryReset"></button>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="c-content-loader">
                                                    <div class="c-content-loader__logo"></div>
                                                    <div class="c-content-loader__spinner"></div>
                                                </div>
                                            </div>
                                            <div class="c-content-progress active">
                                                <span class="c-content-progress__step"></span>
                                            </div>
                                            <div id="confirmCategoryChangeModal" class="marketplace-redesign"
                                                 uk-modal>
                                                <div class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body">
                                                    <button class="uk-modal-close uk-modal-close--search"
                                                            type="button" uk-close></button>

                                                    <div class="modal-product modal-product--confirm">
                                                        <h2 class="modal-message--title">فروشنده گرامی،</h2>
                                                        <p class="modal-message--center">در صورت تغییر گروه کالایی؛
                                                            مقداری از اطلاعاتی که در مرحله‌های بعد وارد کرده‌اید،
                                                            حذف خواهند شد. از انجام این تغییر اطمینان دارید ؟</p>
                                                        <p class="modal-message--center hidden"
                                                           id="differentCategoryThemeMessageContainer">شما گروه
                                                            کالایی با تم متفاوت با گروه کالایی قبلی انتخاب کرده‌اید،
                                                            توجه داشته باشید تمام تنوع‌های این محصول غیرفعال خواهند
                                                            شد
                                                        </p>
                                                    </div>

                                                    <div class="modal-footer modal-footer--center">
                                                        <div class="uk-flex">
                                                            <button
                                                                class="modal-footer__btn modal-footer__btn--confirm modal-footer__btn--wide js-modal-uploads-confirm js-accept"
                                                                type="button">
                                                                بله،‌ مطمئن هستم
                                                            </button>
                                                            <button
                                                                class="modal-footer__btn modal-footer__btn--wide uk-modal-close js-decline"
                                                                type="button">انصراف
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="c-content-accordion__row js-content-section uk-open"
                                                 id="stepProductAccordion">
                                            <h2 class="c-content-accordion__title">
                                                <div class="c-content-accordion__title-text">گام دوم: درج اطلاعات
                                                    کالا
                                                </div>
                                            </h2>
                                            <div class="c-content-accordion__content" id="stepProductContainer">
                                                <div class="c-card__body c-card__body--content">
                                                    <form id="stepProductForm">
                                                        <input type="hidden" id="selectedCategoryId" value=""/>
                                                        <input type="hidden" id="selectedCategoryTheme" value=""/>
                                                        <input type="hidden" name="product[category_id]"
                                                               id="selectedCategoryIdConfirmed"
                                                               value="9588"/>
                                                        <input type="hidden" id="selectedCategoryThemeConfirmed"
                                                               value="sized"/>
                                                        <input type="hidden" name="product[product_id]"
                                                               value="{{ $product->id }}"
                                                               id="productIdContainer"/>
                                                        <ul id="ajaxErrorProduct"
                                                            class="c-content-error c-content-error--list hidden">
                                                        </ul>
                                                        <ul id="moderationErrorProduct"
                                                            class="c-content-error c-content-error--list hidden">
                                                            <li class="c-content-error__item">
                                                            </li>
                                                        </ul>
                                                        <div class="c-grid__row c-grid__row--gap-lg js-auto-title-message ">
                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-12">
                                                                <div class="c-content-product__auto-title-msg">
                                                                    گروه کالایی انتخاب شده، دارای ویژگی اتوماتیک
                                                                    نامگذاری است و به صورت هوشمند با توجه به
                                                                    ورودی‌های شما در گام‌های اول تا سوم، بهترین
                                                                    عنوان کالایی مطابق با قوانین صحیح را در گام
                                                                    چهارم به شما پیشنهاد می‌دهد. در صورتی که
                                                                    نام‌گذاری از نظر شما تایید شده است، لطفا از کلید
                                                                    "تایید عنوان و ادامه" استفاده کنید؛ در غیر
                                                                    اینصورت با استفاده از کلید "ویرایش عنوان"، عنوان
                                                                    صحیح مدنظر خود را وارد کنید. توجه داشته باشید در
                                                                    صورتی که عنوان ورودی از سمت شما خالی باشد، عنوان
                                                                    پیشنهادی برای عنوان اصلی کالای شما انتخاب خواهد
                                                                    شد.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="c-grid__row c-grid__row--gap-lg">
                                                            <div
                                                                class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-12">
                                                                <div class="c-content-product__selected-category">
                                                                    <div
                                                                        class="c-content-product__msg c-content-product__msg--focus">
                                                                        گروه کالایی انتخابی شما
                                                                        <span id="categoryTitleSpan"
                                                                              class="em"></span>
                                                                        و تنوع مجاز برای این گروه کالایی
                                                                        <span id="categoryThemeTranslatedSpan"
                                                                              class="em">سایز</span>
                                                                        است.
                                                                    </div>
                                                                    <div id="noteDimensionLevelProduct"
                                                                         class="c-content-product__msg c-content-product__msg--focus"
                                                                         style="display: none">
                                                                        ابعاد بسته‌بندی گروه کالایی
                                                                        <span name="categoryTitleSpan" class="em">جوراب نوزاد</span>
                                                                        بر اساس
                                                                        <span class="em">محصول</span>
                                                                        است. شما بایستی برای
                                                                        <span class="em">محصول</span>
                                                                        خود در همین گام ابعاد بسته‌بندی وارد کنید.
                                                                    </div>
                                                                    <div id="noteDimensionLevelItem"
                                                                         class="c-content-product__msg c-content-product__msg--focus"
                                                                         style="display: none">
                                                                        ابعاد بسته‌بندی گروه کالایی
                                                                        <span name="categoryTitleSpan" class="em">جوراب نوزاد</span>
                                                                        بر اساس
                                                                        <span class="em">تنوع</span>
                                                                        است. شما بایستی برای هر
                                                                        <span class="em">تنوع</span>
                                                                        در صفحه ایجاد تنوع (مرحله بعدی)، ابعاد
                                                                        بسته‌بندی را وارد کنید.
                                                                    </div>
                                                                    <div class="c-content-product__msg"
                                                                         id="categoryThemeDescriptionSpan">
                                                                        <strong>تنوع سایز: </strong>تنوع سایز برای
                                                                        کالاهایی استفاده می‌شود که ظاهر مشابه دارند
                                                                        اما در سایزهای مختلف فروخته می‌شوند. از این
                                                                        تنوع برای درج کالاهایی مثل انواع لباس
                                                                        استفاده می‌شود. لباس‌ها ظاهری یکسان دارند
                                                                        اما بر اساس سایز طبقه‌بندی می‌شوند و قرار
                                                                        دادن آن‌ها در یک محصول می‌تواند فرآیند
                                                                        انتخاب را برای خریدار ساده‌تر کند.

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="c-grid__row c-grid__row--gap-lg">
                                                            <div
                                                                class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-4 c-grid__col--xs-gap">
                                                                <label for="productIsFake"
                                                                       class="uk-form-label"
                                                                       id="productIsFakeContainerLabel">
                                                                    اصالت کالا:
                                                                </label>

                                                                <div
                                                                    class="field-wrapper field-wrapper--justify field-wrapper--background">
                                                                    <label
                                                                        class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto"
                                                                        id="productIsFakeLabel">
                                                                        <input type="checkbox" class="c-ui-checkbox__origin"
                                                                               name="product[fake]" id="productIsFake" value="1"
                                                                               data-brand-other-id="0" {{ ($product->brand_id == 0 )? 'checked' : '' }}>
                                                                        <span class="c-ui-checkbox__check"></span>
                                                                        <span class="c-ui-checkbox__label">
                                                                    نشان کالای غیراصل
                                                                    (<span class="c-ui-checkbox__strong">غیر اصل</span>)
                                                                </span>
                                                                    </label>

                                                                    <div class="c-wiki c-wiki__holder">
                                                                        <span class="c-wiki-sign js-tooltip"
                                                                            data-tooltip="با انتخاب این گزینه، کلمه “غیراصل” در
                                                                             کنار عنوان کالا و نشان “غیراصل” در کنار
                                                                             تصویر کالای شما در سایت قرار خواهد گرفت. برند کالا
                                                                             باید “متفرقه” درج شود.   در صورت فروش کالای غیراصل بدون
                                                                            این نشان، مطابق با قوانین جریمه خواهید شد."></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-4 c-grid__col--xs-gap">
                                                                <label for=""
                                                                       class="uk-form-label uk-flex uk-flex-between">
                                                                    برند یا نام سازنده کالا:
                                                                    <span class="uk-form-label__required"></span>
                                                                    <a href="{{ route('staff.brands.create') }}"
                                                                       target="_blank" class="search-link">ایجاد
                                                                        برند جدید</a>
                                                                </label>
                                                                <div
                                                                    class="field-wrapper ui-select ui-select__container">
                                                                    <select name="product[brand_id]"
                                                                            id="brandsSelect"
                                                                            class="uk-input uk-input--select js-select-origin"
                                                                            required>
                                                                        <option value="">برند کالا را انتخاب کنید</option>
                                                                        <option value="0" {{ ($product->brand_id == 0 )? 'selected' : '' }}>متفرقه (Miscellaneous)</option>
                                                                        @foreach($parent_category->brands as $brand)
                                                                            <option value="{{ $brand->id }}" {{ ($product->brand_id == $brand->id )? 'selected' : '' }}>{{ $brand->name }}
                                                                                ({{ $brand->en_name }})
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div class="js-select-options"></div>
                                                                </div>
                                                                <div>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-4 c-grid__col--xs-gap">
                                                                <label for="" class="uk-form-label">
                                                                    ماهیت کالا:
                                                                    <span class="uk-form-label__required"></span>
                                                                </label>
                                                                <div class="field-wrapper">
                                                                    <label class="c-content-input">
                                                                        <input type="text"
                                                                               placeholder="مثلا: گوشی موبایل"
                                                                               value="{{ $product->nature }}"
                                                                               class="uk-input js-model-field title-creator"
                                                                               name="product[product_nature]">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="c-grid__row c-grid__row--gap-lg">
                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-4 ">
                                                                <label for="" class="uk-form-label uk-flex uk-flex-between">
                                                                    نوع کالا:
                                                                    <span class="uk-form-label__required"></span>
                                                                </label>

                                                                <div class="field-wrapper ui-select ui-select__container ui-select__container--product">
                                                                    <select name="product[types][]"
                                                                            id="categoryProductTypesSelect"
                                                                            class="uk-input uk-input--select js-select-origin js-in-product"
                                                                            {{ (count($product->category[0]->types) == 0)? 'disabled' : '' }}
                                                                            multiple="multiple">
                                                                        <option value="">نوع کالا را انتخاب کنید
                                                                        </option>
                                                                        @php
                                                                            if(isset($product->type) && !is_null($product->type)) {
                                                                              foreach ($product->type as $type)
                                                                              {
                                                                                  $this_product_types [] = $type->id;
                                                                              }
                                                                            }
                                                                        @endphp

                                                                        @if(isset($product->type) && !is_null($product->type))
                                                                            @foreach($product->category[0]->types as $type)
                                                                                <option
                                                                                    value="{{ $type->id }}" {{ (in_array($type->id, $this_product_types))? 'selected' : '' }}>{{ $type->name }}</option>
                                                                            @endforeach
                                                                        @endif

                                                                    </select>
                                                                    <span class="select-counter"></span>
                                                                    <div class="js-select-options"></div>
                                                                </div>

                                                                <div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-4 c-grid__col--xs-gap  js-product-model">
                                                                <label for="" class="uk-form-label">مدل کالا:
                                                                    <span class="uk-form-label__required"></span>
                                                                </label>
                                                                <div class="field-wrapper">
                                                                    <input type="text"
                                                                           placeholder="مدل کالا را وارد کنید …"
                                                                           value="{{ $product->model }}"
                                                                           class="uk-input js-model-field"
                                                                           name="product[model]">
                                                                </div>
                                                                <div>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial o-spacing-m-t-4 c-grid__col--sm-4 ">
                                                                <label for=""
                                                                       class="uk-form-label uk-flex uk-flex-between">
                                                                    مبدا کالا:
                                                                </label>
                                                                <div
                                                                    class="field-wrapper ui-select ui-select__container ui-select__container--product">
                                                                    <select name="product[is_iranian]"
                                                                            id="isIranian"
                                                                            class="uk-input uk-input--select js-select-origin js-in-product">
                                                                        <option value="" {{ ($product->is_iranian == '' )? 'selected' : '' }}>انتخاب کنید</option>
                                                                        <option value="1" {{ ($product->is_iranian == 1 )? 'selected' : '' }}>
                                                                            ایرانی
                                                                        </option>
                                                                        <option value="2" {{ ($product->is_iranian == 2 )? 'selected' : '' }}>
                                                                            خارجی
                                                                        </option>
                                                                    </select>
                                                                    <span class="select-counter"></span>
                                                                    <div class="js-select-options"></div>
                                                                </div>
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="c-grid__row c-grid__row--gap-lg js-product-package-dimension">
                                                            <div
                                                                class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-8 ">
                                                                <div
                                                                    class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                                                                    <div
                                                                        class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6">
                                                                        <label for="" class="uk-form-label">
                                                                            ابعاد بسته‌بندی (سانتیمتر):
                                                                            <span
                                                                                class="uk-form-label__required"></span>
                                                                        </label>
                                                                        <div
                                                                            class="c-grid__row c-grid__row--gap-small c-grid__row--nowrap-sm">
                                                                            <div
                                                                                class=" c-grid__col c-grid__col--gap-small c-grid__col--flex-initial">
                                                                                <div class="field-wrapper">
                                                                                    <label class="c-content-input">
                                                                                <span
                                                                                    class="c-content-input__text c-content-input__text--overlay">طول</span>
                                                                                        <input type="text"
                                                                                               placeholder=""
                                                                                               class="c-content-input__origin c-content-input__origin--overlay"
                                                                                               value="{{ $product->length }}"
                                                                                               name="product[package_length]">
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class=" c-grid__col c-grid__col--gap-small c-grid__col--flex-initial c-grid__col--xs-gap">
                                                                                <div class="field-wrapper">
                                                                                    <label class="c-content-input">
                                                                                <span
                                                                                    class="c-content-input__text c-content-input__text--overlay">عرض</span>
                                                                                        <input type="text"
                                                                                               placeholder=""
                                                                                               class="c-content-input__origin c-content-input__origin--overlay"
                                                                                               value="{{ $product->width }}"
                                                                                               name="product[package_width]">
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class=" c-grid__col c-grid__col--gap-small c-grid__col--flex-initial c-grid__col--xs-gap">
                                                                                <div class="field-wrapper">
                                                                                    <label class="c-content-input">
                                                                                <span
                                                                                    class="c-content-input__text c-content-input__text--overlay">ارتفاع</span>
                                                                                        <input type="text"
                                                                                               placeholder=""
                                                                                               class="c-content-input__origin c-content-input__origin--overlay"
                                                                                               value="{{ $product->height }}"
                                                                                               name="product[package_height]">
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--xs-gap">
                                                                        <label for="" class="uk-form-label">
                                                                            وزن بسته‌بندی (گرم):
                                                                            <span
                                                                                class="uk-form-label__required"></span>
                                                                        </label>
                                                                        <div class="field-wrapper">
                                                                            <label class="c-content-input">
                                                                        <span
                                                                            class="c-content-input__text c-content-input__text--overlay">وزن</span>
                                                                                <input type="text" placeholder=""
                                                                                       class="c-content-input__origin c-content-input__origin--overlay"
                                                                                       value="{{ $product->weight }}"
                                                                                       name="product[package_weight]">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="c-grid__row c-grid__row--gap-lg">
                                                            <div
                                                                class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                                                <label for="" class="uk-form-label">
                                                                    شرح کالا:
                                                                </label>
                                                                <div class="field-wrapper field-wrapper--textarea enabled">
                                                                    <textarea name="product[description]"
                                                                            placeholder="برای معرفی بهتر کالا به مشتریان، پیشنهاد می‌‌شود 150 کلمه درباره‌ کالای خود بنویسید."
                                                                            class="c-content-input__origin c-content-input__origin--textarea js-textarea-words"
                                                                            rows="5"
                                                                            maxlength="2000"
                                                                    >{{ $product->description }}</textarea>
                                                                    <span class="textarea__wordcount">
                                                                    <span class="js-wordcount-target">0</span>/2000
                                                                </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="c-grid__row c-grid__row--gap-lg">
                                                            <div
                                                                class="c-grid__col c-grid__col--gap-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                                                <label for="" class="uk-form-label">
                                                                    نقاط قوت:
                                                                </label>
                                                                <div class="field-wrapper field-wrapper--textarea">
                                                                    <div class="c-ui-tag__textarea c-ui-tag__textarea--inline js-textarea-tags">
                                                                        <input type="text"
                                                                               class="js-textarea-tags-pros c-ui-tag__input c-ui-tag__input--inline">
                                                                        <button type="button" class="c-ui-tag__submit js-tag-submit-btn">+</button>
                                                                    </div>
                                                                    <div class="c-ui-tag__textarea js-textarea-tags-container"></div>
                                                                    <select name="product[advantages][]" multiple=""
                                                                            class="js-textarea-tags-select c-ui-tag__select" required="">
                                                                        @if(isset($product->advantages) && !is_null($product->advantages))
                                                                            @foreach(json_decode($product->advantages, true) as $advantage)
                                                                            <option value="{{ $advantage }}" selected="selected">{{ $advantage }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                <div>
                                                                </div>
                                                            </div>
                                                            <div class="c-grid__col c-grid__col--gap-attr c-grid__col--flex-initial c-grid__col--sm-6 c-grid__col--xs-gap">
                                                                <label for="" class="uk-form-label">
                                                                    نقات ضعف:
                                                                </label>
                                                                <div class="field-wrapper field-wrapper--textarea">
                                                                    <div class="c-ui-tag__textarea c-ui-tag__textarea--inline js-textarea-tags">
                                                                        <input type="text"
                                                                               class="js-textarea-tags-cons c-ui-tag__input c-ui-tag__input--inline">
                                                                        <button type="button" class="c-ui-tag__submit js-tag-submit-btn">+</button>
                                                                    </div>
                                                                    <div class="c-ui-tag__textarea js-textarea-tags-container"></div>
                                                                    <select name="product[disadvantages][]" multiple=""
                                                                            class="js-textarea-tags-select c-ui-tag__select" required="">
                                                                        @if(isset($product->disadvantages) && !is_null($product->disadvantages))
                                                                            @foreach(json_decode($product->disadvantages, true) as $disadvantage)
                                                                                <option value="{{ $disadvantage }}" selected="selected">{{ $disadvantage }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="c-grid__row c-grid__row--gap-lg js-step-product-title uk-hidden">
                                                            <input type="text" name="product[title_fa]" value="{{ $product->title_fa }}">
                                                            <input type="text" name="product[title_en]" value="{{ $product->title_en }}">

                                                            <input type="text" name="product[suggest_slug]" value="">
                                                            <input type="text" name="product[slug]" value="{{ $product->slug }}">

                                                            <input type="text" name="product[suggest_seo_title]" value="">
                                                            <input type="text" name="product[seo_title]" value="{{ $product->seo_title }}">

                                                            <input type="text" name="product[seo_keyword_meta]" value="{{ $product->seo_keyword_meta }}">
                                                            <input type="text" name="product[seo_description_meta]" value="{{ $product->seo_description_meta }}">
                                                            <input type="text" name="product[seo_custom_meta]" value="{{ $product->seo_custom_meta }}">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="c-content-accordion__step-controls">
                                                    <button class="c-ui-btn c-ui-btn--next mr-a hidden"
                                                            id="productStepNext">
                                                        ادامه دادن
                                                    </button>
                                                </div>
                                                <div class="c-content-loader c-content-loader--fixed">
                                                    <div class="c-content-loader__logo"></div>
                                                    <div class="c-content-loader__spinner"></div>
                                                </div>
                                            </div>
                                            <div class="c-content-progress active">
                                                <span class="c-content-progress__step"></span>
                                            </div>
                                            <div id="confirmFakeSelectionBrandChangeModal"
                                                 class="marketplace-redesign" uk-modal>
                                                <div class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body">
                                                    <button class="uk-modal-close uk-modal-close--search"
                                                            type="button" uk-close></button>

                                                    <div class="modal-product modal-product--confirm">
                                                        <h2 class="modal-message--title">اگر نمایش عدم اصالت کالا را
                                                            انتخاب کنید</h2>
                                                        <p class="modal-message--center">برند به "متفرقه" تغییر
                                                            خواهد کرد، اطمینان دارید؟</p>
                                                    </div>

                                                    <div class="modal-footer modal-footer--center">
                                                        <div class="uk-flex">
                                                            <button
                                                                class="modal-footer__btn modal-footer__btn--confirm modal-footer__btn--wide js-modal-uploads-confirm js-accept"
                                                                type="button">
                                                                بله،‌ مطمئن هستم
                                                            </button>
                                                            <button
                                                                class="modal-footer__btn modal-footer__btn--wide uk-modal-close js-decline"
                                                                type="button">انصراف
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="newBrandRequestModal"
                                                 class="marketplace-redesign uk-modal c-variant" uk-modal>
                                                <div
                                                    class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body c-content-modal"
                                                    id="newBrandRequestModalContent">
                                                    <button class="uk-modal-close uk-modal-close--search"
                                                            type="button" uk-close></button>
                                                    <form id="newBrandRequestForm">
                                                        <input type="hidden" name="brand[product_id]" value="">
                                                        <input type="hidden" name="brand[category_id]"
                                                               id="newBrandRequestCategoryIdContainer">
                                                        <div
                                                            class="c-content-modal__header c-content-modal__header--overflow">
                                                            <h3 class="c-content-modal__title"> درخواست ایجاد برند
                                                                جدید</h3>
                                                            <a href="{{ route('staff.brands.create') }}"
                                                               class="search-link">ایجاد برند جدید</a>

                                                        </div>
                                                        <div
                                                            class="c-content-modal__body c-content-modal__body--overflow">
                                                            <div class="c-content-modal__body-container">
                                                                <div class="c-content-modal__intro">فروشگاه اینترنتی
                                                                    دیجی‌کالا این امکان را برای فروشنده فراهم
                                                                    کرده
                                                                    تا کالایش را با برند (نام
                                                                    تجاری) خودش نمایش دهد و به فروش برساند. برای
                                                                    ایجاد و ثبت برندتان، فرم زیر را تکمیل کنید.
                                                                </div>
                                                                <div class="c-content-modal__notes">
                                                            <span
                                                                class="c-content-modal__notes-title">توجه:</span>
                                                                    <ul class="c-content-modal__notes-list">
                                                                        <li>نام برند مورد نظرتان را وارد کنید و
                                                                            درصورتی‌که برند را در این لیست پیدا
                                                                            نکردید، در صفحه‌ی درخواست برند، برند
                                                                            مورد نظرتان را جست‌و‌جو کرده و در صورت
                                                                            یافتن آن، روی دکمه‌ی افزودن برند به گروه
                                                                            کالایی کلیک کنید.
                                                                        </li>
                                                                        <li>چنانچه، برند مورد نظر در این لیست وجود
                                                                            نداشت، برای ساخت برند جدید، اطلاعات ذکر
                                                                            شده در این صفحه را ارسال کنید.
                                                                        </li>
                                                                        <li class="c-content-modal__notes-item">-
                                                                            برندهای ایرانی باید گواهی ثبت علامت
                                                                            تجاری
                                                                            داشته باشند و تصویر آن را باید همراه با
                                                                            درخواست در فرم ارسال فرمایید.
                                                                        </li>
                                                                        <li class="c-content-modal__notes-item">-
                                                                            برندهای ایرانی که دارای گواهی ثبت علامت
                                                                            تجاری
                                                                            نیستند، ثبت نمی‌شوند.
                                                                        </li>
                                                                        <li class="c-content-modal__notes-item">-
                                                                            برای ثبت برند، اظهار نامه‌ قابل قبول
                                                                            نیست و
                                                                            حتما باید گواهی ثبت برند را ارسال
                                                                            کنید.
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div
                                                                    class="c-variant-error hidden c-variant-error__box c-variant-error__box--modal mt-20 mb-20"
                                                                    id="ajaxBrandErrorsList">
                                                                </div>
                                                                <div class="c-grid__row c-grid__row--gap-lg mt-30">
                                                                    <div
                                                                        class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6">
                                                                        <label for="" class="uk-form-label">
                                                                            نام فارسی برند:
                                                                            <span
                                                                                class="uk-form-label__required"></span>
                                                                        </label>
                                                                        <div class="field-wrapper c-autosuggest">
                                                                            <div
                                                                                class="search-form__autocomplete js-autosuggest-box">
                                                                                <input id="searchKeywordInput"
                                                                                       class="uk-input js-prevent-submit"
                                                                                       type="text"
                                                                                       name="brand[name_fa]"
                                                                                       placeholder="نام فارسی برند را وارد کنید …"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6">
                                                                        <label for="" class="uk-form-label">
                                                                            نام انگلیسی برند:
                                                                            <span
                                                                                class="uk-form-label__required"></span>
                                                                        </label>
                                                                        <div class="field-wrapper c-autosuggest">
                                                                            <div
                                                                                class="search-form__autocomplete js-autosuggest-box">
                                                                                <input id="searchKeywordInput"
                                                                                       class="uk-input js-prevent-submit"
                                                                                       type="text"
                                                                                       name="brand[name_en]"
                                                                                       placeholder="عنوان انگلیسی برند …"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-grid__row c-grid__row--gap-lg">
                                                                    <div
                                                                        class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                                                        <label class="uk-form-label">
                                                                            شرح برند:
                                                                            <span
                                                                                class="uk-form-label__required"></span>
                                                                        </label>
                                                                        <div id="brandDescription"
                                                                             class="field-wrapper">
                <textarea name="brand[description]" class="uk-textarea" cols="" rows="3"
                          placeholder="توضیحات برند بهتر است بین ۷۰ تا ۱۰۰ کلمه درباره‌ی تاریخچه و محصولات برند باشد …"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-grid__row c-grid__row--gap-lg">
                                                                    <div
                                                                        class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--row-attr">
                                                                        <label class="uk-form-label">
                                                                            نوع برند:
                                                                            <span
                                                                                class="uk-form-label__required"></span>
                                                                        </label>
                                                                        <div id="brandOrigin" class="field-wrapper">
                                                                            <label
                                                                                class="c-ui-radio c-ui-radio--content c-ui-checkbox--auto">
                                                                                <input type="radio"
                                                                                       class="c-ui-radio__origin js-brand-origin"
                                                                                       name="brand[origin]"
                                                                                       value="iranian"
                                                                                       id="iranianBrandContainer"
                                                                                       checked>
                                                                                <span
                                                                                    class="c-ui-radio__check c-ui-radio__check--content"></span>
                                                                                <span
                                                                                    class="c-ui-radio__label c-ui-radio__label--content">ایرانی</span>
                                                                            </label>
                                                                            <label
                                                                                class="c-ui-radio c-ui-radio--content c-ui-checkbox--auto">
                                                                                <input type="radio"
                                                                                       class="c-ui-radio__origin js-brand-origin"
                                                                                       name="brand[origin]"
                                                                                       id="foreignBrandContainer"
                                                                                       value="foreign">
                                                                                <span
                                                                                    class="c-ui-radio__check c-ui-radio__check--content"></span>
                                                                                <span
                                                                                    class="c-ui-radio__label c-ui-radio__label--content">خارجی</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div id="foreignBrandContainer1"
                                                                         class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--row-attr hidden">
                                                                        <label class="uk-form-label">
                                                                            لینک سایت معتبر خارجی:
                                                                            <span
                                                                                class="uk-form-label__required"></span>
                                                                        </label>
                                                                        <div class="field-wrapper">
                                                                            <input name="brand[url]"
                                                                                   class="uk-input uk-input--ltr"
                                                                                   placeholder="http://">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-grid__row c-grid__row--gap-lg">
                                                                    <div id="iranianBrandContainer1"
                                                                         class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--row-attr">
                                                                        <label class="uk-form-label">
                                                                            برگه ثبت برند یا لینک سایت قوه قضاییه:
                                                                            <span
                                                                                class="uk-form-label__required"></span>
                                                                        </label>
                                                                        <div class="field-wrapper">
                                                                            <div id="newBrandSheetUpload"
                                                                                 for="brandRegistrationSheet"
                                                                                 class="c-content-modal__uploads-label empty">
                    <span uk-form-custom>
                        <input id="brandRegistrationSheet" type="file" class="hidden">
                    </span>
                                                                                <label for="brandRegistrationSheet"
                                                                                       class="c-content-modal__uploads-preview">
                                                                                    <img src=""
                                                                                         id="newBrandSheetUploadPreview"
                                                                                         class="c-content-modal__uploads-img"
                                                                                         alt="">
                                                                                    <span
                                                                                        class="c-content-upload__img-loader js-img-loader">
                            <span class="progress__wrapper">
                                <span class="progress"></span>
                            </span>
                        </span>
                                                                                </label>
                                                                                <span
                                                                                    class="c-content-modal__list c-content-modal__uploads-tooltips">
                        <span class="c-content-modal__uploads-text">ابعاد
                            برگه ثبت برند را با حداکثر حجم ۷۰۰ مگابایت و فرمت PNG یا JPEG  بارگذاری کنید.
                        </span>
                    </span>
                                                                            </div>
                                                                            <input type="hidden"
                                                                                   name="brand[registration_image_id]"
                                                                                   class="force-validation"
                                                                                   id="registrationImageTempId">
                                                                            <div
                                                                                class="c-content-modal__errors-full"
                                                                                id="newBrandRegistrationImageUploadErrors"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="iranianBrandLogo"
                                                                         class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--row-attr">
                                                                        <label class="uk-form-label">
                                                                            لوگوی برند:
                                                                            <span
                                                                                class="uk-form-label__required"></span>
                                                                        </label>
                                                                        <div class="field-wrapper">
                                                                            <div id="newBrandLogoUpload"
                                                                                 class="c-content-modal__uploads-label empty">
                    <span uk-form-custom>
                        <input id="brandLogoFile" type="file" class="hidden">
                    </span>
                                                                                <label for="brandLogoFile"
                                                                                       class="c-content-modal__uploads-preview">
                                                                                    <img src=""
                                                                                         id="newBrandLogoUploadPreview"
                                                                                         class="c-content-modal__uploads-img"
                                                                                         alt="">
                                                                                    <span
                                                                                        class="c-content-upload__img-loader js-img-loader">
                            <span class="progress__wrapper">
                                <span class="progress"></span>
                            </span>
                        </span>
                                                                                </label>
                                                                                <span
                                                                                    class="c-content-modal__list c-content-modal__uploads-tooltips">
                        <span class="c-content-modal__uploads-text">
                            لوگو برند را در ابعاد ۶۰۰×۶۰۰ پیکسل و با فرمت PNG یا JPEG و پس‌زمینه‌ی سفید بارگذاری کنید.
                        </span>
                    </span>
                                                                            </div>
                                                                            <input type="hidden"
                                                                                   name="brand[logo_id]"
                                                                                   class="force-validation"
                                                                                   id="logoImageTempId">
                                                                            <div
                                                                                class="c-content-modal__errors-full"
                                                                                id="newBrandLogoUploadErrors"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="iranianBrandContainer2"
                                                                         class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6">
                                                                        <label class="uk-form-label">
                                                                            یا لینک سایت قوه قضاییه را وارد کنید.
                                                                            لینک را به صورت کامل وارد کنید:
                                                                            <span
                                                                                class="uk-form-label__required"></span>
                                                                        </label>
                                                                        <div class="field-wrapper">
                                                                            <input name="brand[registration_url]"
                                                                                   type="text"
                                                                                   class="uk-input uk-input--ltr"
                                                                                   placeholder="http://"
                                                                                   id="registrationUrlValue">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="c-content-modal__footer c-content-modal__footer--overflow">
                                                            <button
                                                                class="modal-footer__btn modal-footer__btn--confirm modal-footer__btn--wide js-modal-uploads-confirm js-accept"
                                                                type="button" id="saveBrandRequestButton">
                                                                <span id="brandSuggestBtnLabel">افزودن برند به گروه کالایی</span>
                                                                <span id="brandRequestBtnLabel">ارسال درخواست</span>
                                                            </button>
                                                            <button
                                                                class="modal-footer__btn modal-footer__btn--wide"
                                                                type="button" id="resetBrandRequestBtn">انتخاب مجدد
                                                            </button>
                                                            <button
                                                                class="modal-footer__btn modal-footer__btn--wide uk-modal-close js-decline"
                                                                type="button" id="cancelBrandRequestButton">انصراف
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <div class="c-content-loader">
                                                        <div class="c-content-loader__logo"></div>
                                                        <div class="c-content-loader__spinner"></div>
                                                    </div>
                                                </div>
                                            </div>


                                        </section>
                                        <section class="c-content-accordion__row js-content-section uk-open"
                                                 id="stepAttributesAccordion">
                                            <h2 class="c-content-accordion__title">
                                                <div class="c-content-accordion__title-text">گام سوم: درج ویژگی‌های
                                                    کالا
                                                    {{--                                                        <span class="c-content-accordion__guid-line js-guideline-icon" data-guideline-modal="attributes"></span>--}}
                                                </div>
                                            </h2>
                                            <div class="c-content-accordion__content" id="stepAttributesContainer" style="min-height: auto;">
                                                <div class="c-card__body  c-card__body--content"
                                                     id="stepAttributesContent">
                                                    <form id="stepAttributesForm">

                                                        @foreach($attr_groups as $atrr_group)
                                                            <div class="c-grid__row c-grid__row--gap-lg">
                                                                <div
                                                                    class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                                                    <h3 class="product-form__section-title product-form__section-title--dot">{{ $atrr_group->name }}</h3>
                                                                </div>
                                                            </div>

                                                            <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr">

                                                                @foreach($atrr_group->attributes->sortBy('position') as $attribute)

                                                                    @if($attribute->type == 1)
                                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                                                            <label
                                                                                class="uk-form-label uk-flex uk-flex-between">
                                                                                {{ $attribute->name }}:

                                                                                @if($attribute->is_required)
                                                                                    <span class="uk-form-label__required"></span>
                                                                                @endif

                                                                            </label>
                                                                            <div class="field-wrapper">
                                                                                <input type="text" class="c-content-input__origin js-attribute-old-value
                                                                                    {{ ($attribute->is_required)? 'js-required-attribute' : '' }}"
                                                                                       name="attributes[{{$attribute->id}}]"
                                                                                       value="{{ (isset($product->attributes->find($attribute->id)->pivot->value))? $product->attributes->find($attribute->id)->pivot->value : ''  }}">
                                                                            </div>
                                                                            <div>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    @if($attribute->type == 2)
                                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-12">
                                                                                <label class="uk-form-label uk-flex uk-flex-between">
                                                                                    {{ $attribute->name }}:

                                                                                    @if($attribute->is_required)
                                                                                        <span class="uk-form-label__required"></span>
                                                                                    @endif

                                                                                </label>
                                                                                <div class="field-wrapper">
                                                                                <textarea class="uk-textarea uk-textarea--attr {{ ($attribute->is_required)? 'js-required-attribute' : '' }}"
                                                                                    name="attributes[{{$attribute->id}}]">{{ (isset($product->attributes->find($attribute->id)->pivot->value))? $product->attributes->find($attribute->id)->pivot->value : ''  }}</textarea>
                                                                                </div>
                                                                                <div>
                                                                                </div>
                                                                            </div>
                                                                    @endif

                                                                    @if($attribute->type == 3 )
                                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                                                            <label class="uk-form-label uk-flex uk-flex-between">
                                                                                {{ $attribute->name }}:
                                                                                @if($attribute->is_required)
                                                                                    <span class="uk-form-label__required"></span>
                                                                                @endif
                                                                            </label>

                                                                            <div class="field-wrapper ui-select ui-select__container">
                                                                                <select class="uk-input uk-input--select js-select-origin select2-hidden-accessible {{ ($attribute->is_required)? 'js-required-attribute' : '' }}"
                                                                                    name="attributes[{{$attribute->id}}]" data-placeholder="انتخاب کنید" tabindex="-1" aria-hidden="true">
                                                                                    <option value="">یکی از گزینه‌ها
                                                                                        را انتخاب کنید
                                                                                    </option>

                                                                                    <?php
                                                                                      if ($product->attributes->where('id', $attribute->id)->count()) {
                                                                                        $product_attr_val_id = $product->attributes->find($attribute->id)->pivot->value_id;
                                                                                      } else {
                                                                                        $product_attr_val_id = 0;
                                                                                      }
                                                                                    ?>

                                                                                    @foreach($attribute->values as $value)
                                                                                        <option value="{{ $value->id }}" {{ ($product_attr_val_id == $value->id)? 'selected' : ''  }} >{{ $value->value }}</option>
                                                                                    @endforeach

                                                                                </select>
                                                                                <div class="js-select-options"></div>
                                                                            </div>
                                                                            <div>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    @if($attribute->type == 4 )
                                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                                                            <label class="uk-form-label uk-flex uk-flex-between">
                                                                                {{ $attribute->name }}:

                                                                                @if($attribute->is_required)
                                                                                    <span class="uk-form-label__required"></span>
                                                                                @endif
                                                                            </label>

                                                                              <?php $array = []; ?>

                                                                            @foreach($product->attributes as $attr)
                                                                                @if(!is_null($attr->pivot->value_id))
                                                                                    @php $array[] = $attr->pivot->value_id;  @endphp
                                                                                @endif
                                                                            @endforeach


                                                                            <div class="field-wrapper ui-select ui-select__container ui-select__container--product">
                                                                                <select class="uk-input uk-input--select uk-input--checkboxlist js-select-origin js-in-product select2-hidden-accessible
                                                                                     {{ ($attribute->is_required)? 'js-required-attribute' : '' }}"
                                                                                        multiple="" name="attributes[{{$attribute->id}}][]" data-placeholder="انتخاب کنید"
                                                                                        tabindex="-1" aria-hidden="true"
                                                                                        aria-describedby="attributes[{{$attribute->id}}]-error"
                                                                                        aria-invalid="false">
                                                                                    @foreach($attribute->values as $value)
                                                                                        <option value="{{ $value->id }}" {{ in_array($value->id, $array) ? 'selected' :  '' }} >{{ $value->value }}</option>
                                                                                    @endforeach
                                                                                </select>

                                                                                <span class="select-counter"
                                                                                      style="display: none;">۰</span>
                                                                                <div
                                                                                    class="js-select-options"></div>
                                                                                <div id="attributes[33887][]-error"
                                                                                     class="error error-msg"
                                                                                     style="display: none;"></div>
                                                                            </div>
                                                                            <div>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    @if($attribute->type == 5)
                                                                            @if($attribute->unit->type == 0)
                                                                                <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                                                                    <label class="uk-form-label uk-flex uk-flex-between">
                                                                                        {{ $attribute->name }}:

                                                                                        @if($attribute->is_required)
                                                                                            <span class="uk-form-label__required"></span>
                                                                                        @endif

                                                                                        <span class="uk-float-left uk-padding-medium-left">{{ $attribute->unit->name }}</span>
                                                                                    </label>
                                                                                    <div class="field-wrapper">
                                                                                        <input type="text" class="c-content-input__origin js-attribute-old-value
                    {{ ($attribute->is_required)? 'js-required-attribute' : '' }}" name="attributes[{{$attribute->id}}]" value="{{ (isset($product->attributes->find($attribute->id)->pivot->value))? $product->attributes->find($attribute->id)->pivot->value : ''  }}">
                                                                                    </div>
                                                                                </div>
                                                                            @else

                                                                                @foreach(\Modules\Staff\Attribute\Models\AttributeProduct::where('attribute_id', $attribute->id)->get() as $item)
                                                                                    @php
                                                                                        $unit_val_array[$item->unit_value_id] = $item->value;
                                                                                    @endphp
                                                                                @endforeach

                                                                                <div class="c-grid__col c-grid__col--gap-attr c-grid__col--flex-initial c-grid__col--lg-6">
                                                                                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                                                                                        <div class="c-grid__col c-grid__col--gap-attr c-grid__col--flex-initial c-grid__col--lg-12">
                                                                                            <label for="" class="uk-form-label">
                                                                                                {{ $attribute->name }}:
                                                                                                @if($attribute->is_required)
                                                                                                    <span class="uk-form-label__required"></span>
                                                                                                @endif
                                                                                            </label>
                                                                                            <div class="c-grid__row c-grid__row--gap-small c-grid__row--nowrap-sm">
                                                                                                @foreach($attribute->unit->values as $value)
                                                                                                    <div class=" c-grid__col c-grid__col--gap-small c-grid__col--flex-initial c-grid__col--xs-gap">
                                                                                                        <div class="field-wrapper">
                                                                                                            <label class="c-content-input">
                                                                                                                <span class="c-content-input__text c-content-input__text--overlay">{{ $value->value }}</span>
                                                                                                                <input type="text" placeholder="" class="c-content-input__origin c-content-input__origin--overlay {{ ($attribute->is_required)? 'js-required-attribute' : '' }}" name="attributes[{{$attribute->id}}][{{$value->id}}]"
                                                                                                                       value="{{ (!is_null($unit_val_array[$value->id]))? $unit_val_array[$value->id] : ''  }}">
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                    @endif

                                                                @endforeach

                                                            </div>
                                                        @endforeach
                                                        @if(!$attr_groups->count())
                                                            <div
                                                                class="c-grid__row c-grid__row--gap-lg js-auto-title-message">
                                                                <div
                                                                    class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-12">
                                                                    <div class="c-content-product__auto-title-msg">
                                                                        برای این گروه کالایی شما هیچ ویژگی ایجاد
                                                                        نکرده‌اید پیشنهاد می‌شود حتما ابتدا برای
                                                                        دسته‌بندی‌ها ویژگی ایجاد کنید سپس اقدام به
                                                                        ایجاد محصول کنید و یا پس از ذخیره این صفحه و
                                                                        ایجاد ویژگی برای آن نسبت به ویرایش محصول
                                                                        اقدام کنید.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div
                                                            class="c-content-accordion__step-controls c-content-accordion__step-controls--spacer">
                                                            <button
                                                                class="c-ui-btn c-ui-btn--next mr-a goToTitleStep"
                                                                id="attributesStepNext">
                                                                ادامه دادن
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="c-content-loader c-content-loader--fixed">
                                                    <div class="c-content-loader__logo"></div>
                                                    <div class="c-content-loader__spinner"></div>
                                                </div>
                                            </div>
                                            <div class="c-content-progress active">
                                                <span class="c-content-progress__step"></span>
                                            </div>
                                        </section>
                                        <section class="c-content-accordion__row js-content-section uk-open"
                                                 id="stepTitleAccordion">
                                            <h2 class="c-content-accordion__title">
                                                <div class="c-content-accordion__title-text js-step-title-header">
                                                    گام چهارم: عنوان پیشنهادی و سئو
                                                    {{--                                                        <span class="c-content-accordion__guid-line js-guideline-icon" data-guideline-modal="auto_title"></span>--}}
                                                </div>
                                            </h2>
                                            <div
                                                class="c-content-accordion__content c-content-accordion__content--small"
                                                id="stepTitleContainer">
                                                <div class="c-card__body  c-card__body--content"
                                                     id="stepTitleContent">
                                                    <form id="titleForm">
                                                        <div class="c-grid__row c-grid__row--gap-lg" style="margin-bottom: 25px;">
                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                                                <h3 class="product-form__section-title product-form__section-title--dot">عنوان کالا</h3>
                                                            </div>
                                                        </div>
                                                        <ul id="ajaxErrorTitle"
                                                            class="c-content-error c-content-error--list hidden">
                                                        </ul>
                                                        <ul id="moderationErrorTitle"
                                                            class="c-content-error c-content-error--list hidden">
                                                            <li class="c-content-error__item">
                                                            </li>
                                                        </ul>
                                                        <div class="c-grid__row c-grid__row--gap-lg">
                                                            <div
                                                                class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6">
                                                                <label for="" class="uk-form-label">
                                                                    نام فارسی پیشنهادی کالا:
                                                                </label>
                                                                <div class="field-wrapper">
                                                                    <input value="" class="c-content-input__origin c-ui-input--deactive js-suggested-title-fa js-edit-mode-suggested-title-fa persian-title" disabled/>
                                                                </div>
                                                            </div>

                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--xs-gap">
                                                                <label for="" class="uk-form-label">نام انگلیسی
                                                                    پیشنهادی کالا:</label>
                                                                <div class="field-wrapper">
                                                                    <input value="" class="c-content-input__origin c-ui-input--deactive js-suggested-title-en js-edit-mode-suggested-title-en" disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="c-grid__row c-grid__row--gap-lg  js-edite-title-suggested" data-edit-mode="true" data-status="approved">
                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6">
                                                                <label for="" class="uk-form-label">
                                                                    نام فارسی کالا:
                                                                </label>
                                                                <div class="field-wrapper">
                                                                    <input type="text" placeholder="شیوه نامگذاری صحیح کالا : ماهیت کالا + برند + کلمه مدل+مدل کالا" class="c-content-input__origin js-suggested-title-fa js-edit-mode-title-fa"
                                                                           value="{{ $product->title_fa }}" name="title[title_fa]" required>
                                                                </div>
                                                                <div>
                                                                </div>
                                                            </div>


                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--xs-gap">
                                                                <label for="" class="uk-form-label">
                                                                    نام انگلیسی کالا:
                                                                </label>
                                                                <div class="field-wrapper">
                                                                    <input type="text" placeholder="Syntax for naming product : Brand+Model+Division" class="c-content-input__origin js-suggested-title-en js-edit-mode-title-en" value="{{ $product->title_en }}" name="title[title_en]">
                                                                </div>
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- seo section  -->
                                                        <div class="c-grid__row c-grid__row--gap-lg" style="margin-bottom: 25px;">
                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                                                <h3 class="product-form__section-title product-form__section-title--dot">نامک</h3>
                                                            </div>
                                                        </div>

                                                        <div class="c-grid__col c-grid__col--gap-lg">
                                                            <label class="uk-form-label uk-flex uk-flex-between">نامک پیشنهادی:</label>
                                                            <div class="field-wrapper" style="margin-bottom: 15px;">
                                                                <input type="text" name="suggest_slug" class="c-content-input__origin c-ui-input--deactive url-inputs suggest_slug" dir="ltr" disabled>
                                                                <input type="button" id="button-urls" style="width: auto;" class="c-ui-tag__submit button-urls" value="/{{ $site_url }}/product/{{ strtolower($product_code_prefix) }}-{{ $product->product_code }}">
                                                            </div>
                                                        </div>

                                                        <div class="c-grid__col c-grid__col--gap-lg">
                                                            <label class="uk-form-label uk-flex uk-flex-between">نامک:</label>
                                                            <div class="field-wrapper" style="margin-bottom: 15px;">
                                                                <input type="text" name="slug" class="c-content-input__origin url-inputs" dir="ltr" value="{{ $product->slug }}">
                                                                <input type="button" id="button-urls" style="width: auto;" class="c-ui-tag__submit button-urls" value="/{{ $site_url }}/product/{{ strtolower($product_code_prefix) }}-{{ $product->product_code }}">
                                                            </div>
                                                        </div>

                                                        <div class="c-grid__row c-grid__row--gap-lg" style="margin-bottom: 25px;">
                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                                                <h3 class="product-form__section-title product-form__section-title--dot">عنوان سئو:</h3>
                                                            </div>
                                                        </div>

                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-12">
                                                            <label class="uk-form-label uk-flex uk-flex-between">
                                                                عنوان سئو پیشنهادی:
                                                            </label>
                                                            <div class="field-wrapper">
                                                                <input name="suggest_seo_title" type="text" class="c-content-input__origin c-ui-input--deactive suggest_seo_title" value="" disabled>
                                                            </div>
                                                            <div>
                                                            </div>
                                                        </div>

                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-12">
                                                            <label class="uk-form-label uk-flex uk-flex-between">
                                                                عنوان سئو:
                                                            </label>
                                                            <div class="field-wrapper">
                                                                <input type="text" name="seo_title" class="c-content-input__origin js-suggested-title-fa js-edit-mode-title-fa" value="{{ ($product->seo()->exists())? $product->seo->title : '' }}">
                                                            </div>
                                                            <div>
                                                            </div>
                                                        </div>

                                                        <div class="c-grid__row c-grid__row--gap-lg" style="margin-bottom: 25px;">
                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                                                <h3 class="product-form__section-title product-form__section-title--dot">سایر</h3>
                                                            </div>
                                                        </div>

                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-12">
                                                            <label class="uk-form-label uk-flex uk-flex-between">
                                                                کلمات کلیدی
                                                            </label>
                                                            <div class="field-wrapper">
                                                                <input name='seo_keyword_meta' value="{{ ($product->seo()->exists())? $product->seo->keyword : '' }}">
                                                            </div>
                                                            <div>
                                                            </div>
                                                        </div>

                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-12">
                                                            <label class="uk-form-label uk-flex uk-flex-between">
                                                                متا توضیحات (meta description):
                                                            </label>

                                                            <div class="field-wrapper">
                                                                <textarea class="uk-textarea uk-textarea--attr" name="seo_description_meta">{{ ($product->seo()->exists())? $product->seo->description : '' }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-12">
                                                            <label class="uk-form-label uk-flex uk-flex-between">
                                                                متا تگ‌های سفارشی (Code):
                                                            </label>

                                                            <div class="field-wrapper">
                                                                <textarea class="uk-textarea uk-textarea--attr" name="seo_custom_meta" placeholder='<meta name="robots" content="index, follow">'>{{ ($product->seo()->exists())? $product->seo->custom_code : '' }}</textarea>
                                                            </div>
                                                        </div>
                                                        <!-- end seo section  -->

                                                    </form>
                                                    <div class="c-content-accordion__step-controls c-content-accordion__step-controls--spacer">
                                                        <button class="c-ui-btn c-ui-btn--gray uk-hidden disabled"
                                                                id="cancelEditSubjectSuggested">
                                                            انصراف
                                                        </button>
                                                        <button
                                                            class="c-ui-btn c-ui-btn--outline-blue hidden disabled"
                                                            id="editSubjectSuggested">
                                                            ویرایش عنوان
                                                        </button>
                                                        <button class="c-ui-btn c-ui-btn--next hidden disabled"
                                                                id="setSubjectStepNext">
                                                            تأیید عنوان و ادامه
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="c-content-loader c-content-loader--fixed">
                                                    <div class="c-content-loader__logo"></div>
                                                    <div class="c-content-loader__spinner"></div>
                                                </div>
                                            </div>
                                            <div class="c-content-progress active">
                                                <span class="c-content-progress__step"></span>
                                            </div>
                                        </section>
                                        <section class="c-content-accordion__row js-content-section uk-open"
                                                 id="stepImagesAccordion">
                                            <h2 class="c-content-accordion__title ">
                                                <div class="c-content-accordion__title-text">
                                                    <span class="js-step-images-header">
                                                    گام پنجم: بارگذاری تصاویر
                                                    </span>
                                                </div>
                                            </h2>
                                            <div
                                                class="c-content-accordion__content c-content-accordion__content--last"
                                                id="stepImagesContainer">
                                                <div class="c-card__body c-card__body--content marketplace-redesign"
                                                     id="stepImagesContent">
                                                    <form id="stepImagesForm">
                                                        <div id="imagesSelfServiceContainer"
                                                             class="c-grid__row c-grid__row--gap-lg">
                                                            <div class="c-grid__col">
                                                                <fieldset class="c-content-upload">
                                                                    <legend class="c-content-upload__title">تصویر
                                                                        اصلی و گالری تصاویر
                                                                    </legend>
                                                                    <div>
                                                                        <label class="c-content-upload__trigger"
                                                                               id="uploadGalleryContainer">
                                                                            <div uk-form-custom>
                                                                                <input type="file" multiple
                                                                                       class="hidden">
                                                                            </div>
                                                                            <span class="c-content-upload__ui-btn">بارگذاری تصاویر</span>
                                                                            <ul class="c-content-upload__list c-content-upload__list--tooltips">
                                                                                <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                                                                    ابعاد
                                                                                    تصویر بهتر است در بازه ۶۰۰x۶۰۰ تا
                                                                                    ۲۵۰۰x۲۵۰۰ و حجم آن کمتر از
                                                                                    ۶ مگابایت باشد.
                                                                                </li>
                                                                                <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                                                                    کالا
                                                                                    بهتر است
                                                                                    ۸۵٪ کل تصویر را در برگیرد و پس
                                                                                    زمینه تصویر اصلی کاملاً
                                                                                    سفید باشد.
                                                                                </li>
                                                                                <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                                                                    تصویر بهتر است مربعی باشد یا
                                                                                    ابعاد یک در یک داشته باشد
                                                                                </li>
                                                                                <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                                                                    امکان آپلود چندین تصویر به صورت
                                                                                    همزمان وجود دارد
                                                                                </li>
                                                                                <li class="c-content-upload__list-item c-content-upload__list-item--tooltips">
                                                                                    امکان تغییر ترتیب نمایش تصاویر
                                                                                    با کشیدن و رها کردن وجود دارد
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
                                                                                     id="imageErrorsContainer">
                                                                                </div>
                                                                                <div
                                                                                    class="hidden c-content-upload__error-msg"
                                                                                    id="mainImageErrorContainer">
                                                                                    می‌توانید با استفاده از
                                                                                    کلید<i></i> تصویر مورد نظرتان را
                                                                                    به عنوان تصویر اصلی کالا انتخاب
                                                                                    کنید.
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="imagesSection"
                                                                             class="c-content-upload__uploads js-uploaded-section">
                                                                            <h3 class="product-form__section-title product-form__section-title--gap">
                                                                                تصاویر بارگذاری شده
                                                                            </h3>
                                                                            <input type="hidden" name="images[order]" id="imagesOrderContainer"/>
                                                                            <ul id="imagesContainer"
                                                                                class="c-content-upload__gallery-list js-uploaded-list js-sortable-list">
                                                                                @foreach($product->media as $image)
                                                                                    <li class="c-content-upload__gallery-row js-uploads-row {{ ($image->pivot->is_main == 1)? 'primary' : '' }}" id="{{ $image->id }}">
                                                                                        <input type="hidden" class="js-image-id-input" name="images[images][]" value="{{ $image->id }}">
                                                                                        @if($image->pivot->is_main == 1)
                                                                                            <input type="hidden" name="images[main_image]" id="mainImageContainer"  value="{{$image->id}}"/>
                                                                                        @endif
                                                                                        <div class="c-content-upload__img-container">
                                                                                            <img src="{{ full_media_path($image) }}" alt="" class="c-content-upload__img">
                                                                                        </div>
                                                                                        <div class="c-content-upload__mid-container">
                                                                                            <div class="c-content-upload__mid-container--top">
                                                                                                <div class="c-content-upload__desc">
                                                                                                    <div class="c-content-upload__desc--top">
                                                                                                        <div class="right">
                                                                                                            <div class="c-content-upload__name"></div>
                                                                                                            <div class="c-content-upload__size"></div>
                                                                                                        </div>
                                                                                                        <div class="c-content-upload__select"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <ul class="c-content-upload__list c-content-upload__list--errors js-upload-error-list"></ul>
                                                                                        <div class="c-content-upload__controls">
                                                                                            <button type="button" class="c-content-upload__btn c-content-upload__btn--flag show js-flag-primary {{ ($image->pivot->is_main == 1)? 'checked' : '' }}"></button>
                                                                                            <button type="button" class="c-content-upload__btn c-content-upload__btn--remove show js-remove-upload"></button>
                                                                                            <button type="button" class="c-content-upload__btn c-content-upload__btn--undo js-undo-remove"></button>
                                                                                            <div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">
                                                                                                <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span>
                                                                                                <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>
                                                                                                <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                            <div type="button"
                                                                                 class="c-content-upload__show-more hidden">
                                                                                بیشتر
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="c-content-progress active">
                                                <span class="c-content-progress__step"></span>
                                            </div>
                                            <ul id="uploadingTemplate" class="hidden">
                                                <li class="c-content-upload__gallery-row js-uploads-row">
                                                    <input type="hidden" class="js-image-id-input"/>
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
                                                    <div class="c-content-upload__controls">
                                                        <button type="button"
                                                                class="c-content-upload__btn c-content-upload__btn--refresh js-refresh-upload"></button>
                                                        <button type="button"
                                                                class="c-content-upload__btn c-content-upload__btn--flag js-flag-primary js-tooltip"
                                                                data-tooltip="از این پرچم برای انتخاب تصویر اصلی استفاده کنید"></button>
                                                        <button type="button"
                                                                class="c-content-upload__btn c-content-upload__btn--cancel js-cancel-upload"></button>
                                                        <button type="button"
                                                                class="c-content-upload__btn c-content-upload__btn--remove js-remove-upload"></button>
                                                        <button type="button"
                                                                class="c-content-upload__btn c-content-upload__btn--undo js-undo-remove"></button>
                                                        <div
                                                            class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">
                                                    <span
                                                        class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span>
                                                            <span
                                                                class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>
                                                            <span
                                                                class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </section>
                                    </div>
                                    <form>
                                        <div class="c-card__footer c-card__footer--products">
                                            <div class="c-grid__row">
                                                <div class="c-grid__col c-grid__col--flex-initial">
                                                    <div class="c-content-error c-content-error--list hidden"
                                                         id="saveAjaxErrors">
                                                    </div>
                                                    <div class="uk-flex uk-flex-left" style="width: 97%;">
                                                        <button class="c-ui-btn c-ui-btn--next mr-a " id="saveButton">
                                                            ذخیره کالا
                                                        </button>
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
        <div id="afterProductSaveModal" class="marketplace-redesign" uk-modal>
            <div class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body">
                <div class="modal-product modal-product--confirm">
                    <div>
                <span class="c-ui-table__tag c-ui-table__tag--content">DKP-<span id="afterSaveProductId"
                                                                                 class="js-copy-to-clipboard"></span></span>
                    </div>
                    <p class="modal-message--center">کالا با موفقیت ایجاد شد.</p>
                    <p class="modal-message--center">می‌توانید هر یک از مراحل زیر را برای ادامه انتخاب نمایید.</p>
                </div>
                <div class="modal-footer modal-footer--center">
                    <div class="uk-flex">
                        <a href="/content/create/product/"
                           class="modal-footer__btn modal-footer__btn--confirm modal-footer__btn--wide"
                           type="button">
                            ثبت کالای جدید
                        </a>
                        <a href="/product/" class="modal-footer__btn modal-footer__btn--wide" type="button">
                            مدیریت محصولات
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="attributes" class="uk-modal" uk-modal>
            <div class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body c-content-accordion__modal"
                 id="guidelineModalContent">
                <div>
                    <div class="c-content-accordion__modal-header uk-flex uk-flex-middle uk-flex-between">
                        <p class="c-content-accordion__modal-title c-content-accordion__modal-title--light">
                            راهنما</p>
                        <button class="uk-modal-close" type="button" uk-close></button>
                    </div>

                    <div class="c-content-accordion__modal-body">
                        <p class="c-content-accordion__modal-title c-content-accordion__modal-title--dark">گام سوم:
                            درج ویژگی‌های کالا</p>
                        <div class="o-spacing-m-t-5 c-content-accordion__modal-content-container">
                            <p class="c-content-accordion__modal-text js-modal-item uk-hidden"
                               data-item="short_description">در این مرحله، باید گروه کالایی که محصول شما در آن قرار
                                می‌گیرد را انتخاب نمایید.</p>
                            <div class="o-spacing-m-t-6 c-content-accordion__modal-video js-modal-item uk-hidden"
                                 data-item="video">
                                <figure>
                                    <video width="100%" height="100%" controls class=""
                                           poster="">
                                        <source src="">
                                    </video>
                                </figure>
                            </div>
                            <div
                                class="o-spacing-m-t-5 c-content-accordion__modal-guidelines js-modal-item uk-hidden"
                                data-item="items">
                                <div
                                    class="o-spacing-p-t-4 o-spacing-p-b-4 c-content-accordion__modal-guidelines-separator
                                        c-content-accordion__modal-guidelines-separator-bottom">
                                    <div class="uk-flex uk-flex-between js-expand-item">
                                        <p class="c-content-accordion__modal-guidelines-item"></p>
                                        <span class="c-content-accordion__modal-guidelines-expand-icon"></span>
                                    </div>
                                    <div
                                        class="c-content-accordion__modal-text o-spacing-m-t-3 uk-hidden js-guideline-desc"></div>
                                </div>
                            </div>

                            <div
                                class="o-spacing-m-t-6 c-content-accordion__modal-guidelines-separator uk-hidden js-modal-item"
                                data-item="gallery">

                                <div class="swiper-container js-swiper-container" dir="rtl">
                                    <div class="swiper-wrapper o-spacing-m-t-5 uk-flex uk-flex-bottom">
                                        <div class="swiper-slide">
                                            <p class="c-content-accordion__modal-gellery-title js-gellery-title"></p>
                                            <p class="o-spacing-m-t-2 c-content-accordion__modal-gellery-des js-gellery-des"></p>
                                            <img src="" alt=""
                                                 class="o-spacing-m-t-6 c-content-accordion__modal-gellery-img">
                                        </div>
                                    </div>
                                    <div class="uk-flex uk-flex-between o-spacing-m-t-5">
                                        <div class="swiper-button-prev">
                                            تصویر قبل
                                        </div>
                                        <div class="swiper-pagination uk-flex uk-flex-middle uk-flex-center"></div>
                                        <div class="swiper-button-next">
                                            تصویر بعد
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-right js-video-btn uk-hidden">
                                <div class="o-btn o-btn--outlined-primary-lg-text o-spacing-m-t-6 js-show-video">
                                    مشاهده ویدیوی آموزشی
                                </div>
                                <div
                                    class="o-btn o-btn--outlined-primary-lg-text o-spacing-m-t-6 js-hide-video
                                        c-content-accordion__modal-guidelines-back uk-hidden">
                                    بازگشت به صفحه قبل
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="media" class="uk-modal" uk-modal>
            <div class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body c-content-accordion__modal"
                 id="guidelineModalContent">
                <div>
                    <div class="c-content-accordion__modal-header uk-flex uk-flex-middle uk-flex-between">
                        <p class="c-content-accordion__modal-title c-content-accordion__modal-title--light">
                            راهنما</p>
                        <button class="uk-modal-close" type="button" uk-close></button>
                    </div>

                    <div class="c-content-accordion__modal-body">
                        <p class="c-content-accordion__modal-title c-content-accordion__modal-title--dark">
                            گام
                            <span class="js-modal-section">
        پنجم                    </span>
                            : بارگذاری تصاویر
                        </p>
                        <div class="o-spacing-m-t-5 c-content-accordion__modal-content-container">
                            <p class="c-content-accordion__modal-text js-modal-item uk-hidden"
                               data-item="short_description">در این مرحله، باید گروه کالایی که محصول شما در آن قرار
                                می‌گیرد را انتخاب نمایید.</p>
                            <div class="o-spacing-m-t-6 c-content-accordion__modal-video js-modal-item uk-hidden"
                                 data-item="video">
                                <figure>
                                    <video width="100%" height="100%" controls class=""
                                           poster="">
                                        <source src="">
                                    </video>
                                </figure>
                            </div>
                            <div
                                class="o-spacing-m-t-5 c-content-accordion__modal-guidelines js-modal-item uk-hidden"
                                data-item="items">
                                <div
                                    class="o-spacing-p-t-4 o-spacing-p-b-4 c-content-accordion__modal-guidelines-separator c-content-accordion__modal-guidelines-separator-bottom">
                                    <div class="uk-flex uk-flex-between js-expand-item">
                                        <p class="c-content-accordion__modal-guidelines-item"></p>
                                        <span class="c-content-accordion__modal-guidelines-expand-icon"></span>
                                    </div>
                                    <div
                                        class="c-content-accordion__modal-text o-spacing-m-t-3 uk-hidden js-guideline-desc"></div>
                                </div>
                            </div>

                            <div
                                class="o-spacing-m-t-6 c-content-accordion__modal-guidelines-separator uk-hidden js-modal-item"
                                data-item="gallery">

                                <div class="swiper-container js-swiper-container" dir="rtl">
                                    <div class="swiper-wrapper o-spacing-m-t-5 uk-flex uk-flex-bottom">
                                        <div class="swiper-slide">
                                            <p class="c-content-accordion__modal-gellery-title js-gellery-title"></p>
                                            <p class="o-spacing-m-t-2 c-content-accordion__modal-gellery-des js-gellery-des"></p>
                                            <img src="" alt=""
                                                 class="o-spacing-m-t-6 c-content-accordion__modal-gellery-img">
                                        </div>
                                    </div>
                                    <div class="uk-flex uk-flex-between o-spacing-m-t-5">
                                        <div class="swiper-button-prev">
                                            تصویر قبل
                                        </div>
                                        <div class="swiper-pagination uk-flex uk-flex-middle uk-flex-center"></div>
                                        <div class="swiper-button-next">
                                            تصویر بعد
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-right js-video-btn uk-hidden">
                                <div class="o-btn o-btn--outlined-primary-lg-text o-spacing-m-t-6 js-show-video">
                                    مشاهده ویدیوی آموزشی
                                </div>
                                <div
                                    class="o-btn o-btn--outlined-primary-lg-text o-spacing-m-t-6 js-hide-video
                                        c-content-accordion__modal-guidelines-back uk-hidden">
                                    بازگشت به صفحه قبل
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="product_info" class="uk-modal" uk-modal>
            <div class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body c-content-accordion__modal"
                 id="guidelineModalContent">
                <div>
                    <div class="c-content-accordion__modal-header uk-flex uk-flex-middle uk-flex-between">
                        <p class="c-content-accordion__modal-title c-content-accordion__modal-title--light">
                            راهنما</p>
                        <button class="uk-modal-close" type="button" uk-close></button>
                    </div>

                    <div class="c-content-accordion__modal-body">
                        <p class="c-content-accordion__modal-title c-content-accordion__modal-title--dark">گام دوم:
                            درج اطلاعات کالا</p>
                        <div class="o-spacing-m-t-5 c-content-accordion__modal-content-container">
                            <p class="c-content-accordion__modal-text js-modal-item uk-hidden"
                               data-item="short_description">
                               در این مرحله، باید گروه کالایی که محصول شما در آن قرار
                                می‌گیرد را انتخاب نمایید.
                            </p>
                            <div class="o-spacing-m-t-6 c-content-accordion__modal-video js-modal-item uk-hidden"
                                 data-item="video">
                                <figure>
                                    <video width="100%" height="100%" controls class=""
                                           poster="">
                                        <source src="">
                                    </video>
                                </figure>
                            </div>
                            <div
                                class="o-spacing-m-t-5 c-content-accordion__modal-guidelines js-modal-item uk-hidden"
                                data-item="items">
                                <div
                                    class="o-spacing-p-t-4 o-spacing-p-b-4 c-content-accordion__modal-guidelines-separator c-content-accordion__modal-guidelines-separator-bottom">
                                    <div class="uk-flex uk-flex-between js-expand-item">
                                        <p class="c-content-accordion__modal-guidelines-item"></p>
                                        <span class="c-content-accordion__modal-guidelines-expand-icon"></span>
                                    </div>
                                    <div
                                        class="c-content-accordion__modal-text o-spacing-m-t-3 uk-hidden js-guideline-desc"></div>
                                </div>
                            </div>

                            <div
                                class="o-spacing-m-t-6 c-content-accordion__modal-guidelines-separator uk-hidden js-modal-item"
                                data-item="gallery">

                                <div class="swiper-container js-swiper-container" dir="rtl">
                                    <div class="swiper-wrapper o-spacing-m-t-5 uk-flex uk-flex-bottom">
                                        <div class="swiper-slide">
                                            <p class="c-content-accordion__modal-gellery-title js-gellery-title"></p>
                                            <p class="o-spacing-m-t-2 c-content-accordion__modal-gellery-des js-gellery-des"></p>
                                            <img src="" alt=""
                                                 class="o-spacing-m-t-6 c-content-accordion__modal-gellery-img">
                                        </div>
                                    </div>
                                    <div class="uk-flex uk-flex-between o-spacing-m-t-5">
                                        <div class="swiper-button-prev">
                                            تصویر قبل
                                        </div>
                                        <div class="swiper-pagination uk-flex uk-flex-middle uk-flex-center"></div>
                                        <div class="swiper-button-next">
                                            تصویر بعد
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-right js-video-btn uk-hidden">
                                <div class="o-btn o-btn--outlined-primary-lg-text o-spacing-m-t-6 js-show-video">
                                    مشاهده ویدیوی آموزشی
                                </div>
                                <div
                                    class="o-btn o-btn--outlined-primary-lg-text o-spacing-m-t-6 js-hide-video c-content-accordion__modal-guidelines-back uk-hidden">
                                    بازگشت به صفحه قبل
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="auto_title" class="uk-modal" uk-modal>
            <div class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body c-content-accordion__modal"
                 id="guidelineModalContent">
                <div>
                    <div class="c-content-accordion__modal-header uk-flex uk-flex-middle uk-flex-between">
                        <p class="c-content-accordion__modal-title c-content-accordion__modal-title--light">
                            راهنما</p>
                        <button class="uk-modal-close" type="button" uk-close></button>
                    </div>

                    <div class="c-content-accordion__modal-body">
                        <p class="c-content-accordion__modal-title c-content-accordion__modal-title--dark">گام
                            چهارم: عنوان پیشنهادی کالا</p>
                        <div class="o-spacing-m-t-5 c-content-accordion__modal-content-container">
                            <p class="c-content-accordion__modal-text js-modal-item uk-hidden"
                               data-item="short_description">در این مرحله، باید گروه کالایی که محصول شما در آن قرار
                                می‌گیرد را انتخاب نمایید.</p>
                            <div class="o-spacing-m-t-6 c-content-accordion__modal-video js-modal-item uk-hidden"
                                 data-item="video">
                                <figure>
                                    <video width="100%" height="100%" controls class=""
                                           poster="">
                                        <source src="">
                                    </video>
                                </figure>
                            </div>
                            <div class="o-spacing-m-t-5 c-content-accordion__modal-guidelines js-modal-item uk-hidden" data-item="items">
                                <div class="o-spacing-p-t-4 o-spacing-p-b-4 c-content-accordion__modal-guidelines-separator
                                     c-content-accordion__modal-guidelines-separator-bottom">
                                    <div class="uk-flex uk-flex-between js-expand-item">
                                        <p class="c-content-accordion__modal-guidelines-item"></p>
                                        <span class="c-content-accordion__modal-guidelines-expand-icon"></span>
                                    </div>
                                    <div class="c-content-accordion__modal-text o-spacing-m-t-3 uk-hidden js-guideline-desc"></div>
                                </div>
                            </div>

                            <div class="o-spacing-m-t-6 c-content-accordion__modal-guidelines-separator uk-hidden js-modal-item" data-item="gallery">

                                <div class="swiper-container js-swiper-container" dir="rtl">
                                    <div class="swiper-wrapper o-spacing-m-t-5 uk-flex uk-flex-bottom">
                                        <div class="swiper-slide">
                                            <p class="c-content-accordion__modal-gellery-title js-gellery-title"></p>
                                            <p class="o-spacing-m-t-2 c-content-accordion__modal-gellery-des js-gellery-des"></p>
                                            <img src="" alt=""
                                                 class="o-spacing-m-t-6 c-content-accordion__modal-gellery-img">
                                        </div>
                                    </div>
                                    <div class="uk-flex uk-flex-between o-spacing-m-t-5">
                                        <div class="swiper-button-prev">
                                            تصویر قبل
                                        </div>
                                        <div class="swiper-pagination uk-flex uk-flex-middle uk-flex-center"></div>
                                        <div class="swiper-button-next">
                                            تصویر بعد
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-right js-video-btn uk-hidden">
                                <div class="o-btn o-btn--outlined-primary-lg-text o-spacing-m-t-6 js-show-video">
                                    مشاهده ویدیوی آموزشی
                                </div>
                                <div class="o-btn o-btn--outlined-primary-lg-text o-spacing-m-t-6 js-hide-video
                                     c-content-accordion__modal-guidelines-back uk-hidden">
                                    بازگشت به صفحه قبل
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="pageLoader" class="c-content-loader c-content-loader--fixed">
            <div class="c-content-loader__logo"></div>
            <div class="c-content-loader__spinner"></div>
        </div>
    </div>
</main>


<input name="product_title_prefix" value="{{ $product_title_prefix }}" hidden>

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

$("input[name=seo_keyword_meta]").each(function () {
    var input = document.querySelector('input[name=drag-sort]'),
        tagify = new Tagify(this);

    var dragsort = new DragSort(tagify.DOM.scope, {
        selector: '.' + tagify.settings.classNames.tag,
        callbacks: {
            dragEnd: onDragEnd
        }
    })

    function onDragEnd(elm) {
        tagify.updateValueByDOMTags()
    }
});

$(document).on('change', "input[name='title[title_fa]']", function (){
    var field_val = $("input[name='title[title_fa]']").val();
    $("input[name='product[title_fa]']").val(field_val);
});

$(document).on('change', "input[name='title[title_en]']", function (){
    var field_val = $("input[name='title[title_en]']").val();
    $("input[name='product[title_en]']").val(field_val);
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
});

$(document).ready(function () {
    var model = $("input[name='product[model]']").val();
    var full_brand = $("#brandsSelect option:selected").text();
    var brand = full_brand.substring(0, full_brand.indexOf(" ("));
    var nature = $("input[name='product[product_nature]']").val();
    brand = brand.replace(/\s\s+/g, '');

    if ($("#brandsSelect option:selected").val() == 0) {
        var product_title = nature + ' مدل ' + model;
    } else {
        var product_title = nature + ' ' + brand + ' مدل ' + model;
    }

    $(".persian-title").val(product_title);

    var suggest_slug = $(".persian-title").val();
    suggest_slug = suggest_slug.replace(/ /g,"-");
    $(".suggest_slug").val(suggest_slug);

    var suggest_seo_title = $("input[name='product_title_prefix']").val() + ' ' + $(".persian-title").val();
    $(".suggest_seo_title").val(suggest_seo_title);
});

$(document).ready(function () {
    // suggest_slug
    var suggest_slug = $("input[name='suggest_slug']").val();
    $("input[name='product[suggest_slug]']").val(suggest_slug);

    // slug
    var slug = $("input[name='slug']").val();
    $("input[name='product[slug]']").val(slug);

    // suggest_seo_title
    var suggest_seo_title = $("input[name='suggest_seo_title']").val();
    $("input[name='product[suggest_seo_title]']").val(suggest_seo_title);

    // seo_title
    var seo_title = $("input[name='seo_title']").val();
    $("input[name='product[seo_title]").val(seo_title);

    // seo_keyword_meta
    var seo_keyword_meta = $("input[name='seo_keyword_meta']").val();
    $("input[name='product[seo_keyword_meta]").val(seo_keyword_meta);

    // seo_description_meta
    var seo_description_meta = $("input[name='seo_description_meta']").val();
    $("input[name='product[seo_description_meta]").val(seo_description_meta);

    // seo_custom_meta
    var seo_custom_meta = $("input[name='seo_custom_meta']").val();
    $("input[name='product[seo_custom_meta]").val(seo_custom_meta);

});

$(document).on('change', ".title-creator", function () {
    var model = $("input[name='product[model]']").val();
    var full_brand = $("#brandsSelect option:selected").text();
    var brand = full_brand.substring(0, full_brand.indexOf(" ("));
    var nature = $("input[name='product[product_nature]']").val();

    if ($("#brandsSelect option:selected").val() == 0) {
        var product_title = nature + ' مدل ' + model;
    } else {
        var product_title = nature + '' + brand + ' مدل ' + model;
    }
    $(".persian-title").val(product_title);

});
</script>
@endsection
