<?php
  $wating_count = 0;

  if ($customer->order_variants()->exists() && $customer->order_variants()->where('order_status_id', $sold_status_id)
      ->orWhere('order_status_id', $returned_status_id)->exists()) {
    foreach($customer->order_variants()->where('order_status_id', $returned_status_id)->orWhere('order_status_id', $returned_status_id)->select('product_id')->groupBy('product_id')->get() as $item) {
      if($customer->comments()->where('product_id', $item->product_id)->exists()) {
        continue;
      }
      $wating_count++;
    }
  }
?>
@extends('layouts.customer.master')
@section('head')
<script>
  var supernova_mode = "production";
  var supernova_tracker_url = "https:\/\/etrackerd.digikala.com\/tracker\/events\/";
  var activeMenu = "comments";
  var faqPageTitle = "profile_section";
  var skipWalletRequest = true;
  var userId = 9735394;
  var adroRCActivation = true;
  var loginRegisterUrlWithBack = "\/users\/login-register\/?_back=https:\/\/www.digikala.com\/profile\/comments\/";
  var isNewCustomer = false;
  var digiclubLuckyDrawEndTime = "2021-06-27 15:30:28";
  var activateUrl = "\/digiclub\/activate\/";
</script>
@endsection

@section('o-page__content')
<section class="o-page__content">
  <div class="o-box c-profile-comments">
    <div class="o-box__header"><span class="o-box__title">نظرات</span></div>
    <div class="o-box__tabs">
      <div class="o-box__tab js-ui-tab-pill {{ ($wating_count || $customer->comments()->doesntExist())? 'is-active' : '' }}" data-tab-pill-id="products" data-current-page="1">
        در انتظار ثبت نظر
      </div>
      <div class="o-box__tab js-ui-tab-pill {{ (!$wating_count && $customer->comments()->exists())? 'is-active' : '' }}" data-tab-pill-id="comments" data-current-page="1">
        نظرات من
      </div>
    </div>
    <div class="c-profile-comments__wait-for-comment js-ui-tab-content {{ ($wating_count)? '' : 'u-hidden' }}" data-tab-content-id="products">
      @if ($wating_count)
        <p class="c-profile-comments__wait-for-comment-title">
          نظرتان درباره کالاهایی که خریده‌اید چیست؟
        </p>
        <p class="c-profile-comments__wait-for-comment-dsc">
          با ثبت نظر در مورد کالاهای خریداری شده خود، به دیگران کمک کنید خرید بهتری داشته باشند.
        </p>
         @foreach($customer->order_variants()->where('order_status_id', \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'sold')->first()->id)->orWhere('order_status_id', \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'returned')->first()->id)->select('product_id')->groupBy('product_id')->get() as $item)
          @if($customer->comments()->where('product_id', $item->product_id)->exists())
            @continue
          @endif
          <div class="c-profile-comments__product-container">
          <div class="c-profile-comments__product-thumb">
            @foreach($item->product->media as $image)
              @if($item->product->media && ($image->pivot->is_main == 1))
                <img src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80" alt="{{ $item->product->title_fa }}">
              @endif
            @endforeach
          </div>
          <div class="c-profile-comments__product-content">
            <div class="c-profile-comments__product-row">
              <div class="c-profile-comments__product-title">
                {{ $item->product->title_fa }}
              </div>
            </div>
            <div class="c-profile-comments__product-row c-profile-comments__product-row--reverse">
              <a href="{{ route('front.productPage', $item->product->product_code) }}" class="c-profile-comments__to-comment-link">
                ثبت دیدگاه
              </a>
            </div>
          </div>
        </div>
        @endforeach
        <section class="c-pager"></section>
      @else
        <div class="c-profile-list__empty-container">
          <img src="https://www.digikala.com/static/files/d4fa2ec1.svg" alt="هیچ کالایی برای ثبت نظر وجود ندارد.">
          <p>
            هیچ کالایی برای ثبت نظر وجود ندارد.
          </p>
        </div>
      @endif
    </div>
    <div class="c-profile-comments__comment-history js-ui-tab-content {{ ($wating_count)? 'u-hidden' : '' }}" data-tab-content-id="comments">

    @if ($customer->comments()->exists())
      @foreach($customer->comments as $comment)

      <?php
        $product = \Modules\Staff\Product\Models\Product::find($comment->product->id);

        $advantages = json_decode($comment->advantages, true);
        $disadvantages = json_decode($comment->disadvantages, true);

        if ($comment->customer->order_variants()->exists()) {
          $customerOrders = $comment->customer->order_variants()->where('product_id', $product->id)->where('order_status_id', \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'sold')->first()->id)->orWhere('order_status_id', \Modules\Staff\Shiping\Models\OrderStatus::where('en_name', 'returned')->first()->id)->get();
        }
        else {
          $customerOrders = null;
        }
      ?>

      <div class="c-profile-comments__product-container">
        <div class="c-profile-comments__product-thumb">
          <a href="{{ route('front.productPage', $comment->product->product_code) }}">
            @foreach($comment->product->media as $image)
              @if($comment->product->media && ($image->pivot->is_main == 1))
                <img src="{{ full_media_path($image) }}?x-oss-process=image/resize,m_fill,h_150,w_150/quality,q_60" alt="{{ $comment->product->title_fa }}">
              @endif
            @endforeach
          </a>
        </div>
        <div class="c-profile-comments__product-content">
          <div class="c-profile-comments__product-row">
            <div class="c-profile-comments__product-title">
              {{ $comment->title }}
            </div>
            <div class="c-profile-comments__actions">
              @if ($comment->publish_status == 'accepted')
                <div class="c-profile-comments__status c-profile-comments__status--approved">
                  تایید شده
                </div>
              @elseif($comment->publish_status == 'rejected')
                <div class="c-profile-comments__status c-profile-comments__status--rejected">
                  تایید نشده
                </div>
              @elseif($comment->publish_status == 'not_checked')
                <div class="c-profile-comments__status c-profile-comments__status--review">
                  در انتظار بررسی
                </div>
              @endif

                <div class="c-ui-more">
                <div class="o-btn o-btn--icon-gray-md o-btn--l-more js-ui-see-more"></div>
                <div class="c-ui-more__options js-ui-more-options" style="display: none;">
                  <div class="c-ui-more__option c-ui-more__option--red js-remove-comment-btn" data-edit-url="{{ route('front.createComment', $product->product_code) }}" data-id="{{ $comment->id }}" data-token="">
                    حذف نظر
                  </div>
                  <a class="c-ui-more__option c-ui-more__option js-ga-edit-comment-btn" href="{{ route('front.createComment', $product->product_code) }}" data-edit-url="{{ route('front.createComment', $product->product_code) }}">ویرایش نظر</a>
                </div>
              </div>
            </div>
          </div>
          <div class="c-profile-comments__product-row c-profile-comments__product-row--align-start">
            @if (round($comment->ratings->avg('score')))
            <div class="c-rate-box c-rate-box--normal">
              {{ persianNum(number_format((float)$comment->ratings->avg('score'), 1, '.', '')) }}
            </div>
            @endif
            <span class="c-profile-comments__spacer-dot"></span>

            @if((!is_null($comment->recommend_status)) || ($comment->recommend_status !== " "))
              @if ($comment->recommend_status == 'recommended')
                <div class="c-comment-advice c-comment-advice--recommend">خرید این محصول را توصیه می‌کنم</div>
              @elseif($comment->recommend_status == 'not_recommended')
                <div class="c-comment-advice c-comment-advice--not-recommend">خرید این محصول را توصیه نمی‌کنم</div>
              @elseif($comment->recommend_status == 'not_idea')
                <div class="c-comment-advice c-comment-advice--no-idea">در مورد خرید این محصول مطمئن نیستم</div>
              @endif
            @endif

          </div>
          <div class="c-profile-comments__product-row c-profile-comments__product-row--align-start">
            <p class="c-profile-comments__text">
              {{ $comment->text }}
            </p>
          </div>
          <div class="c-profile-comments__product-row c-profile-comments__product-row--align-start c-profile-comments__product-row--no-margin"></div>


          @if (!is_null($customerOrders))

          <div class="c-profile-comments__product-row c-profile-comments__product-row--border-top"></div>
            @foreach($customerOrders->groupBy('product_variant_id') as $customerOrder)
            <div class="c-profile-comments__product-row c-profile-comments__product-row--align-start c-profile-comments__product-row--no-margin">
              <div class="c-profile-comments__product-variant c-profile-comments__product-variant--color">
                @if (!is_null($customerOrder->first()->product_variant()->first()->variant->value))
                <span style="background-color: {{ $customerOrder->first()->product_variant()->first()->variant->value }}"></span>
                @endif
                {{ $customerOrder->first()->product_variant()->first()->variant->name }}
              </div>
            </div>

            <div class="c-profile-comments__product-row c-profile-comments__product-row--align-start c-profile-comments__product-row--no-margin">
              <div class="c-profile-comments__product-variant c-profile-comments__product-variant--seller">
                {{ $fa_store_name }}
              </div>
            </div>
            @endforeach
          @endif

        </div>
      </div>
      @endforeach
      <section class="c-pager"></section>
    @else
      <div class="c-profile-list__empty-container">
        <img src="https://www.digikala.com/static/files/d4fa2ec1.svg" alt="هیچ نظری ثبت نشده است.">
        <p>
          هیچ نظری ثبت نشده است.
        </p>
      </div>
    @endif
    </div>
  </div>
</section>
@endsection

@section('page-content')
@endsection

@section('script')
@endsection
