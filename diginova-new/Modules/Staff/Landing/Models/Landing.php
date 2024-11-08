<?php

namespace Modules\Staff\Landing\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Media;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Product\Models\Product;
use Modules\Staff\Product\Models\ProductHasVariant;
use Modules\Staff\Promotion\Models\Campain;


class Landing extends Model
{

    protected $table = 'landings';
    protected $fillable = ['name', 'slug', 'start_at', 'end_at', 'status', 'type', 'campain_id'];

    public function productVariants()
    {
        return $this->morphToMany(ProductHasVariant::class, 'variantable', 'product_variantables', '', 'product_variant_id', 'id', 'id');
    }

    public function campain()
    {
        return $this->belongsTo(Campain::class);
    }

}
