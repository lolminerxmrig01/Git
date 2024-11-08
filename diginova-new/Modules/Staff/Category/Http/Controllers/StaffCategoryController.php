<?php

namespace Modules\Staff\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

use App\Models\Media;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Category\Http\Requests\StaffCategoryRequest;
use Illuminate\Contracts\Auth\Guard;
use Auth;

class StaffCategoryController extends Controller
{
    protected $staff_id;

    public function __construct(Guard $auth)
    {
        $this->middleware(function ($request, $next) {
            $this->staff_id = Auth::guard('staff')->user()->id;
            return $next($request);
        });
    }

    /**
     * index page.
     *
     * @return Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::latest()->get();

        return view('staffcategory::index',
            compact('categories'));
    }

    /**
     * create page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::latest()->get();

        return view('staffcategory::create',
            compact('categories'));
    }

    /**
     * get category data for index page.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->id);

        if ($cat_media = $category->media()->first()) {
            return response()->json([
                'image' => View::make('staffcategory::layouts.ajax.image-box.uploaded-image',
                    compact('cat_media'))->render(),
                'category' => $category,
            ]);
        }

        return response()->json([
            'category' => $category,
        ]);
    }

    public function update(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $media = $category->media()->first();

        $category->update([
            'name' => $request->name,
            'en_name' => $request->en_name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        if ($request->image_id !== null && $media !== null) {
            $this->deleteImage($category->media()->first()->id);
            $category->media()->detach();
        }

        if ($request->image_id !== null) {
            $image = Media::findOrFail($request->image_id);
            $image->categories()->attach($category->id);
            $image->update([
                'status' => 1,
            ]);
        }

        if ($request->image_id == null && $media !== null) {
            $request->id = $category->media()->first()->id;
            $category->media()->detach();
            $this->deleteImage($request);
        }

    }

    /**
     * category children loader.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|null
     */
    public function childCatsLoader(Request $request)
    {
        $categories = Category::latest()
            ->get();

        $id = intval($request->id);

        // حل مشکل ستون های خالی
        if (Category::whereParentId($id)->exists()) {
            return View::make("staffcategory::layouts.ajax.category-box.child",
                compact('id', 'categories'));
        }

        return null;
    }

    /**
     * breadcrumb loader
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function breadcrumbLoader(Request $request)
    {
        $category = Category::findOrFail($request->id);

        return View::make("staffcategory::layouts.ajax.category-box.breadcrumb",
            compact('category'));
    }

    /**
     * main category loader
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function mainCatReloader(Request $request)
    {
        $categories = Category::latest()
            ->get();

        return View::make("staffcategory::layouts.ajax.category-box.main",
            compact('categories'));
    }

    /**
     * ajax search category.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function ajaxSearch(Request $request)
    {
        $categories = Category::query()
            ->where('name', 'LIKE', "%{$request->search}%")
            ->get();

        return View::make("staffcategory::layouts.ajax.category-box.search",
            compact('categories'));
    }

    /**
     * delete image.
     *
     * @param Request $request
     */
    public function deleteImage(Request $request)
    {
        $media = Media::find($request->id);

        if($media) {
            $imagePath = public_path($media->path . "\/" . $media->name);
            if (file_exists($imagePath)) {
                unlink($imagePath);
                $media->delete();
            }
        }
    }

    public function uploadImage(Request $request)
    {
        if ($request->old_img) {
            $request->id = $request->old_img;
            if (filled($request->category_id)) {
                $category = Category::findOrFail($request->category_id);
                $category->media()->detach();
            }
            $this->deleteImage($request);
        }

        $imageSize = $request->file('image')->getSize();
        $imageExtension = $request->file('image')->extension();
        $input['image'] = time() . '.' . $imageExtension;

        $request->file('image')->move(public_path('media/categories'), $input['image']);

        $media = Media::create([
            'name' => $input['image'],
            'path' => 'media/categories',
            'person_id' => $this->staff_id,
            'person_role' => 'staff',
        ]);

        return View::make("staffcategory::layouts.ajax.image-box.upload-image",
            compact('input', 'imageSize', 'request', 'media'));
    }

    /**
     * delete category with all children and transfer or delete dependencies.
     *
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $all_children = array_reverse($this->getAllChildren($category));
        array_push($all_children, $category->id);

        foreach($all_children as $child_id) {
                $child_category = Category::findOrFail($child_id);
                $this->transferDependenciesToUncategorized($child_category);
                $this->deleteDependencies($child_category);
                $child_category->delete();
        }
    }


    public function deleteSubCategory($cat_id)
    {
        $sub_categories = Category::where('parent_id', $cat_id)->get();
        foreach ($sub_categories as $sub_category) {
            $sub_category_id = $sub_category->id;

            if ($sub_category_id->media()->exists()) {
                $media = $sub_category_id->media()->first();
                unlink(public_path("$media->path/") . $media->name);
                $sub_category_id->media()->detach();
                $sub_category_id->media()->delete();
            }
            $sub_category->product_variants()->detach();
            $sub_category->product_variants()->forceDelete();
            $sub_category->products()->detach();
            $sub_category->products()->forceDelete();

            $sub_category->delete();

            if (Category::where('parent_id', $sub_category_id)->exists()) {
                $this->deleteSubCategory($sub_category_id);
            }
        }
    }

    /**
     * store new category.
     *
     * @param StaffCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StaffCategoryRequest $request)
    {
        Category::updateOrCreate(['en_name' => $request->en_name], [
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
            'description' => $request->description,
        ]);

        $category = Category::whereEnName($request->en_name)->first();

        if ($media = Media::whereId($request->image)->first()) {
            $media->categories()->attach($category);
            $media->update([
                'status' => 1,
            ]);
        }

        return response()->json(true, 200);

//        if (VariantGroup::whereId(1)->exists()) {
//            $variantGroup = VariantGroup::find(1);
//            $category->variantGroup()->attach($variantGroup);
//        }

//        $rating_ids = [1, 2, 3, 4];
//        foreach ($rating_ids as $id) {
//            if (Rating::whereId($id)->exists()) {
//                $rating = Rating::find($id);
//                $category->ratings()->attach($rating);
//            }
//        }
    }


    /**
     * delete category dependencies.
     *
     * @param $category
     */
    public function deleteDependencies($category)
    {
        /**
         * delete media
         */
        if ($media = $category->media()->first()) {
            $category->media()->detach();
            $category->media()->delete();
            unlink(public_path("$media->path/") . $media->name);
        }
    }

    /**
     * transfer dependencies to uncategorized category.
     *
     * @param $category
     * @param string[] $dependencies
     */
    public function transferDependenciesToUncategorized($category)
    {
        /** @var $uncategorized */
        $uncategorized = Category::whereEnName('uncategorized')
            ->first();

        /** @var array $dependencies */
        $dependencies = [
            'products',
            'brands',
            'warranties',
            'variantGroup',
            'attributes',
            'ratings',
            'types',
        ];

        /**
         * if there was no uncategorized then
         * category detach relationships with category.
         */
        if (! $uncategorized)
        {
            Category::create([
                'name' => 'دسته بندی نشده',
                'en_name' => 'uncategorized',
                'slug' => 'uncategorized',
                'parent_id' => 0
            ]);
        }

        foreach ($dependencies as $dependency) {
            foreach ($category->$dependency as $item) {
                $item->categories()->detach($category);
                $item->categories()->attach($uncategorized);
            }
        }
    }

    /**
     * return array of category children.
     *
     * @param $category
     * @return array
     */
    private function getAllChildren($category)
    {
        $ids = [];
        foreach ($category->children as $cat) {
            $ids[] = $cat->id;
            $ids = array_merge($ids, $this->getAllChildren($cat));
        }
        return $ids;
    }
}
