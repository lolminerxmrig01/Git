<?php

namespace Modules\Staff\Voucher\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Voucher\Models\Voucher;
use Illuminate\Http\Request;

class StaffVoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::paginate(10);

        return view('staffvoucher::index', compact('vouchers'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('staffvoucher::create', compact('categories'));
    }

    public function store(Request $request)
    {
        $start_at = $request->start_at;
        $end_at = $request->end_at;

        $request->start_at = date_create($request->start_at);
        $request->end_at = date_create($request->end_at);

        $messages = [
            'name.required' => 'وارد کردن فیلد عنوان کد تخفیف اجباری است.',
            'code.required' => 'وارد کردن فیلد کد تخفیف اجباری است.',
            'percent.required' => 'وارد کردن فیلد درصد تخفیف اجباری است.',
            'start_at.required_if' => 'در حالت زمان دار وارد کردن زمان شروع اجباری است.',
            'end_at.required_if' => 'در حالت زمان دار وارد کردن زمان پایان اجباری است.',
            'category_id.required_if' => 'در حالت انتخابی انتخاب گروه کالایی مجاز اجباری است',
            'after' => 'زمان پایان باید بیشتر از زمان شروع باشد.',
            'maximum_usable.required_if' => 'در حالت انتخابی وارد کردن حداکثر تعداد استفاده اجباری است.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'code' => 'required',
            'percent' => 'required',
            'up_to' => 'nullable',
            'min_product_price' => 'nullable',
            'has_limit_time' => 'nullable',
            'start_at' => 'nullable|required_if:has_limit_time, 1|date',
            'end_at' => 'nullable|required_if:has_limit_time, 1|date|after:start_at',
            'has_max_usable' => 'nullable',
            'maximum_usable' => 'nullable|required_if:has_max_usable,1',
            'for_new_users' => 'nullable',
            'has_freeـshipping' => 'nullable',
            'has_category_limit' => 'nullable',
            'category_id' => 'nullable|required_if:has_category_limit,1',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => false,
                'data' => [
                    'errors' => $errors,
                ]
            ], 400);
        }

        $voucher = Voucher::updateOrCreate(['id' => (!is_null($request->voucher_id) ? $request->voucher_id : 0)], [
            'name' => $request->name,
            'status' => ($request->status) ? 'active' : 'inactive',
            'code' => $request->code,
            'percent' => $request->percent,
            'up_to' => ($request->up_to) ? $request->up_to : null,
            'min_product_price' => ($request->min_product_price) ? $request->min_product_price : null,
            'start_at' => ($start_at) ? $start_at : null,
            'end_at' => ($end_at) ? $end_at : null,
            'max_usable' => ($request->maximum_usable) ? $request->maximum_usable : null,
            'type' => ($request->for_new_users) ? 'first_purchase' : 'all_users',
            'freeـshipping' => ($request->for_new_users) ? 'true' : 'false',
            'platform' => 'all',
        ]);

        $category = Category::find($request->category_id);

        if ($request->has_category_limit) {
            $voucher->categories()->detach();
            $voucher->categories()->attach($category);
        } else {
            $voucher->categories()->detach($category);
        }
    }

    public function edit($id)
    {
        $categories = Category::all();
        $voucher = Voucher::findOrFail($id);

        if ($voucher->categories()->exists()) {
            $category = $voucher->categories()->first();
            do {
                $main_cat = $category->parent;
                $lists[] = $category;
                $parent_category = $category;
                $category = $category->parent;
            } while (isset($category));
            $lists = array_reverse($lists, true);

            foreach ($lists as $list) {
                $all_parent[] = $list->id;
            }
            array_unshift($all_parent, 0);
        } else {
            $all_parent = [];
            $parent_category = [];
        }
        return view('staffvoucher::edit', compact('voucher', 'categories', 'all_parent', 'parent_category'));
    }

    public function update(Request $request)
    {
    }

    public function delete($id)
    {
        Voucher::find($id)->delete();
    }

    public function searchVoucher(Request $request, Voucher $vouchers)
    {
        $request->paginatorNum = $request->paginatorNum ?? 10;

        $vouchers = $this->Voucherfilter($request, $vouchers);

        return view('staffvoucher::searchResult', compact('vouchers'));
    }

    public function Voucherfilter($request, $vouchers)
    {
        $vouchers = $vouchers->newQuery();

        if (!is_null($request->title)) {
            $vouchers->where("name", "LIKE", "%{$request->title}%");
        }

        if (!is_null($request->start_at)) {
            $vouchers->where('start_at', '>=', $request->start_at);
        }

        if (!is_null($request->end_at)) {
            $vouchers->where('end_at', '<=', $request->end_at);
        }

        if (!is_null($request->status)) {
            if ($request->status == 'active') {
                $vouchers->where('status', 'active');
                $vouchers->where('end_at', null);
                $vouchers->orWhere('end_at', '>', now());
            }

            if ($request->status == 'inactive') {
                $vouchers->where('status', 'inactive');
            }

            if ($request->status == 'ended') {
                $vouchers->where('status', 'ended');
                $vouchers->orWhere('end_at', '<', now());
            }

            if ($request->status == 'has_time') {
                $vouchers->whereNotNull('end_at');
            }

            if ($request->status == 'without_time') {
                $vouchers->whereNull('end_at');
            }
        }

        return $vouchers->paginate($request->paginatorNum);
    }

    public function removeVoucher($id)
    {
        Voucher::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'data' => true,
        ]);
    }

    public function statusVoucher(Request $request)
    {
        Voucher::find($request->id)->update([
            'status' => ($request->status) ? 'active' : 'inactive',
        ]);
    }
}
