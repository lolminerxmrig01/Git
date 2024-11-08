<?php

namespace Modules\Staff\Nav\Http\Controllers;

use Modules\Staff\Setting\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\Staff\Nav\Models\NavGroup;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Nav\Models\Nav;
use Modules\Staff\Nav\Models\NavLocation;
use App\Models\Media;
use Illuminate\Support\Facades\View;

class StaffNavController extends Controller
{

  public function index()
  {
    $nav_locations = NavLocation::paginate(100);
    return view('staffnav::index', compact('nav_locations'));
  }

  public function navs($id)
  {
    $nav_location = NavLocation::find($id);
    $navs = $nav_location->navs()->orderBy('name', 'asc')->paginate(1000000);

    return view('staffnav::navs', compact('navs', 'nav_location'));
  }

  public function UploadImage(Request $request)
  {
    $imageExtension = $request->image->extension();

    $input['image'] = time() . '.' . $imageExtension;
    $request->image->move(public_path('media/navs'), $input['image']);

    $media = Media::create([
      'name' => $input['image'],
      'path' => 'media/navs',
      'person_id' => auth()->guard('staff')->user()->id,
      'person_role' => 'staff' ,
    ]);

    $settings = Setting::select('name', 'value')->get();
    $site_url = $settings->where('name', 'site_url')->first()->value;

    return response()->json([
      'status' => true,
      'data' => [
        'id' => "$media->id",
        'url' => "$site_url/$media->path/$media->name",
        'tempFile' => true,
        'slot' => null,
      ]
    ]);
  }

  public function storeNav(Request $request)
  {

    $messages = [
      'unique' => 'نام فهرست تکراری است',
    ];

    $validator = Validator::make($request->all(), [
      'nav_name' => 'required',
      'nav_link' => 'nullable|string',
      'nav_type' => 'required',
      'uploaded_icon_id' => 'nullable',
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

    if ((Nav::max('position')) || (Nav::max('position') == 0)) {
      $position = Nav::max('position') + 1;
    } else {
      $position = 0;
    }

    $created_nav = Nav::create([
      'name' => $request->nav_name,
      'link' => $request->nav_link,
      'type' => $request->nav_type,
      'position' => $position,
      'location_id' => $request->location_id,
    ]);

    if (!is_null($request->uploaded_icon_id))
    {
      $media = Media::find($request->uploaded_icon_id);
      $created_nav->media()->sync($media);
    }

    return response()->json([
      'status' => true,
      'data' => true,
    ]);

  }

  public function statusNav(Request $request)
  {
    Nav::where('id',$request->nav_id)->update([
      'status' => $request->status,
    ]);
  }

  public function navChangePosition(Request $request)
  {
    foreach ($request->item as $postion => $id) {
      Nav::where('id', $id)->update([
        'position' => $postion,
      ]);
    }
  }

  public function reloadNavsTable(Request $request)
  {
    $navs = Nav::where('location_id', $request->location_id)->paginate(10000);
    return View::make('staffnav::ajax.reload-nav-table', compact('navs'));
  }

  public function deleteNav(Request $request)
  {
    Nav::find($request->id)->delete();

    $navs = Nav::where('location_id', $request->nav_location)->paginate(10000);
    return View::make('staffnav::ajax.reload-nav-table', compact('navs'));
  }

  public function navItems($id)
  {
    $nav = Nav::find($id);
    $items = Nav::where('parent_id', $id)->paginate(100000);
    return view('staffnav::navItems', compact('items', 'nav'));
  }

  public function updateNav(Request $request)
  {

    $messages = [
      'unique' => 'نام فهرست تکراری است',
      'required' => 'وارد کردن نام فهرست ضروری است',
    ];

    $validator = Validator::make($request->all(), [
      'nav_name' => 'required',
      'nav_link' => 'nullable|string',
      'uploaded_icon_id' => 'nullable',
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

    $nav = Nav::findOrFail($request->nav_id);

    $nav->update([
      'name' => $request->nav_name,
      'link' => $request->nav_link,
    ]);

    if (filled($request->uploaded_icon_id))
    {
      $media = Media::findOrFail($request->uploaded_icon_id);
      $nav->media()->sync($media);
    }

    return response()->json([
      'status' => true,
      'data' => true,
    ]);

  }

  public function storeMegaMenu(Request $request)
  {

    $messages = [
      'required' => 'وارد کردن نام مگا‌منو اجباری است.',
    ];

    $validator = Validator::make($request->all(), [
      'megamenu_name' => 'required',
      'megamenu_link' => 'nullable|string',
      'uploaded_icon_id' => 'nullable',
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

    if ((Nav::max('position')) || (Nav::max('position') == 0)) {
      $position = Nav::max('position') + 1;
    } else {
      $position = 0;
    }

    $created_nav = Nav::create([
      'name' => $request->megamenu_name,
      'link' => $request->nav_link,
      'type' => 'megamenu',
      'position' => $position,
      'location_id' => $request->location_id,
      'parent_id' => $request->nav_id,
    ]);

    if (!is_null($request->uploaded_icon_id))
    {
      $media = Media::find($request->uploaded_icon_id);
      $created_nav->media()->attach($media);
    }

    return response()->json([
      'status' => true,
      'data' => true,
    ]);

  }

  public function reloadMegamenuTable(Request $request)
  {
    $nav = Nav::find($request->nav_id);
    $items = Nav::where('parent_id', $request->nav_id)->paginate(10000);

    return View::make('staffnav::ajax.reload-megamenu-table', compact('items', 'nav'));
  }

  public function deleteItem(Request $request)
  {
    Nav::find($request->id)->delete();

    $nav = Nav::find($request->nav_id);
    $items = Nav::where('parent_id', $request->nav_id)->paginate(10000);

    return View::make('staffnav::ajax.reload-megamenu-table', compact('items', 'nav'));
  }

  public function storeMenus(Request $request)
  {

    // delete nav
    if (isset($request->deleted_rows) && (!is_null($request->deleted_rows))) {
      foreach ($request->deleted_rows as $deleted_row) {
        Nav::find($deleted_row)->delete();
      }
    }

    // output: array clean position
    $positions = str_replace('item[]=', '', $request->positions);
    $positions = str_replace('&', ',', $positions);
    $positions = explode(',', $positions);
    $positions = array_map(function ($value) {
      return intval($value);
    }, $positions);

    if (count($request->menu_names)) {

      $i = 0;
      foreach ($request->menu_names as $menu_name) {

        if ($menu_name == null) {
          $i++;
          continue;
        }

        Nav::updateOrCreate(['id' => $positions[$i]], [
          'name' => $request->menu_names[$i],
          'link' => $request->menu_links[$i],
          'style' => ($request->menu_styles[$i] !== '') ? $request->menu_styles[$i] : null,
          'position' => $i,
          'type' => 'menu',
          'parent_id' => $request->parent_id,
        ]);

        $i++;
      }

    }

    return response()->json([
      'status' => true,
      'data' => true,
    ]);

  }

  public function deleteIcon(Request $request)
  {
    $nav = Nav::find($request->nav_id);
    $media_id = $nav->media()->first()->id;

    $media = Media::find($media_id);
    $user_id = auth()->guard('staff')->user()->id;


    $nav->media()->detach();

    if (($media) && ($media->person_role == 'staff') && ($media->person_id == $user_id)) {
      unlink(public_path("$media->path/") . $media->name);
      $media->delete();
    }



    return response()->json([
      'status' => true,
      'data' => true,
    ]);
  }

  public function megamenuItems($id)
  {
    $nav = Nav::find($id);
    $items = Nav::where('parent_id', $id)->paginate(100000);
    return view('staffnav::megamenuItems', compact('items', 'nav'));
  }

}
