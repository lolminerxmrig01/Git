<script>
    var supernova_mode = "production";
    var supernova_tracker_url = "";
    @if ($product_variants)
    var variants = {
      @foreach ($product_variants as $key => $item)
        <?php
          $promotion_price = null;
          if ($item->promotions()->exists()) {
            $promotion_price = $item->promotions()->active()->min('promotion_price');
            $variant_has_min_promotion = $item->promotions()
                ->where('promotion_price', $promotion_price)
                ->active()
                ->first();
            if ($variant_has_min_promotion) {
              $promotion_timer = $variant_has_min_promotion->end_at;
              $promotion = $variant_has_min_promotion;
            } else {
              $promotion_timer = null;
            }
          }
          if ($promotion_price == null) {
            $promotion_price = $item->sale_price;
            $promotion_timer = 'false';
            $promotion = null;
          }
          ?>
        "{{ $item->variant_code }}": {
          "id": {{ $item->variant_code }},
          "active": {{ ($item->status == 1)? 'true' : 'false' }},
          "active_digistyle": true,
          "ovl_selling_active": true,
          "title": "{{ $product->title_fa }}",
          @if($item->variant()->exists() && !is_null($item->variant->value))
          "color": {
            "id": {{ $item->variant->id }},
            "title": "{{ $item->variant->name }}",
            "code": "{{ $item->variant->value }}",
            "hexCode": "{{ $item->variant->value }}",
            "hex_code": "{{ $item->variant->value }}"
          },
          @elseif($item->variant()->exists())
          "size": {
              "id":{{ $item->variant->id }},
              "title":"{{ $item->variant->name }}",
              "sort":{{ $item->variant->position }}
            },
          @endif
          "site": "{{ $site_url }}",
          "warranty": {
            "id": {{ $item->warranty->id }},
            "title": "{{ $item->warranty->name }}",
            "description": null,
            "phone": null,
            "address": null,
            "working_hours": null,
            "condition": null
          },
          "marketplace_seller": {
            "id": 0,
            "name": "{{ $fa_store_name }}",
            "rate": 0,
            "rateCount": 0,
            "rating": {
              "cancel_percentage": 0,
              "cancel_summarize": "excellent",
              "return_percentage": 0,
              "return_summarize": "good",
              "ship_on_time_percentage": 0,
              "ship_on_time_summarize": "excellent",
              "final_score": 0,
              "final_percentage": 0
            },
            "stars": 0,
            "is_trusted": false,
            "is_official_seller": false,
            "is_roosta": false,
            "url": "",
            "registerTimeAgo": ""
          },
          "leadTime": 0,
          "shipping_type": "digikala",
          "gifts": [],
          "gift_product_ids": [],
          "seller_lead_time": 0,
          "market_place_selling_stock": 5,
          "is_fresh": false,
          "scheduled_stock": false,
          "promotion_price_id": null,
          "is_digikala_owner": {{ (\Modules\Staff\Setting\Models\Setting::where('name', 'symbol_image')->first()->media()->exists())? 'true' : 'false' }},
          "rank": 0,
          "sr": null,
          "has_similar_variants": true,
          "fast_shopping_badge": false,
          "fast_shopping_confirm": false,
          "is_multi_warehouse": false,
          "is_ship_by_seller": false,
          "is_eligible_for_jet_delivery": false,
          "plus_cash_back": null,
          "stats": null,
          "available_on_website": {{ ($item->stock_count > 0)? 'true' : 'false' }},
          "provider": "digikala",
          "is_heavy": false,
          "is_electronic": false,
          "sbs_seller_cities": [0],
          "price_list": {
            "id": 0{{ $item->variant_code }},
            "discount_percent": null,
            "rrp_price": {{ $item->sale_price }},
            "selling_price": {{ $promotion_price }},
            "is_incredible_offer": {{ ($item->promotions()->exists())? 'true' : 'false' }},
            "is_plus_offer": false,
            "is_sponsored_offer": false,
            "is_locked_for_plus": false,
            "promotion_id": null,
            @if ($promotion_timer !== 'false')
            "timer": "{{ $promotion_timer }}",
            @else
            "timer": null,
            @endif
            "pre_sell": false,
            "variant_id": {{ $item->variant_code }},
            "orderLimit": {{ $item->max_order_count }},
            "initial_limit": null,
            "tags": null,
            "cache_key_created_at": "",
            "cache_update_source": "supernova-digikala-desktop",
            "discount_amount": 0,
            "discount": 0,
            "show_discount_badge": false,
            "marketable_stock": {{ $item->stock_count }},
            "plus_variant_cash_back": 0
          },
          "addToCartUrl": "{{ route('front.addToCart', $item->variant_code) }}",
          "addToYaldaCartUrl": "",
          "dcPoint": 8,
          "is_free_shipment": false,
          "providerData": {
            "description": "{{ $fa_store_name }}",
            "providers": [{
              "title": "{{ $fa_store_name }}",
              "description": "این محصول توسط {{ $fa_store_name }} به فروش می رسد."
            }],
            "hasLeadTime": false,
            "badge_type": "without_lead_time"
          },
          "newProviderData": [{
            "type": "digikala",
            "has_lead_time": false,
            "text": "{{ $fa_store_name }}"
          }],
          "isExistsInWarehouse": {{ ($item->stock_count !== 0)? 'true' : 'false' }}
        },
      @endforeach
    };
    @endif
    var defaultVariantId = {{ !is_null($variant_defualt)? $variant_defualt->variant_code : 'null' }};
    var maxVisibleVariant = 3;
    var maxVisibleSupplier = 3;
    var hasColorOrSize = {{  ($variantGroup && $variantGroup->type !== 0) ? 1 : 0 }};
    var sellerStatistics = [];
    var hasQuickView = false;
    var cart = {"cartId": 0, "variants": [], "products": [], "itemCount": 0, "isPlusUser": false};
    var productId = {{ $product->product_code }};
    var videos = [];
    var enhanced_ecommerce = {
      "id": {{ $product->product_code }},
      "name": "{{ $product->title_fa }}",
      "category": "{{ $product->category()->first()->en_name }}",
      "category_id": {{ $product->category()->first()->id }},
      "brand": "{{ ($product->brand()->exists())? $product->brand->name : 'متفرقه' }}",
      "variant": {{ !is_null($variant_defualt)?  $variant_defualt->variant_code : 'null' }},
      "price": {{ isset($item)? $item->sale_price : 'null' }},
      "discount_percent": {{ (isset($promotion) && !is_null($promotion))? $promotion->percent : 0 }},
      "quantity": 1
    };
    var categoryId = {{ $product->category()->first()->id }};
    var nowTimeInUTC = "{{ now() }}";
    var emarsysCategoryBreadcrumb = [];
    var emarsysBrand = "{{ ($product->brand()->exists())? $product->brand->name : 'متفرقه' }}";
    var ecpd2 = {
      "id": {{ $product->product_code }},
      "title": "{{ $product->title_fa }}",
      "has_gift": false,
      "is_exclusive": false,
      "is_incredible": 0,
      "is_selling_and_sales": 0,
      "multi_color": true,
      "multi_size": true,
      "multi_warranty": true,
      "multi_seller": false,
      "site_category": ["", "", ""],
      "supply_category": ["{{ $product->category->first()->en_name }}", "{{ $product->category->first()->name }}"],
      "category": {"id": {{ $product->category->first()->id }}, "title": "{{ $product->category->first()->name }}"},
      "brand": {
        "id": {{ ($product->brand()->exists())? $product->brand->id : 0 }},
        "title": "{{ ($product->brand()->exists())? $product->brand->name : 'متفرقه' }}"
      },
      "price": {"selling_price": 782000, "discount_percent": 0},
      "status": "marketable",
      "variants": [
        {
          "id": 1,
          "seller": 0,
          "color": 1,
          "size": 0,
          "warranty": 3
        },
        {
          "id": 14056069,
          "seller": 16763,
          "color": 67,
          "size": 0,
          "warranty": 3
        },
        {
          "id": 13416583,
          "seller": 325102,
          "color": 1,
          "size": 0,
          "warranty": 3
        },
        {
          "id": 11911992,
          "seller": 16763,
          "color": 1,
          "size": 0,
          "warranty": 3
        },
        {
          "id": 12134031,
          "seller": 418108,
          "color": 1,
          "size": 0,
          "warranty": 3
        },
        {
          "id": 13520859,
          "seller": 143851,
          "color": 1,
          "size": 0,
          "warranty": 3
        },
        {
          "id": 15673751,
          "seller": 289363,
          "color": 1,
          "size": 0,
          "warranty": 3
        }
      ],
      @foreach($product->media as $image)
        @if($product->media && ($image->pivot->is_main == 1))
            "image_url": "{{ full_media_path($image) }}?x-oss-process=image\/resize,m_lfit,h_350,w_350\/quality,q_60",
        @endif
        @endforeach
      "product_url": "{{ route('front.productPage', $product->product_code) }}"
    };
    var isbn = null;
    var min_price_in_last_month = 0;
    var isPDP = true;
    var faqPageTitle = "pdp_section";
    var isAnanasFriendly = true;
    var userId = {{ (auth()->guard('customer')->check())? auth()->guard('customer')->user()->id : 'null' }};
    var adroRCActivation = true;
    var loginRegisterUrlWithBack = "/users/login-register";
    var isNewCustomer = false;
    var digiclubLuckyDrawEndTime = "";
    var activateUrl = "";
  </script>
