<?php

namespace Modules\Customers\Front\Http\Controllers;

use App\Models\State;
use App\Models\StoreAddress;
use App\Notifications\InvoicePaid;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Modules\Customers\Front\Models\Cart;
use Modules\Customers\Front\Models\CustomerFavorite;
use Modules\Staff\Brand\Models\Brand;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Comment\Models\Comment;
use Modules\Staff\Comment\Models\CommentFeedback;
use Modules\Staff\Customer\Models\CustomerAddress;
use Modules\Staff\Order\Models\ConsignmentHasProductVariants;
use Modules\Staff\Order\Models\Order;
use Modules\Staff\Order\Models\OrderAddress;
use Modules\Staff\Order\Models\OrderHasConsignment;
use Modules\Staff\Order\Models\OrderStaticDetail;
use Modules\Staff\Peyment\Models\PeymentMethod;
use Modules\Staff\Peyment\Models\PeymentRecord;
use Modules\Staff\Product\Models\Product;
use Illuminate\Http\Request;
use Modules\Staff\Product\Models\ProductHasVariant;
use Modules\Staff\Product\Models\ProductWeight;
use Modules\Staff\Setting\Models\Setting;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Modules\Staff\Shiping\Http\postPishtaz;
use Modules\Staff\Shiping\Http\postSefareshi;
use Modules\Staff\Shiping\Models\DeliveryMethod;
use Modules\Staff\ProductSwiper\Models\ProductSwiper;
use Modules\Staff\Shiping\Models\OrderStatus;
use Modules\Staff\Slider\Models\Slider;
use Modules\Staff\Voucher\Models\Voucher;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderStatusChanged;
use App\Notifications\OrderSubmited;
use Modules\Customers\Auth\Models\Customer;
use Kavenegar;

class FrontController extends Controller
{

    private $category_childs = [];

    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $index_meta_keywords = Setting::where('name', 'index_meta_keywords')->first()->value;
        $index_meta_description = Setting::where('name', 'index_meta_description')->first()->value;

        $amazing_offer_products = Product::whereHas('variants', function ($q) {
            $q->whereHas('promotions', function ($q) {
                $q->active()->whereHas('campain', function ($q) {
                    $q->where('type', 'amazing_offer');
                });
            });
        })->take(15)->get();

        $special_offer_products = Product::whereHas('variants', function ($q) {
            $q->whereHas('promotions', function ($q) {
                $q->active()->whereHas('campain', function ($q) {
                    $q->where('type', 'special_offer');
                });
            });
        })->take(15)->get();

        $productSwipers = ProductSwiper::where('status', 1)->whereHas('category', function ($q) {
            $q->whereHas('products', function ($q) {
                $q->whereHas('variants', function ($q) {
                    $q->where('stock_count', '>', 0)
                        ->where('status', 1);
                })->whereStatus(1);
            });
        })->orderBy('position', 'asc')->get();

        $content_sliders = Slider::whereIn('en_name', ['h', 'i', 'j'])
            ->where('status', 'active')->get();

        if (count($productSwipers) / (count($content_sliders) ? count($content_sliders) : 1)) {
            $primary = $productSwipers;
            $secondary = $content_sliders;
            $primaryType = 'productSwiper';
        } else {
            $primary = $content_sliders;
            $secondary = $productSwipers;
            $primaryType = 'slider';
        }

        return view(
            'front::index',
            compact(
                'customer',
                'amazing_offer_products',
                'special_offer_products',
                'productSwipers',
                'primary',
                'secondary',
                'primaryType',
                'index_meta_keywords',
                'index_meta_description'
            )
        );
    }

    public function productPage(int $product_code)
    {
        $product_title_prefix = Setting::whereName('product_title_prefix')->first()->value;
        $product = Product::where('product_code', $product_code)
            ->with('variants')
            ->firstOrFail();

        $variant_defualt = variant_defualt($product);

        $variant_ids = [];

        $variants = $product->variants()
            ->where('status', 1)
            ->where('stock_count', '>', 0)
            ->get();

        foreach ($variants as $p_variant) {
            if (isset($p_variant->variant->id) && !in_array($p_variant->variant->id, $variant_ids)) {
                $variant_ids[] = $p_variant->variant->id;
            }
        }

        $ratings = $product->ratings;


        $category = $product->category->first();
        do {
            $product_categories[] = $category;
            $category = $category->parent;
        } while (isset($category->parent));

        $product_categories[] = $category;
        $product_categories = array_reverse($product_categories, true);

        return view(
            'front::product',
            compact('product', 'variant_defualt', 'variant_ids', 'product_title_prefix', 'product_categories')
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function mainSearch(Request $request)
    {
        $product_code_prefix = Setting::where('name', 'product_code_prefix')->first();
        if ($product_code_prefix) {
            $product_code_prefix = $product_code_prefix->value;
        } else {
            $product_code_prefix = null;
        }

        $categories = Category::DigiSearch('name', $request->q)
            ->select('name', 'id', 'slug')
            ->take(3)
            ->get();

        $products = Product::DigiSearch('title_fa', $request->q)
            ->select('title_fa', 'id', 'slug', 'product_code')
            ->take(10)
            ->get();

        $categoriesArray = [];

        foreach ($categories as $category) {
            $categoriesArray[] =
                [
                    "title_prefix" => "همه کالاها دسته‌بندی",
                    "title" => "$category->name",
                    "url" => "/search/category-$category->slug/",
                    "icon_image" => null
                ];
        }

        foreach ($products as $product) {
            $product_img = g_product_image_main_src($product);
            $product_slug = "product/$product_code_prefix-$product->product_code";
            $productsArray[] =
                [

                    "id" => $product->id,
                    "title" => "$product->title_fa",
                    "image" => "$product_img?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60",
                    "url" => "$product_slug"
                ];
        }

        return response()->json([
            'status' => true,
            'data' => [
                "search_result" => "",
                "auto_complete" => [
                    [
                        "url" => "search/?q=$request->q",
                        "label" => "$request->q"
                    ],
                ],
                "trends_result" => [],
                "advance_links" => isset($categoriesArray) ? $categoriesArray : '',
                "suggestion_products" => isset($productsArray) ? $productsArray : '',
                "query" => "$request->q",
            ],
        ], 200);
    }

    /**
     *
     */
    public function categoryPage($slug)
    {

        $category = Category::whereSlug($slug)->firstOrFail();

        $products = QueryBuilder::for(Product::class)
            ->whereHas('category', function(Builder $query) use ($category) {
                foreach($this->getCategoryChilds($category) as $key => $id) {
                    if ($key = 0) {
                        $query->where('id', $id);
                    } else {
                        $query->orWhere('id', $id);
                    }
                }
            })
            ->orderBy('has_stock', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(1);

        $max_price = $category->products()->max('min_price');

        $cat = $category;

        $categories = Category::all();

        $list = $this->fullCategoryList($category);

        $fullCategoryList = [];
        foreach($list as $category_id) {
            $fullCategoryList[] = Category::find($category_id);
        }

        $other_categories = $category->children
        ? $category->children->where('id', '<>', $category->id)
        : $category;

        $end_index = end($list);
        array_pop($list);
        $new_end = end($list);

        $brands = Brand::whereHas('products', function ($q) use ($category) {
            $q->whereRelation('category', 'category_id', $category->id);
        })->get();

        $attribute_groups = $cat->attributeGroups;


        return view(
            'front::category',
            compact('cat', 'category', 'fullCategoryList', 'categories', 'brands',
             'products', 'slug', 'max_price', 'attribute_groups', 'other_categories')
        );
    }

    /**
     * @param $order_code
     */
    public function profileOrders($order_code)
    {
    }

    public function productComments(Request $request, $product_id)
    {
        $product = Product::where('product_code', $product_id)
            ->first();

        $comments = $product->comments()
            ->accepted()
            ->paginate(2);

        $mode = $request['mode'] == 'buyers'
            ? 'buyers'
            : 'newest_comment';

        $customer_id = Auth::guard('customer')->check()
            ? Auth::guard('customer')->user()->id
            : null;

        return view(
            'front::ajax.product.comments',
            compact('comments', 'product', 'customer_id', 'mode')
        );
    }

    public function productCommentList(Request $request, $product_id)
    {

        $product = Product::where('product_code', $product_id)
            ->first();

        $comments = $product->comments()
            ->accepted()
            ->paginate(2);

        $mode = $request['mode'] == 'buyers'
            ? 'buyers'
            : 'newest_comment';

        $customer_id = Auth::guard('customer')->check()
            ? Auth::guard('customer')->user()->id
            : null;

        return view('front::ajax.product.commentList',
            compact('comments', 'product', 'customer_id', 'mode'));
    }

    /**
     * @param $product_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createComment($product_id)
    {
        $customer = auth()->guard('customer')->user();
        $store_email = Setting::where('name', 'store_email')->first()->value;

        $product = Product::where('product_code', $product_id)
            ->first();

        $ratings = $product->categories()->first()->ratings()->orderBy('position', 'asc')->get();

        return view('front::create-comment', compact('product', 'store_email', 'customer', 'ratings'));
    }

    /**
     * @param Request $request
     * @param $product_code
     * @return \Illuminate\Http\JsonResponse
     */
    public function createComments(Request $request, $product_code)
    {

        $product = Product::where('product_code', $product_code)->first();
        $is_buyed = is_buyed($product);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable',
            'text' => 'required',
            'recommend' => "nullable|required_if:$is_buyed,true",
            'advantages' => 'nullable',
            'disadvantages' => 'nullable',
        ]);

        if ($validator->fails()) {
            //      $errors = $validator->errors();
            return response()->json([
                'status' => false,
                'data' => [
                    'errors' => 'خطا',
                ]
            ]);
        }

        Comment::create([
            'title' => $request->title,
            'text' => $request->text,
            'recommend' => isset($request->recommend) ? $request->recommend : '',
            'advantages' => isset($request->advantages) ? json_encode($request->advantages) : '',
            'disadvantages' => isset($request->disadvantages) ? json_encode($request->disadvantages) : '',
            'product_id' => $product->id,
            'customer_id' => auth()->guard('customer')->user()->id,
        ]);

        return response()->json([
            'status' => true,
            'data' => null,
        ], 200);
    }

    /**
     * @param $product_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToFavorites($product_id)
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $product_id = Product::where('product_code', $product_id)->first()->id;
        if (!CustomerFavorite::where('product_id', $product_id)->where('customer_id', $customer_id)->exists()) {
            CustomerFavorite::create([
                'customer_id' => $customer_id,
                'product_id' => $product_id,
            ]);

            return response()->json([
                'status' => true,
                'data' => null,
            ]);
        }


        return response()->json([
            'status' => true,
            'data' => null,
        ]);
    }

    /**
     * @param $product_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromFavorites($product_id)
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $product_id = Product::where('product_code', $product_id)->first()->id;

        CustomerFavorite::where('product_id', $product_id)
            ->where('customer_id', $customer_id)
            ->first()
            ->delete();

        return response()->json([
            'status' => true,
            'data' => null,
        ]);
    }

    public function removeComment($id)
    {
        if (Comment::where('id', $id)->exists()) {
            Comment::find($id)->delete();
        }
        return response()->json([
            'status' => true,
            'data' => null,
        ]);
    }

    /**
     * @param $comment_id
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function likeComment($comment_id)
    {

        if (Auth::guard('customer')->check()) {
            $customer_id = Auth::guard('customer')->user()->id;
        } else {
            return null;
        }

        $comment_feedback = CommentFeedback::where('comment_id', $comment_id)
            ->where('customer_id', $customer_id)
            ->get();

        $like_comment_feedback = CommentFeedback::where('comment_id', $comment_id)
            ->where('customer_id', $customer_id)
            ->like()
            ->first();

        $dislike_comment_feedback = CommentFeedback::where('comment_id', $comment_id)
            ->where('customer_id', $customer_id)
            ->dislike()
            ->first();



        if ($comment_feedback) {
            if ($like_comment_feedback) {
                $like_comment_feedback->delete();
                $likeFlag = -1;
            }
            else {
                if ($dislike_comment_feedback) {
                    $dislike_comment_feedback->update([
                        'status' => 'like',
                    ]);
                }
                $likeFlag = 1;
            }
        }

        if (!$comment_feedback) {
            CommentFeedback::create([
                'comment_id' => $comment_id,
                'customer_id' => $customer_id,
                'status' => 'like',
            ]);
            $likeFlag = 1;
        }

        $comment_likes_count = CommentFeedback::where('comment_id', $comment_id)
            ->where('status', 'like')
            ->count();

        $comment_dislikes_count = CommentFeedback::where('comment_id', $comment_id)
            ->where('status', 'dislike')
            ->count();

        return response()->json([
            'status' => true,
            'data' => [
                "likes" => $comment_likes_count,
                "dislikes" => $comment_dislikes_count,
                "type" => 1,
                "LikeFlag" => $likeFlag,
                "DislikeFlag" => 0,
            ],
        ], 200);
    }

    /**
     * @param $comment_id
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function dislikeComment($comment_id)
    {

        if (Auth::guard('customer')->check()) {
            $customer_id = Auth::guard('customer')->user()->id;
        } else {
            return null;
        }

        if (CommentFeedback::where('comment_id', $comment_id)->where('customer_id', $customer_id)->exists()) {
            if (CommentFeedback::where('comment_id', $comment_id)->where('customer_id', $customer_id)->where('status', 'dislike')->exists()) {
                CommentFeedback::where('comment_id', $comment_id)->where('customer_id', $customer_id)->where('status', 'dislike')->delete();
                $dislikeFlag = -1;
            } else {
                if (CommentFeedback::where('comment_id', $comment_id)->where('customer_id', $customer_id)->where('status', 'like')->exists()) {
                    CommentFeedback::where('comment_id', $comment_id)->where('customer_id', $customer_id)->where('status', 'like')->update([
                        'status' => 'dislike',
                    ]);
                }
                $dislikeFlag = 1;
            }
        } else {
            CommentFeedback::create([
                'comment_id' => $comment_id,
                'customer_id' => $customer_id,
                'status' => 'dislike',
            ]);
            $dislikeFlag = 1;
        }

        $comment_likes_count = CommentFeedback::where('comment_id', $comment_id)
            ->where('status', 'like')
            ->count();

        $comment_dislikes_count = CommentFeedback::where('comment_id', $comment_id)
            ->where('status', 'dislike')
            ->count();

        return response()->json([
            'status' => true,
            'data' => [
                "likes" => $comment_likes_count,
                "dislikes" => $comment_dislikes_count,
                "type" => 1,
                "LikeFlag" => 0,
                "DislikeFlag" => $dislikeFlag,
            ],
        ], 200);
    }


    public function cart()
    {
        $customer = auth()->guard('customer')->user();
        $carts = $customer->carts;

        foreach ($carts as $item) {
            $old_sale_price = $item->old_sale_price;
            $old_promotion_price = $item->old_promotion_price;

            $new_sale_price = $item->new_sale_price;
            $new_promotion_price = $item->new_promotion_price;

            $item->update([
                'old_sale_price' => $new_sale_price,
                'new_sale_price' => $item->product_variant()->first()->sale_price,

                'old_promotion_price' => $new_promotion_price,
                'new_promotion_price' => $item->product_variant()->first()
                    ->promotions()
                    ->whereDate('start_at', '<=', now())
                    ->whereDate('end_at', '>=', now())
                    ->where('status', 'active')
                    ->orWhere('status', 1)
                    ->min('promotion_price'),
            ]);
        }

        $first_carts = $customer->carts()->where('type', 'first')->get();
        $second_carts = $customer->carts()->where('type', 'second')->get();
        $carts = $customer->carts;

        return view('front::cart', compact('carts', 'first_carts', 'second_carts'));
    }

    /**
     * @param $variant_id
     * @param $count
     * @return \Illuminate\Http\JsonResponse
     */
    public function cartChange($variant_id, $count)
    {
        $customer = Auth::guard('customer')->user();
        $carts = $customer->carts;

        foreach ($carts as $item) {
            $old_sale_price = $item->old_sale_price;
            $new_sale_price = $item->new_sale_price;

            $old_promotion_price = $item->old_promotion_price;
            $new_promotion_price = $item->new_promotion_price;

            $item->update([
                'old_sale_price' => $new_sale_price,
                'new_sale_price' => $item->product_variant()->first()->sale_price,

                'old_promotion_price' => $new_promotion_price,
                'new_promotion_price' => $item->product_variant()->first()->promotions()->active()->min('promotion_price'),
            ]);
        }

        Cart::where('customer_id', $customer->id)->where('product_variant_id', $variant_id)->first()->update([
            'count' => $count,
        ]);
        $first_carts = $customer->carts()->where('type', 'first')->get();
        return response()->json([
            "status" => true,
            "data" => [
                "data" => View::make('front::layouts.cart.changeCartResponseData', compact('first_carts'))->render(),
                //        "miniCartData" => View::make('front::layouts.cart.miniCartData')->render(),
            ]
        ]);
    }

    /**
     * @param $variant_code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart($variant_code)
    {

        $product_variant = ProductHasVariant::where('variant_code', $variant_code)->first();
        $promotion_price = $product_variant->promotions()->active()->min('promotion_price');

        if (auth()->guard('customer')->check() && !Cart::where('product_variant_id', $product_variant->id)->exists()) {
            Cart::create([
                'customer_id' => Auth::guard('customer')->user()->id,
                'type' => 'first',
                'count' => 1,
                'old_sale_price' => $product_variant->sale_price,
                'old_promotion_price' => $promotion_price,
                'new_sale_price' => $product_variant->sale_price,
                'new_promotion_price' => $promotion_price,
                'product_variant_id' => $product_variant->id,
            ]);
        } elseif (auth()->guard('customer')->check()) {
            Cart::where('product_variant_id', $product_variant->id)->first()->increment('count');
        }



        return redirect()->route('front.cart');
    }

    /**
     * @param $variant_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveForLater($variant_id)
    {

        $customer = Auth::guard('customer')->user();

        Cart::where('customer_id', $customer->id)->where('product_variant_id', $variant_id)->where('type', 'first')->first()->update([
            'type' => 'second',
        ]);

        return response()->json([
            'status' => true,
            'data' => [
                'redirectUrl' => route('front.cart'),
            ],
        ]);
    }

    /**
     * @param $variant_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromCart($variant_id)
    {
        $customer = Auth::guard('customer')->user();

        Cart::where('customer_id', $customer->id)
            ->where('product_variant_id', $variant_id)
            ->first()
            ->delete();

        return redirect()->route('front.cart');
    }

    /**
     * @param $variant_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromSaveForLaterAjax($variant_id)
    {
        $customer = auth()->guard('customer')->user();

        Cart::where('product_variant_id', $variant_id)
            ->where('customer_id', $customer->id)
            ->where('type', 'second')->first()->delete();

        return response()->json([
            'status' => true,
            'data' => [
                'redirectUrl' => route('front.cart'),
            ],
        ]);
    }


    /**
     * @param $variant_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromSaveForLater($variant_id)
    {
        $customer = auth()->guard('customer')->user();

        Cart::where('product_variant_id', $variant_id)
            ->where('customer_id', $customer->id)
            ->where('type', 'second')->first()->delete();

        return redirect()->back();
    }

    /**
     * @param $variant_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function moveToFirstCart($variant_id)
    {
        $customer = Auth::guard('customer')->user();

        Cart::where('customer_id', $customer->id)
            ->where('product_variant_id', $variant_id)
            ->where('type', 'second')->first()->update([
                'type' => 'first',
                'count' => 1,
            ]);

        return response()->json([
            'status' => true,
            'data' => [
                'redirectUrl' => route('front.cart'),
            ],
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function moveAllToFirstCart()
    {
        $customer = Auth::guard('customer')->user();

        Cart::where('customer_id', $customer->id)
            ->where('type', 'second')
            ->first()
            ->update([
                'type' => 'first',
            ]);

        return response()->json([
            'status' => true,
            'data' => [
                'redirectUrl' => route('front.cart'),
            ],
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function addAddress()
    {
        $states = State::all();
        $customer = Auth::guard('customer')->user();
        return view('front::add-address', compact('states', 'customer'));
    }

    /**
     * @param $state_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function cityLoader($state_id)
    {

        $state = State::find($state_id);
        $cities = $state->childs()->where('type', 'city')->get();

        foreach ($cities as $city) {
            $cityArray[] = ['id' => $city->id, 'name' => $city->name, 'state_id' => $city->state_id];
        }

        return response()->json([
            'status' => true,
            'data' => $cityArray,
        ]);
    }

    /**
     * @param $district_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function districtLoader($district_id)
    {

        $city = State::find($district_id);
        $districts = $city->childs()->where('type', 'district')->get();

        foreach ($districts as $district) {
            $districtArray[] = ['id' => $district->id, 'name' => $district->name, 'state_id' => $district->state_id];
        }

        return response()->json([
            'status' => true,
            'data' => isset($districtArray) ? $districtArray : '',
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchAddressReverse(Request $request)
    {

        $client = new Client();
        $map_apikey = Setting::where('name', 'map_apikey')->first()->value;
        $response = $client->get("https://map.ir/reverse?lat=$request->latitude&lon=$request->longitude&x-api-key={$map_apikey}");
        $response = json_decode($response->getBody(), true);

        //    return $response;

        if (State::where('name', $response['city'])->where('type', 'city')->exists()) {
            $city_id = State::where('name', $response['city'])->where('type', 'city')->first()->id;
        } else {
            $city_id = State::where('name', $response['district'])->where('type', 'city')->first()->id;
        }
        $state_id = State::where('name', $response['province'])->where('type', 'state')->first()->id;

        return response()->json([
            'status' => true,
            'data' => [
                'address' => $response['address_compact'],
                'city_id' => $city_id,
                'state_id' => $state_id,
            ],
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchAddress(Request $request)
    {

        $client = new Client();
        $map_apikey = Setting::where('name', 'map_apikey')->first()->value;
        $response = $client->get("https://map.ir/search/v2/autocomplete?text={$request->address}&x-api-key={$map_apikey}");
        $response = json_decode($response->getBody(), true);

        foreach ($response['value'] as $key => $item) {
            $responseItems[$key] = ['title' => $item['title'], 'address' => $item['address'], 'longitude' => $item['geom']['coordinates'][0], 'latitude' => $item['geom']['coordinates'][1],];
        }


        return response()->json([
            'status' => true,
            'data' => $responseItems,

            //      'data' => [
            //        'title' => $response['value'],
            //        'address' => $response['address_compact'],
            //        'latitude' => $response['address_compact'],
            //        'longitude' => $response['address_compact'],
            //      ],

        ]);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveAddressLogic($request)
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $customer = Auth::guard('customer')->user();

        $validator = Validator::make($request->all(), [
            "address.lat" => "required",
            "address.lng" => "required",
            "address.address" => "required",
            "address.bld_num" => "required",
            "address.apt_id" => "nullable",
            "address.post_code" => "required",
            "address.recipient_is_self" => "nullable",
            "address.first_name" => "nullable",
            "address.last_name" => "nullable",
            "address.national_id" => "nullable",
            "address.mobile_phone" => "nullable",
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => false,
                'data' => [
                    'errors' => $errors,
                ]
            ]);
        }


        CustomerAddress::create([
            'lan' => $request->address['lat'],
            'len' => $request->address['lng'],
            'address' => $request->address['address'],
            'plaque' => enNum($request->address['bld_num']),
            'unit' =>  enNum($request->address['apt_id']),
            'postal_code' =>  enNum($request->address['post_code']),
            'is_recipient_self' => (isset($request->address['recipient_is_self']) && ($request->address['recipient_is_self'] == "true")),
            'recipient_firstname' => filled($request->address['first_name']) ? enNum($request->address['first_name']) : null,
            'recipient_lastname' =>  filled($request->address['last_name']) ? enNum($request->address['last_name']) : null,
            'recipient_national_code' => filled($request->address['national_id']) ? enNum($request->address['national_id']) : null,
            'recipient_mobile' => filled($request->address['mobile_phone']) ? ltrim(enNum($request->address['mobile_phone']), 0) : null,
            //      'is_main' => $request->address[''],
            'customer_id' => $customer_id,
            'state_id' => filled($request->address['district_id']) ? enNum($request->address['district_id']) : enNum($request->address['city_id']),
        ]);


        if (! $customer->delivery_address) {
            $defualt_address_id = $customer->addresses()->latest()->first()->id;
            $customer->update([
                'address_type' => 'CustomerAddress',
                'address_id' => $defualt_address_id,
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAddress(Request $request)
    {
        $this->saveAddressLogic($request);
        return redirect()->route('front.shipping');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveAddressFromShipping(Request $request)
    {

        $this->saveAddressLogic($request);

        $store_addresses = StoreAddress::all();
        $customer = Auth::guard('customer')->user();
        if ($customer->where('address_type', 'CustomerAddress')->exists()) {
            $delivery_type = 'customer';
        } else {
            $delivery_type = 'store';
        }

        return response()->json([
            "status" => true,
            "data" => [
                "data" => View::make('front::ajax.shipping.changeAddress', compact('customer', 'store_addresses', 'delivery_type'))->render(),
                "stickyCart" => View::make('front::ajax.shipping.changeAddressUpdatePrice')->render(),
                "invalidData" => '<div class="swiper-container swiper-container-horizontal js-swiper-delivery-limit"><div class="swiper-wrapper"></div><div class="swiper-button-prev js-swiper-button-prev"></div><div class="swiper-button-next js-swiper-button-next"></div></div>',
                "hasInvalidItems" => false,
                "changeAddress" => false,
                "errorMessageForInvalidItems" => null,
                "nonInteraction" => false,
                "skipItemIds" => [],
                "errorMessage" => null
            ]
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function shipping()
    {

        if (Cart::where('type', 'first')->doesntExist()) {
            return abort(404);
        }

        $customer = Auth::guard('customer')->user();

        if (!$customer->addresses()->exists()) {
            return redirect()->route('front.addAddress');
        }

        $states = State::all();
        $customer = Auth::guard('customer')->user();
        $first_carts = $customer->carts()->where('type', 'first')->get();
        $store_addresses = StoreAddress::all();
        $weights = ProductWeight::all();

        foreach ($weights as $i => $weight) {
            foreach ($first_carts as $item) {
                if ($item->product_variant->product->weight()->first()->id == $weight->id) {
                    $has_consignment = true;
                }

                if (isset($has_consignment) && $has_consignment) {
                    $sum_weight = 0;
                    foreach ($first_carts as $key => $cart) {
                        if ($cart->product_variant()->first()->product->weight()->first()->id == $weight->id) {
                            $sum_weight += $cart->product_variant()->first()->product->weight;
                            if ($first_carts->count() - 1 == $key) {
                                if ($weight->deliveryMethods()->exists()) {
                                    foreach ($weight->deliveryMethods()->where('status', 'active')->get() as $key => $method) {
                                        if ($sum_weight > 5000 && $method->id == 1) {
                                            continue;
                                        }
                                        $method_ids[] = $method->id;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $consignment_shipping_cost = $this->shippingCostLogic($customer, $weights, $method_ids);

        return view('front::shipping', compact('states', 'customer', 'first_carts', 'store_addresses', 'weights', 'consignment_shipping_cost', 'method_ids'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function shippingCost(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $first_carts = $customer->carts()->where('type', 'first')->get();
        $weights = ProductWeight::all();
        $method_ids = $request->method_ids;

        $consignment_shipping_cost = $this->shippingCostLogic($customer, $weights, $method_ids);
        return response()->json([
            "status" => true,
            "data" => [
                "data" => View::make('front::ajax.shipping.changeAddressUpdatePrice', compact('customer', 'first_carts', 'weights', 'consignment_shipping_cost', 'method_ids'))->render(),
            ]
        ]);
    }

    /**
     * @param $customer
     * @param $weights
     * @param $method_ids
     * @return array
     */
    public function shippingCostLogic($customer, $weights, $method_ids)
    {

        $store_addresses = StoreAddress::all();

        if ($customer->where('address_type', 'CustomerAddress')->exists()) {
            $delivery_type = 'customer';
        } else {
            $delivery_type = 'store';
        }

        $cart = $customer->carts()->where('type', 'first')->get();
        $first_carts = $customer->carts()->where('type', 'first')->get();
        $weights = ProductWeight::all();
        $fillable_weight_ids = [];
        $consignment_shipping_cost = [];

        $settings = Setting::all();
        $store_city = $settings->where('name', 'store_city')->first();
        $store_state_id = ($store_city && $store_city->states()->exists())
            ? $store_city->states()->first()->id
            : 1;

        if ($customer->where('address_type', 'CustomerAddress')->exists()) {
            $customer_state_id = $customer->delivery_address->id;
        } else {
            $customer_state_id = 0;
        }

        foreach ($weights as $i => $weight) {
            foreach ($cart as $key => $item) {
                if (($item->product_variant()->first()->product->weight()->first()->id == $weight->id)) {
                    $fillable_weight_ids[] = $weight->id;
                    if (isset($consignment_weight[$weight->id])) {
                        $consignment_weight[$weight->id] += $item->product_variant()->first()->product->weight;
                    } else {
                        $consignment_weight[$weight->id] = $item->product_variant()->first()->product->weight;
                    }
                }
            }
        }

        $fillable_weight_ids = array_unique($fillable_weight_ids);

        foreach ($fillable_weight_ids as $j => $f_weight_id) {
            if (!isset($method_ids[$j])) {
                $method_ids[$j] = $weight->deliveryMethods()->where('status', 'active')->first()->id;
            }

            if ($method_ids[$j] == 2 && $customer_state_id !== 0) {
                $consignment_shipping_cost[$f_weight_id] = postPishtaz::pishtaz($store_state_id, $customer_state_id, $consignment_weight[$f_weight_id])->getPrice();
                if (($consignment_shipping_cost[$f_weight_id] % 10000) > 5000) {
                    $consignment_shipping_cost[$f_weight_id] = $consignment_shipping_cost[$f_weight_id] + (10000 - $consignment_shipping_cost[$f_weight_id] % 10000);
                } else {
                    $consignment_shipping_cost[$f_weight_id] = $consignment_shipping_cost[$f_weight_id] - ($consignment_shipping_cost[$f_weight_id] % 10000);
                }
            }

            if ($method_ids[$j] == 1 && $customer_state_id !== 0) {
                $consignment_shipping_cost[$f_weight_id] = postSefareshi::sefarshi($store_state_id, $customer_state_id, $consignment_weight[$f_weight_id])->getPrice();
                if (($consignment_shipping_cost[$f_weight_id] % 10000) > 5000) {
                    $consignment_shipping_cost[$f_weight_id] = $consignment_shipping_cost[$f_weight_id] + (10000 - $consignment_shipping_cost[$f_weight_id] % 10000);
                } else {
                    $consignment_shipping_cost[$f_weight_id] = $consignment_shipping_cost[$f_weight_id] - ($consignment_shipping_cost[$f_weight_id] % 10000);
                }
            } elseif ($method_ids[$j] == 3) {
                $consignment_shipping_cost[$f_weight_id] = -1;
            } elseif ($method_ids[$j] == 4) {
                $consignment_shipping_cost[$f_weight_id] = !is_null(DeliveryMethod::find(4)->delivery_cost) ? DeliveryMethod::find(4)->delivery_cost : 0;
            }
            if (($method_ids[$j] == 1 || $method_ids[$j] == 2) && $customer_state_id == 0) {
                $consignment_shipping_cost[$f_weight_id] = 0;
            }
        }

        return $consignment_shipping_cost;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeSharedDeliveryAddress($id)
    {

        $store_addresses = StoreAddress::all();

        $customer = Auth::guard('customer')->user();

        $customer->update([
            "address_type" => "StoreAddress",
            "address_id" => $id
        ]);

        $delivery_type = 'store';

        return response()->json([
            "status" => true,
            "data" => [
                "data" => View::make('front::ajax.shipping.changeAddress',
                     compact('customer', 'store_addresses', 'delivery_type'))->render(),
                "stickyCart" => View::make('front::ajax.shipping.changeAddressUpdatePrice')->render(),
                "invalidData" => '<div class="swiper-container swiper-container-horizontal js-swiper-delivery-limit"><div class="swiper-wrapper"></div><div class="swiper-button-prev js-swiper-button-prev"></div><div class="swiper-button-next js-swiper-button-next"></div></div>',
                "hasInvalidItems" => false,
                "changeAddress" => false,
                "errorMessageForInvalidItems" => null,
                "nonInteraction" => false,
                "skipItemIds" => [],
                "errorMessage" => null
            ]
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeCustomerDeliveryAddress($id)
    {
        $store_addresses = StoreAddress::all();

        $customer = Auth::guard('customer')->user();

        $customer->update([
            "address_type" => "CustomerAddress",
            "address_id" => $id
        ]);

        $delivery_type = 'customer';

        return response()->json([
            "status" => true,
            "data" => [
                "data" => View::make('front::ajax.shipping.changeAddress', compact('customer', 'store_addresses', 'delivery_type'))->render(),
                "stickyCart" => View::make('front::ajax.shipping.changeAddressUpdatePrice')->render(),
                "invalidData" => '<div class="swiper-container swiper-container-horizontal js-swiper-delivery-limit"><div class="swiper-wrapper"></div><div class="swiper-button-prev js-swiper-button-prev"></div><div class="swiper-button-next js-swiper-button-next"></div></div>',
                "hasInvalidItems" => false,
                "changeAddress" => false,
                "errorMessageForInvalidItems" => null,
                "nonInteraction" => false,
                "skipItemIds" => [],
                "errorMessage" => null
            ]
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeCustomerDeliveryAddress($id)
    {

        $customer = Auth::guard('customer')->user();

        if (CustomerAddress::where('customer_id', $customer->id)->where('id', $id)->exists()) {
            CustomerAddress::where('customer_id', $customer->id)->where('id', $id)->first()->delete();
        }

        $store_addresses = StoreAddress::all();

        if ($customer->where('address_type', 'CustomerAddress')->exists()) {
            $delivery_type = 'customer';
        } else {
            $delivery_type = 'store';
        }

        if (!$customer->delivery_address()->exists() && $customer->addresses()->exists()) {
            $defualt_address_id = $customer->addresses()->latest()->first()->id;
            $customer->update([
                'address  _type' => 'CustomerAddress',
                'address_id' => $defualt_address_id,
            ]);
        }

        return response()->json([
            "status" => true,
            "data" => [
                "data" => View::make('front::ajax.shipping.changeAddress', compact('customer', 'store_addresses', 'delivery_type'))->render(),
                "stickyCart" => View::make('front::ajax.shipping.changeAddressUpdatePrice')->render(),
                "invalidData" => '<div class="swiper-container swiper-container-horizontal js-swiper-delivery-limit"><div class="swiper-wrapper"></div><div class="swiper-button-prev js-swiper-button-prev"></div><div class="swiper-button-next js-swiper-button-next"></div></div>',
                "hasInvalidItems" => false,
                "changeAddress" => false,
                "errorMessageForInvalidItems" => null,
                "nonInteraction" => false,
                "skipItemIds" => [],
                "errorMessage" => null
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function saveShippingToCookie(Request $request)
    {
        $method_ids = json_encode($request->method_ids);

        setcookie('method_ids', $method_ids, time() + (10 * 365 * 24 * 60 * 60), "/");
        return $_COOKIE["method_ids"];
    }

    /**
     * @param $errorMessage
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnError($errorMessage)
    {
        return response()->json([
            'status' => false,
            'data' => [
                'errors' => $errorMessage,
            ]
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function payment()
    {

        if (!isset($_COOKIE['method_ids']) || Cart::where('type', 'first')->doesntExist()) {
            return abort(404);
        }

        $customer = Auth::guard('customer')->user();
        $weights = ProductWeight::all();
        $first_carts = $customer->carts()->where('type', 'first')->get();
        $method_ids = json_decode($_COOKIE['method_ids'], true);
        $consignment_shipping_cost = $this->shippingCostLogic($customer, $weights, $method_ids);
        $peyment_methods = PeymentMethod::where('status', 'active')->get();

        return view('front::peyment', compact('customer', 'weights', 'first_carts', 'consignment_shipping_cost', 'method_ids', 'peyment_methods'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paymentVoucher(Request $request)
    {

        $customer = Auth::guard('customer')->user();
        $first_carts = $customer->carts()->where('type', 'first')->get();
        $weights = ProductWeight::all();
        $method_ids = json_decode($_COOKIE['method_ids'], true);
        $consignment_shipping_cost = $this->shippingCostLogic($customer, $weights, $method_ids);

        $code = $request->code;
        $code = 'PZOD2';


        if (!Voucher::where('code', $code)->where('status', 'active')->exists()) {
            return $this->returnError('این کد تخفیف قابل استفاده نیست.');
        }

        $voucher = Voucher::where('code', $code)->where('status', 'active')->first();

        if (!is_null($voucher->start_at) && $voucher->where('start_at', '>=', Carbon::now())->exists()) {
            return $this->returnError('زمان استفاده از کد تخفیف هنوز شروع نشده است.');
        }

        if (!is_null($voucher->end_at) && $voucher->where('end_at', '<=', Carbon::now())->exists()) {
            return $this->returnError('زمان استفاده از این کد تخفیف پایان یافته است.');
        }

        if (!is_null($voucher->max_usable) && $voucher->max_usable == 0) {
            return $this->returnError('تعداد قابل استفاده از این کد تخفیف پایان یافته است.');
        }

        if ($voucher->type == 'first_purchase' && $customer->orders()->exists()) {
            return $this->returnError('این کد تخفیف فقط برای مشتریان خرید اولی قابل استفاده می‌باشد.');
        }

        $voucher_varints_cost = $this->voucherCostLogic($customer, $voucher, $method_ids);

        if (PeymentRecord::where('customer_id', $customer->id)->where('method_type', 'Voucher')->where('status', 'unsuccessful')->exists()) {
            PeymentRecord::where('customer_id', $customer->id)->where('method_type', 'Voucher')->where('status', 'unsuccessful')->delete();
        }

        PeymentRecord::create([
            'status' => 'unsuccessful',
            'price' => $voucher_varints_cost,
            'method_type' => 'Voucher',
            'method_id' => $voucher->id,
            'customer_id' => $customer->id,
        ]);

        return response()->json([
            "status" => true,
            "data" => [
                "voucherDiscount" => $voucher_varints_cost,
                "voucher_code" => $code,
            ],
        ]);
    }

    /**
     * @param $customer
     * @param $voucher
     * @param $method_ids
     * @return float|int
     */
    public function voucherCostLogic($customer, $voucher, $method_ids)
    {

        $cart = $customer->carts()->where('type', 'first')->get();
        $first_carts = $customer->carts()->where('type', 'first')->get();
        $weights = ProductWeight::all();
        $voucher_varints_cost = 0;
        $voucher_categories_id = [];

        if ($voucher->categories()->exists()) {
            $category = $voucher->categories()->first();
            do {
                $voucher_categories_id[] = $category->id;
                $category = $category->parent;
            } while (isset($category));
        }

        foreach ($weights as $i => $weight) {
            foreach ($cart as $key => $item) {
                if (($item->product_variant()->first()->product->weight()->first()->id == $weight->id)) {
                    // چک میکنه که تنوع کالایی پروموشن داره یا نه
                    $product_variant = $item->product_variant()->first();
                    if ($product_variant->promotions()->exists()) {
                        if ($product_variant->promotions()->active()->exists()) {
                            $promotion_price = $product_variant->promotions()->active()->min('promotion_price');
                        } else {
                            $promotion_price = $product_variant->sale_price;
                        }
                    }

                    // اگه پروموشن داشت رد میکنه
                    if ($product_variant->sale_price !== $promotion_price) {
                        continue;
                    }

                    // اگه مبلغ کل سبد خرید کمتر از حداقل مبلغ مورد نیاز برای اعمال کد تخفیف بود رد کنه
                    $sum_cart_cost = $this->sumCartCost($first_carts);
                    if ($voucher->min_product_price !== null && $sum_cart_cost <= $voucher->min_product_price) {
                        continue;
                    }

                    // اگه کد تخفیف محدود به دسته‌بندی خاصی بود چک کنه سبد رو و هرکدوم که تو اون دسته و زیر مجموعه هاش نبود رو رد کنه
                    if ($voucher->categories()->exists()) {
                        $variant_category_id = $item->product_variant()->first()->product->category()->first()->id;
                        if (count($voucher_categories_id) && !in_array($variant_category_id, $voucher_categories_id)) {
                            continue;
                        }
                    }

                    $voucher_varints_cost += (($product_variant->sale_price / 100) * $voucher->percent);
                }
            }
        }

        if (!is_null($voucher->up_to) && $voucher_varints_cost > $voucher->up_to) {
            $voucher_varints_cost = $voucher->up_to;
        }

        $sum_cart_cost = $this->sumCartCost($first_carts);
        if (!is_null($voucher->up_to) && $voucher_varints_cost > $voucher->up_to && $sum_cart_cost < $voucher_varints_cost) {
            $voucher_varints_cost = $sum_cart_cost;
        }

        return $voucher_varints_cost;
    }

    /**
     * @param $first_carts
     * @return float|int
     */
    public function sumCartCost($first_carts)
    {
        $sum_sale_price = 0;
        $sum_promotion_price = 0;

        foreach ($first_carts as $priceItem) {
            $sum_sale_price += ($priceItem->new_sale_price * $priceItem->count);
            if ($priceItem->new_sale_price > $priceItem->new_promotion_price) {
                $sum_promotion_price += (($priceItem->new_sale_price - $priceItem->new_promotion_price) * $priceItem->count);
            }
        }

        return $sum_sale_price - $sum_promotion_price;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeVoucher()
    {

        $customer = Auth::guard('customer')->user();

        if (PeymentRecord::where('customer_id', $customer->id)->where('method_type', 'Voucher')->where('status', 'unsuccessful')->exists()) {
            PeymentRecord::where('customer_id', $customer->id)->where('method_type', 'Voucher')->where('status', 'unsuccessful')->delete();
        }

        return response()->json([
            'status' => true,
            'data' => null,
        ], 200);
    }

    /**
     * @return float|\Illuminate\Http\RedirectResponse|int
     */
    public function finalGetOrderCartAmount()
    {
        // اگه کوکی سیو نشده بود یا یوزر دیلیت زده بود ریدایررکت بشه به صفحه shipping
        if (!isset($_COOKIE['method_ids'])) {
            return redirect()->route('front.shipping');
        }

        $customer = Auth::guard('customer')->user();
        $weights = ProductWeight::all();
        $first_carts = $customer->carts()->where('type', 'first')->get();
        $method_ids = json_decode($_COOKIE['method_ids'], true);
        $peyment_methods = PeymentMethod::where('status', 'active')->get();
        $consignment_shipping_cost = $this->shippingCostLogic($customer, $weights, $method_ids);

        // مجموع قیمت اصلی فروش محصول بدون پروموشن
        $sum_sale_price = 0;
        foreach ($first_carts as $priceItem) {
            $sum_sale_price += ($priceItem->new_sale_price * $priceItem->count);
        }

        // مجموع قیمت پروموشن
        $sum_promotion_price = 0;
        foreach ($first_carts as $priceItem) {
            if ($priceItem->new_sale_price > $priceItem->new_promotion_price) {
                $sum_promotion_price += (($priceItem->new_sale_price - $priceItem->new_promotion_price) * $priceItem->count);
            }
        }

        // هزینه حمل
        $m = 1;
        $sum_shipping_cost = 0;
        foreach ($consignment_shipping_cost as $key => $item) {
            $delivery_method = \Modules\Staff\Shiping\Models\DeliveryMethod::find($method_ids[$m - 1]);
            $sum_shipping_cost = +$item;
            $m++;
        }

        // مبلغ نهایی بدون کد تخفیف
        return $final_sum_price = $sum_sale_price - $sum_promotion_price + $sum_shipping_cost;
    }

    /**
     * @return float|int|null
     */
    public function finalGetOrderVoucherAmount()
    {

        $customer = Auth::guard('customer')->user();
        if (!PeymentRecord::where('customer_id', $customer->id)->where('method_type', 'Voucher')->where('status', 'unsuccessful')->exists()) {
            return null;
        }

        $first_carts = $customer->carts()->where('type', 'first')->get();
        $weights = ProductWeight::all();
        $method_ids = json_decode($_COOKIE['method_ids'], true);
        $consignment_shipping_cost = $this->shippingCostLogic($customer, $weights, $method_ids);

        $voucher_id = PeymentRecord::where('customer_id', $customer->id)->where('method_type', 'Voucher')->where('status', 'unsuccessful')->first()->id;
        $voucher = Voucher::find($voucher_id);
        $code = Voucher::find($voucher_id)->code;

        if (!Voucher::where('code', $code)->where('status', 'active')->exists()) {
            return null;
        }

        if (!is_null($voucher->start_at) && $voucher->where('start_at', '>=', Carbon::now())->exists()) {
            return null;
        }

        if (!is_null($voucher->end_at) && $voucher->where('end_at', '<=', Carbon::now())->exists()) {
            return null;
        }

        if (!is_null($voucher->max_usable) && $voucher->max_usable == 0) {
            return null;
        }

        if ($voucher->type == 'first_purchase' && $customer->orders()->exists()) {
            return null;
        }

        $voucher_varints_cost = $this->voucherCostLogic($customer, $voucher, $method_ids);

        return $voucher_varints_cost;
    }


    /**
     * submit order logic and view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function submitOrder(Request $request)
    {

        $customer = Auth::guard('customer')->user();
        $final_sum_price = $this->finalGetOrderCartAmount();
        $final_sum_voucher = $this->finalGetOrderVoucherAmount();
        $first_carts = $customer->carts()->where('type', 'first')->get();
        $method_ids = json_decode($_COOKIE['method_ids'], true);
        $weights = ProductWeight::all();
        $consignment_shipping_cost = $this->shippingCostLogic($customer, $weights, $method_ids);

        //customizable
        $gateway_name = PeymentMethod::findOrFail($request->bank_id)->en_name;
        $gateway = PeymentMethod::findOrFail($request->bank_id);

        // مجموع قیمت پروموشن
        $sum_promotion_price = 0;
        foreach ($first_carts as $priceItem) {
            if ($priceItem->new_sale_price > $priceItem->new_promotion_price) {
                $sum_promotion_price += (($priceItem->new_sale_price - $priceItem->new_promotion_price) * $priceItem->count);
            }
        }

        if (!is_null($final_sum_voucher) && $final_sum_price > $final_sum_voucher) {
            $final_sum_price = $final_sum_price - $final_sum_voucher;
        }

        if (Order::count()) {
            $order_code = Order::max('order_code') + 1;
        } else {
            $order_code = 3000000;
        }

        $order_status_id = OrderStatus::where('en_name', 'awaiting_payment')->first()->id;

        //ایجاد سفارش
        $order = Order::create([
            'order_code' => $order_code,
            'order_status_id' => $order_status_id,
            'customer_id' => $customer->id,
            'cost' => $final_sum_price,
            'discount' => $sum_promotion_price + $final_sum_voucher,
        ]);


//        // ارسال پیامک ثبت موفق سفارش
//        Notification::send(auth()->user(),
//            new OrderSubmited($order->order_code)
//        );

        if (OrderHasConsignment::count()) {
            $delivery_code = OrderHasConsignment::max('delivery_code') + 1;
            $consignment_code = OrderHasConsignment::max('consignment_code') + 1;
        } else {
            $delivery_code = 10000;
            $consignment_code = 4000000;
        }

        $i = 0;
        foreach ($consignment_shipping_cost as $key => $shipping_cost)
        {
            // ایجاد مرسوله
            OrderHasConsignment::create([
                'consignment_code' => $consignment_code,
                'shiping_cost' => $shipping_cost,
                'delivery_code' => $delivery_code,
                'tracking_code' => null,
                'delivery_at' => null,
                'order_status_id' => $order_status_id,
                'delivery_method_id' => $method_ids[$i],
                'order_id' => $order->id,
            ]);

            $consignment_id = OrderHasConsignment::where('consignment_code', $consignment_code)->first()->id;

            // اضافه کردن تنوع‌ها به مرسوله
            foreach ($first_carts as $item) {

                // ایدی حجم: key
                if ($item->product_variant()->first()->product->weight()->first()->id == $key)
                {
                    $consignment_p_v_id = ConsignmentHasProductVariants::insertGetId([
                        'count' => $item->count,
                        'variant_price' => $item->new_sale_price,
                        'promotion_price' => $item->new_promotion_price,
                        'product_id' => $item->product_variant()->first()->product->id,
                        'consignment_id' => $consignment_id,
                        'order_id' => $order->id,
                        'order_status_id' => $order_status_id,
                        'product_variant_id' => $item->product_variant_id,
                        'promotion_type' => null,
                        'promotion_percent' => null,
                        'customer_id' => $customer->id,
                    ]);

                    $consignment_product_variant_id = ConsignmentHasProductVariants::where('product_variant_id', $item->product_variant_id)->first()->id;

                    OrderStaticDetail::create([
                        'product_title_fa' => $item->product_variant()->first()->product->title_fa,
                        'variant_name' => $item->product_variant()->first()->variant->name,
                        'warranty_name' => $item->product_variant()->first()->warranty->name,
                        'seller' => 'site',
                        'consignment_product_variant_id' => $consignment_product_variant_id,
                    ]);
                }
            }

            $i++;
        }

        $default_address = $customer->delivery_address;

        OrderAddress::create([
            'lan' => $default_address->lan,
            'len' => $default_address->len,
            'address' => $default_address->address,
            'plaque' => $default_address->plaque,
            'unit' => $default_address->unit,
            'postal_code' => $default_address->postal_code,
            'firstname' => !is_null($default_address->recipient_firstname)
                ? $default_address->recipient_firstname
                : $customer->first_name,
            'lastname' => !is_null($default_address->recipient_lastname)
                ? $default_address->recipient_lastname
                : $customer->last_name,
            'national_code' => !is_null($default_address->recipient_national_code)
                ? $default_address->recipient_national_code
                : $customer->national_code,
            'mobile' => !is_null($default_address->recipient_mobile)
                ? $default_address->recipient_mobile
                : $customer->mobile,
            'customer_id' => $default_address->customer_id,
            'state_id' => $default_address->state_id,
            'order_id' => $order->id,
        ]);

        $customer->carts()->where('type', 'first')->delete();

        $customer->carts()->where('type', 'second')->update([
            'type' => 'first',
        ]);

        config()->set([
            'payment.default' => $gateway_name,
        ]);

        return $this->PaymentLogic($gateway_name, $order, $gateway, $customer);
    }

    /**
     * payment logic for gateways after receive response from selected gateway
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function paymentOrder(Request $request)
    {

        $customer = Auth::guard('customer')->user();
        $transaction_id = $request->token;
        $invoiceـnumber = $_COOKIE["invoiceـnumber"];

        try {
            $receipt = Payment::transactionId($transaction_id)->verify();

            $paymentRecord = PeymentRecord::where('invoiceـnumber', $invoiceـnumber)
                ->firstOrFail();

            // بروز رسانی رکورد پرداخت موفق سفارش
            $paymentRecord->update([
                'tracking_code' => $receipt->getReferenceId(),
                'status' => 'successful',
            ]);

            $order = $paymentRecord->order();

            // تغییر وضعیت ها بعد از پرداخت موفق
            $this->updateStatusAfterSuccessfulPayment($order);

//            if (Setting::whereName('successful_payment_sms_status', 'active')->exists()) {
//                Notification::send($paymentRecord->customer,
//                new InvoicePaid($invoiceـnumber, $tracking_code = $receipt->getReferenceId()
//                    , $order->order_code, $order->cost)
//              );
//            }
        } catch (InvalidPaymentException $exception) {

            // تغییر وضعیت رکورد پرداخت به ناموفق وقتی از سمت درگاه ریسپانس ناموفق برمیگردد
            PeymentRecord::where('invoiceـnumber', $invoiceـnumber)->update([
                'status' => 'unsuccessful',
            ]);

            // نمایش صفحه وضعیت سفارش
            $order_code = PeymentRecord::where('invoiceـnumber', $invoiceـnumber)->first()->order->order_code;
            return $this->orderStatus($order_code);
        }
    }

    /**
     * order status page
     *
     * @param $order_code
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function orderStatus($order_code)
    {

        if (Order::where('order_code', $order_code)->doesntExist()) {
            abort(404);
        }

        $order = Order::where('order_code', $order_code)->first();

        if ($order->status->en_name !== 'accepted' && $order->status->en_name !== 'awaiting_payment') {
            abort(404);
        }

        return view('front::order-status', compact('order'));
    }

    /**
     * repayment order without reselect gateway logic
     *
     * @param $order_code
     * @return mixed
     * @throws \Exception
     */
    public function repaymentOrder($order_code)
    {

        if (PeymentMethod::where('en_name', '!=', 'cod')->where('status', 'active')->doesntExist()) {
            abort(404);
        }

        $order = Order::where('order_code', $order_code)->first();
        $gateway_name = $order->peyment_records()->where('method_type', 'PeymentMethod')->first()->peymentMethod->en_name;

        if ($gateway_name !== 'cod') {
            $gateway = $order->peyment_records()->where('method_type', 'PeymentMethod')->first()->peymentMethod;
            config()->set([
                'payment.default' => $gateway->name,
            ]);
        } else {
            $gateway = PeymentMethod::where('en_name', '!=', 'cod')->where('status', 'active')->first();
            config()->set([
                'payment.default' => $gateway->en_name,
            ]);
        }

        $invoice = new Invoice;
        $invoice->amount($order->cost / 10);
        $invoice->via($gateway->en_name);

        return Payment::purchase($invoice)->pay()->render();
    }

    /**
     * reselect payment page
     *
     * @param $order_code
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function reselectGateway($order_code)
    {

        // اگه سفارش با این کد سفارش موجود نبود
        if (!Order::where('order_code', $order_code)->exists()) {
            return abort(404);
        }

        $order = Order::where('order_code', $order_code)->first();

        // اگه دارای پرداخت موفق از طریق درگاه بود
        if ($order->peyment_records()->successfulPeyment()->where('method_id', PeymentMethod::where('en_name', '!==', 'cod')->first()->id)->where('price', $order->cost)->exists()) {
            return abort(404);
        }

        $peyment_methods = PeymentMethod::where('status', 'active')->get();

        if ($order->peyment_records()->successfulPeyment()->where('method_id', PeymentMethod::where('en_name', 'cod')->first()->id)->where('price', $order->cost)->exists()) {
            $peyment_methods = PeymentMethod::where('status', 'active')->where('en_name', '!==', 'cod')->get();
        }

        return view('front::reselect-gateway', compact('order', 'peyment_methods'));
    }

    /**
     * reselect payment logic
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function reselectPaymant(Request $request)
    {

        $customer = Auth::guard('customer')->user();
        $order = Order::where('order_code', $request->order_code)->first();

        // اگه یه ساعت از ایجاد سفارش گذشته بود و پرداخت موفق از بخش روش پرداخت نداشت
        if (Carbon::make($order->created_at)->addHour() < Carbon::now() && PeymentRecord::where('order_id', $order->id)->successfulPeyment()->doesntExist()) {
            // تغییر وضعیت بعد از پرداخت ناموفق
            $this->updateStatusAfterUnsuccessfulPayment($order);

            // تغییر خواهد کرد
            return redirect()->route('front.cart');
        }

        if (isset($request->bank_id) && !is_null($request->bank_id)) {
            $gateway_name = PeymentMethod::findOrFail($request->bank_id)->en_name;
            $gateway = PeymentMethod::findOrFail($request->bank_id);
        } else {
            $gateway_name = Order::where('order_code', $request);
        }

        $this->PaymentLogic($gateway_name, $order, $gateway, $customer);
    }

    /**
     * update order, consignment, consignent variants "status" after successful payment.
     *
     * @param $order
     */
    public function updateStatusAfterSuccessfulPayment($order): void
    {
//        // ارسال پیامک تعییر وضعیت سفارش
//        if (Setting::whereName('delivery_sms_status', 'active')->exists()) {
//            Notification::send(auth()->user(),
//                new OrderStatusChanged($order->order_code, 'تایید شده'));
//        }

        // تغییر وضعیت سفارش به تایید شده
        $order->update([
            'order_status_id' => OrderStatus::where('en_name', 'accepted')->first()->id,
        ]);

        // تغییر وضعیت مرسوله های سفارش به در انتظار بررسی awaiting_review
        OrderHasConsignment::where('order_id', $order->id)->update([
            'order_status_id' => OrderStatus::where('en_name', 'awaiting_review')->first()->id,
        ]);

        // تغییر وضعیت تنوع‌های مرسولات سفارش به بفروش رفته sold
        ConsignmentHasProductVariants::where('order_id', $order->id)->update([
            'order_status_id' => OrderStatus::where('en_name', 'sold')->first()->id,
        ]);

        // کم کردن موجودی تنوع اگه قبلا با cod پرداخت نشده بود
        if ($order->peyment_records()->successfulPeyment()->where('price', $order->cost)->count() < 2) {
            foreach (ConsignmentHasProductVariants::where('order_id', $order->id)->get() as $consignment_product_variant) {
                $consignment_product_variant->product_variant()->update([
                    'stock_count' => $consignment_product_variant->product_variant->stock_count - $consignment_product_variant->count,
                    'sale_count' => $consignment_product_variant->product_variant->sale_count + $consignment_product_variant->count,
                ]);

                $consignment_product_variant->product()->increment('sales_count');
                if ($consignment_product_variant->product()->variants()->active()->exists()) {
                    $consignment_product_variant->product()->update(['has_stock' => 1]);
                } else {
                    $consignment_product_variant->product()->update(['has_stock' => 0]);
                }

                $consignment_product_variant->product()->update([
                    'min_price' => product_price($consignment_product_variant->product)
                ]);
            }
        }

//        if (Setting::whereName('delivery_sms_status', 'active')->exists()) {
//            Notification::send(auth()->user(),
//                new OrderStatusChanged($order->order_code, $order->cost));
//        }
    }

    /**
     * update order, consignment, consignent variants "status" after unsuccessful payment.
     *
     * @param $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatusAfterUnsuccessfulPayment($order)
    {
        // ارسال پیامک تعییر وضعیت سفارش
//        if (Setting::whereName('delivery_sms_status', 'active')->exists()) {
//            Notification::send(auth()->user(),
//                new OrderStatusChanged($order->order_code, 'لغو شده'));
//        }

        // تغییر وضعیت سفارش به لغو شده
        $order->update([
            'order_status_id' => OrderStatus::where('en_name', 'canceled')->first()->id,
        ]);

        // تغییر وضعیت مرسوله های سفارش به لغو شده
        OrderHasConsignment::where('order_id', $order->id)->update([
            'order_status_id' => OrderStatus::where('en_name', 'canceled')->first()->id,
        ]);

        // تغییر وضعیت تنوع‌های مرسولات سفارش به لغو شده
        ConsignmentHasProductVariants::where('order_id', $order->id)->update([
            'order_status_id' => OrderStatus::where('en_name', 'canceled')->first()->id,
        ]);
    }

    /**
     * payment logic for COD or Gateways
     *
     * @param $gateway_name
     * @param $order
     * @param $gateway
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $customer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function PaymentLogic($gateway_name, $order, $gateway, ?\Illuminate\Contracts\Auth\Authenticatable $customer)
    {
        if ($gateway_name == 'cod') {

            // ایجاد رکورد پرداخت موفق سفارش
            PeymentRecord::create([
                'invoiceـnumber' => null,
                'status' => 'successful',
                'price' => $order->cost,
                'order_id' => $order->id,
                'method_type' => 'PeymentMethod',
                'method_id' => $gateway->id,
                'customer_id' => $customer->id,
            ]);

            // تغییر وضعیت ها بعد از پرداخت موفق
            $this->updateStatusAfterSuccessfulPayment($order);

            return $this->orderStatus($order->order_code);
        }

        if ($gateway_name !== 'cod') {

            // ایجاد شماره سفارش تصادفی
            invoiceـnumber:
            $invoiceـnumber = rand(1000000000, 9999999999);
            if (PeymentRecord::where('invoiceـnumber', $invoiceـnumber)->exists()) {
                goto invoiceـnumber;
            }

            $invoice = new Invoice;
            $invoice->amount($order->cost / 10);
            $invoice->via($gateway_name);

            // ایجاد صورتحساب و انتقال به درگاه
            return Payment::purchase($invoice, function ($driver, $transactionId) use ($order, $gateway, $invoiceـnumber, $customer) {
                // ایجاد رکورد در انتظار پرداخت سفارش
                PeymentRecord::create([
                    'invoiceـnumber' => $invoiceـnumber,
                    'status' => 'awaiting_payment',
                    'price' => $order->cost,
                    'order_id' => $order->id,
                    'method_type' => 'PeymentMethod',
                    'method_id' => $gateway->id,
                    'customer_id' => $customer->id,
                ]);

                // ایجاد کوکی شماره سفارش
                setcookie('invoiceـnumber', $invoiceـnumber, time() + (10 * 365 * 24 * 60 * 60), "/");
            })->pay()->render();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAddressFromPanel(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $this->saveAddressLogic($request);
        return response()->json([
            'status' => true,
            'data' => [
                'addresses' => View::make('customerpanel::profile.ajax.panelAddressSection', compact('customer'))->render(),
            ],
        ], 200);
    }

    public function removeCustomerAddressFromPanel(int $id)
    {

        $customer = Auth::guard('customer')->user();

        if (CustomerAddress::where('customer_id', $customer->id)->where('id', $id)->exists()) {
            CustomerAddress::where('customer_id', $customer->id)->where('id', $id)->first()->delete();
        }

        $store_addresses = StoreAddress::all();

        if ($customer->where('address_type', 'CustomerAddress')->exists()) {
            $delivery_type = 'customer';
        } else {
            $delivery_type = 'store';
        }

        if (!$customer->delivery_address()->exists() && $customer->addresses()->exists()) {
            $defualt_address_id = $customer->addresses()->latest()->first()->id;
            $customer->update([
                'address_type' => 'CustomerAddress',
                'address_id' => $defualt_address_id,
            ]);
        }

        return response()->json([
            "status" => true,
            "data" => null,
        ]);
    }

    public function removeFromHistory($product_code)
    {
        $customer = Auth::guard('customer')->user();
        if (Product::where('product_code', $product_code)->exists()) {
            $product_id = Product::where('product_code', $product_code)->first()->id;
            $customer->histories()->where('product_id', $product_id)->first()->delete();
        }

        return response()->json([
            "status" => true,
            "data" => null,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->q;

        $products = QueryBuilder::for(Product::class)
            ->where('title_fa', 'Like', '%' . $query . '%')
            ->orderBy('has_stock', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(1);

        $max_price = Product::where('title_fa', 'Like', '%' . $query . '%')->max('min_price');

        return view('front::search', compact('query', 'products', 'max_price'));

    }


    public function test()
    {
        $category = Category::find(25);

        $main_cat = $category;
        $lists[] = $category->id;
        while (isset($category->parent)) {
            $main_cat = $category->parent;
            $category = $category->parent;
            $lists[] = $category->id;
        }

        $lists = array_reverse($lists, true);
        $end_index = end($lists);
        array_pop($lists);
        $new_end = end($lists);

        if (count(Category::find(end($lists))->children)) {
            foreach (Category::find($new_end)->children as $child) {
                $lists2[] = $child->id;
            }
        }

        $lists = $this->nestArray($lists);
    }

    public function nestArray($myArray)
    {
        if (empty($myArray)) {
            return array();
        }

        $firstValue = array_shift($myArray);
        return array($firstValue => $this->nestArray($myArray));
    }

    /**
     * @param $category
     * @return array
     */
    public function fullCategoryList($category)
    {
        $main_cat = $category;
        $list[] = $category->id;
        while (isset($category->parent)) {
            $main_cat = $category->parent;
            $category = $category->parent;
            $list[] = $category->id;
        }
        $list = array_reverse($list, true);
        return $list;
    }

    public function findChilds($category)
    {
          $this->child_list[] = $category->id;
          if ($category->children) {
              foreach($category->children as $child){
                  $this->findChilds($child);
              }
          }
    }

    public function findCategoryChilds(Category $category)
    {
        $this->category_childs[] = $category->id;

        if($category->children){
            foreach($category->children as $child){
                $this->findCategoryChilds($child);
            }
        }
    }

    public function getCategoryChilds(Category $category)
    {
        $this->findCategoryChilds($category);

        return $this->category_childs;
    }
}
