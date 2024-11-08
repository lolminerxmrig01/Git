<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <title> {{ $fa_store_name }} | ورود به پنل مدیریت </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon"
          href="{{ !is_null($favicon_image)? $site_url . '/' . $favicon_image->path . '/'. $favicon_image->name : '' }}"
          type="image/icon">
    <link rel="stylesheet" href="{{ asset('mehdi/staff/css/select2.css') }}">
    <script src="{{ asset('mehdi/staff/js/jquery.min.js') }}"></script>
    <script src="{{ asset('mehdi/staff/js/loginAction.js') }}"></script>
</head>
<body>
<div class="c-new-login">
    <aside class="c-new-login__sidebar c-new-login__sidebar--xs">
        <div class="c-new-login__sidebar-content">
            <header class="c-new-login__sidebar-header">
                <a href="#" class="c-new-login__logo">
                    @if (!is_null($header_logo) && $header_logo !== '')
                        <center>
                            <img src="{{ asset($site_url . '/' . $header_logo->path . '/'. $header_logo->name) }}"
                                 alt="{{ $fa_store_name }}" class="c-new-login__sidebar-img"
                                 style="height: 35px !important;padding-right: 58px;">
                        </center>
                    @endif
                </a>
                <h1 class="c-new-login__header">
                    به پنل مدیریت
                    {{ $fa_store_name }}
                    <br>
                    خوش آمدید!
                </h1>
            </header>
            <div class="c-new-login__sidebar-center">
                <img src="{{ asset('mehdi/staff/images/seller-center.svg') }}" class="c-new-login__sidebar-img">
            </div>
            <footer class="c-new-login__footer">
                <p>Copyright © 2021 DigiNova</p>
            </footer>
        </div>
    </aside>
    <aside class="c-new-login__sidebar c-new-login__sidebar--xs-visible">
        <div class="c-new-login__sidebar-content">
            <header class="c-new-login__sidebar-header">
                <a href="{{ route('staff.loginPage') }}" class="c-new-login__logo">
                    @if (!is_null($header_logo))
                        <img src="{{ asset("$site_url . '/' . $header_logo->path . '/'. $header_logo->name") }}"
                             alt="{{ $fa_store_name }}">
                    @endif
                </a>
                <h1 class="c-new-login__header">به پنل مدیریت {{ $site_title }} <br> خوش آمدید!</h1>
            </header>
        </div>
    </aside>
    <main class="c-new-login__main">
        <div class="c-reg-form c-reg-form--login">
            <form method="post" id="login-form" action="{{ route('staff.confirm') }}" data-name="login"
                  novalidate="novalidate">
                @csrf
                <div class="c-reg-form__row">
                    <div class="c-reg-form__col c-reg-form__col--12">
                        <div class="c-ui-input">
                            <input type="text" name="email"
                                   class="c-ui-input__field c-ui-input__field--ltr c-ui-input__field--has-icon"
                                    value="" placeholder="ایمیل خود را وارد کنید" maxlength="255"
                                   autocomplete="email" required="" aria-invalid="false">
                            <div class="c-ui-input__icon c-ui-input__icon--email"></div>
                        </div>
                    </div>
                </div>
                <div class="c-reg-form__row">
                    <div class="c-reg-form__col c-reg-form__col--12">
                        @if(isset($errors) && ($errors->first()))
                            <div class="c-ui-input has-error">
                                <input type="password" name="password"
                                       class="c-ui-input__field c-ui-input__field--ltr c-ui-input__field--has-icon c-ui-input__field--has-btn"
                                       placeholder="کلمه عبور خود را وارد کنید" minlength="4" maxlength="255"
                                       autocomplete="current-password"
                                       required="" aria-invalid="false">
                                <div class="c-ui-input__icon c-ui-input__icon--password"></div>
                            </div>
                            <div id="login[password]-error" class="error c-reg-form__error">{{ $errors->first() }}</div>
                        @else
                            <div class="c-ui-input">
                                <input type="password" name="password"
                                       class="c-ui-input__field c-ui-input__field--ltr c-ui-input__field--has-icon c-ui-input__field--has-btn"
                                       placeholder="کلمه عبور خود را وارد کنید" minlength="4" maxlength="255"
                                       autocomplete="current-password"
                                       required="" aria-invalid="false">
                                <div class="c-ui-input__icon c-ui-input__icon--password"></div>
                                </div>
                        @endif
                    </div>
                </div>
                <div class="c-reg-form__row c-reg-form__row--gap-40 c-reg-form__row--align-center">
                    <div class="c-reg-form__col">
                        <div class="c-ui-checkbox__group">
                            <label class="c-ui-checkbox">
                                <input class="c-ui-checkbox__origin " type="checkbox" name="remember" value="true">
                                <span class="c-ui-checkbox__check"></span>
                                <span class="c-ui-checkbox__label">مرا به خاطر بسپار</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="c-reg-form__row c-reg-form__row--align-center">
                    <div class="c-reg-form__col">
                        <button class="c-reg-form__submit-btn" id="btnSubmit">ورود</button>
                    </div>
                </div>
                <div class="c-reg-form__row c-reg-form__row--align-center c-reg-form__row--gap-40">
                    <div class="c-reg-form__col">
                        <p class="c-reg-form__text">
                            <a href="{{ route('staff.forgotPage') }}" class="c-reg-form__link">
                                رمز عبورم را فراموش کرده ام.
                            </a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>



