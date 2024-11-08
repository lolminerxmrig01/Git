@extends('layouts.front.master')

@section('head')
  <title>خطا | {{ $fa_store_name }}</title>
  <meta name="robots" content="noindex, nofollow">
  <script src="{{ asset('assets/js/sentry.js') }}"></script>
@endsection

@section('content')
  <main id="main">
    <div id="HomePageTopBanner"></div>
    <div id="content">
      <div class="c-404">
        <div class="c-404__title">
          <h1>صفحه‌ای که دنبال آن بودید پیدا نشد!</h1>
        </div>
        <div class="c-404__actions">
          <a href="{{ route('front.indexPage') }}" class="c-404__action c-404__action--primary">
            صفحه اصلی
          </a>
        </div>
        <div class="c-404__image">
          <img src="{{ asset('assets/images/png/404.png') }}" loading="lazy">
        </div>
      </div>
    </div>
  </main>
@endsection
