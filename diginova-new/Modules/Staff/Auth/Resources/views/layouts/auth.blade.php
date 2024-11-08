<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon"
          href="{{ !is_null($favicon_image)? $site_url . '/' . $favicon_image->path . '/'. $favicon_image->name : '' }}"
          type="image/icon">
    <link rel="stylesheet" href="{{ asset('mehdi/staff/css/select2.css') }}">
    <script src="{{ asset('mehdi/staff/js/jquery.min.js') }}"></script>
    @yield('head')
</head>
<body>
<div class="c-new-login c-new-login--vertical">
    <main class="c-new-login__main">
        <div class="c-new-login__logo">
            <a href="#">
                @if (!is_null($header_logo) && $header_logo !== '')
                    <center>
                        <img src="{{ asset($site_url . '/' . $header_logo->path . '/'. $header_logo->name) }}"
                             alt="{{ $fa_store_name }}" class="c-new-login__sidebar-img"
                             style="height: 35px !important;padding-right: 80px;">
                    </center>
                @endif
            </a>
        </div>

        @yield('content')
    </main>
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
</div>
</body>
</html>
