<?php

namespace Modules\Staff\Warranty\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

use Modules\Staff\Category\Models\Categorizable;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Warranty\Models\Warranty;

class StaffWarrantyController extends Controller
{

    public function index()
    {
        $warranties = Warranty::orderBy('created_at', 'desc')
            ->paginate(10);

        $trashed_warranties = Warranty::onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $categories = Category::all();

        return view(
            'staffwarranty::index',
            compact('warranties', 'categories', 'trashed_warranties')
        );
    }

    public function create()
    {
        $categories = Category::get();

        return view('staffwarranty::create', compact('categories'));
    }

    public function store(Request $request)
    {

        if (is_null($request->categories)) {
            return response()->json('error', 400);
        }

        $warranty = Warranty::create([
            'name' => $request->name,
            'month' => (!is_null($request->time)) ? $request->time : null,
            'has_insurance' => $request->has_insurance,
        ]);

        // تبدیل آرایه ای از اعداد با فرمت رشته به آرایه عددی
        $categories = array_map(function ($value) {
            return intval($value);
        }, $request->categories);

        foreach ($categories as $category) {
            $this_cat = Category::find($category);
            $warranty->categories()->attach($this_cat);
        }
    }

    public function edit($id)
    {
        $warranty = Warranty::find($id);
        $warranties = Warranty::all();
        $categories = Category::get();

        return view('staffwarranty::edit',
            compact('categories', 'warranty', 'warranties'));
    }

    public function update(Request $request)
    {
        if (is_null($request->categories)) {
            return response()->json('error', 400);
        }

        $warranty = Warranty::find($request->id);

        Warranty::find($request->id)->update([
            'name' => $request->name,
            'month' => (!is_null($request->time)) ? $request->time : null,
            'has_insurance' => $request->has_insurance,
        ]);

        // تبدیل آرایه ای از اعداد با فرمت رشته به آرایه عددی
        $categories = array_map(function ($value) {
            return intval($value);
        }, $request->categories);

        Categorizable::where('categorizable_type', 'Warranty')
            ->where('categorizable_id', $request->id)
            ->delete();

        foreach ($categories as $category) {
            $this_cat = Category::find($category);

            $warranty->categories()
                ->attach($this_cat);
        }
    }

    public function ajaxPagination(Request $request)
    {
        $request->paginatorNum
            ? $paginatorNum = $request->paginatorNum
            : $paginatorNum = 10;

        $warranties = Warranty::distinct('name')
            ->orderBy('created_at', 'desc')
            ->paginate($paginatorNum);

        $trashed_warranties = Warranty::distinct('name')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $categories = Category::all();

        $pageType = 'index';

        return View::make(
            'staffwarranty::ajax-content',
            compact('warranties', 'categories', 'pageType', 'trashed_warranties')
        )
            ->render();
    }

    public function filterByType(Request $request)
    {
        if ($request->search_type == 'all') {
            return $this->ajaxPagination($request);
        }

        $warranties = Warranty::where('type', 1)
            ->distinct('name')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $trashed_warranties = Warranty::distinct('name')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $pageType = 'only_special';

        if ($warranties) {
            return View::make(
                'staffwarranty::ajax-content',
                compact('warranties', 'pageType', 'trashed_warranties')
            );
        }
    }

    public function trash()
    {
        $warranties = Warranty::onlyTrashed()
            ->paginate(10);

        return view('staffwarranty::trash', compact('warranties'));
    }

    public function trashPagination()
    {
        $warranties = Warranty::onlyTrashed()
            ->paginate(10);

        return View::make(
            'staffwarranty::ajax-trash-content',
            compact('warranties')
        );
    }

    public function moveToTrash(Request $request)
    {
        Warranty::find($request->id)
            ->delete();

        return $this->ajaxPagination($request);
    }

    public function restoreFromTrash(Request $request)
    {
        Warranty::withTrashed()
            ->find($request->id)
            ->restore();

        $warranties = Warranty::onlyTrashed()
            ->paginate(10);

        return View::make(
            'staffwarranty::ajax-trash-content',
            compact('warranties')
        );
    }

    public function removeFromTrash(Request $request)
    {
        $warranty = Warranty::withTrashed()
            ->find($request->id);

        Categorizable::where('categorizable_type', 'Warranty')
            ->where('categorizable_id', $request->id)
            ->delete();

        if ($warranty->product_variants) {
            foreach ($warranty->product_variants as $variant) {
                $variant->update([
                    'warranty_id' => 1,
                    'status' => 0,
                ]);
            }
        }

        $warranty->forceDelete();

        $warranties = Warranty::onlyTrashed()
            ->paginate(10);

        return View::make(
            'staffwarranty::ajax-trash-content',
            compact('warranties')
        );
    }

    public function warrantySearch(Request $request, Warranty $warranties)
    {
        $search_keyword = $request->search_keyword;

        $warranties = Warranty::query()
            ->where('name', 'LIKE', "%{$search_keyword}%")
            ->paginate(10);

        $trashed_warranties = Warranty::distinct('name')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($warranties) {
            $pageType = 'warrantySearch';
            return View::make(
                "staffwarranty::ajax-content",
                compact('warranties', 'pageType', 'trashed_warranties')
            );
        }
    }

    public function warrantyCatSearch(Request $request, Warranty $warranties)
    {
        $search_keyword = $request->search_keyword;

        $warranties = $warranties->whereHas(
            'categories',
            function ($query) use ($search_keyword) {
                $query->where('name', 'LIKE', '%' . $search_keyword . '%');
            }
        )->paginate(10);

        if ($warranties) {
            $pageType = 'warrantyCatSearch';
            $trashed_warranties = Warranty::distinct('name')
                ->onlyTrashed()
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return View::make(
                "staffwarranty::ajax-content",
                compact('warranties', 'pageType', 'trashed_warranties')
            );
        }
    }
}
