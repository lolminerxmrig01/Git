<?php

namespace Modules\Staff\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Customers\Auth\Models\Customer;
use Modules\Staff\Product\Models\Product;
use Modules\Staff\Product\Models\ProductHasVariant;
use Modules\Staff\Shiping\Models\OrderStatus;


class ConsignmentHasProductVariants extends Model
{
    use HasFactory;

    protected $fillable = [
      'count',
      'variant_price',
      'promotion_price',
      'promotion_percent',
      'product_id',
      'product_variant_id',
      'consignment_id',
      'order_id',
      'promotion_type',
      'order_status_id',
      'customer_id'
    ];

    public function consignment()
    {
      return $this->belongsTo(OrderHasConsignment::class, 'consignment_id');
    }

    public function status()
    {
      return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function product_variant()
    {
      return $this->belongsTo(ProductHasVariant::class, 'product_variant_id');
    }

    public function product()
    {
      return $this->belongsTo(Product::class, 'product_id');
    }

    public function customer()
    {
      return $this->belongsTo(Customer::class, 'customer_id');
    }

}
