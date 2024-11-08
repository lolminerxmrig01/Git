<?php

namespace Modules\Staff\ProductSwiper\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\ProductSwiper\Models\ProductSwiper;

class StaffProductSwiperController extends Controller
{

    public function index()
    {
        $categories = Category::select('id', 'name')->get();
        $productSwipers = ProductSwiper::get();

        return view('staffProductSwiper::index',
          compact('productSwipers', 'categories'));
    }

    public function deleteProductSwipers($request)
    {
        if (filled($request->deleted_rows))
            foreach ($request->deleted_rows as $deleted_row) {
                ProductSwiper::whereId($deleted_row)->delete();
            }
    }


    public function update(Request $request)
    {

        $this->deleteProductSwipers($request);

        // output: array clean position
        $positions = str_replace('item[]=', '', $request->positions);
        $positions = str_replace('&', ',', $positions);
        $positions = explode(',', $positions);
        $positions = array_map(function ($value) {
            return intval($value);
        }, $positions);


        if (! filled($request->titles))
            return null;

        $i = 0;
        foreach ($request->titles as $title) {
            if ($title == null) {
              $i++;
              continue;
            }

            ProductSwiper::updateOrCreate(['id' => $positions[$i]],[
              'title' => $title,
              'description' => $request->desciptions[$i],
              'category_id' => $request->category_ids[$i],
              'sort_by' => $request->sort_by[$i],
              'status' => $request->status[$i],
              'position' => $i,
            ]);

            $i++;
        }

    }

}
