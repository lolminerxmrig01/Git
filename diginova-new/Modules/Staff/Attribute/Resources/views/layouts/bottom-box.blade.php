<div class="content-section"></div>
<div id="newAttributeRequestModal" class="marketplace-redesign uk-modal c-variant"
    uk-modal="" style="display: none;">
    <div class="uk-modal-dialog uk-modal-dialog--confirm uk-modal-body c-content-modal" id="newBrandRequestModalContent">
        <button class="uk-modal-close uk-modal-close--search uk-close uk-icon" type="button" uk-close=""></button>
        <form id="newBrandRequestForm" novalidate="novalidate">
            <input type="hidden" name="brand[product_id]" value="">
            <input type="hidden" name="brand[category_id]" id="newBrandRequestCategoryIdContainer">
            <div class="c-content-modal__header c-content-modal__header--overflow">
                <h3 class="c-content-modal__title">ایجاد گروه ویژگی جدید</h3>
            </div>
            <div class="c-content-modal__body c-content-modal__body--overflow">
                <div class="c-content-modal__body-container">
                    <div class="c-content-modal__intro">
                        از این بخش می‌توانید گروه ویژگی ایجاد کنید.
                         هدف از ایجاد گروه های ویژگی ارائه 
                         اطلاعات جزئی محصول به مشتریان است.
                    </div>
                    <div class="c-content-modal__notes">
                        <span class="c-content-modal__notes-title">توجه:</span>
                        <ul class="c-content-modal__notes-list">
                            <li>
                                پس از ایجاد گروه ویژگی برای افزودن ویژگی به آن،
                                 از طریق همین صفحه بر روی دکمه ویرایش کلیک کنید.
                            </li>
                        </ul>
                    </div>

                    <form id="attr-group">
                        <div class="c-grid__row c-grid__row--gap-lg mt-30">
                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12">
                                <label for="" class="uk-form-label">نام گروه ویژگی
                                  <span class="uk-form-label__required"></span>
                                </label>
                                <div class="field-wrapper c-autosuggest">
                                    <div class="search-form__autocomplete js-autosuggest-box">
                                        <input id="searchKeywordInput" class="uk-input js-prevent-submit" 
                                            type="text" name="attr_name" placeholder="نام گروه ویژگی را وارد کنید ...">
                                      <ul class="c-autosuggest__list-container" style="display: none;"></ul>
                                    </div>
                                    <div id="name-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="c-grid__row c-grid__row--gap-lg">
                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
                                <label class="uk-form-label">توضیحات (اختیاری)</label>
                                <div id="brandDescription" class="field-wrapper">
                                    <textarea name="attr_desc" class="uk-textarea" cols="" rows="3"
                                     placeholder="توضیحات گروه ویژگی را در صورت تمایل وارد کنید ..."></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="c-content-modal__footer c-content-modal__footer--overflow">
                <button class="modal-footer__btn modal-footer__btn--confirm modal-footer__btn--wide
                    js-modal-uploads-confirm js-accept save-btn" type="button" id="saveBrandRequestButton">
                    <span id="brandRequestBtnLabel">ایجاد گروه ویژگی</span>
                </button>
                <button class="modal-footer__btn modal-footer__btn--wide uk-close uk-modal-close js-decline"
                 type="button" id="cancelBrandRequestButton">انصراف</button>
            </div>
        </form>
        <div class="c-content-loader">
            <div class="c-content-loader__logo"></div>
            <div class="c-content-loader__spinner"></div>
        </div>
    </div>
</div>

<div uk-modal="esc-close: true; bg-close: true;" class="uk-modal-container uk-modal-container--message 
    js-common-modal-notification uk-modal" style="display: none;">
    <div class="uk-modal-dialog uk-modal-dialog--flex">
        <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""></button>
        <div class="uk-modal-body">
            <div class="c-modal-notification">
                <div class="c-modal-notification__content c-modal-notification__content--limited">
                    <h2 class="c-modal-notification__header">هشدار</h2>
                    <p class="c-modal-notification__text">
                        با حذف این گروه، تمامی گزینه‌ها و 
                        اطلاعات موجود در آن که در محصولات دسته مرتبط 
                        درج شده اند به صورت کامل حذف خواهند شد. 
                        آیا از حذف کامل آن اطمینان دارید؟
                    </p>
                    <div class="c-modal-notification__actions">
                        <button class="c-modal-notification__btn no uk-modal-close">خیر</button>
                        <button class="c-modal-notification__btn c-modal-notification__btn--secondary
                         yes uk-modal-close">بله</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
