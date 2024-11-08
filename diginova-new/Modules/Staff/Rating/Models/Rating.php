<?php

namespace Modules\Staff\Rating\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Product\Models\Product;


class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'position'];

    /**
     * The products that belong to the ratings.
     */
//    public function ratings()
//    {
//        return $this->belongsToMany(Product::class, 'product_type');
//    }
}

