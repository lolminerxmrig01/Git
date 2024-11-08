<?php

namespace Modules\Staff\Variant\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Modules\Staff\Variant\Models\Variant;
use Modules\Staff\Variant\Models\VariantValue;
use Modules\Staff\Category\Models\Category;
use Illuminate\Support\Facades\Validator;
use Modules\Staff\Variant\Models\VariantGroup;
use Modules\Staff\Unit\Models\Unit;


class StaffVariantController extends Controller
{
    public function index()
    {
        $variant_groups = VariantGroup::paginate(10)
            ->sortBy('position');

        return view('staffvariant::index',
            compact('variant_groups')
        );
    }

    public function edit($id)
    {
        $variantGroup = VariantGroup::where('id', $id)
            ->firstOrFail();

        if (Variant::where('group_id', $id)->count()) {
            $variants = Variant::where('group_id', $id)
                ->orderBy('position')
                ->get();
        } else {
            $variants = collect();
        }

        return view('staffvariant::edit', compact('variantGroup', 'variants'));
    }

    public function getData(Request $request)
    {
        $variant_groups = VariantGroup::paginate(10)
            ->sortBy('position');

        return view('staffvariant::ajax-content',
            compact('variant_groups'));
    }

    public function storeGroup(Request $request)
    {
        $messages = [
            'unique' => 'نام وارد شده تکراری است',
            'required' => 'وارد کردن نام اجباری است',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:variant_groups',
            'type' => 'required',
            'description' => 'nullable|string',
        ], $messages);


        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            if ((VariantGroup::max('position')) || (VariantGroup::max('position') == 0)) {
                $position = VariantGroup::max('position') + 1;
            } else {
                $position = 0;
            }

            VariantGroup::create([
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                'position' => $position,
                'status' => 1,
            ]);

            $variant_groups = VariantGroup::paginate(10)
                ->sortBy('position');

            return view('staffvariant::ajax-content',
                compact('variant_groups'));
        }
    }

    public function indexChangePosition(Request $request)
    {
        foreach ($request->item as $postion => $id) {
            VariantGroup::where('id', $id)->update([
                'position' => $postion,
            ]);
        }
    }

    public function deleteGroup(Request $request)
    {
        VariantGroup::whereId($request->id)
            ->delete();
    }

    public function statusGroup(Request $request)
    {
        VariantGroup::whereId($request->group_id)->update([
            'status' => $request->status,
        ]);
    }

    public function store(Request $request)
    {

        // update variant group
        if (!is_null($request->group_name)) {
            VariantGroup::where('id', $request->group_id)->update([
                'name' => $request->group_name,
                'description' => $request->group_desc,
            ]);
        }

        // delete variant
        if (isset($request->deleted_rows) && (!is_null($request->deleted_rows))) {
            foreach ($request->deleted_rows as $deleted_row) {
                Variant::whereId($deleted_row)->delete();
            }
        }

        // output: array clean position
        $positions = str_replace('item[]=', '', $request->positions);
        $positions = str_replace('&', ',', $positions);
        $positions = explode(',', $positions);
        $positions = array_map(function ($value) {
            return intval($value);
        }, $positions);

        if (isset($request->variant_names) && count($request->variant_names)) {
            $i = 0;
            foreach ($request->variant_names as $variant_name) {
                if ($variant_name == null) {
                    $i++;
                    continue;
                }

                // اگه جدید بود
                if (VariantGroup::find($request->group_id)->type == 1) {
                    $value = null;
                } elseif (VariantGroup::find($request->group_id)->type == 2) {
                    $value = $request->variant_values[$i];
                    if (!str_starts_with($value, '#')) {
                        $value = '#' . $value;
                    }
                } else {
                    $value = null;
                }

                if (!is_null($positions) && $positions[$i] == 0) {
                    Variant::create([
                        'name' => $variant_name,
                        'value' => $value,
                        'status' => $request->variant_status[$i],
                        'position' => $i,
                        'group_id' => $request->group_id,
                    ]);
                } else {  // اگه سطر جدید نبود
                    if (!Variant::find($positions[$i])) {
                        $i++;
                        continue;
                    }

                    Variant::find($positions[$i])->update([
                        'name' => $variant_name,
                        'value' => $value,
                        'status' => $request->variant_status[$i],
                        'position' => $i,
                        'group_id' => $request->group_id,
                    ]);
                }
                $i++;
            }
        }
    }

    public function variantCategory()
    {
        $categories = Category::all();

        return view('staffvariant::variant-category',
            compact('categories')
        );
    }

    public function loadCategoryVariant(Request $request)
    {
        $category = Category::findOrFail($request->category_id);
        $variantGroups = VariantGroup::all();

        if (! count($variantGroups)) {
            $variantGroups = [];
        }

        return View::make('staffvariant::ajax-config-content',
            compact('category', 'variantGroups'));
    }

    public function saveConfig(Request $request)
    {
        $category = Category::find($request->category_id);
        $variantGroup = VariantGroup::find($request->variant_g_id);
        $category->variantGroup()->sync($variantGroup);
    }
}
