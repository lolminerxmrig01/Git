@extends('layouts.staff.master')
@section('title') مدیریت واحدها | {{ $fa_store_name }}  @endsection
@section('head')
    <script src="{{ asset('mehdi/staff/js/tags.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('mehdi/staff/css/tagify.css') }}">
    <script src="{{ asset('mehdi/staff/js/jQuery.tagify.min.js') }}"></script>
    <script src="{{ asset('mehdi/staff/js/tagify.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('mehdi/staff/css/dragsort.css') }}"
         media="print" onload="this.media='all'">
    <script src="{{ asset('mehdi/staff/js/dragsort.js') }}"></script>

    <style>
        .select2-search {
            display: none;
        }

        .select2-selection__arrow {
            display: block !important;
        }

        .select2-search--dropdown {
            display: none;
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
                <div class="c-grid__row c-product-list--align-header" style="margin-bottom: 25px;">
                    <div class="c-grid__col">
                        <div class="c-card c-card--transparent">
                            <h1 class="c-card__title c-card__title--dark c-card__title--desc">
                                ایجاد و ویرایش واحد
                                <span>
                                    برای ایجاد و ویرایش  واحد ها از این قسمت استفاده نمایید
                                </span>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="js-table-container">
                    <div class="c-grid__row">
                        <div class="c-grid__col">
                            <div class="c-card">
                                <div class="c-card__wrapper">
                                    <div class="c-card__header c-card__header--table">
                                        <a target="_blank">
                                            <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                ایجاد واحد جدید
                                            </div>
                                        </a>
                                        <div class="c-ui-paginator js-paginator"></div>
                                    </div>
                                    <div class="c-card__body c-ui-table__wrapper">
                                        <table class="c-ui-table  js-search-table js-table-fixed-header c-join__table"
                                               data-search-url="/ajax/product/search/">
                                            <thead>
                                            <tr class="c-ui-table__row">
                                                <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap "></span>
                                                </th>
                                                <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap
                                                         table-header-searchable--desc">عنوان واحد</span>
                                                </th>
                                                <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap ">تعداد فیلد</span>
                                                </th>
                                                <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap ">فیلدها</span>
                                                </th>
                                                <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap ">حذف</span>
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody id="tbody">
                                            @if(isset($units) && !is_null($units))
                                                @foreach($units->unique() as $unit)
                                                    <tr name="row db-row" id="item-{{$unit->id}}" data-id="{{$unit->id}}"
                                                        class="c-ui-table__row c-ui-table__row--body c-join__table-row row db-row">
                                                        <td class="c-ui-table__cell" style="padding-right: 0px; padding-left: 23px;">
                                                            <div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">
                                                                <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span>
                                                                <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>
                                                                <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>
                                                            </div>
                                                        </td>
                                                        <td class="c-ui-table__cell" style="min-width: 90px">
                                                            <input type="text" name="unit_name" value="{{ ($unit->name)? $unit->name : '' }}"
                                                                class="c-content-input__origin js-unit-old-value attr_name">
                                                        </td>
                                                        <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: right; min-width: 200px;">
                                                            <select name="unit_type"  tabindex="-1" aria-hidden="true"
                                                                    class="uk-input uk-input--select js-select-origin select2-hidden-accessible"
                                                                    aria-invalid="false" disabled>
                                                                <option value="0" {{ ($unit->type == 0)? 'selected' : '' }}>تک فیلد</option>
                                                                <option value="1" {{ ($unit->type == 1)? 'selected' : '' }}>چند فیلد</option>
                                                            </select>
                                                        </td>
                                                        <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15">
                                                            <div class="uk-flex uk-flex-column">
                                                                @if($unit->type == 0)
                                                                    <input type="text" class="c-content-input__origin
                                                                        unit_input_tag c-ui-input--deactive val_field" value="" disabled>
                                                                @else
                                                                    <input name='drag-sort' class="unit_input_tag" value='{{ $unit->values }}'>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="c-ui-table__cell">
                                                            <div class="c-promo__actions" style="width: 50%; margin: auto;">
                                                                <button type="button" class="c-content-upload__btn
                                                                     c-content-upload__btn--remove remove-btn"></button>
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
                                            <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                ایجاد واحد جدید
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
                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial
                                 c-grid__col--lg-6 c-grid__col--xs-gap" style="width: 40%; loat: left; display: contents;">
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
                        <p class="c-modal-notification__text">با حذف واحد مورد نظر، این واحد از فیلتر محصولات دسته
                            انتخابی به صورت کامل حذف شده و قابل بازیابی نمی‌باشد. آیا از حذف کامل آن اطمینان دارید؟</p>
                        <div class="c-modal-notification__actions">
                            <button class="c-modal-notification__btn no uk-modal-close">خیر</button>
                            <button class="c-modal-notification__btn
                                c-modal-notification__btn--secondary yes uk-modal-close">
                                بله
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

            var unit_name = $("input[name='unit_name']").map(function(){return $(this).val();}).get();

            var unit_type = $("select[name='unit_type']").map(function(){return $(this).val();}).get();

            var unit_input_tag = $("input.unit_input_tag").map(function(){return $(this).val();}).get();

            var position = $("tbody").sortable('serialize');

            var deleted_values = $("input[name='deleted_val']").map(function(){return $(this).val();}).get();

            var deleted_rows = $("input[name='deleted_row']").map(function(){return $(this).val();}).get();


            $.ajax({
                method: "post",
                url: '{{route('staff.units.store')}}',
                data: {
                    positions:position,
                    unit_names: unit_name,
                    unit_types: unit_type,
                    unit_values: unit_input_tag,
                    deleted_values: deleted_values,
                    deleted_rows: deleted_rows,
                },

                success: function () {
                    window.location.href = "{{ route('staff.units.index') }}";
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
                                <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down">
                            </span>
                        </div>
                    </td>
                    <td class="c-ui-table__cell" style="min-width:90px">
                        <input class="c-content-input__origin js-unit-old-value unit_name" name="unit_name">
                    </td>
                    <td class="c-ui-table__cell c-ui-table__cell--small-text td-select" style="text-align:right; min-width: 200px;">
                        <select name="unit_type" class="uk-input uk-input--select js-select-origin attr_type select2-hidden-accessible"
                            tabindex="-1" aria-hidden="true" aria-invalid="false">
                            <option value="0" selected>تک فیلد</option>
                            <option value="1">چند فیلد</option>
                        </select>
                    </td>
                    <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15">
                    <div class="uk-flex uk-flex-column values-td">
                        <input type="text" class="c-content-input__origin unit_input_tag c-ui-input--deactive val_field" disabled></div>
                    </td>
                    <td class="c-ui-table__cell">
                        <div class="c-promo__actions" style="width:50%;margin:auto">
                            <button type="button" class="c-content-upload__btn c-content-upload__btn--remove remove-btn"></button>
                        </div>
                    </td>
                </tr>
            `;

            $("#tbody").append(tr);
            generateSelectUi();
        });

        function generateSelectUi() {
            $('.js-select-origin').each(function () {
                const $this = $(this);
                const isMultiSelect = $this.attr('multiple');
                const $placeholder = $this.attr('datas-placeholder') || '';
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

        $("input[name=drag-sort]").each(function () {
            var input = document.querySelector('input[name=drag-sort]'),
                tagify = new Tagify(this,{
                    tagTextProp: 'text',
                });

            var dragsort = new DragSort(tagify.DOM.scope, {
                selector:'.'+tagify.settings.classNames.tag,
                callbacks: {
                    dragEnd: onDragEnd
                }
            })

            function onDragEnd(elm){
                tagify.updateValueByDOMTags()
            }
        });


        $('tbody').sortable({
            handle: '.c-content-upload__drag-handler',
        });

        $(document).on('change', '.attr_type', function (){
            if (($(this).val() == 0))
            {
                $(".tags").each(function (){
                    $(this).remove();
                });
                $(this).closest('.row').find(".tagify").remove();
                var disabled_field = `
                    <div class="uk-flex uk-flex-column values-td">
                        <input type="text" class="c-content-input__origin unit_input_tag c-ui-input--deactive val_field" disabled>
                    </td>`;
                $(this).closest('.row').find(".values-td").replaceWith(disabled_field);
            }

            if (($(this).val() == 1))
            {
                $(this).closest('.row').find(".tagify").remove();
                var tag_field = '<div class="uk-flex uk-flex-column values-td"><input name="drag-sort" class="drag-sort new-tag-input unit_input_tag val_field"></td>';
                $(this).closest('.row').find(".values-td").replaceWith(tag_field);

                var input = document.querySelector('.new-tag-input');
                tagify = new Tagify(input);

                new DragSort(tagify.DOM.scope, {
                    selector: '.' + tagify.settings.classNames.tag,
                    callbacks: {
                        dragEnd: onDragEnd
                    }
                });

                function onDragEnd(elm) {
                    tagify.updateValueByDOMTags()
                }

                $(".drag-sort").removeClass("new-tag-input");

            }
        });

        $(document).on('click', '.tagify__tag__removeBtn', function (){
            var deleted_id = $(this).closest('tag').attr('id');
            var deleted_tag = '<input name="deleted_val" value="' + deleted_id + '" hidden>';
            $('.c-main').append(deleted_tag);
        });

        var input = document.querySelector('input[name=input-sort]'),
            tagify = new Tagify(input);

        var dragsort = new DragSort(tagify.DOM.scope, {
            selector:'.'+tagify.settings.classNames.tag,
            callbacks: {
                dragEnd: onDragEnd
            }
        })

        function onDragEnd(elm){
            tagify.updateValueByDOMTags()
        }
</script>

@endsection
