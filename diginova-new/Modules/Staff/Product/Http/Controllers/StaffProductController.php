<?php

namespace Modules\Staff\Product\Http\Controllers;

use App\Models\Mediable;
use App\Models\SeoContent;
use Modules\Staff\Setting\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;

use App\Models\Media;
use Modules\Staff\Attribute\Models\Attribute;
use Modules\Staff\Attribute\Models\AttributeProduct;
use Modules\Staff\Category\Models\Categorizable;
use Modules\Staff\Product\Models\Product;
use Modules\Staff\Brand\Models\Brand;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Product\Models\ProductHasVariant;
use Modules\Staff\Product\Models\ProductType;
use Modules\Staff\Variant\Models\VariantGroup;


class StaffProductController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')
            ->paginate(10);

        $trashed_products = Product::distinct('title_fa')
            ->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $settings = Setting::select('name', 'value')->get();

        return view('staffproduct::index',
         compact('products', 'trashed_products', 'settings'));
    }

    public function edit($id)
    {
        $product = Product::where('product_code',$id)->firstOrFail();
        $category = $product->category[0];
        do {
            $main_cat=$category->parent;
            $lists[] = $category;
            $parent_category = $category;
            $category = $category->parent;
        } while (isset($category));
        $lists = array_reverse($lists,true);

        foreach ($lists as $list) {
            $all_parent[] = $list->id;
        }
        array_unshift($all_parent,0);

        $categories = Category::all();
        $attr_groups = $product->category[0]->attributeGroups;

        $settings = Setting::select('name', 'value')->get();

        return view('staffproduct::edit', 
            compact('product', 'all_parent', 'categories', 'attr_groups', 'parent_category', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        $settings = Setting::select('name', 'value')->get();

      return view('staffproduct::create', compact('categories', 'settings'));
    }

    /**
     * Return the tree structure View for category select section.
     * @return Response
     */
    public function childCatsLoader(Request $request)
    {
        $categories = Category::all();
        $id = $request->parent_id;

        return View::make("staffproduct::ajax.child-cat-loader",
         compact('id', 'categories'));
    }

    /**
     * Return the result for category search section.
     * @return Response
     */
    public function searchCategories(Request $request)
    {
        if (!is_null($request->q)) {
            $categories = Category::query()->where('name', 'LIKE', "%{$request->q}%")->get();
            return View::make("staffproduct::ajax.search-categories", compact('categories'));
        }

        $categories = Category::all();
        
        return View::make("staffproduct::ajax.main-cat-loader", compact('categories'));
    }

    /**
     * Return the result for step two in create page.
     * @return Response
     */
    public function stepProduct(Request $request)
    {
        $category = Category::findOrFail($request->category_id);

        while ($category->parent) {
            $category = $category->parent;
        }

        if ($category->parent_id == 0) {
            $cat = $category->brands;
        }

        foreach ($cat as $brand) {
            $brands[] = array("value" => $brand->id, "text" => $brand->name . ' (' . $brand->en_name . ')');
        }

        $defualt_brand = array("value" => "", "text" => 'برند کالا را انتخاب کنید');
        $miscellaneous_brand = array("value" => 1, "text" => 'متفرقه Miscellaneous');

        if (!isset($brands)) {
            $brands = [];
        }

        array_unshift($brands, $miscellaneous_brand);
        array_unshift($brands, $defualt_brand);

        $find_category = Category::findOrFail($request->category_id);

        foreach ($find_category->types as $type) {
            $types[] = array("value" => $type->id, "text" => $type->name);
        }

        if (!isset($types)) {
            $types = [];
        }

        if (count($types) > 0) {
            $defualt_types = array("value" => "", "text" => 'دسته‌بندی کالا را انتخاب کنید');
            array_unshift($types, $defualt_types);
        }


      $category = $find_category;
      if ($category->variantGroup()->exists()){
          $variant_group = $category->variantGroup()->first();
      } else {
          $variant_group = '';
      }

      if ($category->variantGroup()->exists() && !is_null($category->variantGroup()->first()->description)) {
            $categoryThemeDescription = "<strong>تنوع $variant_group->name: </strong>$variant_group->description";
        } else {
            $categoryThemeDescription = "<strong>تعیین نشده: </strong>برای تعیین تنوع مجاز برای دسته‌بندی انتخابی از بخش تنوع روی دکمه تعیین تنوع مجاز کلیک کنید";
        }


        $jayParsedAry = [
            "status" => true,
            "data" => [
                "categoryFormValid" => true,
                "fields" => [
                    "select" => [
                        "brands" => [
                            "options" =>
                                $brands,
                        ],
                        "categoryProductTypes" => [
                            "options" =>
                                $types,
                        ],
                    ],
                    "span" => [
//                        "categoryTheme" => "sized",
                        "categoryThemeTranslated" => (isset($variant_group->name))? $variant_group->name : '',
                        "categoryTitle" => $category->name,
                        "categoryThemeDescription" => $categoryThemeDescription
                    ],
                    "extra" => [
                        "allow_fake" => true,
                        "brand_other_id" => 719
                    ]
                ]
            ]
        ];

        return response()->json($jayParsedAry, 200);
    }

    public function stepAttributes(Request $request)
    {
        $category = Category::find($request->category_id);

        $attr_groups = $category->attributeGroups;

        return View::make("staffproduct::ajax.attributes-step", compact('attr_groups'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "product.package_length" => "required",
            "product.package_width" => "required",
            "product.package_height" => "required",
            "product.package_weight" => "required",
            "product.brand_id" => "required",
            "product.product_nature" => "required",
            "product.model" => "required",
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

        if (filled($request->slug))
            $slug = $request->slug;

        if ($request->product['brand_id'] == 1) {
          $slug = $request->product['product_nature'] . ' مدل ' . $request->product['model'];
        }
        else {
          $brand = Brand::find($request->product['brand_id'])->name;
          $slug = $request->product['product_nature'] . ' ' . $brand . ' مدل ' . $request->product['model'];
          $slug = str_replace(' ', '-', $slug);
        }

        if (!is_null($request->seo_title)) {
            $seo_title = $request->seo_title;
        }
        else {
            $predix = Setting::where('name','product_title_prefix')->first()->value;
            if ($request->product['brand_id'] == 0) {
                $seo_title = $predix . ' ' . $request->product['product_nature'] . ' مدل ' . $request->product['model'];
            } else {
                $brand = Brand::find($request->product['brand_id'])->name;
                $seo_title = $predix . ' ' . $request->product['product_nature'] . ' ' . $brand . ' مدل ' . $request->product['model'];
            }
        }

        if (!is_null($request->seo_keyword_meta)) {
            $this_key = '';
            foreach (json_decode($request->seo_keyword_meta) as $keyword) {
                $seo_keyword_meta = (array)$keyword;
                foreach ($keyword as $key) {
                    $val[] = $key;
                    if (isset($val[0]) && !is_null($key)) {
                        $this_key = $this_key . ',' . $key;
                    }
                }
                $seo_keyword_meta = ltrim($this_key, ',');

            }
        }
        else {
            $seo_keyword_meta = '';
        }


        if (isset($request->product['advantages']) && !is_null($request->product['advantages']))
        {
            foreach ($request->product['advantages'] as $key => $advantage) {
                if (mb_strlen($advantage) >= 5 && mb_strlen($advantage) <= 50){
                    $advantages[] = $advantage;
                }
            }
            $advantages = json_encode($advantages);
        }
        else {
            $advantages = null;
        }

        if (isset($request->product['disadvantages']) && !is_null($request->product['disadvantages']))
        {
            foreach ($request->product['disadvantages'] as $disadvantage) {
                if (mb_strlen($disadvantage) >= 5 && mb_strlen($disadvantage) <= 50){
                    $disadvantages[] = $disadvantage;
                }
            }
            $disadvantages = json_encode($disadvantages);
        }
        else {
            $disadvantages = null;
        }

        // product code
        if(count(Product::all())){
            $product_code = Product::withTrashed()->max('product_code')+1;
        } else {
            $product_code = 1000000;
        }

        $product = Product::create([
            'status' => $request->publish_status,
            'title_fa' => $request->title['title_fa'],
            'title_en' => $request->title['title_en'],
            'nature' => $request->product['product_nature'],
            'advantages' => $advantages,
            'disadvantages' => $disadvantages,
            'brand_id' => $request->product['brand_id'],
            'model' => $request->product['model'],
            'is_iranian' => $request->product['is_iranian'],
            'length' => $request->product['package_length'],
            'width' => $request->product['package_width'],
            'height' => $request->product['package_height'],
            'weight' => $request->product['package_weight'],
            'description' => $request->product['description'],
            'product_code' => $product_code,
            'slug' => $slug,
        ]);

        SeoContent::create([
            'title' => $seo_title,
            'keyword' => $seo_keyword_meta,
            'description' => $request->seo_description_meta,
            'custom_code' => $request->seo_custom_meta,
            'seoable_type' => 'Product',
            'seoable_id' => $product->id,
        ]);

        $category = Category::find($request->product['category_id']);

        Categorizable::create([
           'category_id' => $request->product['category_id'],
           'categorizable_type' => 'Product',
           'categorizable_id' => $product->id,
        ]);

        if (isset($request['attributes']) && !is_null($request['attributes']))
        {
            foreach ($request['attributes'] as $id => $value) {
                if(is_array($value)){
                    if (Attribute::find($id)->unit()->count())
                    {
                        $unit = Attribute::find($id)->unit;
                        if ($unit->type == 1) {
                            $val_position = 0;
                            foreach ($unit->values()->orderBy('position')->get() as $val) {
                                AttributeProduct::create([
                                    'attribute_id' => $id,
                                    'product_id' => $product->id,
                                    'unit_id' => $unit->id,
                                    'unit_value_id' => $val->id,
                                    'value' => $value[$val_position],
                                ]);
                                $val_position++;
                            }
                        }

                    }
                    else {
                        foreach ($value as $val) {
                            AttributeProduct::create([
                                'attribute_id' => $id,
                                'product_id' => $product->id,
                                'value_id' => $val,
                            ]);
                        }
                    }
                }
                elseif (!is_array($value) && !is_null($value)) {
                    $unit = Attribute::find($id)->unit;
                    if (Attribute::find($id)->unit()->count()) {
                        if ($unit->type == 0) {
                            AttributeProduct::create([
                                'attribute_id' => $id,
                                'product_id' => $product->id,
                                'unit_id' => $unit->id,
                                'value' => (isset($request['attributes'][$id])) ? $request['attributes'][$id] : '',
                            ]);
                        }
                    }
                    elseif (Attribute::find($id)->values()->count()) {

                        AttributeProduct::create([
                            'attribute_id' => $id,
                            'product_id' => $product->id,
                            'value_id' => (isset($request['attributes'][$id])) ? $request['attributes'][$id] : '',
                        ]);
                    }
                    else {
                        AttributeProduct::create([
                            'attribute_id' => $id,
                            'product_id' => $product->id,
                            'value' => (isset($request['attributes'][$id])) ? $request['attributes'][$id] : '',
                        ]);
                    }
                }
            }
        }

        if (isset($request->product['types'])) {
            foreach ($request->product['types'] as $key => $type) {
                ProductType::create([
                    'product_id' => $product->id,
                    'type_id' => $type,
                ]);
            }
        }

        if (isset($request->images['images']))
        {
          foreach ($request->images['images'] as $key => $value)
        {
            if($request['images']['main_image'] == $value){
                $is_main = 1;
            } else {
                $is_main = 0;
            }

            Mediable::create([
                'media_id' => $value,
                'mediable_type' => 'Product',
                'mediable_id' => $product->id,
                'position' => $key,
                'is_main' => $is_main,
            ]);

            Media::where('id', $value)->update([
                'status' => 1,
            ]);


            $user_id = auth()->guard('staff')->user()->id;


            $all_images = $request['images']['order'];
            $all_images = explode(',', $all_images);

            $available_images = $request['images']['images'];

            $only_trashed = array_diff($all_images, $available_images);

            foreach ($only_trashed as $item)
            {
                $media = Media::find($item);
                if(($media) && ($media->person_role == 'staff') && ($media->person_id == $user_id))
                {
                    unlink(public_path("$media->path/"). $media->name);
                    $media->delete();
                }
            }

        }
        }


        $json_response = [
            "status" => true,
            "data" => [
                "save" => [
                    "status" => true,
                    "id" => $product->product_code,
                ]
            ]
        ];

        return response()->json($json_response, 200);

    }

    public function update(Request $request)
    {

        if (!is_null($request->slug)) {
            $slug = $request->product['slug'];
        } else {
            $slug = $request->product['suggest_slug'];
        }

        if (!is_null($request->seo_title)) {
            $seo_title = $request->product['seo_title'];

        } else {
            $seo_title = $request->product['suggest_seo_title'];
        }


        if (isset($request->product['advantages']) && !is_null($request->product['advantages']))
        {
            foreach ($request->product['advantages'] as $key => $advantage) {
                if (mb_strlen($advantage) >= 5 && mb_strlen($advantage) <= 50){
                    $advantages[] = $advantage;
                }
            }
            $advantages = json_encode($advantages);
        }
        else {
            $advantages = null;
        }

        if (isset($request->product['disadvantages']) && !is_null($request->product['disadvantages']))
        {
            foreach ($request->product['disadvantages'] as $disadvantage) {
                if (mb_strlen($disadvantage) >= 5 && mb_strlen($disadvantage) <= 50){
                    $disadvantages[] = $disadvantage;
                }
            }
            $disadvantages = json_encode($disadvantages);
        }
        else {
            $disadvantages = null;
        }


        Product::find($request->product['product_id'])->update([
//            'status' => $request->publish_status,
            'title_fa' => $request->product['title_fa'],
            'title_en' => $request->product['title_en'],
            'nature' => $request->product['product_nature'],
            'advantages' => $advantages,
            'disadvantages' => $disadvantages,
            'brand_id' => $request->product['brand_id'],
            'model' => $request->product['model'],
            'is_iranian' => $request->product['is_iranian'],
            'length' => $request->product['package_length'],
            'width' => $request->product['package_width'],
            'height' => $request->product['package_height'],
            'weight' => $request->product['package_weight'],
            'description' => $request->product['description'],
            'slug' => $slug,
        ]);

        Product::find($request->product['product_id'])->seo()->update([
            'title' => $request->product['seo_title'],
            'keyword' => $request->product['seo_keyword_meta'],
            'description'=> $request->product['seo_description_meta'],
            'custom_code' => $request->product['seo_custom_meta'],
        ]);

        $product = Product::find($request->product['product_id']);

        if (isset($request['attributes']) && !is_null($request['attributes']))
        {
            foreach ($request['attributes'] as $id => $value) {
                if(is_array($value)){
                    if (Attribute::find($id)->unit()->count())
                    {
                        $unit = Attribute::find($id)->unit;
                        if ($unit->type == 1) {
                            $attribute_products = AttributeProduct::where('product_id', $product->id)->where('attribute_id', $id)
                                ->select('unit_value_id', 'value')->get();
                            if (count($attribute_products)){
                                foreach (json_decode($attribute_products) as $attribute_product) {
                                    $attribute_product = (array) $attribute_product;
                                    AttributeProduct::where('product_id', $product->id)
                                        ->where('attribute_id', $id)
                                        ->where('unit_value_id', $attribute_product['unit_value_id'])
                                        ->update([
                                            'value' => $request['attributes'][$id][$attribute_product['unit_value_id']],
                                        ]);
                                }
                            }
                        }
                    }
                    else {
                        AttributeProduct::where('product_id', $product->id)->where('attribute_id', $id)->delete();
                        foreach ($value as $val) {
                            AttributeProduct::create([
                                'attribute_id' => $id,
                                'product_id' => $product->id,
                                'value_id' => $val,
                            ]);
                        }
                    }
                }
                elseif (!is_array($value) && !is_null($value)) {
                    $unit = Attribute::find($id)->unit;
                    if (Attribute::find($id)->unit()->count()) {
                        if ($unit->type == 0) {
                            AttributeProduct::where('product_id', $product->id)
                                ->where('attribute_id', $id)
                                ->update([
                                'value' => (isset($request['attributes'][$id])) ? $request['attributes'][$id] : '',
                            ]);
                        }
                    }
                    elseif (Attribute::find($id)->values()->count()) {
                        AttributeProduct::where('product_id', $product->id)
                            ->where('attribute_id', $id)
                            ->update([
                            'value_id' => (isset($request['attributes'][$id])) ? $request['attributes'][$id] : '',
                        ]);
                    }
                    else {
                        AttributeProduct::where('product_id', $product->id)
                            ->where('attribute_id', $id)
                            ->update([
                            'value' => (isset($request['attributes'][$id])) ? $request['attributes'][$id] : '',
                        ]);
                    }
                }
            }
        }

        if (isset($request->product['types'])) {
            ProductType::where('product_id', $product->id)->delete();
            foreach ($request->product['types'] as $key => $type) {
                ProductType::create([
                    'product_id' => $product->id,
                    'type_id' => $type,
                ]);
            }
        }

        Mediable::where('mediable_type', 'Product')->where('mediable_id', $product->id)->delete();

        if (isset($request->images['images'])) {
          foreach ($request->images['images'] as $key => $value)
          {
            if($request['images']['main_image'] == $value){
              $is_main = 1;
            } else {
              $is_main = 0;
            }

            Mediable::create([
              'media_id' => $value,
              'mediable_type' => 'Product',
              'mediable_id' => $product->id,
              'position' => $key,
              'is_main' => $is_main,
            ]);

            Media::where('id', $value)->update([
              'status' => 1,
            ]);

            $user_id = auth()->guard('staff')->user()->id;
            $all_images = $request['images']['order'];
            $all_images = explode(',', $all_images);
            $available_images = $request['images']['images'];

            $only_trashed = array_diff($all_images, $available_images);

            foreach ($only_trashed as $item)
            {
              $media = Media::find($item);
              if(($media) && ($media->person_role == 'staff') && ($media->person_id == $user_id))
              {
                unlink(public_path("$media->path/"). $media->name);
                $media->delete();
              }
            }
          }
        }

        return response()->json([
          'status' => true,
          'data' => [
            'forceUrl' => 'testss',
            'redirectUrl' => 'jjwjwj',
          ],
        ], 200);

    }

    public function ajaxPagination(Request $request)
    {
        if ($request->paginatorNum) {
            $paginatorNum = $request->paginatorNum;
        } else {
            $paginatorNum = 10;
        }

        $products = Product::orderBy('created_at', 'desc')->paginate($paginatorNum);
        $trashed_products = Product::onlyTrashed()->orderBy('created_at', 'desc')->paginate(10);

        $media = Media::all();
        $categories = Category::all();

        $pageType = 'index';

        return View::make('staffproduct::ajax.ajax-content',
            compact('products', 'media', 'categories', 'pageType', 'trashed_products'))->render();

    }

    public function filterByType(Request $request)
    {
        if ($request->search_type == 'all') {
            return $this->ajaxPagination($request);

        } else {
            $products = Product::where('type', 1)->orderBy('created_at', 'desc')->paginate(10);
            $trashed_products = Product::distinct('name')->onlyTrashed()->orderBy('created_at', 'desc')->paginate(10);
            $pageType = 'only_special';

            if ($products) {
                return View::make('staffproduct::ajax.ajax-content', compact('products', 'pageType', 'trashed_products'));
            }

        }
    }

    public function trash()
    {
        $products = Product::onlyTrashed()->paginate(10);
        return view('staffproduct::trash', compact('products'));
    }

    public function trashPagination()
    {
        $products = Product::onlyTrashed()->paginate(10);
        return View::make('staffproduct::ajax.ajax-trash-content', compact('products'));
    }

    public function moveToTrash(Request $request)
    {
        Product::find($request->id)->delete();
        return $this->ajaxPagination($request);
    }

    public function restoreFromTrash(Request $request)
    {
        Product::withTrashed()->find($request->id)->restore();
        $products = Product::onlyTrashed()->paginate(10);
        return View::make('staffproduct::ajax.ajax-trash-content', compact('products'));
    }

    public function removeFromTrash(Request $request)
    {
        ProductType::where('product_id', $request->id)->forceDelete();
        SeoContent::where('seoable_type', 'Product')->where('seoable_id', $request->id)->delete();
        AttributeProduct::where('product_id', $request->id)->delete();
        ProductHasVariant::where('product_id', $request->id)->forceDelete();
        Product::withTrashed()->find($request->id)->media()->forceDelete();
        Product::withTrashed()->find($request->id)->categories()->detach();
        Product::withTrashed()->find($request->id)->seo()->delete();
        Product::withTrashed()->find($request->id)->forceDelete();
        $products = Product::onlyTrashed()->paginate(10);

        return View::make('staffproduct::ajax.ajax-trash-content', compact('products'));
    }

    public function productSearch(Request $request, Brand $brands)
    {
        $search_keyword = $request->search_keyword;

        $products = Product::query()->where('title_fa', 'LIKE', "%{$search_keyword}%")->paginate(1);
        $trashed_products = Product::onlyTrashed()->orderBy('created_at', 'desc')->paginate(10);

        if ($products) {
            $pageType = 'productSearch';
            return View::make("staffproduct::ajax.ajax-content",
                compact('products', 'pageType', 'trashed_products'));
        }
    }

    public function productCatSearch(Request $request, Product $products)
    {
        $search_keyword = $request->search_keyword;

        $products = $products->whereHas('categories', function ($query) use ($search_keyword) {
            $query->where('name', 'LIKE', '%' . $search_keyword . '%');
        })->paginate(5);

        if ($products) {
            $pageType = 'brandCatSearch';
            $trashed_products = Product::onlyTrashed()->orderBy('created_at', 'desc')->paginate(10);
            return View::make("staffproduct::ajax.ajax-content", compact('products', 'pageType', 'trashed_products'));
        }
    }

    public function statusProduct(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->update([
            'status' => $request->status,
        ]);
    }

    public function variant($id)
    {
        $product = Product::where('product_code',$id)->firstOrFail();
        $category = $product->category()->first();
        while ($category->parent) {
            $category = $category->parent;
        }

        if ($category->parent_id == 0) {
            if (count($category->warranties)) {
                $warranties = $category->warranties;
            } else {
                $warranties = [];
            }
        }

        $settings = Setting::select('name', 'value')->get();
        return view('staffproduct::variant', compact('settings', 'product', 'warranties'));
    }

    public function variantSave(Request $request)
    {
        // variant code
        if(ProductHasVariant::count()){
            $variant_code = ProductHasVariant::max('variant_code')+1;
        } else {
            $variant_code = 2000000;
        }

//        $i = 0;
        foreach($request->product_variants['variants'] as $i) {

            // if (!isset($request->product_variants["variant_{$i}_attribute"])) {
            //     continue;
            // }

            ProductHasVariant::create([
                'product_id' => $request->product_variants['product_id'],
                'variant_id' => isset($request->product_variants["variant_{$i}_attribute"])
                ? $request->product_variants["variant_{$i}_attribute"]
                : null,
                'status' => $request->product_variants["variant_{$i}_active"],
                'post_time' => $request->product_variants["variant_{$i}_post_time"],
                'max_order_count' => $request->product_variants["variant_{$i}_order_limit"],
                'buy_price' => $request->product_variants["variant_{$i}_buy_price"],
                'sale_price' => $request->product_variants["variant_{$i}_price"],
                'warranty_id' => $request->product_variants["variant_{$i}_warranty_id"],
                'stock_count' => $request->product_variants["variant_{$i}_marketplace_seller_stock"],
                'variant_code' => $variant_code,
                'shipping_type' => 'site',
            ]);
            $i++;
        }

        $product_variants = ProductHasVariant::where('product_id', $request->product_variants['product_id'])->get();

//        foreach ($product_variants as $pr_variant) {
//            $product_array_variants[] = array($pr_variant => "1");
//        }
        $product = Product::findOrFail($request->product_variants['product_id']);
        $this->updateProductMainDetails($product);

        $jsonResponse= [
            "status" => true,
            "data" => [
                "variationData" => [
//                    "variation_pairs" => $product_array_variants,
//                    "total_variants" => count($product_variants),
                ]
            ]
        ];

        return response()->json($jsonResponse, 200);

    }

    public function ajaxVariantsList(Request $request){
        $settings = Setting::select('name', 'value')->get();
        $product = Product::find($request->search['product_id']);
        return View::make("staffproduct::ajax.variant.ajax-variant-list", compact('product', 'settings'));
    }

    public function variantUpdate(Request $request)
    {
        $status = isset($request->product_variant['active']) ? 1 : 0;
        ProductHasVariant::where('id', $request->product_variant['product_variant_id'])->update([
            'status' => $status,
            'post_time' => $request->product_variant['lead_time'],
            'max_order_count' => $request->product_variant['order_limit'],
            'buy_price' => $request->product_variant['buy_price'],
            'sale_price' => $request->product_variant['price'],
//            'warranty_id' => $request->product_variant["warranty_id"],
            'stock_count' => $request->product_variant['marketplace_seller_stock'],
        ]);

        $product_variants = ProductHasVariant::where('product_id', $request->product_variant['product_id'])->get();
        $product_variant = ProductHasVariant::find($request->product_variant['product_variant_id']);

        $jsonResponse= [
            "status" => true,
            "data" => [
                "product_variant_id" => $request->product_variant['product_variant_id'],
                "active" => ($product_variant->status)? true : false,
                "active_int" => ($product_variant->status)? 1 : 0,
                "lead_time" => $product_variant->post_time,
                "lead_time_fa" => persianNum($product_variant->post_time),
                "marketplace_seller_stock" => $product_variant->stock_count,
                "marketplace_seller_stock_fa" => persianNum($product_variant->stock_count),
                "sale_price" => $product_variant->sale_price,
                "sale_price_fa" => persianNum($product_variant->sale_price),
                "buy_price" => $product_variant->buy_price,
                "buy_price_fa" => persianNum($product_variant->buy_price),
                "order_limit" => $product_variant->max_order_count,
                "order_limit_fa" => persianNum($product_variant->max_order_count),
                "shipping_type" => [
                    "dk_shipping" => 1,
                    "seller_shipping" => 1,
                ],
                "channels" => [
                    "dk_channel_disabled" => true,
                    "dk_channel_checked" => 1,
                    "dk_channel_active" => true,
                    "ds_channel_disabled" => true,
                    "ds_channel_checked" => 0,
                    "ds_channel_active" => false,
                    "both_channel_disabled" => true,
                    "both_channel_checked" => 0
                ],
            ],
        ];

        $this->updateProductMainDetails($product_variant->product);

        return response()->json($jsonResponse, 200);

    }

    public function variantDelete(Request $request)
    {
        ProductHasVariant::whereId($request->id)
            ->delete();

        $settings = Setting::select('name', 'value')->get();

        $product = Product::findOrFail($request->product_id);
        $this->updateProductMainDetails($product);

    }


    public function stepUploadImages(Request $request)
    {
      $messages = [
        'files.*.mimes' => 'فرمت تصویر غیر مجاز است',
        'files.*.max' => 'حجم عکس بیشتر از مقدار مجاز است',
        'files.*.dimensions' => 'اندازه تصویر مناسب نیست',
      ];

      $validator = Validator::make($request->all(), [
//        'files.*' => 'required|mimes:jpg|max:6144|dimensions:min_width=300,min_height=300,max_width=2500,max_height=2500',
      ], $messages);


      if ($validator->fails()) {
        $error = $validator->errors()->first();
        $data = [
          "status" => true,
          "data" => [
            "errors" => [
              "error" => "$error"
            ],
            "slot" => "$request->slot",
          ]
        ];

        return response()->json($data, 200);

      }
      else
      {

          $image = $request->file('image');
          $destinationPath = public_path('media/products/');
          $file_name = time() . rand(10000, 100000) . "." . $image->getClientOriginalExtension();
          $image->move($destinationPath, $file_name);
          $data[] = $file_name;


          $media = Media::create([
            'name' => $file_name,
            'path' => 'media/products',
            'person_id' => auth()->guard('staff')->user()->id,
            'person_role' => 'staff',
            'status' => 0,
          ]);

          $site_url = Setting::where('name', 'site_url')->first()->value;

          $path = $site_url . '/media/products/' . $file_name;


          $data = [
            "status" => true,
            "data" => [
              "id" => "$media->id",
              "url" => "$path",
              "tempFile" => true,
              "slot" => "$request->slot"
            ]
          ];

          return response()->json($data, 200);

      }
    }

    public function updateProductMainDetails($product){
        $product->increment('sales_count');

        if ($product->variants()->active()->exists()) {
            $product->update(['has_stock' => 1]);
        } else {
            $product->update(['has_stock' => 0]);
        }

        $product->update(['min_price' => product_price($product) ?? 0]);
    }

}
