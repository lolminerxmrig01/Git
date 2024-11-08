@extends('layouts.staff.master')
@section('title') مدیریت مشتریان | {{ $fa_store_name }}  @endsection
@section('head')
<script>
    var supernova_mode = "production";
    var supernova_tracker_url = "";
    var showRejectedMessage = 0;
    var rejectedMessage = "";
    var isLoggedSeller = 1;
    var walkthroughSteps = [];
    var showPriceModal = 0;
    var newSeller = 1;
    var is_yalda = 0;
</script>
<script src="{{ asset('mehdi/staff/js/tableView.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/jalali-moment.browser.js') }}"></script>
<style>
.c-ui-table__cell {
    text-align: right !important;
}

.c-ui-table__header {
    text-align: right !important;
}
</style>
@endsection
@section('content')
<main class="c-main">
        <div class="uk-container uk-container-large">
            <div class="c-grid c-join__grid">
                <div class="c-grid__row c-join__top-details c-join__top-details--sm">
                    <div class="c-grid__col c-join__flex-space-between">
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc c-add-products__title">
                            مدیریت مشتریان
                            <span class="c-card__title-sub c-card__title-sub--no-spacing">
                                از طریق این صفحه می‌توانید مشتریان را مدیریت کنید.
                            </span>
                        </h1>
                    </div>
                </div>

                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card">
                            <div class="c-card__header">
                                <div class="c-grid__col">
                                    <h2 class="c-card__title">لیست مشتریان</h2>
                                </div>
                            </div>
                            <div class="c-card__body">
                                <div class="c-grid__col">
                                    <div class="c-grid__col c-promo__tab-container c-promo__tab-container--is-visible" data-tab="1">

                                        <div class="c-grid__row c-promo__has-divider">
                                            <form class="c-ui-form c-join__manage-filters" id="searchForm">
                                                <div class="c-ui-form__row">
                                                    <div class="c-ui-form__col c-ui-form__col-4">
                                                        <label class="c-ui-form__label">جستجو:</label>
                                                        <div class="c-ui-input">
                                                            <input type="search" name="title" class="c-ui-input__field c-ui-input__field--order
                                                             js-form-clearable c-join__input" id="search_input" 
                                                             placeholder="جستجوی نام، نام خانوادگی، شماره یا ایمیل" style="width: 400px;">
                                                            <button class="uk-icon-button c-join__search-btn uk-icon" uk-tooltip="title: جستجو;"
                                                             uk-icon="icon: search" id="submitButton" title="" aria-expanded="false">
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="c-ui-form__col c-ui-form__col-2" style="width: 215px">
                                                        <label class="c-ui-form__label">وضعیت
                                                        </label>
                                                        <select name="status" class="dropdown-control c-ui-select c-ui-select--common
                                                            c-ui-select--small select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                            <option class="option-control" value="all">نمایش همه</option>
                                                            <option class="option-control" value="active">فعال</option>
                                                            <option class="option-control" value="inactive">غیرفعال</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="js-table-container" id="product-list-items">
                                            <br>
                                            <div class="c-ui-paginator js-paginator">
                                                @if(count($customers))
                                                    <div class="c-ui-paginator__total" data-rows="">
                                                        تعداد نتایج: <span>{{ persianNum($customers->total()) }} مورد</span>
                                                    </div>
                                                @else
                                                    <div class="c-ui-paginator__total" data-rows="۰">
                                                        جستجو نتیجه‌ای نداشت
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="c-grid__row c-promo__row--m-sm">
                                                <table class="c-ui-table c-join__table  js-search-table js-table-fixed-header"
                                                 data-sort-column="created_at" data-sort-order="desc"
                                                       data-search-url="{{ route('staff.customers.search') }}" data-auto-reload-seconds="0" data-new-ui="1"
                                                       data-is-header-floating="1" data-has-checkboxes="" 
                                                       style="text-align: right !important; display: rtl !important;">
                                                    <thead>
                                                    <tr class="c-ui-table__row">
                                                        <th class="c-ui-table__header ">
                                                            <span class="js-search-table-column">نام</span>
                                                        </th>
                                                        <th class="c-ui-table__header ">
                                                            <span class="js-search-table-column">شماره</span>
                                                        </th>
                                                        <th class="c-ui-table__header c-ui-table__header--nowrap ">
                                                            <span class="js-search-table-column">ایمیل</span>
                                                        </th>
                                                        <th class="c-ui-table__header ">
                                                            <span class="js-search-table-column">تعداد سفارشات</span>
                                                        </th>
                                                        <th class="c-ui-table__header ">
                                                            <span class="js-search-table-column">وضعیت مشتری</span>
                                                        </th>
                                                        <th class="c-ui-table__header c-ui-table__header--nowrap " style="text-align: center !important;">
                                                            <span class="js-search-table-column">عملیات</span>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody style="font-size: 13px !important;">
                                                    @if(count($customers))
                                                      @foreach($customers as $customer)
                                                        <tr class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                                                        <td class="c-ui-table__cell">
                                                          <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                                            {{ $customer->first_name . ' ' . $customer->last_name }}
                                                          </span>
                                                        </td>
                                                        <td class="c-ui-table__cell" style="">
                                                          <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                                            {{ !is_null($customer->mobile)? persianNum(0 . $customer->mobile) : '' }}
                                                          </span>
                                                        </td>
                                                        <td class="c-ui-table__cell c-ui-table__cell--text-blue">
                                                            {{ !is_null($customer->email)? $customer->email : '' }}
                                                        </td>

                                                        <td class="c-ui-table__cell c-ui-tطable__cell--small-text">
                                                          <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                                            {{ ($customer->orders()->exists())? persianNum($customer->orders()->count()) : persianNum(0) }}                    
                                                          </span>
                                                        </td>

                                                        <td class="c-ui-table__cell">
                                                          @if($customer->status == 'active')
                                                            <div class="c-wallet__body-card-status-no-circle c-wallet__body-card-status-no-circle--active
                                                             uk-text-nowrap">
                                                              فعال
                                                            </div>
                                                          @else
                                                            <div class="c-wallet__body-card-status-no-circle c-wallet__body-card-status-no-circle--danger
                                                             uk-text-nowrap">
                                                              غیرفعال
                                                            </div>
                                                          @endif
                                                        </td>

                                                        <td class="c-ui-table__cell c-ui-table__cell--small-text" style="width: 21% !important;">
                                                            <div class="c-promo__actions">
                                                                <a class="c-join__btn c-join__btn--icon-left c-join__btn--icon-edit
                                                                 c-join__btn--secondary-greenish"
                                                                  href="{{ route('staff.customers.profile', ['id' => $customer->id]) }}">ویرایش</a>
                                                                <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete c-join__btn--primary js-remove-plp js-remove-customer" data-url="{{ route('staff.customers.remove', ['id' => $customer->id]) }}">حذف</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                      @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                                <div class="c-card__loading"></div>

                                            </div>
                                            <br>


                                            <div class="c-card__footer" style="width: auto;">
                                                <a href="#" style="visibility: hidden;">
                                                    <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                    </div>
                                                </a>
                                                {{ $customers->links('staffcustomer::layouts.pagination.custom-pagination') }}
                                                <div class="c-ui-paginator js-paginator">
                                                    <div class="c-ui-paginator js-paginator">
                                                      @if(count($customers))
                                                          <div class="c-ui-paginator__total" data-rows="">
                                                              تعداد نتایج: <span>{{ persianNum($customers->total()) }} مورد</span>
                                                          </div>
                                                      @else
                                                          <div class="c-ui-paginator__total" data-rows="۰">
                                                              جستجو نتیجه‌ای نداشت
                                                          </div>
                                                      @endif
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

function persianNum() {
    String.prototype.toPersianDigits= function(){
        var id= ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        return this.replace(/[0-9]/g, function(w){
            return id[+w]
        });
    }
}
function convertDate() {
    $(".span-time").each(function (){
        var output="";
        var input = $(this).attr('data-value');
        var m = moment(input);
        if(m.isValid()){
            m.locale('fa');
            output = $(this).attr('data-type') + ' ' + m.format("YYYY/M/D HH:mm");
        }
        $(this).text(output.toPersianDigits());
    });
}

persianNum();
convertDate();

$(document).on('change', 'input[name="status"]', function () {
    if($(this).is(':checked'))
    {
        var status = 1;
    }
    else{
        var status = 0;
    }
    var data_id = $(this).attr('data-id');

    $.ajax({
        method: 'post',
        {{--url: "{{ route('staff.customers.statuscustomer') }}",--}}
        data: {
            'status': status,
            'id' : data_id,
        }
    });
});

</script>
@endsection
