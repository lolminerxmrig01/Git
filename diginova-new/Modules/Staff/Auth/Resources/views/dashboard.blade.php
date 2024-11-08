@extends('layouts.staff.master')

@section('title') پیشخوان دیجی نوا @endsection

@section('head')
  <script src="{{ asset('mehdi/staff/js/dashboardAction.js') }}"></script>
  <script src="{{ asset('mehdi/staff/js/econtract.js') }}"></script>
  <script src="{{ asset('mehdi/staff/js/promotionCalendar.js') }}"></script>
  <style>
  @if(!is_null($header_logo))
    .c-profile-nav__avatar:after {
      background-color: unset !important;
    }
  @endif
  </style>
@endsection

@section('content')
<main class="c-main" style="padding-bottom: 15px;">
    <div class="uk-container uk-container-large">
      <div class="c-grid">
        <div class="c-grid__row">
          <div class="c-grid__col c-grid__col--lg-3">
            <div class="c-grid__row c-grid__row--sm c-grid__row--lg">

              <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-12">
                <div class="c-card" id="dashboard-step-2">
                  <div class="c-card__body">

                    <div class="c-profile-nav">
                      <div class="c-profile-nav__avatar">
                        @if(!is_null($header_logo))
                            <img src="{{ $site_url . '/' . (!is_null($header_logo)? $header_logo->path . '/' . $header_logo->name : '') }}"
                             class="c-content-modal__uploads-img" alt="" style="width: 100% !important; height: 100%; border-radius: 50% !important;">
                        @endif
                      </div>
                      <h2 class="c-profile-nav__title">{{ $fa_store_name }}</h2>

                      <div class="c-profile-nav__menu">
                        <a href="{{ route('staff.settings.index') }}" class="c-profile-nav__menu-item">
                          <img src="{{ asset('mehdi/staff/images/icons/dashboard/setting.svg') }}">
                          تنظیمات
                        </a>
                        <a href="{{ $site_url }}" target="_blank" class="c-profile-nav__menu-item">
                          <img src="{{ asset('mehdi/staff/images/icons/dashboard/store.svg') }}">
                          فروشگاه
                        </a>
                        <a class="c-profile-nav__menu-item">
                          <img src="{{ asset('mehdi/staff/images/icons/dashboard/activity.svg') }}">
                          گزارشات
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="c-grid__col c-grid__col--sm-6 c-grid__col--lg-12 c-grid__col--lg-gap c-grid__col--xs-gap">
                <div class="c-card" id="dashboard-step-12">
                  <div class="c-card__header">
                    <h2 class="c-card__title">امتیاز عملکرد شما</h2>
                  </div>
                  <div class="c-card__body c-card__body--grow">
                    <div class="c-rating-chart">
                      <?php
                        $recommend_count = \Modules\Staff\Comment\Models\Comment::where('recommend_status', 'recommended')->count();
                        $not_recommended = \Modules\Staff\Comment\Models\Comment::where('recommend_status', 'not_recommended')->count();
                        $no_idea = \Modules\Staff\Comment\Models\Comment::where('recommend_status', 'no_idea')->count();
                        $rating_sum = $recommend_count + $not_recommended + $no_idea;
                      ?>
                      <div class="c-rating-chart__reg-from c-ui--mt-0 c-ui--mb-40">
                        از مجموع {{ persianNum($rating_sum) }} امتیاز به محصولات
                      </div>

                      <div class="c-rating-chart__stats">
                        <div class="c-rating-chart__stat">
                          <div class="c-rating-chart__stat-desc">پیشنهاد<br>کردند</div>
                          <div class="c-rating-chart__stat-value c-rating-chart__stat-value--success">
                            ٪{{ ($recommend_count !== 0)?persianNum(ceil(($recommend_count/$rating_sum) * 100)) : persianNum(0) }}
                          </div>
                        </div>
                        <div class="c-rating-chart__stat">
                          <div class="c-rating-chart__stat-desc">بدون<br> نظر</div>
                          <div class="c-rating-chart__stat-value c-rating-chart__stat-value--warning">
                            ٪{{ ($recommend_count !== 0)?persianNum(floor(($no_idea/$rating_sum) * 100)): persianNum(0) }}
                          </div>
                        </div>
                        <div class="c-rating-chart__stat">
                          <div class="c-rating-chart__stat-desc">پیشنهاد<br>نکردند</div>
                          <div class="c-rating-chart__stat-value c-rating-chart__stat-value--danger">
                            ٪{{ ($recommend_count !== 0)?persianNum(floor(($not_recommended/$rating_sum) * 100)): persianNum(0) }}
                          </div>
                        </div>
                      </div>

                      <div class="c-rating-chart c-rating-chart--condensed" style="margin-top: 20px !important;">
                        <a class="c-rating-chart__details-bar">
                          <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                            دیدگاه کاربران برای محصولات
                          </div>
                          <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                            {{ persianNum(\Modules\Staff\Comment\Models\Comment::whereDate('created_at', '>' , \Carbon\Carbon::now()->subDays(30))->count()) }}
                          </div>
                        </a>
                        <span class="c-rating-chart__description--sub">در ۳۰ روز گذشته</span>
                      </div>
                     </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="c-grid__col c-grid__col--lg-9">
            <div class="c-grid__row">
              <div class="c-grid__col c-grid__col--sm-4">
                <div class="c-card c-card--transparent">
                  <div class="c-interactive-status {{ $peyment_methods->where('status', 'active')->count()? 'c-interactive-status--ok' : 'c-interactive-status--warning' }}" id="dashboard-step-3">
                    <div class="c-interactive-status__title">روش‌های پرداخت</div>
                      @if($peyment_methods->where('status', 'active')->count())
                        <div class="c-interactive-status__description">فعال</div>
                      @else
                        <div class="c-interactive-status__description">غیرفعال</div>
                      @endif
                  </div>
                </div>
              </div>


              <div class="c-grid__col c-grid__col--sm-4">
                <div class="c-card c-card--transparent">
                  <div class="c-interactive-status {{ ($settings->where('name', 'site_sms_status')->first()->value == 'active')? 'c-interactive-status--ok' : 'c-interactive-status--warning' }}" id="dashboard-step-4">
                    <div class="c-interactive-status__title">سامانه پیامکی</div>
                      @if($settings->where('name', 'site_sms_status')->first()->value == 'active')
                        <div class="c-interactive-status__description">فعال</div>
                      @else
                        <div class="c-interactive-status__description">غیرفعال</div>
                      @endif
                  </div>
                </div>
              </div>


              <div class="c-grid__col c-grid__col--sm-4">
                <div class="c-card c-card--transparent">
                  <div class="c-interactive-status {{ ($settings->where('name', 'site_email_status')->first()->value == 'active')? 'c-interactive-status--ok' : 'c-interactive-status--warning' }}" id="dashboard-step-5">
                    <div class="c-interactive-status__title">سامانه ایمیل</div>
                    @if($settings->where('name', 'site_email_status')->first()->value == 'active')
                      <div class="c-interactive-status__description">فعال</div>
                    @else
                      <div class="c-interactive-status__description">غیرفعال</div>
                    @endif
                  </div>
                </div>
              </div>


            </div>


            <div class="c-grid__row">
              <div class="c-grid__col c-grid__col--sm-4">
                <a href="{{ route('staff.products.create') }}" class="c-card c-card--is-link c-card--has-btn c-dashboard-status__jc-c" id="dashboard-step-6">
                  <div class="c-card__header c-card__header--no-border">
                    <h2 class="c-card__title c-card__title--dark">افزودن محصول جدید</h2>
                    <div class="c-card__header-btn c-card__header-btn--add"></div>
                  </div>
                </a>
              </div>
              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--xs-gap">
                <a href="{{ route('staff.periodic-prices.index') }}" class="c-card c-card--is-link c-dashboard-status__jc-c uk-open"
                 id="dashboard-step-7" aria-expanded="false">
                  <div class="c-card__header c-card__header--no-border">
                    <h2 class="c-card__title c-card__title--dark">تنوع‌های فعال در پروموشن‌ها
                      <span class="c-card__title-side c-card__title-side--arrow"></span>
                    </h2>
                  </div>
                </a>
              </div>
              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--xs-gap">
                <a href="{{ route('staff.settings.index') }}" id="dashboard-step-8"
                  class="c-card c-card--is-link c-card--has-btn c-card--has-success c-dashboard-status__jc-c">
                  <div class="c-card__header c-card__header--no-border">
                    <h2 class="c-card__title c-card__title--dark">
                      وضعیت فروشگاه
                      @if($settings->where('name', 'development_mode')->first()->value == 'true')
                        <small style="font-size: 12px !important;">حالت توسعه</small>
                        <div class="c-card__header-btn c-card__header-btn--deny"></div>
                      @else
                        <small>فعال</small>
                        <div class="c-card__header-btn c-card__header-btn--success"></div>
                      @endif
                    </h2>
                  </div>
                </a>
              </div>
            </div>
            <div class="c-grid__row">
              <div class="c-grid__col c-grid__col--sm-4">
                <div class="c-card" id="dashboard-step-9">
                  <div class="c-card__header">
                    <h2 class="c-card__title">مدیریت محصولات</h2>
                  </div>
                  <div class="c-card__body">
                    <div class="c-rating-chart c-rating-chart--condensed">
                      <a class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                          تعداد محصولات فروشگاه
                          <div class="c-rating-chart__description"></div>
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum($products->count()) }}
                        </div>
                      </a>
                    </div>

                    <div class="c-rating-chart c-rating-chart--condensed">
                      <a class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                          محصولات پیش‌نویس
                          <div class="c-rating-chart__description"></div>
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum($products->where('status', 0)->count()) }}
                        </div>
                      </a>
                    </div>

                    <div class="c-rating-chart c-rating-chart--condensed">
                      <a class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                          محصولات بدون تنوع
                          <div class="c-rating-chart__description"></div>
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum($products->count() - \Modules\Staff\Product\Models\ProductHasVariant::orderBy('product_id')->distinct('product_id')->count()) }}
                        </div>
                      </a>
                    </div>

                    <div class="c-rating-chart c-rating-chart--condensed">
                      <a class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                          محصولات بدون فروش
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum($products->count() - \Modules\Staff\Order\Models\ConsignmentHasProductVariants::select('product_id')->distinct()->count()) }}
                        </div>
                      </a>
                    </div>

                    <div class="c-rating-chart c-rating-chart--condensed">
                      <a class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                          محصولات درج شده
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum(\Modules\Staff\Product\Models\Product::whereDate( 'created_at', '>', \Carbon\Carbon::now()->subDays(30))->count()) }}
                        </div>
                      </a>
                      <span class="c-rating-chart__description--sub">در ۳۰ روز گذشته</span>
                    </div>

                  </div>
                </div>
              </div>

              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--xs-gap">
                <div class="c-card" id="dashboard-step-10">
                  <div class="c-card__header">
                    <h2 class="c-card__title">مدیریت تنوع و قیمت‌گذاری</h2>
                  </div>
                  <div class="c-card__body">
                    <a class="c-rating-chart c-rating-chart--condensed">
                      <div class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                          کل تنوع‌های فعال
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum(\Modules\Staff\Product\Models\ProductHasVariant::where('status', 1)->count()) }}
                        </div>
                      </div>
                    </a>

                    <a class="c-rating-chart c-rating-chart--condensed">
                      <div class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                         کل تنوع‌های غیرفعال
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum(\Modules\Staff\Product\Models\ProductHasVariant::where('status', 0)->count()) }}
                        </div>
                      </div>
                    </a>

                    <a class="c-rating-chart c-rating-chart--condensed">
                      <div class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                          تنوع‌های بدون فروش
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum($consignments->count() - \Modules\Staff\Product\Models\ProductVariantable::where('variantable_type', 'ConsignmentHasProductVariants')->select('variantable_id')->distinct()->count()) }}
                        </div>
                      </div>
                    </a>

                    <div class="c-rating-chart c-rating-chart--condensed">
                      <a class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                           تنوع‌های در حال اتمام موجودی (کمتر از سه عدد)
                        </div>

                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum(\Modules\Staff\Product\Models\ProductHasVariant::where('stock_count', '<', 3)->where('stock_count', '>', 0)->count()) }}
                        </div>
                      </a>

                    </div>
                    <a class="c-rating-chart c-rating-chart--condensed">
                      <div class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                          تنوع‌های بدون موجودی
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum(\Modules\Staff\Product\Models\ProductHasVariant::where('stock_count', 0)->count()) }}
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>

              <div class="c-grid__col c-grid__col--sm-4 c-grid__col--xs-gap">
                <div class="c-card" id="dashboard-step-11">
                  <div class="c-card__header">
                    <h2 class="c-card__title">مدیریت سفارشات</h2>
                  </div>
                  <div class="c-card__body">

                    <a class="c-rating-chart c-rating-chart--condensed">
                      <div class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                         سفارشات موفق امروز شما
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum(\Modules\Staff\Order\Models\Order::whereDate('created_at', \Carbon\Carbon::today())->where('order_status_id', '!=' , 1)->count()) }}
                        </div>
                      </div>
                    </a>

                    <a class="c-rating-chart c-rating-chart--condensed">
                      <div class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                          سفارشات در انتظار بررسی
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum(\Modules\Staff\Order\Models\Order::where('order_status_id', 8)->count()) }}
                        </div>
                      </div>
                    </a>

                    <a class="c-rating-chart c-rating-chart--condensed">
                      <div class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                          کل تعهد ارسال گذشته و امروز
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum($send_today_only) }}
                        </div>
                        <div class="c-rating-chart__description-tooltip uk-dropdown" uk-dropdown="boundary: .js-dropdown-desc; pos: bottom-center;delay: 0">
                          <div class="c-rating-chart__description c-rating-chart__description--bar c-rating-chart__description--sub c-card__stat-description">حداقل یک فروشنده روی کالای مشابه قیمت‌گذاری کرده است</div>
                        </div>
                      </div>
                    </a>

                    <a class="c-rating-chart c-rating-chart--condensed">
                      <div class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                          کل تعهد ارسال فردا به بعد
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum($send_tomorrow_only) }}
                        </div>
                      </div>
                    </a>

                    <a class="c-rating-chart c-rating-chart--condensed">
                      <div class="c-rating-chart__details-bar">
                        <div class="c-rating-chart__description c-rating-chart__description--bar c-card__stat-description uk-inline">
                          سفارشات تاخیر دار
                        </div>
                        <div class="c-rating-chart__details-value c-rating-chart__details-value--large">
                          {{ persianNum($delivery_order_delay) }}
                        </div>
                        <div class="c-rating-chart__description-tooltip uk-dropdown" uk-dropdown="boundary: .js-dropdown-desc; pos: bottom-center;delay: 0">
                          <div class="c-rating-chart__description c-rating-chart__description--bar c-rating-chart__description--sub c-card__stat-description">تنوع‌های که در حال حاضرشما تنها فروشنده آن هستید</div>
                        </div>
                      </div>
                    </a>

                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="c-grid__row">
          <div class="c-grid__col c-grid__col--lg-9 c-grid__col--xs-gap c-grid__col--sm-gap">
          </div>
        </div>

        <div class="c-grid__row">
          <div class="c-grid__col c-grid__col--lg-4" id="dashboard-step-16">
            <div class="c-card">
              <div class="c-card__header">
                <h2 class="c-card__title">وضعیت فروش</h2>
              </div>
              <div class="c-card__body">
                <?php
                  $sum_order_cost_filter1 = \Modules\Staff\Order\Models\Order::whereDate( 'created_at', '>', \Carbon\Carbon::now()->subDays(7))->sum('cost');
                  $sum_order_count_filter1 = \Modules\Staff\Order\Models\Order::whereDate( 'created_at', '>', \Carbon\Carbon::now()->subDays(7))->count();
                  $sum_order_cost_filter2 = \Modules\Staff\Order\Models\Order::whereDate( 'created_at', '<', \Carbon\Carbon::now()->subDays(7))->whereDate( 'created_at', '>', \Carbon\Carbon::now()->subDays(14))->sum('cost');
                  $sum_order_count_filter2 = \Modules\Staff\Order\Models\Order::whereDate( 'created_at', '<', \Carbon\Carbon::now()->subDays(7))->whereDate( 'created_at', '>', \Carbon\Carbon::now()->subDays(14))->count();
                  $sum_order_cost_filter3 = \Modules\Staff\Order\Models\Order::whereDate( 'created_at', '>', \Carbon\Carbon::now()->subDays(30))->sum('cost');
                  $sum_order_count_filter3 = \Modules\Staff\Order\Models\Order::whereDate( 'created_at', '>', \Carbon\Carbon::now()->subDays(30))->count();

                  $sum_order_count_filter4 = \Modules\Staff\Order\Models\Order::where('order_status_id', 7)->whereDate( 'created_at', '>', \Carbon\Carbon::now()->subDays(30))->count();
                  $sum_order_count_filter5 = \Modules\Staff\Order\Models\Order::where('order_status_id', '!=', 1)->orWhere('order_status_id', '!=', 7)->whereDate( 'created_at', '>', \Carbon\Carbon::now()->subDays(30))->count();
                ?>
                <div class="c-card__stat c-card__stat--section">
                  <a class="js-change-selling-chart" data-option="last_7_days">
                    <div class="c-card__stat-value c-card__stat-value--active" data-value="{{ $sum_order_cost_filter1 }}">
                      <span dir="ltr" data-debug="{{ $sum_order_cost_filter1 }}">
                        {{ persianNum(number_format($sum_order_cost_filter1)) }}
                        </span>
                         <span class="small">ریال</span>
                    </div>
                    <div class="c-card__stat-description">
                      فروش هفته جاری
                    </div>
                  </a>
                </div>

                <a class="c-card__stat js-change-selling-chart" data-option="last_60_days">
                  <div class="c-card__stat-value" data-value="{{ $sum_order_cost_filter2 }}">
                    <span dir="ltr" data-debug="{{ $sum_order_cost_filter2 }}">
                      {{ persianNum(number_format($sum_order_cost_filter2)) }}
                      </span>
                       <span class="small">ریال</span>
                  </div>
                  <div class="c-card__stat-description">
                    فروش هفته گذشته
                  </div>
                </a>

                <a class="c-card__stat js-change-selling-chart" data-option="last_year">
                  <div class="c-card__stat-value" data-value="0">
                    <span dir="ltr" data-debug="{{ $sum_order_cost_filter3 }}">
                      {{ persianNum(number_format($sum_order_cost_filter3)) }}
                    </span> 
                    <span class="small">ریال</span>
                  </div>
                  <div class="c-card__stat-description">
                    فروش ماه گذشته
                  </div>
                </a>
              </div>
            </div>
          </div>

          <div class="c-grid__col c-grid__col--xs-gap c-grid__col--sm-gap c-grid__col--lg-4" id="dashboard-step-18">
            <div class="c-card">
              <div class="c-card__header">
                <h2 class="c-card__title">تعداد فروش </h2>
              </div>
              <div class="c-card__body">
                <a class="c-card__stat">
                  <div class="c-rating-chart__details-value c-rating-chart__details-value--full c-card__stat-value c-rating-chart__details-value--5">
                    {{ persianNum($sum_order_count_filter1) }} <span>عدد</span>
                  </div>
                  <div class="c-card__stat-description">
                    تعداد کالای فروش رفته هفته جاری
                  </div>
                </a>

                <a class="c-card__stat">
                  <div class="c-rating-chart__details-value c-rating-chart__details-value--full c-card__stat-value c-rating-chart__details-value--neutral">
                    {{ persianNum($sum_order_count_filter2) }} <span>عدد</span>
                  </div>
                  <div class="c-card__stat-description">
                    تعداد کالای فروش رفته هفته گذشته
                  </div>
                </a>

                <a class="c-card__stat">
                  <div class="c-rating-chart__details-value c-rating-chart__details-value--full c-card__stat-value c-rating-chart__details-value--neutral">
                    {{ persianNum($sum_order_count_filter3) }} <span>عدد</span>
                  </div>
                  <div class="c-card__stat-description">
                    تعداد کالای فروش رفته ماه گذشته
                  </div>
                </a>
              </div>
            </div>
          </div>

          <div class="c-grid__col c-grid__col--xs-gap c-grid__col--sm-gap c-grid__col--lg-4" id="dashboard-step-17">
            <div class="c-card">
              <div class="c-card__header">
                <h2 class="c-card__title">وضعیت سفارش‌ها در ماه گذشته</h2>
              </div>
              <div class="c-card__body">
                <a class="c-card__stat">
                  <div class="c-rating-chart__details-value c-rating-chart__details-value--full c-card__stat-value c-rating-chart__details-value--info">
                    {{ persianNum($sum_order_count_filter5) }}
                  </div>
                  <p class="c-card__stat-description">سفارش‌های پرداخت موفق</p>
                </a>

                <a class="c-card__stat">
                  <div class="c-rating-chart__details-value c-rating-chart__details-value--full c-card__stat-value c-rating-chart__details-value--3">
                    {{ persianNum($sum_order_count_filter4) }}
                  </div>
                  <p class="c-card__stat-description ">سفارش‌های لغو شده / بایگانی شده</p>
                </a>

                <a class="c-card__stat">
                  <div class="c-rating-chart__details-value c-rating-chart__details-value--full c-card__stat-value c-rating-chart__details-value--1">
                    ۰
                  </div>
                  <p class="c-card__stat-description">سفارش‌های مرجوع شده</p>
                </a>

              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </main>
@endsection

