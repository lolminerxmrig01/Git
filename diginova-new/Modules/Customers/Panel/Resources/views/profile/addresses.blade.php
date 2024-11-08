@extends('layouts.customer.master')
@section('head')
  <script>
    var supernova_mode = "production";
    var supernova_tracker_url = "https:\/\/etrackerd.digikala.com\/tracker\/events\/";
    var activeMenu = "addresses";
    var faqPageTitle = "profile_section";
    var skipWalletRequest = true;
    var userInformation = {"firstName":"","lastName":"","nationalSecurityNumber":"","mobile":""};
    var addressAjaxUrls = {"add":"\/ajax\/profile\/addresses\/add\/","edit":"\/ajax\/profile\/addresses\/edit\/","delete":"\/ajax\/addresses\/remove\/"};
    var isFirstAddress = false;
    var pageName = "Profile";
    var userId = 9735394;
    var adroRCActivation = true;
    var loginRegisterUrlWithBack = "\/users\/login-register\/?_back=https:\/\/www.digikala.com\/profile\/addresses\/";
    var isNewCustomer = false;
    var digiclubLuckyDrawEndTime = "2021-06-27 15:30:28";
    var activateUrl = "\/digiclub\/activate\/";
  </script>
@endsection
@section('o-page__content')
<section class="o-page__content">
    <div class="o-box" id="address-section">
      {{-- start --}}
      <div class="o-box__header">
        <span class="o-box__title">نشانی‌ها</span>
      </div>

      @foreach($customer->addresses as $address)
        <div class="c-profile-address__item js-user-address-container">
        <div class="c-profile-address__item-top">
          <div class="c-profile-address__item-title">
            {{ $address->address }}
          </div>
          <div class="c-ui-more">
            <div class="o-btn o-btn--icon-gray-md o-btn--l-more js-ui-see-more"></div>
            <div class="c-ui-more__options js-ui-more-options">
              <div class="c-ui-more__option c-ui-more__option--red js-remove-address-btn" data-id="{{ $address->id }}" data-token="">
                حذف
              </div>
            </div>
          </div>
        </div>
        <div class="c-profile-address__content">
          <ul class="c-profile-address__info">
            <li>
              <div class="c-profile-address__info-item location">
{{--                {{ fullZone($address->state->id, ' ', ' ', ' ') }}--}}
                  {{ getState($address->state->id)->name . '، ' . $address->state->name }}
              </div>
            </li>
            @if(!is_null($address->postal_code))
            <li>
              <div class="c-profile-address__info-item postal-code">{{ persianNum($address->postal_code) }}</div>
            </li>
            @endif
            @if(!is_null($customer->mobile))
            <li>
              <div class="c-profile-address__info-item phone">{{ persianNum(0 . $customer->mobile) }}</div>
            </li>
            @endif
            <li>
              <div class="c-profile-address__info-item name">{{ $customer->first_name . ' ' . $customer->last_name }}</div>
            </li>
{{--            <li class="location-link">--}}
{{--              <div class="o-link o-link--has-arrow o-link--sm js-edit-address-btn">ویرایش نشانی</div>--}}
{{--            </li>--}}
          </ul>
        </div>
      </div>
      @endforeach
      {{-- end --}}

      <div class="c-profile-address__add js-add-address-btn">
        اضافه کردن نشانی جدید
      </div>

    </div>
    <div class="remodal c-modal c-modal--no-bottom-padding js-address-modal"
         data-remodal-id="add-edit-address"
         role="dialog"
         aria-labelledby="modalTitle"
         tabindex="-1z"
         aria-describedby="modalDesc"
         data-remodal-options="closeOnOutsideClick: false"
    >
      <div class="c-modal__top-bar  ">
        <div class="c-modal__title js-address-modal-title">افزودن آدرس</div>
        <div class="c-modal__close" data-remodal-action="close"></div>
      </div>
      <form method="post" id="add-edit-address-form">
        <div class="c-address__modal-content js-map-interactive" id="address-modal-map">
          <div class="c-map__address-container js-map-address-container u-hidden">
            <div class="c-map__address-title">برای ادامه دادن فرآیند خرید موقعیت آدرس زیر را بر روی نقشه تعیین
              کنید:
            </div>
            <div class="c-map__address js-map-address"></div>
          </div>
          <div class="c-map__container  js-map-container">
            <div class="c-map " id="map" data-current-icon="https://www.digikala.com/static/files/c1d18c6c.png"></div>
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
              <img src="https://www.digikala.com/static/files/7ab27ed3.svg"/></div>
          </div>
          <div class="c-address__modal-footer">
            <div class="c-address__modal-footer-title">مرسوله شما به این موقعیت ارسال خواهد شد.</div>
            <div class="o-btn o-btn--contained-red-md js-select-address-map">ثبت و افزودن جزییات</div>
          </div>
        </div>
        <div class="c-address__modal-content u-hidden" id="address-modal-form">
          <div class="c-address__separator"></div>
          <div class="c-address__form">
            <div class="c-address__form-row">
              <div class="o-form__field-container">
                <div class="o-form__field-label">استان*</div>
                <select class="c-ui-select js-ui-select-search js-dropdown-universal js-select-state js-address-state-id" name="address[state_id]" value="">
                  <option value="">انتخاب استان</option>
                  @foreach($states->where('type', 'state') as $state)
                    <option value="{{ $state->id }}" >{{ $state->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="o-form__field-container">
                <div class="o-form__field-label">شهر*</div>
                <select
                  class="c-ui-select js-ui-select-search js-dropdown-universal js-select-city js-address-city-id"
                  name="address[city_id]" value="">
                  <option value="">انتخاب شهر</option>
                </select></div>
            </div>
            <div class="c-address__form-row js-district-wrapper">
              <div class="o-form__field-container">
                <div class="o-form__field-label">محله*</div>
                <select
                  class="c-ui-select js-ui-select-search js-dropdown-universal js-select-district js-address-district-id"
                  name="address[district_id]" value="">
                  <option value="">انتخاب محله</option>
                </select></div>
            </div>
            <div class="c-address__form-row c-address__form-row--full-width js-address-field"><label
                class="o-form__field-container">
                <div class="o-form__field-label">نشانی پستی*</div>
                <div class="o-form__field-frame"><input name="address[address]" type="" placeholder=""
                                                        value=""
                                                        class="o-form__field js-input-field js-address-address"/>
                </div>
              </label></div>
            <div class="c-address__form-row">
              <div class="c-address__form-row"><label class="o-form__field-container">
                  <div class="o-form__field-label">پلاک*</div>
                  <div class="o-form__field-frame"><input name="address[bld_num]" type="" placeholder=""
                                                          value=""
                                                          class="o-form__field js-input-field js-address-building-number"/>
                  </div>
                </label><label class="o-form__field-container">
                  <div class="o-form__field-label">واحد</div>
                  <div class="o-form__field-frame"><input name="address[apt_id]" type="" placeholder=""
                                                          value=""
                                                          class="o-form__field js-input-field js-address-apartment-number"/>
                  </div>
                </label></div>
              <div class="c-address__form-row"><label class="o-form__field-container">
                  <div class="o-form__field-label">کد پستی*</div>
                  <div class="o-form__field-frame"><input name="address[post_code]" type="" placeholder=""
                                                          value=""
                                                          class="o-form__field js-input-field js-address-postal-code"/>
                  </div>
                  <div class="o-form__field-helper">کدپستی باید ۱۰ رقم و بدون خط تیره باشد</div>
                </label></div>
            </div>
          </div>
          <div class="c-address__form">
            <div class="c-address__form-row c-address__form-row--full-width js-recipient-is-me-container"><label
                class="o-form__check-box"><input class="o-form__check-box-input js-recipient-is-me"
                                                 name="address[recipient_is_self]" value="true" type="checkbox"><span
                  class="o-form__check-box-sign"></span><span class="js-ui-checkbox-label">
            گیرنده سفارش خودم هستم
        </span></label></div>
            <div class="c-address__form-row"><input type="hidden" class="js-address-id"><label
                class="o-form__field-container">
                <div class="o-form__field-label">نام گیرنده*</div>
                <div class="o-form__field-frame"><input name="address[first_name]" type="" placeholder=""
                                                        value=""
                                                        class="o-form__field js-input-field js-address-first-name"/>
                </div>
              </label><label class="o-form__field-container">
                <div class="o-form__field-label">نام خانوادگی گیرنده*</div>
                <div class="o-form__field-frame"><input name="address[last_name]" type="" placeholder=""
                                                        value=""
                                                        class="o-form__field js-input-field js-address-last-name"/>
                </div>
              </label></div>
            <div class="c-address__form-row"><label class="o-form__field-container">
                <div class="o-form__field-label">شماره موبایل*</div>
                <div class="o-form__field-frame"><input name="address[mobile_phone]" type="" placeholder=""
                                                        value=""
                                                        class="o-form__field js-input-field js-address-mobile-phone"/>
                </div>
                <div class="o-form__field-helper">مثل: ۰۹۱۲۳۴۵۶۷۸۹</div>
              </label></div>
          </div>
          <div class="c-address__separator"></div>
          <div class="c-address__modal-footer">
            <div class="o-btn o-btn--link-blue-sm js-back-to-map">اصلاح موقعیت بر روی نقشه</div>
            <button class="o-btn o-btn--contained-red-md js-submit-btn" type="submit">تایید و ثبت آدرس</button>
          </div>
        </div>
      </form>
    </div>
</section>
@endsection


@section('page-content')
@endsection

@section('script')
@endsection
