<div class="c-grid__row js-table-container table_section">
  <div class="c-grid__col">
    <div class="c-card">
      <div class="c-card__wrapper">
        <div class="c-card__header c-card__header--table">
          <div class="c-card__paginator">
            <div class="c-ui-paginator js-paginator">
              @if(count($orders))
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
          <table class="c-ui-table   js-search-table js-table-fixed-header" 
          data-sort-column="order_created_at" data-sort-order="desc" 
          data-search-url="{{ route('staff.orders.search') }}" data-auto-reload-seconds="0"
           data-new-ui="1" data-is-header-floating="1" data-has-checkboxes="1"
            data-export-url="/order/export/">
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
              @if(count($orders))
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

<script>
  persianNum();
  convertDate();
  convertTime();
</script>
