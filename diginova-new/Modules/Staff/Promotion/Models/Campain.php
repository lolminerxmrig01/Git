<?php

namespace Modules\Staff\Promotion\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Media;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Landing\Models\Landing;
use Modules\Staff\Product\Models\Product;
use Modules\Staff\Product\Models\ProductHasVariant;


class Campain extends Model
{
    protected $fillable = [
        'name',
        'min_percent',
        'start_at',
        'end_at',
        'type',
        'status'
    ];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_variant_id');
    }

    public function category()
    {
        return $this->morphTo(ProductHasVariant::class);
    }

    public function landing()
    {
        return $this->hasOne(Landing::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
}
