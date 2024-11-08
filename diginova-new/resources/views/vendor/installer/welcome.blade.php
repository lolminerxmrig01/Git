@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.welcome.templateTitle') }}
@endsection

@section('title')
    <span>{{ trans('installer_messages.welcome.title') }}</span>
    <i class="fa-fw" aria-hidden="true">
        <img src="{{ asset('installer/img/icons/home.png') }}" style="margin-top: 15px" width="20px">
    </i>
@endsection

@section('container')
    <div dir="rtl">
        <p class="text-center">
          {{ trans('installer_messages.welcome.message') }}
        </p>
        <p class="text-center">
          <a href="{{ route('LaravelInstaller::requirements') }}" class="button">
              {{ trans('installer_messages.welcome.next') }}
              <i class="fa fa-angle-left fa-fw" aria-hidden="true"></i>
          </a>
        </p>
    </div>
@endsection
