<?php

namespace Modules\Staff\Promotion\Http\Controllers;

use Modules\Staff\Setting\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

use Modules\Staff\Promotion\Models\Campain;
use Modules\Staff\Product\Models\ProductHasVariant;
use Modules\Staff\Promotion\Models\Promotion;
use Modules\Staff\Landing\Models\Landing;

class StaffCampainController extends Controller
{
    public function campainStatus(Request $request)
    {
        $campain = Campain::whereId($request->id)->first();
        $campain->update([
            'status' => $request->status,
        ]);
    }

    public function endedCampainSearch(Request $request, Campain $campains)
    {
        $campains->where('end_at', '<', now())
            ->orWhere('status', 'ended')
            ->get();

        $request->paginatorNum = $request->paginatorNum ?? 10;

        $campains = $this->campainFilter($request, $campains);

        return view('staffpromotion::campains.endedSearchResult',
         compact('campains'));
    }

    public function searchCampain(Request $request, Campain $campains)
    {
        $request->paginatorNum = $request->paginatorNum ?? 10;

        $campains = $this->campainFilter($request, $campains);

        return view('staffpromotion::campains.searchResult',
         compact('campains'));
    }

    public function moveToEnds(Request $request)
    {
        Campain::whereId($request->promotionVariantId)->update(['status' => 'ended']);

        return response()->json([
            'status' => true,
        ]);
    }

    public function campainFilter($request, $campains)
    {
        $campains = $campains->newQuery();

        if (!is_null($request->title)) {
            $campains->where("name", "LIKE", "%{$request->title}%");
        }

        if (!is_null($request->start_at)) {
            $campains->where('start_at', '>=', $request->start_at);
        }

        if (!is_null($request->end_at)) {
            $campains->where('end_at', '<=', $request->end_at);
        }

        return $campains->paginate($request->paginatorNum);
    }

    public function removeCampain($id)
    {
        Campain::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'data' => true,
        ]);
    }

    public function index()
    {
        $campains = Campain::where('end_at', '<', now())
            ->orWhere('status', 'active')
            ->paginate(10);

        return view('staffpromotion::campains.index',
         compact('campains'));
    }

    public function create()
    {
        return view('staffpromotion::campains.create');
    }

    public function update(Request $request, $id)
    {
        $start_at = $request->start_at;
        $end_at = $request->end_at;

        $request->start_at = date_create($request->start_at);
        $request->end_at = date_create($request->end_at);

        $messages = [
            'after' => 'زمان پایان باید بیشتر از زمان شروع باشد.',
            'name.required' => 'نام کمپین الزامی است.',
            'status.required' => 'وضعیت کمپین الزامی است.',
            'start_at.required' => 'تاریخ و زمان شروع کمپین الزامی است.',
            'end_at.required' => 'تاریخ و زمان پایان کمپین الزامی است.',
            'slug.required_if' => 'در حالت انتخابی وارد کردن نامک الزامی است.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'has_landing' => 'nullable',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'slug' => 'nullable|required_if:has_landing,1',
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

        $status = $request->status ? 'active' : 'inactive';

        $campain = Campain::updateOrCreate(['id' => $request->campain_id], [
            'name' => $request->name,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'type' => 'custom',
            'status' => $status,
        ]);


        if (isset($request->has_landing) && ($request->has_landing == '1')) {
          Landing::updateOrCreate(['campain_id' => $campain->id], [
            'name' => $request->name,
            'slug' => $request->slug,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'type' => 'custom',
            'status' => 'active',
          ]);
        }

        elseif (isset($request->has_landing) && ($request->has_landing !== '1')) {
            if ($campain->landing) {
                $campain->landing->delete();
            }
        }

        return response()->json([
            'status' => true,
            'data' => [
                'redirectUrl' => route('staff.campains.index'),
            ],
        ]);
    }

    public function manage($id)
    {
        $campain = Campain::findOrFail($id);
        $promotions = $campain->promotions()
            ->paginate(10);

        return view('staffpromotion::campains.manageCampain',
         compact('campain', 'promotions'));
    }

    public function renderAddVariantsRows(Request $request)
    {
        if (isset($request->variantIds)){
            $variantIds = $request->variantIds;
            $product_variants = ProductHasVariant::all();
            return response()->json([
                'status' => true,
                'data' => view('staffpromotion::campains.render-add-variants-rows',
                 compact('variantIds', 'product_variants'))->render(),
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => "\n\n\n\n\n",
            ]);
        }
    }

    public function save(Request $request)
    {
        $messages = [
            'promotion_limit.required' => 'وارد کردن فیلد تعداد در تخفیف اجباری است.',
            'promotion_limit.integer' => 'وارد کردن فیلد تعداد در تخفیف اجباری است.',
            'promotion_order_limit.required' => 'وارد کردن فیلد تعداد در سبد اجباری است.',
            'promotion_price.ends_with' => 'دو رقم انتهای قیمت باید ۰ باشد.',
            'promotion_price.required' => 'وارد کردن فیلد قیمت پس از تخفیف اجباری است.',
        ];

        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'promotion_price' => 'required|ends_with:00',
            'promotion_limit' => 'required',
            'promotion_order_limit' => 'required',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()
                ->first();

            return response()->json([
                'status' => false,
                'data' => [
                    'errors' => $errors,
                ]
            ]);
        }

        $product_variant = ProductHasVariant::find($request->id);

        $promotion = Promotion::updateOrCreate(['id' => $request->promotion_variant_id], [
            'promotion_price' => $request->promotion_price,
            'percent' => $request->promotion_percent,
            'promotion_limit' => $request->promotion_limit,
            'promotion_order_limit' => $request->promotion_order_limit,
            'status' => ($request->status == 0)? "inactive" : "active",
            'campain_id' => $request->campain_id,
        ]);

        $product_variant = ProductHasVariant::find($request->id);

        $promotion->productVariants()
            ->sync($product_variant);

        return response()->json([
            'status' => true,
            'data' => [
                'promotion_variant_id' => $request->campain_id,
            ]
        ]);
    }

    public function ended()
    {
        if (Campain::where('status', 'ended')->count()) {
            $campains = Campain::where('status', 'ended')
                ->paginate(10);
        } else {
            $campains = [];
        }

        return view('staffpromotion::campains.ended',
         compact('campains'));
    }

    public function loadProductVariants(Request $request, ProductHasVariant $product_variants, $id)
    {
        $request->paginatorNum = $request->paginatorNum ?? 10;

        $product_variants = $this->ProductVariantsSearch($request, $product_variants);

        (!is_null($request['query'])
            ? $query = $request['query'] 
            : $query = '');
            
        (!is_null($request['type'])
            ? $type = $request['type']
            : $type = '');

        return view('staffpromotion::campains.ajax-load-variants',
            compact('product_variants', 'query', 'type'));
    }

    public function ProductVariantsSearch($request, $product_variants)
    {
        $product_variants = $product_variants->newQuery();

        $search_keyword = ltrim($request['query'], Setting::where('name', 'product_code_prefix')->first()->value . 'C-');
        $search_keyword = ltrim($search_keyword, Setting::where('name', 'product_code_prefix')->first()->value . '-');

        if ($request->type == 'all' && !is_null($request['query'])) {
            $product_variants = $product_variants->whereHas('product', function ($query) use ($search_keyword) {
                $query->where('product_code', 'LIKE', '%' . $search_keyword . '%');
                $query->orWhere('title_fa', 'LIKE', '%' . $search_keyword . '%');
            });
            $product_variants = $product_variants->orWhere('variant_code', 'LIKE', "%{$search_keyword}%");
        }

        if ($request->type == 'product_id' && !is_null($request['query'])) {
            $product_variants = $product_variants->whereHas('product', function ($query) use ($search_keyword) {
                $query->where('product_code', 'LIKE', '%' . $search_keyword . '%');
            });
        }

        if ($request->type == 'product_name' && !is_null($request['query'])) {
            $product_variants = $product_variants->whereHas('product', function ($query) use ($search_keyword) {
                $query->where('title_fa', 'LIKE', '%' . $search_keyword . '%');
            });
        }

        if ($request->type == 'product_variant_id' && !is_null($request['query'])) {
            $product_variants = $product_variants->where('variant_code', 'LIKE', "%{$search_keyword}%");
        }

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

        return $product_variants->paginate($request->paginatorNum);

    }


    public function done()
    {
        return view('staffpromotion::campains.done',
            compact('promotions'));
    }

    public function delete(Request $request){
        Promotion::find($request->promotionVariantId)
            ->delete();
        return response()->json([
            'status' => true,
            'data' => true,
        ]);
    }

    public function search(Request $request, Promotion $promotions)
    {
        $request->paginatorNum = $request->paginatorNum ?? 10;

        $paginate_type = 'active';
        $promotions = $promotions->with('productVariants');

        $search_keyword = ltrim($request->search['title'], Setting::where('name', 'product_code_prefix')->first()->value . 'C-');
        $search_keyword = ltrim($search_keyword, Setting::where('name', 'product_code_prefix')->first()->value . '-');

        $promotions = $this->promotionSearch($request, $promotions, $paginate_type);

        (!is_null($request->search['title'])
            ? $query = $request->search['title']
            : $query = '');

        (!is_null($request['type'])
            ? $request['type']
            : $type = '');

        $paginate_type = 'active';

        return view('staffpromotion::campains.ajax-load-promotions',
            compact('promotions', 'query', 'type', 'paginate_type'));

    }


    public function promotionSearch($request, $promotions, $paginate_type)
    {
        $promotions = $promotions->newQuery();

        $productCodePrefix = Setting::where('name', 'product_code_prefix')->first()->value . 'C-';
        $search_keyword = ltrim($request->search['title'], $productCodePrefix);
        $search_keyword = ltrim($search_keyword, $productCodePrefix);

        if ($request->search['type'] == 'all' && !is_null($search_keyword)) {
            $promotions->whereHas('productVariants', function ($query) use ($search_keyword) {
                $query->whereHas('product', function ($query) use ($search_keyword) {
                    $query->where('title_fa', 'LIKE', '%' . $search_keyword . '%');
                    $query->orWhere('product_code', 'LIKE', '%' . $search_keyword . '%');
                });
                $query->orWhere('variant_code', 'LIKE', "%{$search_keyword}%");
            });

            if ($paginate_type == 'active') {
                $promotions->where('status', '!=', 'ended');
            }
        }

        if ($request->search['type'] == 'product_id' && !is_null($search_keyword)) {
            $promotions->whereHas('productVariants', function ($query) use ($search_keyword) {
                $query->whereHas('product', function ($query) use ($search_keyword) {
                    $query->where('product_code', 'LIKE', '%' . $search_keyword . '%');
                });
            });
        }

        if ($request->search['type'] == 'product_name' && !is_null($search_keyword)) {
            $promotions->whereHas('productVariants', function ($query) use ($search_keyword) {
                $query->whereHas('product', function ($query) use ($search_keyword) {
                    $query->where('title_fa', 'LIKE', '%' . $search_keyword . '%');
                });
            });
        }

        if ($request->search['type'] == 'product_variant_id' && !is_null($search_keyword)) {
            $promotions->whereHas('productVariants', function ($query) use ($search_keyword) {
                $query->where('variant_code', 'LIKE', "%{$search_keyword}%");
            });
        }

        if (isset($request->search['status']) && $request->search['status'] == 'active') {
            if ($paginate_type == 'active') {
                $promotions->where('status', 'active');
            }
        }

        if (isset($request->search['status']) && $request->search['status'] == 'inactive') {
            $promotions->where('status', 'inactive');
        }

        if (isset($request->search['status']) && !is_null($request->search['start_from'])) {
            $promotions->where('start_at', '>=', $request->search['start_from']);
        }

        if (isset($request->search['status']) && !is_null($request->search['end_to'])) {
            $promotions->where('start_at', '<=', $request->search['end_to']);
        }

        if ($paginate_type == 'ended') {
            $promotions->where('status', 'ended');
        }

        return $promotions->paginate($request->paginatorNum);
    }


}
