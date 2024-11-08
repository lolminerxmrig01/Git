@extends('customerauth::layouts.auth')

@section('title') ورود/ثبت‌نام | فروشگاه اینترنتی {{ $fa_store_name }} @endsection

@section('head')
<script src="{{ asset('assets/js/otpAction.js') }} "></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <form class="c-login__form" method="post" action="{{ route('customer.confirmSms') }}" id="authForm" novalidate="novalidate">
        @csrf
        <div class="c-login__header-logo">
            <a href="{{ route('customer.regLoginPage') }}" class="c-login__back-button"></a>
            <a href="{{ route('front.indexPage') }}">
                <img alt="{{ $site_url }}" src="{{ full_media_path($header_logo) }}">
            </a>
        </div>

        <div class="c-login__form-header">
            کد تایید را وارد نمایید
        </div>

        <div class="c-login__opt-mobile-message">
            کد تایید برای شماره موبایل
            <span class="js-otp-phone-number">{{ persianNum(0) . persianNum(session('c_mobile')) }}</span>
            ارسال گردید
        </div>

        <div class="c-login__form-row">
            <label class="o-form__field-container">
                <div class="o-form__field-frame">
                    <input name="code" class="o-form__field js-input-field c-login__otp-input" maxlength="5">
                </div>
            </label>
        </div>

        @if(session('has_password') == true)
        <div class="c-login__form-row">
            <a href="{{ route('customer.confirmPage') }}">
                <button type="button" class="c-login__arrow-link">ورود با رمز عبور</button>
            </a>
        </div>
        @endif

        <div class="c-login__resend-otp-section">
            <div class="c-login__resend-otp-message js-phone-code-container">
                ارسال مجدد کد تا
                <span class="js-phone-code-counter" data-countdownseconds="180"></span>
                دیگر
            </div>

            <a id="resend" href="javascript:document.resendForm.submit()"
               class="o-btn o-btn--full-width o-btn--link-blue-lg u-hidden js-send-otp-confirm-code" data-mode="login">
                دریافت مجدد کد تایید
            </a>
        </div>

        <button type="submit" class="o-btn o-btn--full-width o-btn--contained-red-lg">ادامه</button>
    </form>

    <form method="post" name="resendForm" action="{{ route('customer.check') }}" hidden>
        @csrf
        <input name="email_phone" value="{{ session('c_mobile') }}">
        <button id="resend-btn"></button>
    </form>
@endsection
