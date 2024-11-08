@extends('layouts.staff.master')
@section('title') مدیریت تنوع مجاز | {{ $fa_store_name }}  @endsection
@section('head')
<!-- <script src="{{ asset('seller/js/tags3.js') }}"></script> -->
<script src="{{ asset('mehdi/staff/js/tags.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/jquery-ui.min.js') }}"></script>

<script src="{{ asset('mehdi/staff/js/dragsort.js') }}"></script>
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
                        <span class="c-content-page__header-action">
                            مدیریت تنوع مجاز گروه کالایی
                        </span>
                        <span class="c-content-page__header-desc">
                            از این صفحه می‌توانید تنوع مجاز هر گروه کالایی را مشخص کنید
                        </span>
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
                                                <div style="color: #606265;">مدیریت تنوع مجاز گروه کالایی</div>
                                            </h2>
                                            <div style="width: 100%;margin: -7px 0px 20px 0px !important;padding: 0px !important;
                                                background: #e2dddd;height: 1px;">
                                            </div>
                                            <div class="c-content-accordion__content c-content-accordion__content--small"
                                                id="stepTitleContainer" aria-hidden="false" style=" margin-right: -25px;">
                                                <div class="c-card__body c-card__body--content category-box">
                                                    <label for="" class="search-form__action-label">
                                                        جستجو در میان دسته‌ها
                                                    </label>
                                                    <div class="search-form__autocomplete-container">
                                                        <div class="search-form__autocomplete js-autosuggest-box">
                                                            <input name="search" id="searchKeyword"
                                                                   class="c-content-input__origin js-prevent-submit"
                                                                   type="text"
                                                                   placeholder="دسته مورد نظرتان را جستجو کنید">
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
                                                            <div
                                                                class="c-content-categories__wrapper js-category-column cat-box"
                                                                id="cat-box" data-id="0">
                                                                <ul class="c-content-categories__list"
                                                                    style="list-style: none;">
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
                                                            <button type="button"
                                                                    class="c-content-categories__search-reset reset-box"
                                                                    id="categoryReset">
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
                                                    {{--ajax--}}
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


    var variant_group_id = $("select[name='variant_group']").val();

    var category_id = $("input[name='selected-cat']").val();

    $.ajax({
        method: "post",
        url: '{{route('staff.variants.saveConfig')}}',
        data: {
            category_id: category_id,
            variant_g_id: variant_group_id,
        },
        success: function () {
            window.location.href = "{{ route('staff.variants.variantCategory') }}";
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
        url: '{{route('staff.types.childCatsLoader')}}',
        data: {
            id: categorySelected,
        },
        success: function (response) {
            $('#categoriesContainerContent').append(response);
        },
    });

    if($(document).find('.ajax-box')) {
        $(".ajax-box").remove();
    }

});

// ایجکس breadcrumb
$(document).on('change', "input[type='radio']", function (e) {

    var bread_id = $("input[type='radio']:checked").val();

    $.ajax({
        method: "POST",
        url: '{{route('staff.types.breadcrumbLoader')}}',
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
            url: '{{route('staff.types.ajaxsearch')}}',
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
            url: '{{route('staff.types.mainCatLoader')}}',
            success: function (response) {
                $('.c-content-categories__wrapper').replaceWith(response);
            }
        });
    }

});

$(document).on('click', ".reset-box", function (e) {

    $.ajax({
        type: 'post',
        url: '{{route('staff.types.mainCatLoader')}}',
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

function generateSelectUi() {
    $('.js-select-origin').each(function () {
        const $this = $(this);
        const isMultiSelect = $this.attr('multiple');
        const $placeholder = $this.attr('data-placeholder') || '';
        const inProductStep = $this.hasClass('js-in-product');

        $this.select2({
            placeholder: $placeholder,
            closeOnSelect: !isMultiSelect,
            allowClear: (isMultiSelect && inProductStep),
            sorter: function (data) {
                return data.sort(function (a, b) {
                    a = $(a).prop('selected');
                    b = $(b).prop('selected');
                    return b - a;
                });
            }
        }).on('select2:opening', function () {
            $('body').addClass('ui-select');
        }).on('select2:select', function () {
            let $sortedOptions = $('li.select2-results__option').sort(function (a, b) {
                return ($(b).attr('aria-selected') === 'true') - ($(a).attr('aria-selected') === 'true');
            });
            $('.select2-results__options').prepend($sortedOptions);
        }).on('select2:unselect', function () {
            let $sortedOptions = $('li.select2-results__option').sort(function (a, b) {
                return ($(b).attr('aria-selected') === 'true') - ($(a).attr('aria-selected') === 'true');
            });
            $('.select2-results__options').prepend($sortedOptions);
        }).on('change', function () {
            if (isMultiSelect && inProductStep) {
                let $selectionsContainerWidth = $this.siblings('.select2-container').find('ul.select2-selection__rendered').width() - 77;
                const $selections = $this.siblings('.select2-container').find('li.select2-selection__choice');

                $selections.removeClass('hidden');
                $selections.each(function () {
                    $selectionsContainerWidth -= $(this).outerWidth(true);
                    if ($selectionsContainerWidth < 0) {
                        $(this).addClass('hidden');
                    }
                });

                let $selectionsCount = $this.siblings('.select2-container').find('li.select2-selection__choice.hidden').length;
                let $counter = $this.siblings('.select-counter');

                if ($selectionsCount > 0) {
                    $counter.css('display', 'flex');
                } else {
                    $counter.css('display', 'none');
                }
                $counter.text($selectionsCount.toLocaleString('fa-IR'));
            }
            $(this).trigger('blur');
        }).on('select2:close', function () {
            $(this).valid();
            $('body').removeClass('ui-select');
        });

        if (isMultiSelect && inProductStep) {
            let $selectionsContainerWidth = $this.siblings('.select2-container').find('ul.select2-selection__rendered').width() - 77;
            const $selections = $this.siblings('.select2-container').find('li.select2-selection__choice');

            $selections.removeClass('hidden');
            $selections.each(function () {
                $selectionsContainerWidth -= $(this).outerWidth(true);
                if ($selectionsContainerWidth < 0) {
                    $(this).addClass('hidden');
                }
            });

            let $counter = $this.siblings('.select-counter');
            let $selectionsCount = $this.siblings('.select2-container').find('li.select2-selection__choice.hidden').length;

            if ($selectionsCount > 0) {
                $counter.text($selectionsCount.toLocaleString('fa-IR'));
                $counter.css('display', 'flex');
            }
        }

    });
}

$('.js-select-origin').each(function () {
    const $this = $(this);
    const isMultiSelect = $this.attr('multiple');
    const $placeholder = $this.attr('data-placeholder') || '';
    const inProductStep = $this.hasClass('js-in-product');

    $this.select2({
        placeholder: $placeholder,
        closeOnSelect: !isMultiSelect,
        allowClear: (isMultiSelect && inProductStep),
        sorter: function (data) {
            return data.sort(function (a, b) {
                a = $(a).prop('selected');
                b = $(b).prop('selected');
                return b - a;
            });
        }
    }).on('select2:opening', function () {
        $('body').addClass('ui-select');
    }).on('select2:select', function () {
        let $sortedOptions = $('li.select2-results__option').sort(function (a, b) {
            return ($(b).attr('aria-selected') === 'true') - ($(a).attr('aria-selected') === 'true');
        });
        $('.select2-results__options').prepend($sortedOptions);
    }).on('select2:unselect', function () {
        let $sortedOptions = $('li.select2-results__option').sort(function (a, b) {
            return ($(b).attr('aria-selected') === 'true') - ($(a).attr('aria-selected') === 'true');
        });
        $('.select2-results__options').prepend($sortedOptions);
    }).on('change', function () {
        if (isMultiSelect && inProductStep) {
            let $selectionsContainerWidth = $this.siblings('.select2-container').find('ul.select2-selection__rendered').width() - 77;
            const $selections = $this.siblings('.select2-container').find('li.select2-selection__choice');

            $selections.removeClass('hidden');
            $selections.each(function () {
                $selectionsContainerWidth -= $(this).outerWidth(true);
                if ($selectionsContainerWidth < 0) {
                    $(this).addClass('hidden');
                }
            });

            let $selectionsCount = $this.siblings('.select2-container').find('li.select2-selection__choice.hidden').length;
            let $counter = $this.siblings('.select-counter');

            if ($selectionsCount > 0) {
                $counter.css('display', 'flex');
            } else {
                $counter.css('display', 'none');
            }
            $counter.text($selectionsCount.toLocaleString('fa-IR'));
        }
        $(this).trigger('blur');
    }).on('select2:close', function () {
        $(this).valid();
        $('body').removeClass('ui-select');
    });

    if (isMultiSelect && inProductStep) {
        let $selectionsContainerWidth = $this.siblings('.select2-container').find('ul.select2-selection__rendered').width() - 77;
        const $selections = $this.siblings('.select2-container').find('li.select2-selection__choice');

        $selections.removeClass('hidden');
        $selections.each(function () {
            $selectionsContainerWidth -= $(this).outerWidth(true);
            if ($selectionsContainerWidth < 0) {
                $(this).addClass('hidden');
            }
        });

        let $counter = $this.siblings('.select-counter');
        let $selectionsCount = $this.siblings('.select2-container').find('li.select2-selection__choice.hidden').length;

        if ($selectionsCount > 0) {
            $counter.text($selectionsCount.toLocaleString('fa-IR'));
            $counter.css('display', 'flex');
        }
    }

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
            url: '{{route('staff.variants.loadCategoryVariant')}}',
            data: {
                category_id: category_id,
            },
            success: function (result) {
                $(".editable-section").replaceWith(result);
                var selected_cat = $("input:checked[type='radio']").val();
                console.log(selected_cat);
                $("input[name='selected-cat']").val(selected_cat);
                generateSelectUi();
            },
        });

        $(".edit-form-section").show(100);
    }

});

$("#sortable1").sortable({
    connectWith: ".connectedSortable",
});

</script>
@endsection
