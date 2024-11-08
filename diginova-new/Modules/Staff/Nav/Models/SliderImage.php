<?php

namespace Modules\Staff\Nav\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class NavImage extends Model
{
    use HasFactory;

    protected $fillable = ['alt', 'link', 'nav_id', 'position', 'status'];

    public function nav()
    {
      return $this->belongsTo(Nav::class);
    }

    public function media()
    {
      return $this->morphToMany(Media::class, 'mediable');
    }
}
