@extends('customerauth::layouts.auth')

@section('title') ورود/ثبت‌نام | فروشگاه اینترنتی {{ $fa_store_name }} @endsection

@section('head')
    <script src="{{ asset('assets/js/loginAction.js') }} "></script>
@endsection

@section('content')
    <form class="c-login__form" action="{{ route('customer.check') }}" method="post" id="loginForm"
          novalidate="novalidate">
        @csrf

        <div class="c-login__header-logo c-login__header-logo--lg">
            <a href="{{ route('front.indexPage') }}">
                <img alt="{{ $site_url }}" src="{{ full_media_path($header_logo) }}">
            </a>
        </div>

        <div class="c-login__form-header">
            ورود / ثبت‌نام
        </div>

        <div class="c-login__opt-mobile-message">
            شماره موبایل یا پست الکترونیک خود را وارد کنید
        </div>

        <div class="c-login__form-row">
            <label class="o-form__field-container">
                <div class="o-form__field-frame">
                    <input name="email_phone" class="o-form__field js-input-field ">
                    <span type="button" class="o-form__field-clear-button js-ui-field-cleaner u-hidden"></span>
                </div>
            </label>
        </div>

        <button type="submit" class="o-btn o-btn--contained-red-lg c-login__form-action">
            ورود به {{ $fa_store_name }}
        </button>

        <p class="c-login__footer">
            با ورود و یا ثبت نام در
            {{ $fa_store_name }}
            شما شرایط و قوانین استفاده از سرویس های سایت
            {{ $fa_store_name }}
            و قوانین حریم خصوصی آن را می‌پذیرید.
        </p>

    </form>
@endsection
