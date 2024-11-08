@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.menu.templateTitle') }}
@endsection

@section('title')
    <span>{!! trans('installer_messages.environment.menu.title') !!}</span>
    <i class="fa-fw" aria-hidden="true">
        <img src="{{ asset('installer/img/icons/settings.png') }}" style="margin-top: 15px" width="20px">
    </i>
@endsection

@section('container')
    <div dir="rtl">
        <p class="text-center">
            {!! trans('installer_messages.environment.menu.desc') !!}
        </p>
        <div class="buttons">
            <a href="{{ route('LaravelInstaller::environmentWizard') }}" class="button button-wizard">
                {{ trans('installer_messages.environment.menu.wizard-button') }}
{{--                <i class="fa fa-sliders fa-fw" aria-hidden="true"></i>--}}
            </a>
            <a href="{{ route('LaravelInstaller::environmentClassic') }}" class="button button-classic">
                {{ trans('installer_messages.environment.menu.classic-button') }}
{{--                <i class="fa fa-code fa-fw" aria-hidden="true"></i>--}}
            </a>
        </div>
    </div>
@endsection
