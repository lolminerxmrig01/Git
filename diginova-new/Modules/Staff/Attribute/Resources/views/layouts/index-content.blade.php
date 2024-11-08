<div class="c-content-accordion__content c-content-accordion__content--small"
    id="stepTitleContainer" aria-hidden="false" style=" margin-right: -25px;">
    <div class="c-card__body c-card__body--content category-box">
        <label for="" class="search-form__action-label">
            جستجو در میان دسته‌ها
        </label>
        <div class="search-form__autocomplete-container">
            <div class="search-form__autocomplete js-autosuggest-box">
                <input name="search" id="searchKeyword" class="c-content-input__origin js-prevent-submit"
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
            <div class="c-content-categories__container" id="categoriesContainerContent">
                <div class="c-content-categories__wrapper js-category-column cat-box" id="cat-box" data-id="0">
                    <ul class="c-content-categories__list" style="list-style: none;">
                        @foreach($categories->where('parent_id', 0) as $category)
                            <li class="c-content-categories__item {{ (count($category->children) > 0) ? 'has-children' : '' }}">
                                <label class="c-content-categories__link js-category-link">
                                    <input type="radio" name="category" value="{{ $category->id }}"
                                         class="js-category-data radio uk-hidden" data-id="{{ $category->id }}"
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
        <div id="breadcrumb" class="c-content-categories__summary">
            <div class="c-content-categories__summary-breadcrumbs" id="bread-box">
                <span class="">دسته انتخابی شما:</span>
                <ul class="js-selected-category c-content-categories__selected-list" id="breadcrumbs">
                    <!-- ajax -->
                </ul>
            </div>
            <div class="c-content-accordion__step-controls c-content-accordion__step-controls--category">
                <button class="c-ui-btn c-ui-btn--next mr-a js-continue-btn disabled" id="categoryStepNext" disabled="true">
                    انتخاب دسته
                </button>
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

    @include('staffattribute::layouts.bottom-box')
</div>
