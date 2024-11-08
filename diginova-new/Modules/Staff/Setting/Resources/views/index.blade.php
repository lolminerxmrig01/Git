@extends('layouts.staff.master')
@section('title') تنظیمات | {{ $fa_store_name }}  @endsection
@section('head')

<link rel="stylesheet" href="{{ asset('mehdi/staff/css/tagify.css') }}">
<script src="{{ asset('mehdi/staff/js/inputmask.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/jQuery.tagify.min.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/tagify.min.js') }}"></script>

<style>
  tags {
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
                    <nav class="uk-navbar-container uk-navbar-transparent c-RD-profile--h-70 c-profile-responsive-navbar uk-navbar" uk-navbar="" style="border-bottom: 1px solid #e6e9ed;margin-bottom: 15px; height: 57px">
                      <div class="uk-navbar-left">
                        <ul class="uk-navbar-nav">
                          <li class="c-profile-nav--menu-links js-profile-navbar uk-flex uk-flex-column" data-content="general" style="padding-top: 5px; padding-bottom: 5px; pointer-events: all;">
                            <a class="c-RD-profile__menu-text" href="#general" style="color: rgb(98, 102, 109) !important;">عمومی</a>
                            <div class="c-RD-profile__selected-nav" style="display: block;">&nbsp;</div>
                          </li>

                          <li class="c-profile-nav--menu-links js-profile-navbar uk-flex uk-flex-column" data-content="store" style="padding-top: 5px; padding-bottom: 5px; pointer-events: all;">
                            <a class="c-RD-profile__menu-text" href="#store" style=" color: rgb(161, 163, 168) !important;">فروشگاه</a>
                            <div class="c-RD-profile__selected-nav" style="display: none;">&nbsp;</div>
                          </li>

                          <li class="c-profile-nav--menu-links js-profile-navbar uk-flex uk-flex-column" data-content="footer" style="padding-top: 5px; padding-bottom: 5px; pointer-events: all;">
                            <a class="c-RD-profile__menu-text" href="#footer" style="color: rgb(161, 163, 168) !important;">پابرگ</a>
                            <div class="c-RD-profile__selected-nav" style="display: none;">&nbsp;</div>
                          </li>

                          <li class="c-profile-nav--menu-links js-profile-navbar uk-flex uk-flex-column" data-content="sms" style="padding-top: 5px; padding-bottom: 5px; pointer-events: all;">
                            <a class="c-RD-profile__menu-text" href="#sms" style="color: rgb(161, 163, 168) !important;">سامانه پیامکی</a>
                            <div class="c-RD-profile__selected-nav" style="display: none;">&nbsp;</div>
                          </li>

                          <li class="c-profile-nav--menu-links js-profile-navbar uk-flex uk-flex-column" data-content="email" style="padding-top: 5px; padding-bottom: 5px; pointer-events: all;">
                            <a class="c-RD-profile__menu-text" href="#email" style="color: rgb(161, 163, 168) !important;">ایمیل</a>
                            <div class="c-RD-profile__selected-nav" style="display: none;">&nbsp;</div>
                          </li>

                          <li class="c-profile-nav--menu-links js-profile-navbar uk-flex uk-flex-column" data-content="peyment" style="padding-top: 5px; padding-bottom: 5px; pointer-events: all;">
                            <a class="c-RD-profile__menu-text" href="#peyment" style="color: rgb(161, 163, 168) !important;">پرداخت</a>
                            <div class="c-RD-profile__selected-nav" style="display: none;">&nbsp;</div>
                          </li>

                          <li class="c-profile-nav--menu-links js-profile-navbar uk-flex uk-flex-column" data-content="invoice" style="padding-top: 5px; padding-bottom: 5px; pointer-events: all;">
                            <a class="c-RD-profile__menu-text" href="#invoice" style="color: rgb(161, 163, 168) !important;">فاکتور</a>
                            <div class="c-RD-profile__selected-nav" style="display: none;">&nbsp;</div>
                          </li>

                          <li class="c-profile-nav--menu-links js-profile-navbar uk-flex uk-flex-column" data-content="advanced" style="padding-top: 5px; padding-bottom: 5px; pointer-events: all;">
                            <a class="c-RD-profile__menu-text" href="#advanced" style="color: rgb(161, 163, 168) !important;">پیشرفته</a>
                            <div class="c-RD-profile__selected-nav" style="display: none;">&nbsp;</div>
                          </li>

                          <li class="c-profile-nav--menu-links js-profile-navbar uk-flex uk-flex-column" data-content="license" style="padding-top: 5px; padding-bottom: 5px; pointer-events: all;">
                            <a class="c-RD-profile__menu-text" href="#license" style="color: rgb(161, 163, 168) !important;">لایسنس</a>
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
                            <span class="c-RD-profile__title">اطلاعات سایت</span>
                          </div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="fa_store_name">نام فارسی فروشگاه:</label>
                              <div class="c-ui-input ">
                                <input type="text" name="fa_store_name" class="c-ui-input__field c-ui-input__RD-field" value="{{ $settings->where('name', 'fa_store_name')->first()->value }}">
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                                <label class="c-RD-profile__input-name" for="en_store_name">نام انگلیسی فروشگاه:</label>
                                <div class="c-ui-input ">
                                  <input type="text" name="en_store_name" value="{{ $settings->where('name', 'en_store_name')->first()->value }}"
                                   class="c-ui-input__field c-ui-input__RD-field" spellcheck="false">
                                </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                                <label class="c-RD-profile__input-name" for="site_url">آدرس سایت:</label>
                                <div class="c-ui-input ">
                                  <input type="text" name="site_url" value="{{ $settings->where('name', 'site_url')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                                </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                                <label class="c-RD-profile__input-name" for="admin_email">ایمیل مدیریت:</label>
                                <div class="c-ui-input ">
                                  <input type="text" name="admin_email" value="{{ $settings->where('name', 'admin_email')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                                </div>
                            </div>
                            <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                                <label class="c-RD-profile__input-name" for="management_subdomain">زیر دامنه مدیریت:</label>
                                <div class="c-ui-input ">
                                  <input type="text" name="management_subdomain" class="c-ui-input__field c-ui-input__RD-field" value="{{ $settings->where('name', 'management_subdomain')->first()->value }}" disabled>
                                </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="site_index_status">نمایش سایت در موتورهای جستجو:</label>
                              <div class="field-wrapper field-wrapper--justify field-wrapper--background" style="border-radius: 8px;background-color: #f5f7fa;padding-left: 15px;padding-right: 15px;min-height: 40px;">
                                <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto">
                                  <input type="checkbox" class="c-ui-checkbox__origin" name="site_index_status" {{ ($settings->where('name', 'site_index_status')->first()->value == 'true')? 'checked' : '' }}>
                                  <span class="c-ui-checkbox__check"></span>
                                  <span class="c-ui-checkbox__label">از موتورهای جستجو درخواست کن تا محتوای سایت را بررسی نکنند</span>
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                                <label class="c-RD-profile__input-name" for="site_title">عنوان سایت:</label>
                                <div class="c-ui-input ">
                                  <input type="text" name="site_title" value="{{ $settings->where('name', 'site_title')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                                </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                                <label class="c-RD-profile__input-name" for="index_meta_description">متاتگ توضیحات: (meta description)</label>
                                <div class="c-ui-input">
                                  <textarea name="index_meta_description" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--textarea" rows="4" style="border-color: #dddddd; font-weight: bold;">{{ $settings->where('name', 'index_meta_description')->first()->value }}</textarea>
                                </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                                <label class="c-RD-profile__input-name" for="index_meta_keywords">کلمات کلیدی: (meta keywords)</label>
                                <div class="c-ui-input">
                                  <input class="form-control tagify" name="index_meta_keywords" value="{{ $settings->where('name', 'index_meta_keywords')->first()->value }}" style="background: white !important; border-color:#e6e9ed!important; width: 100% !important;">
                                </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row uk-margin-medium-top" style="background-color: #f5f7fa; padding: 20px; border-radius: 8px; margin-top: 20px !important;">
                          <div class="o-spacing-m-r-3" style="padding-right: 10px;">
                            <div class="field-wrapper">
                              <div id="logoUpload" class="c-content-modal__uploads-label {{ is_null($header_logo)? 'empty' : '' }}">
                              <span uk-form-custom="" class="uk-form-custom">
                                  <input id="brandLogoFile" name="upload_logo" type="file" class="hidden">
                              </span>
                                <label for="brandLogoFile" class="c-content-modal__uploads-preview" style="border: 1px solid #e0e0e2; background-color: white;">
                                  <img src="{{ (!is_null($header_logo)? $site_url . '/' .  $header_logo->path . '/' . $header_logo->name : '') }}" id="logoUploadPreview" class="c-content-modal__uploads-img" alt="" style="width: 100% !important; height: 100%;">
                                  <span class="c-content-upload__img-loader js-img-loader">
                                  <span class="progress__wrapper">
                                      <span class="progress"></span>
                                  </span>
                                </span>
                                  @if(!$settings->where('name', 'header_logo')->first()->media()->exists())
                                    <label class="c-RD-profile__upload-btn" id="logoUploadLable">
                                      <input id="brandLogoFile" type="file" class="hidden">
                                    </label>
                                  @endif
                                </label>
                              </div>
                              <input type="hidden" name="logoImageTempId" id="logoImageTempId">
                              <div class="c-content-modal__errors-full" id="logoUploadErrors"></div>
                            </div>
                          </div>
                          <div class="o-spacing-m-r-3" style="padding-right: 20px;padding-top: 15px;">
                            <span style="display: block;">لوگو سایت</span>
                            <span style="display: inline-block;font-size: 12px;margin-top: 7px;">اندازه استاندارد: 110x30px</span>
                            <span style="display: inline-block;font-size: 12px;margin-top: 7px;margin-right: 20px;">فرمت استاندارد: png, svg, jpeg, jpg</span>
                          </div>
                        </div>

                        <div class="c-grid__row uk-margin-medium-top" style="background-color: #f5f7fa; padding: 20px; border-radius: 8px; margin-top: 20px !important;">
                          <div class="o-spacing-m-r-3" style="padding-right: 10px;">
                            <div class="field-wrapper">
                              <div id="faviconUpload" class="c-content-modal__uploads-label {{ is_null($favicon_image)? 'empty' : '' }}">
                                <span uk-form-custom="" class="uk-form-custom">
                                    <input id="brandfaviconFile" name="upload_favicon" type="file" class="hidden">
                                </span>

                                <label for="brandfaviconFile" class="c-content-modal__uploads-preview" style="border: 1px solid #e0e0e2; background-color: white;">
                                  <img src="{{ (!is_null($favicon_image)? $site_url . '/' .  $favicon_image->path . '/' . $favicon_image->name : '') }}" id="faviconUploadPreview" class="c-content-modal__uploads-img" alt="" style="width: 100% !important; height: 100%;">

                                  <span class="c-content-upload__img-loader js-img-loader">
                                      <span class="progress__wrapper">
                                        <span class="progress"></span>
                                      </span>
                                  </span>
                                  @if(!$settings->where('name', 'header_logo')->first()->media()->exists())
                                    <label class="c-RD-profile__upload-btn" id="faviconUploadLable">
                                      <input id="brandfaviconFile" type="file" class="hidden">
                                    </label>
                                  @endif
                                </label>
                              </div>
                              <input type="hidden" name="faviconImageTempId" id="faviconImageTempId">
                              <div class="c-content-modal__errors-full" id="faviconUploadErrors"></div>
                            </div>
                          </div>
                          <div class="o-spacing-m-r-3" style="padding-right: 20px;padding-top: 15px;">
                            <span style="display: block;">فاوآیکون</span>
                            <span style="display: inline-block;font-size: 12px;margin-top: 7px;">اندازه استاندارد: 96x96px</span>
                            <span style="display: inline-block;font-size: 12px;margin-top: 7px;margin-right: 20px;">فرمت استاندارد: png, svg, jpeg, jpg</span>
                          </div>
                        </div>

                        <div class="c-grid__row uk-margin-medium-top" style="background-color: #f5f7fa; padding: 20px; border-radius: 8px; margin-top: 20px !important;">
                          <div class="o-spacing-m-r-3" style="padding-right: 10px;">
                            <div class="field-wrapper">
                              <div id="symbolUpload" class="c-content-modal__uploads-label {{ is_null($symbol_image)? 'empty' : '' }}">
                                <span uk-form-custom="" class="uk-form-custom">
                                    <input id="brandsymbolFile" name="upload_symbol" type="file" class="hidden">
                                </span>

                                <label for="brandsymbolFile" class="c-content-modal__uploads-preview" style="border: 1px solid #e0e0e2; background-color: white;">
                                  <img src="{{ $site_url . '/' . (!is_null($symbol_image)? $symbol_image->path . '/' . $symbol_image->name : '') }}" id="symbolUploadPreview" class="c-content-modal__uploads-img" alt="" style="width: 100% !important; height: 100%;">
                                  <span class="c-content-upload__img-loader js-img-loader">
                                    <span class="progress__wrapper">
                                        <span class="progress"></span>
                                    </span>
                                  </span>
                                  @if(!$settings->where('name', 'symbol_image')->first()->media()->exists())
                                    <label class="c-RD-profile__upload-btn" id="symbolUploadLable">
                                      <input id="brandsymbolFile" type="file" class="hidden">
                                    </label>
                                  @endif
                                </label>
                              </div>
                              <input type="hidden" name="symbolImageTempId" id="symbolImageTempId">
                              <div class="c-content-modal__errors-full" id="symbolUploadErrors"></div>
                            </div>
                          </div>
                          <div class="o-spacing-m-r-3" style="padding-right: 20px;padding-top: 15px;">
                            <span style="display: block;">نماد فروشگاه در صفحه محصول</span>
                            <span style="display: inline-block;font-size: 12px;margin-top: 7px;">اندازه استاندارد: 24x24px</span>
                              <span style="display: inline-block;font-size: 12px;margin-top: 7px;margin-right: 20px;">فرمت استاندارد: png, svg, jpeg, jpg</span>
                          </div>
                        </div>


                        <div class="uk-flex uk-flex-column uk-width-1-1">
                          <div class="c-profile-business-info-logo-error o-spacing-m-t-6 o-spacing-m-b-2 uk-margin-remove-right" style="display: none;"></div>
                          <div class="c-profile-business-info-logo-error  uk-margin-remove-right o-spacing-m-b-2" style="display: none;"></div>
                        </div>

                        <div class="c-ui-form__row c-RD-profile__form-action js-profile-form-action" style="margin-right: auto">
                          <div class="c-RD-profile__cancel-btn uk-flex uk-flex-center uk-flex-middle js-profile-cancel-edit-form">بازگشت</div>
                          <div class="c-RD-profile__approve-btn uk-flex uk-flex-center uk-flex-middle uk-margin-small-right save_tab_form" data-value="general">ذخیره تغییرات</div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="c-RD-profile__dis-none " data-name="store" style="display: none;">
              <div class="c-grid__row c-RD-profile__mt-0" id="store">
                <div class="c-grid__col">
                  <div class="c-card c-RD-profile__bdrs-top-0 js-profile-content-spinner" style="box-shadow: 0 10px 12px 0 rgba(0, 0, 0, 0.05);">
                    <div class="c-card__header c-card__header--with-controls business_info  uk-hidden"></div>
                    <div class="c-card__body c-card__body--form">

                      <div class="c-grid__row">
                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                            <span class="c-RD-profile__title">اطلاعات فروشگاه</span>
                          </div>
                          <div class="c-RD-profile__action-btn c-RD-profile__action-btn--cancel js-profile-cancel-edit-form uk-hidden"></div>
                        </div>
                      </div>


                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="development_mode">حالت توسعه:</label>
                            <div class="field-wrapper field-wrapper--justify field-wrapper--background" style="border-radius: 8px;background-color: #f5f7fa;padding-left: 15px;padding-right: 15px;min-height: 40px;">
                              <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto">
                                <input type="checkbox" class="c-ui-checkbox__origin" name="development_mode" value="1"
                                  {{ ($settings->where('name', 'development_mode')->first()->value == 'true')? 'checked' : '' }}
                                  disabled>
                                <span class="c-ui-checkbox__check"></span>
                                <span class="c-ui-checkbox__label">
                                  در صورت انتخاب امکان فروش در سایت غیرفعال خواهد شد و تنها امکان بازدید وجود خواهد داشت
                                </span>
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="auto_navigateـtoـcart">هدایت به سبد خرید بعد از افزودن کالا:</label>
                              <div class="c-ui-input ">
                                <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible"
                                        name="auto_navigateـtoـcart" data-active="false" aria-hidden="true" disabled>
                                  <option value="true" {{ ($settings->where('name', 'auto_navigateـtoـcart')->first()->value == 'true')? 'selected' : '' }}>فعال</option>
                                  <option value="false" {{ ($settings->where('name', 'auto_navigateـtoـcart')->first()->value == 'false')? 'selected' : '' }}>غیرفعال</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="product_code_prefix">
                              پیشوند کد محصول:
                            </label>
                            <div class="c-ui-input ">
                              <input type="text" value="{{ $settings->where('name', 'product_code_prefix')->first()->value }}" name="product_code_prefix" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="product_title_prefix">
                              پیشوند عنوان محصول:
                            </label>
                            <div class="c-ui-input ">
                              <input type="text" value="{{ $settings->where('name', 'product_title_prefix')->first()->value }}" name="product_title_prefix" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="max_add_to_cart_num">
                              حداکثر تعداد قابل افزودن به سبد خرید: (برای نامحدود شدن فیلد را خالی رها کنید)
                            </label>
                            <div class="c-ui-input ">
                              <input type="number" value="{{ $settings->where('name', 'max_add_to_cart_num')->first()->value }}" name="max_add_to_cart_num" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="max_shipping_day_count">حداکثر زمان ارسال کالا:</label>
                            <div class="c-ui-input ">
                              <label class="c-content-input">
                                <input type="number" name="max_shipping_day_count" value="{{ $settings->where('name', 'max_shipping_day_count')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                                <span class="c-content-input__text c-content-input__text--overlay" style="left: 0 !important;right: unset !important;">روز</span>
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="products_per_page_count">تعداد محصولات در هر صفحه:</label>
                            <div class="c-ui-input ">
                              <input type="number" name="products_per_page_count" value="{{ $settings->where('name', 'products_per_page_count')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>
                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                              <label class="c-RD-profile__input-name" for="store_city">
                                محل فروشگاه: (برای محاسبه هزینه ارسال کالا)
                              </label>
                              <div class="c-ui-input ">
                                <select name="store_city" class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile js-profile-contact-city-select select2-hidden-accessible" aria-hidden="true">
                                  <option value=""> انتخاب کنید </option>
                                  @foreach($states->where('type', 'state') as $state)
                                    <option value="{{ $state->id }}" {{ ($settings->where('name', 'store_city')->first()->states()->exists() && $settings->where('name', 'store_city')->first()->states()->first()->id == $state->id)? 'selected' : '' }}> {{ $state->name }} </option>
                                  @endforeach
                                </select>
                              </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>


                      <div class="c-grid__row" style="margin-top: 75px !important;">
                      <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                        <span class="c-RD-profile__title">تحویل حضوری فروشگاه</span>
                      </div>
                      <div class="c-RD-profile__action-btn c-RD-profile__action-btn--cancel uk-hidden"></div>
                    </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-12">
                          <label class="c-RD-profile__input-name" for="inـpersonـdelivery" style="width: 100%">فعال / غیرفعال کردن تحویل حضوری کالا:</label>
                          <div class="field-wrapper field-wrapper--justify field-wrapper--background"
                               style="border-radius: 8px;background-color: #f5f7fa;padding-left: 15px;padding-right: 15px;min-height: 40px;width: 46%;">
                            <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto">
                              <input type="checkbox" class="c-ui-checkbox__origin" name="inـpersonـdelivery" value="1"
                                {{ ($settings->where('name', 'inـpersonـdelivery')->first()->value == 'true')? 'checked' : '' }}>
                              <span class="c-ui-checkbox__check"></span>
                              <span class="c-ui-checkbox__label">
                                در صورت انتخاب امکان تحویل حضوری کالا در آدرس های تعیین شده  وجود خواهد داشت
                              </span>
                            </label>
                          </div>
                          <a class="c-RD-profile__action-btn c-RD-profile__action-btn--outline c-RD-profile__action-btn--add c-RD-profile__asfe new-address-btn" style="margin-right: 28px; {{ ($settings->where('name', 'inـpersonـdelivery')->first()->value !== 'true')? 'display:none;' : '' }}">آدرس جدید</a>
                        </div>
                      </div>

                      <div class="c-grid__row shop_address" style="{{ ($settings->where('name', 'inـpersonـdelivery')->first()->value !== 'true')? 'display:none;' : '' }}">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-9">
                          <div class="c-form address-section" >
                            <label class="c-RD-profile__input-name" for="shop_address" style="display: block;margin-top: 30px !important; font-weight: bold; font-size: 13px !important; ">آدرس فروشگاه:</label>


                            @if(count($store_addresses))
                              @foreach($store_addresses as $store_address)
                                <div class="address-row" style="margin-top: 20px">
                                  <div style="float: right;width: 94.2%;">
                                    <input type="text" name="shop_address" value="{{ $store_address->address }}" data-id="{{ $store_address->id }}" class="c-ui-input__field c-ui-input__RD-field">
                                  </div>
                                  <div class="c-ui-form__col c-ui-form__col--wrap-xs c-ui-form__col--pull-left uk-margin-remove-right" style="display: inline-block;margin-left: 0px !important;padding-left: 0px !important;">
                                    <div class="c-RD-profile__delete-warehouse c-RD-profile__delete-warehouse--danger delete-addreess" data-id="{{ $store_address->id }}" style="padding: 9px;"></div>
                                  </div>
                                </div>
                              @endforeach
                            @endif
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-ui-form__row c-RD-profile__form-action" style="margin-right: auto">
                        <div class="c-RD-profile__cancel-btn uk-flex uk-flex-center uk-flex-middle js-profile-cancel-edit-form">بازگشت</div>
                        <div class="c-RD-profile__approve-btn uk-flex uk-flex-center uk-flex-middle uk-margin-small-right save_tab_form" data-value="store">ذخیره تغییرات</div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="c-RD-profile__dis-none " data-name="email" style="display: none;">
              <div class="c-grid__row c-RD-profile__mt-0" id="email">
                <div class="c-grid__col">
                  <div class="c-card c-RD-profile__bdrs-top-0 js-profile-content-spinner" style="box-shadow: 0 10px 12px 0 rgba(0, 0, 0, 0.05);">
                    <div class="c-card__header c-card__header--with-controls business_info  uk-hidden"></div>
                    <div class="c-card__body c-card__body--form">

                      <div class="c-grid__row">
                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                            <span class="c-RD-profile__title">تنظیمات ایمیل</span>
                          </div>
                          <div class="c-RD-profile__action-btn c-RD-profile__action-btn--cancel js-profile-cancel-edit-form uk-hidden"></div>
                        </div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="site_email_status">فعال / غیرفعال کردن ایمیل فروشگاه:</label>
                            <div class="field-wrapper field-wrapper--justify field-wrapper--background"
                                 style="border-radius: 8px;background-color: #f5f7fa;padding-left: 15px;padding-right: 15px;min-height: 40px;">
                              <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto">
                                <input type="checkbox" class="c-ui-checkbox__origin" name="site_email_status" value="1" checked disabled
                                  {{-- {{ ($settings->where('name', 'site_email_status')->first()->value == 'active')? 'checked' : '' }} --}}
                                  >
                                <span class="c-ui-checkbox__check"></span>
                                <span class="c-ui-checkbox__label">
                                  فعالسازی ایمیل فروشگاه
                                </span>
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="mail_server">
                              سرویس‌دهنده ایمیل:
                            </label>
                            <div class="c-ui-input ">
                              <input type="text" name="mail_server" value="{{ $settings->where('name', 'mail_server')->first()->value }}"
                                     class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="mail_port">درگاه:</label>
                            <div class="c-ui-input ">
                              <label class="c-content-input">
                                <input type="number" name="mail_port" value="{{ $settings->where('name', 'mail_port')->first()->value }}"
                                       class="c-ui-input__field c-ui-input__RD-field">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="mail_username">نام کاربری:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="mail_username" value="{{ $settings->where('name', 'mail_username')->first()->value }}"
                                     class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                              <label class="c-RD-profile__input-name" for="mail_password">
                                کلمه عبور:
                              </label>
                              <div class="c-ui-input ">
                                <input type="text" name="mail_password" value="{{ $settings->where('name', 'mail_password')->first()->value }}"
                                       class="c-ui-input__field c-ui-input__RD-field">
                              </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="mail_password">
                              آدرس ایمیل:
                            </label>
                            <div class="c-ui-input ">
                              <input type="text" name="mail_address"  value="{{ $settings->where('name', 'mail_address')->first()->value }}"
                                     class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      {{-- <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="order_email_status">
                              ارسال ایمیل ثبت موفق سفارش به مشتری:
                            </label>
                            <div class="c-ui-input ">
                              <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible"
                                      name="order_email_status" data-active="false" aria-hidden="true">
                                <option value="active" {{ ($settings->where('name', 'order_email_status')->first()->value == 'active')? 'selected' : '' }}>فعال</option>
                                <option value="inactive" {{ ($settings->where('name', 'order_email_status')->first()->value == 'inactive')? 'selected' : '' }}>غیرفعال</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div> --}}

                      {{-- <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="order_email_text">متن ایمیل ثبت موفق سفارش:</label>
                            <div class="c-ui-input">
                              <textarea name="order_email_text"
                                class="c-ui-input__field c-ui-input__field--order c-ui-input__field--textarea"
                                rows="5" style="border-color: #dddddd; font-weight: bold;"
                                >{{ $settings->where('name', 'order_email_text')->first()->value }}</textarea>
                            </div>
                            <div class="c-profile-business-info-logo-hint" style="margin-right: 0px !important; margin-top: 10px !important;">
                              <span>نام مشتری:  <strong>[customer]</strong></span>&nbsp;&nbsp;
                              <span>شماره سفارش: <strong>[order_code]</strong></span>&nbsp;&nbsp;
                              <span>لینک پیگیری: <strong>[tracking_url]</strong></span>&nbsp;&nbsp;
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div> --}}

                      {{-- <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="delivery_email_status">
                              ارسال ایمیل وضعیت تحویل کالا به مشتری:
                            </label>
                            <div class="c-ui-input ">
                              <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible"
                                      name="delivery_email_status" data-active="false" aria-hidden="true">
                                <option value="active" {{ ($settings->where('name', 'delivery_email_status')->first()->value == 'active')? 'selected' : '' }}>فعال</option>
                                <option value="inactive" {{ ($settings->where('name', 'delivery_email_status')->first()->value == 'inactive')? 'selected' : '' }}>غیرفعال</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div> --}}

                      {{-- <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="delivery_email_text">متن ایمیل وضعیت تحویل کالا:</label>
                            <div class="c-ui-input">
                              <textarea name="delivery_email_text" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--textarea"
                                rows="5" style="border-color: #dddddd; font-weight: bold;"
                                >{{ $settings->where('name', 'delivery_email_text')->first()->value }}</textarea>
                            </div>
                            <div class="c-profile-business-info-logo-hint" style="margin-right: 0px !important; margin-top: 10px !important;">
                              <span>نام مشتری:  <strong>[customer]</strong></span>&nbsp;&nbsp;
                              <span>شماره سفارش: <strong>[order_code]</strong></span>&nbsp;&nbsp;
                              <span>لینک پیگیری: <strong>[tracking_url]</strong></span>&nbsp;&nbsp;
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div> --}}

                      {{-- <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="email_forgot_code_status">
                              بازیابی رمز عبور از طریق ایمیل:
                            </label>
                            <div class="c-ui-input ">
                              <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible"
                                      name="email_forgot_code_status" data-active="false" aria-hidden="true">
                                <option value="active"  {{ ($settings->where('name', 'email_forgot_code_status')->first()->value == 'active')? 'selected' : '' }}>فعال</option>
                                <option value="inactive"  {{ ($settings->where('name', 'email_forgot_code_status')->first()->value == 'inactive')? 'selected' : '' }}>غیرفعال</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div> --}}

                      {{-- <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="send_registration_code_to_email">
                              الزامی بودن تایید ایمیل هنگام ثبت نام:
                            </label>
                            <div class="c-ui-input ">
                              <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible"
                                      name="email_reg_code_status" data-active="false" aria-hidden="true">
                                <option value="active" {{ ($settings->where('name', 'email_reg_code_status')->first()->value == 'active')? 'selected' : '' }}>فعال</option>
                                <option value="inactive" {{ ($settings->where('name', 'email_reg_code_status')->first()->value == 'inactive')? 'selected' : '' }}>غیرفعال</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div> --}}

                      <div class="c-ui-form__row c-RD-profile__form-action" style="margin-right: auto">
                        <div class="c-RD-profile__cancel-btn uk-flex uk-flex-center uk-flex-middle js-profile-cancel-edit-form">بازگشت</div>
                        <div class="c-RD-profile__approve-btn uk-flex uk-flex-center uk-flex-middle uk-margin-small-right js-profile-submit-changes save_tab_form" data-value="email">ذخیره تغییرات</div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="c-RD-profile__dis-none " data-name="footer" style="display: none;">
              <div class="c-grid__row c-RD-profile__mt-0" id="footer">
                <div class="c-grid__col">
                  <div class="c-card c-RD-profile__bdrs-top-0 js-profile-content-spinner" style="box-shadow: 0 10px 12px 0 rgba(0, 0, 0, 0.05);">
                    <div class="c-card__header c-card__header--with-controls business_info  uk-hidden"></div>
                    <div class="c-card__body c-card__body--form">

                      <div class="c-grid__row">
                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                            <span class="c-RD-profile__title">اطلاعات فوتر</span>
                          </div>
                          <div class="c-RD-profile__action-btn c-RD-profile__action-btn--cancel js-profile-cancel-edit-form uk-hidden"></div>
                        </div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="footer_slogan">شعار تبلیغاتی یا آدرس:</label>
                            <div class="c-ui-input ">
                              <input type="text" value="{{ $settings->where('name', 'footer_slogan')->first()->value }}" name="footer_slogan" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="copyright_text">متن کپی رایت:</label>
                            <div class="c-ui-input">
                              <textarea name="copyright_text" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--textarea"
                              maxlength="1500" rows="5" style="border-color: #dddddd; font-weight: bold;"
                              >{{ $settings->where('name', 'copyright_text')->first()->value }}</textarea>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="store_phone">شماره تماس:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="store_phone" value="{{ $settings->where('name', 'store_phone')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="store_email">آدرس ایمیل:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="store_email" value="{{ $settings->where('name', 'store_email')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="footer_desc_title">
                              عنوان بخش توضیحات فروشگاه: (H1)
                            </label>
                            <div class="c-ui-input ">
                              <input type="text" name="footer_desc_title" value="{{ $settings->where('name', 'footer_desc_title')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-12 c-grid__col--lg-12">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="footer_description">توضیحات فروشگاه:</label>
                            <div class="c-ui-input">
                              <textarea name="footer_description" class="c-ui-input__field c-ui-input__field--order
                               c-ui-input__field--textarea" rows="5" style="border-color: #dddddd; font-weight: bold;"
                               >{{ $settings->where('name', 'footer_description')->first()->value }}</textarea>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row" style="margin-top: 75px !important;">
                        <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                          <span class="c-RD-profile__title" style="width: auto;">نمادهای الکترونیک &nbsp;</span>
                          <span style="font-size: 11px;"> (در صورتی که قصد نمایش نماد را ندارید فیلد را خالی رها کنید)</span>
                        </div>
                        <div class="c-RD-profile__action-btn c-RD-profile__action-btn--cancel uk-hidden"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="ecunion_link">لینک مجوز اتحادیه کسب‌وکارهای مجازی:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="ecunion_link" value="{{ $settings->where('name', 'ecunion_link')->first()->value }}"
                               class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="enamad_link">لینک نماد اعتماد الکترونیکی:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="enamad_link" value="{{ $settings->where('name', 'enamad_link')->first()->value }}"
                               class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="samandehi_link">لینک نشان ملی ثبت ساماندهی:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="samandehi_link" value="{{ $settings->where('name', 'samandehi_link')->first()->value }}"
                               class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>



                      <div class="c-grid__row" style="margin-top: 75px !important;">
                        <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                          <span class="c-RD-profile__title" style="width: auto;">شبکه‌های اجتماعی &nbsp;</span>
                          <span style="font-size: 11px;"> (در صورتی که قصد نمایش ندارید فیلد را خالی رها کنید)</span>
                        </div>
                        <div class="c-RD-profile__action-btn c-RD-profile__action-btn--cancel uk-hidden"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="instagram_link">لینک اینستاگرام:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="instagram_link" value="{{ $settings->where('name', 'instagram_link')->first()->value }}"
                               class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="twitter_link">لینک توییتر:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="twitter_link" value="{{ $settings->where('name', 'twitter_link')->first()->value }}"
                               class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="aparat_link">لینک آپارات:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="aparat_link" value="{{ $settings->where('name', 'aparat_link')->first()->value }}"
                               class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="linkedin_link">لینک لینکدین:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="linkedin_link" value="{{ $settings->where('name', 'linkedin_link')->first()->value }}"
                               class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      {{-- <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="whatsapp_link">لینک واتساپ:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="whatsapp_link" value="{{ $settings->where('name', 'whatsapp_link')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div> --}}

                      {{-- <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="telegram_link">لینک تلگرام:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="telegram_link" value="{{ $settings->where('name', 'telegram_link')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div> --}}

                      <div class="c-grid__row" style="margin-top: 75px !important;">
                        <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                          <span class="c-RD-profile__title" style="width: auto;">معرفی اپلیکیشن &nbsp;</span>
                          <span style="font-size: 11px;"> (در صورتی که قصد نمایش ندارید فیلد را خالی رها کنید)</span>
                        </div>
                        <div class="c-RD-profile__action-btn c-RD-profile__action-btn--cancel uk-hidden"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="googleplay_link">لینک گوگل پلی:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="googleplay_link" value="{{ $settings->where('name', 'googleplay_link')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="cafebazaar_link">لینک کافه بازار:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="cafebazaar_link" value="{{ $settings->where('name', 'cafebazaar_link')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="myket_link">لینک مایکت:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="myket_link" value="{{ $settings->where('name', 'myket_link')->first()->value }}"
                                     class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="sibapp_link">لینک سیب اپ:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="sibapp_link" value="{{ $settings->where('name', 'sibapp_link')->first()->value }}"
                                     class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-ui-form__row c-RD-profile__form-action" style="margin-right: auto">
                        <div class="c-RD-profile__cancel-btn uk-flex uk-flex-center uk-flex-middle js-profile-cancel-edit-form">بازگشت</div>
                        <div class="c-RD-profile__approve-btn uk-flex uk-flex-center uk-flex-middle uk-margin-small-right
                         js-profile-submit-changes save_tab_form" data-value="footer">ذخیره تغییرات</div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="c-RD-profile__dis-none " data-name="advanced" style="display: none;">
              <div class="c-grid__row c-RD-profile__mt-0" id="advanced">
                <div class="c-grid__col">
                  <div class="c-card c-RD-profile__bdrs-top-0 js-profile-content-spinner" style="box-shadow: 0 10px 12px 0 rgba(0, 0, 0, 0.05);">
                    <div class="c-card__header c-card__header--with-controls business_info  uk-hidden"></div>
                    <div class="c-card__body c-card__body--form">

                      <div class="c-grid__row">
                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                            <span class="c-RD-profile__title">تنظیمات پیشرفته</span>
                          </div>
                          <div class="c-RD-profile__action-btn c-RD-profile__action-btn--cancel js-profile-cancel-edit-form uk-hidden"></div>
                        </div>
                      </div>


                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-12 c-grid__col--lg-12">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="custom_header_code">
                                اضافه کردن اسکریپت سفارشی در تگ HEAD:
                            </label>
                            <div class="c-ui-input">
                              <textarea class="c-ui-input__field c-ui-input__field--order
                               c-ui-input__field--textarea" name="custom_header_code"
                                rows="5" style="border-color: #dddddd; font-weight: bold; direction: ltr;"
                              >{{ $settings->where('name', 'custom_header_code')->first()->value }}</textarea>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-12 c-grid__col--lg-12">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="custom_footer_code">
                                اضافه کردن اسکریپت سفارشی در Footer:
                            </label>
                            <div class="c-ui-input">
                              <textarea name="custom_footer_code" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--textarea"
                                        rows="5" style="border-color: #dddddd; font-weight: bold; direction: ltr;" spellcheck="false"
                              >{{ $settings->where('name', 'custom_footer_code')->first()->value }}</textarea>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-12 c-grid__col--lg-12">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="custom_css_code">کد CSS سفارشی:</label>
                            <div class="c-ui-input">
                              <textarea name="custom_css_code" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--textarea"
                                        rows="5" style="border-color: #dddddd; font-weight: bold; direction: ltr;" spellcheck="false"
                              >{{ $settings->where('name', 'custom_css_code')->first()->value }}</textarea>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-ui-form__row c-RD-profile__form-action" style="margin-right: auto">
                        <div class="c-RD-profile__cancel-btn uk-flex uk-flex-center
                            uk-flex-middle js-profile-cancel-edit-form">بازگشت</div>
                        <div class="c-RD-profile__approve-btn uk-flex uk-flex-center
                        uk-flex-middle uk-margin-small-right js-profile-submit-changes
                        save_tab_form" data-value="advanced">ذخیره تغییرات</div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="c-RD-profile__dis-none " data-name="license" style="display: none;">
              <div class="c-grid__row c-RD-profile__mt-0" id="license">
                <div class="c-grid__col">
                  <div class="c-card c-RD-profile__bdrs-top-0 js-profile-content-spinner" style="box-shadow: 0 10px 12px 0 rgba(0, 0, 0, 0.05);">
                    <div class="c-card__header c-card__header--with-controls business_info  uk-hidden"></div>
                    <div class="c-card__body c-card__body--form">

                      <div class="c-grid__row">
                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                            <span class="c-RD-profile__title">فعالسازی محصول</span>
                          </div>
                          <div class="c-RD-profile__action-btn c-RD-profile__action-btn--cancel js-profile-cancel-edit-form uk-hidden"></div>
                        </div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="license_username">نام کاربری:</label>
                            <div class="c-ui-input ">
                              <input type="text" name="license_username" class="c-ui-input__field c-ui-input__RD-field" value="">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="license_order_code">شماره سفارش:</label>
                            <div class="c-ui-input ">
                              <input type="number" name="license_order_code" class="c-ui-input__field c-ui-input__RD-field" value="">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-ui-form__row c-RD-profile__form-action" style="margin-right: auto">
                        <div class="c-RD-profile__cancel-btn uk-flex uk-flex-center uk-flex-middle js-profile-cancel-edit-form">بازگشت</div>
                        <div class="c-RD-profile__approve-btn uk-flex uk-flex-center uk-flex-middle uk-margin-small-right
                         js-profile-submit-changes save_tab_form" data-value="license">ذخیره تغییرات</div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="c-RD-profile__dis-none " data-name="sms" style="display: none;">
              <div class="c-grid__row c-RD-profile__mt-0" id="sms">
                <div class="c-grid__col">
                  <div class="c-card c-RD-profile__bdrs-top-0 js-profile-content-spinner" style="box-shadow: 0 10px 12px 0 rgba(0, 0, 0, 0.05);">
                    <div class="c-card__header c-card__header--with-controls business_info  uk-hidden"></div>
                    <div class="c-card__body c-card__body--form">

                      <div class="c-grid__row">
                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                            <span class="c-RD-profile__title">تنظیمات سامانه پیامکی</span>
                          </div>
                          <div class="c-RD-profile__action-btn c-RD-profile__action-btn--cancel js-profile-cancel-edit-form uk-hidden"></div>
                        </div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="site_sms_status">فعال / غیرفعالسازی:</label>
                            <div class="field-wrapper field-wrapper--justify field-wrapper--background" style="border-radius: 8px;background-color: #f5f7fa;padding-left: 15px;padding-right: 15px;min-height: 40px;">
                              <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto">
                                <input type="checkbox" class="c-ui-checkbox__origin" name="site_sms_status" value="1"
                                  {{-- {{ ($settings->where('name', 'site_sms_status')->first()->value == 'active')? 'checked' : '' }} --}}
                                  checked disabled>
                                <span class="c-ui-checkbox__check"></span>
                                <span class="c-ui-checkbox__label">
                                  در صورت انتخاب سامانه پیامکی فعال می‌شود
                                </span>
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="sms_provider">سرویس‌دهنده پیامک:</label>
                            <div class="c-ui-input ">
                              <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible"
                                      name="sms_provider" data-active="false" aria-hidden="true">
                                <option value="kavenegar" {{ ($settings->where('name', 'sms_provider')->first()->value == 'kavenegar')? 'selected' : '' }}>کاوه نگار</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="api_key">
                              کلید ای پی آی (API Key):
                            </label>
                            <div class="c-ui-input ">
                              <input type="text" name="api_key" value="{{ $settings->where('name', 'api_key')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="order_sms_text">متن پیام ثبت موفق سفارش:</label>
                            <div class="c-ui-input">
                                <textarea name="order_sms_text" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--textarea"
                                 rows="5" style="border-color: #dddddd; font-weight: bold;" spellcheck="false"
                                 >{{ $settings->where('name', 'order_sms_text')->first()->value }}</textarea>
                            </div>
                            <div class="c-profile-business-info-logo-hint" style="margin-right: 0px !important; margin-top: 10px !important;">
                              <span>نام مشتری:  <strong>[customer]</strong></span>&nbsp;&nbsp;
                              <span>شماره سفارش: <strong>[order_code]</strong></span>&nbsp;&nbsp;
                              {{-- <span>لینک پیگیری: <strong>[tracking_url]</strong></span>&nbsp;&nbsp; --}}
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="sms_sender_number">شماره خط ارسالی:</label>
                            <div class="c-ui-input ">
                              <input type="number" name="sms_sender_number" value="{{ $settings->where('name', 'sms_sender_number')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="delivery_sms_status">
                              ارسال پیامک وضعیت تحویل کالا به مشتری:
                            </label>
                            <div class="c-ui-input ">
                              <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible"
                                      name="delivery_sms_status" data-active="false" aria-hidden="true">
                                <option value="active" {{ ($settings->where('name', 'delivery_sms_status')->first()->value == 'active')? 'selected' : '' }}>فعال</option>
                                <option value="inactive" {{ ($settings->where('name', 'delivery_sms_status')->first()->value == 'inactive')? 'selected' : '' }}>غیرفعال</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="delivery_sms_text">
                              متن پیامک وضعیت تحویل کالا:
                            </label>
                            <div class="c-ui-input">
                              <textarea name="delivery_sms_text" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--textarea"
                                        maxlength="1500" rows="5" style="border-color: #dddddd; font-weight: bold;" spellcheck="true"
                                        >{{ $settings->where('name', 'delivery_sms_text')->first()->value }}</textarea>
                            </div>
                            <div class="c-profile-business-info-logo-hint" style="margin-right: 0px !important; margin-top: 10px !important;">
                              <span>نام مشتری:  <strong>[customer]</strong></span>&nbsp;&nbsp;
                              <span>وضعیت: <strong>[status]</strong></span>&nbsp;&nbsp;
                              <span>شماره سفارش: <strong>[order_code]</strong></span>&nbsp;&nbsp;
                              {{-- <span>لینک پیگیری: <strong>[tracking_url]</strong></span>&nbsp;&nbsp; --}}
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>


                      {{-- <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="sms_forgot_code_status">
                              بازیابی رمز عبور از طریق پیامک:
                            </label>
                            <div class="c-ui-input ">
                              <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible"
                                      name="sms_forgot_code_status" data-active="false" aria-hidden="true">
                                <option value="active" {{ ($settings->where('name', 'sms_forgot_code_status')->first()->value == 'active')? 'selected' : '' }}>فعال</option>
                                <option value="inactive" {{ ($settings->where('name', 'sms_forgot_code_status')->first()->value == 'inactive')? 'selected' : '' }}>غیرفعال</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div> --}}

                      {{-- <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="sms_reg_code_status">
                              الزامی بودن تایید شماره موبایل هنگام ثبت نام:
                            </label>
                            <div class="c-ui-input ">
                              <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible"
                                      name="sms_reg_code_status" data-active="false" aria-hidden="true">
                                <option value="active" {{ ($settings->where('name', 'sms_reg_code_status')->first()->value == 'active')? 'selected' : '' }}>فعال</option>
                                <option value="inactive" {{ ($settings->where('name', 'sms_reg_code_status')->first()->value == 'inactive')? 'selected' : '' }}>غیرفعال</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div> --}}

                      <div class="c-ui-form__row c-RD-profile__form-action" style="margin-right: auto">
                        <div class="c-RD-profile__cancel-btn uk-flex uk-flex-center uk-flex-middle js-profile-cancel-edit-form">بازگشت</div>
                        <div class="c-RD-profile__approve-btn uk-flex uk-flex-center uk-flex-middle uk-margin-small-right js-profile-submit-changes save_tab_form" data-value="sms">ذخیره تغییرات</div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="c-RD-profile__dis-none " data-name="peyment" style="display: none;">
              <div class="c-grid__row c-RD-profile__mt-0" id="peyment">
                <div class="c-grid__col">
                  <div class="c-card c-RD-profile__bdrs-top-0 js-profile-content-spinner" style="box-shadow: 0 10px 12px 0 rgba(0, 0, 0, 0.05);">
                    <div class="c-card__header c-card__header--with-controls business_info  uk-hidden"></div>
                    <div class="c-card__body c-card__body--form">

                      <div class="c-grid__row">
                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                            <span class="c-RD-profile__title">تنظیمات درگاه پرداخت</span>
                          </div>
                          <div class="c-RD-profile__action-btn c-RD-profile__action-btn--cancel js-profile-cancel-edit-form uk-hidden"></div>
                        </div>
                      </div>

                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="delivery_sms_status">
                              ارسال پیامک پرداخت موفق سفارش به مشتری:
                            </label>
                            <div class="c-ui-input ">
                              <select class="c-ui-select c-ui-select--common c-ui-select--small c-RD-profile select2-hidden-accessible"
                                      name="successful_payment_sms_status" data-active="false" aria-hidden="true" spellcheck="false">
                                <option value="active" {{ ($settings->where('name', 'successful_payment_sms_status')->first()->value == 'active')? 'selected' : '' }}>فعال</option>
                                <option value="inactive" {{ ($settings->where('name', 'successful_payment_sms_status')->first()->value == 'inactive')? 'selected' : '' }}>غیرفعال</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>
                      <div class="c-grid__row">
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                          <div class="c-form">
                            <label class="c-RD-profile__input-name" for="peyment_success_message">متن پیام پرداخت موفق:</label>
                            <div class="c-ui-input">
                              <textarea name="peyment_success_message" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--textarea"
                                        rows="7" style="border-color: #dddddd; font-weight: bold;" spellcheck="false"
                              >{{ $settings->where('name', 'peyment_success_message')->first()->value }}</textarea>
                            </div>
                            <div class="c-profile-business-info-logo-hint" style="margin-right: 0px !important; margin-top: 10px !important;">
                              <span>نام مشتری:  <strong>[customer]</strong></span>&nbsp;&nbsp;
                              <span>شماره فاکتور: <strong>[invoice_code]</strong></span>&nbsp;&nbsp;
                              <span>مبلغ پرداخت: <strong>[cost]</strong></span>&nbsp;&nbsp;<br>
                              <span>شماره سفارش: <strong>[order_code]</strong></span>&nbsp;&nbsp;
                              <span>شناسه پیگیری: <strong>[tracking_code]</strong></span>&nbsp;&nbsp;
                            </div>
                          </div>
                        </div>
                        <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                      </div>


                      <div class="c-ui-form__row c-RD-profile__form-action" style="margin-right: auto">
                        <div class="c-RD-profile__cancel-btn uk-flex uk-flex-center uk-flex-middle js-profile-cancel-edit-form">بازگشت</div>
                        <div class="c-RD-profile__approve-btn uk-flex uk-flex-center uk-flex-middle uk-margin-small-right js-profile-submit-changes save_tab_form" data-value="peyment">ذخیره تغییرات</div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="c-RD-profile__dis-none " data-name="invoice" style="display: none;">
              <div class="c-grid__row c-RD-profile__mt-0" id="invoice">
                <div class="c-grid__col">
                  <div class="c-card c-RD-profile__bdrs-top-0 js-profile-content-spinner" style="box-shadow: 0 10px 12px 0 rgba(0, 0, 0, 0.05);">
                    <div class="c-card__header c-card__header--with-controls  uk-hidden"></div>
                    <div class="c-card__body c-card__body--form">
                      <div class="c-grid__row">

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-10 c-RD-profile__section-title">
                            <span class="c-RD-profile__title">اطلاعات فاکتور</span>
                          </div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="invoice_title">عنوان فاکتور اصلی:</label>
                              <div class="c-ui-input ">
                                <input type="text" name="invoice_title" class="c-ui-input__field c-ui-input__RD-field" value="{{ $settings->where('name', 'invoice_title')->first()->value }}">
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="invoice_seller">فروشنده:</label>
                              <div class="c-ui-input ">
                                <input type="text" name="invoice_seller" value="{{ $settings->where('name', 'invoice_seller')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="invoice_national_id">شناسه ملی:</label>
                              <div class="c-ui-input ">
                                <input type="text" name="invoice_national_id" value="{{ $settings->where('name', 'invoice_national_id')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="invoice_reg_number">شماره ثبت:</label>
                              <div class="c-ui-input ">
                                <input type="text" name="invoice_reg_number" value="{{ $settings->where('name', 'invoice_reg_number')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                              </div>
                            </div>
                            <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="invoice_economic_number">شماره اقتصادی:</label>
                              <div class="c-ui-input ">
                                <input type="text" name="invoice_economic_number" class="c-ui-input__field c-ui-input__RD-field" value="{{ $settings->where('name', 'invoice_economic_number')->first()->value }}">
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="invoice_company_address">نشانی شرکت:</label>
                              <div class="c-ui-input">
                                <textarea name="invoice_company_address" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--textarea" rows="2" style="border-color: #dddddd; font-weight: bold;">{{ $settings->where('name', 'invoice_company_address')->first()->value }}</textarea>
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="invoice_company_postal_code">کد پستی:</label>
                              <div class="c-ui-input ">
                                <input type="text" name="invoice_company_postal_code" value="{{ $settings->where('name', 'invoice_company_postal_code')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="invoice_company_fax_phone">تلفن:</label>
                              <div class="c-ui-input ">
                                <input type="text" name="invoice_company_fax_phone" value="{{ $settings->where('name', 'invoice_company_fax_phone')->first()->value }}" class="c-ui-input__field c-ui-input__RD-field">
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row">
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4">
                            <div class="c-form">
                              <label class="c-RD-profile__input-name" for="invoice_description">توضیحات:</label>
                              <div class="c-ui-input">
                                <textarea name="invoice_description" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--textarea" rows="4" style="border-color: #dddddd; font-weight: bold;">{{ $settings->where('name', 'invoice_description')->first()->value }}</textarea>
                              </div>
                            </div>
                          </div>
                          <div class="c-grid__col c-grid__col--sm-4 c-grid__col--lg-4"></div>
                        </div>

                        <div class="c-grid__row uk-margin-medium-top" style="background-color: #f5f7fa; padding: 20px; border-radius: 8px; margin-top: 40px !important;">
                          <div class="o-spacing-m-r-3" style="padding-right: 10px;">
                            <div class="field-wrapper">
                              <div id="stampUpload" class="c-content-modal__uploads-label {{ is_null($stamp_image)? 'empty' : '' }}">
                                <span uk-form-custom="" class="uk-form-custom">
                                    <input id="brandstampFile" name="upload_stamp" type="file" class="hidden">
                                </span>

                                <label for="brandstampFile" class="c-content-modal__uploads-preview" style="border: 1px solid #e0e0e2; background-color: white;">
                                  <img src="{{ (!is_null($stamp_image)? $site_url . '/' .  $stamp_image->path . '/' . $stamp_image->name : '') }}" id="stampUploadPreview" class="c-content-modal__uploads-img" alt="" style="width: 100% !important; height: 100%;">

                                  <span class="c-content-upload__img-loader js-img-loader">
                                      <span class="progress__wrapper">
                                        <span class="progress"></span>
                                      </span>
                                  </span>
                                  @if(!$settings->where('name', 'invoice_stamp')->first()->media()->exists())
                                    <label class="c-RD-profile__upload-btn" id="stampUploadLable">
                                      <input id="brandstampFile" type="file" class="hidden">
                                    </label>
                                  @endif
                                </label>
                              </div>
                              <input type="hidden" name="stampImageTempId" id="stampImageTempId">
                              <div class="c-content-modal__errors-full" id="stampUploadErrors"></div>
                            </div>
                          </div>

                          <div class="o-spacing-m-r-3" style="padding-right: 20px;padding-top: 15px;">
                            <span style="display: block;">
                              تصویر مهر شرکت
                              @if($settings->where('name', 'invoice_stamp')->first()->media()->exists())
                                <a class="c-ui-btn c-ui-btn--next mr-a delete-stamp-image"  style=" margin-left: 21px;width: 59px !important;height: 20px !important;min-width: 45px !important;border-radius: 5px;font-size: 10px;box-shadow: unset;font-weight: bold;" id="submit-form">حذف تصویر</a>
                              @endif
                              </span>

                            <span style="display: inline-block;font-size: 12px;margin-top: 7px;">اندازه استاندارد: 600x300px</span>
                            <span style="display: inline-block;font-size: 12px;margin-top: 7px;margin-right: 20px;">فرمت استاندارد: png, svg, jpeg, jpg</span>

                          </div>
                        </div>

                        <div class="uk-flex uk-flex-column uk-width-1-1">
                          <div class="c-profile-business-info-logo-error o-spacing-m-t-6 o-spacing-m-b-2 uk-margin-remove-right" style="display: none;"></div>
                          <div class="c-profile-business-info-logo-error  uk-margin-remove-right o-spacing-m-b-2" style="display: none;"></div>
                        </div>

                        <div class="c-ui-form__row c-RD-profile__form-action js-profile-form-action" style="margin-right: auto">
                          <div class="c-RD-profile__cancel-btn uk-flex uk-flex-center uk-flex-middle js-profile-cancel-edit-form">بازگشت</div>
                          <div class="c-RD-profile__approve-btn uk-flex uk-flex-center uk-flex-middle uk-margin-small-right save_tab_form" data-value="invoice">ذخیره تغییرات</div>
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

function initLogoUpload() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  let $logoUpload = $('#logoUpload');
  let $previewImg = $('#logoUploadPreview');
  let $errorsSection = $('#logoUploadErrors');
  window.UIkit.upload($logoUpload, {
    url: "{{ route('staff.settings.UploadImage') }}",
    beforeSend: function () {
      $errorsSection.html('');
    },
    beforeSend: e => e.headers = { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
    beforeAll: function () {
      $logoUpload.addClass('loading');
      $errorsSection.html('');
    },
    load: function () {
    },
    error: function () {
    },
    complete: function () {
      let result = JSON.parse(arguments[0].response);
      if (typeof result.status === 'undefined') {
        return;
      }
      $errorsSection.html('');
      $errorsSection.addClass('hidden');
      /**
       * @param result
       * @param result.data.errors errors related to image validation
       * @param result.data.error_server error related to cloud upload
       */
      if (typeof result.data.errors !== 'undefined') {
        $.each(result.data.errors, function (messageKey, messageText) {
          let $div = $('<div/>');
          $div.html(messageText);
          $errorsSection.append($div);
        });
        $errorsSection.removeClass('hidden');
        $logoUpload.removeClass('loading');
        return;
      }

      if (typeof result.data.error_server !== 'undefined') {
        let $div = $('<div/>');
        $div.html(result.data.error_server);
        $errorsSection.append($div);
        $errorsSection.removeClass('hidden');
        $logoUpload.removeClass('loading');
        return;
      }

      $logoUpload.removeClass('empty loading');
      $previewImg.attr('src', result.data.url);
      $("#logoUploadLable").remove();
      $('#logoImageTempId').val(result.data.id);
    },
    loadStart: function () {
    },
    progress: function () {
    },
    loadEnd: function () {
    },
    completeAll: function () {
    }
  });

}

function initfaviconUpload() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  let $faviconUpload = $('#faviconUpload');
  let $previewImg = $('#faviconUploadPreview');
  let $errorsSection = $('#faviconUploadErrors');
  window.UIkit.upload($faviconUpload, {
    url: "{{ route('staff.settings.UploadImage') }}",
    beforeSend: function () {
      $errorsSection.html('');
    },
    beforeSend: e => e.headers = { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
    beforeAll: function () {
      $faviconUpload.addClass('loading');
      $errorsSection.html('');
    },
    load: function () {
    },
    error: function () {
    },
    complete: function () {
      let result = JSON.parse(arguments[0].response);
      if (typeof result.status === 'undefined') {
        return;
      }
      $errorsSection.html('');
      $errorsSection.addClass('hidden');
      /**
       * @param result
       * @param result.data.errors errors related to image validation
       * @param result.data.error_server error related to cloud upload
       */
      if (typeof result.data.errors !== 'undefined') {
        $.each(result.data.errors, function (messageKey, messageText) {
          let $div = $('<div/>');
          $div.html(messageText);
          $errorsSection.append($div);
        });
        $errorsSection.removeClass('hidden');
        $faviconUpload.removeClass('loading');
        return;
      }

      if (typeof result.data.error_server !== 'undefined') {
        let $div = $('<div/>');
        $div.html(result.data.error_server);
        $errorsSection.append($div);
        $errorsSection.removeClass('hidden');
        $faviconUpload.removeClass('loading');
        return;
      }

      $faviconUpload.removeClass('empty loading');
      $previewImg.attr('src', result.data.url);
      $("#faviconUploadLable").remove();
      $('#faviconImageTempId').val(result.data.id);
    },
    loadStart: function () {
    },
    progress: function () {
    },
    loadEnd: function () {
    },
    completeAll: function () {
    }
  });

}

function initstampUpload() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  let $stampUpload = $('#stampUpload');
  let $previewImg = $('#stampUploadPreview');
  let $errorsSection = $('#stampUploadErrors');
  window.UIkit.upload($stampUpload, {
    url: "{{ route('staff.settings.UploadImage') }}",
    beforeSend: function () {
      $errorsSection.html('');
    },
    beforeSend: e => e.headers = { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
    beforeAll: function () {
      $stampUpload.addClass('loading');
      $errorsSection.html('');
    },
    load: function () {
    },
    error: function () {
    },
    complete: function () {
      let result = JSON.parse(arguments[0].response);
      if (typeof result.status === 'undefined') {
        return;
      }
      $errorsSection.html('');
      $errorsSection.addClass('hidden');
      /**
       * @param result
       * @param result.data.errors errors related to image validation
       * @param result.data.error_server error related to cloud upload
       */
      if (typeof result.data.errors !== 'undefined') {
        $.each(result.data.errors, function (messageKey, messageText) {
          let $div = $('<div/>');
          $div.html(messageText);
          $errorsSection.append($div);
        });
        $errorsSection.removeClass('hidden');
        $stampUpload.removeClass('loading');
        return;
      }

      if (typeof result.data.error_server !== 'undefined') {
        let $div = $('<div/>');
        $div.html(result.data.error_server);
        $errorsSection.append($div);
        $errorsSection.removeClass('hidden');
        $stampUpload.removeClass('loading');
        return;
      }

      $stampUpload.removeClass('empty loading');
      $previewImg.attr('src', result.data.url);
      $("#stampUploadLable").remove();
      $('#stampImageTempId').val(result.data.id);
    },
    loadStart: function () {
    },
    progress: function () {
    },
    loadEnd: function () {
    },
    completeAll: function () {
    }
  });

}

function initsymbolUpload() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  let $symbolUpload = $('#symbolUpload');
  let $previewImg = $('#symbolUploadPreview');
  let $errorsSection = $('#symbolUploadErrors');
  window.UIkit.upload($symbolUpload, {
    url: "{{ route('staff.settings.UploadImage') }}",
    beforeSend: function () {
      $errorsSection.html('');
    },
    beforeSend: e => e.headers = { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
    beforeAll: function () {
      $symbolUpload.addClass('loading');
      $errorsSection.html('');
    },
    load: function () {
    },
    error: function () {
    },
    complete: function () {
      let result = JSON.parse(arguments[0].response);
      if (typeof result.status === 'undefined') {
        return;
      }
      $errorsSection.html('');
      $errorsSection.addClass('hidden');
      /**
       * @param result
       * @param result.data.errors errors related to image validation
       * @param result.data.error_server error related to cloud upload
       */
      if (typeof result.data.errors !== 'undefined') {
        $.each(result.data.errors, function (messageKey, messageText) {
          let $div = $('<div/>');
          $div.html(messageText);
          $errorsSection.append($div);
        });
        $errorsSection.removeClass('hidden');
        $symbolUpload.removeClass('loading');
        return;
      }

      if (typeof result.data.error_server !== 'undefined') {
        let $div = $('<div/>');
        $div.html(result.data.error_server);
        $errorsSection.append($div);
        $errorsSection.removeClass('hidden');
        $symbolUpload.removeClass('loading');
        return;
      }

      $symbolUpload.removeClass('empty loading');
      $previewImg.attr('src', result.data.url);
      $("#symbolUploadLable").remove();
      $('#symbolImageTempId').val(result.data.id);
    },
    loadStart: function () {
    },
    progress: function () {
    },
    loadEnd: function () {
    },
    completeAll: function () {
    }
  });

}

initLogoUpload();
initfaviconUpload();
initsymbolUpload();
initstampUpload();

$(document).on('click', '.save_tab_form', function (){

  if ($('input[name=site_index_status]').is(":checked")) {
    var site_index_status = 'true';
  } else {
    var site_index_status = 'false';
  }

  if ($('input[name=development_mode]').is(":checked")) {
    var development_mode = 'true';
  } else {
    var development_mode = 'false';
  }

  if ($('input[name=inـpersonـdelivery]').is(":checked")) {
    var inـpersonـdelivery = 'true';
  } else {
    var inـpersonـdelivery = 'false';
  }

  if ($('input[name=site_sms_status]').is(":checked")) {
    var site_sms_status = 'active';
  } else {
    var site_sms_status = 'inactive';
  }

  if ($('input[name=site_email_status]').is(":checked")) {
    var is_avtive_email = 'active';
  } else {
    var is_avtive_email = 'inactive';
  }


  var formData = {
      // general tab
      active_tab : $(this).data('value'),
      fa_store_name : $('input[name=fa_store_name]').val(),
      en_store_name : $('input[name=en_store_name]').val(),
      site_url : $('input[name=site_url]').val(),
      admin_email : $('input[name=admin_email]').val(),
      management_subdomain : $('input[name=management_subdomain]').val(),
      site_index_status : site_index_status,
      site_title : $('input[name=site_title]').val(),
      index_meta_description : $('textarea[name=index_meta_description]').val(),
      index_meta_keywords : $('input[name=index_meta_keywords]').val(),
      logoImageId : $('input[name=logoImageTempId]').val(),
      faviconImageId : $('input[name=faviconImageTempId]').val(),
      symbolImageId : $('input[name=symbolImageTempId]').val(),

      // store tab
      development_mode : development_mode,
      auto_navigateـtoـcart : $('select[name=auto_navigateـtoـcart]').val(),
      max_add_to_cart_num : $('input[name=max_add_to_cart_num]').val(),
      max_shipping_day_count : $('input[name=max_shipping_day_count]').val(),
      products_per_page_count : $('input[name=products_per_page_count]').val(),
      product_code_prefix : $('input[name=product_code_prefix]').val(),
      product_title_prefix : $('input[name=product_title_prefix]').val(),
      store_city : $('select[name=store_city]').val(),
      inـpersonـdelivery : inـpersonـdelivery,
      shop_addresses : $("input[name='shop_address']").map(function(){return $(this).val();}).get(),
      shop_addresses_id : $("input[name='shop_address']").map(function(){return $(this).data('id');}).get(),
      deleted_addresses : $("input[name='deleted_address']").map(function(){return $(this).val();}).get(),

      // footer tab
      footer_slogan : $('input[name=footer_slogan]').val(),
      copyright_text : $('textarea[name=copyright_text]').val(),
      store_phone : $('input[name=store_phone]').val(),
      store_email : $('input[name=store_email]').val(),
      footer_desc_title : $('input[name=footer_desc_title]').val(),
      footer_description : $('textarea[name=footer_description]').val(),
      ecunion_link : $('input[name=ecunion_link]').val(),
      enamad_link : $('input[name=enamad_link]').val(),
      samandehi_link : $('input[name=samandehi_link]').val(),
      instagram_link : $('input[name=instagram_link]').val(),
      twitter_link : $('input[name=twitter_link]').val(),
      aparat_link : $('input[name=aparat_link]').val(),
      linkedin_link : $('input[name=linkedin_link]').val(),
      whatsapp_link : $('input[name=whatsapp_link]').val(),
      telegram_link : $('input[name=telegram_link]').val(),
      googleplay_link : $('input[name=googleplay_link]').val(),
      cafebazaar_link : $('input[name=cafebazaar_link]').val(),
      myket_link : $('input[name=myket_link]').val(),
      sibapp_link : $('input[name=sibapp_link]').val(),

      // advanced tab
      custom_header_code : $('textarea[name=custom_header_code]').val(),
      custom_footer_code : $('textarea[name=custom_footer_code]').val(),
      custom_css_code : $('textarea[name=custom_css_code]').val(),

      // sms tab
      site_sms_status: site_sms_status,
      sms_provider: $('select[name=sms_provider]').val(),
      api_key: $('input[name=api_key]').val(),
      order_sms_text: $('textarea[name=order_sms_text]').val(),
      sms_sender_number: $('input[name=sms_sender_number]').val(),
      delivery_sms_status: $('select[name=delivery_sms_status]').val(),
      delivery_sms_text: $('textarea[name=delivery_sms_text]').val(),
      sms_forgot_code_status: $('select[name=sms_forgot_code_status]').val(),
      sms_reg_code_status: $('select[name=sms_reg_code_status]').val(),

      // email tab
      site_email_status: is_avtive_email,
      mail_server: $('input[name=mail_server]').val(),
      mail_port: $('input[name=mail_port]').val(),
      mail_username: $('input[name=mail_username]').val(),
      mail_password: $('input[name=mail_password]').val(),
      mail_address: $('input[name=mail_address]').val(),
      order_email_status: $('select[name=order_email_status]').val(),
      order_email_text: $('textarea[name=order_email_text]').val(),
      delivery_email_status: $('select[name=delivery_email_status]').val(),
      delivery_email_text: $('textarea[name=delivery_email_text]').val(),
      email_forgot_code_status: $('select[name=email_forgot_code_status]').val(),
      email_reg_code_status: $('select[name=email_reg_code_status]').val(),

      // peyment tab
      peyment_success_message: $('textarea[name=peyment_success_message]').val(),
      successful_payment_sms_status: $('select[name=successful_payment_sms_status]').val(),

      // invoice tab
      invoice_title : $('input[name=invoice_title]').val(),
      invoice_seller : $('input[name=invoice_seller]').val(),
      invoice_national_id : $('input[name=invoice_national_id]').val(),
      invoice_reg_number : $('input[name=invoice_reg_number]').val(),
      invoice_economic_number : $('input[name=invoice_economic_number]').val(),
      invoice_company_address : $('textarea[name=invoice_company_address]').val(),
      invoice_description : $('textarea[name=invoice_description]').val(),
      invoice_company_postal_code : $('input[name=invoice_company_postal_code]').val(),
      invoice_company_fax_phone : $('input[name=invoice_company_fax_phone]').val(),
      stampImageId : $('input[name=stampImageTempId]').val(),
  }

  $.ajax({
    method:'post',
    url: '{{ route('staff.settings.update') }}',
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
      contactDetailsAction.displayError(errors.responseJSON.data.errors);
    },
  });

});


$('.delete-stamp-image').on('click', function (e) {
  // e.preventDefault();

  $.ajax({
    method: "post",
    url: '{{route('staff.settings.deleteStampImage')}}',
    success: function () {
      $('#stampImageTempId').val('');

      UIkit.notification({
        message: 'تصویر حذف شد.',
        status: 'success',
        pos: 'top-left',
        timeout: 3000
      });

      window.location.href = "{{ route('staff.settings.index') }}";

    },

    error: function (errors) {
      Promotion.displayError(errors.responseJSON.data.errors);
    }
  });

});

var input = document.querySelector('input[name=index_meta_keywords]');
var tagify = new Tagify(input, {
  originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
});

$(document).on('click',".new-address-btn", function (){
  var address_row = '<div class="address-row" style="margin-top: 20px"><div style="float: right;width: 94.2%;"><input type="text" name="shop_address" class="c-ui-input__field c-ui-input__RD-field"></div><div class="c-ui-form__col c-ui-form__col--wrap-xs c-ui-form__col--pull-left uk-margin-remove-right" style="display: inline-block;margin-left: 0px !important;padding-left: 0px !important;"><div class="c-RD-profile__delete-warehouse c-RD-profile__delete-warehouse--danger delete-addreess" data-id="new" style="padding: 9px;"></div></div></div>';
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
