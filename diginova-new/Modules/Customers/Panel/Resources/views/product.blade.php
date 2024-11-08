@extends('layouts.customer.master')
@section('o-page__content')
  <section class="o-page__content">
    <div class="u-hidden js-ml-profile-ab-test"></div>
    <div class="o-grid">
      <div class="row">
        <div class="col-6">
          <div class="o-headline o-headline--profile">
            <span>اطلاعات شخصی</span>
          </div>
          <div class="c-profile-stats">
            <div class="c-profile-stats__row">
              <div class="c-profile-stats__col">
                <p>
                  <span>نام و نام خانوادگی:</span>
                  {{ $customer->full_name }}
                </p>
              </div>
              <div class="c-profile-stats__col">
                <p>
                  <span>پست الکترونیک :</span>
                  <span class="c-profile-stats__value">
                    {{ !is_null($customer->email)? $customer->email : '-' }}
                  </span>
                </p>
              </div>
            </div>
            <div class="c-profile-stats__row">
              <div class="c-profile-stats__col">
                <p>
                  <span>شماره تلفن همراه:</span>
                  {{ persianNum(0 . $customer->mobile) }}
                </p>
              </div>
              <div class="c-profile-stats__col">
                <p>
                  <span>کد ملی:</span>
                  {{ !is_null($customer->national_code)? persianNum($customer->national_code) : '' }}
                </p>
              </div>
            </div>
            <div class="c-profile-stats__row">
              <div class="c-profile-stats__col">
                <p>
                  <span>دریافت خبرنامه:</span>
                  {{ ($customer->newsletters)? 'بله' : 'خیر' }}
                </p>
              </div>
              <div class="c-profile-stats__col">
                <p>
                  <span>روش بازگشت وجه:</span>
                  <span class="c-profile-stats__value">
                      {{ !is_null($customer->return_money_method)? ($customer->return_money_method == 'wallet' ? 'کیف پول' : 'حساب بانکی' ) : '-' }}
                  </span>
                </p>
              </div>
            </div>
            <div class="c-profile-stats__action">
              <a href="{{ route('customer.panel.personalInfo') }}" class="btn-link-spoiler btn-link-spoiler--edit">ویرایش
                اطلاعات شخصی</a>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="o-headline o-headline--profile">
            <span>لیست آخرین علاقه‌مندی‌ها</span>
          </div>
          <div class="c-profile-recent-fav">
            <div class="c-profile-recent-fav__content">
              <div class="c-profile-recent-fav__row js-favorite-product">
                <a href="https://www.digikala.com/product/dkp-769647/"
                   class="c-profile-recent-fav__col c-profile-recent-fav__col--thumb">
                  <img
                    data-src="https://dkstatics-public.digikala.com/digikala-products/3490996.jpg?x-oss-process=image/resize,m_fill,h_150,w_150/quality,q_60"
                    alt="هندزفری سلبریت مدل D1">
                </a>
                <div class="c-profile-recent-fav__col c-profile-recent-fav__col--title">
                  <a href="https://www.digikala.com/product/dkp-769647/">
                    <h4 class="c-profile-recent-fav__name">هندزفری سلبریت مدل D1</h4>
                  </a>
                  <div class="c-profile-recent-fav__price">۴۱,۰۰۰ تومان</div>
                </div>
                <div class="c-profile-recent-fav__col c-profile-recent-fav__col--actions">
                  <button class="btn-action btn-action--remove js-remove-favorite-product"
                          data-product-id="769647"></button>
                </div>
              </div>
              <div class="c-profile-recent-fav__row js-favorite-product">
                <a href="https://www.digikala.com/product/dkp-1492772/"
                   class="c-profile-recent-fav__col c-profile-recent-fav__col--thumb">
                  <img
                    data-src="https://dkstatics-public-2.digikala.com/digikala-products/110490415.jpg?x-oss-process=image/resize,m_fill,h_150,w_150/quality,q_60"
                    alt="هندزفری بلوتوث مدل SP01">
                </a>
                <div class="c-profile-recent-fav__col c-profile-recent-fav__col--title">
                  <a href="https://www.digikala.com/product/dkp-1492772/">
                    <h4 class="c-profile-recent-fav__name">هندزفری بلوتوث مدل SP01</h4>
                  </a>
                  <div class="c-profile-recent-fav__price">۳۶,۵۰۰ تومان</div>
                </div>
                <div class="c-profile-recent-fav__col c-profile-recent-fav__col--actions">
                  <button class="btn-action btn-action--remove js-remove-favorite-product"
                          data-product-id="1492772"></button>
                </div>
              </div>
              <div class="c-profile-recent-fav__row js-favorite-product">
                <a href="https://www.digikala.com/product/dkp-310914/"
                   class="c-profile-recent-fav__col c-profile-recent-fav__col--thumb">
                  <img
                    data-src="https://dkstatics-public.digikala.com/digikala-products/3092427.jpg?x-oss-process=image/resize,m_fill,h_150,w_150/quality,q_60"
                    alt="هندزفری مدل EO-IG955">
                </a>
                <div class="c-profile-recent-fav__col c-profile-recent-fav__col--title">
                  <a href="https://www.digikala.com/product/dkp-310914/">
                    <h4 class="c-profile-recent-fav__name">هندزفری مدل EO-IG955</h4>
                  </a>
                  <div class="c-profile-recent-fav__price">۱۹,۵۰۰ تومان</div>
                </div>
                <div class="c-profile-recent-fav__col c-profile-recent-fav__col--actions">
                  <button class="btn-action btn-action--remove js-remove-favorite-product"
                          data-product-id="310914"></button>
                </div>
              </div>
            </div>
            <div class="c-profile-recent-fav__action">
              <a href="{{ route('customer.panel.favorites') }}" class="btn-link-spoiler btn-link-spoiler--edit">مشاهده و
                ویرایش لیست مورد علاقه</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="o-headline o-headline--profile">
      <span>آخرین سفارش‌ها </span>
    </div>
    <div class="c-table-orders">
      <div class="c-table-orders__head c-table-orders__head--highlighted">
        <div class="c-table-orders__row">
          <div class="c-table-orders__cell c-table-orders__cell--hash">#</div>
          <div class="c-table-orders__cell c-table-orders__cell--id">شماره سفارش</div>
          <div class="c-table-orders__cell c-table-orders__cell--date">تاریخ ثبت سفارش</div>
          <div class="c-table-orders__cell c-table-orders__cell--price">مبلغ قابل پرداخت</div>
          <div class="c-table-orders__cell c-table-orders__cell--price">مبلغ کل</div>
          <div class="c-table-orders__cell c-table-orders__cell--payment">عملیات پرداخت</div>
          <div class="c-table-orders__cell c-table-orders__cell--detail"> جزییات</div>
        </div>
      </div>
      <div class="c-table-orders__body">
        <div class="c-table-orders__row">
          <div class="c-table-orders__cell c-table-orders__cell--hash">۱</div>
          <div class="c-table-orders__cell c-table-orders__cell--id">DKC-87085641</div>
          <div class="c-table-orders__cell c-table-orders__cell--date">۳۰ آذر ۱۳۹۹</div>
          <div class="c-table-orders__cell c-table-orders__cell--price">
            <div>۰</div>
          </div>
          <div class="c-table-orders__cell c-table-orders__cell--price">۷۶,۰۰۵,۰۰۰ تومان</div>
          <div class="c-table-orders__cell c-table-orders__cell--payment">
            <span class="c-table-orders__payment-status c-table-orders__payment-status--error">لغو شده</span>
          </div>
          <div class="c-table-orders__cell c-table-orders__cell--detail">
            <a href="/profile/my-orders/84987432/" class="btn-order-more"></a>
          </div>
        </div>
        <div class="c-table-orders__row">
          <div class="c-table-orders__cell c-table-orders__cell--hash">۲</div>
          <div class="c-table-orders__cell c-table-orders__cell--id">DKC-46149463</div>
          <div class="c-table-orders__cell c-table-orders__cell--date">۱۶ دی ۱۳۹۸</div>
          <div class="c-table-orders__cell c-table-orders__cell--price">
            <div>۰</div>
          </div>
          <div class="c-table-orders__cell c-table-orders__cell--price">۱۱۵,۷۰۰ تومان</div>
          <div class="c-table-orders__cell c-table-orders__cell--payment">
            <span class="c-table-orders__payment-status c-table-orders__payment-status--ok">پرداخت موفق</span>
          </div>
          <div class="c-table-orders__cell c-table-orders__cell--detail">
            <a href="/profile/my-orders/49417487/" class="btn-order-more"></a>
          </div>
        </div>
        <a href="{{ route('customer.panel.orders') }}" class="c-table-orders__show-more">مشاهده لیست سفارش‌ها</a>
      </div>
    </div>
  </section>
@endsection


@section('page-content')
  <div class="remodal-wrapper remodal-is-closed" style="display: none;"><div class="remodal c-remodal-general-alert remodal-is-initialized remodal-is-closed" data-remodal-id="alert" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc" tabindex="-1"><div class="c-remodal-general-alert__main"><div class="c-remodal-general-alert__content"><p class="js-remodal-general-alert__text">آیا مطمئنید که این محصول از لیست مورد علاقه شما حذف شود؟</p><p class="c-remodal-general-alert__description js-remodal-general-alert__description" style="display: none;"></p></div><div class="c-remodal-general-alert__actions"><button class="c-remodal-general-alert__button c-remodal-general-alert__button--approve js-remodal-general-alert__button--approve">بله</button><button class="c-remodal-general-alert__button c-remodal-general-alert__button--cancel js-remodal-general-alert__button--cancel">خیر</button></div></div></div></div>
@endsection

@section('script')
@endsection
