@extends('layouts.customer.master')
@section('head')
<script>
  var supernova_mode = "production";
  var supernova_tracker_url = "https:\/\/etrackerd.digikala.com\/tracker\/events\/";
  var activeMenu = "personalInfo";
  var faqPageTitle = "profile_section";
  var skipWalletRequest = true;
  var userId = 9735394;
  var adroRCActivation = true;
  var loginRegisterUrlWithBack = "\/users\/login-register\/?_back=https:\/\/www.digikala.com\/profile\/personal-info\/";
  var isNewCustomer = false;
  var digiclubLuckyDrawEndTime = "2021-06-27 15:30:28";
  var activateUrl = "\/digiclub\/activate\/";
</script>
@endsection
@section('o-page__content')
<section class="o-page__content">
  <div class="o-box">
    <div class="o-box__header">
      <span class="o-box__title">اطلاعات شخصی</span></div>
    <div class="c-profile-personal__grid">
      <div class="c-profile-personal__grid-item">
        <div>
          <div class="c-profile-personal__grid-item-title">نام و نام خانوادگی</div>
          <div class="c-profile-personal__grid-item-value">
              {{ !is_null($customer->first_name)? $customer->first_name . ' ' . $customer->last_name : '-' }}
          </div>
        </div>
        <div class="c-profile-personal__grid-item-btn js-personal-info-modal-btn is-edit"
             data-verified-phone="1" data-remodal="fullname"></div>
      </div>
      <div class="c-profile-personal__grid-item">
        <div>
          <div class="c-profile-personal__grid-item-title">کد ملی</div>
          <div class="c-profile-personal__grid-item-value">
            {{ !is_null($customer->national_code)? persianNum($customer->national_code) : '-' }}
          </div>
        </div>
        <div class="c-profile-personal__grid-item-btn js-personal-info-modal-btn is-edit"
             data-verified-phone="1" data-remodal="national_identity_number"></div>
      </div>
      <div class="c-profile-personal__grid-item">
        <div>
          <div class="c-profile-personal__grid-item-title">شماره تلفن همراه</div>
          <div class="c-profile-personal__grid-item-value">
            {{ !is_null($customer->mobile)? persianNum(0 . $customer->mobile) : '-' }}
          </div>
        </div>
        <div class="c-profile-personal__grid-item-btn js-personal-info-modal-btn is-edit"
             data-verified-phone="1" data-remodal="mobile_phone"></div>
      </div>
      <div class="c-profile-personal__grid-item">
        <div>
          <div class="c-profile-personal__grid-item-title">پست الکترونیک</div>
          <div class="c-profile-personal__grid-item-value">
            {{ !is_null($customer->email)? $customer->email : '-' }}
          </div>
        </div>
        <div class="c-profile-personal__grid-item-btn js-personal-info-modal-btn is-edit"
             data-verified-phone="1" data-remodal="email"></div>
      </div>
      <div class="c-profile-personal__grid-item">
        <div>
          <div class="c-profile-personal__grid-item-title">تاریخ تولد</div>
          <div class="c-profile-personal__grid-item-value">
            {{ count($date)? persianNum($date[0]) . '/' . persianNum($date[1]) . '/' . persianNum($date[2]) : '-' }}
          </div>
        </div>
        <div class="c-profile-personal__grid-item-btn js-personal-info-modal-btn is-edit"
             data-verified-phone="1" data-remodal="birth"></div>
      </div>
      <div class="c-profile-personal__grid-item">
        <div>
          <div class="c-profile-personal__grid-item-title">شغل</div>
          <div class="c-profile-personal__grid-item-value">
            -
          </div>
        </div>
        <div class="c-profile-personal__grid-item-btn js-personal-info-modal-btn is-edit"
             data-verified-phone="1" data-remodal="job_title"></div>
      </div>
      <div class="c-profile-personal__grid-item">
        <div>
          <div class="c-profile-personal__grid-item-title">روش بازگرداندن وجه</div>
          <div class="c-profile-personal__grid-item-value">
            {{ !is_null($customer->return_money_method)? ($customer->return_money_method == 'wallet' ? 'کیف پول' : 'شماره کارت: ' . persianNum($customer->bank_card_number) ) : '-' }}
          </div>
        </div>
        <div class="c-profile-personal__grid-item-btn js-personal-info-modal-btn is-edit"
             data-verified-phone="1" data-remodal="bank_card_number"></div>
      </div>
      <div class="c-profile-personal__grid-item">
        <div>
          <div class="c-profile-personal__grid-item-title">رمز عبور</div>
          <div class="c-profile-personal__grid-item-value">
            ******
          </div>
        </div>
        <div class="c-profile-personal__grid-item-btn js-personal-info-modal-btn is-edit"
             data-verified-phone="1" data-remodal="reset_password"></div>
      </div>
    </div>
  </div>
  <div class="o-box">
    <div class="o-box__header profile__legal-header"><span class="o-box__title">افزودن اطلاعات حقوقی</span>
    </div>
    <div class="c-profile-personal__legal-desc js-legal-content">با تکمیل اطلاعات حقوقی،
      می‌توانید اقدام به خرید سازمانی با دریافت فاکتور رسمی و گواهی ارزش افزوده نمایید.
    </div>
    <div class="c-profile-personal__legal-link js-legal-content">
      <div class="o-link o-link--sm o-link--has-arrow js-edit-legal">ویرایش اطلاعات حقوقی
      </div>
    </div>

    <form class="c-profile-personal__legal-form js-legal-form js-personal-info-form" data-city-id="" data-city-name="" id="personal-info-legal-form" method="post">
      <input name="additionalinfo[company]" type="hidden" value="1">
      <label class="o-form__field-container">
        <div class="o-form__field-label">نام سازمان</div>
        <div class="o-form__field-frame">
          <input class="o-form__field js-input-field " name="additionalinfo[company_name]" placeholder="" type="text" value="{{ ($customer->legal()->exists())? $customer->legal->company_name : '' }}"/>
        </div>
      </label>
      <label class="o-form__field-container">
        <div class="o-form__field-label">کد اقتصادی</div>
        <div class="o-form__field-frame">
          <input class="o-form__field js-input-field " name="additionalinfo[company_economic_number]" placeholder="" type="text" value="{{ ($customer->legal()->exists())? persianNum($customer->legal->economic_number) : '' }}"/>
        </div>
      </label>
      <label class="o-form__field-container">
        <div class="o-form__field-label">شناسه ملی</div>
        <div class="o-form__field-frame">
          <input class="o-form__field js-input-field " name="additionalinfo[company_national_identity_number]" placeholder="" type="text" value="{{ ($customer->legal()->exists())? persianNum($customer->legal->nationalـidentity) : '' }}"/>
        </div>
      </label>

      <label class="o-form__field-container">
        <div class="o-form__field-label">شناسه ثبت</div>
        <div class="o-form__field-frame">
          <input class="o-form__field js-input-field " name="additionalinfo[company_registration_number]" placeholder="" type="text" value="{{ ($customer->legal()->exists())? persianNum($customer->legal->registration_number) : '' }}"/>
        </div>
      </label>

      <div class="o-form__field-container">
        <div class="o-form__field-label">استان محل دفتر مرکزی</div>
        <select class="c-ui-select js-ui-select-search js-dropdown-universal js-select-company-state js-select-state"
          name="additionalinfo[company_state_id]" value="">
          <option value="">انتخاب استان</option>
          @if(count($states))
            @foreach($states->where('type', 'state') as $state)
              <option value="{{ $state->id }}" {{ (($customer->legal()->exists()) && ($customer->legal->city->state->id == $state->id))? 'selected' : '' }}> {{ $state->name }} </option>
            @endforeach
          @endif
        </select>
      </div>


      <div class="o-form__field-container">
        <div class="o-form__field-label">شهر محل دفتر مرکزی</div>
        <select class="c-ui-select js-ui-select-search js-dropdown-universal js-select-company-city js-select-city" name="additionalinfo[company_city_id]" value="">
          <option value="">انتخاب شهر</option>
        </select>
      </div>
      <label class="o-form__field-container">
        <div class="o-form__field-label">شماره تلفن ثابت</div>
        <div class="o-form__field-frame">
          <input class="o-form__field js-input-field " name="additionalinfo[company_phone]" placeholder="" type="text" value="{{ ($customer->legal()->exists())? persianNum($customer->legal->phone) : '' }}"/></div>
      </label>
      <div class="c-profile-personal__legal-actions">
        <button class="o-btn o-btn--contained-blue-lg">ثبت اطلاعات</button>
      </div>
    </form>

  </div>
  <div class="c-notice u-hidden js-notice"><span class="js-notice-text"></span>
    <button class="c-notice__dismiss-button js-notice-button"></button>
    <div class="c-notice__progress-bar js-notice-progress"></div>
  </div>
</section>
@endsection
