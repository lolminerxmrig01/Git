@extends('staffauth::layouts.auth')

@section('title') {{ $fa_store_name }} | فراموشی کلمه عبور @endsection

@section('head')
    <script src="{{ asset('mehdi/staff/js/forgotPasswordAction.js') }}"></script>
@endsection

@section('content')
    <div class="c-reg-form c-reg-form--forgot">
        <form action="{{ route('staff.forgot') }}" method="post" id="forgot-form" data-name="forgot">
            @csrf
            <div class="c-reg-form__row c-reg-form__row--align-center">
                <div class="c-reg-form__col c-reg-form__col--12">
                    <h2 class="c-reg-form__header c-reg-form__header--bold">یادآوری کلمه عبور</h2>
                </div>
            </div>
            <div class="c-reg-form__row">
                <div class="c-reg-form__col c-reg-form__col--12">
                    @if(isset($errors) && ($errors->first()))
                        <div class="c-ui-input has-error">
                            <input type='email' name='email'
                                   class='c-ui-input__field c-ui-input__field--ltr c-ui-input__field--has-icon'
                                   type='email' placeholder='ایمیل خود را وارد کنید' maxlength='255'
                                   autocomplete='email' required>
                            <div class="c-ui-input__icon c-ui-input__icon--email"></div>
                            <div id="login[password]-error" class="error c-reg-form__error">{{ $errors->first() }}</div>
                            @else
                                <div class="c-ui-input">
                                    <input type='email' name='email'
                                           class='c-ui-input__field c-ui-input__field--ltr c-ui-input__field--has-icon'
                                           type='email' placeholder='ایمیل خود را وارد کنید' maxlength='255'
                                           autocomplete='email' required>
                                    <div class="c-ui-input__icon c-ui-input__icon--email"></div>
                                    @endif
                                </div>
                        </div>
                </div>
                <div class="c-reg-form__row c-reg-form__row--align-center c-reg-form__row--gap-50">
                    <div class="c-reg-form__col">
                        <button class="c-reg-form__submit-btn" id="btnSubmit">ارسال ایمیل بازیابی</button>
                    </div>
                </div>
        </form>
    </div>
@endsection
