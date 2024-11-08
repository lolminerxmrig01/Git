<?php

namespace Modules\Customers\Front\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Product\Models\ProductHasVariant;

class Cart extends Model
{
  use HasFactory;

  protected $fillable = ['customer_id', 'type', 'count', 'old_sale_price', 'new_sale_price','old_promotion_price','new_promotion_price' , 'product_variant_id'];

  public function product_variant()
  {
    return $this->belongsTo(ProductHasVariant::class,'product_variant_id');
  }

}

