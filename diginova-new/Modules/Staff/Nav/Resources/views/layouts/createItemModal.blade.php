<div id="newAttributeRequestModal" class="marketplace-redesign uk-modal c-variant" uk-modal="" style="display: none;">
  <div class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body c-content-modal" id="newBrandRequestModalContent">
    <button class="uk-modal-close uk-modal-close--search uk-close uk-icon" type="button" uk-close="">
    </button>
    <form id="newNanRequestForm" novalidate="novalidate">
      <div class="c-content-modal__header c-content-modal__header--overflow">
        <h3 class="c-content-modal__title">ایجاد منو جدید</h3>
      </div>
      <div class="c-content-modal__body c-content-modal__body--overflow">
        <div class="c-content-modal__body-container">

          <div class="c-content-modal__notes uk-hidden">
            <span class="c-content-modal__notes-title">توجه:</span>
            <ul class="c-content-modal__notes-list">
              <li>نام برند مورد نظرتان را وارد کنید و درصورتی‌که برند را در این لیست پیدا نکردید، در صفحه‌ی درخواست برند، برند مورد نظرتان را جست‌و‌جو کرده و در صورت یافتن آن، روی دکمه‌ی افزودن برند به گروه کالایی کلیک کنید.</li>
            </ul>
          </div>
          <div class="c-variant-error hidden c-variant-error__box c-variant-error__box--modal mt-20 mb-20" id="ajaxBrandErrorsList"></div>

          <div class="c-grid__row c-grid__row--gap-lg mt-30">
            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6">
              <label for="" class="uk-form-label">نام مگامنو:<span class="uk-form-label__required"></span>
              </label>
              <div class="field-wrapper c-autosuggest">
                <div class="search-form__autocomplete js-autosuggest-box">
                  <input class="uk-input js-prevent-submit" type="text" name="megamenu_name" placeholder="نام مگامنو را وارد کنید ...">
                  <ul class="c-autosuggest__list-container" style="display: none;"></ul>
                </div>
              </div>
            </div>
            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6">
              <label for="" class="uk-form-label">لینک:</label>
              <div class="field-wrapper c-autosuggest">
                <div class="search-form__autocomplete js-autosuggest-box">
                  <input name="megamenu_link" type="text" class="uk-input uk-input--ltr" placeholder="http://" id="registrationUrlValue">
                  <ul class="c-autosuggest__list-container" style="display: none;"></ul>
                </div>
              </div>
            </div>
          </div>

          <label class="uk-form-label" style="visibility: hidden">
            نوع منو:
            <span class="uk-form-label__required"></span>
          </label>

          <div id="iranianBrandLogo" class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial
           c-grid__col--lg-6 c-grid__col--row-attr">
            <label class="uk-form-label">
              آیکون منو: (اختیاری)
            </label>
            <div class="field-wrapper">
              <div id="iconUpload" class="c-content-modal__uploads-label empty">
                <span uk-form-custom="" class="uk-form-custom">
                    <input id="brandLogoFile" type="file" class="hidden">
                </span>
                <label for="brandLogoFile" class="c-content-modal__uploads-preview">
                  <img src="" id="iconUploadPreview" class="c-content-modal__uploads-img" alt="">
                  <span class="c-content-upload__img-loader js-img-loader">
                      <span class="progress__wrapper">
                          <span class="progress"></span>
                      </span>
                  </span>
                </label>
                <span class="c-content-modal__list c-content-modal__uploads-tooltips">
                    <span class="c-content-modal__uploads-text">آیکون منو را در نسبت ۱ در ۱ بارگذاری کنید.</span>
                </span>
              </div>
              <input type="hidden" name="logo_id" class="force-validation" id="iconImageTempId" value="">
              <div class="c-content-modal__errors-full" id="iconUploadErrors"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="c-content-modal__footer c-content-modal__footer--overflow">
        <button class="modal-footer__btn modal-footer__btn--confirm modal-footer__btn--wide js-modal-uploads-confirm js-accept save-btn" type="button" id="saveBrandRequestButton">
          <span id="brandRequestBtnLabel">ایجاد مگا‌منو جدید</span>
        </button>
        <button class="modal-footer__btn modal-footer__btn--wide uk-close uk-modal-close js-decline" type="button" id="cancelBrandRequestButton">انصراف</button>
      </div>
    </form>

    <div class="c-content-loader">
      <div class="c-content-loader__logo"></div>
      <div class="c-content-loader__spinner"></div>
    </div>

  </div>
</div>

