@extends('layouts.staff.master')
@section('title') محصولات حذف شده | {{ $fa_store_name }}  @endsection
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
                    <div class="c-card c-card--transparent">
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc">مدیریت محصولاتی حذف شده<span>
                                از این صفحه می‌توانید محصولاتی حذف شده را مدیریت کنید</span>
                        </h1>
                    </div>
                </div>
            </div>
            @if ($products->count())

                <div class="js-table-container" data-select2-id="17">
                    <div style="margin-top: 20px; margin-bottom: 20px;"></div>
                    <div class="c-grid__row">
                        <div class="c-grid__col">
                            <div class="c-card">
                                <div class="c-card__wrapper">
                                    <div class="c-card__header c-card__header--table">
                                        <div class="c-grid__col c-grid__col--lg-4">
                                            <a href="{{ route('staff.products.index') }}" class="c-ui-btn js-view-all-orders">بازگشت به صفحه مدیریت محصولات</a>
                                        </div>
                                        <div class="c-ui-paginator js-paginator" data-select2-id="16">
                                            <div class="c-ui-paginator__total" data-rows="۶">
                                                تعداد نتایج: <span name="total" data-id="{{ $products->total() }}">{{ persianNum($products->total()) }} مورد</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-card__body c-ui-table__wrapper">
                                        <table class="c-ui-table js-search-table js-table-fixed-header c-join__table"
                                               data-search-url="/ajax/product/search/">
                                            <thead>
                                            <tr class="c-ui-table__row" style="text-align: center;">
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap "> ردیف </span>
                                                </th>
                                                <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap "></span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap"> عنوان و کد کالا ({{ $product_code_prefix }}) </span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap"> گروه کالایی </span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap ">برند کالا</span>
                                                </th>

                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap "> تعداد تنوع </span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap ">عملیات</span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody">
                                            @foreach($products as $key => $product)
                                                <tr name="row" id="{{$product->id}}" class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                                                    <td class="c-ui-table__cell">
                                                        <span class="c-wallet__body-card-row-item"> {{ persianNum($products->firstItem() + $key) }} </span>
                                                    </td>
                                                    <td class="c-ui-table__cell" style="min-width: 90px">
                                                     @if(count($product->media))
                                                        @foreach($product->media as $image)
                                                          @if($product->media && ($image->pivot->is_main == 1))
                                                            <img src="{{ full_media_path($image) }}" width="75" height="75">
                                                          @endif
                                                        @endforeach
                                                      @else
                                                        <img src="{{ asset('mehdi/staff/images/default-picture.png') }}" width="65" height="65">
                                                      @endif                                                    </td>
                                                    <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15">
                                                        <div class="uk-flex uk-flex-column">
                                                            <a href="#" target="_blank">
                                                          <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial" style="margin:auto;">
                                                               {{ $product->title_fa }}
                                                          </span>
                                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial"></span>
                                                            </a>
                                                            <div class="uk-flex">
                                                                <span class="c-mega-campaigns-join-list__container-table-dkpc c-ui--fit c-ui--nowrap" style="margin: auto;">{{ $product_code_prefix }}-{{ $product->product_code }}</span>                                                      </div>
                                                            </div>
                                                    </td>
                                                    <td class="c-ui-table__cell">
                                                        <a href="#">
                                                        <span class="c-wallet__body-card-row-item c-ui--initial">
                                                           {{ ($product->category()->first())? $product->category()->first()->name : '' }}
                                                        </span>
                                                        </a>
                                                    </td>


                                                    <td class="c-ui-table__cell">
                                                        <a href="#">
                                                            <div class="uk-flex uk-flex-column">
                                                          <span class="c- -card-row-item" style="margin: auto;">
                                                              @if(!is_null($product->brand))
                                                                  {{ $product->brand->name }}
                                                              @else
                                                                  {{ 'متفرقه' }}
                                                              @endif
                                                          </span>
                                                                <span class="c-wallet__body-card-row-item" style="margin: auto;">
                                                            @if(!is_null($product->brand))
                                                                        {{ $product->brand->en_name }}
                                                                    @else
                                                                        {{ 'Miscellaneous' }}
                                                                    @endif
                                                          </span>
                                                            </div>
                                                        </a>
                                                    </td>

                                                    <td class="c-ui-table__cell">
                                                        <span class="c-wallet__body-card-row-item"> {{ persianNum(count($product->variants)) }} </span>
                                                    </td>

                                                    <td class="c-ui-table__cell">
                                                        <div class="c-promo__actions">

                                                           <button class="c-join__btn c-join__btn--icon-right c-join__btn--secondary-greenish restore-btn"
                                                                value="{{ $product->id }}">بازگردانی</button>

                                                            <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete
                                                              c-join__btn--primary js-remove-plp js-remove-product-list delete-btn"
                                                               value="{{ $product->id }}">حذف کامل</button>
                                                        </div>

                                                        <div uk-modal="esc-close: true; bg-close: true;" class="uk-modal-container uk-modal-container--message js-common-modal-notification" style="display: none;">
                                                            <div class="uk-modal-dialog uk-modal-dialog--flex">
                                                                <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""></button>

                                                                <div class="uk-modal-body">
                                                                    <div class="c-modal-notification">
                                                                        <div class="c-modal-notification__content c-modal-notification__content--limited">
                                                                            <h2 class="c-modal-notification__header">هشدار</h2>
                                                                            <p class="c-modal-notification__text">با حذف محصول ، تمامی تنوع‌های آن نیز حذف خواهد شد. آیا از حذف آن اطمینان دارید؟</p>
                                                                            <div class="c-modal-notification__actions">
                                                                                <button class="c-modal-notification__btn no uk-modal-close">خیر</button>
                                                                                <button class="c-modal-notification__btn c-modal-notification__btn--secondary yes uk-modal-close">بله</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="c-card__footer" style="width: auto;">
                                        <a href="{{ route('staff.products.index') }}" class="c-ui-btn js-view-all-orders">بازگشت به صفحه مدیریت محصولات</a>

                                        {{ $products->links('staffproduct::layouts.pagination.pagination') }}

                                        <div class="c-ui-paginator js-paginator">
                                            <div class="c-ui-paginator__total" data-rows="۶">
                                                تعداد نتایج: <span name="total" data-id="{{ $products->total() }}">{{ persianNum($products->total()) }} مورد</span>
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
                                                        برای مدیریت محصولات روی دکمه زیر کلیک کنید.
                                                    </p>
                                                    <a class="c-join__btn c-join__btn--info-box c-join__btn--secondary-greenish"
                                                       href="{{ route('staff.products.index') }}">مدیریت محصولها</a>
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
// توکن csrf
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


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

// پجینیشن
$(document).on('click', '.c-ui-paginator__control a', function(e){
    e.preventDefault();

    var page = $(this).attr('href').split('page=')[1];

    var url = "{{route('staff.products.trashPagination')}}?page="+page;

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
    $(this).closest('.c-ui-table__cell').find('.uk-modal-container').addClass('uk-open');
    $(this).closest('.c-ui-table__cell').find('.uk-modal-container').css('display', 'block');
    $('.c-header__nav').hide();

    $(document).on('click', '.yes', function (){

        $('.c-header__nav').show();


        var product_id = $(this).closest('.c-ui-table__cell').find('.delete-btn').val();

        $.ajax({
            method: 'post',
            url: "{{route('staff.products.removeFromTrash')}}",
            data: {
                'id': product_id,
            },
            success: function (result){
                $('.js-table-container').replaceWith(result);
            },
        });

    });

    $(document).on('click', '.uk-modal-close-default', function (){
        $('.c-header__nav').show();
    });

    $(document).on('click', '.no', function (){
        $('.c-header__nav').show();
    });

});






//حذف محصول
{{--$(document).on('click','.delete-btn' , function (){--}}
{{--    var product_id = $(this).val();--}}

{{--    $.ajax({--}}
{{--        method: 'post',--}}
{{--        url: "{{route('staff.products.removeFromTrash')}}",--}}
{{--        data: {--}}
{{--            'id': product_id,--}}
{{--        },--}}
{{--        success: function (response){--}}
{{--            $('.js-table-container').replaceWith(response);--}}
{{--        },--}}
{{--    });--}}
{{--});--}}



// بازگردانی
$(document).on('click','.restore-btn' , function (){
    var product_id = $(this).val();

    $.ajax({
        method: 'post',
        url: "{{route('staff.products.restoreFromTrash')}}",
        data: {
            'id': product_id,
        },
        success: function (response){
            $('.js-table-container').replaceWith(response);
        },
    });
});


    {{--<button class="c-join__btn c-join__btn--icon-right c-join__btn--secondary-greenish restore-btn"--}}
    {{--value="{{ $product->id }}">بازگردانی</button>--}}

    {{--    <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete--}}
    {{--c-join__btn--primary js-remove-plp js-remove-product-list delete-btn"--}}
    {{--value="{{ $product->id }}">حذف کامل</button>--}}
    {{--</script>--}}

</script>
@endsection
