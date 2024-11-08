<?php

namespace Modules\Staff\Unit\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\View;
use Modules\Staff\Unit\Models\Unit;
use Modules\Staff\Unit\Models\UnitValue;


class StaffUnitController extends Controller
{

    public function index()
    {
        $units = Unit::all()->sortBy('position');

        return view('staffunit::index', compact('units'));
    }

    public function store(Request $request)
    {

        // delete unit
        if (isset($request->deleted_rows)) {
            foreach ($request->deleted_rows as $deleted_row) {
                Unit::find($deleted_row)->values()->delete();
                Unit::find($deleted_row)->delete();
            }
        }

        // delete value
        if (isset($request->deleted_values)) {
            foreach ($request->deleted_values as $deleted_value) {
                UnitValue::find($deleted_value)->delete();
            }
        }

        // output: array clean position
        $positions = str_replace('item[]=', '', $request->positions);
        $positions = str_replace('&', ',', $positions);
        $positions = explode(',', $positions);
        $positions = array_map(function ($value) {
            return intval($value);
        }, $positions);


        if (!is_null($request->unit_names) && count($request->unit_names)) {
            $i = 0;
            foreach ($request->unit_names as $unit_name) {
                if ($unit_name == null) {
                    $i++;
                    continue;
                } // if is null unit name ignore

                if (($request->unit_types[$i] == 0) || ($request->unit_types[$i] == 1 && !is_null($request->unit_values[$i]))) {
                    if ($positions[$i] == 0) {
                        // اگه جدید بود
                        $created_unit = Unit::create([
                            'name' => $unit_name,
                            'type' => $request->unit_types[$i],
                            'position' => $i,
                        ]);

                        // اگه جدید تک فیلد بود
                        if($request->unit_types[$i] == 0){
                            $i++;
                            continue;
                        }
                        else {
                            foreach (json_decode($request->unit_values[$i]) as $unit_value) {
                                $val = [];
                                $val_position = 0;
                                foreach ($unit_value as $unit_val) {
                                    $val[] = $unit_val;
                                    if (isset($val[0]) && !is_null($unit_val)) {
                                        UnitValue::create([
                                            'value' => $unit_val,
                                            'unit_id' => $created_unit->id,
                                            'position' => $val_position,
                                        ]);
                                        $val_position++;
                                    }
                                }
                            }
                        }
                        $i++;
                    }
                    else {  // اگه سطر جدید نبود
                        if (($request->unit_types[$i] == 0) || ($request->unit_types[$i] == 1 && !is_null($request->unit_values[$i]))) {

                            if (!Unit::find($positions[$i])) {
                                $i++;
                                continue;
                            }

                            Unit::find($positions[$i])->update([
                                'name' => $unit_name,
                                'type' => $request->unit_types[$i],
                                'position' => $i,
                            ]);

                            $unit = Unit::find($positions[$i]);

                            if ($request->unit_types[$i] == 1){
                                $val_position = 0;

                                foreach (json_decode($request->unit_values[$i]) as $unit_value) {
                                    $unit_value = (array)$unit_value;
                                    if (isset($unit_value['id'])) { // جدید نیست
                                        UnitValue::find($unit_value['id'])->update([
                                            'value' => $unit_value['value'],
                                            'unit_id' => $unit->id,
                                            'position' => $val_position,
                                        ]);
                                    } else {  // جدیده
                                        UnitValue::create([
                                            'value' => $unit_value['value'],
                                            'unit_id' => $unit->id,
                                            'position' => $val_position,
                                        ]);
                                    }
                                    $val_position++;
                                }
                            }
                        }
                        $i++;
                    }
                }
            }
        }
    }

    public function delete(Request $request)
    {
        Unit::where('name', $request->unit_name)->delete();
    }

    public function edit(Request $request)
    {
        $units = Unit::where('name', $request->name)->get();
        
        return View::make('staffunit::ajax.edit-modal', compact('units'));
    }
}
