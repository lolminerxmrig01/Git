@extends('layouts.staff.master')
@section('title')  مدیریت کمپین ها | {{ $fa_store_name }}  @endsection
@section('head')
<script src="{{ asset('mehdi/staff/js/dk.price.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/bundle.min.js') }}"></script>
<style>
    .select2-search--dropdown{
        display: none !important;
    }
</style>

<script>
    var supernova_mode = "production";
    var supernova_tracker_url = "";
    var showRejectedMessage = 0;
    var rejectedMessage = "";
    var isLoggedSeller = 1;
    var walkthroughSteps = [];
    var showPriceModal = 0;
    var newSeller = 1;
    var is_yalda = 0;
</script>
@endsection
@section('content')
<main class="c-main">
    <div class="uk-container uk-container-large">
        <div class="page-layout layout-empty c-grid c-join__grid" style="">
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <div class="c-card c-join-smart-joined__container">
                        <img src="{{ asset('mehdi/staff/images/promotion.svg') }}" alt="">
                        <div class="c-join-smart-emty__des-title">
                            تخفیف‌های تعیین شده بر روی کالاهای انتخابی شما اعمال شد
                        </div>
                        <div class="c-join-smart-emty__des-sub-title c-join-smart-joined--no-with-limitation"                            >
                            خلاصه ی وضعیت تخفیف‌ها و پروموشن ها و کمپین‌های شرکت داده شده به شرح زیر می‌باشد:
                        </div>
                        <div class="c-join-smart-joined__detail">
                            <div class="c-join-smart-joined__detail-type">
                                <div class="c-join-smart-joined__detail-icon c-join-smart-joined__detail-icon--discount"></div>
                                <div class="c-join-smart-joined__detail-type-count">
                                    <!-- ۶ -->
                                </div>
                                <div class="c-join-smart-joined__detail-type-title">تنوع کالا با تخفیف نمایش داده می شوند</div>
                                <div class="c-join-smart-joined__detail-type-des">
                                    این کالاها با قیمت خط خورده و با درصد تخفیف در وب سایت {{ $fa_store_name }} نمایش داده می شوند.
                                </div>
                            </div>
                            <div class="c-join-smart-joined__detail-type c-join-smart-joined__detail--br">
                                <div class="c-join-smart-joined__detail-icon c-join-smart-joined__detail-icon--promotion"></div>
                                <div class="c-join-smart-joined__detail-type-count">
                                    <!-- -۶ -->
                                </div>
                                <div class="c-join-smart-joined__detail-type-title">
                                    تنوع کالا به پروموشن فروش ویژه اضافه شدند
                                </div>
                                <div class="c-join-smart-joined__detail-type-des">
                                    این کالاها علاوه بر نمایش به صورت تخفیف خورده
                                    <b>
                                        در صورت تایید
                                    </b>
                                    به لیست کالاهای فروش ویژه نیز اضافه می شوند.
                                </div>
                            </div>
                            <div class="c-join-smart-joined__detail-type c-join-smart-joined__detail--br">
                                <div class="c-join-smart-joined__detail-icon c-join-smart-joined__detail-icon--campaign"></div>
                                <div class="c-join-smart-joined__detail-type-count">
                                    <!-- ۰ -->
                                </div>
                                <div class="c-join-smart-joined__detail-type-title">
                                    تنوع کالا به کمپین‌های {{ $fa_store_name }} اضافه شدند
                                </div>
                                <div class="c-join-smart-joined__detail-type-des">
                                    این کالاها علاوه بر نمایش به صورت تخفیف خورده
                                    <b>
                                        در صورت تایید
                                    </b>
                                    به کمپین‌های {{ $fa_store_name }} نیز اضافه می شوند
                                </div>
                            </div>
                        </div>
                        <div class="c-mega-campaigns__btns-green c-join-smart-joined--mt-70 js-back-promotion-management">
                            <a href="/periodic-prices/active/">تایید و بازگشت به مدیریت تخفیف‌ها </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script>
// توکن csrf
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
@endsection
