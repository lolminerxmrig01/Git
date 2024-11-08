@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.classic.templateTitle') }}
@endsection

@section('title')
    {{ trans('installer_messages.environment.classic.title') }}
    <i class="fa fa-code fa-fw" aria-hidden="true"></i>
@endsection

@section('container')

    <form method="post" action="{{ route('LaravelInstaller::environmentSaveClassic') }}">
        {!! csrf_field() !!}
        <textarea class="textarea" name="envConfig">{{ $envConfig }}</textarea>
        <div class="buttons buttons--right">
            <button class="button button--light" type="submit">
             	{!! trans('installer_messages.environment.classic.save') !!}
                <i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i>
            </button>
        </div>
    </form>

    @if( ! isset($environment['errors']))
        <div class="buttons-container">
            <a class="button float-left" href="{{ route('LaravelInstaller::environmentWizard') }}">
                {!! trans('installer_messages.environment.classic.back') !!}
                <i class="fa fa-sliders fa-fw" aria-hidden="true"></i>
            </a>
            <a class="button float-right" href="{{ route('LaravelInstaller::database') }}">
                <i class="fa fa-angle-double-left fa-fw" aria-hidden="true"></i>
                {!! trans('installer_messages.environment.classic.install') !!}
            </a>
        </div>
    @endif

@endsection
