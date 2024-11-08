<?php

namespace Modules\Staff\Type\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Modules\Staff\Type\Http\Requests\StaffTypeRequest;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Type\Models\Type;


class StaffTypeController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('stafftype::index', compact('categories'));
    }

    public function store(Request $request)
    {
        $positionArray = str_replace('item[]=', '', $request->sort_data);
        $positionArray = str_replace('&', ',', $positionArray);
        $positionArray = explode(',', $positionArray);
        // تبدیل آرایه ای از اعداد با فرمت رشته به آرایه عددی
        $positionArray = array_map(function($value) {
            return intval($value);
        }, $positionArray);

        // فیلد جدید داشتیم
        if(! is_null($request->type_fields))
        {
            $new_data_array = array_filter($request->type_fields);

            foreach ($new_data_array as $key => $type)
            {
                $insert_type = Type::create([
                    'name' => $type,
                    'position' => array_search($key, $positionArray),
                ]);

                $category = Category::find($request->category);

                $category->types()
                    ->save($insert_type);
            }
        }

        if (filled($request->database_data)) {
            return $this->update($request);
        }
    }

    public function update($request)
    {
        if (filled($request->database_data))
        {
            $positionArray = str_replace('item[]=', '', $request->sort_data);
            $positionArray = str_replace('&', ',', $positionArray);
            $positionArray = explode(',', $positionArray);
            // تبدیل آرایه ای از اعداد با فرمت رشته به آرایه عددی
            $positionArray = array_map(function($value) {
                return intval($value);
            }, $positionArray);

            $data = array_filter($request->database_data);
            
            foreach ($data as $key => $value)
            {
                if ($value == 'deleted'){
                    Category::find($request->category)
                        ->types()
                        ->where('id', $key)
                        ->delete();

                    DB::table('categorizables')
                        ->where('categorizable_type', 'Type')
                        ->where('categorizable_id', $request->category)
                        ->delete();
                }
                elseif (!is_null($value)){
                    Type::find($key)->update([
                        'name' => $value,
                        'position' => array_search($key, $positionArray),
                    ]);
                } else {
                    Category::find($request->category)
                        ->types()->where('id', $key)
                        ->delete();
                }
            }
        }
    }

    public function childCatsLoader(Request $request)
    {
        $categories = Category::get()->unique('name');
        $id = $request->id;
        // حل مشکل ستون های خالی
        if (Category::where('parent_id', $id)->count() !== 0)
        {
            return View::make("stafftype::layouts.ajax.category-box.child", 
                compact('id', 'categories'));
        }
    }

    public function breadcrumbLoader(Request $request)
    {
        $category = Category::find($request->id);

        return View::make("stafftype::layouts.ajax.category-box.breadcrumb",
            compact('category'));
    }

    public function mainCatReloader(Request $request)
    {
        $categories = Category::get();

        return View::make("stafftype::layouts.ajax.category-box.main",
         compact('categories'));
    }

    public function ajaxSearch(Request $request)
    {
        $categories = Category::query()
            ->where('name', 'LIKE', "%{$request->search}%")
            ->get();

        if($categories)
        {
            return View::make("stafftype::layouts.ajax.category-box.search",
             compact('categories'));
        }
    }

    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->category_id);

        if ($category->types())
        {
            return View::make('stafftype::ajax-content', 
                compact('category'));
        } 

        return response()->json('saved data not found', 200);
    }
}
