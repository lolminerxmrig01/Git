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
           data-search-url="{{ route('staff.customers.search') }}" 
           data-auto-reload-seconds="0" data-new-ui="1"
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

            <td class="c-ui-table__cell c-ui-table__cell--small-text">
              <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                {{ ($customer->orders()->exists())? persianNum($customer->orders()->count()) : persianNum(0) }}
              </span>
            </td>

            <td class="c-ui-table__cell">
              @if($customer->status == 'active')
                <div class="c-wallet__body-card-status-no-circle c-wallet__body-card-status-no-circle--active uk-text-nowrap">
                  فعال
                </div>
              @else
                <div class="c-wallet__body-card-status-no-circle c-wallet__body-card-status-no-circle--danger uk-text-nowrap">
                  غیرفعال
                </div>
              @endif
            </td>
            
            <td class="c-ui-table__cell c-ui-table__cell--small-text" style="width: 21% !important;">
              <div class="c-promo__actions">
                <a class="c-join__btn c-join__btn--icon-left c-join__btn--icon-edit
                 c-join__btn--secondary-greenish" href="{{ route('staff.customers.profile', ['id' => $customer->id]) }}">ویرایش</a>
                <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete c-join__btn--primary
                 js-remove-plp js-remove-customer" data-url="{{ route('staff.customers.remove', ['id' => $customer->id]) }}">حذف</button>
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
