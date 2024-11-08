@extends('customerauth::layouts.auth')

@section('title') ورود/ثبت‌نام | فروشگاه اینترنتی {{ $fa_store_name }} @endsection

@section('head')
<script src="{{ asset('assets/js/rememberPasswordAction.js') }} "></script>
@endsection

@section('content')
    <form class="c-login__form" action="{{ route('customer.forgot') }}" method="post" id="rememberForm" data-name="remember" novalidate="novalidate">
        @csrf
        <div class="c-login__header-logo">
            <a href="{{ route('customer.regLoginPage') }}" class="c-login__back-button"></a>
            <a href="{{ route('front.indexPage') }}">
                <img alt="{{ $site_url }}" src="{{ full_media_path($header_logo) }}">
            </a>
        </div>

        <div class="c-login__grow-column">
            <div class="c-login__form-header">
                درخواست بازیابی رمز عبور
            </div>

            <div class="c-login__opt-mobile-message">
                &nbsp;&nbsp;لطفا پست الکترونیک یا شماره موبایل خود را وارد نمایید.
            </div>

            <div class="c-login__form-row c-login__form-row--margin-bottom">
                <label class="o-form__field-container">
                    <div class="o-form__field-frame">
                        <input name="email_phone" class="o-form__field js-input-field ">
                    </div>
                </label>
            </div>
        </div>

        <button type="submit" class="o-btn o-btn--full-width o-btn--contained-red-lg">ادامه</button>
    </form>
@endsection
