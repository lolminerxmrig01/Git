@extends('layouts.customer.master')
@section('head')
<script>
  var supernova_mode = "production";
  var supernova_tracker_url = "https:\/\/etrackerd.digikala.com\/tracker\/events\/";
  var activeMenu = "giftCards";
  var faqPageTitle = "profile_section";
  var skipWalletRequest = true;
  var userId = 9735394;
  var adroRCActivation = true;
  var loginRegisterUrlWithBack = "\/users\/login-register\/?_back=https:\/\/www.digikala.com\/profile\/giftcards\/";
  var isNewCustomer = false;
  var digiclubLuckyDrawEndTime = "2021-06-27 15:30:28";
  var activateUrl = "\/digiclub\/activate\/";
</script>
@endsection
@section('o-page__content')
<section class="o-page__content">
  <div class="o-box">
    <div class="o-box__header">
      <span class="o-box__title">کارت‌های هدیه</span>
    </div>
    <div class="c-profile-empty-temporary">
      <div class="c-profile-empty-temporary__img">
        <img src="https://www.digikala.com/static/files/994b3d4c.svg">
      </div>
      <div class="c-profile-empty-temporary__desc">
        کارت هدیه ای برای نمایش وجود ندارد
      </div>
    </div>
  </div>
</section>
@endsection

