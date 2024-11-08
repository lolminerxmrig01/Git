<?php

namespace Modules\Staff\Landing\Http\Controllers;

use Modules\Staff\Setting\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Modules\Staff\Product\Models\ProductHasVariant;
use Modules\Staff\Landing\Models\Landing;

class StaffLandingController extends Controller
{
    public function index()
    {
        $landings = Landing::paginate(1);
        return view('stafflanding::index', compact('landings'));
    }

    public function create()
    {
        return view('stafflanding::create');
    }

    public function update(Request $request, $id)
    {
        $request->start_at = date_create($request->start_at);
        $request->end_at = date_create($request->end_at);

        $messages = [
            'after' => 'زمان پایان باید بیشتر از زمان شروع باشد.',
            'name.required' => 'نام صفحه سفارشی الزامی است.',
            'status.required' => 'وضعیت صفحه سفارشی الزامی است.',
            'slug.required' => 'نامک صفحه سفارشی الزامی است.',
            'start_at.required' => 'تاریخ و زمان شروع صفحه سفارشی الزامی است.',
            'end_at.required' => 'تاریخ و زمان پایان صفحه سفارشی الزامی است.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'slug' => 'required',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => false,
                'data' => [
                    'errors' => $errors,
                ]
            ]);
        }

        $landing = Landing::updateOrCreate(['id' => $id], [
            'name' => $request->name,
            'slug' => $request->slug,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'type' => 'custom',
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'data' => [
                'redirectUrl' => $landing->id,
            ],
        ]);

    }

    public function manage($id, Request $request)
    {
        $landing = Landing::find($id);

        if($request->has('product_id')) {
            Log::info('true');
            $request->product_id = ltrim($request->product_id, Setting::where('name', 'product_code_prefix')->first()->value . 'C-');
            $request->product_id = ltrim($request->product_id, Setting::where('name', 'product_code_prefix')->first()->value . '-');
            $product_variants = $landing->productVariants()->where('variant_code', 'LIKE', '%' . $request->product_id . '%')->get();
        }

        if (!isset($product_variants) || is_null($product_variants)) {
            $product_variants = [];
        }

        return view('stafflanding::manageLanding', compact('landing', 'product_variants'));
    }

    public function addVariant(Request $request, $id)
    {
        $landing = Landing::find($id);
        foreach ($request->variantIds as $variantId) {
            $product_variant = ProductHasVariant::find($variantId);

            $landing->productVariants()->attach($product_variant);
        }

        return response()->json([
            'status' => true,
            'data' => [],
        ]);
    }

    public function variants($id, Request $request)
    {
        $product_variants = Landing::find($id)->productVariants;
        return view('stafflanding::addVariants', compact('product_variants'));
    }

    public function removeVariant(Request $request, $id)
    {
        $variant_id = $request->promotionVariantId;
        $landing = Landing::find($id);
        $landing->productVariants()->detach($request->promotionVariantId);
        return response()->json([
            'status' => true,
            'data' => true,
        ]);
    }

    public function removeAll($id)
    {
        Landing::find($id)->productVariants()->detach();
        return response()->json([
            'status' => true,
            'data' => true,
        ]);
    }

    public function removeLanding($id)
    {
        Landing::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'data' => true,
        ]);
    }

    public function statusGroup(Request $request)
    {
        Landing::where('id', $request->id)->update([
            'status' => $request->status,
        ]);
    }


    // search for landing index page
    public function Landingfilter($request, $landings)
    {
        $landings = $landings->newQuery();

        if (!is_null($request->title)) {
            $landings->where("name", "LIKE", "%{$request->title}%");
        }

        if (!is_null($request->start_at)) {
            $landings->where('start_at', '>=', $request->start_at);
        }

        if (!is_null($request->end_at)) {
            $landings->where('end_at', '<=', $request->end_at);
        }

        return $landings->paginate($request->paginatorNum);
    }

    public function searchLanding(Request $request, Landing $landings)
    {
        (!$request->paginatorNum) ? $request->paginatorNum = 10 : '';

        $landings = $this->Landingfilter($request, $landings);

        return view('stafflanding::searchResult', compact('landings'));
    }


    // search for add product variant to landings
    public function search($id, Request $request, ProductHasVariant $product_variants)
    {
        (!$request->paginatorNum) ? $request->paginatorNum = 2 : '';

        $product_variants = $this->productVariantFilter($request, $product_variants);
        $landing = Landing::find($id);

        return view('stafflanding::variantsLoader',
            compact('product_variants', 'landing'));

    }

    public function productVariantFilter($request, $product_variants)
    {
        $product_variants = $product_variants->newQuery();

        if (!is_null($request->sort)) {
            if ($request->sort == 'desc') {
                $product_variants->orderBy('created_at', 'desc');
            }

            if ($request->sort == 'price_low') {
                $product_variants->orderBy('sale_price', 'asc');
            }

            if ($request->sort == 'price_high') {
                $product_variants->orderBy('sale_price', 'desc');
            }
        }

        if (!is_null($request['query'])) {
            $request['query'] = ltrim($request['query'], Setting::where('name', 'product_code_prefix')->first()->value . 'C-');
            $request['query'] = ltrim($request['query'], Setting::where('name', 'product_code_prefix')->first()->value . '-');

            $product_variants->whereHas('product', function($query) use ($request){
                $query->where('product_code', 'LIKE', '%' . $request['query'] . '%');
                $query->orWhere('title_fa', 'LIKE', '%' . $request['query'] . '%');
            });

            $product_variants->orWhere('variant_code', 'LIKE', '%' . $request['query'] . '%');
        }

        return $product_variants->paginate($request->paginatorNum);


    }


}
