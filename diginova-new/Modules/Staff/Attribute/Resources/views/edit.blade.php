@extends('layouts.staff.master')
@section('title')
    ویرایش گروه ویژگی | {{ $fa_store_name }}
@endsection
@section('head')
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('mehdi/staff/css/tagify.css') }}">
<script src="{{ asset('mehdi/staff/js/jQuery.tagify.min.js') }}"></script>

<script src="{{ asset('mehdi/staff/js/tagify.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('mehdi/staff/css/dragsort.css') }}"
         media="print" onload="this.media='all'">
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
                            ویرایش گروه ویژگی
                            <span>
                            برای ویرایش  گروه ویژگی و ایجاد ویژگی
                            برای آن از این قسمت استفاده نمایید
                            </span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <div class="c-card">
                        <h2 style="font-size: 18px;margin-right: 33px;margin-top: 28px;margin-bottom: -30px;">
                            <div style="color: #606265;">اطلاعات گروه ویژگی</div>
                        </h2>
                        <div style="width: 100%;margin: -7px 0px 50px 0px !important;padding: 0px !important;
                            background: #e2dddd;height: 1px;display: none;">
                        </div>
                        <div class="c-card__header"></div>
                        <div class="c-card__body">
                            <div class="c-grid__row c-grid__row--gap-lg">
                                <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-8 ">
                                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                                        <div class="c-grid__col c-grid__col--gap-lg
                                            c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--xs-gap">
                                            <label for="" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">نام گروه ویژگی
                                                <span class="uk-form-label__required"></span>
                                            </label>
                                            <div class="field-wrapper">
                                                <label class="c-content-input">
                                                    <input name="group_id" class="group_id" value="{{ $attributeGroup->id }}" hidden>
                                                    <input type="text" class="c-content-input__origin
                                                     c-content-input__origin attr_group_name" name="attr_group_name"
                                                     value="{{ $attributeGroup->name }}" dir="rtl" style="text-align: right;">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-grid__row c-grid__row--gap-lg">
                                <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                    <label for="" class="uk-form-label" style="color: #606265;margin-bottom: 8px;">
                                        توضیحات (اختیاری)
                                    </label>
                                    <div class="field-wrapper field-wrapper--textarea">
                                        <textarea name="attr_group_desc"class="c-content-input__origin c-content-input__origin--textarea
                                            js-textarea-words attr_group_desc" rows="2" maxlength="1000"
                                            @if(!$attributeGroup->description)
                                                placeholder="در صورت تمایل اطلاعات گروه ویژگی را وارد کنید ..."
                                            @endif >{{ ($attributeGroup->description)? $attributeGroup->description : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            ایجاد ویژگی جدید
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
                                                <span class="table-header-searchable uk-text-nowrap table-header-searchable--desc">عنوان ویژگی</span>
                                              </th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap ">نوع نمایش</span>
                                              </th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap ">ضروری</span>
                                              </th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap ">قابل فیلتر</span>
                                              </th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap ">برگزیده</span>
                                              </th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap ">مقادیر ورودی</span>
                                              </th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap ">حذف</span>
                                              </th>
                                          </tr>
                                        </thead>

                                        <tbody id="tbody">
                                          @if(isset($attributes) && !is_null($attributes))
                                            @foreach($attributes->unique() as $attribute)
                                              <tr name="row db-row" id="item-{{$attribute->id}}" data-id="{{$attribute->id}}"
                                                class="c-ui-table__row c-ui-table__row--body c-join__table-row row db-row">
                                                <input name="attribute_id" value="{{ $attribute->id }}" hidden>
                                                <td class="c-ui-table__cell" style="padding-right: 0px; padding-left: 23px;">
                                                    <div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">
                                                        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span>
                                                        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>
                                                        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>
                                                    </div>
                                                </td>
                                                <td class="c-ui-table__cell" style="min-width: 90px">
                                                    <input type="text" name="attr_name" value="{{ ($attribute->name)? $attribute->name : '' }}"
                                                        class="c-content-input__origin js-attribute-old-value attr_name">
                                                </td>
                                                <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: right; min-width: 200px;">
                                                    <select name="attr_type" class="uk-input uk-input--select attr_type js-select-origin
                                                     select2-hidden-accessible" tabindex="-1" aria-hidden="true" aria-invalid="false" disabled>
                                                        <option value="1" {{ ($attribute->type == 1)? 'selected' : '' }}>عبارت کوتاه (text)</option>
                                                        <option value="2" {{ ($attribute->type == 2)? 'selected' : '' }}>متن بلند (textarea)</option>
                                                        <option value="3" {{ ($attribute->type == 3)? 'selected' : '' }}>تک انتخابی (select box)</option>
                                                        <option value="4" {{ ($attribute->type == 4)? 'selected' : '' }}>چند انتخابی (select box)</option>
                                                        <option value="5" {{ ($attribute->type == 5)? 'selected' : '' }}>عبارت کوتاه با واحد</option>
                                                    </select>
                                                </td>
                                                <td class="c-ui-table__cell c-ui-table__cell--small-text">
                                                    <div class="c-ui-tooltip__anchor">
                                                        <div class="c-ui-toggle__group">
                                                            <label class="c-ui-toggle">
                                                                <input class="c-ui-toggle__origin js-toggle-active-product attr_required" type="checkbox"
                                                                    name="attr_required" {{ ($attribute->is_required)? 'checked' : '' }}>
                                                                <span class="c-ui-toggle__check"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="c-ui-table__cell c-ui-table__cell--small-text">
                                                    <div class="c-ui-tooltip__anchor">
                                                        <div class="c-ui-toggle__group">
                                                            <label class="c-ui-toggle">
                                                                <input class="c-ui-toggle__origin js-toggle-active-product attr_filterable"
                                                                 type="checkbox" name="attr_filterable"  {{ ($attribute->is_filterable)? 'checked' : '' }}>
                                                                <span class="c-ui-toggle__check"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="c-ui-table__cell c-ui-table__cell--small-text">
                                                    <div class="c-ui-tooltip__anchor">
                                                        <div class="c-ui-toggle__group">
                                                            <label class="c-ui-toggle">
                                                                <input class="c-ui-toggle__origin js-toggle-active-product attr_favorite"
                                                                    type="checkbox" name="attr_favorite"  {{ ($attribute->is_favorite)? 'checked' : '' }}>
                                                                <span class="c-ui-toggle__check"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15" style="text-align: right;">
                                                    <div class="uk-flex uk-flex-column">
                                                        @if(($attribute->type == 1) || ($attribute->type == 2))
                                                            <input type="text" class="c-content-input__origin attr_input_tag c-ui-input--deactive val_field" value="" disabled>
                                                        @elseif(($attribute->type == 3) || ($attribute->type == 4))
                                                            <input name='drag-sort' class="attr_input_tag" value='{{ $attribute->values }}'>
                                                        @elseif($attribute->type == 5)
                                                            <select name="attr_unit" class="uk-input uk-input--select attr_input_tag js-select-origin
                                                                select2-hidden-accessible" tabindex="-1" aria-hidden="true" aria-invalid="false">
                                                                @if(isset($units) && count($units))
                                                                    @foreach($units as $unit)
                                                                        <option value="{{ $unit->id }}" {{ ($attribute->unit_id == $unit->id)? 'selected' : '' }}>
                                                                            {{ $unit->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @endif
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
                                        <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">ایجاد ویژگی
                                            جدید
                                        </div>
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
                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--xs-gap"
                         style="width: 40%; float: left; display: contents;">
                        <a class="c-ui-btn c-ui-btn--next mr-a" style="margin-left: 68px;max-width: 100px;" id="submit-form">
                            ذخیره
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
                      با حذف ویژگی مورد نظر ، این ویژگی از فیلتر محصولات دسته انتخابی به صورت کامل
                      حذف شده و قابل بازیابی نمی باشد. آیا از حذف کامل آن اطمینان دارید؟
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
    <select name="attr_unit[]" class="uk-input uk-input--select attr_input_tag js-select-origin select2-hidden-accessible">
        @if(isset($units) && count($units))
        @foreach($units as $unit)
        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
        @endforeach
        @endif
    </select>
</div>
@endsection
@section('script')
<script>

$(document).ready(function (){
  $(".tagify").each(function (){
      $(this).removeClass('attr_input_tag');
  });
  generateSelectUi();

});

$(".attr_type").each(function () {
    if ($(this).val() == 1 || $(this).val() == 5) {
        $(this).closest('.row').find("input[name='attr_filterable']").attr('disabled', 'true');
    }

    if ($(this).val() == 2) {
        $(this).closest('.row').find("input[name='attr_favorite']").attr('disabled', 'true');
        $(this).closest('.row').find("input[name='attr_filterable']").attr('disabled', 'true');
    }
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

    var category_id = $("input[name='group_id']").val();
    var group_name = $("input[name='attr_group_name']").val();
    var group_desc = $("textarea[name='attr_group_desc']").val();

    var attr_name = $("input[name='attr_name']").map(function(){return $(this).val();}).get();

    var attr_type = $("select[name='attr_type']").map(function(){return $(this).val();}).get();

    var attr_required = $("input[name='attr_required']").map(function(){
        if($(this).is(':checked')){return 1;}else{return 0;}
    }).get();

    var attr_filterable = $("input[name='attr_filterable']").map(function(){
        if($(this).is(':checked')){return 1;}else{return 0;}
    }).get();

    var attr_favorite = $("input[name='attr_favorite']").map(function(){
        if($(this).is(':checked')){return 1;}else{return 0;}
    }).get();

    var attr_input_tag = $(".attr_input_tag").map(function(){return $(this).val();}).get();

    var position = $("tbody").sortable('serialize');

    var deleted_values = $("input[name='deleted_val']").map(function(){return $(this).val();}).get();

    var deleted_rows = $("input[name='deleted_row']").map(function(){return $(this).val();}).get();


    $.ajax({
        method: "post",
        url: '{{route('staff.attributes.store')}}',
        data: {
            positions:position,
            deleted_values: deleted_values,
            deleted_rows: deleted_rows,

            category_id: category_id,
            group_name: group_name,
            group_desc: group_desc,

            attr_names: attr_name,
            attr_types: attr_type,
            attr_requireds: attr_required,
            attr_filterables: attr_filterable,
            attr_favorites: attr_favorite,
            attr_values: attr_input_tag,
        },

        success: function () {
            window.location.href = "{{ route('staff.attributes.index') }}";
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

            $(".hide-tr").hide();
            $(".hide-tr").removeClass('hide-tr');
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

$("tbody").sortable({
    handle: '.c-content-upload__drag-handler',
});

$(document).on('click', '.c-mega-campaigns__btns-green-plus', function () {
    var tr = `
    <tr name="row" id="item-new" class="c-ui-table__row c-ui-table__row--body c-join__table-row row">
        <td class="c-ui-table__cell" style="padding-right:0;padding-left:23px">
            <div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">
                <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span>
                <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>
                <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>
            </div>
        </td>
        <td class="c-ui-table__cell" style="min-width:90px">
            <input class="c-content-input__origin js-attribute-old-value attr_name" name="attr_name">
        </td>
        <td class="c-ui-table__cell c-ui-table__cell--small-text td-select" style="text-align:right; min-width: 200px;">
            <select name="attr_type" class="uk-input uk-input--select js-select-origin attr_type select2-hidden-accessible"
             tabindex="-1" aria-hidden="true" aria-invalid="false">
                <option value="1" selected>عبارت کوتاه (text)</option>
                <option value="2">عبارت بلند (textarea)</option>
                <option value="3">تک انتخابی (select box)</option>
                <option value="4">چند انتخابی (select box)</option>
                <option value="5">عبارت کوتاه با واحد</option>
            </select>
        </td>
        <td class="c-ui-table__cell c-ui-table__cell--small-text">
            <div class="c-ui-tooltip__anchor">
                <div class="c-ui-toggle__group"><label class="c-ui-toggle">
                    <input class="c-ui-toggle__origin js-toggle-active-product attr_required" type="checkbox"
                    name="attr_required" value="1"> <span class="c-ui-toggle__check"></span></label>
                </div>
            </div>
        </td>
        <td class="c-ui-table__cell c-ui-table__cell--small-text">
        <div class="c-ui-tooltip__anchor">
            <div class="c-ui-toggle__group"><label class="c-ui-toggle"><input class="c-ui-toggle__origin
             js-toggle-active-product attr_filterable" type="checkbox" name="attr_filterable" value="1" disabled>
                <span class="c-ui-toggle__check"></span></label>
            </div>
        </div>
        </td>
        <td class="c-ui-table__cell c-ui-table__cell--small-text">
        <div class="c-ui-tooltip__anchor">
            <div class="c-ui-toggle__group">
            <label class="c-ui-toggle">
            <input class="c-ui-toggle__origin
            js-toggle-active-product attr_filterable" type="checkbox" name="attr_favorite">
            <span class="c-ui-toggle__check"></span>
            </label>
        </div>
        </div>
        </td>
        <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15">
        <div class="uk-flex uk-flex-column values-td">
            <input type="text" class="c-content-input__origin attr_input_tag
             c-ui-input--deactive val_field" disabled=""></div>
        </td>
        <td class="c-ui-table__cell">
        <div class="c-promo__actions" style="width:50%;margin:auto">
            <button type="button" class="c-content-upload__btn
            c-content-upload__btn--remove remove-btn"></button>
        </div>
        </td>
    </tr>`;

    $("#tbody").append(tr);
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
                let $selectionsContainerWidth = $this.siblings('.select2-container')
                    .find('ul.select2-selection__rendered').width() - 77;
                const $selections = $this.siblings('.select2-container')
                    .find('li.select2-selection__choice');

                $selections.removeClass('hidden');
                $selections.each(function () {
                    $selectionsContainerWidth -= $(this).outerWidth(true);
                    if ($selectionsContainerWidth < 0) {
                        $(this).addClass('hidden');
                    }
                });

                let $selectionsCount = $this.siblings('.select2-container')
                    .find('li.select2-selection__choice.hidden').length;
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
            let $selectionsContainerWidth = $this.siblings('.select2-container')
                .find('ul.select2-selection__rendered').width() - 77;
            const $selections = $this.siblings('.select2-container')
                .find('li.select2-selection__choice');

            $selections.removeClass('hidden');
            $selections.each(function () {
                $selectionsContainerWidth -= $(this).outerWidth(true);
                if ($selectionsContainerWidth < 0) {
                    $(this).addClass('hidden');
                }
            });

            let $counter = $this.siblings('.select-counter');
            let $selectionsCount = $this.siblings('.select2-container')
                .find('li.select2-selection__choice.hidden').length;

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
            let $selectionsContainerWidth = $this.siblings('.select2-container')
                .find('ul.select2-selection__rendered').width() - 77;
            const $selections = $this.siblings('.select2-container')
                .find('li.select2-selection__choice');

            $selections.removeClass('hidden');
            $selections.each(function () {
                $selectionsContainerWidth -= $(this).outerWidth(true);
                if ($selectionsContainerWidth < 0) {
                    $(this).addClass('hidden');
                }
            });

            let $selectionsCount = $this.siblings('.select2-container')
                .find('li.select2-selection__choice.hidden').length;
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
        let $selectionsContainerWidth = $this.siblings('.select2-container')
            .find('ul.select2-selection__rendered').width() - 77;
        const $selections = $this.siblings('.select2-container')
            .find('li.select2-selection__choice');

        $selections.removeClass('hidden');
        $selections.each(function () {
            $selectionsContainerWidth -= $(this).outerWidth(true);
            if ($selectionsContainerWidth < 0) {
                $(this).addClass('hidden');
            }
        });

        let $counter = $this.siblings('.select-counter');
        let $selectionsCount = $this.siblings('.select2-container')
            .find('li.select2-selection__choice.hidden').length;

        if ($selectionsCount > 0) {
            $counter.text($selectionsCount.toLocaleString('fa-IR'));
            $counter.css('display', 'flex');
        }
    }

});

$("input[name=drag-sort]").each(function () {
        var input = document.querySelector('input[name=drag-sort]'),
            tagify = new Tagify(this);
});

$('tbody').sortable({
    handle: '.c-content-upload__drag-handler',
});

$(document).on('change', '.attr_type', function (){
    if (($(this).val() == 1) || ($(this).val() == 2))
    {
        $(this).closest('.row').find("input[name='attr_filterable']").attr('disabled', 'true');
        var attr = $(this).closest('.row').find("input[name='attr_filterable']:checked");
        if(typeof attr !== typeof undefined && attr !== false) {
            attr.prop('checked', false);
        }

        $(this).closest('.row').find(".tagify").remove();

        var disabled_field = `
            <div class="uk-flex uk-flex-column values-td">
            <input type="text" class="c-content-input__origin attr_input_tag
                c-ui-input--deactive val_field" disabled="">
            </td>
        `;
        $(this).closest('.row').find(".values-td").replaceWith(disabled_field);
    }

    if ($(this).val() == 2){
        $(this).closest('.row').find("input[name='attr_favorite']").attr('disabled', 'true');
        var attr_filterable = $(this).closest('.row').find("input[name='attr_favorite']:checked");
        if(typeof attr_filterable !== typeof undefined && attr_filterable !== false){
            attr_filterable.prop('checked', false);
        }
    }

    if ($(this).val() == 1) {
        $(this).closest('.row').find("input[name='attr_favorite']").removeAttr('disabled');
    }

    if (($(this).val() == 3) || ($(this).val() == 4))
    {
        $(this).closest('.row').find("input[name='attr_filterable']").removeAttr('disabled');
        $(this).closest('.row').find("input[name='attr_favorite']").removeAttr('disabled');

        $(this).closest('.row').find(".tagify").remove();
        var tag_field = `
            <div class="uk-flex uk-flex-column values-td">
                <input name="drag-sort" class="drag-sort new-tag-input attr_input_tag val_field">
            </td>
        `;
        $(this).closest('.row').find(".values-td").replaceWith(tag_field);
        var input = document.querySelector('.new-tag-input');
        tagify = new Tagify(input);
        $(".drag-sort").removeClass("new-tag-input");
        $(".tagify").each(function (){
            $(this).removeClass('attr_input_tag');
        });
    }

    if ($(this).val() == 5)
    {
        $(this).closest('.row').find("input[name='attr_filterable']").attr('disabled', 'true');
        $(this).closest('.row').find("input[name='attr_favorite']").removeAttr('disabled');

        // var xxx = $(".select-unit:last").clone();

        var xxx = `
        <div class="uk-flex uk-flex-column values-td select-unit" style="display: none;">
            <select name="attr_unit[]" class="uk-input uk-input--select attr_input_tag
             js-select-origin select2-hidden-accessible">
                @if(isset($units) && count($units))
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        `;


        $(this).closest('.row').find(".values-td").replaceWith(xxx);
        $(this).closest('.row').find(".select2-container").remove();
        $(this).closest('.row').find(".select-unit").show();

        generateSelectUi();

        $("tags").each(function (){
            $(this).removeClass('attr_input_tag');
        });
    }
});

$(document).on('click', '.tagify__tag__removeBtn', function (){
    var deleted_id = $(this).closest('tag').attr('id');
    var deleted_tag = '<input name="deleted_val" value="' + deleted_id + '" hidden>';
    $('.c-main').append(deleted_tag);
});

</script>
@endsection
