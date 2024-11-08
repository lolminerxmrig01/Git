<div id="address-section">
  <div class="c-checkout-contact is-completed js-user-address-container"  id="user-default-address-container" data-address='{"id":5,"default":true,"title":"مرکز خرید پلاتین","address":"تهران، تهران، بلوار فرحزادی، نبش سیمای ایران، مرکز خرید پلاتین، طبقه اول، واحد 107","description":"مرکز خرید پلاتین","fmcg_support":false,"sort":0}'>
    <div class="c-checkout-contact__content js-default-recipient-box">
      <div class="c-checkout-contact__title">
        آدرس مرکز دریافت سفارش
      </div>
      <input type="hidden" id="address-id" name="addressId" value="">
      <ul class="c-checkout-contact__items">
        <li class="c-checkout-contact__item c-checkout-contact__item--address js-recipient-address-part">
          {{ persianNum($customer->delivery_address->address) }}
        </li>
        <li class="c-checkout-contact__item c-checkout-contact__item--username">
          {{ $customer->first_name . ' ' . $customer->last_name }}
        </li>
        <li class="c-checkout-contact__item">
          <button type="button" class="o-link o-link--sm o-link--has-arrow" id="change-address-btn">
            تغییر آدرس
          </button>
        </li>
      </ul>
      <div class="c-checkout-contact__dropoff-address-action-container">
        @if ($delivery_type == 'store')
          <p>
            می‌خواهید کالاها به جای دریافت حضوری توسط شما به یکی از آدرس‌هایتان ارسال شوند؟
          </p>
          <button type="button" class="o-link o-link--sm o-link--has-arrow" id="change-address-btn">
            انتخاب از آدرس‌های خودم
          </button>
        @elseif($delivery_type == 'customer')
          <p>
            با انتخاب یکی از آدرس‌های دریافت حضوری می‌توانید کالاهای این سفارش را به صورت حضوری از مراکز دیجی‌کالا دریافت نمایید.
          </p>
          <button type="button" class="o-link o-link--sm o-link--has-arrow" id="change-to-dropoff-address">
            انتخاب آدرس دریافت حضوری
          </button>
        @endif

      </div>
    </div>
  </div>
  <div class="c-checkout-address js-user-address-container" id="user-address-list-container" style="display: none">
    <div class="c-checkout-address__headline">
      <div class="c-checkout-address__title">آدرس تحویل سفارش را انتخاب نمایید:</div>
      <div class="o-btn c-checkout-address__close" id="cancel-change-address-btn"></div>
    </div>
    <div class="o-box__tabs">
      <div class="o-box__tab js-ui-tab-pill is-active" data-tab-pill-id="userAddresses">
        آدرس‌های شما
      </div>
      @if (!is_null($store_addresses) && count($store_addresses))
        <div class="o-box__tab js-ui-tab-pill" data-tab-pill-id="dropOff">
          آدرس‌های مراکز دریافت {{ $fa_store_name }}
        </div>
      @endif
    </div>
    <div class="c-checkout-address__content js-ui-tab-content" data-tab-content-id="userAddresses">
      <div class="c-checkout-address__content">
        @foreach($customer->addresses as $address)
          @if ($customer->where('address_type', 'CustomerAddress')->exists())
            <?php $is_selected_id = $customer->delivery_address->id; ?>
          @else
            <?php $is_selected_id = null; ?>
          @endif
          <div class="c-checkout-address__item {{ ($is_selected_id == $address->id)? 'is-selected' : '' }} js-recipient-box js-user-address-container js-address-box" data-id="{{ $address->id }}" data-event="change_address" data-event-category="funnel" data-event-label="addresses: 2" data-address='{"id":{{ $address->id }},"full_name":"{{ $customer->first_name . ' ' . $customer->last_name }}","mobile_phone":"{{ 0 . $customer->mobile }}","phone_code":null,"post_code":"1212121212","phone":null,"address":"{{ $address->address }}","description":null,"active":true,"default":true,"city_id":0,"city_name":"xxxxxxxxxx","state_id":0,"state_name":"xxxxxxxxxx","district_id":0,"district_name":"xxxxxxxxxx","building_no":"1","unit":null,"full_address":"{{ $address->address }}","map_lon":0.00000,"map_lat":0.00000,"map_lon_mobile":"0.00000","map_lat_mobile":"0.00000","map_lon_web":"0.00000","map_lat_web":"0.00000","fmcg_support":true,"is_shared_address":false,"shared_address_id":null}'>
            <div class="c-checkout-address__item-headline">
              <label class="c-outline-radio">
                <input type="radio" name="address" {{ ($is_selected_id == $address->id)? 'checked' : '' }}>
                <span class="c-outline-radio__check"></span>
              </label>

              {{ ($is_selected_id == $address->id)? 'به این آدرس ارسال می‌شود' : 'ارسال به این آدرس' }}
            </div>
            <ul class="c-checkout-address__item-content">
              <li class="c-checkout-address__item-address">
                {{ $address->address }}
              </li>
              @if(!is_null($address->postal_code))
                <li class="c-checkout-address__item-detail c-checkout-address__item-detail--postal-code">
                  {{ persianNum($address->postal_code) }}
                </li>
              @endif

              @if(!is_null($customer->mobile))
                <li class="c-checkout-address__item-detail c-checkout-address__item-detail--phone">
                  {{ persianNum(0 . $customer->mobile) }}
                </li>
              @endif
              <li class="c-checkout-address__item-detail c-checkout-address__item-detail--username">
                {{ $customer->first_name . ' ' . $customer->last_name }}
              </li>
            </ul>
            <div class="c-checkout-address__actions">
              <button class="o-btn o-btn--link-blue-sm js-remove-address-btn" data-id="{{ $address->id }}"
                      data-token="">حذف
              </button>
{{--              <button class="o-btn o-btn--link-blue-sm js-edit-address-btn" data-event="edit_address"--}}
{{--                      data-event-category="funnel"--}}
{{--                      data-event-label="addresses: 2, position: list of addresses"--}}
{{--                      data-id="{{ $address->id }}">ویرایش--}}
{{--              </button>--}}
            </div>
          </div>
        @endforeach
        <button type="button" class="o-btn c-checkout-address__item c-checkout-address__item--new js-add-address-btn">
          <span class="c-checkout-address__add-btn">
            ایجاد آدرس جدید
           </span>
        </button>
      </div>
    </div>
    @if (count($store_addresses))
      <div class="js-ui-tab-content u-hidden" data-tab-content-id="dropOff">
        <div class="c-checkout-address__shared-list">
          <p class="o-hint o-hint--medium o-hint--text o-hint--neutral">
            با انتخاب آدرس مرکز تحویل، می‌توانید با مراجعه به آدرس انتخاب شده، کالای خود را دریافت نمایید.
          </p>

          <div class="c-checkout-address__content c-checkout-address__content--shared">
            @foreach($store_addresses as $key => $item)
              @if ($customer->where('address_type', 'StoreAddress')->exists())
                <?php $selected_store_address_id = $customer->delivery_address->id; ?>
              @else
                <?php $selected_store_address_id = null; ?>
              @endif
              <div class="c-checkout-address__item js-recipient-box js-user-address-container js-address-box js-dropoff-return {{ ($selected_store_address_id == $item->id)? 'is-selected' : '' }}"
                   data-id="{{ $item->id }}" data-is-shared="true" data-event="change_address" data-event-category="funnel"
                   data-event-label="addresses: {{ count($store_addresses) }}"
                   data-address="{&quot;id&quot;:{{ $item->id }},&quot;default&quot;:true,&quot;title&quot;:&quot;xxxxxxx&quot;,&quot;address&quot;:&quot;xxxxxxx&quot;,&quot;description&quot;:&quot;xxxxxxx&quot;,&quot;fmcg_support&quot;:false,&quot;sort&quot;:0}"
                   data-gtm-vis-recent-on-screen-9070001_346="4423"
                   data-gtm-vis-first-on-screen-9070001_346="4423"
                   data-gtm-vis-total-visible-time-9070001_346="100"
                   data-gtm-vis-has-fired-9070001_346="1">
                <div class="c-checkout-address__item-headline">
                  <label class="c-outline-radio">
                    <input type="radio" name="address" {{ ($selected_store_address_id == $item->id)? 'checked' : '' }}>
                    <span class="c-outline-radio__check"></span>
                  </label>
                  ارسال به این آدرس
                </div>
                <ul class="c-checkout-address__item-content">
                  <li class="c-checkout-address__item-address">
                    {{ persianNum($item->address) }}
                  </li>
                  <li class="c-checkout-address__item-detail c-checkout-address__item-detail--username">
                    {{ $customer->first_name . ' ' . $customer->last_name }}
                  </li>
                </ul>
                <div class="c-checkout-address__actions"></div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    @endif
  </div>
</div>
<form method="post" class="c-checkout-shipment__form"
      data-has-fresh="0"
      data-has-heavy="0"
      data-has-normal="0"
      data-multi-shipment="0" id="shipping-data-form">
  <input type="hidden" name="shipping[is_jet_delivery_enabled]" value="" id="js-jet-delivery-enabled-input" />
  <input type="hidden" name="shipping[skipItemIds]" value="[]" id="js-skip-item-id-input" />
  <div class="u-hidden">
    <div class="c-checkout-shipment js-shippment-type">
      <div class="c-checkout-shipment__title">
        شیوه و زمان ارسال
      </div>
      <div class="c-checkout-shipment__tab-row">
        <div class="c-checkout-shipment__tab-pill">
          <label>
            <input type="radio" name="shipping[type]" value="normal" checked id="shipment-option-1">
            <span class="c-checkout-shipment__tab-pill-title c-checkout-shipment__tab-pill-title--normal">
               پیشنهادی
               </span>
            <span class="c-checkout-shipment__tab-pill-dsc">
               چینش مرسوله‌ها به پیشنهاد ما
               </span>
          </label>
        </div>
      </div>
    </div>
  </div>
  <div class="js-normal-delivery ">
    <div>
      <div class="c-checkout-pack js-checkout-pack " data-parcel="0-1-1">
        <div class="c-checkout-pack__header">
          <div class="c-checkout-pack__header-title">
            <span>مرسوله ۱ از ۱</span>
          </div>
          <div class="c-checkout-pack__header-dsc">
                  <span>
                  ۲
                  کالا
                  </span>
            <span class="c-checkout-time-table__shipping-lead-time">
                  موجود در انبار دیجی‌کالا
                  </span>
          </div>
        </div>
        <div class="c-checkout-pack__sub-header ">
          <div class="c-checkout-time-table__shipping-type c-checkout-time-table__shipping-type--drop-off">
            تحویل حضوری
          </div>
        </div>
        <div class="c-checkout-pack__row">
          <script>
            var carouselDataTracker = null;
            if (carouselDataTracker) {
              if (!window.carouselData)
                window.carouselData = [carouselDataTracker];
              else
                window.carouselData.push(carouselDataTracker);
            }
          </script>
          <section class="c-swiper c-swiper--products-compact js-swiper-box-container">
            <div class="c-box">
              <div class="swiper-container swiper-container-horizontal js-swiper-container js-swiper-cart-parcel">
                <div class="swiper-wrapper">
                  <div class="swiper-slide js-product-box-container" data-item-id="1141159823">
                    <div class="c-product-box c-product-box--compact js-product-box">
                      <a class="c-product-box__img js-url">
                        <img data-src-swiper="https://dkstatics-public.digikala.com/digikala-products/4209444.jpg?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60" alt="لپ تاپ 15 اینچی لنوو مدل Ideapad 330 - E"
                             class="swiper-lazy">
                      </a>
                      <div class="c-product-box__variant c-product-box__variant--color">
                        <span style="background-color: #212121;"></span>
                        مشکی
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide js-product-box-container" data-item-id="1141161050">
                    <div class="c-product-box c-product-box--compact js-product-box">
                      <a class="c-product-box__img js-url">
                        <img data-src-swiper="https://dkstatics-public.digikala.com/digikala-products/054e9141e62cb5e052a64991df2aecfa651f5a04_1606049057.jpg?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60" alt="ظرف پودر رختشویی طرح ماشین لباس شویی مدل W23"
                             class="swiper-lazy">
                      </a>
                      <div class="c-product-box__variant c-product-box__variant--color">
                        <span style="background-color: #FF80AB;"></span>
                        صورتی
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-button-prev js-swiper-button-prev"></div>
                <div class="swiper-button-next js-swiper-button-next"></div>
              </div>
            </div>
          </section>
        </div>
        <div class="c-checkout-pack__row js-shipment-submit-type active"
             data-shipping-id="shipping-type-normal-0-1-1">
          <div class="c-checkout-time-table js-time-table">
            <div class="c-checkout-time-table__table-title">
              انتخاب زمان ارسال
            </div>
            <span class="js-package-shipping-cost u-hidden"
                  data-price="0"
                  data-cost-id="js-0-1-1-package-row-normal"
                  data-post-payed="">
                  هزینه ارسال : <span class=''>رایگان</span>
                  </span>
            <div class="c-time-table js-time-table-container ">
              <div class="c-time-table__table swiper-container js-time-table-swiper">
                <ul class=" swiper-wrapper">
                  <li class="swiper-slide c-time-table__day-details "
                      id="day-normal-0-1-1-1">
                              <span class="c-time-table__day-name c-time-table__day-name--holiday">
                              جمعه
                              </span>
                    <span class="c-time-table__date">
                              ۲۴ اردیبهشت
                              </span>
                    <ul class="c-time-table__hour-container">
                      <li class="c-outline-radio c-time-table__hour-item ">
                        <input type="radio"
                               name="shipping[time_scopes][0-1-1]"
                               value="9011455"
                               id ="hour-radio-0-1-1-9011455-normal"
                        >
                        <label class="c-time-table__radio-label
                                       "
                               for="hour-radio-0-1-1-9011455-normal"
                        >
                                    <span>
                                    بازه
                                    ۱۰
                                    -
                                    ۲۱
                                    </span>
                        </label>
                      </li>
                    </ul>
                  </li>
                  <li class="swiper-slide c-time-table__day-details "
                      id="day-normal-0-1-1-2">
                              <span class="c-time-table__day-name ">
                              شنبه
                              </span>
                    <span class="c-time-table__date">
                              ۲۵ اردیبهشت
                              </span>
                    <ul class="c-time-table__hour-container">
                      <li class="c-outline-radio c-time-table__hour-item ">
                        <input type="radio"
                               name="shipping[time_scopes][0-1-1]"
                               value="3433184"
                               id ="hour-radio-0-1-1-3433184-normal"
                        >
                        <label class="c-time-table__radio-label
                                       "
                               for="hour-radio-0-1-1-3433184-normal"
                        >
                                    <span>
                                    بازه
                                    ۱۰
                                    -
                                    ۱۸
                                    </span>
                        </label>
                      </li>
                    </ul>
                  </li>
                  <li class="swiper-slide c-time-table__day-details "
                      id="day-normal-0-1-1-3">
                              <span class="c-time-table__day-name ">
                              یکشنبه
                              </span>
                    <span class="c-time-table__date">
                              ۲۶ اردیبهشت
                              </span>
                    <ul class="c-time-table__hour-container">
                      <li class="c-outline-radio c-time-table__hour-item ">
                        <input type="radio"
                               name="shipping[time_scopes][0-1-1]"
                               value="9011457"
                               id ="hour-radio-0-1-1-9011457-normal"
                        >
                        <label class="c-time-table__radio-label
                                       "
                               for="hour-radio-0-1-1-9011457-normal"
                        >
                                    <span>
                                    بازه
                                    ۱۰
                                    -
                                    ۲۱
                                    </span>
                        </label>
                      </li>
                    </ul>
                  </li>
                  <li class="swiper-slide c-time-table__day-details "
                      id="day-normal-0-1-1-4">
                              <span class="c-time-table__day-name ">
                              دو‌شنبه
                              </span>
                    <span class="c-time-table__date">
                              ۲۷ اردیبهشت
                              </span>
                    <ul class="c-time-table__hour-container">
                      <li class="c-outline-radio c-time-table__hour-item ">
                        <input type="radio"
                               name="shipping[time_scopes][0-1-1]"
                               value="9011458"
                               id ="hour-radio-0-1-1-9011458-normal"
                        >
                        <label class="c-time-table__radio-label
                                       "
                               for="hour-radio-0-1-1-9011458-normal"
                        >
                                    <span>
                                    بازه
                                    ۱۰
                                    -
                                    ۲۱
                                    </span>
                        </label>
                      </li>
                    </ul>
                  </li>
                  <li class="swiper-slide c-time-table__day-details "
                      id="day-normal-0-1-1-5">
                              <span class="c-time-table__day-name ">
                              سه‌شنبه
                              </span>
                    <span class="c-time-table__date">
                              ۲۸ اردیبهشت
                              </span>
                    <ul class="c-time-table__hour-container">
                      <li class="c-outline-radio c-time-table__hour-item ">
                        <input type="radio"
                               name="shipping[time_scopes][0-1-1]"
                               value="9011459"
                               id ="hour-radio-0-1-1-9011459-normal"
                        >
                        <label class="c-time-table__radio-label
                                       "
                               for="hour-radio-0-1-1-9011459-normal"
                        >
                                    <span>
                                    بازه
                                    ۱۰
                                    -
                                    ۲۱
                                    </span>
                        </label>
                      </li>
                    </ul>
                  </li>
                </ul>
                <div class="c-time-table__navigation c-time-table__navigation--prev js-swiper-button-prev">
                  <div class="c-time-table__navigation-button" data-icon="Icon-Navigation-Chevron-Right"></div>
                </div>
                <div class="c-time-table__navigation c-time-table__navigation--next js-swiper-button-next">
                  <div class="c-time-table__navigation-button" data-icon="Icon-Navigation-Chevron-Left"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="c-checkout-shipment__invoice-type">
    <input type="hidden" name="is_legal" value="0" />
    <p class="c-checkout-shipment__invoice-type-info">
      شما می‌توانید فاکتور خرید را پس از تحویل سفارش از بخش جزییات سفارش در حساب کاربری خود دریافت کنید.
    </p>
  </div>
</form>
