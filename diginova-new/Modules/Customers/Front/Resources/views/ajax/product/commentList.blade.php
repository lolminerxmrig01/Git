<div class="c-comments__list">
  @foreach($comments as $comment)

    <?php
    $advantages = json_decode($comment->advantages, true);
    $disadvantages = json_decode($comment->disadvantages, true);

    $customer = auth()->guard('customer')->user();

    if ($comment->customer->orders()->whereHas('consignment_variants', function ($q) use ($product) {$q->where('product_id', $product->id);$q->where('order_status_id', 4);})->exists()) {
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

{{--    @if((!isset($customerOrders) || is_null($customerOrders) || !count($customerOrders)) && $mode = 'buyers')--}}
{{--      @continue--}}
{{--    @endif--}}

    <div class="c-comments__item c-comments__item--pdp">
      <div class="c-comments__row">
        <span class="c-comments__title">{{ $comment->title }}</span>
      </div>
      <div class="c-comments__row">
        <span class="c-comments__detail span-time" data-value="{{ $comment->published_at }}"></span>
        <span class="c-comments__detail">
              {{ ($comment->is_anonymous == 1)? 'کاربر ' . $fa_store_name : ((!is_null($comment->customer->first_name))? $comment->customer->first_name . ' ' . $comment->customer->last_name : 'کاربر ' . $fa_store_name) }}
            </span>

        @if(isset($customerOrders) && !is_null($customerOrders) && count($customerOrders))
          <div class="c-comments__buyer-badge">خریدار</div>
        @endif
      </div>

      @if((!is_null($comment->recommend_status)) || ($comment->recommend_status !== " "))
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
        @if((!is_null($advantages) && count($advantages)) || (!is_null($advantages) && count($advantages)))
          <div class="c-comments__separator c-comments__separator--half"></div>
          <div class="c-comments__modal-evaluation">
            @foreach($advantages as $advantage)
              <div class="c-comments__modal-evaluation-item c-comments__modal-evaluation-item--positive">
                {{ $advantage['value'] }}
              </div>
            @endforeach

            @foreach($disadvantages as $disadvantage)
              <div class="c-comments__modal-evaluation-item c-comments__modal-evaluation-item--negative">
                {{--                    {{ $disadvantage['value'] }}--}}
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
