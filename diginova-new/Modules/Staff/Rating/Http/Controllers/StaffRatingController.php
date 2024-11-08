<?php

namespace Modules\Staff\Rating\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\View;
use Modules\Staff\Rating\Http\Requests\StaffRatingRequest;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Rating\Models\Rating;


class StaffRatingController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('staffrating::index', compact('categories'));
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
        if(!is_null($request->type_fields))
        {
            $new_data_array = array_filter($request->type_fields);

            foreach ($new_data_array as $key => $rating)
            {
                $insert_rating = Rating::create([
                    'name' => $rating,
                    'position' => array_search($key, $positionArray),
                ]);

                $category = Category::find($request->category);
                $category->ratings()->save($insert_rating);
            }
        }

        if (isset($request->database_data) && !is_null($request->database_data)) {
            return $this->update($request);
        }
    }

    public function update($request)
    {
        if (isset($request->database_data) && !is_null($request->database_data)){

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
                    Category::find($request->category)->ratings()->where('id', $key)->delete();
                }
                elseif (!is_null($value)){
                    Rating::find($key)->update([
                        'name' => $value,
                        'position' => array_search($key, $positionArray),
                    ]);
                } else {
                    Category::find($request->category)->ratings()->where('id', $key)->delete();
                }
            }
        }
    }

    public function childCatsLoader(Request $request)
    {
        $categories = Category::get()->unique('name');
        $id = $request->id;
        // حل مشکل ستون های خالی
        if (count(Category::where('parent_id', $id)->get()) !== 0)
        {
            return View::make("staffrating::layouts.ajax.category-box.child", compact('id', 'categories'));
        }
    }

    public function breadcrumbLoader(Request $request)
    {
        $category = Category::find($request->id);
        return View::make("staffrating::layouts.ajax.category-box.breadcrumb", compact('category'));
    }

    public function mainCatReloader(Request $request)
    {
        $categories = Category::get()->unique('name');
        return View::make("staffrating::layouts.ajax.category-box.main", compact('categories'));
    }

    public function ajaxSearch(Request $request)
    {
        $categories = Category::query()->where('name', 'LIKE', "%{$request->search}%")->get();
        if($categories)
        {
            return View::make("staffrating::layouts.ajax.category-box.search", compact('categories'));
        }
    }

    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->category_id);
        if ($category->ratings())
        {
            return View::make('staffrating::ajax-content', compact('category'));
        } else {
            return response()->json('saved data not found', 200);
        }
    }
}
