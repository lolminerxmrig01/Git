<?php

namespace Modules\Staff\Promotion\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Media;
use Modules\Staff\Product\Models\Product;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Product\Models\ProductHasVariant;


class Promotion extends Model
{
    protected $fillable = [
        'promotion_price',
        'percent',
        'start_at',
        'end_at',
        'promotion_limit',
        'promotion_order_limit',
        'status',
        'campain_id'
    ];

    public function campain() {
      return $this->belongsTo(Campain::class);
    }

    public function scopeActive($query) {
        return $query->whereDate('start_at', '<=', now())
            ->whereDate('end_at', '>=', now())
            ->where('status', 'active')
            ->orWhere('status', 1);
    }

    public function productVariants()
    {
        return $this->morphToMany(ProductHasVariant::class,
         'variantable',
         'product_variantables',
         'variantable_id',
         'product_variant_id');
    }
}
