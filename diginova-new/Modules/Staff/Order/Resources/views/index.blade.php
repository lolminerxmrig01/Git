@extends('layouts.staff.master')
@section('title') مدیریت سفارشات | {{ $fa_store_name }}  @endsection
@section('head')
  <script src="{{ asset('mehdi/staff/js/tableView.js') }}"></script>
  <script src="{{ asset('mehdi/staff/js/intro.min.js') }}"></script>
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
      <div class="c-grid c-order">
        <div class="c-grid__row">
          <div class="c-grid__col">
            <form action="/packages/setup-varaints/" method="post" id="create-package-form">
              <input type="hidden" value="" id="variant-ids" name="product_variant_ids">
              <input type="hidden" value="" id="type" name="type">
            </form>
            <input type="hidden" value="" name="has-warehouses">
            <div class="c-card c-card--transparent c-ui--my-5">
              <h1 class="c-card__title c-card__title--dark c-card__title--desc">
                سفارش‌های ثبت شده 
                <span>از این بخش می‌توانید سفارش‌های ثبت شده را مدیریت کنید.</span>
              </h1>
            </div>
          </div>
        </div>

        <div class="c-grid__row">
          <div class="c-grid__col">
            <div class="c-card">
              <div class="c-card__header">
                <h2 class="c-card__title">جستجو و فیلتر</h2>
              </div>
              <div class="c-card__body">
                <form class="c-ui-form" method="POST" id="searchForm">

                  <div class="c-ui-form__row">
                    <div class="c-ui-form__col c-ui-form__col--2 c-ui-form__col--xs-12">
                      <label class="c-ui-form__label">ارسال توسط:</label>
                      <div class="c-ui-form__controls">
                        <label class="c-ui-switch " id="orders-step-1">
                          <input type="radio" class="c-ui-switch__origin" name="search[seller]" value="1" id="sendTodayOnly" checked="">
                          <span class="c-ui-switch__label"><span class="c-ui-switch__desc ">{{ $fa_store_name }}</span>
                        </span>
                          <span class="c-ui-switch__tooltip">
                            <span class="c-ui-switch__tooltip-title">در حال حاضر کالاهای شما فقط از انبار {{ $fa_store_name }} برای مشتری ارسال می‌شود.</span>
                            <span class="c-ui-switch__tooltip-text"></span>
                          </span>
                        </label>

                      </div>
                    </div>

                    <div class="c-ui-form__col c-ui-form__col--3 c-ui-form__col--xs-12 c-ui-form__col--wrap-xs">
                      <label class="c-ui-form__label">تعهد ارسال:</label>
                      <div class="c-ui-form__controls">
                        <label class="c-ui-switch " id="orders-step-3">
                          <input type="checkbox" class="c-ui-switch__origin js-order-switch-off has-warehouse-inventory searchـsend_date  js-search-item" name="searchـsend_today_only" value="1">
                          <span class="c-ui-switch__label">
                          <span class="c-ui-switch__desc ">گذشته و امروز</span>
                          <span class="c-ui-switch__value ">
                            {{ persianNum($send_today_only) }}
                          </span>
                        </span>
                        </label>

                        <label class="c-ui-switch " id="orders-step-4">
                          <input type="checkbox" class="c-ui-switch__origin js-order-switch-off has-warehouse-inventory searchـsend_date js-search-item" name="search_send_tomorrow_only" value="2">
                          <span class="c-ui-switch__label">
                          <span class="c-ui-switch__desc ">فردا به بعد</span>
                          <span class="c-ui-switc h__value ">
                            {{ persianNum($send_tomorrow_only) }}
                          </span>
                        </span>
                        </label>
                      </div>
                    </div>

                    <div class="c-ui-form__col c-ui-form__col--3 c-ui-form__col--xs-12 c-ui-form__col--wrap-xs">
                      <label class="c-ui-form__label">وضعیت سفارش:</label>
                      <div class="c-ui-form__controls">

                        <label class="c-ui-switch " id="orders-step-3">
                          <input type="checkbox" class="c-ui-switch__origin js-order-switch-off has-warehouse-inventory js-search-item" name="search_order_status" value="awaiting_peyment">
                          <span class="c-ui-switch__label">
                          <span class="c-ui-switch__desc ">در انتظار پرداخت</span>
                          <span class="c-ui-switch__value ">{{ persianNum(\Modules\Staff\Order\Models\Order::where('order_status_id', 1)->count()) }}</span>
                        </span>
                        </label>

                        <label class="c-ui-switch " id="orders-step-4">
                          <input type="checkbox" class="c-ui-switch__origin js-order-switch-off has-warehouse-inventory js-search-item" name="search_order_status" value="confirmed">
                          <span class="c-ui-switch__label">
                          <span class="c-ui-switch__desc ">تایید شده</span>
                          <span class="c-ui-switch__value ">{{ persianNum(\Modules\Staff\Order\Models\Order::where('order_status_id', 2)->count()) }}</span>
                        </span>
                        </label>

                        <label class="c-ui-switch " id="orders-step-4">
                          <input type="checkbox" class="c-ui-switch__origin js-order-switch-off has-warehouse-inventory js-search-item"
                                 name="search_order_status" value="processing">
                          <span class="c-ui-switch__label">
                          <span class="c-ui-switch__desc ">در حال پردازش</span>
                          <span class="c-ui-switch__value ">{{ persianNum(\Modules\Staff\Order\Models\Order::where('order_status_id', 3)->count()) }}</span>
                        </span>
                        </label>

                        <label class="c-ui-switch " id="orders-step-4">
                          <input type="checkbox" class="c-ui-switch__origin js-order-switch-off has-warehouse-inventory js-search-item" name="search_order_status" value="delivered">
                          <span class="c-ui-switch__label">
                          <span class="c-ui-switch__desc ">تحویل داده شده</span>
                          <span class="c-ui-switch__value ">{{ persianNum(\Modules\Staff\Order\Models\Order::where('order_status_id', 4)->count()) }}</span>
                        </span>
                        </label>

                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="c-grid__row js-table-container table_section">
          <div class="c-grid__col">
            <div class="c-card">
              <div class="c-card__wrapper">
                <div class="c-card__header c-card__header--table">
                  <div class="c-card__paginator">
                    <div class="c-ui-paginator js-paginator">
                      @if($orders)
                        <div class="c-ui-paginator__total" data-rows="">
                          تعداد نتایج: <span>{{ persianNum($orders->total()) }} مورد</span>
                        </div>
                      @else
                        <div class="c-ui-paginator__total" data-rows="۰">
                          جستجو نتیجه‌ای نداشت
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="c-card__body c-ui-table__wrapper">
                  <table class="c-ui-table   js-search-table js-table-fixed-header" data-sort-column="order_created_at" data-sort-order="desc" data-search-url="{{ route('staff.orders.search') }}" data-auto-reload-seconds="0" data-new-ui="1" data-is-header-floating="1" data-has-checkboxes="1" data-export-url="/order/export/">
                    <thead>
                    <tr class="c-ui-table__row">
                      <th class="c-ui-table__header c-ui-table__header--nowrap ">
                        <span class="js-search-table-column">ردیف</span>
                      </th>
                      <th class="c-ui-table__header c-ui-table__header--nowrap ">
                        <span class="js-search-table-column">کد سفارش</span>
                      </th>
                      <th class="c-ui-table__header c-ui-table__header--nowrap ">
                        <span class="js-search-table-column">مشتری</span>
                      </th>
                      <th class="c-ui-table__header c-ui-table__header--nowrap ">
                        <span class="js-search-table-column">تعداد مرسوله</span>
                      </th>
                      <th class="c-ui-table__header c-ui-table__header--nowrap ">
                        <span class="js-search-table-column">زمان ثبت سفارش</span>
                      </th>
                      <th class="c-ui-table__header c-ui-table__header--nowrap ">
                        <span class="js-search-table-column">مرسوله</span>
                      </th>
                      <th class="c-ui-table__header c-ui-table__header--nowrap ">
                        <span class="js-search-table-column">تعداد کالا</span>
                      </th>
                      <th class="c-ui-table__header c-ui-table__header--nowrap " style="width: 12% !important;" >
                        <span class="js-search-table-column">روش ارسال</span>
                      </th>
                      <th class="c-ui-table__header c-ui-table__header--nowrap ">
                        <span class="js-search-table-column">وضعیت سفارش</span>
                      </th>
                      <th class="c-ui-table__header c-ui-table__header--nowrap " style="text-align: center !important;">
                        <span class="js-search-table-column">عملیات</span>
                      </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($orders))
                      @foreach($orders as $key => $order)
                        <tr class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                          <td class="c-ui-table__cell" style="">
                            <span class="c-wallet__body-card-row-item"> {{ persianNum($orders->firstItem() + $key) }} </span>
                          </td>

                          <td class="c-ui-table__cell c-ui-table__cell--text-blue">
                            <a class="c-join__promotion-link" target="_blank" style="font-weight: bold"> {{ persianNum($order->order_code) }} </a>
                          </td>

                          <td class="c-ui-table__cell">
                            <span class="c-wallet__body-card-row-item"> {{ $order->customer->first_name . ' ' . $order->customer->last_name }} </span>
                          </td>

                          <td class="c-ui-table__cell">
                            <span class="c-wallet__body-card-row-item"> {{ persianNum(count($order->consignments)) }} </span>
                          </td>

                          <td class="c-ui-table__cell">
                            <span class="c-wallet__body-card-row-item span-time" data-value="{{ $order->created_at }}"></span>
                          </td>

                          <td class="c-ui-table__cell" colspan="3" style="padding-top: 10px; min_width: 100px !important; width: 100px !important;">
                            <?php $i = 1; ?>
                            @foreach($order->consignments as $consignment)
                              <div class="uk-flex uk-grid-medium c-commission-table__row c-commission-table__row--dashed-border">
                                <span class="c-wallet__body-card-row-item" style="width: 10% !important;"> {{ persianNum($i) }} از {{ persianNum($order->consignments()->count()) }} </span>
                                <span class="c-wallet__body-card-row-item" style="width: 15% !important;"> {{ persianNum(count($consignment->consignment_variants)) }} </span>
{{--                                <span class="c-commission-table__col c-commission-table__col--60 green span-date" data-value="{{ $consignment->delivery_at }}" style="width: 25% !important;"></span>--}}
                                <span class="c-commission-table__col c-commission-table__col--40" style="padding-left: 0px !important; width: auto !important;">{{ $consignment->delivery_method->name }}</span>
                              </div>
                              <?php $i++; ?>
                            @endforeach
                          </td>

                          <td class="c-ui-table__cell c-ui-table__cell--small-text">
                            <div class="c-wallet__body-card-status-no-circle uk-text-nowrap {{ ($order->status->en_name == 'delivered')? 'c-wallet__body-card-status-no-circle--active' : 'c-wallet__body-card-status-no-circle--alert' }}">
                              {{ $order->status->name }}
                            </div>
                          </td>

                          <td class="c-ui-table__cell">
                            <div class="c-promo__actions">
                              <a class="c-join__btn c-join__btn--icon-left {{ ($order->status->en_name == 'awaiting_peyment' || $order->status->en_name == 'canceled')? 'c-join__btn--deactive' : 'c-join__btn--secondary-greenish' }}" href="{{ route('staff.orders.details', ['id' => $order->id]) }}">مشاهده جزئیات</a>
                              <a href="{{ ($order->status->en_name == 'awaiting_peyment' || $order->status->en_name == 'canceled')? '' : route('staff.orders.invoice', ['id' => $order->id]) }}" target="_blank" class="c-join__btn c-join__btn--icon-left c-join__btn--primary c-wallet__body-card-btn--printer" uk-tooltip="مشاهده و چاپ فاکتور"  title="" aria-expanded="false" style="font-size: 20px !important;"></a>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                    </tbody>
                  </table>
                </div>

                <div class="c-card__footer" style="width: auto;">
                  <a href="#" style="visibility: hidden;">
                    <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                    </div>
                  </a>

                  {{ $orders->links('stafforder::layouts.pagination.custom-pagination') }}
                  <div class="c-ui-paginator js-paginator">
                    <div class="c-ui-paginator js-paginator">
                      @if($orders)
                        <div class="c-ui-paginator__total" data-rows="">
                          تعداد نتایج: <span>{{ persianNum($orders->total()) }} مورد</span>
                        </div>
                      @else
                        <div class="c-ui-paginator__total" data-rows="۰">
                          جستجو نتیجه‌ای نداشت
                        </div>
                      @endif
                    </div>
                  </div>

                </div>

                <div class="c-card__loading"></div>
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

    $(document).on('change', '.searchـsend_date', function (){

      if ($('input[name=searchـsend_today_only]').is(':checked')) {
        var searchـsend_today_only = 1;
      }

      if ($('input[name=search_send_tomorrow_only]').is(':checked')) {
        var search_send_tomorrow_only = 2;
      }

      $.ajax({
        method: 'post',
        url: '{{ route('staff.orders.search') }}',
        data: {
          searchـsend_today_only: searchـsend_today_only,
          search_send_tomorrow_only: search_send_tomorrow_only,
        },
        success: function (response){
          $('.table_section').replaceWith(response);
        }
      });
    })

    $(document).on('change', 'input[name=search_order_status]', function (){

      if ($(this).is(':checked')) {
        var search_order_status = $(this).val();
      }

      $.ajax({
        method: 'post',
        url: '{{ route('staff.orders.search') }}',
        data: {
          search_order_status: search_order_status,
        },
        success: function (response){
          $('.table_section').replaceWith(response);
        }
      });
    });

    $(document).ready(function (){
      persianNum();
      convertDate();
      convertTime();
    });


    function convertTime() {
      $(".span-time").each(function (){
        var output="";
        var input = $(this).data('value');
        var m = moment(input);
        if(m.isValid()){
          m.locale('fa');
          output = m.format("HH:mm YYYY/M/D");
        }
        $(this).text(output.toPersianDigits());
      });
    }

    function convertDate() {
      $(".span-date").each(function (){
        var output="";
        var input = $(this).data('value');
        var m = moment(input);
        if(m.isValid()){
          m.locale('fa');
          output = m.format("YYYY/M/D");
        }
        $(this).text(output.toPersianDigits());
      });
    }

    function persianNum() {
      String.prototype.toPersianDigits= function(){
        var id= ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        return this.replace(/[0-9]/g, function(w){
          return id[+w]
        });
      }
    }

  </script>
@endsection
