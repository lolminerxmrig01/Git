@extends('layouts.front.master')

@section('head')
  <title>{{ $fa_store_name }}</title>
  <link rel="canonical" href="{{ route('front.addAddress') }}"/>
  <meta name="robots" content="noindex, nofollow"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>
    var supernova_mode = "production";
    var userInformation = {
      "firstName": "{{ $customer->first_name }}",
      "lastName": "{{ $customer->last_name }}",
      "nationalSecurityNumber": "{{ $customer->national_code }}",
      "mobile": "{{ !is_null($customer->mobile)? 0 . $customer->mobile : "" }}"
    };
    var userId = {{ $customer->id }};
    var isNewCustomer = false;
  </script>
  <script id="sentry_js" src="{{ asset('assets/js/sentry.js') }}"></script>
  <script id="map_js" src="{{ asset('assets/js/map2.js') }}"></script>
  <script src="https://www.parsimap.com/js/v3.1.0/parsimap.js?key=public"></script>
  <style>
    @media screen and (-ms-high-contrast: none) {
      .c-shipment-page__to-payment-sticky, .c-checkout__to-shipping-sticky {
        position: relative !important;
      }

      .c-checkout-aside {
        position: relative !important;
      }
    }

    /* all edge versions */
    @supports (-ms-ime-align:auto) {
      .c-shipment-page__to-payment-sticky, .c-checkout__to-shipping-sticky {
        position: relative !important;
      }

      .c-checkout-aside {
        position: relative !important;
      }
    }
  </style>
@endsection

@section('content')

<main id="main">
  <div id="HomePageTopBanner"></div>
  <div class="c-address__page">
    <div class="js-add-address-btn u-hidden" data-not-modal="true"></div>
    <div class="c-address__title js-address-modal-title">
      موقعیت مکانی آدرس
    </div>
    <div class="c-address__subtitle js-address-modal-subtitle">
      لطفا موقعیت مکانی آدرس را بر روی نقشه تعیین کنید.
    </div>
    <form method="post" id="add-edit-address-form" action="{{ route('front.saveAddress') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="c-address__modal-content js-map-interactive" id="address-modal-map">
        <div class="c-map__address-container js-map-address-container u-hidden">
          <div class="c-map__address-title">
            برای ادامه دادن فرآیند خرید موقعیت آدرس زیر را بر روی نقشه تعیین کنید:
          </div>
          <div class="c-map__address js-map-address"></div>
        </div>
        <div class="c-map__container  js-map-container">
          <div class="c-map " id="map" data-current-icon="{{ asset('assets/images/png/location.png') }}"></div>
          <div class="c-map__search-field">
            <input class="js-search-map-input" placeholder="جستجو آدرس">
            <button type="button" class="o-btn c-map__search-cancel js-search-map-cancel u-hidden"></button>
          </div>
          <div class="c-map__search-content">
            <div class="c-map__search-content-list js-search-map-content"></div>
          </div>
          <input type="hidden" name="address[lat]">
          <input type="hidden" name="address[lng]">
          <div class="c-map__overlay"></div>
          <div class="c-map__marker">
            <img src="{{ asset('assets/images/svg/location2.svg') }}"/></div>
        </div>
        <div class="c-address__modal-footer">
          <div class="c-address__modal-footer-title">
            مرسوله شما به این موقعیت ارسال خواهد شد.
          </div>
          <div class="o-btn o-btn--contained-red-md js-select-address-map">
            ثبت و افزودن جزییات
          </div>
        </div>
      </div>
      <div class="c-address__modal-content u-hidden" id="address-modal-form">
        <div class="c-address__form">
          <div class="c-address__form-row">
            <div class="o-form__field-container">
              <div class="o-form__field-label">استان*</div>
              <select class="c-ui-select js-ui-select-search js-dropdown-universal js-select-state js-address-state-id"
                name="address[state_id]" value="">
                <option value="">انتخاب استان</option>
                @foreach($states->where('type', 'state') as $state)
                <option value="{{ $state->id }}" >{{ $state->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="o-form__field-container">
              <div class="o-form__field-label">شهر*</div>
              <select class="c-ui-select js-ui-select-search js-dropdown-universal js-select-city js-address-city-id" name="address[city_id]" value="">
                <option value="">انتخاب شهر</option>
              </select>
            </div>
          </div>
          <div class="c-address__form-row js-district-wrapper">
            <div class="o-form__field-container">
              <div class="o-form__field-label">محله*</div>
              <select class="c-ui-select js-ui-select-search js-dropdown-universal js-select-district js-address-district-id" name="address[district_id]" value="">
                <option value="">انتخاب محله</option>
              </select>
            </div>
          </div>
          <div class="c-address__form-row c-address__form-row--full-width js-address-field">
            <label class="o-form__field-container">
              <div class="o-form__field-label">نشانی پستی*</div>
              <div class="o-form__field-frame">
                <input name="address[address]" type="" placeholder="" value="" class="o-form__field js-input-field js-address-address" />
              </div>
            </label>
          </div>
          <div class="c-address__form-row">
            <div class="c-address__form-row">
              <label class="o-form__field-container">
                <div class="o-form__field-label">پلاک*</div>
                <div class="o-form__field-frame">
                  <input name="address[bld_num]" type="" placeholder="" value="" class="o-form__field js-input-field js-address-building-number" />
                </div>
              </label>
              <label class="o-form__field-container">
                <div class="o-form__field-label">واحد</div>
                <div class="o-form__field-frame">
                  <input name="address[apt_id]" type="" placeholder="" value="" class="o-form__field js-input-field js-address-apartment-number" />
                </div>
              </label>
            </div>
            <div class="c-address__form-row">
              <label class="o-form__field-container">
                <div class="o-form__field-label">کد پستی*</div>
                <div class="o-form__field-frame">
                  <input name="address[post_code]" type="" placeholder="" value="" class="o-form__field js-input-field js-address-postal-code" />
                </div>
                <div class="o-form__field-helper">کدپستی باید ۱۰ رقم و بدون خط تیره باشد</div>
              </label>
            </div>
          </div>
        </div>
        <div class="c-address__form">
          <div class="c-address__form-row c-address__form-row--full-width js-recipient-is-me-container">
            <label class="o-form__check-box">
              <input class="o-form__check-box-input js-recipient-is-me" name="address[recipient_is_self]" value="true" type="checkbox" >
              <span class="o-form__check-box-sign"></span>
              <span class="js-ui-checkbox-label">
                گیرنده سفارش خودم هستم
              </span>
            </label>
          </div>
          <div class="c-address__form-row">
            <input type="hidden" class="js-address-id">
            <label class="o-form__field-container">
              <div class="o-form__field-label">نام گیرنده*</div>
              <div class="o-form__field-frame">
                <input name="address[first_name]" type="" placeholder="" value="" class="o-form__field js-input-field js-address-first-name" />
              </div>
            </label>
            <label class="o-form__field-container">
              <div class="o-form__field-label">نام خانوادگی گیرنده*</div>
              <div class="o-form__field-frame">
                <input name="address[last_name]" type="" placeholder="" value="" class="o-form__field js-input-field js-address-last-name" />
              </div>
            </label>
          </div>
          <div class="c-address__form-row">
            <label class="o-form__field-container">
              <div class="o-form__field-label">کد ملی گیرنده*</div>
              <div class="o-form__field-frame">
                <input name="address[national_id]" type="" placeholder="" value="" class="o-form__field js-input-field js-address-national-id" />
              </div>
              <div class="o-form__field-helper">کد ملی باید ۱۰ رقم و بدون خط تیره باشد</div>
            </label>
            <label class="o-form__field-container">
              <div class="o-form__field-label">شماره موبایل*</div>
              <div class="o-form__field-frame">
                <input name="address[mobile_phone]" type="" placeholder="" value="" class="o-form__field js-input-field js-address-mobile-phone" />
              </div>
              <div class="o-form__field-helper">مثل: ۰۹۱۲۳۴۵۶۷۸۹</div>
            </label>
          </div>
        </div>
        <div class="c-address__modal-footer">
          <div class="o-btn o-btn--link-blue-sm js-back-to-map">اصلاح موقعیت بر روی نقشه</div>
          <button class="o-btn o-btn--contained-red-md js-submit-btn" type="submit">تایید و ثبت آدرس</button>
        </div>
      </div>
    </form>
  </div>
</main>

@endsection

@section('source')
  <script>
    // اضافه کردن توکن به درخواست های ایجکس
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $("body").addClass('c-checkout-pages');
    $("body").removeClass('has-top-banner');
  </script>
@endsection

