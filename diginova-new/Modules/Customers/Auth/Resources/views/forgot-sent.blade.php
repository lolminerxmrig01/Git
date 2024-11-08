@extends('customerauth::layouts.auth')

@section('title') ورود/ثبت‌نام | فروشگاه اینترنتی {{ $fa_store_name }} @endsection

@section('head')
<script src="{{ asset('assets/js/rememberPasswordAction.js') }} "></script>
@endsection

@section('content')
    <div class="c-login__email-info-image">
        <img alt="{{ $site_url }}" src="{{ full_media_path($header_logo) }}">
    </div>

    <div class="c-login__email-info-header">
        ایمیل بازیابی ارسال شد!
    </div>

    <p class="c-login__email-info-text">
        لطفاً به صندوق الکترونیکی خود مراجعه کرده و بر روی لینک ارسال شده کلیک نمائید.
    </p>

    <a href="{{ route('front.indexPage') }}" class="o-btn o-btn--full-width o-btn--outlined-red-lg">بازگشت به {{ $fa_store_name }}</a>
@endsection
