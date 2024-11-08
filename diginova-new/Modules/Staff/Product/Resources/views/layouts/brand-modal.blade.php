<div id="newBrandRequestModal" class="marketplace-redesign uk-modal c-variant" uk-modal="">
  <div class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body c-content-modal"
       id="newBrandRequestModalContent">
    <button class="uk-modal-close uk-modal-close--search uk-close uk-icon" type="button"
            uk-close="">
      <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"
           ratio="1">
        <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line>
        <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line>
      </svg>
    </button>
    <form id="newBrandRequestForm" novalidate="novalidate">
      <input type="hidden" name="brand[product_id]" value="">
      <input type="hidden" name="brand[category_id]" id="newBrandRequestCategoryIdContainer">
      <div class="c-content-modal__header c-content-modal__header--overflow">
        <h3 class="c-content-modal__title"> درخواست ایجاد برند جدید</h3>
      </div>
      <div class="c-content-modal__body c-content-modal__body--overflow">
        <div class="c-content-modal__body-container">
          <div class="c-content-modal__intro">فروشگاه اینترنتی {{ $fa_store_name }} این امکان را برای
            فروشنده فراهم
            کرده
            تا کالایش را با برند (نام
            تجاری) خودش نمایش دهد و به فروش برساند. برای ایجاد و ثبت برندتان، فرم زیر را تکمیل
            کنید.
          </div>
          <div class="c-content-modal__notes">
            <span class="c-content-modal__notes-title">توجه:</span>
            <ul class="c-content-modal__notes-list">
              <li>نام برند مورد نظرتان را وارد کنید و درصورتی‌که برند را در این لیست پیدا
                نکردید، در صفحه‌ی درخواست برند، برند مورد نظرتان را جست‌و‌جو کرده و در صورت
                یافتن آن، روی دکمه‌ی افزودن برند به گروه کالایی کلیک کنید.
              </li>
              <li>چنانچه، برند مورد نظر در این لیست وجود نداشت، برای ساخت برند جدید، اطلاعات ذکر
                شده در این صفحه را ارسال کنید.
              </li>
              <li class="c-content-modal__notes-item">- برندهای ایرانی باید گواهی ثبت علامت
                تجاری
                داشته باشند و تصویر آن را باید همراه با
                درخواست در فرم ارسال فرمایید.
              </li>
              <li class="c-content-modal__notes-item">- برندهای ایرانی که دارای گواهی ثبت علامت
                تجاری
                نیستند، ثبت نمی‌شوند.
              </li>
              <li class="c-content-modal__notes-item">- برای ثبت برند، اظهار نامه‌ قابل قبول
                نیست و
                حتما باید گواهی ثبت برند را ارسال
                کنید.
              </li>
            </ul>
          </div>
          <div
            class="c-variant-error hidden c-variant-error__box c-variant-error__box--modal mt-20 mb-20"
            id="ajaxBrandErrorsList">
          </div>
          <div class="c-grid__row c-grid__row--gap-lg mt-30">
            <div
              class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6">
              <label for="" class="uk-form-label">
                نام فارسی برند:
                <span class="uk-form-label__required"></span>
              </label>
              <div class="field-wrapper c-autosuggest">
                <div class="search-form__autocomplete js-autosuggest-box">

                  <input id="searchKeywordInput" class="uk-input js-prevent-submit" type="text"
                         name="brand[name_fa]" placeholder="نام فارسی برند را وارد کنید …">
                  <ul class="c-autosuggest__list-container" style="display: none;"></ul>
                </div>
              </div>
            </div>
            <div
              class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6">
              <label for="" class="uk-form-label">
                نام انگلیسی برند:
                <span class="uk-form-label__required"></span>
              </label>
              <div class="field-wrapper c-autosuggest">
                <div class="search-form__autocomplete js-autosuggest-box">

                  <input id="searchKeywordInput" class="uk-input js-prevent-submit" type="text"
                         name="brand[name_en]" placeholder="عنوان انگلیسی برند …">
                  <ul class="c-autosuggest__list-container" style="display: none;"></ul>
                </div>
              </div>
            </div>
          </div>
          <div class="c-grid__row c-grid__row--gap-lg">
            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
              <label class="uk-form-label">
                شرح برند:
                <span class="uk-form-label__required"></span>
              </label>
              <div id="brandDescription" class="field-wrapper">
                                        <textarea name="brand[description]" class="uk-textarea" cols="" rows="3"
                                                  placeholder="توضیحات برند بهتر است بین ۷۰ تا ۱۰۰ کلمه درباره‌ی تاریخچه و محصولات برند باشد …"></textarea>
              </div>
            </div>
          </div>
          <div class="c-grid__row c-grid__row--gap-lg">
            <div
              class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--row-attr">
              <label class="uk-form-label">
                نوع برند:
                <span class="uk-form-label__required"></span>
              </label>
              <div id="brandOrigin" class="field-wrapper">
                <label class="c-ui-radio c-ui-radio--content c-ui-checkbox--auto">
                  <input type="radio" class="c-ui-radio__origin js-brand-origin"
                         name="brand[origin]" value="iranian" id="iranianBrandContainer"
                         checked="">
                  <span class="c-ui-radio__check c-ui-radio__check--content"></span>
                  <span class="c-ui-radio__label c-ui-radio__label--content">ایرانی</span>
                </label>
                <label class="c-ui-radio c-ui-radio--content c-ui-checkbox--auto">
                  <input type="radio" class="c-ui-radio__origin js-brand-origin"
                         name="brand[origin]" id="foreignBrandContainer" value="foreign">
                  <span class="c-ui-radio__check c-ui-radio__check--content"></span>
                  <span class="c-ui-radio__label c-ui-radio__label--content">خارجی</span>
                </label>
              </div>
            </div>
            <div id="foreignBrandContainer1"
                 class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--row-attr hidden">
              <label class="uk-form-label">
                لینک سایت معتبر خارجی:
                <span class="uk-form-label__required"></span>
              </label>
              <div class="field-wrapper">
                <input name="brand[url]" class="uk-input uk-input--ltr" placeholder="http://">
              </div>
            </div>
          </div>
          <div class="c-grid__row c-grid__row--gap-lg">
            <div id="iranianBrandContainer1"
                 class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--row-attr">
              <label class="uk-form-label">
                برگه ثبت برند یا لینک سایت قوه قضاییه:
                <span class="uk-form-label__required"></span>
              </label>
              <div class="field-wrapper">
                <div id="newBrandSheetUpload" for="brandRegistrationSheet"
                     class="c-content-modal__uploads-label empty">
                                <span uk-form-custom="" class="uk-form-custom">
                                    <input id="brandRegistrationSheet" type="file" class="hidden">
                                </span>
                  <label for="brandRegistrationSheet" class="c-content-modal__uploads-preview">
                    <img src="" id="newBrandSheetUploadPreview"
                         class="c-content-modal__uploads-img" alt="">
                    <span class="c-content-upload__img-loader js-img-loader">
                                        <span class="progress__wrapper">
                                            <span class="progress"></span>
                                        </span>
                                    </span>
                  </label>
                  <span class="c-content-modal__list c-content-modal__uploads-tooltips">
                                    <span class="c-content-modal__uploads-text">ابعاد
                                        برگه ثبت برند را با حداکثر حجم ۷۰۰ مگابایت و فرمت PNG یا JPEG  بارگذاری کنید.
                                    </span>
                                </span>
                </div>
                <input type="hidden" name="brand[registration_image_id]"
                       class="force-validation" id="registrationImageTempId">
                <div class="c-content-modal__errors-full"
                     id="newBrandRegistrationImageUploadErrors"></div>
              </div>
            </div>
            <div id="iranianBrandLogo"
                 class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--row-attr">
              <label class="uk-form-label">
                لوگوی برند:
                <span class="uk-form-label__required"></span>
              </label>
              <div class="field-wrapper">
                <div id="newBrandLogoUpload" class="c-content-modal__uploads-label empty">
                                <span uk-form-custom="" class="uk-form-custom">
                                    <input id="brandLogoFile" type="file" class="hidden">
                                </span>
                  <label for="brandLogoFile" class="c-content-modal__uploads-preview">
                    <img src="" id="newBrandLogoUploadPreview"
                         class="c-content-modal__uploads-img" alt="">
                    <span class="c-content-upload__img-loader js-img-loader">
                                        <span class="progress__wrapper">
                                            <span class="progress"></span>
                                        </span>
                                    </span>
                  </label>
                  <span class="c-content-modal__list c-content-modal__uploads-tooltips">
                                    <span class="c-content-modal__uploads-text">
                                        لوگو برند را در ابعاد ۶۰۰×۶۰۰ پیکسل و با فرمت PNG یا JPEG و پس‌زمینه‌ی سفید بارگذاری کنید.
                                    </span>
                                </span>
                </div>
                <input type="hidden" name="brand[logo_id]" class="force-validation"
                       id="logoImageTempId">
                <div class="c-content-modal__errors-full" id="newBrandLogoUploadErrors"></div>
              </div>
            </div>
            <div id="iranianBrandContainer2"
                 class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6">
              <label class="uk-form-label">
                یا لینک سایت قوه قضاییه را وارد کنید. لینک را به صورت کامل وارد کنید:
                <span class="uk-form-label__required"></span>
              </label>
              <div class="field-wrapper">
                <input name="brand[registration_url]" type="text" class="uk-input uk-input--ltr"
                       placeholder="http://" id="registrationUrlValue">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="c-content-modal__footer c-content-modal__footer--overflow">
        <button
          class="modal-footer__btn modal-footer__btn--confirm modal-footer__btn--wide js-modal-uploads-confirm js-accept"
          type="button" id="saveBrandRequestButton">
          <span id="brandSuggestBtnLabel">افزودن برند به گروه کالایی</span>
          <span id="brandRequestBtnLabel">ارسال درخواست</span>
        </button>
        <button class="modal-footer__btn modal-footer__btn--wide" type="button"
                id="resetBrandRequestBtn">انتخاب مجدد
        </button>
        <button class="modal-footer__btn modal-footer__btn--wide uk-modal-close js-decline"
                type="button" id="cancelBrandRequestButton">انصراف
        </button>
      </div>
    </form>
    <div class="c-content-loader">
      <div class="c-content-loader__logo"></div>
      <div class="c-content-loader__spinner"></div>
    </div>
  </div>
</div>
