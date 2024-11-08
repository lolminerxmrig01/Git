<?php

namespace Modules\Staff\Variant\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Product\Models\ProductHasVariant;

class Variant extends Model
{
    protected $fillable = ['name', 'value', 'status', 'position', 'group_id'];

    public function variant_group()
    {
        return $this->belongsTo(VariantGroup::class);
    }

    public function productVariant()
    {
        return $this->hasMany(ProductHasVariant::class);
    }
}
