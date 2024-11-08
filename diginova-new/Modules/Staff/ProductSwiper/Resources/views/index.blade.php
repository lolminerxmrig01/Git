@extends('layouts.staff.master')
@section('title') مدیریت صفحه اصلی | {{ $fa_store_name }}  @endsection
@section('head')
<script src="{{ asset('mehdi/staff/js/jquery-ui.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('mehdi/staff/css/tagify.css') }}">
<script src="{{ asset('mehdi/staff/js/jQuery.tagify.min.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/tagify.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('mehdi/staff/css/dragsort.css') }}" media="print" onload="this.media='all'">
<script src="{{ asset('mehdi/staff/js/dragsort.js') }}"></script>
<style>
.select2-selection__arrow {
    display: block !important;
}

.select2-selection--single {
    background-color: #fff;
    border: 1px solid #bbbaba;
    border-radius: 4px;
}
</style>
@endsection
@section('content')
<main class="c-main">
  <div class="uk-container uk-container-large">
      <div class="c-grid">
            <div class="c-grid__row c-product-list--align-header">
                <div class="c-grid__col">
                    <div class="c-card c-card--transparent">
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc">
                            مدیریت صفحه اصلی
                            <span>
                            برای مدیریت  صفحه اصلی از این قسمت استفاده نمایید
                        </span>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="js-table-container">

                <div class="c-grid__row" style="margin-top:30px">
                    <div class="c-grid__col">
                        <div class="c-card">
                            <div class="c-card__wrapper">
                                <div class="c-card__header c-card__header--table">
                                    <a target="_blank">
                                        <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                            ایجاد اسلایدر محصول
                                        </div>
                                    </a>
                                    <div class="c-ui-paginator js-paginator"></div>
                                </div>
                                <div class="c-card__body c-ui-table__wrapper">
                                    <table class="c-ui-table  js-search-table js-table-fixed-header c-join__table">
                                        <thead>
                                          <tr class="c-ui-table__row">
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap "></span></th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap table-header-searchable--desc">عنوان اسلایدر</span>
                                              </th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap ">زیر عنوان</span>
                                              </th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap ">دسته‌بندی</span>
                                              </th>
                                              <th class="c-ui-table__header" style="max-width: 5% !important;">
                                                <span class="table-header-searchable uk-text-nowrap ">مرتب‌سازی بر اساس</span>
                                              </th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap ">وضعیت</span>
                                              </th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap ">حذف</span>
                                              </th>
                                          </tr>
                                        </thead>

                                        <tbody id="tbody">
                                          @if(isset($productSwipers) && !is_null($productSwipers))
                                            @foreach($productSwipers as $productSwiper)
                                              <tr name="row db-row" id="item-{{$productSwiper->id}}" data-id="{{$productSwiper->id}}" class="c-ui-table__row c-ui-table__row--body c-join__table-row row db-row">
                                                <input name="swiper_id" value="{{ $productSwiper->id }}" hidden>
                                                <td class="c-ui-table__cell" style="padding-right: 0px; padding-left: 23px;">
                                                    <div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">
                                                        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span>
                                                        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>
                                                        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>
                                                    </div>
                                                </td>

                                                <td class="c-ui-table__cell" style="min-width: 90px">
                                                    <input type="text" name="swiper_title" value="{{ ($productSwiper->title)? $productSwiper->title : '' }}" class="c-content-input__origin js-attribute-old-value swiper_title">
                                                </td>

                                                <td class="c-ui-table__cell" style="min-width: 90px">
                                                    <input type="text" name="swiper_subtitle" value="{{ ($productSwiper->description)? $productSwiper->description : '' }}" class="c-content-input__origin js-attribute-old-value swiper_subtitle">
                                                </td>

                                                <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: right; min-width: 200px;">
                                                  <select name="category" class="uk-input uk-input--select category js-select-origin select2-hidden-accessible" tabindex="-1" aria-hidden="true" aria-invalid="false">
                                                    @foreach($categories as $category)
                                                      <option value="{{ $category->id }}" {{ ($productSwiper->category_id == $category->id)? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                  </select>
                                                </td>

                                                <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: right; min-width: 200px;">
                                                  <select name="sort_by" class="uk-input uk-input--select sort_by js-select-origin select2-hidden-accessible" tabindex="-1" aria-hidden="true" aria-invalid="false">
                                                      <option value="newest" {{ ($productSwiper->sort_by == 'newest')? 'selected' : '' }}>جدیدترین</option>
                                                      <option value="expensive" {{ ($productSwiper->sort_by == 'expensive')? 'selected' : '' }}>گران‌ترین</option>
                                                      <option value="chipest" {{ ($productSwiper->sort_by == 'chipest')? 'selected' : '' }}>ارزان‌ترین</option>
                                                      <option value="best_selling" {{ ($productSwiper->sort_by == 'best_selling')? 'selected' : '' }}>پرفروش‌ترین</option>
                                                  </select>
                                                </td>

                                                <td class="c-ui-table__cell c-ui-table__cell--small-text">
                                                  <div class="c-ui-tooltip__anchor">
                                                      <div class="c-ui-toggle__group">
                                                          <label class="c-ui-toggle">
                                                              <input class="c-ui-toggle__origin js-toggle-active-product swiper_status" type="checkbox" name="swiper_status" {{ ($productSwiper->status)? 'checked' : '' }}>
                                                              <span class="c-ui-toggle__check"></span>
                                                          </label>
                                                      </div>
                                                  </div>
                                                </td>

                                                <td class="c-ui-table__cell">
                                                  <div class="c-promo__actions" style="width: 50%; margin: auto;">
                                                      <button type="button" class="c-content-upload__btn c-content-upload__btn--remove remove-btn"></button>
                                                  </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                          @endif

                                        </tbody>
                                    </table>
                                </div>

                                <div class="c-card__footer" style="width: auto;">
                                  <a>
                                    <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">ایجاد اسلایدر محصول</div>
                                  </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <div class="c-grid__row">
            <div class="c-grid__col">
                <div class="c-card">
                    <div class="edit-form-section c-card__footer c-card__footer--products">
                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--xs-gap" style="width: 40%; float: left; display: contents;">
                        <a class="c-ui-btn c-ui-btn--next mr-a" style="margin-left: 68px;max-width: 100px;" id="submit-form">ذخیره
                        </a>
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

<div uk-modal="esc-close: true; bg-close: true;" class="uk-modal-container uk-modal-container--message js-common-modal-notification uk-modal" style="display: none;">
    <div class="uk-modal-dialog uk-modal-dialog--flex">
        <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""></button>
        <div class="uk-modal-body">
            <div class="c-modal-notification">
                <div class="c-modal-notification__content c-modal-notification__content--limited">
                    <h2 class="c-modal-notification__header">هشدار</h2>
                    <p class="c-modal-notification__text">
                      آیا از حذف کامل آن اطمینان دارید؟
                    </p>
                    <div class="c-modal-notification__actions">
                        <button class="c-modal-notification__btn no uk-modal-close">خیر</button>
                        <button class="c-modal-notification__btn c-modal-notification__btn--secondary yes uk-modal-close"> بله </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="uk-flex uk-flex-column values-td select-unit" style="display: none;">
  <select name="category[]" class="uk-input uk-input--select attr_input_tag js-select-origin select2-hidden-accessible">
      @if(isset($categories) && count($categories))
        @foreach($categories as $category)
         <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      @endif
  </select>
</div>
@endsection
@section('script')
<script>

$(document).ready(function (){
  generateSelectUi();
});

// اضافه کردن توکن به درخواست های ایجکس
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// ایجکس فرم اصلی
$('#submit-form').on('click', function (e) {
    // e.preventDefault();

    var swiper_title = $("input[name='swiper_title']").map(function(){return $(this).val();}).get();
    var swiper_desciption = $("input[name='swiper_subtitle']").map(function(){return $(this).val();}).get();
    var category_id = $("select[name='category']").map(function(){return $(this).val();}).get();
    var sort_by = $("select[name='sort_by']").map(function(){return $(this).val();}).get();


    var swiper_status = $("input[name='swiper_status']").map(function(){
        if($(this).is(':checked')){return 1;}else{return 0;}
    }).get();
    var position = $("tbody").sortable('serialize');
    var deleted_rows = $("input[name='deleted_row']").map(function(){return $(this).val();}).get();

    $.ajax({
        method: "post",
        url: '{{route('staff.productSwipers.update')}}',
        data: {
            positions:position,
            deleted_rows: deleted_rows,

            category_ids: category_id,
            titles: swiper_title,
            desciptions: swiper_desciption,
            sort_by: sort_by,
            status: swiper_status,
        },

        success: function () {
            window.location.href = "{{ route('staff.productSwipers.index') }}";
        },
    });

});

$(document).on('click', '.remove-btn', function () {
    $(".uk-modal-container").addClass('uk-open');
    $(".uk-modal-container").css('display', 'block');
    $('.c-header__nav').hide();
    $(this).closest("tr").addClass('hide-tr');

    $(document).on('click', '.yes', function (){
        if ($(document).find('.hide-tr').hasClass('db-row'))
        {
            var deleted_id = $(".hide-tr").attr('data-id');
            var deleted_row = '<input name="deleted_row" value="' + deleted_id + '" hidden>';
            $('.c-main').append(deleted_row);
            $(".hide-tr").remove();
        }
        else {
            $(".hide-tr").remove();
        }

        $('.c-header__nav').show();
    });

    $(document).on('click', '.no', function () {
        $('.c-header__nav').show();
        $(".hide-tr").removeClass('hide-tr');
    });

    $(document).on('click', '.uk-close', function () {
        $('.c-header__nav').show();
        $(".hide-tr").removeClass('hide-tr');
    });

});

$(document).on('click', '.c-mega-campaigns__btns-green-plus', function () {
    var new_tr = `
    <tr name="row" id="item-new" class="c-ui-table__row c-ui-table__row--body c-join__table-row row">
      <td class="c-ui-table__cell" style="padding-right: 0px; padding-left: 23px;">
          <div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">
              <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span>
              <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>
              <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>
          </div>
      </td>

      <td class="c-ui-table__cell" style="min-width: 30%">
          <input type="text" name="swiper_title" value="" class="c-content-input__origin js-attribute-old-value swiper_title">
      </td>

      <td class="c-ui-table__cell" style="min-width: 30%">
          <input type="text" name="swiper_subtitle" value="" class="c-content-input__origin js-attribute-old-value swiper_subtitle">
      </td>

      <td class="c-ui-table__cell c-ui-table__cell--small-text td-select" style="text-align: right; min-width: 5%;">
        <select name="category" class="uk-input uk-input--select category js-select-origin select2-hidden-accessible" tabindex="-1" aria-hidden="true" aria-invalid="false">
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
     </td>

      <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: right; min-width: 5%;">
        <select name="sort_by" class="uk-input uk-input--select sort_by js-select-origin select2-hidden-accessible" tabindex="-1" aria-hidden="true" aria-invalid="false">
          <option value="newest" selected>جدیدترین</option>
          <option value="expensive">گران‌ترین</option>
          <option value="chipest">ارزان‌ترین</option>
          <option value="best_selling">پرفروش‌ترین</option>
        </select>
      </td>

      <td class="c-ui-table__cell c-ui-table__cell--small-text">
        <div class="c-ui-tooltip__anchor">
            <div class="c-ui-toggle__group">
                <label class="c-ui-toggle">
                    <input class="c-ui-toggle__origin js-toggle-active-product swiper_status"
                       type="checkbox" name="swiper_status" checked>
                    <span class="c-ui-toggle__check"></span>
                </label>
            </div>
        </div>
      </td>

      <td class="c-ui-table__cell">
        <div class="c-promo__actions" style="width: 50%; margin: auto;">
            <button type="button" class="c-content-upload__btn c-content-upload__btn--remove remove-btn"></button>
        </div>
      </td>
    </tr>
    `;

    $("#tbody").append(new_tr);
    generateSelectUi();

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

$('tbody').sortable({
  handle: '.c-content-upload__drag-handler',
});



</script>
@endsection
