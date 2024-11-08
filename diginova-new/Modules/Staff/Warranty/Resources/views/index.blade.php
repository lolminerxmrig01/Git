@extends('layouts.staff.master')
@section('title') مدیریت گارانتی‌ها | {{ $fa_store_name }}  @endsection
@section('head')
    <script src="{{ asset('mehdi/staff/js/indexAction.js') }}"></script>
    <script src="{{ asset('mehdi/staff/js/tableView.js') }}"></script>
@endsection
@section('content')
<main class="c-main">
    <div class="uk-container uk-container-large">
        <div class="c-grid ">
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <input type="hidden" value="" name="has-warehouses">
                    <div class="c-card c-card--transparent">
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc">
                            مدیریت گارانتی‌ها
                            <span>از این صفحه می‌توانید گارانتی‌ها را مدیریت کنید</span>
                        </h1>
                    </div>
                </div>
            </div>
            @if ($warranties->count())
                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card" id="consignment-step-1">
                            <div class="c-card__header">
                                <h2 class="c-card__title">جستجو و فیلتر</h2>
                            </div>
                            <div class="c-card__body">
                                <div class="c-ui-form__row">
                                    <div class="c-ui-form__col c-ui-form__col--8 c-ui-form__col--xs-12">
                                        <label class="c-ui-form__label">جستجو بر اساس:</label>
                                        <div class="c-ui-form__row">
                                            <div
                                                class="c-ui-form__col c-ui-form__col--3 c-ui-form__col--xs-12
                                                 c-ui-form__col--small-gap c-ui-form__col--xs c-ui-form__col--wrap-xs"
                                                style="min-width: 175px" >
                                                <select
                                                    class="c-ui-select c-ui-select--common c-ui-select--small js-form-clearable select2-hidden-accessible"
                                                    name="searchGroup" tabindex="-1"
                                                    aria-hidden="true" id="searchGroup">
                                                    <option value="warranty_name" selected>نام گارانتی</option>
                                                    <option value="warranty_category">گروه کالا</option>
                                                </select>
                                            </div>
                                            <div
                                                class="c-ui-form__col c-ui-form__col--6 c-ui-form__col--xs-12
                                                    c-ui-form__col--small-gap c-ui-form__col--wrap-xs c-ui-form__col--xs">
                                                <label>
                                                    <div class="c-ui-input">
                                                        <input type="text" name="searchKeyword" class="c-ui-input__field c-ui-input__field--order
                                                            js-form-clearable" id="searchKeyword" value="" placeholder="عنوان را بنویسید ...">
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="c-ui-form__col c-ui-form__col--xs-12 c-ui-form__col--small-gap
                                             c-ui-form__col--wrap-xs c-ui-form__col--xs">
                                                <button class="c-ui-btn c-ui-btn--xs-block c-ui-btn--active c-ui-btn--search-form"
                                                    id="search-btn" disabled>
                                                    <span>جستجو</span>
                                                </button>
                                            </div>
                                            <div class="c-ui-form__col c-ui-form__col--xs-12 c-ui-form__col--small-gap c-ui-form__col--wrap-xs
                                             c-ui-form__col--xs">
                                                <button type="button"
                                                        class="c-ui-btn c-ui-btn--xs-block c-ui-btn--active c-ui-btn--clear-form"
                                                        id="searchClear" disabled=""></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="js-table-container">
                    <input name="page_type" value="index" hidden>
                    <div style="margin-top: 20px; margin-bottom: 20px;"></div>
                    <div class="c-grid__row">
                        <div class="c-grid__col">
                            <div class="c-card">
                                <div class="c-card__wrapper">
                                    <div class="c-card__header c-card__header--table">
                                        <a href="{{ route('staff.warranties.create') }}" target="_blank">
                                            <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                ایجاد گارانتی جدید
                                            </div>
                                        </a>
                                        @if($trashed_warranties->count())
                                        <div class="c-grid__col c-grid__col--lg-4">
                                            <a href="{{ route('staff.warranties.trash') }}" class="c-ui-btn js-view-all-orders">
                                                مدیریت گارانتی‌های حذف شده
                                            </a>
                                        </div>
                                        @endif
                                        <div class="c-ui-paginator js-paginator">
                                            <div class="c-ui-paginator__total">
                                                تعداد نتایج: <span name="total" data-id="{{ $warranties->total() }}">
                                                    {{ persianNum($warranties->total()) }} مورد
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-card__body c-ui-table__wrapper">
                                        <table class="c-ui-table js-search-table js-table-fixed-header c-join__table"
                                               data-search-url="/ajax/product/search/">
                                            <thead>
                                            <tr class="c-ui-table__row">
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap "> ردیف </span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap table-header-searchable--desc">نام گارانتی</span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap "> گروه کالایی </span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap ">تعداد تنوع</span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap ">عملیات</span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody">
                                            @foreach($warranties as $key => $warranty)
                                                <tr name="row" id="{{$warranty->id}}" class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                                                    <td class="c-ui-table__cell">
                                                        <span class="c-wallet__body-card-row-item">
                                                             {{ persianNum($warranties->firstItem() + $key) }}
                                                        </span>
                                                    </td>
                                                    <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15">
                                                        <div class="uk-flex uk-flex-column">
                                                            <a href="#" target="_blank">
                                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                                                  @if($warranty->month !== null)
                                                                    {{ 'گارانتی ' . persianNum($warranty->month) . ' ' . ' ماهه ' . $warranty->name  }}
                                                                  @else
                                                                    {{ 'گارانتی ' . $warranty->name  }}
                                                                  @endif
                                                                </span>
                                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial"></span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="c-ui-table__cell">
                                                        <a href="#">
                                                            <div class="uk-flex uk-flex-column">
                                                                  <span class="c- -card-row-item" style="line-height: 23px;">
                                                                    @foreach($warranty->categories as $category)
                                                                          {{ $category->name }}&nbsp;<br>
                                                                    @endforeach
                                                                  </span>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="c-ui-table__cell"><span class="c-wallet__body-card-row-item">
                                                        {{ persianNum($warranty->product_variants->count()) }}
                                                    </span>
                                                    </td>
                                                    <td class="c-ui-table__cell">
                                                        <div class="c-promo__actions">
                                                            <a class="c-join__btn c-join__btn--icon-right c-join__btn--icon-edit
                                                             c-join__btn--secondary-greenish" href="{{ route('staff.warranties.edit', $warranty->id) }}">
                                                                ویرایش
                                                            </a>
                                                            @if($warranty->id !== 1)
                                                                <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete
                                                                    c-join__btn--primary js-remove-plp js-remove-product-list delete-btn"
                                                                    value="{{ $warranty->id }}">
                                                                    حذف
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="c-card__footer" style="width: auto;">
                                        <a href="{{ route('staff.warranties.create') }}">
                                            <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                ایجاد گارانتی جدید
                                            </div>
                                        </a>

                                        {{ $warranties->links('staffwarranty::layouts.pagination.pagination') }}

                                        <div class="c-ui-paginator js-paginator">
                                            <div class="c-ui-paginator__total" data-rows="۶">
                                                تعداد نتایج: <span name="total" data-id="{{ $warranties->total() }}">
                                                    {{ persianNum($warranties->total()) }} مورد
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="c-grid c-join__grid">
                    <div class="c-grid__row">
                        <div class="c-grid__col">
                            <div class="c-card">
                                <div class="c-card__body">
                                    <div class="c-grid__col">
                                        <div class="c-grid__col c-promo__tab-container c-promo__tab-container--is-visible" data-tab="1">
                                            <div class="c-join__promotion-info-box c-join__promotion-info-box--empty">
                                                <img class="c-join__promotion-info-img" src="{{ asset('mehdi/staff/images/no-content.svg') }}" alt="Empty">
                                                 @if($trashed_warranties->count())
                                                    <p class="c-join__promotion-info-statement c-join__promotion-info-statement--bg">
                                                        نتیجه‌ای برای نمایش وجود ندارد!
                                                    </p>
                                                    <p class="c-join__promotion-info-statement">
                                                        شما تعداد {{ persianNum($trashed_warranties->count()) }} گارانتی حذف شده در Trash
                                                        دارید برای مدیریت و بازگردانی آنها بر روی دکمه زیر کلیک کنید
                                                    </p>
                                                    <a class="c-join__btn c-join__btn--info-box c-join__btn--secondary-greenish"
                                                       href="{{ route('staff.warranties.trash') }}">ورود به صفحه Trash</a>
                                                @else
                                                    <p class="c-join__promotion-info-statement c-join__promotion-info-statement--bg">
                                                        شما تا به حال هیچ گارانتی ایجاد نکرده‌اید
                                                    </p>
                                                    <p class="c-join__promotion-info-statement">
                                                        برای ایجاد گارانتی جدید روی دکمه زیر کلیک کنید.
                                                    </p>
                                                    <a class="c-join__btn c-join__btn--info-box c-join__btn--secondary-greenish"
                                                       href="{{ route('staff.warranties.create') }}">ایجاد گارانتی جدید</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
@section('script')
<script>

// تبدیل اعداد انگلیسی به فارسی
function ConvertNumberToPersion() {
    persian = { 0: '۰', 1: '۱', 2: '۲', 3: '۳', 4: '۴', 5: '۵', 6: '۶', 7: '۷', 8: '۸', 9: '۹' };
    function traverse(el) {
        if (el.nodeType == 3) {
            var list = el.data.match(/[0-9]/g);
            if (list != null && list.length != 0) {
                for (var i = 0; i < list.length; i++)
                    el.data = el.data.replace(list[i], persian[list[i]]);
            }
        }
        for (var i = 0; i < el.childNodes.length; i++) {
            traverse(el.childNodes[i]);
        }
    }
    traverse(document.body);
}

// توکن csrf
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// پجینیشن
$(document).on('click', '.c-ui-paginator__control a', function(e){
    e.preventDefault();

    var page = $(this).attr('href').split('page=')[1];

    var pageType = $("input[name='page_type']").val();

    if (pageType == 'index'){
        var url = "{{route('staff.warranties.ajaxPagination')}}?page="+page;
    }
    else if (pageType == 'only_special') {
        var url = "{{route('staff.warranties.filterByType')}}?page="+page;
    }
    else if(pageType == 'warrantySearch') {
        var url = "{{route('staff.warranties.warrantySearch')}}?page="+page;
    }
    else if(pageType == 'warrantyCatSearch') {
        var url = "{{route('staff.warranties.warrantyCatSearch')}}?page="+page;
    }

    if(pageType == 'warrantyCatSearch' || pageType == 'warrantySearch')
    {
        var searchValue = $("#searchKeyword").val();
        var data = {
            page: page,
            search_keyword: searchValue,
        }
    }
    else
        {
        var data = {
            page: page,
        }
    }

    $.ajax({
        method: 'post',
        url: url,
        data: data,
        success:function(result)
        {
            $(".js-table-container").html(result);
            window.pagination_type = 'withoutFilter';
        }
    });
});

// نمایش گارانتی: ویژه و همه
$(".search_type").on('change', function (){

    var searchType = $("input:checked[name='search_type']").val();

    $.ajax({
        type: 'post',
        url: '{{route('staff.warranties.filterByType')}}',
        data: {
            search_type: searchType,
        },
        success:function (result) {
            $(".js-table-container").replaceWith(result);
        }
    });
});


//حذف گارانتی
$(document).on('click','.delete-btn' , function (){
    var warranty_id = $(this).val();

    $.ajax({
        method: 'post',
        url: "{{route('staff.warranties.moveToTrash')}}",
        data: {
            'id': warranty_id,
        },
        success: function (result){
            $('.js-table-container').replaceWith(result);
        },
    });
});

//دکمه سرچ
$("#search-btn").on('click', function (){

    var searchValue = $("#searchKeyword").val();
    var searchGroup = $("#searchGroup").val();

    if (searchGroup == 'warranty_name')
    {
        var url = "{{route('staff.warranties.warrantySearch')}}";
    }
    else if(searchGroup == 'warranty_category')
    {
        var url = "{{route('staff.warranties.warrantyCatSearch')}}";
    }

    $.ajax({
        type: 'post',
        url: url,
        data: {
            'search_keyword': searchValue,
            'searchGroup': searchGroup,
        },
        success: function (result) {
            $(".js-table-container").replaceWith(result);
            if ($(".search_type:checked").val())
            {
                $(this).removeAttr('checked');
            }
        }
    });
});

// دکمه حذف سرچ
$("#searchClear").on('click', function () {
    $.ajax({
        method: 'post',
        url: "{{route('staff.warranties.ajaxPagination')}}",
        success:function(result)
        {
            $(".js-table-container").html(result);
        }
    });
});

// ایجکس سرچ
$('#searchKeyword').on('keyup', function () {

    var searchValue = $(this).val();

    if (searchValue.length > 0) {
        $("#search-btn").removeAttr('disabled');
        $("#searchClear").removeAttr('disabled');

        $("#searchClear").on('click', function () {
            $("#searchKeyword").val('');
            $("#search-btn").attr('disabled', true);
            $("#searchClear").attr('disabled', true);
        });

    }

    if (searchValue.length == 0) {
        $("#search-btn").attr('disabled', true);
        $("#searchClear").attr('disabled', true);

        $.ajax({
            type: 'post',
            url: '{{route('staff.warranties.ajaxPagination')}}',
            success: function (result) {
                $(".js-table-container").replaceWith(result);
            }
        });
    }

});

// انتخاب تعداد نمایش: غیرفعال
$("select[name='paginator-select-pages']").on('change', function (){
    //selectbox paginator val
    var selectedPaginator = $(this).val();

    $.ajax({
        type: 'post',
        url: "{{route('staff.warranties.ajaxPagination')}}",
        data: {
            paginatorNum: selectedPaginator,
        },
        success: function (result){
            $("js-table-container").replaceWith(result);
        }
    });
});

</script>
@endsection
