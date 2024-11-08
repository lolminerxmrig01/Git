@extends('layouts.staff.master')
@section('title') ویرایش گروه تنوع | {{ $fa_store_name }}  @endsection
@section('head')
<script src="{{ asset('mehdi/staff/js/jquery-ui.min.js') }}"></script>
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
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc">ویرایش گروه تنوع
                            <span>
                            برای ویرایش  گروه تنوع و ایجاد تنوع برای آن از این قسمت استفاده نمایید
                        </span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <div class="c-card">
                        <h2 style="font-size: 18px;margin-right: 33px;margin-top: 28px;margin-bottom: -30px;">
                            <div style="color: #606265;">اطلاعات گروه تنوع</div>
                        </h2>
                        <div style="width: 100%;margin: -7px 0px 50px 0px !important;padding: 0px !important;background: #e2dddd;height: 1px;display: none;"></div>
                        <div class="c-card__header"></div>
                        <div class="c-card__body">
                            <div class="c-grid__row c-grid__row--gap-lg">
                                <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 ">
                                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 c-grid__col--xs-gap">
                                            <label for="" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">نام گروه تنوع
                                                <span class="uk-form-label__required"></span>
                                            </label>
                                            <div class="field-wrapper">
                                                <label class="c-content-input">
                                                    <input name="group_id" class="group_id" value="{{ $variantGroup->id }}" hidden>
                                                    <input type="text" class="c-content-input__origin c-content-input__origin variant_group_name"
                                                           name="variant_group_name" value="{{ $variantGroup->name }}" dir="rtl" style="text-align: right;">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 ">
                                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">

                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 c-grid__col--xs-gap">

                                            <label for="" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">نوع نمایش
                                                <span class="uk-form-label__required"></span>
                                            </label>

                                            <div class="field-wrapper">
                                                <label class="c-content-input">
                                                    <select name="variant_type" class="uk-input uk-input--select variant_type js-select-origin select2-hidden-accessible"
                                                            tabindex="-1" aria-hidden="true" aria-invalid="false" disabled>
                                                        <option value="0" {{ ($variantGroup->type == 0)? 'selected' : '' }}>بدون تنوع</option>
                                                        <option value="1" {{ ($variantGroup->type == 1)? 'selected' : '' }}>متن</option>
                                                        <option value="2" {{ ($variantGroup->type == 2)? 'selected' : '' }}>کد رنگ</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-grid__row c-grid__row--gap-lg">
                                <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                    <label for="" class="uk-form-label" style="color: #606265;margin-bottom: 8px;">توضیحات (اختیاری)</label>
                                    <div class="field-wrapper field-wrapper--textarea">
                                        <textarea name="variant_group_desc" class="c-content-input__origin
                                         c-content-input__origin--textarea js-textarea-words variant_group_desc"
                                          rows="2" maxlength="1000" @if(!$variantGroup->description)placeholder="در صورت تمایل اطلاعات گروه تنوع را وارد کنید ..."@endif
                                        >{{ ($variantGroup->description)? $variantGroup->description : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="js-table-container {{ ($variantGroup->type == 0)? 'uk-hidden' : '' }}">
                <div class="c-grid__row" style="margin-top:30px">
                    <div class="c-grid__col">
                        <div class="c-card">
                            <div class="c-card__wrapper">
                                <div class="c-card__header c-card__header--table"><a target="_blank">
                                        <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">ایجاد تنوع
                                            جدید
                                        </div>
                                    </a>
                                    <div class="c-ui-paginator js-paginator">
                                    </div>
                                </div>
                                <div class="c-card__body c-ui-table__wrapper">
                                    <table class="c-ui-table  js-search-table js-table-fixed-header c-join__table">
                                        <thead>
                                        <tr class="c-ui-table__row">
                                            <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap"></span>
                                            </th>
                                            <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap table-header-searchable--desc">عنوان تنوع</span>
                                            </th>
                                            <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap">فعال / غیرفعال</span>
                                            </th>
                                            @if($variantGroup->type == 2)
                                                <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap table-header-searchable--desc">کد رنگ</span>
                                                </th>
                                            @endif
                                            <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap">حذف</span>
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody id="tbody">
                                          @if(isset($variants) && !is_null($variants))
                                            @foreach($variants->unique() as $variant)
                                              <tr name="row db-row" id="item-{{$variant->id}}" data-id="{{$variant->id}}" class="c-ui-table__row c-ui-table__row--body c-join__table-row row db-row">
                                                <input name="variant_id" value="{{ $variant->id }}" hidden>
                                                <td class="c-ui-table__cell" style="padding-right: 0px; padding-left: 23px;">
                                                    <div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">
                                                        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span>
                                                        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>
                                                        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>
                                                    </div>
                                                </td>
                                                <td class="c-ui-table__cell" style="min-width: 90px">
                                                    <input type="text" name="variant_name" value="{{ ($variant->name)? $variant->name : '' }}" class="c-content-input__origin js-variant-old-value variant_name">
                                                </td>
                                                <td class="c-ui-table__cell c-ui-table__cell--small-text">
                                                    <div class="c-ui-tooltip__anchor">
                                                        <div class="c-ui-toggle__group">
                                                            <label class="c-ui-toggle">
                                                                <input class="c-ui-toggle__origin js-toggle-active-product variant_status"
                                                                    type="checkbox" name="variant_status"  {{ ($variant->status)? 'checked' : '' }}>
                                                                <span class="c-ui-toggle__check"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                  @if($variantGroup->type == 2)
                                                  <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15" style="text-align: right;">
                                                    <div class="uk-flex uk-flex-column">

                                                        <input type="color" name="variant_value" value="{{ (!is_null($variant->value))? $variant->value : '' }}" class="c-content-input__origin js-variant-old-value variant_value">
                                                    </div>
                                                  </td>
                                                  @endif
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
                                        <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">ایجاد تنوع
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

                    <p class="c-modal-notification__text">با حذف تنوع مورد نظر ، این تنوع از فیلتر محصولات دسته
                        انتخابی به صورت کامل حذف شده و قابل بازیابی نمی‌باشد. آیا از حذف کامل آن اطمینان دارید؟</p>
                    <div class="c-modal-notification__actions">
                        <button class="c-modal-notification__btn no uk-modal-close">خیر</button>
                        <button
                            class="c-modal-notification__btn c-modal-notification__btn--secondary yes uk-modal-close">
                            بله
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="uk-flex uk-flex-column values-td select-unit" style="display: none;">
</div>
@endsection
@section('script')
<script>

// اضافه کردن توکن به درخواست های ایجکس
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// ایجکس فرم اصلی
$('#submit-form').on('click', function (e) {
    // e.preventDefault();

    var group_id = $("input[name='group_id']").val();
    var group_name = $("input[name='variant_group_name']").val();
    var group_desc = $("textarea[name='variant_group_desc']").val();

    var variant_name = $("input[name='variant_name']").map(function(){return $(this).val();}).get();
    var variant_value = $("input[name='variant_value']").map(function(){return $(this).val();}).get();
    var variant_status = $("input[name='variant_status']").map(function(){
        if($(this).is(':checked')){return 1;}else{return 0;}
    }).get();

    var position = $("tbody").sortable('serialize');
    var deleted_rows = $("input[name='deleted_row']").map(function(){return $(this).val();}).get();


    $.ajax({
        method: "post",
        url: '{{route('staff.variants.store')}}',
        data: {
            positions:position,
            deleted_rows: deleted_rows,

            group_id: group_id,
            group_name: group_name,
            group_desc: group_desc,

            variant_names: variant_name,
            variant_values: variant_value,
            variant_status: variant_status,
        },

        success: function () {
            window.location.href = "{{ route('staff.variants.index') }}";
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

    if($("select[name='variant_type']").val() == 2) {
        var td = '<td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15"><div class="uk-flex uk-flex-column values-td"><input type="color" class="c-content-input__origin js-variant-old-value variant_value" name="variant_value"></div></td>';
    } else {
        var td = '';
    }

    var tr = '<tr name="row" id="item-new" class="c-ui-table__row c-ui-table__row--body c-join__table-row row"><td class="c-ui-table__cell" style="padding-right:0;padding-left:23px">' +
        '<div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer"><span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span> ' +
        '<span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span> <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down">' +
        '</span></div></td><td class="c-ui-table__cell" style="min-width:90px"><input class="c-content-input__origin js-variant-old-value variant_name" name="variant_name"></td>' +
        '<td class="c-ui-table__cell c-ui-table__cell--small-text"><div class="c-ui-tooltip__anchor"><div class="c-ui-toggle__group"><label class="c-ui-toggle"><input class="c-ui-toggle__origin js-toggle-active-product variant_status" type="checkbox" name="variant_status" checked> ' +
        '<span class="c-ui-toggle__check"></span></label></div></div></td>' +
        td +
        '<td class="c-ui-table__cell"><div class="c-promo__actions" style="width:50%;margin:auto">' +
        '<button type="button" class="c-content-upload__btn c-content-upload__btn--remove remove-btn"></button></div></td></tr>';

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
