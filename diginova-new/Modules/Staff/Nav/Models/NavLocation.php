<?php

namespace Modules\Staff\Nav\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Category\Models\Category;


class NavLocation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'for_slug', 'category_id'];


    public function navs()
    {
      return $this->hasMany(Nav::class, 'location_id', 'id');
    }

}
