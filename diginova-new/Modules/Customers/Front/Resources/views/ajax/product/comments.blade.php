<div class="c-comments__container">
    <div class="c-comments__side-bar">
      <div class="c-comments__side-rating-container">
        @if ($product->ratings()->exists())
            <div class="c-comments__side-rating">
            <div class="c-comments__side-rating-main">
                {{ persianNum(round($product->ratings()->avg('score'), 1)) }}
            </div>
            <div class="c-comments__side-rating-desc">از ۵</div>
            </div>
        @else
            <div class="c-comments__side-no-rating">هنوز امتیازی ثبت نشده‌است</div>
        @endif

        <div class="c-comments__side-rating-bottom">
          <div class="c-stars">
            <span class="c-stars__item"></span>
            <span class="c-stars__item"></span>
            <span class="c-stars__item"></span>
            <span class="c-stars__item"></span>
            <span class="c-stars__item"></span>
            <div class="c-stars__selected"
                style="width: {{  $product->ratings()->exists() ? $product->ratings()->avg('score')*20 : 0 }}%">
              <span class="c-stars__item"></span>
              <span class="c-stars__item"></span>
              <span class="c-stars__item"></span>
              <span class="c-stars__item"></span>
              <span class="c-stars__item"></span>
            </div>
          </div>

          @if ($product->ratings()->exists())
          <div class="c-comments__side-rating-all">
            <?php
                $rating_sample = $product->ratings()->first();
            ?>
            از مجموع {{ persianNum($product->ratings()->where('rating_id', $rating_sample->id)->count()) }} امتیاز
          </div>
          @endif

        </div>
      </div>

      <ul class="c-content-expert__rating">
        @foreach ($product->categories()->first()->ratings as $item)
          <li>
            <div class="c-content-expert__rating-title">{{ $item->name }}</div>
            <div class="c-content-expert__rating-value">
              <div class="c-rating c-rating--general js-rating">
                <div class="c-rating__rate js-rating-value"
                    data-rate-value="{{ $product->ratings()->where('rating_id', $item->id)->exists()
                        ? ($product->ratings()->where('rating_id', $item->id)->avg('score'))*20
                        : 60 }}%"
                    style="width: {{ $product->ratings()->where('rating_id', $item->id)->exists()
                    ? ($product->ratings()->where('rating_id', $item->id)->avg('score'))*20
                    : 60 }}%"></div>
              </div>
              <span class="c-rating__overall-word">
                {{ $product->ratings()->where('rating_id', $item->id)->exists()
                ? persianNum(round($product->ratings()->where('rating_id', $item->id)->avg('score'), 1))
                : persianNum(3)  }}
            </span>
            </div>
          </li>
        @endforeach
      </ul>

      <div class="c-comments__add-comment-desc">
          دیدگاه خود را درباره این کالا بیان کنید
      </div>
      <a href="{{ route('front.createComment', [$product->product_code]) }}"
           class="o-btn o-btn--outlined-red-md o-btn--full-width js-add-new-comment">
           افزودن دیدگاه
        </a>
    </div>

  <div class="c-comments__content-section">
    @if(count($comments))
        <div class="c-sort-row">
        <i class="c-icon-font c-icon-font--large  js-icon-font" data-icon="Icon-Action-Sort"
         data-icon-active="Icon-Action-Sort" data-icon-deactive=""></i>

        <span class="c-sort-row__text">مرتب‌سازی دیدگاه‌ها بر اساس:</span>
        <ul class="c-sort-row__items js-filter-items">
            <li class="c-sort-row__item">
            <a href="#" class="c-sort-row__label " data-sort-mode="newest_comment">
                جدیدترین دیدگاه‌ها
            </a>
            </li>
            <li class="c-sort-row__item">
              <a href="#" class="c-sort-row__label " data-sort-mode="most_liked">
                مفیدترین دیدگاه‌ها
              </a>
            </li>
            <li class="c-sort-row__item">
              <a href="#" class="c-sort-row__label " data-sort-mode="buyers">
                دیدگاه خریداران
              </a>
            </li>
        </ul>
        </div>
    @else
        <div class="c-comments__empty">
            <div class="c-comments__empty-title">شما هم می‌توانید در مورد این کالا نظر دهید.</div>
            <div class="c-comments__empty-desc">اگر این محصول را قبلا از دیجی‌کالا خریده باشید، دیدگاه شما به عنوان خریدار ثبت خواهد شد. همچنین در صورت تمایل می‌توانید به صورت ناشناس دیدگاه خود را ثبت کنید.</div>
        </div>
    @endif


    <div id="product-comment-list">

      <div class="c-comments__list">
        @foreach($comments as $comment)

          <?php
            $advantages = json_decode($comment->advantages, true);
            $disadvantages = json_decode($comment->disadvantages, true);

            $customer = auth()->guard('customer')->user();

            if ($comment->customer->orders()->whereHas('consignment_variants', function ($q) use ($product) {$q->where('product_id', $product->id);
                    $q->where('order_status_id', 4);})->exists()) {
              $customerOrders = $comment->customer->orders()->whereHas('consignment_variants', function ($q) use ($product) {
                $q->where('product_id', $product->id);
                $q->where('order_status_id', 4);
              })->get();
            }
            else {
              $customerOrders = null;
            }


            $variant_ids = [];
            if (!is_null($customerOrders)) {
              foreach ($customerOrders as $order)
              {
                foreach ($order->consignment_variants()->where('product_id', $product->id)->get() as $consignment_variant)
                {
                  $variant_ids[] = $consignment_variant->product_variant()->first()->variant->id;
                }
              }
            }
        ?>

{{--          @if((!isset($customerOrders) || is_null($customerOrders) || !count($customerOrders)) && $mode = 'buyers')--}}
{{--            @continue--}}
{{--          @endif--}}

          <div class="c-comments__item c-comments__item--pdp">
          <div class="c-comments__row">
            <span class="c-comments__title">{{ $comment->title }}</span>
          </div>
          <div class="c-comments__row">
            <span class="c-comments__detail span-time" data-value="{{ $comment->published_at }}"></span>
            <span class="c-comments__detail">
              {{ $comment->is_anonymous == 1
                ? 'کاربر ' . $fa_store_name
                : ((!is_null($comment->customer->first_name))
                ? $comment->customer->first_name . ' ' . $comment->customer->last_name
                : 'کاربر ' . $fa_store_name)
              }}
            </span>

            @if($customerOrders)
              <div class="c-comments__buyer-badge">خریدار</div>
            @endif
          </div>

          @if($comment->recommend_status && ($comment->recommend_status !== " "))
            <div class="c-comments__separator c-comments__separator--half"></div>
            <div class="c-comments__row">
              @if ($comment->recommend_status == 'recommended')
                <div class="c-comments__status c-comments__status--positive">خرید این محصول را توصیه می‌کنم</div>
              @elseif($comment->recommend_status == 'not_recommended')
                <div class="c-comments__status c-comments__status--negative">خرید این محصول را توصیه نمی‌کنم</div>
              @elseif($comment->recommend_status == 'not_idea')
                <div class="c-comments__status c-comments__status--not-sure">در مورد خرید این محصول مطمئن نیستم</div>
              @endif
            </div>
          @endif

          <div class="c-comments__row c-comments__row--grow c-comments__row--comment">
            <div class="c-comments__content">{{ $comment->text }}</div>
            @if($advantages)
              <div class="c-comments__separator c-comments__separator--half"></div>
              <div class="c-comments__modal-evaluation">
                @foreach($advantages as $advantage)
                  <div class="c-comments__modal-evaluation-item c-comments__modal-evaluation-item--positive">
                    {{ $advantage['value'] }}
                  </div>
                @endforeach

                @foreach($disadvantages as $disadvantage)
                  <div class="c-comments__modal-evaluation-item c-comments__modal-evaluation-item--negative">
                    {{ $disadvantage['value'] }}
                  </div>
                @endforeach
              </div>
            @endif
          </div>

          @if (isset($variant_ids) && !is_null($variant_ids) && count($variant_ids))
            <div class="c-comments__separator c-comments__separator--half"></div>
            <div class="c-comments__row">
                @foreach(array_unique($variant_ids) as $id)
                  <?php $variant = \Modules\Staff\Variant\Models\Variant::find($id); ?>
                  <div class="c-comments__color" style="margin-bottom: 10px;">
                    <span class="c-comments__color-circle" style="background-color: {{ $variant->value }}"></span>
                      {{ $variant->name }}
                  </div>
                @endforeach
              <a class="c-comments__seller">{{ $fa_store_name }}</a>
            </div>
          @endif


            <div class="c-comments__row">
            <div class="c-comments__helpful">
              <div class="c-comments__helpful-question">آیا این دیدگاه برایتان مفید بود؟</div>
              <div class="c-comments__helpful-items js-comment-like-container is-modal">
                <div class="c-comments__helpful-yes  js-comment-like {{ (!is_null($customer_id) && $comment->feedback()->where('customer_id', $customer_id)->where('status', 'like')->exists())? 'is-active' : '' }}" data-comment="{{ $comment->id }}">{{ ($comment->feedback()->exists())? persianNum($comment->feedback()->where('status', 'like')->count()) : '۰' }}</div>
                <div class="c-comments__helpful-yes  js-comment-dislike dislike-style {{ (!is_null($customer_id) && $comment->feedback()->where('customer_id', $customer_id)->where('status', 'dislike')->exists())? 'is-active' : '' }}" data-comment="{{ $comment->id }}" style="transform: rotate(180deg);">{{ ($comment->feedback()->exists())? persianNum($comment->feedback()->where('status', 'dislike')->count()) : '۰' }}</div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <div class="c-pager" id="comment-pagination">
        {{ $comments->links('front::ajax.product.layouts.commentPagination', ['product_code' => $product->product_code]) }}
      </div>

    </div>
  </div>
</div>

<script src="{{ asset('mehdi/staff/js/jalali-moment.browser.js') }}"></script>

<script>
  function persianNum() {
    String.prototype.toPersianDigits = function () {
      var id = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
      return this.replace(/[0-9]/g, function (w) {
        return id[+w]
      });
    }
  }

  function convertDate() {
    $(".span-time").each(function (){
      var output="";
      var input = $(this).data('value');
      var m = moment(input);
      if(m.isValid()){
        m.locale('fa');
        output = m.format("YYYY/M/D");
      }
      $(this).text(output.toPersianDigits());
    });
  }
  persianNum();
  convertDate();
</script>
