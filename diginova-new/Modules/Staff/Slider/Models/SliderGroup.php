<?php

namespace Modules\Staff\Slider\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Slider\Models\Slider;


class SliderGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'for_slug', 'category_id'];


    public function sliders()
    {
      return $this->hasMany(Slider::class, 'group_id', 'id');
    }

    public function category()
    {
      return $this->belongsTo(Category::class);
    }

}
