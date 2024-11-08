@extends('staffauth::layouts.auth')

@section('title') {{ $fa_store_name }} | بازیابی کلمه عبور @endsection

@section('content')
    <div class="c-reg-form c-reg-form--forgot">
        <div class="c-reg-form__row c-reg-form__row--align-center">
            <div class="c-reg-form__col c-reg-form__col--12">
                <div class="c-reg-form__success-status"></div>
            </div>
        </div>

        <div class="c-reg-form__row c-reg-form__row--align-center c-reg-form__row--gap-40">
            <div class="c-reg-form__col c-reg-form__col--12">
                <div class="c-reg-form__text">
                    <strong>کاربر گرامی،</strong>
                    <br>لینک بازیابی کلمه عبور به ایمیل شما ارسال گردید.
                </div>
            </div>
        </div>

        <div class="c-reg-form__row c-reg-form__row--align-center c-reg-form__row--gap-60">
            <div class="c-reg-form__col">
                <p class="c-reg-form__text">
                    بازگشت به صفحه
                    <a href="{{ route('staff.loginPage') }}" class="c-reg-form__link">ورود</a>
                </p>
            </div>
        </div>
    </div>
@endsection
