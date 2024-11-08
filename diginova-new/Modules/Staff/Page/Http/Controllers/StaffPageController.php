<?php

namespace Modules\Staff\Page\Http\Controllers;

use App\Models\Mediable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

use Modules\Staff\Brand\Http\Requests\staffpageImageRequest;
use Modules\Staff\Brand\Http\Requests\staffpageRequest;
use Modules\Staff\Category\Models\Categorizable;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Brand\Models\Brand;
use App\Models\Media;

class StaffPageController extends Controller
{

    public function index()
    {
        $brands = Brand::distinct('name')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $trashed_brands = Brand::distinct('name')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $media = Media:: all();
        $categories = Category:: all();
        return view('staffpage::index',
            compact('brands', 'media', 'categories', 'trashed_brands'));
    }

    public  function ajaxPagination(Request $request)
    {
        if ($request->paginatorNum){
            $paginatorNum = $request->paginatorNum;
        }
        else {
            $paginatorNum = 10;
        }

        $brands = Brand::distinct('name')
            ->orderBy('created_at', 'desc')
            ->paginate($paginatorNum);

        $trashed_brands = Brand::distinct('name')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $media = Media::all();
        $categories = Category::all();

        $pageType = 'index';

        return View::make('staffpage::ajax-content',
            compact('brands', 'media', 'categories', 'pageType', 'trashed_brands'))->render();
    }

    public function filterByType(Request $request)
    {
        if ($request->search_type == 'all')
        {
            return $this->ajaxPagination($request);
        }
        else {
            $brands = Brand::where('type', 1)
                ->distinct('name')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $trashed_brands = Brand::distinct('name')
                ->onlyTrashed()
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $pageType = 'only_special';

            if ($brands){
                return View::make('staffpage::ajax-content',
                    compact('brands', 'pageType', 'trashed_brands'));
            }

        }
    }

    public function create()
    {
        $categories = Category::get()->unique('name');
        return view('staffpage::create', compact('categories'));
    }

    public function edit($brand)
    {
        $brand = Brand::where('en_name', $brand)->first();
        $brands = Brand::all();
        $categories = Category::get()->unique('name');
        $media = Media:: all();

        return view('staffpage::edit',
            compact('categories', 'brand', 'brands', 'media'));
    }

    public function update(staffpageRequest $request)
    {
        // تبدیل آرایه ای از اعداد با فرمت رشته به آرایه عددی
        $categories = array_map(function($value) {
            return intval($value);
        }, $request->categories);

        $brand = Brand::find($request->id);

        Brand::find($request->id)->update([
            'name' => $request->name,
            'en_name' => $request->en_name,
            'description' => $request->description,
            'slug' => $request->slug,
        ]);

        $media = Brand::find($request->id)->media()->first();
        $user_id = auth()->guard('staff')->user()->id;

        if ($request->image)
        {
            $old_img = Mediable::where('media_id', $request->image)->first();
            if($old_img == null)
            {
                if (Brand::find($request->id)->media()->first() !== null
                    && Brand::find($request->id)->media()->first()->id !== $request->image){
                    Mediable::where('mediable_type', 'Brand')->where('mediable_id', $request->id)->delete();
                    if (($media) && ($media->person_role == 'staff') && ($media->person_id == $user_id)) {
                        unlink(public_path("$media->path/") . $media->name);
                    }
                    $media->delete();

                    Media::find($request->image)->update([
                        'status' => 1,
                    ]);

                    $this_brand = Brand::find($request->id)->id;
                    Media::find($request->image)->brands()->attach($this_brand);
                }
            }
        }

        Categorizable::where('categorizable_type', 'Brand')
            ->where('categorizable_id', $request->id)
            ->delete();

        foreach ($categories as $category)
        {
            $this_cat = Category::find($category);
            $brand->categories()->attach($this_cat);
        }

    }

    public function store(staffpageRequest $request)
    {
        // تبدیل آرایه ای از اعداد با فرمت رشته به آرایه عددی
        $categories = array_map(function($value) {
            return intval($value);
        }, $request->categories);

        $brand = Brand::create([
            'name' => $request->name,
            'en_name' => $request->en_name,
            'description' => $request->description,
            'slug' => $request->slug,
        ]);

        foreach ($categories as $category)
        {
            $this_cat = Category::find($category);
            $brand->categories()->attach($this_cat);
        }

        if ($request->image !== 'not_required')
        {
            Media::find($request->image)->brands()->attach($brand);
            Media::find($request->image)->update([
                'status' => 1,
            ]);
        }
    }

    public function uploadImage(staffpageImageRequest $request)
    {
        if ($request->old_img){
            $request->id = $request->old_img;
            $this->deleteImage($request);
        }

        $imageSize = $request->file('image')->getSize();

        $input['image'] = time().'.'.$request->image->extension();
        $request->image->move(public_path('media'), $input['image']);

        $media = Media::create([
            'name' => $input['image'],
            'path' => 'media',
            'person_id' => auth()->guard('staff')->user()->id,
            'person_role' => 'staff',
        ]);


        return View::make("staffpage::layouts.ajax.image-box.upload-image" ,
            compact('input', 'imageSize', 'request' , 'media'));
    }

    public function uploadUpdate(staffpageImageRequest $request)
    {
        if ($request->old_img) {
            $request->id = $request->old_img;
            if(Mediable::where('media_id', $request->old_img)->first() == null)
            {
                $this->deleteImage($request);
            }
        }

        $imageSize = $request->file('image')->getSize();

        $input['image'] = time() . '.' . $request->image->extension();
        $request->image->move(public_path('media'), $input['image']);

        $media = Media::create([
            'name' => $input['image'],
            'path' => 'media',
            'person_id' => auth()->guard('staff')->user()->id,
            'person_role' => 'staff',
        ]);

        return View::make("staffpage::layouts.ajax.image-box.upload-image",
            compact('input', 'imageSize', 'request', 'media'));
    }

    public function deleteImage(Request $request)
    {
        $media = Media::find($request->id);
        $user_id = auth()->guard('staff')->user()->id;

        if(($media) && ($media->person_role == 'staff') && ($media->person_id == $user_id))
        {
            unlink(public_path("$media->path/"). $media->name);
            $media->delete();
        }
    }

    public function trash()
    {
        $brands = Brand::onlyTrashed()->paginate(10);
        return view('staffpage::trash', compact('brands'));
    }

    public function trashPagination(){
        $brands = Brand::onlyTrashed()->paginate(10);
        return View::make('staffpage::ajax-trash-content', compact('brands'));
    }

    public function moveToTrash(Request $request)
    {
        Brand::find($request->id)->delete();
        return $this->ajaxPagination($request);
    }

    public function restoreFromTrash(Request $request)
    {
        Brand::withTrashed()->find($request->id)->restore();
        $brands = Brand::onlyTrashed()->paginate(10);
        return View::make('staffpage::ajax-trash-content', compact('brands'));
    }

    public function removeFromTrash(Request $request)
    {
        $brand = Brand::withTrashed()->find($request->id);
        $media = $brand->media()->first();
        $user_id = auth()->guard('staff')->user()->id;
        if (($media) && ($media->person_role == 'staff') && ($media->person_id == $user_id)) {
            unlink(public_path("$media->path/") . $media->name);
            $media->delete();
            Mediable::where('mediable_type', 'Brand')
                ->where('mediable_id', $request->id)
                ->delete();
        }

        Categorizable::where('categorizable_type', 'Brand')->where('categorizable_id', $request->id)->delete();
        $brand->forceDelete();
        if($brand->products)
        {
            foreach ($brand->products as $product)
            {
                $product->update([
                   'brand_id' => 0,
                ]);
            }
        }
        $brands = Brand::onlyTrashed()->paginate(10);
        return View::make('staffpage::ajax-trash-content', compact('brands'));

    }

    public function brandSearch(Request $request, Brand $brands)
    {
        $search_keyword = $request->search_keyword;

        $brands = Brand::query()->where('name', 'LIKE', "%{$search_keyword}%")->paginate(10);
        $trashed_brands = Brand::distinct('name')->onlyTrashed()->orderBy('created_at', 'desc')->paginate(10);

        if ($brands) {
            $pageType = 'brandSearch';

            return View::make("staffpage::ajax-content",
                compact('brands', 'pageType', 'trashed_brands'));
        }
    }

    public function brandCatSearch(Request $request, Brand $brands)
    {
        $search_keyword = $request->search_keyword;

        $brands = $brands->whereHas('categories', function ($query) use ($search_keyword) {
            $query->where('name', 'LIKE', '%' . $search_keyword . '%');
        })->paginate(5);

        if ($brands) {
            $pageType = 'brandCatSearch';
            $trashed_brands = Brand::distinct('name')->onlyTrashed()->orderBy('created_at', 'desc')->paginate(10);
            return View::make("staffpage::ajax-content", compact('brands', 'pageType', 'trashed_brands'));
        }
    }

}
