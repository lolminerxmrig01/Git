@extends('customerauth::layouts.auth')

@section('title') ورود/ثبت‌نام | فروشگاه اینترنتی {{ $fa_store_name }} @endsection

@section('head')
<script src="{{ asset('assets/js/otpAction.js') }} "></script>
@endsection

@section('content')
<form class="c-login__form" action="{{ route('customer.confirm') }}" method="post" id="authForm">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @csrf

    <div class="c-login__header-logo">
      <a href="{{ route('customer.regLoginPage') }}" class="c-login__back-button"></a>
        <a href="{{ route('front.indexPage') }}">
            <img alt="{{ $site_url }}" src="{{ full_media_path($header_logo) }}">
        </a>
    </div>

    <div class="c-login__grow-column">
      <div class="c-login__form-header">
        رمز عبور را وارد کنید
      </div>

      <div class="c-login__opt-mobile-message">
        رمز عبور حساب کاربری خود را وارد کنید
      </div>

      <div class="c-login__form-row">
        <label class="o-form__field-container">
          <div class="o-form__field-frame">
            <input name="password" type="password" class="o-form__field js-input-field "/>
            <span type="button" class="o-form__password-field-button js-ui-toggle-password"></span>
          </div>
        </label>
      </div>

      @if(session('c_mobile') !== null)
      <div class="c-login__form-row">
        <a href="javascript:document.resendForm.submit()" class="c-login__arrow-link">
          ورود با رمز یک‌بار مصرف
        </a>
      </div>
      @endif

      <div class="c-login__form-row">
        <a href="{{ route('customer.forgotPage') }}" class="c-login__arrow-link">بازیابی رمز عبور</a>
      </div>
    </div>

    <button type="submit" class="o-btn o-btn--full-width o-btn--contained-red-lg">ادامه</button>

  </form>

    <form method="post" name="resendForm" action="{{ route('customer.check') }}" hidden>
        @csrf
        <input name="loginWithSms" value="true">
        <button id="resend-btn"></button>
    </form>
@endsection
