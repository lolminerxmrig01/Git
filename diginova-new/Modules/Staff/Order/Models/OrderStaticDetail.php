<?php

namespace Modules\Staff\Order\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Modules\Customers\Auth\Models\Customer;


class OrderStaticDetail extends Model
{

    protected $fillable = [
      'product_title_fa',
      'variant_name',
      'warranty_name',
      'seller',
      'consignment_product_variant_id',
    ];

    public function customer()
    {
      return $this->belongsTo(Customer::class);
    }

}
