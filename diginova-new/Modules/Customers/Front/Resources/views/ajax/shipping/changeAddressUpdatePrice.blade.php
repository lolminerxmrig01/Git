<?php $cons_count = 0; ?>
@foreach($weights as $weight)
  @foreach ($first_carts as $item)
    @if ($item->product_variant()->first()->product->weight()->first()->id == $weight->id)
      <?php $cons_count++; ?>
      @break;
    @endif
  @endforeach
@endforeach
<div class="c-checkout-aside js-checkout-aside">
  <div class="c-checkout-bill">
    <ul class="c-checkout-bill__summary">
      <?php $sum_sale_price = 0; ?>
      @foreach($first_carts as $priceItem)
        <?php $sum_sale_price += ($priceItem->new_sale_price * $priceItem->count); ?>
      @endforeach
      <li>
        <span class="c-checkout-bill__item-title">
          قیمت کالاها
          ({{ persianNum($first_carts->count()) }})
        </span>
        <span class="c-checkout-bill__price">
          {{ persianNum(number_format(toman($sum_sale_price))) }}
          <span class="c-checkout-bill__currency">
              تومان
          </span>
        </span>
      </li>

      @if($first_carts->sum('new_promotion_price') > 0)

        <?php $sum_promotion_price = 0; ?>
        @foreach($first_carts as $priceItem)
          @if ($priceItem->new_sale_price > $priceItem->new_promotion_price)
            <?php $sum_promotion_price += (($priceItem->new_sale_price - $priceItem->new_promotion_price) * $priceItem->count); ?>
          @endif
        @endforeach
        <li>
          <span class="c-checkout-bill__item-title">
              تخفیف کالاها
          </span>
          <span class="c-checkout-bill__price c-checkout-bill__price--discount">
            <span>
              ({{ persianNum(number_format(($sum_promotion_price / $sum_sale_price) * 100)) }}٪)
            </span>
              {{ persianNum(number_format(toman($sum_promotion_price))) }}
            <span class="c-checkout-bill__currency"> تومان </span>
          </span>
        </li>
      @endif

      <li class="c-checkout-bill__sum-price">
        <span class="c-checkout-bill__item-title">
            جمع
        </span>
        <span class="c-checkout-bill__price">
          {{ persianNum(number_format(toman($sum_sale_price - $sum_promotion_price))) }}
          <span class="c-checkout-bill__currency">
              تومان
          </span>
        </span>
      </li>
      <li>
        <div class="c-checkout-bill__item-title">
          <span>
            هزینه ارسال
          </span>

          <div class="c-checkout-bill__shipping-history js-normal-delivery ">
            {{ persianNum($cons_count) }} مرسوله
            <div class="c-checkout-bill__shipping-history-container">
              <?php
                $m = 1;
                $sum_shipping_cost = 0;
              ?>
              @foreach($consignment_shipping_cost as $key => $item)
                <?php
                  $delivery_method = \Modules\Staff\Shiping\Models\DeliveryMethod::find($method_ids[$m-1]);
                  $sum_shipping_cost =+ $item;
                ?>
                <div class="c-checkout-bill__shipping-history-row ">
                  <span style="float: right;">مرسوله {{ persianNum($m) }} </span>
{{--                  <span class="c-checkout-bill__shipping-history-title js-package-row-title">--}}
{{--                    <span style="background-image: url({{ $site_url . '/' .  $delivery_method->media()->first()->path . '/' . $delivery_method->media()->first()->name }});width: 25px !important;height: 19px !important;float: right;background-repeat: no-repeat;background-size: 18px;margin-left: 0px;margin-top: 2px;"></span>--}}
{{--                  </span>--}}
                    <span>{{ $delivery_method->name }}</span>
                  </span>
                  <span class="c-checkout-bill__shipping-history-title js-package-row-alt-title u-hidden">
                     {{ persianNum($m) }}
                    <span class="c-checkout-bill__shipping-history-title--altShipping">
                       {{ $delivery_method->name }}
                    </span>
                  </span>
                  <span class="c-checkout-bill__shipping-history-price c-checkout-bill__shipping-history-price--free-plus c-digiplus-sign--after js-package-row-plus-free-amount u-hidden"><span class="c-checkout__plus-delivery-counter">
                                   از ۰
                              </span>
                    رایگان پلاس
                  </span>
                  <span class="c-checkout-bill__shipping-history-price js-package-row-non-free-amount">
                    <span class="c-checkout-bill__shipping-history-price--amount js-package-row-amount">
                      {{ persianNum(number_format(toman($item))) }}
                    </span>
                    <span class="c-checkout-bill__shipping-history-price--currency">
                      تومان
                    </span>
                  </span>
                  <span class="c-checkout-bill__shipping-history-price--free js-package-row-free-amount u-hidden">
                    رایگان
                  </span>
                </div>
                <?php $m++; ?>
              @endforeach
            </div>
          </div>

        </div>
        @if ($sum_shipping_cost == 0)
          <span class="c-checkout-bill__item-title js-free-shipping">
            رایگان
          </span>
        @elseif($sum_shipping_cost !== -1)
          <span class="c-checkout-bill__item-title js-not-free-shipping">
            <span class="js-shipping-cost"> {{ persianNum(number_format(toman($sum_shipping_cost))) }} </span>
            &nbsp;تومان
          </span>
        @endif
        @if (in_array(-1, $consignment_shipping_cost) && $sum_shipping_cost !== 0 && $sum_shipping_cost !== -1)
          <span class="c-checkout-bill__item-title js-shipping-divider"> + </span>
        @endif
        @if(in_array(-1, $consignment_shipping_cost))
        <span class="c-checkout-bill__item-title js-shipping-post-paid">پس کرایه</span>
        @endif
      </li>
      <li class="c-checkout-bill__shipping-cost-notice js-dynamic-shipping-cost-notice">
        هزینه بر اساس وزن و حجم مرسوله تعیین شده است.
      </li>
      <li class="c-checkout-bill__total-price">
        <span class="c-checkout-bill__total-price--title">
          مبلغ قابل پرداخت
        </span>
        <span class="c-checkout-bill__total-price--amount" id="cartPayablePrice">
          <?php
            $final_sum_price = toman($sum_sale_price - $sum_promotion_price + $sum_shipping_cost);
          ?>
            <span class="js-price" data-price="{{ $final_sum_price }}"> {{ persianNum(number_format($final_sum_price)) }} </span>
            <span class="c-checkout-bill__total-price--currency">
              تومان
            </span>
        </span>
      </li>
      <li class="c-checkout-bill__to-forward-button">
        <a class="o-btn o-btn--full-width o-btn--contained-red-lg js-save-shipping-data" style="pointer-events: all; cursor: pointer;">
          ادامه فرآیند خرید
        </a>
      </li>
    </ul>
  </div>
</div>
