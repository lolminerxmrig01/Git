<?php

namespace Modules\Staff\Slider\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SliderImage extends Model
{
    use HasFactory;

    protected $fillable = ['alt', 'link', 'slider_id', 'position', 'status'];

    public function slider()
    {
      return $this->belongsTo(Slider::class);
    }

    public function media()
    {
      return $this->morphToMany(Media::class, 'mediable');
    }

    public function scopeActive($query)
    {
        return $query->whereStatus('active');
    }
}
