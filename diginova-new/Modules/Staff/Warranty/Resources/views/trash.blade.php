@extends('layouts.staff.master')
@section('title') مدیریت گارانتی‌های حذف شده | {{ $fa_store_name }}  @endsection
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
                    <div class="c-card c-card--transparent">
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc">
                            مدیریت گارانتی‌های حذف شده
                            <span>
                                از این صفحه می‌توانید گارانتی‌های حذف شده را مدیریت کنید
                            </span>
                        </h1>
                    </div>
                </div>
            </div>
            @if ($warranties->count())
                <div class="js-table-container">
                    <div style="margin-top: 20px; margin-bottom: 20px;"></div>
                    <div class="c-grid__row">
                        <div class="c-grid__col">
                            <div class="c-card">
                                <div class="c-card__wrapper">
                                    <div class="c-card__header c-card__header--table">
                                        <div class="c-grid__col c-grid__col--lg-4">
                                            <a href="{{ route('staff.warranties.index') }}" class="c-ui-btn js-view-all-orders">
                                                بازگشت به صفحه مدیریت گارانتی‌ها
                                            </a>
                                        </div>

                                        <div class="c-ui-paginator js-paginator">
                                            <div class="c-ui-paginator__total">
                                                تعداد نتایج:
                                                <span name="total" data-id="{{ $warranties->total() }}">
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
                                                <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap "> ردیف </span>
                                                </th>
                                                <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap table-header-searchable--desc">نام گارانتی</span>
                                                </th>
                                                <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap "> گروه کالایی </span>
                                                </th>
                                                <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap ">تعداد تنوع</span>
                                                </th>
                                                <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap ">عملیات</span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                @foreach($warranties as $key => $warranty)
                                                    <tr name="row" id="{{$warranty->id}}"
                                                        class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                                                        <td class="c-ui-table__cell">
                                                            <span class="c-wallet__body-card-row-item"> 
                                                                {{ persianNum($warranties->firstItem() + $key) }}
                                                            </span>
                                                        </td>
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
                                                                        @if($warranty->type == 1)
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
                                                                        @foreach($warranty->categories as $category)
                                                                            {{ $category->name }}&nbsp;<br>
                                                                        @endforeach
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </td>

                                                        <td class="c-ui-table__cell">
                                                            <span class="c-wallet__body-card-row-item"> 
                                                                {{ persianNum($warranty->product_variants->count()) }} 
                                                            </span>
                                                        </td>

                                                        <div class="modal-section">
                                                        <td class="c-ui-table__cell">
                                                            <div class="c-promo__actions">
                                                            <button class="c-join__btn c-join__btn--icon-right c-join__btn--secondary-greenish restore-btn"
                                                                    value="{{ $warranty->id }}">بازگردانی</button>

                                                                <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete
                                                                    c-join__btn--primary js-remove-plp js-remove-product-list delete-btn"
                                                                    value="{{ $warranty->id }}">حذف کامل</button>
                                                            </div>
                                                        </td>
                                                        </div>
                                                    </tr>
                                                @endforeach
                                                @include('staffwarranty::layouts.modal')
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="c-card__footer" style="width: auto;">
                                        <a href="{{ route('staff.warranties.index') }}" class="c-ui-btn js-view-all-orders">
                                            بازگشت به صفحه مدیریت گارانتی‌ها
                                        </a>

                                        {{ $warranties->links('staffwarranty::layouts.pagination.pagination') }}

                                        <div class="c-ui-paginator js-paginator">
                                            <div class="c-ui-paginator__total" data-rows="۶">
                                                تعداد نتایج: 
                                                <span name="total" data-id="{{ $warranties->total() }}">
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
                                                    <p class="c-join__promotion-info-statement c-join__promotion-info-statement--bg">
                                                        نتیجه‌ای برای نمایش وجود ندارد!
                                                    </p>
                                                    <p class="c-join__promotion-info-statement">
                                                        برای مدیریت گارانتی‌ها روی دکمه زیر کلیک کنید.
                                                    </p>
                                                    <a class="c-join__btn c-join__btn--info-box c-join__btn--secondary-greenish"
                                                       href="{{ route('staff.warranties.index') }}">
                                                       مدیریت گارانتیها
                                                    </a>
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

    var url = "{{route('staff.warranties.trashPagination')}}?page="+page;

        var data = {
            page: page,
        }

    $.ajax({
        method: 'post',
        url: url,
        data: data,
        success:function(result)
        {
            $(".js-table-container").html(result);
        }
    });
});

$(document).on('click', '.delete-btn', function () {

    $('.c-header__nav').hide();
    $(".uk-modal-container").addClass('uk-open');
    $(".uk-modal-container").css('display', 'block');


    $(document).on('click', '.uk-close', function () {
        $('.c-header__nav').show();
        warranty_id = null;
    });

    $(document).on('click', '.no', function () {
        $('.c-header__nav').show();
        warranty_id = null;
    });

    var warranty_id = $(this).val();

    $(document).on('click', '.yes', function () {

        $('.c-header__nav').show();

        if (warranty_id !== null)
        {
            $.ajax({
                method: 'post',
                url: "{{route('staff.warranties.removeFromTrash')}}",
                data: {
                    'id': warranty_id,
                },
                success: function (response){
                    $('.js-table-container').replaceWith(response);

                    $.toast({
                        heading: 'موفق!',
                        text: "گارانتی با موفقیت حذف شد",
                        bgColor: '#3DC3A1',
                        textColor: '#fff',
                    });
                },
            });
        }
    });
});

// بازگردانی
$(document).on('click','.restore-btn' , function (){
    var warranty_id = $(this).val();

    $.ajax({
        method: 'post',
        url: "{{route('staff.warranties.restoreFromTrash')}}",
        data: {
            'id': warranty_id,
        },
        success: function (response){
            $('.js-table-container').replaceWith(response);
        },
    });
});

</script>
@endsection
