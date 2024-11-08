@extends('layouts.staff.master')
@section('title') مدیریت سفارشات | {{ $fa_store_name }}  @endsection
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
  <script src="{{ asset('mehdi/staff/js/orderDetailAction.js') }}"></script>
  <script src="{{ asset('mehdi/staff/js/jalali-moment.browser.js') }}"></script>

  <style>
    .c-ui-table__cell {
      text-align: right !important;
    }

    .c-ui-table__header {
      text-align: right !important;
    }

    .c-profile-order__payment-records {
      padding: 12px 16px;
      background-color: #ffffff;
      width: 100%;
      border: 1px solid #e6e9ed!important;
      margin: 8px 0;
      display: none;
    }

    .c-profile-order__payment-records-row:first-child, .c-profile-order__payment-records-row:last-child {
      border: none;
    }

    .c-profile-order__payment-records-row {
      padding: 8px;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      border-bottom: 1px solid #e6e9ed!important;
    }

    .c-profile-order__payment-record--title {
      font-weight: 700;
    }

    .c-profile-order__payment-record {
      font-size: 12px;
      font-size: .857rem;
      line-height: 1.833;
      color: #232933;
      -webkit-box-flex: 0;
      -ms-flex: 0 0 25%;
      flex: 0 0 15%;
    }

    .c-profile-order__payment-record-status--positive:before {
      content: "\E062\00FE0E";
      color: #4caf50;
    }

    .c-profile-order__payment-record-status:before {
      font-size: 24px;
      font-size: 1.714rem;
      line-height: 24px;
    }

  </style>
@endsection
@section('content')
  <main class="c-main">
    <div class="uk-container uk-container-large">
      <div class="c-order-history__page-container" id="orderRoot" style="position: relative">

        <div class="c-ui-main-header">
          <div class="c-ui-main-header__title">
            تاریخچه سفارشات
          </div>
          <div class="c-ui-main-header__splitter">
            <div></div>
          </div>
          <div class="c-ui-main-header__description">
            اطلاعات و جزییات مربوط به کلیه سفارش‌های خود را در این قسمت پیگیری کنید.
          </div>
        </div>


        <div class="c-order-history__body c-order-history__body--select-arrow-fixed">

          <div class="c-grid__row">
            <div class="c-grid__col">
              <div class="c-card">
                <div class="c-card__header">
                  <h2 class="c-card__title">اطلاعات سفارش</h2>
                </div>
                <div class="c-card__body" style="padding-bottom: 30px !important;">
                  <ul class="c-commission-accordion uk-accordion" uk-accordion="">

                    <li class="c-commission-accordion__row uk-open">
                      <a class="c-commission-accordion__title uk-accordion-title" href="#">
                        <h4>جزئیات سفارش</h4>
                      </a>
                      <div class="c-commission-accordion__content uk-accordion-content" aria-hidden="false">
                        <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr">
                          <div
                            class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                            <label class="c-ui-form__label" for="product_page_title">کد سفارش:</label>
                            <div class="field-wrapper">
                              <input type="text" name="order_code" value="{{ persianNum($order->order_code) }}"
                                     class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable"
                                     disabled>
                            </div>
                          </div>

                          <div
                            class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                            <label class="c-ui-form__label" for="product_page_title">مشتری:</label>
                            <div class="field-wrapper">
                              <input type="text" name="order_code"
                                     value="{{ $order->customer->first_name . ' ' . $order->customer->last_name }}"
                                     class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable"
                                     disabled>
                            </div>
                          </div>

                          <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                            <label class="c-ui-form__label" for="product_page_title">زمان ثبت سفارش:</label>
                            <div class="field-wrapper">
                              <input type="text" name="order_code" data-value="{{ $order->created_at }}"
                              class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable span-time" disabled>
                            </div>
                          </div>

                          <div
                            class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                            <label class="c-ui-form__label" for="product_page_title">وضعیت سفارش:</label>
                            <div class="field-wrapper">
                              <input type="text" name="order_code" value="{{ $order->status->name }}"
                              class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable" disabled>
                            </div>
                          </div>

                          <div
                            class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                            <label class="c-ui-form__label" for="product_page_title">مبلغ کل (ریال):</label>
                            <div class="field-wrapper">
                              <input type="text" name="order_code" value="{{ persianNum(number_format($order->consignment_variants->sum('variant_price'))) }}"
                                     class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable"
                                     disabled>
                            </div>
                          </div>

                          <div
                            class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                            <label class="c-ui-form__label" for="product_page_title">تخفیف (ریال):</label>
                            <div class="field-wrapper">
                              <input type="text" name="order_code" value="{{ persianNum(number_format($order->consignment_variants->sum('promotion_price'))) }}"
                                     class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable"
                                     disabled>
                            </div>
                          </div>

                          <div
                            class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                            <label class="c-ui-form__label" for="product_page_title">تعداد مرسوله:</label>
                            <div class="field-wrapper">
                              <input type="text" name="order_code" value="{{ persianNum(count($order->consignments)) }}"
                                     class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable"
                                     disabled>
                            </div>
                          </div>

                          <div
                            class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                            <label class="c-ui-form__label" for="product_page_title">تعداد کالا:</label>
                            <div class="field-wrapper">
                              <input type="text" name="variant_count" value="{{ persianNum(count($order->consignment_variants)) }}"
                                     class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable"
                                     disabled>
                            </div>
                          </div>

                          <div
                            class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-12">
                            <label class="c-ui-form__label" for="product_page_title">آدرس تحویل گیرنده:</label>
                            <div class="field-wrapper">
                              <input type="text" name="order_code"
                                     value="{{ fullZone($order->address->zone->first()->id) . ' - ' . persianNum($order->address->address)  . ' پلاک ' . persianNum($order->address->plaque) }} {{ !is_null($order->address->unit)? ' واحد ' . persianNum($order->address->unit) : '' }}"
                                     class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable"
                                     disabled>
                            </div>
                          </div>

                          <div
                            class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                            <label class="c-ui-form__label" for="product_page_title">نام و نام خانوادگی گیرنده:</label>
                            <div class="field-wrapper">
                              <input type="text" name="recipient_firstname"
                                     value="{{ $order->address->firstname . ' ' . $order->address->lastname }}"
                                     class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable"
                                     disabled>
                            </div>
                          </div>

                          <div
                            class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                            <label class="c-ui-form__label" for="product_page_title">تلفن همراه گیرنده:</label>
                            <div class="field-wrapper">
                              <input type="text" name="recipient_mobile" value="{{ persianNum(0 . $order->address->mobile) }}"
                                     class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable"
                                     disabled>
                            </div>
                          </div>

                          <div
                            class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                            <label class="c-ui-form__label" for="product_page_title">کد ملی گیرنده:</label>
                            <div class="field-wrapper">
                              <input type="text" name="recipient_national_code"
                                     value="{{ persianNum(0 . $order->address->national_code) }}"
                                     class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable"
                                     disabled>
                            </div>
                          </div>

                          <div
                            class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                            <label class="c-ui-form__label" for="product_page_title">کد پستی گیرنده:</label>
                            <div class="field-wrapper">
                              <input type="text" name="postal_code" value="{{ persianNum($order->address->postal_code) }}"
                                     class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable"
                                     disabled>
                            </div>
                          </div>

                          <div
                            class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-12">
                            <label class="c-ui-form__label" for="product_page_title">توضیحات:</label>
                            <div class="field-wrapper field-wrapper--textarea enabled">
                              <textarea name="description" id="text"
                                        class="c-content-input__origin c-content-input__origin--textarea js-textarea-words"
                                        rows="5" maxlength="2000"
                                        style="background: white;border-color: #e6e9ed!important;">{{ $order->description }}</textarea>
                            </div>
                          </div>

                          <label class="c-ui-form__label" for="product_page_title" style="margin-right: 18px;margin-top: 5px;">تاریخچه تراکنش ها:</label>

                          <div class="c-profile-order__payment-records js-payment-records" style="display: block;width: 95%;
                            margin: auto;border-radius: 5px;margin-bottom: 15px;">
                            <div class="c-profile-order__payment-records-row" style="margin-bottom: 20px !important;">
                              <div class="c-profile-order__payment-record c-profile-order__payment-record--title">ردیف</div>
                              <div class="c-profile-order__payment-record c-profile-order__payment-record--title">روش پرداخت</div>
                              <div class="c-profile-order__payment-record c-profile-order__payment-record--title">تاریخ</div>
                              <div class="c-profile-order__payment-record c-profile-order__payment-record--title">زمان</div>
                              <div class="c-profile-order__payment-record c-profile-order__payment-record--title">کد پیگیری</div>
                              <div class="c-profile-order__payment-record c-profile-order__payment-record--title">وضعیت</div>
                              <div class="c-profile-order__payment-record c-profile-order__payment-record--title">مبلغ (ریال)</div>
                            </div>
                            <?php $i = 1; ?>
                            @foreach($order->peyment_records as $peyment_record)
                              <div class="c-profile-order__payment-records-row">
                                <div class="c-profile-order__payment-record">{{ persianNum($i) }}</div>
                                <div class="c-profile-order__payment-record">
                                  {{--                                  <div>پرداخت مبلغ سفارش</div>--}}
                                  <div>{{ $peyment_record->peymentMethod->name }}</div>
                                </div>
                                <div class="c-profile-order__payment-record span-date" data-value="{{ $peyment_record->created_at }}"></div>
                                <div class="c-profile-order__payment-record span-only-time" data-value="{{ $peyment_record->created_at }}"></div>
                                <div class="c-profile-order__payment-record">
                                  {{ !is_null($peyment_record->tracking_code)? persianNum($peyment_record->tracking_code) : '-' }}
                                </div>
                                <div class="c-profile-order__payment-record">
                                  @if($peyment_record->status == 'success')
                                    <img src="{{ asset('mehdi/staff/images/bank/successful.svg') }}">
                                  @else
                                    <img src="{{ asset('mehdi/staff/images/bank/failed.svg') }}">
                                  @endif
                                </div>
                                <div class="c-profile-order__payment-record">
                                  {{ persianNum(number_format($peyment_record->price)) }}
                                </div>
                              </div>
                              <?php $i++; ?>
                            @endforeach
                          </div>


                          <div class="c-grid__row" style="margin-top: 10px !important;">
                            <div class="c-grid__col c-grid__col--flex-initial">
                              <div class="c-content-error c-content-error--list hidden" id="saveAjaxErrors">
                              </div>
                              <div class="uk-flex uk-flex-left">
                                <button class="c-ui-btn c-ui-btn--next mr-a submit-form-cu save-form" data-value="order_detail">ذخیره</button>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </li>

                    <?php $i = 1; ?>
                    @foreach($order->consignments as $consignment)
                      <li class="c-commission-accordion__row">
                        <a class="c-commission-accordion__title uk-accordion-title" href="#">
                          <h4>مرسوله {{ persianNum($i) }} از {{ persianNum(count($order->consignments)) }}</h4>
                        </a>
                        <div class="c-commission-accordion__content uk-accordion-content" aria-hidden="false">

                          <div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr">

                            <div
                              class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                              <label class="c-ui-form__label" for="product_page_title">کد مرسوله:</label>
                              <div class="field-wrapper">
                                <input type="text" name="consignment_code" value="{{ $consignment->consignment_code }}"
                                       class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable"
                                       disabled>
                              </div>
                            </div>

                            <div
                              class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                              <label class="c-ui-form__label" for="product_page_title">روش ارسال:</label>
                              <div class="field-wrapper">
                                <input type="text" name="delivery_method_name"
                                       value="{{ $consignment->delivery_method->name }}"
                                       class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable"
                                       disabled>
                              </div>
                            </div>

                            <div
                              class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                              <label class="c-ui-form__label" for="product_page_title">تعهد زمان ارسال:</label>
                              <div class="field-wrapper">
                                <input type="text" name="delivery_at" data-value="{{ $consignment->delivery_at }}"
                                       class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable span-date"
                                       disabled>
                              </div>
                            </div>

                            <div
                              class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                              <label class="c-ui-form__label" for="product_page_title">هزینه ارسال:</label>
                              <div class="field-wrapper">
                                <input type="text" name="shiping_cost" value="{{ $consignment->shiping_cost }}"
                                       class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable" disabled>
                              </div>
                            </div>

                            <div
                              class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                              <label class="c-ui-form__label" for="product_page_title">کد پیگیری پستی:</label>
                              <div class="field-wrapper">
                                <input type="text" name="tracking_code" value="{{ $consignment->tracking_code }}"
                                       class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable">
                              </div>
                            </div>

                            <div
                              class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-3">
                              <label class="c-ui-form__label" for="product_page_title">وضعیت سفارش:</label>
                              <select
                                class="dropdown-control c-ui-select c-ui-select--common c-ui-select--small select2-hidden-accessible"
                                name="order_status" tabindex="-1" aria-hidden="true">
                                <option class="option-control" value="awaiting_review" {{ ($consignment->order_status->en_name == 'awaiting_review')? 'checked' : '' }}>در انتظار بررسی</option>
                                <option class="option-control" value="preparation" {{ ($consignment->order_status->en_name == 'preparation')? 'selected' : '' }}>آماده سازی مرسوله</option>
                                <option class="option-control" value="sending" {{ ($consignment->order_status->en_name == 'sending')? 'selected' : '' }}>در حال ارسال</option>
                                <option class="option-control" value="bounced" {{ ($consignment->order_status->en_name == 'bounced')? 'selected' : '' }}>برگشت خورده</option>
                                <option class="option-control" value="delivered" {{ ($consignment->order_status->en_name == 'delivered')? 'selected' : '' }}>تحویل داده شده</option>
                              </select>
                            </div>

                            <div class="c-grid__row" style="margin-top: 10px !important;">
                              <div class="c-grid__col c-grid__col--flex-initial">
                                <div class="c-content-error c-content-error--list hidden" id="saveAjaxErrors">
                                </div>
                                <div class="uk-flex uk-flex-left">
                                  <button class="c-ui-btn c-ui-btn--next mr-a submit-form-cu save-form" data-value="{{ $consignment->id }}">ذخیره</button>
                                </div>
                              </div>
                            </div>

                          </div>

                        </div>
                      </li>
                      <?php $i++; ?>
                    @endforeach

                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="c-grid__row js-table-container">
            <div class="c-grid__col">
              <div class="c-card">
                <div class="c-card__wrapper">
                  <div class="c-card__header c-card__header--table">
                    <div class="c-card__paginator">
                      <div class="c-ui-paginator js-paginator">
                        <div class="c-ui-paginator__total" data-rows="۸">
                          تعداد نتایج: <span>۸ مورد</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="c-card__body c-ui-table__wrapper">
                    <table class="c-ui-table js-search-table js-table-fixed-header" data-sort-column="order_id"
                           data-sort-order="desc" data-search-url="/passiveorders/search/" data-auto-reload-seconds="0"
                           data-new-ui="1" data-is-header-floating="1" data-has-checkboxes=""
                           data-export-url="/passiveorders/export/">
                      <thead>

                      <tr class="c-ui-table__row">
                        <th class="c-ui-table__header c-ui-table__header--nowrap " style="transform: none;width: 6% !important;">
                          <span class="js-search-table-column">ردیف</span>
                        </th>
                        <th class="c-ui-table__header c-ui-table__header--nowrap " style="transform: none;">
                          <span class="js-search-table-column">کد سفارش/<br>کد مرسوله</span>
                        </th>
                        <th class="c-ui-table__header c-ui-table__header--nowrap " style="transform: none;width: 9% !important;">
                          <span class="js-search-table-column">تاریخ ثبت سفارش</span>
                        </th>
                        <th class="c-ui-table__header c-ui-table__header--nowrap " style="transform: none;width: 6% !important;">
                          <span class="js-search-table-column">مرسوله</span>
                        </th>
                        <th class="c-ui-table__header c-ui-table__header--nowrap " style="transform: none;">
                          <span class="js-search-table-column">تصویر کالا</span>
                        </th>
                        <th class="c-ui-table__header c-ui-table__header--nowrap " style="transform: none;">
                          <span class="js-search-table-column">عنوان و کد تنوع (DNPC)</span>
                        </th>
                        <th class="c-ui-table__header c-ui-table__header--nowrap " style="transform: none;">
                          <span class="js-search-table-column-sortable table-header-searchable"
                          data-sort-column="product_id" data-sort-order="desc">کد محصول</span>
                        </th>
                        <th class="c-ui-table__header c-ui-table__header--nowrap " style="transform: none;">
                          <span class="js-search-table-column">وضعیت</span>
                        </th>
                      </tr>

                      </thead>
                      <tbody>
                      <?php $i = 1; ?>
                      <?php $j = 1; ?>
                      @foreach($order->consignments as $consignment)
                        @foreach($consignment->consignment_variants as $consignment_variant)
                          <tr class="c-order-history__item-header">
                            <td class="c-order-history__item-index" style="width: 6%;">
                              {{ persianNum($i) }}
                            </td>
                            <td class="c-order-history__package-codes c-order-history__inner-column"
                                style="width: 7% !important;">
                                <span>
                                    {{ $order->order_code }}
                                </span>
                              <span>
                                   {{ $consignment->consignment_code }}
                                </span>
                            </td>
                            <td class="c-order-history__create-date span-time"
                                style="width: 10% !important;padding-left: 0px !important;margin-left: 0px;"
                                data-value="{{ $order->created_at }}"></td>
                            <td class="c-order-history__status uk-flex" style="width: 6% !important;">
                              <span class="c-commission-table__tag" style="width: auto; margin:auto; text-align: center;">
                              {{ persianNum($j) }} از {{ persianNum(count($consignment->consignment_variants)) }}
                            </span>
                            </td>
                            <td class="c-order-history__splitter"></td>
                            @php
                              $image = $consignment_variant->product_variant->first()->product->media()->where('is_main', 1)->first();
                            @endphp
                            <td class="c-order-history__item-image">
                              <img src="{{ full_media_path($image) }}" alt=""
                                   class="c-content-upload__img">
                            </td>
                            <td class="c-order-history__item-title" style="margin-left: 30px !important;">
                              {{ $consignment_variant->product_variant->first()->product->title_fa }}
                              | {{ $consignment_variant->product_variant->first()->variant->name }} |
                              @if(!is_null($consignment_variant->product_variant->first->warranty->warranty->month))
                                گارانتی {{ persianNum($consignment_variant->product_variant->first->warranty->warranty->month) }}
                                ماهه {{ $consignment_variant->product_variant->first->warranty->warranty->name }}
                              @else
                                گارانتی {{ $consignment_variant->product_variant->first()->warranty->name }}
                              @endif
                              <div class="c-order-history__variant-tag">
                                {{ $product_code_prefix }}C-{{ $consignment_variant->product_variant->first()->variant_code }}
                              </div>
                            </td>
                            <td class="c-order-history__product-id">
                              <a>
                                {{ $consignment_variant->product_variant->first->product->product->product_code }}
                              </a>
                            </td>
                            <td class="c-order-history__category" style="width: auto !important;">
                                <span class="c-ui-order-status c-ui-order-status--purchased"
                                      style="width: auto !important;">
                                  {{ $consignment_variant->status->name }}
                                </span>
                            </td>
                            <td class="c-order-history__last-column">
                              <button class="c-order-history__minimize-button js-order-history-minimize-item"></button>
                            </td>
                          </tr>
                          <tr class="c-order-history__item-body">
                            <td>
                              <table class="c-order-history__item-inner-table">
                                <thead class="c-order-history__inner-table-header" style="width: 100% !important;">
                                <tr style="width: 100% !important;">
                                  <th style="width: 20% !important;">
                                    ارسال توسط
                                  </th>
                                  <th style="width: 20% !important;">
                                    قیمت واحد (ریال)
                                  </th>
                                  <th style="width: 20% !important;">
                                    تخفیف واحد (ریال)
                                  </th>
                                  <th style="width: 20% !important;">
                                    نوع تخفیف
                                  </th>
                                  <th style="width: 20% !important;">
                                    روش پرداخت
                                  </th>
                                  <th style="width: 20% !important;">
                                    تعهد ارسال به مشتری
                                  </th>
                                  <th style="width: 20% !important;">
                                    بازه ارسال (روز)
                                  </th>
                                  <th style="width: 20% !important;">
                                    روش ارسال
                                  </th>
                                </tr>
                                </thead>
                                <tbody class="uk-flex uk-flex-column">
                                <tr class="c-order-history__inner-row" style="z-index: 2">
                                  <td style="width: 20% !important;">
                                    دیجی نوا
                                  </td>
                                  <td style="width: 20% !important;">
                                    {{ persianNum(number_format($consignment_variant->variant_price)) }}
                                  </td>
                                  <td style="width: 20% !important;">
                                    {{ !is_null($consignment_variant->promotion_price)
                                      ? persianNum(number_format($consignment_variant->promotion_price))
                                      : persianNum(0)
                                    }}
                                  </td>
                                  <td style="width: 20% !important;">
                                    @if(!is_null($consignment_variant->promotion_type) && ($consignment_variant->promotion_type == 'voucher'))
                                      کد تخفیف
                                    @elseif(!is_null($consignment_variant->promotion_type) && ($consignment_variant->promotion_type == 'campain'))
                                      کمپین
                                    @elseif(!is_null($consignment_variant->promotion_type) && ($consignment_variant->promotion_type == 'campain'))
                                      تخفیف شگفت‌انگیز
                                    @else
                                      بدون تخفیف
                                    @endif
                                  </td>
                                  <td style="width: 20% !important;">
                                    {{ $order->peyment_records()->whereNotNull('tracking_code')->first()->peymentMethod()->first()->name }}
                                  </td>
                                  <td class="span-date" data-value="{{ $consignment->delivery_at }}"
                                      style="width: 20% !important;"></td>
                                  <td style="width: 20% !important;">
                                    {{ persianNum($consignment_variant->product_variant->first()->post_time) }}
                                  </td>
                                  <td style="width: 20% !important;">
                                    {{ $consignment->delivery_method->name }}
                                  </td>
                                </tr>

                                </tbody>
                              </table>
                            </td>
                          </tr>
                          <?php $j++; ?>
                        @endforeach
                        <?php $i++; ?>
                      @endforeach
                      </tbody>
                    </table>
                  </div>

                  <div class="c-card__footer" style="width:auto !important; margin-top: 10px !important;">

                    <div class="c-card__paginator">
                      <div class="c-ui-paginator js-paginator">
                        <div class="c-ui-paginator__total" data-rows="۸">
                          تعداد نتایج: <span>۸ مورد</span>
                        </div>
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

    $(document).on('click', '.save-form', function (){
      $.ajax({
        method: 'post',
        url: '{{ route('staff.orders.updateDetail') }}',
        data: {
          order_id: {{ $order->id }},
          consignment_id: $(this).data('value'),
          description: $("textarea[name=description]").val(),
          tracking_code: $(this).closest('.c-commission-accordion__row').find('input[name=tracking_code]').val(),
          consignment_status_id: $(this).closest('.c-commission-accordion__row').find('select[name=order_status]').val(),
        },
        success: function () {
          $(window).scrollTop(0);

          UIkit.notification({
            message: 'تغییرات شما ثبت گردید',
            status: 'success',
            pos: 'top-left',
            timeout: 3000
          }).delay(5);
        },
        error: function (errors) {
          contactDetailsAction.displayError(errors.responseJSON.data.errors);
        },
      });
    });

    $(document).ready(function () {
      convertTime();
      convertDate();
      convertOnlyTime();
      persianNum();
    });

    function convertTime() {
      $(".span-time").each(function () {
        var output = "";
        var input = $(this).attr('data-value');
        var m = moment(input);
        if (m.isValid()) {
          m.locale('fa');
          output = m.format("HH:mm YYYY/M/D");
        }
        $(this).val(output.toPersianDigits());
        $(this).text(output.toPersianDigits());
      });
    }

    function convertOnlyTime() {
      $(".span-only-time").each(function () {
        var output = "";
        var input = $(this).attr('data-value');
        var m = moment(input);
        if (m.isValid()) {
          m.locale('fa');
          output = m.format("HH:mm");
        }
        $(this).val(output.toPersianDigits());
        $(this).text(output.toPersianDigits());
      });
    }

    function convertDate() {
      $(".span-date").each(function () {
        var output = "";
        var input = $(this).attr('data-value');
        var m = moment(input);
        if (m.isValid()) {
          m.locale('fa');
          output = m.format("YYYY/M/D");
        }
        $(this).val(output.toPersianDigits());
        $(this).text(output.toPersianDigits());
      });
    }

    function persianNum() {
      String.prototype.toPersianDigits = function () {
        var id = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        return this.replace(/[0-9]/g, function (w) {
          return id[+w]
        });
      }
    }

  </script>
@endsection
