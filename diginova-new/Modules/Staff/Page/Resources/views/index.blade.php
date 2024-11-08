@extends('layouts.staff.master')
@section('head')
<script src="{{ asset('mehdi/staff/js/indexAction.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/tableView.js') }}"></script>
@endsection
@section('content')
<main class="c-main">
    <div class="uk-container uk-container-large">
        <div class="c-grid " data-select2-id="13">
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <input type="hidden" value="" name="has-warehouses">
                    <div class="c-card c-card--transparent">
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc">مدیریت برندها<span>از این صفحه می‌توانید برندها را مدیریت کنید</span>
                        </h1>
                    </div>
                </div>
            </div>
            @if ($brands->count())
                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card" id="consignment-step-1">
                            <div class="c-card__header">
                                <h2 class="c-card__title">جستجو و فیلتر</h2>
                            </div>
                            <div class="c-card__body">
                                <div class="c-ui-form__row" data-select2-id="12">
                                    <div class="c-ui-form__col c-ui-form__col--8 c-ui-form__col--xs-12"
                                         data-select2-id="11">
                                        <label class="c-ui-form__label">جستجو بر اساس:</label>
                                        <div class="c-ui-form__row" data-select2-id="10">
                                            <div
                                                class="c-ui-form__col c-ui-form__col--3 c-ui-form__col--xs-12 c-ui-form__col--small-gap c-ui-form__col--xs c-ui-form__col--wrap-xs"
                                                style="min-width: 175px" >
                                                <select
                                                    class="c-ui-select c-ui-select--common c-ui-select--small js-form-clearable select2-hidden-accessible"
                                                    name="searchGroup" data-select2-id="1" tabindex="-1"
                                                    aria-hidden="true" id="searchGroup">
                                                    <option value="brand_name" selected>نام برند</option>
                                                    <option value="brand_category">گروه کالا</option>
                                                </select>
                                            </div>
                                            <div
                                                class="c-ui-form__col c-ui-form__col--6 c-ui-form__col--xs-12
                  c-ui-form__col--small-gap c-ui-form__col--wrap-xs c-ui-form__col--xs">
                                                <label>
                                                    <div class="c-ui-input">
                                                        <input type="text" name="searchKeyword" class="c-ui-input__field c-ui-input__field--order js-form-clearable"
                                                               id="searchKeyword" value="" placeholder="عنوان را بنویسید ...">
                                                    </div>
                                                </label>
                                            </div>
                                            <div
                                                class="c-ui-form__col c-ui-form__col--xs-12 c-ui-form__col--small-gap c-ui-form__col--wrap-xs c-ui-form__col--xs">
                                                <button class="c-ui-btn c-ui-btn--xs-block c-ui-btn--active c-ui-btn--search-form"
                                                    id="search-btn" disabled>
                                                    <span>جستجو</span>
                                                </button>
                                            </div>
                                            <div
                                                class="c-ui-form__col c-ui-form__col--xs-12 c-ui-form__col--small-gap c-ui-form__col--wrap-xs c-ui-form__col--xs">
                                                <button type="button"
                                                        class="c-ui-btn c-ui-btn--xs-block c-ui-btn--active c-ui-btn--clear-form"
                                                        id="searchClear" disabled=""></button>
                                            </div>
                                        </div>
                                    </div>

{{--                                    <div class="c-ui-form__col c-ui--mr-30 uk-padding-remove c-product-radio-group-container">--}}
{{--                                        <div class="c-join__filter">--}}
{{--                                            <p class="c-ui-form__label">نمایش برند:</p>--}}
{{--                                            <div class="c-join__filter-container">--}}
{{--                                                <label class="c-join__radio-label">--}}
{{--                                                    <input class="c-join__radio search_type" type="radio"--}}
{{--                                                           name="search_type" value="all" checked>--}}
{{--                                                    <span class="c-join__radio-option">همه برندها</span>--}}
{{--                                                </label>--}}
{{--                                                <label class="c-join__radio-label">--}}
{{--                                                    <input class="c-join__radio search_type" type="radio" name="search_type" value="only_special">--}}
{{--                                                    <span class="c-join__radio-option">فقط ویژه ها</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="js-table-container" data-select2-id="17">
                    <input name="page_type" value="index" hidden>
                    <div style="margin-top: 20px; margin-bottom: 20px;"></div>
                    <div class="c-grid__row">
                        <div class="c-grid__col">
                            <div class="c-card">
                                <div class="c-card__wrapper">
                                    <div class="c-card__header c-card__header--table">
                                        <a href="{{ route('staff.brands.create') }}" target="_blank">
                                            <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                ایجاد برند جدید
                                            </div>
                                        </a>
                                        @if($trashed_brands->count())
                                        <div class="c-grid__col c-grid__col--lg-4">
                                            <a href="{{ route('staff.brands.trash') }}" class="c-ui-btn js-view-all-orders">مدیریت برندهای حذف شده</a>
                                        </div>
                                        @endif

{{--                                        {{ $brands->links('staffbrand::layouts.pagination.pagination') }}--}}

                                        <div class="c-ui-paginator js-paginator" data-select2-id="16">
                                            <div class="c-ui-paginator__total" data-rows="۶">
                                                تعداد نتایج: <span name="total" data-id="{{ $brands->total() }}">{{ persianNum($brands->total()) }} مورد</span>
                                            </div>
{{--                                            <div class="c-ui-paginator__select" data-select2-id="15">--}}
{{--                                                <div class="c-ui-paginator__select-label">تعداد نمایش</div>--}}
{{--                                                <div class="c-ui-paginator__select-pages">--}}
{{--                                                    <div class="field-wrapper ui-select ui-select__container">--}}

{{--                                                        <select class="c-ui-select c-ui-select--common c-ui-select--small--}}
{{--                                                        select2-hidden-accessible paginator-selected"--}}
{{--                                                            name="paginator-select-pages" tabindex="-1" id="paginator-top" aria-hidden="true">--}}
{{--                                                            <option value="10">۱۰</option>--}}
{{--                                                            <option value="20">۲۰</option>--}}
{{--                                                            <option value="50">۵۰</option>--}}
{{--                                                            <option value="100">۱۰۰</option>--}}
{{--                                                        </select>--}}

{{--                                                        <div class="js-select-options c-ui-paginator__dropdown-container"></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
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
                                                        class="table-header-searchable uk-text-nowrap ">لوگو برند</span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap table-header-searchable--desc">نام برند</span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap "> گروه کالایی </span>
                                                </th>
{{--                                                <th class="c-ui-table__header"><span--}}
{{--                                                        class="table-header-searchable uk-text-nowrap "> وضعيت </span>--}}
{{--                                                </th>--}}
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap ">تعداد کالا</span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap ">کالاهای فعال</span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap ">عملیات</span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody">
                                            @foreach($brands as $key => $brand)
                                                <tr name="row" id="{{$brand->id}}" class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                                                    <td class="c-ui-table__cell">
                                                        <span class="c-wallet__body-card-row-item"> {{ persianNum($brands->firstItem() + $key) }} </span>
                                                    </td>
                                                    <td class="c-ui-table__cell" style="min-width: 90px">
                                                            @if(count($brand->media))
                                                            <img src="{{ $site_url . '/' . $brand->media()->first()->path . '/'.$brand->media()->first()->name }}" width="65" height="65">
                                                            @endif
                                                    </td>
                                                    <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15">
                                                        <div class="uk-flex uk-flex-column">
                                                            <a href="#" target="_blank">
                                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                                                {{ $brand->name }}
                                                                    @if($brand->type == 1)
                                                                        <span style="color: red; font-size: 11px;"> (ویژه) </span>
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
{{--                                                                      {{ $brand->name }}--}}
{{--                                                                      {{ count($brand->categories) }}--}}
                                                                    @foreach($brand->categories as $category)
                                                                          {{ $category->name }}&nbsp;<br>
                                                                      @endforeach
                                                                  </span>
                                                            </div>
                                                        </a>
                                                    </td>
{{--                                                    <td class="c-ui-table__cell">--}}
{{--                                                        <div class="">--}}
{{--                                                            <div class="c-wallet__body-card-status-no-circle--}}
{{--                          c-wallet__body-card-status-no-circle--active uk-text-nowrap" style="margin: auto">--}}
{{--                                                                فعال--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
                                                    <td class="c-ui-table__cell"><span class="c-wallet__body-card-row-item"> ۱ </span>
                                                    </td>
                                                    <td class="c-ui-table__cell"><span class="c-wallet__body-card-row-item"> ۱ </span>
                                                    </td>
                                                    <td class="c-ui-table__cell">
                                                        <div class="c-promo__actions">
                                                            <a class="c-join__btn c-join__btn--icon-right c-join__btn--icon-edit
                          c-join__btn--secondary-greenish" href="{{ route('staff.brands.edit', $brand->en_name) }}">ویرایش</a>
                                                            <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete
                                                              c-join__btn--primary js-remove-plp js-remove-product-list delete-btn"
                                                               value="{{ $brand->id }}">حذف</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="c-card__footer" style="width: auto;">
                                        <a href="{{ route('staff.brands.create') }}">
                                            <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                ایجاد برند جدید
                                            </div>
                                        </a>

                                        @if($trashed_brands->count())
                                            <div class="c-grid__col c-grid__col--lg-4">
                                                <a href="{{ route('staff.brands.trash') }}" class="c-ui-btn js-view-all-orders">مدیریت برندهای حذف شده</a>
                                            </div>
                                        @endif

                                        {{ $brands->links('staffbrand::layouts.pagination.pagination') }}
                                        <div class="c-ui-paginator js-paginator" data-select2-id="25">
                                            <div class="c-ui-paginator__total" data-rows="۶">
                                                تعداد نتایج: <span name="total" data-id="{{ $brands->total() }}">{{ persianNum($brands->total()) }} مورد</span>
                                            </div>
{{--                                            <div class="c-ui-paginator__select" data-select2-id="24">--}}
{{--                                                <div class="c-ui-paginator__select-label">تعداد نمایش</div>--}}
{{--                                                <div class="c-ui-paginator__select-pages">--}}
{{--                                                    <div class="field-wrapper ui-select ui-select__container">--}}

{{--                                                        <select class="c-ui-select c-ui-select--common c-ui-select--small--}}
{{--                                                         select2-hidden-accessible paginator-selected"--}}
{{--                                                            name="paginator-select-pages" id="paginator-bottom"--}}
{{--                                                            tabindex="-1" aria-hidden="true">--}}
{{--                                                            <option value="10">۱۰</option>--}}
{{--                                                            <option value="20">۲۰</option>--}}
{{--                                                            <option value="50">۵۰</option>--}}
{{--                                                            <option value="100">۱۰۰</option>--}}
{{--                                                        </select>--}}


{{--                                                        <div class="js-select-options c-ui-paginator__dropdown-container"></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
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
                                {{--
                                <div class="c-card__header">
                                  --}}
                                {{--
                                <div class="c-grid__col">
                                  --}}
                                {{--
                                <h2 class="c-card__title c-join__tab-card-title">مدیریت برندها</h2>
                                --}}
                                {{--
                                <ul class="uk-tab c-promo__tabs">
                                  --}}
                                {{--
                                <li class="c-promo__tab-item c-promo__tab-item--promotions uk-active" data-tab="1">--}}
                                {{--                                            <a href="/promotion-management/">همه برندها</a>--}}
                                {{--
                              </li>
                              --}}
                                {{--
                                <li class="c-promo__tab-item c-promo__tab-item--products" data-tab="2">--}}
                                {{--                                            <a href="/promotion-management/products/">برندهای حذف شده</a>--}}
                                {{--
                              </li>
                              --}}
                                {{--
                              </ul>
                              --}}
                                {{--
                              </div>
                              --}}
                                {{--
                              </div>
                              --}}
                                <div class="c-card__body">
                                    <div class="c-grid__col">
                                        <div class="c-grid__col c-promo__tab-container c-promo__tab-container--is-visible" data-tab="1">
                                            <div class="c-join__promotion-info-box c-join__promotion-info-box--empty">
                                                <img class="c-join__promotion-info-img" src="{{ asset('mehdi/staff/images/no-content.svg') }}" alt="Empty">
                                                 @if($trashed_brands->count())
                                                    <p class="c-join__promotion-info-statement c-join__promotion-info-statement--bg">
                                                        نتیجه‌ای برای نمایش وجود ندارد!
                                                    </p>
                                                    <p class="c-join__promotion-info-statement">
                                                        شما تعداد {{ persianNum($trashed_brands->count()) }} برند حذف شده در Trash دارید برای مدیریت و بازگردانی آنها بر روی دکمه زیر کلیک کنید
                                                    </p>
                                                    <a class="c-join__btn c-join__btn--info-box c-join__btn--secondary-greenish"
                                                       href="{{ route('staff.brands.trash') }}">ورود به صفحه Trash</a>
                                                @else
                                                    <p class="c-join__promotion-info-statement c-join__promotion-info-statement--bg">شما تا به حال هیچ برندی ایجاد نکرده‌اید</p>
                                                    <p class="c-join__promotion-info-statement">
                                                        برای ایجاد برند جدید روی دکمه زیر کلیک کنید.
                                                    </p>
                                                    <a class="c-join__btn c-join__btn--info-box c-join__btn--secondary-greenish"
                                                       href="{{ route('staff.brands.create') }}">ایجاد برند جدید</a>
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
        var url = "{{route('staff.brands.ajaxPagination')}}?page="+page;
    }
    else if (pageType == 'only_special') {
        var url = "{{route('staff.brands.filterByType')}}?page="+page;
    }
    else if(pageType == 'brandSearch') {
        var url = "{{route('staff.brands.brandSearch')}}?page="+page;
    }
    else if(pageType == 'brandCatSearch') {
        var url = "{{route('staff.brands.brandCatSearch')}}?page="+page;
    }

    if(pageType == 'brandCatSearch' || pageType == 'brandSearch')
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

// نمایش برند: ویژه و همه
$(".search_type").on('change', function (){

    var searchType = $("input:checked[name='search_type']").val();

    $.ajax({
        type: 'post',
        url: '{{route('staff.brands.filterByType')}}',
        data: {
            search_type: searchType,
        },
        success:function (result) {
            $(".js-table-container").replaceWith(result);
        }
    });
});


//حذف برند
$(document).on('click','.delete-btn' , function (){
    var brand_id = $(this).val();

    $.ajax({
        method: 'post',
        url: "{{route('staff.brands.moveToTrash')}}",
        data: {
            'id': brand_id,
        },
        success: function (result){
            $('.js-table-container').replaceWith(result);
            // $("tr[id="+ id +"]").remove();
            //
            // var total_count = $("span[name='total']").attr('data-id');
            // var new_count = total_count-1;
            //
            // var total = '<span name="total" data-id=" + new_count + ">' + new_count + ' مورد</span>';
            //
            // $("span[name='total']").replaceWith(total);
            //
            // ConvertNumberToPersion();

        },
    });
});

//دکمه سرچ
$("#search-btn").on('click', function (){

    var searchValue = $("#searchKeyword").val();
    var searchGroup = $("#searchGroup").val();

    if (searchGroup == 'brand_name')
    {
        var url = "{{route('staff.brands.brandSearch')}}";
    }
    else if(searchGroup == 'brand_category')
    {
        var url = "{{route('staff.brands.brandCatSearch')}}";
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
        url: "{{route('staff.brands.ajaxPagination')}}",
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
            url: '{{route('staff.brands.ajaxPagination')}}',
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
        url: "{{route('staff.brands.ajaxPagination')}}",
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
