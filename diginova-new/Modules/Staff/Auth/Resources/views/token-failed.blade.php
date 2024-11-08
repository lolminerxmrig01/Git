<html dir="rtl">
<head>
    <title>{{ $fa_store_name }} | بازیابی کلمه عبور </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon"
          href="{{ !is_null($favicon_image)? $site_url . '/' . $favicon_image->path . '/'. $favicon_image->name : '' }}"
          type="image/icon">
    <link rel="stylesheet" href="{{ asset('mehdi/staff/css/select2.css') }}">
</head>
<body class="c-new-login uk-flex-column">
<div class="c-new-login__main c-new-login__main--forgotten-pass">
    <div class="c-new-login__container c-new-login__container--center">
        <h1 class="c-header__logo"><a href="#"></a></h1>
        <span class="c-new-login__icon c-new-login__icon--danger"></span>
        <div class="c-new-login__message c-new-login__message--center mt-40">
            لینک بازیابی کلمه عبور منقضی شده است. <br>
            لطفاً دوباره تلاش کنید.
        </div>
        <div class="c-new-login__message c-new-login__message--center mt-60">
            <span>بازگشت به صفحه </span>
            <a href="{{ route('staff.loginPage') }}" class="c-reg-form__link">ورود</a>
        </div>
    </div>
</div>

<footer class="c-new-login__main-footer">
    <div class="c-new-login__main-footer-row">
        <div class="c-new-login__main-footer-copyright c-new-login__main-footer-copyright--bold">
            کليه حقوق اين سايت متعلق به
            <em> {{ $fa_store_name }} </em>
            می‌باشد.
        </div>
        <div class="c-new-login__main-footer-copyright">Copyright © 2021 DigiNova</div>
    </div>
</footer>
</body>
</html>
