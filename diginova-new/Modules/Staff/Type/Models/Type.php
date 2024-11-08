<?php

namespace Modules\Staff\Type\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Product\Models\Product;


class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'position'];

    public function categories()
    {
        return $this->morphedByMany(Category::class, 'typable');
    }


    /**
     * The products that belong to the types.
     */
    public function types()
    {
        return $this->belongsToMany(Product::class, 'product_type');
    }
}

