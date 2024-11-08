@extends('layouts.staff.master')
@section('title') پروفایل | {{ $fa_store_name }}  @endsection
@section('head')
<script>
  var supernova_mode = "production";
  var supernova_tracker_url = "";
  var dashboard_sold_history_dates = 0;
  var dashboard_sold_history_prices = 0;
  var dashboard_sold_history_quantities = 0;
  var dashboard_variant_active_with_inventory = 0;
  var dashboard_variant_active_without_inventory = 0;
  var dashboard_variant_all = 0;
  var dashboard_variant_active_false = 0;
  var dashboardRate = 70;
  var existNewElectronicContract = false;
  var contractDaysLeft = 7;
  var isContractRejected = false;
  var hasAccessToContract = true;
  var showRejectedMessage = 0;
  var rejectedMessage = "";
  var isLoggedSeller = 1;
  var walkthroughSteps = [];
  var showPriceModal = 0;
  var newSeller = 1;
  var is_yalda = 0;
</script>

<link rel="stylesheet" href="{{ asset('mehdi/staff/css/tagify.css') }}">
<script src="{{ asset('mehdi/staff/js/inputmask.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/jQuery.tagify.min.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/tagify.min.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/edited_datepicker.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/tags5.js') }}"></script>

<style>
  .tags {
    background: white;
    border-color: #e6e9ed!important;
  }
  .tagify .tagify__tag {
    background-color: #ebedf3;
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 0 .5rem !!important;
    border-radius: .42rem !important;
  }

  .tagify__input {
    color: #606265;
  }

  .c-ui-input__RD-field {
    font-size: 0.97rem !important;
  }

  .c-ui-input__field--textarea {
    font-size: 0.97rem !important;
    font-weight: unset !important;
  }

  .c-content-modal__uploads-label.empty .c-content-modal__uploads-preview:before {
    content: unset !important;
  }
</style>
@endsection
@section('content')
<main class="c-main">
  <div class="uk-container uk-container-large">
    <div class="c-grid">
      <div class="c-grid__row c-grid__row--lg-top">

        <form method="POST" id="profile-form" data-name="profile" class="c-grid__col c-grid__col--lg-9
         c-grid__col--xs-gap c-grid__col--sm-gap js-profile-page" novalidate="novalidate">
          <div class="c-grid__row">
            <div class="c-grid__col">
              <div class="c-card c-RD-profile__bdrs-bottom-0">
                <div class="c-card__body c-card__body--pd-0">
                  <div class="">
                    <nav class="uk-navbar-container uk-navbar-transparent c-RD-profile--h-70
                     c-profile-responsive-navbar uk-navbar" uk-navbar="" style="border-bottom: 1px solid #e6e9ed;margin-bottom: 15px; height: 57px">
                      <div class="uk-navbar-left">
                        <ul class="uk-navbar-nav">
                          <li class="c-profile-nav--menu-links js-profile-navbar uk-flex uk-flex-column"
                           data-content="general" style="padding-top: 5px; padding-bottom: 5px; pointer-events: all;">
                            <a class="c-RD-profile__menu-text" href="#general" style="color: rgb(98, 102, 109) !important;">اطلاعات حساب</a>
                            <div class="c-RD-profile__selected-nav" style="display: block;">&nbsp;</div>
                          </li>
                          <li class="c-profile-nav--menu-links js-profile-navbar uk-flex uk-flex-column"
                           data-content="addresses" style="padding-top: 5px; padding-bottom: 5px; pointer-events: all;">
                            <a class="c-RD-profile__menu-text" href="#addresses" style="color: rgb(161, 163, 168) !important;">نشانی ها</a>
                            <div class="c-RD-profile__selected-nav" style="display: none;">&nbsp;</div>
                          </li>
                        </ul>
                      </div>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="c-RD-profile--w-100p js-profile-content">

            <div class="c-RD-profile__dis-none " data-name="general" style="display: block;">

              <div class="c-grid__row c-RD-profile__mt-0" id="general">
                <div class="c-grid__col">
                  <div class="c-card c-RD-profile__bdrs-top-0 js-profile-content-spinner" style="box-shadow: 0 10px 12px 0 rgba(0, 0, 0, 0.05);">
                    <div class="c-card__header c-card__header--with-controls  uk-hidden"></div>
                    <div class="c-card__body c-card__body--form">
                      <div class="c-grid__row">

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                            <span class="c-RD-profile__title">وضعیت</span>
                          </div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="status">وضعیت مشتری:</label>
                              <div class="c-ui-input">
                                <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible"
                                   name="status"  aria-hidden="true">
                                  <option value="active" {{ ($customer->status == 'active')? 'selected' : '' }}>فعال</option>
                                  <option value="inactive" {{ ($customer->status == 'inactive')? 'selected' : '' }}>غیرفعال</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row" style="margin-top: 50px !important;">
                          <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                            <span class="c-RD-profile__title">اطلاعات شخصی</span>
                          </div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="first_name">نام:</label>
                              <div class="c-ui-input">
                                <input type="text" name="first_name" class="c-ui-input__field c-ui-input__RD-field" 
                                value="{{ $customer->first_name }}" aria-invalid="false">
                              </div>
                            </div>
                          </div>

                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="last_name">نام خانوادگی:</label>
                              <div class="c-ui-input">
                                <input type="text" name="last_name" class="c-ui-input__field c-ui-input__RD-field" 
                                value="{{ $customer->last_name }}"  aria-invalid="false">
                              </div>
                            </div>
                          </div>

                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label for="birthdate" class="c-RD-profile__input-name">تاریخ تولد:</label>
                              <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker js-persian-date-picker" 
                              data-format="YYYY-MM-DD" data-time="1" data-from-today="0" data-date="1" data-name="birthdate"
                               value="{{ $customer->birthdate }}" autocomplete="off">
                              <input name="birthdate" id="birthdate" type="hidden" value="{{ $customer->birthdate }}">
                            </div>
                          </div>

                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="national_code">کد ملی:</label>
                              <div class="c-ui-input">
                                <input type="text" name="national_code" class="c-ui-input__field c-ui-input__RD-field" 
                                value="{{ $customer->national_code }}" aria-invalid="false">
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="mobile">شماره تلفن همراه:</label>
                              <div class="c-ui-input">
                                <input type="text" name="mobile" class="c-ui-input__field c-ui-input__RD-field"
                                 value="{{ !is_null($customer->mobile)? 0 . $customer->mobile : '' }}"  aria-invalid="false">
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="email">ایمیل:</label>
                              <div class="c-ui-input">
                                <input type="text" name="email" class="c-ui-input__field c-ui-input__RD-field"
                                 value="{{ $customer->email }}" aria-invalid="false">
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="bank_card_number">شماره کارت:</label>
                              <div class="c-ui-input">
                                <input type="text" name="bank_card_number" class="c-ui-input__field c-ui-input__RD-field" 
                                value="{{ $customer->bank_card_number }}" aria-invalid="false">
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="newsletters">دریافت خبرنامه:</label>
                              <div class="c-ui-input">
                                <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible"
                                 name="newsletters"  aria-hidden="true" disabled>
                                  <option></option>
                                  <option value="active">بله</option>
                                  <option value="inactive">خیر</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row" style="margin-top: 75px !important;">
                          <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                            <span class="c-RD-profile__title">اطلاعات حقوقی</span>
                          </div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="has_legal_info">دارای اطلاعات حقوقی:</label>
                              <div class="c-ui-input">
                                <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible" 
                                name="has_legal_info" data-value="legal" aria-hidden="true">
                                  <option value="active" {{ ($customer->legal()->exists())? 'selected' : '' }}>بله</option>
                                  <option value="inactive" {{ !($customer->legal()->exists())? 'selected' : '' }}>خیر</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="company_name">نام سازمان:</label>
                              <div class="c-ui-input">
                                <input type="text" name="company_name" class="c-ui-input__field c-ui-input__RD-field" 
                                value="{{ isset($customer->legal->company_name)? $customer->legal->company_name : '' }}" aria-invalid="false">
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="economic_number">کد اقتصادی:</label>
                              <div class="c-ui-input">
                                <input type="text" name="economic_number" class="c-ui-input__field c-ui-input__RD-field" 
                                value="{{ isset($customer->legal->economic_number)? $customer->legal->economic_number: '' }}" aria-invalid="false">
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="registration_number">شناسه ثبت:</label>
                              <div class="c-ui-input">
                                <input type="text" name="registration_number" class="c-ui-input__field c-ui-input__RD-field" 
                                value="{{ isset($customer->legal->registration_number)? $customer->legal->registration_number : '' }}" aria-invalid="false">
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="nationalـidentity">شناسه ملی:</label>
                              <div class="c-ui-input">
                                <input type="text" name="nationalـidentity" class="c-ui-input__field c-ui-input__RD-field" 
                                value="{{ isset($customer->legal->nationalـidentity)? $customer->legal->nationalـidentity : '' }}" aria-invalid="false">
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="company_phone">شماره تلفن ثابت:</label>
                              <div class="c-ui-input">
                                <input type="text" name="company_phone" class="c-ui-input__field c-ui-input__RD-field" 
                                value="{{ (isset($customer->legal->phone) && !is_null($customer->legal->phone))? 0 . $customer->legal->phone : '' }}" 
                                  aria-invalid="false">
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="state">استان محل دفتر مرکزی:</label>
                              <div class="c-ui-input">
                                <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible"
                                 name="state" data-value="legal" aria-hidden="true">
                                  <option value="">انتخاب استان</option>
                                  @foreach($states->where('type', 'state') as $state)
                                  <option value="{{ $state->id }}" {{ (isset($customer->legal->city_id) && !is_null($customer->legal->city_id) &&
                                     ($states->where('id', $customer->legal->city_id)->first()->state_id ) == $state->id)? 'selected' : ''  }}>
                                     {{ $state->name }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4 zone_section" data-value="legal">
                            <div class="c-form citySelect">
                              <label class="c-RD-profile__input-name " for="city">شهر محل دفتر مرکزی:</label>
                              <div class="c-ui-input">
                                <select class="c-ui-select c-ui-select--common c-ui-select--small
                                 c-RD-profile select2-hidden-accessible" name="city" data-value="legal" aria-hidden="true">
                                  <option value="">انتخاب شهر</option>
                                  @if( $customer->legal()->exists() && !is_null($customer->legal->city_id))
                                    @foreach($states->where('id', $customer->legal->city_id)->first()->parent->childs as $city)
                                      <option value="{{ $city->id }}" {{ ($customer->legal->city_id == $city->id)? 'selected' : '' }}>
                                        {{ $city->name }}
                                      </option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                          </div>


                        <div class="uk-flex uk-flex-column uk-width-1-1">
                          <div class="c-profile-business-info-logo-error o-spacing-m-t-6
                           o-spacing-m-b-2 uk-margin-remove-right" style="display: none;"></div>
                          <div class="c-profile-business-info-logo-error  uk-margin-remove-right o-spacing-m-b-2" style="display: none;"></div>
                        </div>

                        <div class="c-ui-form__row c-RD-profile__form-action js-profile-form-action" style="margin-right: auto">
                          <div class="c-RD-profile__cancel-btn uk-flex uk-flex-center
                           uk-flex-middle js-profile-cancel-edit-form">بازگشت</div>
                          <div class="c-RD-profile__approve-btn uk-flex uk-flex-center
                           uk-flex-middle uk-margin-small-right save_tab_form" data-value="general">ذخیره تغییرات</div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="c-RD-profile__dis-none " data-name="addresses" style="display: none;">
              <div class="c-grid__row c-RD-profile__mt-0" id="addresses">
                <div class="c-grid__col">
                  <div class="c-card c-RD-profile__bdrs-top-0 js-profile-content-spinner" 
                  style="box-shadow: 0 10px 12px 0 rgba(0, 0, 0, 0.05);">
                    <div class="c-card__header c-card__header--with-controls  uk-hidden"></div>
                    <div class="c-card__body c-card__body--form">
                      <div class="c-grid__row">

                        @if($customer->addresses()->exists())
                          @foreach($customer->addresses as $item)
                            <input type="hidden" name="address_id" value="{{ $item->id }}">
                            <div class="c-grid__row">
                              <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                                <span class="c-RD-profile__title">آدرس:</span>
                              </div>
                            </div>

                            <div class="c-grid__row">
                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4 zone_section" data-value="state-{{ $item->id }}">
                                <div class="c-form">
                                  <label class="c-RD-profile__input-name" for="state">استان:</label>
                                  <div class="c-ui-input">
                                    <select class="c-ui-select--common c-ui-select--small js-select-origin select2-hidden-accessible"
                                       name="state" data-name="state"  data-value="state-{{ $item->id }}" aria-hidden="true">
                                      <option value="">انتخاب استان</option>
                                      @foreach($states->where('type', 'state') as $state)
                                        @if($item->state->type == 'district')
                                          <option value="{{ $state->id }}" {{ ($item->state->parent->parent->id == $state->id)? 'selected' : '' }}>
                                            {{ $state->name }}
                                          </option>
                                        @else
                                          <option value="{{ $state->id }}" {{ ($item->state->parent->id == $state->id)? 'selected' : '' }}>
                                            {{ $state->name }}
                                          </option>
                                        @endif
                                      @endforeach

                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4 zone_section" data-value="state-{{ $item->id }}">
                                <div class="c-form citySelect">
                                  <label class="c-RD-profile__input-name " for="city">شهر:</label>
                                  <div class="c-ui-input">
                                    <select class="c-ui-select--common c-ui-select--small js-select-origin select2-hidden-accessible"
                                     name="city" data-id="{{ $item->id }}" data-name="city" data-value="" aria-hidden="true">
                                      <option value="">انتخاب شهر</option>
                                      @if($item->state->type == 'district')
                                        @foreach($item->state->parent->parent->childs->where('type', 'city') as $city)
                                          <option value="{{ $city->id }}" {{ ($item->state->parent->id == $city->id)? 'selected' : '' }}>
                                            {{ $city->name }}
                                          </option>
                                        @endforeach
                                      @elseif($item->state->type == 'city')
                                        @foreach($item->state->parent->childs->where('type', 'city') as $city)
                                          <option value="{{ $city->id }}" {{ ($item->state->id == $city->id)? 'selected' : '' }}>
                                            {{ $city->name }}
                                          </option>
                                        @endforeach
                                      @endif
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4 zone_section" data-value="state-{{ $item->id }}" >
                                <div class="c-form districtSelect">
                                  @if($item->state->type == 'district')
                                  <label class="c-RD-profile__input-name deletable_district" for="district">محله:</label>
                                  <div class="c-ui-input deletable_district">
                                    <select class="c-ui-select--common c-ui-select--small js-select-origin select2-hidden-accessible" name="district" data-id="{{ $item->id }}" data-name="district" data-value="customer_address" aria-hidden="true">
                                      <option value="">انتخاب محله</option>
                                      @foreach($item->state->parent->childs->where('type', 'district') as $district)
                                        <option value="{{ $district->id }}" {{ ($item->state_id == $district->id)? 'selected' : '' }}>
                                          {{ $district->name }}
                                        </option>
                                      @endforeach
                                    </select>
                                  </div>
                                  @endif
                                </div>
                              </div>
                            </div>

                            <div class="c-grid__row">
                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-12">
                                <div class="c-form">
                                  <label class="c-RD-profile__input-name" for="address">آدرس:</label>
                                  <div class="c-ui-input">
                                    <input type="text" name="address" class="c-ui-input__field c-ui-input__RD-field" 
                                    value="{{ $item->address }}" aria-invalid="false">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="c-grid__row">
                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                                <div class="c-form">
                                  <label class="c-RD-profile__input-name" for="plaque">پلاک:</label>
                                  <div class="c-ui-input">
                                    <input type="text" name="plaque" class="c-ui-input__field c-ui-input__RD-field" 
                                    value="{{ $item->plaque }}" aria-invalid="false">
                                  </div>
                                </div>
                              </div>

                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                                <div class="c-form">
                                  <label class="c-RD-profile__input-name" for="unit">واحد:</label>
                                  <div class="c-ui-input">
                                    <input type="text" name="unit" class="c-ui-input__field c-ui-input__RD-field" 
                                    value="{{ $item->unit }}"  aria-invalid="false">
                                  </div>
                                </div>
                              </div>

                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                                <div class="c-form">
                                  <label class="c-RD-profile__input-name" for="postal_code">کدپستی:</label>
                                  <div class="c-ui-input">
                                    <input type="text" name="postal_code" class="c-ui-input__field c-ui-input__RD-field" 
                                    value="{{ $item->postal_code }}" aria-invalid="false">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="c-grid__row">
                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                                <div class="c-form">
                                  <label class="c-RD-profile__input-name" for="lan">عرض جغرافیایی:</label>
                                  <div class="c-ui-input">
                                    <input type="text" name="lan" class="c-ui-input__field c-ui-input__RD-field" 
                                    value="{{ $item->lan }}" aria-invalid="false" disabled>
                                  </div>
                                </div>
                              </div>

                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                                <div class="c-form">
                                  <label class="c-RD-profile__input-name" for="len">طول جغرافیایی:</label>
                                  <div class="c-ui-input">
                                    <input type="text" name="len" class="c-ui-input__field c-ui-input__RD-field"
                                     value="{{ $item->len }}" aria-invalid="false" disabled>
                                  </div>
                                </div>
                              </div>

                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                                <div class="c-form">
                                  <label class="c-RD-profile__input-name" for="recipient_status">گیرنده:</label>
                                  <div class="field-wrapper field-wrapper--justify field-wrapper--background"
                                   style="border-radius: 8px;background-color: #f5f7fa;padding-left: 15px;padding-right: 15px;min-height: 40px;">
                                    <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto">
                                      <input type="checkbox" class="c-ui-checkbox__origin" name="recipient_status"
                                       {{ (!is_null($item->is_recipient_self) && ($item->is_recipient_self == true))? 'checked' : '' }}>
                                      <span class="c-ui-checkbox__check"></span>
                                      <span class="c-ui-checkbox__label">گیرنده سفارش خود مشتری می‌باشد</span>
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="c-grid__row">
                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                                <div class="c-form">
                                  <label class="c-RD-profile__input-name" for="recipient_firstname">نام گیرنده:</label>
                                  <div class="c-ui-input">
                                    <input type="text" name="recipient_firstname" class="c-ui-input__field c-ui-input__RD-field"
                                     value="{{ $item->recipient_firstname }}" aria-invalid="false">
                                  </div>
                                </div>
                              </div>

                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                                <div class="c-form">
                                  <label class="c-RD-profile__input-name" for="unit">نام خانوادگی گیرنده:</label>
                                  <div class="c-ui-input">
                                    <input type="text" name="recipient_lastname" class="c-ui-input__field c-ui-input__RD-field" 
                                    value="{{ $item->recipient_lastname }}"  aria-invalid="false">
                                  </div>
                                </div>
                              </div>

                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                                <div class="c-form">
                                  <label class="c-RD-profile__input-name" for="recipient_national_code">کد ملی گیرنده:</label>
                                  <div class="c-ui-input">
                                    <input type="text" name="recipient_national_code" class="c-ui-input__field c-ui-input__RD-field"
                                     value="{{ $item->recipient_national_code }}" aria-invalid="false">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="c-grid__row" style="margin-bottom: 40px !important;">
                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                                <div class="c-form">
                                  <label class="c-RD-profile__input-name" for="recipient_mobile">تلفن همراه گیرنده:</label>
                                  <div class="c-ui-input">
                                    <input type="text" name="recipient_mobile" class="c-ui-input__field c-ui-input__RD-field"
                                     value="{{ $item->recipient_mobile }}" aria-invalid="false">
                                  </div>
                                </div>
                              </div>
                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                            </div>
                          @endforeach
                        @endif

                        <div class="uk-flex uk-flex-column uk-width-1-1">
                          <div class="c-profile-business-info-logo-error o-spacing-m-t-6 o-spacing-m-b-2 uk-margin-remove-right"
                           style="display: none;"></div>
                          <div class="c-profile-business-info-logo-error  uk-margin-remove-right o-spacing-m-b-2" style="display: none;"></div>
                        </div>

                        <div class="c-ui-form__row c-RD-profile__form-action js-profile-form-action" style="margin-right: auto">
                          <div class="c-RD-profile__cancel-btn uk-flex uk-flex-center uk-flex-middle js-profile-cancel-edit-form">بازگشت</div>
                          <div class="c-RD-profile__approve-btn uk-flex uk-flex-center uk-flex-middle uk-margin-small-right save_tab_form" 
                          data-value="addresses">ذخیره تغییرات</div>
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
    </form>
      </div>
    </div>
  </div>
</main>
@endsection
@section('script')
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function initUiSelect() {
  $('.js-select-origin').each(function () {
    const $this = $(this);
    const isMultiSelect = $this.attr('multiple');
    const $placeholder = $this.attr('data-placeholder') || '';
    const inProductStep = $this.hasClass('js-in-product');

    $this.select2({
      placeholder: $placeholder,
      closeOnSelect: !isMultiSelect,
      allowClear: (isMultiSelect && inProductStep),
      sorter: function (data) {
        return data.sort(function (a, b) {
          a = $(a).prop('selected');
          b = $(b).prop('selected');
          return b - a;
        });
      }
    }).on('select2:opening', function () {
      $('body').addClass('ui-select');
    }).on('select2:select', function () {
      let $sortedOptions = $('li.select2-results__option').sort(function (a, b) {
        return ($(b).attr('aria-selected') === 'true') - ($(a).attr('aria-selected') === 'true');
      });
      $('.select2-results__options').prepend($sortedOptions);
    }).on('select2:unselect', function () {
      let $sortedOptions = $('li.select2-results__option').sort(function (a, b) {
        return ($(b).attr('aria-selected') === 'true') - ($(a).attr('aria-selected') === 'true');
      });
      $('.select2-results__options').prepend($sortedOptions);
    }).on('change', function () {
      if (isMultiSelect && inProductStep) {
        let $selectionsContainerWidth = $this.siblings('.select2-container').find('ul.select2-selection__rendered').width() - 77;
        const $selections = $this.siblings('.select2-container').find('li.select2-selection__choice');

        $selections.removeClass('hidden');
        $selections.each(function () {
          $selectionsContainerWidth -= $(this).outerWidth(true);
          if ($selectionsContainerWidth < 0) {
            $(this).addClass('hidden');
          }
        });

        let $selectionsCount = $this.siblings('.select2-container').find('li.select2-selection__choice.hidden').length;
        let $counter = $this.siblings('.select-counter');

        if ($selectionsCount > 0) {
          $counter.css('display', 'flex');
        } else {
          $counter.css('display', 'none');
        }
        $counter.text($selectionsCount.toLocaleString('fa-IR'));
      }
      $(this).trigger('blur');
    }).on('select2:close', function () {
      $(this).valid();
      $('body').removeClass('ui-select');
    });

    if (isMultiSelect && inProductStep) {
      let $selectionsContainerWidth = $this.siblings('.select2-container').find('ul.select2-selection__rendered').width() - 77;
      const $selections = $this.siblings('.select2-container').find('li.select2-selection__choice');

      $selections.removeClass('hidden');
      $selections.each(function () {
        $selectionsContainerWidth -= $(this).outerWidth(true);
        if ($selectionsContainerWidth < 0) {
          $(this).addClass('hidden');
        }
      });

      let $counter = $this.siblings('.select-counter');
      let $selectionsCount = $this.siblings('.select2-container').find('li.select2-selection__choice.hidden').length;

      if ($selectionsCount > 0) {
        $counter.text($selectionsCount.toLocaleString('fa-IR'));
        $counter.css('display', 'flex');
      }
    }

  });
}

function displayError(errors) {
  var message = '';
  if (typeof errors === typeof  "") {
    message = errors;
  } else if (typeof errors === typeof {}) {
    try {
      message = Object.values(errors).join('<br/>');
    } catch (e) {
      message = errors;
    }
  }
  UIkit.notification({
    message: message,
    status: 'danger',
    pos: 'bottom-right',
    timeout: 8000
  });
}

$(document).on('change', "select[name=state]", function (){
  var zone_type = $(this).data('value');
  $.ajax({
    method:'post',
    url: '{{ route('staff.customers.cities') }}',
    data: {
      state_id: $(this).val(),
      type: $(this).data('id'),
    },
    success: function (response) {
      $(".zone_section[data-value=" + zone_type + "]").find(".citySelect").replaceWith(response);
      initUiSelect();

      $(".zone_section[data-value=" + zone_type + "]").find(".deletable_district").each(function (){
        $(this).remove();
      });
    }
  });
});

$(document).on('change', "select[name=city]", function (){
  var zone_type = $(this).closest('.zone_section').data('value');

  $(".zone_section[data-value=" + zone_type + "]").find(".deletable_district").each(function (){
    $(this).remove();
  });

  $.ajax({
    method:'post',
    url: '{{ route('staff.customers.district') }}',
    data: {
      city_id: $(this).val(),
      type: $(this).data('id'),

    },
    success: function (response) {
      $(".zone_section[data-value=" + zone_type + "]").find(".districtSelect").replaceWith(response);

      initUiSelect();
    }
  });
});

$(document).on('click', '.save_tab_form', function (){
  if ($('input[name=recipient_status]').is(":checked")) {
    var recipient_status = 1;
  } else {
    var recipient_status = 0;
  }

  var formData = {
      // general tab
      active_tab : $(this).data('value'),
      customer_id : '{{ $customer->id }}',
      status : $('select[name=status]').val(),
      first_name : $('input[name=first_name]').val(),
      last_name : $('input[name=last_name]').val(),
      birthdate : $('input[name=birthdate]').val(),
      national_code : $('input[name=national_code]').val(),
      mobile : $('input[name=mobile]').val(),
      email : $('input[name=email]').val(),
      bank_card_number : $('input[name=bank_card_number]').val(),

      has_legal_info : $('select[name=has_legal_info]').val(),
      company_name : $('input[name=company_name]').val(),
      economic_number : $('input[name=economic_number]').val(),
      registration_number : $('input[name=registration_number]').val(),
      nationalـidentity : $('input[name=nationalـidentity]').val(),
      phone : $('input[name=company_phone]').val(),
      city : $('select[name=city]').val(),

      // address tab
      address_id : $("input[name='address_id']").map(function(){return $(this).val();}).get(),
      address_state_id : $("select[data-name=state]").map(function(){return $(this).val();}).get(),
      address_city_id : $("select[data-name=city]").map(function(){return $(this).val();}).get(),
      address_district_id : $("select[data-name=district]").map(function(){return $(this).val();}).get(),
      address_district_refrence : $("select[data-name=district]").map(function(){return $(this).data('id');}).get(),

      address : $("input[name=address]").map(function(){return $(this).val();}).get(),
      plaque : $("input[name=plaque]").map(function(){return $(this).val();}).get(),
      unit : $("input[name=unit]").map(function(){return $(this).val();}).get(),
      postal_code : $("input[name=postal_code]").map(function(){return $(this).val();}).get(),
      recipient_status : recipient_status,
      recipient_firstname : $("input[name=recipient_firstname]").map(function(){return $(this).val();}).get(),
      recipient_lastname : $("input[name=recipient_lastname]").map(function(){return $(this).val();}).get(),
      recipient_national_code : $("input[name=recipient_national_code]").map(function(){return $(this).val();}).get(),
      recipient_mobile : $("input[name=recipient_mobile]").map(function(){return $(this).val();}).get(),
  }

  $.ajax({
    method:'post',
    url: '{{ route('staff.customers.update') }}',
    data: formData,
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
      displayError(errors.responseJSON.data.errors);
    },
  });

});

var input = document.querySelector('input[name=index_meta_keywords]');
var tagify = new Tagify(input, {
  originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
});

$(document).on('click',".new-address-btn", function (){
  var address_row = `
  <div class="address-row" style="margin-top: 20px">
    <div style="float: right;width: 94.2%;">
      <input type="text" name="shop_address" class="c-ui-input__field c-ui-input__RD-field">
      </div>
      <div class="c-ui-form__col c-ui-form__col--wrap-xs c-ui-form__col--pull-left uk-margin-remove-right"
      style="display: inline-block;margin-left: 0px !important;padding-left: 0px !important;">
      <div class="c-RD-profile__delete-warehouse c-RD-profile__delete-warehouse--danger delete-addreess" data-id="new" style="padding: 9px;">
      </div>
    </div>
   </div>
  `;

  $(".address-section").append(address_row);
});

$(document).on('click', '.delete-addreess', function (){
  if ($(this).closest('.address-row').data('id') !== 'new')
  {
    var deleted_id = $(this).attr('data-id');
    var deleted_row = '<input name="deleted_address" value="' + deleted_id + '" hidden>';
    $('.c-main').append(deleted_row);
  }
  $(this).closest('.address-row').remove();
});

$(document).on('click', '.c-profile-nav--menu-links', function (){
    var selected_menu = $(this).data('content');

    var active_tab = $(".c-RD-profile__selected-nav").closest('li').data('content');
    $(".c-RD-profile__selected-nav").closest('li').find('.c-RD-profile__menu-text').first().attr('style', 'color: rgb(161, 163, 168) !important;');
    $(".c-RD-profile__selected-nav").remove();

    var change_nav_lable = '<div class="c-RD-profile__selected-nav" style="display: block;">&nbsp;</div>';
    $(this).append(change_nav_lable);
    $(this).find('.c-RD-profile__menu-text').attr('style', 'color: rgb(98, 102, 109) !important;');

    $(".c-RD-profile__dis-none[data-name='" + active_tab + "']").css('display', 'none');
    $(".c-RD-profile__dis-none[data-name='" + selected_menu + "']").css('display', 'block');

    $("body").scrollTop(0);

    initSelect();
    initUiSelect();

});

$(document).on('change', 'input[name=inـpersonـdelivery]', function (){
  if($(this).is(':checked')) {
    $('.new-address-btn').show();
    $('.shop_address').show();
  } else {
    $('.new-address-btn').hide();
    $('.shop_address').hide();
  }
});

function initSelect() {
  /** @var cities */
  const citiesArray = window.cities;
  const $inputs = $('.c-ui-select');

  $inputs.each(function () {
    const $input = $(this);
    const inputPlaceholder = $input.attr('placeholder');
    const hasSearch = $input.hasClass('c-ui-select--search');

    $input
      .select2({
        placeholder: inputPlaceholder,
        minimumResultsForSearch: hasSearch ? 0 : Infinity,
        language: Services.selectSearchLanguage,
      })
      .data('select2')
      .$dropdown.addClass('c-ui-select__dropdown');

    $input.on('change', function () {
      $(this).valid();
    });
  });

  const $citySelect = $('#city-id');
  const $stateSelect = $('#state-id');
  const $cityCode = $('input[name="register[city_code]"]');

  if (!isModuleActive('marketplace_seller_registration_address')) {
    checkTehranForWarehouse($citySelect);

    $citySelect.on('change', function () {
      checkTehranForWarehouse($citySelect);
    });
  }

  if ($stateSelect.val() !== '') {
    const selectedValue = $stateSelect.val();
    const citySelected = $citySelect.val();

    if (citiesArray[selectedValue]) {
      $citySelect
        .html('')
        .select2({
          placeholder: $stateSelect.attr('placeholder'),
        })
        .data('select2')
        .$dropdown.addClass('c-ui-select__dropdown');
      $.each(citiesArray[selectedValue], function (index, city) {
        if (parseInt(citySelected) === parseInt(city.id)) {
          $citySelect.append('<option value="' + city.id + '" selected>' + city.label + '</option>');
        } else {
          $citySelect.append('<option value="' + city.id + '">' + city.label + '</option>');
        }
      });
      $citySelect.trigger('change');
      $cityCode.val(Services.convertToFaDigit($stateSelect.find(':selected').data('code')));
    }
  }

  $stateSelect.on('change', function () {
    const $select = $(this);
    const $value = $select.val();
    const placeholder = $stateSelect.attr('placeholder');

    if ($value === '') {
      $citySelect
        .select2({
          placeholder: placeholder,
        })
        .data('select2')
        .$dropdown.addClass('c-ui-select__dropdown');
      $citySelect.prop('disabled', true);
    } else if (citiesArray[$value]) {
      $citySelect
        .html('')
        .select2({
          placeholder: placeholder,
        })
        .data('select2')
        .$dropdown.addClass('c-ui-select__dropdown');

      $citySelect.append('<option></option>');
      $.each(citiesArray[$value], function fillOptions(index, city)
      {
        $citySelect.append('<option value="' + city.id + '">' + city.label + '</option>');
      });
      $cityCode.val(Services.convertToFaDigit($select.find(':selected').data('code')));
    }

    if (!isModuleActive('marketplace_seller_registration_address')) {
      checkTehranForWarehouse($citySelect);
    }
  });

  function checkTehranForWarehouse($select)
  {
    if ($select.val() !== '1698') {
      makeWarehouseDetailsVisible();
    }

    function makeWarehouseDetailsVisible()
    {
      const $warehouseDetailsControl = $('[name="register[has_warehouse_address]"][value="1"]');

      $warehouseDetailsControl.prop('checked', true);
      $warehouseDetailsControl.trigger('change');
    }
  }
}

initSelect();

</script>
@endsection

