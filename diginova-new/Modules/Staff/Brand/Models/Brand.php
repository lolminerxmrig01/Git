<?php

namespace Modules\Staff\Brand\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Media;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Product\Models\Product;


class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'en_name',
        'type',
        'category_id',
        'slug',
        'description'
    ];

    public function media()
    {
        return $this->morphToMany(Media::class, 'mediable');
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function getRouteKeyName()
    {
        return 'en_name';
    }

    public function products()
    {
      return $this->hasMany(Product::class, 'brand_id');
    }

}
