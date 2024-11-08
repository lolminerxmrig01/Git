<?php

namespace Modules\Staff\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Variant\Models\Variant;
use Modules\Staff\Landing\Models\Landing;
use Modules\Staff\Warranty\Models\Warranty;
use Modules\Staff\Promotion\Models\Campain;
use Modules\Staff\Promotion\Models\Promotion;
use Illuminate\Database\Eloquent\Relations\Relation;


class ProductHasVariant extends Model
{
    protected $fillable = [
      'product_id',
      'variant_id',
      'warranty_id',
      'shipping_type',
      'status',
      'post_time',
      'buy_price',
      'sale_price',
      'sale_count',
      'max_order_count',
      'stock_count',
      'variantable_type',
      'variantable_id',
      'variant_code',
    ];

    public function warranty(){
        return $this->belongsTo(Warranty::class);
    }

    public function variant(){
        return $this->belongsTo(Variant::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function categories()
    {
        return $this->hasManyThrough(ProductHasVariant::class, Product::class)
            ->where('categorizable_type', array_search(static::class, Relation::morphMap()) ?: static::class);
    }

    public function campains()
    {
        return $this->morphedByMany(Campain::class, 'variantable', 'product_variantables', 'product_variant_id', 'variantable_id');
    }

    public function landings()
    {
        return $this->morphedByMany(Landing::class, 'variantable', 'product_variantables', 'product_variant_id', 'variantable_id');
    }

    public function promotions()
    {
        return $this->morphedByMany(Promotion::class, 'variantable', 'product_variantables', 'product_variant_id', 'variantable_id');
    }


    public function scopeActive($query)
    {
        return $query->whereStatus(1)->where('stock_count', '>', 0);
    }
}
