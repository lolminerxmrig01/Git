@extends('layouts.staff.master')
@section('title') مدیریت تنوع | {{ $fa_store_name }}  @endsection
@section('head')
    <script src="{{ asset('mehdi/staff/js/tags.js') }}"></script>
    <script src="{{ asset('mehdi/staff/js/jquery-ui.min.js') }}"></script>
    <!-- <script src="{{ asset('seller/js/tags3.js') }}"></script> -->
@endsection
@section('content')
<main class="c-content-layout">
    <div class="uk-container uk-container-large">
        <div class="c-grid" data-select2-id="137">
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <input type="hidden" value="" name="has-warehouses">
                    <div class="c-card c-card--transparent">
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc">مدیریت تنوع<span>از این صفحه می‌توانید تنوع و گروه تنوع‌ها را مدیریت کنید</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="js-table-container" data-select2-id="17">
                <div style="margin-top: 20px; margin-bottom: 20px;"></div>
                <div class="content-section">
                  <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card" data-select2-id="136">
                            <div class="c-grid__col">
                                <div class="product-form">
                                    <div class="c-grid__row">
                                        <div class="c-card">
                                            <div class="c-card__wrapper">
                                                <div class="c-card__header c-card__header--table" style="display: flow-root;">
                                                    <a style="float: right">
                                                        <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                                ایجاد گروه تنوع جدید
                                                        </div>
                                                    </a>

                                                    <a href="{{ route('staff.variants.variantCategory') }}" target="_blank" style="float: right;margin-right: 13px;">
                                                        <div class="c-mega-campaigns__btns-green uk-margin-remove" style="line-height: 1.771 !important;background-color: #4fcce9;box-shadow: 0 6px 12px 0 rgb(79 193 233 / 30%);color: white;">
                                                            تعیین تنوع مجاز
                                                        </div>
                                                    </a>

                                                    <div class="c-ui-paginator js-paginator" style="margin-top: 10px;">
                                                        <div class="c-ui-paginator__total" data-rows="۶">
                                                            تعداد نتایج: <span name="total" data-id="{{ $variant_groups->count() }}">{{ persianNum($variant_groups->count()) }} مورد</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="c-card__body c-ui-table__wrapper">
                                                    <table class="c-ui-table js-search-table js-table-fixed-header c-join__table" >
                                                        <thead>
                                                        <tr class="c-ui-table__row">
                                                            <th class="c-ui-table__header">
                                                                <span class="table-header-searchable uk-text-nowrap "></span>
                                                            </th>
                                                            <th class="c-ui-table__header"><span
                                                                    class="table-header-searchable uk-text-nowrap "> عنوان گروه تنوع </span>
                                                            </th>
                                                            <th class="c-ui-table__header"><span
                                                                    class="table-header-searchable uk-text-nowrap table-header-searchable--desc"> تعداد تنوع‌ها </span>
                                                            </th>
                                                            <th class="c-ui-table__header"><span
                                                                    class="table-header-searchable uk-text-nowrap "> توضیحات گروه تنوع</span>
                                                            </th>
                                                            <th class="c-ui-table__header"><span
                                                                    class="table-header-searchable uk-text-nowrap "> فعال / غیرفعال </span>
                                                            </th>
                                                            <th class="c-ui-table__header"><span
                                                                    class="table-header-searchable uk-text-nowrap ">عملیات</span>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tbody">
                                                            @foreach($variant_groups as $variantGroup)
                                                                <tr name="row" id="item-{{$variantGroup->id}}" class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                                                                    <td class="c-ui-table__cell" style="padding-right: 0px; padding-left: 23px;">
                                                                        <div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">
                                                                            <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span>
                                                                            <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>
                                                                            <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15" style="min-width: 90px">
                                                                        <div class="uk-flex uk-flex-column">
                                                                            <a href="#" target="_blank">
                                                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                                                                {{ $variantGroup->name }}
                                                                                </span>
                                                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial"></span>
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                    <td class="c-ui-table__cell">
                                                                        {{ (isset($variantGroup->variants) && count($variantGroup->variants))? persianNum(count($variantGroup->variants)) : persianNum(0) }}
                                                                    </td>
                                                                    <td class="c-ui-table__cell">
                                                                        {{ ($variantGroup->description)? $variantGroup->description : '' }}
                                                                    </td>
                                                                    <td class="c-ui-table__cell c-ui-table__cell--small-text">
                                                                        <div class="c-ui-tooltip__anchor">
                                                                            <div class="c-ui-toggle__group">
                                                                                <label class="c-ui-toggle">
                                                                                    <input class="c-ui-toggle__origin js-toggle-active-product" type="checkbox" data-group-id="{{ $variantGroup->id }}" name="status" {{ ($variantGroup->status)? 'checked' : '' }}>
                                                                                    <span class="c-ui-toggle__check"></span>
                                                                                </label>
                                                                                </label>
                                                                            </div>

                                                                        </div>
                                                                    </td>

                                                                    <td class="c-ui-table__cell">
                                                                        <div class="c-promo__actions">
                                                                            <a class="c-join__btn c-join__btn--icon-right c-join__btn--icon-edit c-join__btn--secondary-greenish" href="{{ route('staff.variants.edit', $variantGroup->id) }}">ویرایش</a>
                                                                            <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete c-join__btn--primary js-remove-plp js-remove-product-list delete-btn" value="{{ $variantGroup->id }}" {{ ($variantGroup->type == 0)? 'disabled' : '' }}>حذف</button>
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="c-card__footer" style="width: auto;">
                                                    <a>
                                                        <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                            ایجاد گروه تنوع جدید
                                                        </div>
                                                    </a>

                                                    <div class="c-ui-paginator js-paginator" data-select2-id="25">
                                                        <div class="c-ui-paginator__total" data-rows="۶">
                                                            تعداد نتایج: <span name="total" data-id="{{ $variant_groups->count() }}">{{ persianNum($variant_groups->count()) }} مورد</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>



    <div id="newVariantRequestModal" class="marketplace-redesign uk-modal c-variant" uk-modal="" style="display: none;">
        <div class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body c-content-modal" id="newBrandRequestModalContent">
            <button class="uk-modal-close uk-modal-close--search uk-close uk-icon" type="button" uk-close=""></button>
            <form id="newBrandRequestForm" novalidate="novalidate">
                <div class="c-content-modal__header c-content-modal__header--overflow">
                    <h3 class="c-content-modal__title">ایجاد گروه تنوع جدید</h3>
                </div>
                <div class="c-content-modal__body c-content-modal__body--overflow">
                    <div class="c-content-modal__body-container">
                        <div class="c-content-modal__intro">
                            پس از ایجاد گروه تنوع برای افزودن تنوع به آن، از طریق همین صفحه بر روی دکمه ویرایش کلیک کنید
                        </div>

                        <div class="c-grid__row c-grid__row--gap-lg mt-30">
                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6">
                                <label for="" class="uk-form-label">
                                    نام گروه تنوع:
                                    <span class="uk-form-label__required"></span>
                                </label>
                                <div class="field-wrapper c-autosuggest">
                                    <div class="search-form__autocomplete js-autosuggest-box">
                                        <input id="searchKeywordInput" class="uk-input js-prevent-submit" type="text" 
                                        name="variant_name" placeholder="نام گروه تنوع را وارد کنید ...">
                                        <ul class="c-autosuggest__list-container" style="display: none;"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="c-grid__row c-grid__row--gap-lg">
                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                <label class="uk-form-label">
                                    توضیحات (اختیاری):
                                </label>
                                <div id="variantDescription" class="field-wrapper">
                                    <textarea name="variant_desc" class="uk-textarea" cols="" rows="3" placeholder="توضیحات گروه تنوع را در صورت تمایل وارد کنید ..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="c-grid__row c-grid__row--gap-lg">
                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--row-attr">
                                <label class="uk-form-label">
                                    نوع نمایش:
                                    <span class="uk-form-label__required"></span>
                                </label>
                                <div id="brandOrigin" class="field-wrapper">
                                    <label class="c-ui-radio c-ui-radio--content c-ui-checkbox--auto">
                                        <input type="radio" class="c-ui-radio__origin js-brand-origin" name="variant_type" value="1" id="iranianBrandContainer" checked="">
                                        <span class="c-ui-radio__check c-ui-radio__check--content"></span>
                                        <span class="c-ui-radio__label c-ui-radio__label--content">متن</span>
                                    </label>
                                    <label class="c-ui-radio c-ui-radio--content c-ui-checkbox--auto">
                                        <input type="radio" class="c-ui-radio__origin js-brand-origin" name="variant_type" id="foreignBrandContainer" value="2">
                                        <span class="c-ui-radio__check c-ui-radio__check--content"></span>
                                        <span class="c-ui-radio__label c-ui-radio__label--content">کد رنگ</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="c-content-modal__footer c-content-modal__footer--overflow">
                    <button class="modal-footer__btn modal-footer__btn--confirm modal-footer__btn--wide
                        js-modal-uploads-confirm js-accept save-btn" type="button" id="saveBrandRequestButton">
                        <span id="brandRequestBtnLabel">ایجاد گروه تنوع</span>
                    </button>

                    <button class="modal-footer__btn modal-footer__btn--wide uk-close uk-modal-close js-decline" type="button"
                            id="cancelBrandRequestButton">انصراف
                    </button>
                </div>
            </form>
            <div class="c-content-loader">
                <div class="c-content-loader__logo"></div>
                <div class="c-content-loader__spinner"></div>
            </div>
        </div>
    </div>

    <div uk-modal="esc-close: true; bg-close: true;" class="uk-modal-container uk-modal-container--message
     js-common-modal-notification uk-modal" style="display: none;">
        <div class="uk-modal-dialog uk-modal-dialog--flex">
            <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""></button>

            <div class="uk-modal-body">
                <div class="c-modal-notification">
                    <div class="c-modal-notification__content c-modal-notification__content--limited">
                        <h2 class="c-modal-notification__header">هشدار</h2>
                        <p class="c-modal-notification__text">
                            با حذف این گروه، تمامی تنوع‌های ایجاد شده برای محصولات که از تنوع‌های این گروه
                             استفاده می کنند به صورت کامل حذف خواهند شد. آیا از حذف کامل آن اطمینان دارید؟
                        </p>
                        <div class="c-modal-notification__actions">
                            <button class="c-modal-notification__btn no uk-modal-close">خیر</button>
                            <button class="c-modal-notification__btn c-modal-notification__btn--secondary yes uk-modal-close">بله</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>
@endsection
@section('script')
<script>


    // اضافه کردن توکن به درخواست های ایجکس
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.c-mega-campaigns__btns-green-plus', function () {
        console.log('clicked...');
        $("#newVariantRequestModal").addClass('uk-open');
        $("#newVariantRequestModal").css('display', 'block');
        $('.c-header__nav').hide();
    });

    // ایجکس فرم پاپ آپ
    $('.save-btn').on('click', function (e) {
        // e.preventDefault();

        var name = $("input[name='variant_name']").val();
        var type = $("input:checked[name='variant_type']").val();
        var desc = $("textarea[name='variant_desc']").val();

        if (name) {
            $.ajax({
                method: "post",
                url: '{{route('staff.variants.storeGroup')}}',
                data: {
                    name: name,
                    description: desc,
                    type: type,
                },
                success: function (result) {
                    $("#newVariantRequestModal").hide();
                    $('#variant-grup').trigger("reset");
                    $('.uk-input').val('');
                    $('.uk-textarea').val('');
                    $('.c-header__nav').show();
                    $(".content-section").replaceWith(result);
                },

                error: function (response) {
                    //
                }
            });
        }
    });


    $(document).on('click', '.uk-close', function () {
        $('.c-header__nav').show();
    });

    $(document).on('click', '.no', function (){
        $('.c-header__nav').show();
    });

    $(document).on('click', '.delete-btn', function () {
        var id = $(this).val();

        $(".uk-modal-container").addClass('uk-open');
        $(".uk-modal-container").css('display', 'block');

        $(document).on('click', '.yes', function (){

            $('.c-header__nav').show();

            $.ajax({
                method: 'post',
                url: "{{ route('staff.variants.deleteGroup') }}",
                data: {
                    'id': id,
                },
                success: function (){
                    $.toast({
                        heading: 'موفق!',
                        text: "گروه با موفقیت حذف شد",
                        bgColor: '#3DC3A1',
                        textColor: '#fff',
                    });

                    var category_id = $("input[type='radio']:checked").val();

                    $.ajax({
                        method: "post",
                        url: '{{route('staff.variants.getData')}}',
                        data: {
                            category_id: category_id,
                        },
                        success: function (result) {
                            $(".content-section").replaceWith(result);
                        },
                    });

                },
            });

        });

    });

    $(document).on('change', 'input[name="status"]', function () {
        if($(this).is(':checked'))
        {
            var status = 1;
        }
        else{
            var status = 0;
        }
        var data_group_id = $(this).attr('data-group-id');

        $.ajax({
            method: 'post',
            url: "{{ route('staff.variants.statusGroup') }}",
            data: {
                'status': status,
                'group_id' : data_group_id,
            },
            success: function (){
                var category_id = $("input[type='radio']:checked").val();

                $.ajax({
                    method: "post",
                    url: '{{route('staff.variants.getData')}}',
                    data: {
                        category_id: category_id,
                    },
                    success: function (result) {
                        $(".content-section").replaceWith(result);
                    },
                });

            },
        });
    });

    $('tbody').sortable({
        handle: '.c-content-upload__drag-handler',
        update: function (event, ui) {
            var data = $("tbody").sortable('serialize');
            $.ajax({
                data: data,
                type: 'post',
                url: '{{route('staff.variants.indexChangePosition')}}'
            });
        }
    });

</script>
@endsection
