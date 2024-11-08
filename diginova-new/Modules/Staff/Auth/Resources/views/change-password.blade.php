@extends('layouts.staff.master') @section('title') تغییر کلمه عبور |
{{ $fa_store_name }} @endsection @section('head')
<script src="{{ asset('mehdi/staff/js/jquery.min.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/changePasswordAction.js') }}"></script>
<style>
    td {
        text-align: right !important;
    }

    th {
        text-align: right !important;
    }
</style>
@endsection
@section('content')
<main class="c-main js-layout-main-content" data-is-production-mode="1">
    <div class="uk-container uk-container-large">
        <div class="c-pass">
            <div class="c-pass__header">تغییر کلمه عبور</div>
            <div class="c-pass__content">
                <form
                    class="uk-form-horizontal"
                    method="post"
                    id="changePasswordForm"
                    data-name="changepassword"
                    novalidate="novalidate"
                >
                    @csrf
                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text"
                            >کلمه عبور فعلی</label
                        >
                        <div class="uk-form-controls">
                            <input
                                class="uk-input"
                                type="password"
                                name="changepassword[password_old]"
                                placeholder="کلمه عبور فعلی"
                                dir="ltr"
                            />
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text"
                            >کلمه عبور جدید</label
                        >
                        <div class="uk-form-controls">
                            <input
                                class="uk-input"
                                type="password"
                                id="txtPassword"
                                name="changepassword[password]"
                                placeholder="کلمه عبور جدید"
                                dir="ltr"
                            />
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text"
                            >تکرار کلمه عبور جدید</label
                        >
                        <div class="uk-form-controls">
                            <input
                                class="uk-input"
                                type="password"
                                name="changepassword[password2]"
                                placeholder="تکرار کلمه عبور جدید"
                                dir="ltr"
                            />
                        </div>
                    </div>
                    <div class="uk-text-left">
                        <button
                            class="uk-button uk-button-primary-seller"
                            id="btnSubmit"
                            aria-expanded="false"
                        >
                            تغییر کلمه عبور
                        </button>
                    </div>
                    <div hidden="" id="status">
                        {{ isset($status)? $status : 0 }} 
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection