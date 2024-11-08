<?php

namespace Modules\Staff\Attribute\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Product\Models\Product;
use Modules\Staff\Attribute\Models\ProductAttributes;
use Modules\Staff\Unit\Models\Unit;


class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'type', 
        'is_required', 
        'is_filterable', 
        'is_favorite', 
        'group_id', 
        'unit_id', 
        'position'
    ];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function values()
    {
      return $this->hasMany(AttributeValue::class)->select('id', 'value');
     }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}

