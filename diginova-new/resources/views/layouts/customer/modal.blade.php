<div class="remodal c-remodal-account" data-remodal-id="login" role="dialog"
     aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
    <div class="c-remodal-account__headline">ورود به دیجی‌کالا</div>
    <div class="c-remodal-account__content">
        <form class="c-form-account" id="loginFormModal">
            <div class="c-message-light c-message-light--info" id="login-form-msg"></div>
            <div class="c-form-account__title">پست الکترونیک یا شماره موبایل</div>
            <div class="c-form-account__row">
                <div class="c-form-account__col">
                    <label class="c-ui-input c-ui-input--account-login">
                        <input class="c-ui-input__field" type="text" name="login[email_phone]"
                            autocomplete="current-email" placeholder="{{ $settings->where('name', 'store_email')->first()->value }}">
                    </label>
                </div>
            </div>
            <div class="c-form-account__title">کلمه عبور</div>
            <div class="c-form-account__row">
                <div class="c-form-account__col">
                    <label class="c-ui-input c-ui-input--account-password">
                        <input class="c-ui-input__field" name="login[password]" type="password"
                            autocomplete="current-password" placeholder="">
                    </label>
                </div>
            </div>
            <div class="c-form-account__agree">
                <label class="c-ui-checkbox c-ui-checkbox--primary">
                    <input type="checkbox" value="1" name="login[remember]" id="accountAutoLogin">
                    <span class="c-ui-checkbox__check"></span>
                </label>
                <label for="accountAutoLogin">
                    مرا به خاطر داشته باش
                </label>
            </div>
            <div class="c-form-account__row c-form-account__row--submit">
                <div class="c-form-account__col">
                    <button class="btn-login login-button-js">
                        ورود به دیجی‌کالا
                    </button>
                </div>
            </div>
            <div class="c-form-account__link">
                <a data-snt-event="dkLoginClick" data-snt-params='{"type":"forgetPassword","site":"login-modal"}'
                    href="/users/password/forgot/" class="btn-link-spoiler">
                    رمز عبور خود را فراموش کرده‌ام
                </a>
            </div>
            <div class="c-message-light c-message-light--error has-oneline" id="loginFormError">نام کاربری
                یا کلمه عبور اشتباه است.
            </div>
        </form>
    </div>
    <div class="c-remodal-account__footer is-highlighted">
        <span>کاربر جدید هستید؟</span>
        <a data-snt-event="dkLoginClick" data-snt-params='{"type":"signup","site":"login-modal"}'
           href="/users/login-register/?_back=https://www.digikala.com/profile/addresses/" class="btn-link-spoiler">
            ثبت‌نام در دیجی‌کالا
        </a>
    </div>
</div>

<div class="remodal c-remodal-loader" data-remodal-id="loader"
     data-remodal-options="hashTracking: false, closeOnOutsideClick: false"
     role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <div class="c-remodal-loader__icon"></div>
    <div class="c-remodal-loader__bullets">
        <i class="c-remodal-loader__bullet c-remodal-loader__bullet--1"></i>
        <i class="c-remodal-loader__bullet c-remodal-loader__bullet--2"></i>
        <i class="c-remodal-loader__bullet c-remodal-loader__bullet--3"></i>
        <i class="c-remodal-loader__bullet c-remodal-loader__bullet--4"></i>
    </div>
</div>

<div class="remodal c-remodal-general-alert" data-remodal-id="alert"
     role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <div class="c-remodal-general-alert__main">
        <div class="c-remodal-general-alert__content">
            <p class="js-remodal-general-alert__text"></p>
            <p class="c-remodal-general-alert__description js-remodal-general-alert__description"></p>
        </div>
        <div class="c-remodal-general-alert__actions">
            <button class="c-remodal-general-alert__button c-remodal-general-alert__button--approve
                js-remodal-general-alert__button--approve"></button>
            <button class="c-remodal-general-alert__button c-remodal-general-alert__button--cancel
                js-remodal-general-alert__button--cancel"></button>
        </div>
    </div>
</div>

<div class="remodal c-remodal-general-information" data-remodal-id="information" role="dialog"
     aria-labelledby="modal1Title"
     aria-describedby="modal1Desc">
    <div class="c-remodal-general-information__main">
        <div class="c-remodal-general-information__content">
            <p class="js-remodal-general-information__text"></p>
        </div>
        <div class="c-remodal-general-information__actions">
            <button class="c-remodal-general-information__button
             c-remodal-general-information__button--approve
             js-remodal-general-information__button--approve"></button>
        </div>
    </div>
</div>

<div class="remodal c-remodal c-remodal-quick-view"
     data-remodal-id="quick-view" role="dialog"
     aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close c-remodal__close" aria-label="Close"></button>
    <div class="c-quick-view__content js-quick-view-section"></div>
</div>

<div class="c-toast__container js-toast-container">
    <div class="c-toast js-toast" style="display: none">
        <div class="c-toast__text js-toast-text"></div>
        <div class="c-toast__btn-container">
            <button type="button" class="js-toast-btn o-link o-link--sm o-link--no-border o-btn">
                متوجه شدم
            </button>
        </div>
    </div>
</div>

<div class="remodal c-remodal-location js-general-location" data-remodal-id="general-location"
     role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <div class="c-remodal-location__header">
        <span class="js-general-location-title">انتخاب استان</span>
        <div class="c-remodal-location__close js-close-modal"></div>
    </div>
    <div class="c-remodal-location__content js-states-container">
        <div class="c-general-location__row c-general-location__row--your-location js-your-location">
            مکان‌یابی خودکار
        </div>
    </div>
    <div class="c-remodal-location__content js-cities-container">
        <div class="c-general-location__row c-general-location__row--back js-back-to-states">
            بازگشت به لیست استان‌ها
        </div>
    </div>
</div>

<div class="remodal c-remodal-location c-remodal-location--addresses js-general-location-addresses"
     data-remodal-id="general-location" role="dialog" aria-labelledby="modal1Title"
     aria-describedby="modal1Desc">
    <div class="c-remodal-location__header">
        <span class="js-general-location-title">انتخاب آدرس</span>
        <div class="c-remodal-location__close js-close-modal"></div>
    </div>
    <div class="c-remodal-location__content js-addresses-container">
        <div class="c-ui-radio-wrapper c-ui-radio--general-location js-sample-address u-hidden">
            <label class="c-filter__label " for="generalLocationAddress"></label>
            <label class="c-ui-radio">
                <input type="radio" value="" name="generalLocationAddress" class=""
                    id="generalLocationAddress" data-title="">
                <span class="c-ui-radio__check"></span>
            </label>
        </div>
        <a href="/addresses/add/" class="c-general-location__add-address js-general-location-add-address">
            افزودن آدرس جدید
        </a>
    </div>
</div>

<div class="remodal-overlay remodal-is-closed" style="display: none;"></div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div aria-describedby="modalDesc" aria-labelledby="modalTitle"
         class="remodal c-modal c-u-minicart__modal u-hidden
         js-minicart-modal remodal-is-initialized remodal-is-closed"
         data-remodal-id="universal-mini-cart" data-remodal-options=""
         role="dialog" tabindex="-1">
        <div class="c-modal__top-bar ">
            <div>
                <div class="c-u-minicart__quantity">
                    سبد خرید
                    <span>۰ کالا</span>
                </div>
                <a class="o-link o-link--has-arrow o-link--no-border o-link--sm" href="/cart/">مشاهده سبد خرید</a>
            </div>
            <div class="c-modal__close" data-remodal-action="close"></div>
        </div>
        <div class="c-u-minicart"></div>
        <div class="c-modal__footer">
            <div class="c-header__cart-info-total">
                <span class="c-header__cart-info-total-text">مبلغ قابل پرداخت</span>
                <p class="c-header__cart-info-total-amount">
                    <span class="c-header__cart-info-total-amount-number"> ۰</span>
                    <span> تومان</span>
                </p>
            </div>
            <div>
                <a class="o-btn o-btn--contained-red-md"
                   data-snt-event="dkHeaderClick" href="/shipping/"
                   data-snt-params="{&quot;item&quot;:&quot;mini-cart&quot;,&quot;item_option&quot;:&quot;confirm-cart&quot;}">
                    ثبت سفارش
                </a>
            </div>
        </div>
    </div>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div aria-describedby="modalDesc" aria-labelledby="modalTitle"
         class="remodal c-modal c-modal--sm remodal-is-initialized remodal-is-closed" data-remodal-id="share"
         data-remodal-options="" role="dialog" tabindex="-1">
        <div class="c-modal__top-bar c-modal__top-bar--has-line">
            <div class="c-modal__title ">اشتراک‌گذاری</div>
            <div class="c-modal__close" data-remodal-action="close"></div>
        </div>
        <form class="c-share" id="share-public-list-modal">
            <div class="c-share__title">
                با استفاده از روش‌های زیر می‌توانید این لیست را با دوستان خود به اشتراک بگذارید.
            </div>
            <div class="c-share__options">
                <div class="c-share__social-buttons">
                    <a class="js-twitter o-btn c-share__social c-share__social--twitter" href=""
                        rel="nofollow" target="_blank"></a>
                    <a class="js-whatsapp o-btn c-share__social c-share__social--whatsapp"
                        href="" rel="nofollow" target="_blank"></a>
                    <a class="js-facebook o-btn c-share__social c-share__social--fb" href=""
                        rel="nofollow" target="_blank"></a>
                </div>
                <div class="js-share-value o-btn o-btn--outlined-gray-sm o-btn--copy
                    c-share__link-btn js-copy-url" data-copy="">
                    کپی لینک
                </div>
            </div>
        </form>
    </div>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div aria-describedby="modal1Desc" aria-labelledby="modal1Title"
         class="remodal c-remodal-avatar remodal-is-initialized remodal-is-closed"
         data-remodal-id="avatar-modal" role="dialog" tabindex="-1">
        <button aria-label="Close" class="remodal-close" data-remodal-action="close"></button>
        <div class="c-remodal-avatar__main">
            <div class="c-remodal-avatar__content">
                <div class="c-remodal-avatar__title">تغییر نمایه کاربری شما</div>
                <ul class="c-profile-avatars">
                    <li class="js-change-user-avatar is-active" data-avatar-id="default">
                        <span class="c-profile-avatars__item" style="background-image: url(https://www.digikala.com/static/files/fd4840b2.svg)"></span>
                    </li>
                    <li class="js-change-user-avatar" data-avatar-id="avatar_01">
                        <span class="c-profile-avatars__item" style="background-image: url(https://www.digikala.com/static/files/df110dcf.svg)"></span>
                    </li>
                    <li class="js-change-user-avatar" data-avatar-id="avatar_02">
                        <span class="c-profile-avatars__item" style="background-image: url(https://www.digikala.com/static/files/b5f7d7b8.svg)"></span>
                    </li>
                    <li class="js-change-user-avatar" data-avatar-id="avatar_03">
                        <span class="c-profile-avatars__item" style="background-image: url(https://www.digikala.com/static/files/e8e1a8b5.svg)"></span>
                    </li>
                    <li class="js-change-user-avatar" data-avatar-id="avatar_04">
                        <span class="c-profile-avatars__item" style="background-image: url(https://www.digikala.com/static/files/a5a6ccef.svg)"></span>
                    </li>
                    <li class="js-change-user-avatar" data-avatar-id="avatar_05">
                        <span class="c-profile-avatars__item" style="background-image: url(https://www.digikala.com/static/files/6cdbab30.svg)"></span>
                    </li>
                    <li class="js-change-user-avatar" data-avatar-id="avatar_06">
                        <span class="c-profile-avatars__item" style="background-image: url(https://www.digikala.com/static/files/2a5b1e32.svg)"></span>
                    </li>
                    <li class="js-change-user-avatar" data-avatar-id="avatar_07">
                        <span class="c-profile-avatars__item" style="background-image: url(https://www.digikala.com/static/files/61f2d6e4.svg)"></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div aria-describedby="modal1Desc" aria-labelledby="modal1Title"
         class="remodal c-remodal-account remodal-is-initialized remodal-is-closed"
         data-remodal-id="login" role="dialog" tabindex="-1">
        <button aria-label="Close" class="remodal-close" data-remodal-action="close"></button>
        <div class="c-remodal-account__headline">
            ورود به دیجی‌کالا
        </div>
        <div class="c-remodal-account__content">
            <form class="c-form-account" id="loginFormModal" novalidate="novalidate">
                <div class="c-message-light c-message-light--info" id="login-form-msg"></div>
                <div class="c-form-account__title">
                    پست الکترونیک یا شماره موبایل
                </div>
                <div class="c-form-account__row">
                    <div class="c-form-account__col">
                        <label class="c-ui-input c-ui-input--account-login">
                            <input autocomplete="current-email" class="c-ui-input__field" name="login[email_phone]"
                               placeholder="{{ $settings->where('name', 'store_email')->first()->value }}" type="text">
                        </label>
                    </div>
                </div>
                <div class="c-form-account__title">کلمه عبور</div>
                <div class="c-form-account__row">
                    <div class="c-form-account__col">
                        <label class="c-ui-input c-ui-input--account-password">
                            <input autocomplete="current-password" class="c-ui-input__field"
                               name="login[password]" type="password">
                        </label>
                    </div>
                </div>
                <div class="c-form-account__agree">
                    <label class="c-ui-checkbox c-ui-checkbox--primary">
                        <input id="accountAutoLogin" name="login[remember]"
                            type="checkbox" value="1">
                        <span class="c-ui-checkbox__check"></span>
                    </label>
                    <label for="accountAutoLogin">
                        مرا به خاطر داشته باش
                    </label>
                </div>
                <div class="c-form-account__row c-form-account__row--submit">
                    <div class="c-form-account__col">
                        <button class="btn-login login-button-js">
                            ورود به دیجی‌کالا
                        </button>
                    </div>
                </div>
                <div class="c-form-account__link">
                    <a class="btn-link-spoiler" data-snt-event="dkLoginClick"
                        data-snt-params="{&quot;type&quot;:&quot;forgetPassword&quot;,&quot;site&quot;:&quot;login-modal&quot;}"
                             href="/users/password/forgot/">
                        رمز عبور خود را فراموش کرده‌ام
                    </a>
                </div>
                <div class="c-message-light c-message-light--error has-oneline" id="loginFormError">
                    نام کاربری یا کلمه عبور اشتباه است.
                </div>
            </form>
        </div>
        <div class="c-remodal-account__footer is-highlighted">
            <span>کاربر جدید هستید؟</span>
            <a class="btn-link-spoiler" data-snt-event="dkLoginClick"
               data-snt-params="{&quot;type&quot;:&quot;signup&quot;,&quot;site&quot;:&quot;login-modal&quot;}"
               href="/users/login-register/?_back=https://www.digikala.com/profile/favorites/">
                ثبت‌نام در دیجی‌کالا
            </a>
        </div>
    </div>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div aria-describedby="modal1Desc" aria-labelledby="modal1Title"
         class="remodal c-remodal-loader remodal-is-initialized remodal-is-closed" data-remodal-id="loader"
         data-remodal-options="hashTracking: false, closeOnOutsideClick: false" role="dialog" tabindex="-1">
        <div class="c-remodal-loader__icon"></div>
        <div class="c-remodal-loader__bullets">
            <i class="c-remodal-loader__bullet c-remodal-loader__bullet--1"></i>
            <i class="c-remodal-loader__bullet c-remodal-loader__bullet--2"></i>
            <i class="c-remodal-loader__bullet c-remodal-loader__bullet--3"></i>
            <i class="c-remodal-loader__bullet c-remodal-loader__bullet--4"></i>
        </div>
    </div>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div aria-describedby="modal1Desc" aria-labelledby="modal1Title"
         class="remodal c-remodal-general-alert remodal-is-initialized remodal-is-closed"
         data-remodal-id="alert" role="dialog" tabindex="-1">
        <div class="c-remodal-general-alert__main">
            <div class="c-remodal-general-alert__content">
                <p class="js-remodal-general-alert__text">
                    آیا مطمئنید که این محصول از لیست مورد علاقه شما حذف شود؟
                </p>
                <p class="c-remodal-general-alert__description js-remodal-general-alert__description" style="display: none;">
                </p>
            </div>
            <div class="c-remodal-general-alert__actions">
                <button class="c-remodal-general-alert__button c-remodal-general-alert__button--approve
                     js-remodal-general-alert__button--approve">
                    بله
                </button>
                <button class="c-remodal-general-alert__button c-remodal-general-alert__button--cancel
                    js-remodal-general-alert__button--cancel">
                    خیر
                </button>
            </div>
        </div>
    </div>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div aria-describedby="modal1Desc" aria-labelledby="modal1Title"
         class="remodal c-remodal-general-information remodal-is-initialized remodal-is-closed"
         data-remodal-id="information" role="dialog" tabindex="-1">
        <div class="c-remodal-general-information__main">
            <div class="c-remodal-general-information__content">
                <p class="js-remodal-general-information__text"></p>
            </div>
            <div class="c-remodal-general-information__actions">
                <button class="c-remodal-general-information__button
                 c-remodal-general-information__button--approve
                 js-remodal-general-information__button--approve">
                </button>
            </div>
        </div>
    </div>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div aria-describedby="modal1Desc" aria-labelledby="modal1Title"
         class="remodal c-remodal c-remodal-quick-view remodal-is-initialized remodal-is-closed"
         data-remodal-id="quick-view" role="dialog" tabindex="-1">
        <button aria-label="Close" class="remodal-close c-remodal__close" data-remodal-action="close"></button>
        <div class="c-quick-view__content js-quick-view-section"></div>
    </div>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div aria-describedby="modal1Desc" aria-labelledby="modal1Title"
         class="remodal c-remodal-location js-general-location remodal-is-initialized remodal-is-closed"
         data-remodal-id="general-location" role="dialog" tabindex="-1">
        <div class="c-remodal-location__header">
            <span class="js-general-location-title">انتخاب استان</span>
            <div class="c-remodal-location__close js-close-modal"></div>
        </div>
        <div class="c-remodal-location__content js-states-container">
            <div class="c-general-location__row c-general-location__row--your-location js-your-location">
                مکان‌یابی خودکار
            </div>
        </div>
        <div class="c-remodal-location__content js-cities-container" style="display: none;">
            <div class="c-general-location__row c-general-location__row--back js-back-to-states">
                بازگشت به لیست استان‌ها
            </div>
        </div>
    </div>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div aria-describedby="modal1Desc" aria-labelledby="modal1Title"
        class="remodal c-remodal-location c-remodal-location--addresses
         js-general-location-addresses remodal-is-initialized remodal-is-closed"
        data-remodal-id="general-location" role="dialog" tabindex="-1">
        <div class="c-remodal-location__header">
            <span class="js-general-location-title">انتخاب آدرس</span>
            <div class="c-remodal-location__close js-close-modal"></div>
        </div>
        <div class="c-remodal-location__content js-addresses-container">
            <div class="c-ui-radio-wrapper c-ui-radio--general-location js-sample-address u-hidden">
                <label class="c-filter__label " for="generalLocationAddress"></label>
                <label class="c-ui-radio">
                    <input class="" data-title="" id="generalLocationAddress"
                        name="generalLocationAddress" type="radio" value="">
                    <span class="c-ui-radio__check"></span>
                </label>
            </div>
            <a class="c-general-location__add-address js-general-location-add-address" href="/addresses/add/">
                افزودن آدرس جدید
            </a>
        </div>
    </div>
</div>

<div class="remodal-overlay remodal-is-closed" style="display: none;"></div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div class="remodal c-modal c-u-minicart__modal u-hidden js-minicart-modal
        remodal-is-initialized remodal-is-closed" data-remodal-id="universal-mini-cart"
         role="dialog" aria-labelledby="modalTitle" tabindex="-1"
         aria-describedby="modalDesc" data-remodal-options="">
        <div class="c-modal__top-bar ">
            <div>
                <div class="c-u-minicart__quantity">
                    سبد خرید
                    <span>۰ کالا</span>
                </div>
                <a href="/cart/" class="o-link o-link--has-arrow o-link--no-border o-link--sm">
                    مشاهده سبد خرید
                </a>
            </div>
            <div class="c-modal__close" data-remodal-action="close"></div>
        </div>
        <div class="c-u-minicart"></div>
        <div class="c-modal__footer">
            <div class="c-header__cart-info-total">
                <span class="c-header__cart-info-total-text">مبلغ قابل پرداخت</span>
                <p class="c-header__cart-info-total-amount">
                    <span class="c-header__cart-info-total-amount-number"> ۰</span>
                    <span> تومان</span>
                </p>
            </div>
            <div>
                <a data-snt-event="dkHeaderClick" href="/shipping/" class="o-btn o-btn--contained-red-md"
                   data-snt-params="{&quot;item&quot;:&quot;mini-cart&quot;,&quot;item_option&quot;:&quot;confirm-cart&quot;}">
                    ثبت سفارش
                </a>
            </div>
        </div>
    </div>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div class="remodal c-modal c-modal--sm js-personal-info-modal remodal-is-initialized remodal-is-closed"
         data-remodal-id="personal-info-mobile_phone-modal" role="dialog" aria-labelledby="modalTitle" tabindex="-1"
         aria-describedby="modalDesc" data-remodal-options="closeOnOutsideClick: false">
        <div class="c-modal__top-bar  c-modal__top-bar--has-line">
            <div class="c-modal__title ">شماره موبایل</div>
            <div class="c-modal__close" data-remodal-action="close"></div>
        </div>
        <form class="c-modal__content js-not-empty-parent js-personal-info-form js-phone-modal"
              id="personal-info-phone-form" novalidate="novalidate">
            <label class="o-form__field-container">
                <div class="o-form__field-frame">
                    <input name="additionalinfo[mobile_phone]" value="{{ $customer->mobile }}"
                       class="o-form__field js-input-field js-not-empty-input">
                </div>
            </label>
            <div class="c-modal__btn-container">
                <button class="o-btn o-btn--contained-blue-md disabled js-not-empty-btn disabled">
                    ارسال کد تایید
                </button>
            </div>
        </form>
    </div>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div class="remodal c-modal c-modal--sm js-personal-info-modal
         js-phone-verification-modal remodal-is-initialized remodal-is-closed"
        data-remodal-id="personal-info-phone-verification-modal" role="dialog"
         aria-labelledby="modalTitle" tabindex="-1" aria-describedby="modalDesc"
         data-remodal-options="closeOnOutsideClick: false">
        <div class="c-modal__top-bar  c-modal__top-bar--has-line">
            <div class="c-modal__title ">تایید شماره موبایل</div>
            <div class="c-modal__close" data-remodal-action="close"></div>
        </div>
        <form class="c-modal__content js-confirm-phone-form">
            <div class="o-form__row">
                <div class="c-profile-personal__info">
                    کد تایید برای شماره موبایل
                    <span class="js-changed-phone-number"></span>
                    ارسال گردید.
                </div>
            </div>
            <div class="o-form__row">
                <div class="o-form__field-container">
                    <label class="c-profile-personal__verify-phone-container o-form__field-frame">
                        <input name="confirm[code]" class="c-profile-personal__verify-phone-input
                            js-verify-phone-input js-persian-digit-input" type="text" maxlength="5">
                        <div class="c-profile-personal__verify-phone-input-hider"></div>
                    </label>
                </div>
            </div>
            <div class="c-form__row">
                <div class="js-phone-code-container">
                    <div class="c-profile-personal__verify-phone-text">ارسال مجدد تا
                        <span class="js-phone-code-counter" data-countdownseconds=""></span>
                        ثانیه دیگر
                    </div>
                </div>
                <a href="#" class="c-profile-personal__verify-phone-text u-hidden js-send-confirm-code">
                    دریافت مجدد کد تایید
                </a>
            </div>
        </form>
    </div>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div class="remodal c-modal c-modal--sm js-personal-info-modal remodal-is-initialized remodal-is-closed"
         data-remodal-id="personal-info-reset_password-modal" role="dialog" aria-labelledby="modalTitle" tabindex="-1"
         aria-describedby="modalDesc" data-remodal-options="closeOnOutsideClick: false">
        <div class="c-modal__top-bar  c-modal__top-bar--has-line">
            <div class="c-modal__title ">ویرایش رمز عبور</div>
            <div class="c-modal__close" data-remodal-action="close"></div>
        </div>
        <form class="c-modal__content js-not-empty-parent js-change-password-form"
              id="change-password-form"
              novalidate="novalidate">
            <div class="o-form__row">
                <div class="c-profile-personal__info">رمز عبور باید حداقل ۶ حرف باشد.</div>
            </div>
            <input class="u-hidden-visually">
            <div class="o-form__row">
                <label class="o-form__field-container">
                    <div class="o-form__field-label">رمز عبور فعلی</div>
                    <div class="o-form__field-frame">
                        <input name="changepassword[password_old]" type="password"
                            class="o-form__field js-input-field js-not-empty-input">
                    </div>
                </label>
            </div>
            <div class="o-form__row">
                <label class="o-form__field-container">
                    <div class="o-form__field-label">رمز عبور جدید</div>
                    <div class="o-form__field-frame">
                        <input name="changepassword[password]" type="password"
                           class="o-form__field js-input-field js-not-empty-input txtPassword">
                    </div>
                </label></div>
            <div class="o-form__row">
                <label class="o-form__field-container">
                    <div class="o-form__field-label">تکرار رمز عبور جدید</div>
                    <div class="o-form__field-frame">
                        <input name="changepassword[password2]" type="password"
                            class="o-form__field js-input-field js-not-empty-input">
                    </div>
                </label>
            </div>
            <div class="c-modal__btn-container">
                <button type="submit" class="o-btn o-btn--contained-blue-md js-not-empty-btn disabled">ثبت</button>
            </div>
        </form>
    </div>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div class="remodal c-modal c-modal--xs c-profile-iban js-personal-info-modal remodal-is-initialized remodal-is-closed"
        data-remodal-id="personal-info-bank_card_number-modal" role="dialog" aria-labelledby="modalTitle" tabindex="-1"
        aria-describedby="modalDesc" data-remodal-options="closeOnOutsideClick: false">
        <div class="c-modal__top-bar  c-modal__top-bar--has-line">
            <div class="c-modal__title ">اطلاعات حساب بانکی برای بازگرداندن وجه</div>
            <div class="c-modal__close" data-remodal-action="close"></div>
        </div>
        <div class="c-modal__content js-destination-state">
            <p class="c-profile-iban__dsc">
                لطفا روش بازگرداندن وجوه خود را انتخاب نمایید.
            </p>
            <div>
                <div class="c-profile-iban__dest-row">
                    <label class="c-outline-radio">
                        <input type="radio" class="js-destination-selector-input"
                               id="iban-destination" data-has-iban="0" data-iban=""
                              name="refund-destination-selector" value="iban">
                        <span class="c-outline-radio__check">
                        </span>
                    </label>
                    <label class="c-profile-iban__credit-card-title" for="iban-destination">
                        <span class="c-profile-iban__dest-title">
                          واریز به حساب بانکی
                      </span>
                        <span class="c-profile-iban__dest-dsc js-iban-dest-row-text u-hidden">
                          شماره شبا:
                      </span>
                        <button class="o-btn o-btn--left-icon js-edit-iban o-btn--link-blue-sm c-profile-iban__edit-iban u-hidden"
                                data-after-icon="Icon-Navigation-Chevron-Left" type="button">
                            ویرایش شماره شبا
                        </button>
                        <span class="c-profile-iban__dest-dsc js-iban-dest-row-dsc ">
                          در این روش، {{ $fa_store_name }} به شماره شبا حساب بانکی شما نیاز دارد.
                      </span>
                    </label>
                </div>
            </div>
        </div>

        <div class="c-modal__content js-card-number-state u-hidden">
            <p class="c-profile-iban__dsc">
                شماره کارت متصل به حسابی که می‌خواهید واریز وجه به آن انجام شود را وارد کنید
            </p>
            <div class="o-form__row js-credit-card-input">
                <label class="c-profile-personal__card-container">
                    <input class="c-profile-personal__card-input js-card-complete-input" maxlength="4">
                    <span class="c-profile-personal__card-separator">-</span>
                    <input class="c-profile-personal__card-input js-card-complete-input" maxlength="4">
                    <span class="c-profile-personal__card-separator">-</span>
                    <input class="c-profile-personal__card-input js-card-complete-input" maxlength="4">
                    <span class="c-profile-personal__card-separator">-</span>
                    <input class="c-profile-personal__card-input js-card-complete-input" maxlength="4">
                </label>
            </div>
            <div class="c-modal__btn-container">
                <button type="button" class="o-btn o-btn--contained-red-md disabled js-card-complete-btn">
                    ثبت کارت بانکی
                </button>
            </div>
        </div>

        <div class="c-modal__content o-text-right u-hidden js-iban-state">
            <p class="c-profile-iban__dsc">
                تبدیل شماره شبای کارت شما با خطا مواجه شد.
                لطفا شماره شبای خود را به صورت دستی وارد نمایید
            </p>
            <div>
                <div class="c-profile-iban__credit-data-row">
                    <span class="c-profile-iban__credit-card-number js-iban-credit-card-number"></span>
                    <span class="c-profile-iban__bank-logo">
                        <img class="js-iban-bank-image">
                    </span>
                </div>
                <div class="c-profile-iban__bank-title js-iban-bank-title"></div>
            </div>
            <form id="iban-input-form">
                <div class="c-profile-iban__input-row">
                    <label class="o-form__field-container">
                        <div class="o-form__field-frame">
                            <input name="ibanCodeInput" class="o-form__field js-input-field js-iban-input">
                        </div>
                    </label>
                </div>
            </form>
            <div class="o-hint o-hint--small o-hint--text o-hint--neutral">
                شماره شبا را به همراه IR و بدون فاصله وارد نمایید.
            </div>
            <div class="c-modal__btn-container">
                <button type="button" class="o-btn o-btn--contained-red-md disabled js-check-iban-button">
                    بررسی اطلاعات
                </button>
            </div>
        </div>
    </div>
</div>

<div class="remodal c-modal c-modal--sm c-modal--not-scroll js-personal-info-modal"
     data-remodal-id="personal-info-birth-modal"
     role="dialog" aria-labelledby="modalTitle"
     tabindex="-1z" aria-describedby="modalDesc"
     data-remodal-options="closeOnOutsideClick: false">
    <div class="c-modal__top-bar  c-modal__top-bar--has-line">
        <div class="c-modal__title ">تاریخ تولد</div>
        <div class="c-modal__close" data-remodal-action="close"></div>
    </div>

    <form class="c-modal__content js-not-empty-parent js-personal-info-form">
        <div class="o-form__row o-form__row--flex">
            <div class="o-form__field-container">
                <div class="o-form__field-label">سال</div>
                <select class="c-ui-select js-ui-select-search js-dropdown-universal js-not-empty-input"
                        name="additionalinfo[birth_year]">
                    <option value="">سال</option>
                    @for($i=1382; $i >= 1310; $i--)
                        <option value="{{ $i }}" {{ (isset($date[0]) && ($date[0] == $i))? 'selected' : ''  }}>
                            {{ persianNum($i) }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="o-form__field-container">
                <div class="o-form__field-label">ماه</div>
                <select class="c-ui-select js-ui-select-search js-dropdown-universal js-not-empty-input"
                    name="additionalinfo[birth_month]">
                    <option value="">ماه</option>
                    @php
                        $persianMonth = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'];
                    @endphp
                    @for($i=1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ (isset($date[1]) && ($date[1] == $i))? 'selected' : ''  }}>
                            {{ $persianMonth[$i-1] }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="o-form__field-container">
                <div class="o-form__field-label">روز</div>
                <select class="c-ui-select js-ui-select-search js-dropdown-universal js-not-empty-input"
                        name="additionalinfo[birth_day]">
                    <option value="">روز</option>
                    @for($i=1; $i <= 31; $i++)
                        <option value="{{ $i }}" {{ (isset($date[2]) && ($date[2] == $i))? 'selected' : ''  }}>
                            {{ persianNum($i) }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="c-modal__btn-container">
            <button type="submit" class="o-btn o-btn--contained-blue-md js-not-empty-btn disabled">
                ثبت تاریخ تولد
            </button>
        </div>
    </form>
</div>

<div class="remodal c-modal c-modal--sm js-personal-info-modal"
     data-remodal-id="personal-info-email-modal"
     role="dialog"
     aria-labelledby="modalTitle"
     tabindex="-1z"
     aria-describedby="modalDesc"
     data-remodal-options="closeOnOutsideClick: false">
    <div class="c-modal__top-bar  c-modal__top-bar--has-line">
        <div class="c-modal__title ">ایمیل</div>
        <div class="c-modal__close" data-remodal-action="close"></div>
    </div>

    <form class="c-modal__content js-not-empty-parent js-personal-info-form js-email-modal"
          id="personal-info-email-form">
        <label class="o-form__field-container">
            <div class="o-form__field-frame">
                <input name="additionalinfo[email]" value="mehdi.jalaliii03@gmail.com"
                    class="o-form__field js-input-field js-not-empty-input"/>
            </div>
        </label>
        <div class="c-modal__btn-container">
            <button type="submit" class="o-btn o-btn--contained-blue-md js-not-empty-btn disabled
                js-personal-info-email-submit">
                تایید
            </button>
        </div>
    </form>
</div>

<div class="remodal c-modal c-modal--sm js-verification-email-modal"
     data-remodal-id="personal-info-email-verification-modal"
     role="dialog"
     aria-labelledby="modalTitle"
     tabindex="-1z"
     aria-describedby="modalDesc"
     data-remodal-options="closeOnOutsideClick: false">
    <div class="c-modal__top-bar  c-modal__top-bar--has-line">
        <div class="c-modal__title ">ایمیل تایید ارسال شد</div>
        <div class="c-modal__close" data-remodal-action="close"></div>
    </div>
    <div class="c-modal__content">
        <div>
            <img src="https://www.digikala.com/static/files/ba53f9b1.svg"/>
        </div>
        <div class="c-modal__desc">
            لطفا به ایمیل خود مراجعه نموده و بر روی لینک ارسال‌شده کلیک کنید.
        </div>
        <div class="c-modal__btn-container">
            <button type="button" class="o-btn o-btn--outlined-blue-md" data-remodal-action="close">
                متوجه شدم
            </button>
        </div>
    </div>
</div>

<div class="remodal c-modal c-modal--sm js-personal-info-modal"
     data-remodal-id="personal-info-fullname-modal"
     role="dialog"
     aria-labelledby="modalTitle"
     tabindex="-1z"
     aria-describedby="modalDesc"
     data-remodal-options="closeOnOutsideClick: false">
    <div class="c-modal__top-bar  c-modal__top-bar--has-line">
        <div class="c-modal__title ">نام و نام خانوادگی</div>
        <div class="c-modal__close" data-remodal-action="close"></div>
    </div>
    <form class="c-modal__content js-not-empty-parent js-personal-info-form"
          id="personal-info-name-form" method="post">
        <div class="o-form__row">
            <label class="o-form__field-container">
                <div class="o-form__field-label">نام</div>
                <div class="o-form__field-frame">
                    <input name="additionalinfo[first_name]" value="{{ $customer->first_name }}"
                           class="o-form__field js-input-field js-not-empty-input"/>
                </div>
            </label>
        </div>
        <div class="o-form__row"><label class="o-form__field-container">
                <div class="o-form__field-label">نام خانوادگی</div>
                <div class="o-form__field-frame">
                    <input name="additionalinfo[last_name]" value="{{ $customer->last_name }}"
                       class="o-form__field js-input-field js-not-empty-input"/>
                </div>
            </label>
        </div>
        <div class="c-modal__btn-container">
            <button class="o-btn o-btn--contained-blue-md js-not-empty-btn disabled">
                ثبت اطلاعات
            </button>
        </div>
    </form>
</div>

<div class="remodal c-modal c-modal--sm js-personal-info-modal"
     data-remodal-id="personal-info-national_identity_number-modal"
     role="dialog" aria-labelledby="modalTitle"
     tabindex="-1z" aria-describedby="modalDesc"
     data-remodal-options="closeOnOutsideClick: false">
    <div class="c-modal__top-bar  c-modal__top-bar--has-line">
        <div class="c-modal__title ">کد ملی</div>
        <div class="c-modal__close" data-remodal-action="close"></div>
    </div>
    <form class="c-modal__content js-national-code-form" method="post" id="personal-info-national-id-form">
        <div class="o-form__row">
            <label class="o-form__field-container">
                <div class="o-form__field-frame">
                    <input name="additionalinfo[national_identity_number]" type="text"
                        placeholder="" value="" class="o-form__field js-input-field "/>
                </div>
            </label>
        </div>
    </form>
</div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div class="remodal c-remodal-general-alert remodal-is-initialized remodal-is-closed"
         data-remodal-id="alert" role="dialog" aria-labelledby="modal1Title"
         aria-describedby="modal1Desc" tabindex="-1">
        <div class="c-remodal-general-alert__main">
            <div class="c-remodal-general-alert__content">
                <p class="js-remodal-general-alert__text">
                    آیا مطمئنید که این محصول از لیست مورد علاقه شما حذف شود؟
                </p>
                <p class="c-remodal-general-alert__description
                    js-remodal-general-alert__description" style="display: none;"></p>
            </div>
            <div class="c-remodal-general-alert__actions">
                <button class="c-remodal-general-alert__button
                    c-remodal-general-alert__button--approve js-remodal-general-alert__button--approve">
                    بله
                </button>
                <button class="c-remodal-general-alert__button
                    c-remodal-general-alert__button--cancel js-remodal-general-alert__button--cancel">
                    خیر
                </button>
            </div>
        </div>
    </div>
</div>
