<?php

namespace Modules\Staff\Slider\Http\Controllers;

use App\Models\Media;
use App\Models\Mediable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

use Modules\Staff\Category\Models\Categorizable;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Slider\Models\Slider;
use Modules\Staff\Slider\Models\SliderGroup;
use Modules\Staff\Slider\Models\SliderImage;

class StaffSliderController extends Controller
{

    public function index()
    {
        $slider_groups = SliderGroup::paginate(10);

        return view('staffslider::index', compact('slider_groups'));
    }

    public function sliders($id)
    {
      $slider_group = SliderGroup::find($id);

      $sliders = SliderGroup::find($id)
        ->sliders()
        ->orderBy('name', 'asc')
        ->paginate(10);

      return view('staffslider::sliders', compact('sliders', 'slider_group'));
    }

    public function customUploadImage(Request $request)
    {
        if (filled($request->old_img)) {
          $request->id = $request->old_img;

          \DB::table('mediables')
            ->where('media_id', intval($request->old_img))
            ->delete();


          $this->deleteImage($request);
        }

        $imageExtension = $request->file('image')->extension();

        $input['image'] = time() . '.' . $imageExtension;
        $request->file('image')->move(public_path('media/sliders'), $input['image']);

        $media = Media::create([
          'name' => $input['image'],
          'path' => 'media/sliders',
          'person_id' => auth()->guard('staff')->user()->id,
          'person_role' => 'staff' ,
          'status' => 1
        ]);

        SliderImage::updateOrCreate(['slider_id' => $request->slider_id], [
          'slider_id' => $request->slider_id,
        ]);

        $image = SliderImage::where('slider_id', $request->slider_id)->first();
        $image->media()->attach($media);

        return $media->id;
    }

    public function UploadImage(Request $request)
    {
      if ($request->old_img) {
        $request->id = $request->old_img;
        SliderImage::find($request->row_id)->media()->detach();

        $this->deleteImage($request);
      }

      $imageExtension = $request->file('image')->extension();

      $input['image'] = time() . '.' . $imageExtension;
      $request->file('image')->move(public_path('media/sliders'), $input['image']);

      $media = Media::create([
        'name' => $input['image'],
        'path' => 'media/sliders',
        'person_id' => auth()->guard('staff')->user()->id,
        'person_role' => 'staff' ,
      ]);

      if (!is_null($request->row_id))
      {
        $image = SliderImage::find($request->row_id);
        $image->media()->attach($media);
      } else {
        return $media->id;
      }

    }

    public function deleteImage(Request $request)
      {
          $media = Media::find($request->id);
          unlink(public_path("$media->path/") . $media->name);
          $media->delete();
      }

    public function sliderImages($id)
    {
        $slider_images = Slider::find($id)->images()->paginate(10);
        $slider = Slider::find($id);
        return view('staffslider::sliderImages', compact('slider_images', 'slider'));
    }

    public function updateSlider(Request $request)
    {
        // output: array clean position
        $positions = str_replace('item[]=', '', $request->positions);
        $positions = str_replace('&', ',', $positions);
        $positions = explode(',', $positions);
        $positions = array_map(function ($value) {
          return intval($value);
        }, $positions);

        foreach($positions as $key => $position) {
            Slider::find($position)->update([
              'status' => $request->status[$key],
            ]);

            SliderImage::updateOrCreate(['slider_id' => $position], [
              'alt' => $request->images_alt[$key],
              'link' => $request->slider_links[$key],
              'slider_id' => $position,
            ]);
        }
    }

    public function updateSliderImagesRow(Request $request)
    {
        // delete rows
        if (isset($request->deleted_rows) && count($request->deleted_rows)) {
          foreach ($request->deleted_rows as $deleted_row) {
            $sliderImage = SliderImage::find($deleted_row);
            $sliderImage->forceDelete();
          }
        }

        // output: array clean position
        $positions = str_replace('item[]=', '', $request->positions);
        $positions = str_replace('&', ',', $positions);
        $positions = explode(',', $positions);
        $positions = array_map(function ($value) {
          return intval($value);
        }, $positions);


        if (count($positions)) {
            $i = 0;
            foreach ($positions as $id) {

              if ($id == 0 && is_null($request->media_ids[$i])) {
                  continue;
                  $i++;
              }

              if (SliderImage::find($id)) {
                  SliderImage::where('id', $id)->update([
                    'alt' => $request->images_alt[$i],
                    'link' => $request->slider_links[$i],
                    'position' => $i,
                    'status' => $request->status[$i],
                    'slider_id' => $request->slider_id,
                  ]);
              }
              else {
                  $createdSliderImage = SliderImage::create([
                    'alt' => $request->images_alt[$i],
                    'link' => $request->slider_links[$i],
                    'position' => $i,
                    'status' => $request->status[$i],
                    'slider_id' => $request->slider_id,
                  ]);

                $media = Media::find($request->media_ids[$i]);
                $createdSliderImage->media()->attach($media);
              }

              $i++;


            }
        }

    }

}
