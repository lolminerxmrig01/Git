<?php

namespace Modules\Staff\Order\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Customers\Auth\Models\Customer;
use Modules\Staff\Peyment\Models\PeymentRecord;
use Modules\Staff\Shiping\Models\DeliveryStatus;
use Modules\Staff\Shiping\Models\OrderStatus;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
      'order_code',
      'order_status_id',
      'customer_id', 
      'description', 
      'cost', 
      'discount'
    ];

    public function customer()
    {
      return $this->belongsTo(Customer::class);
    }

    public function consignments()
    {
      return $this->hasMany(OrderHasConsignment::class, 'order_id');
    }

    public function consignment_variants()
    {
      return $this->hasMany(ConsignmentHasProductVariants::class, 'order_id');
    }

    public function status()
    {
      return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function address()
    {
      return $this->hasOne(OrderAddress::class);
    }

    public function peyment_records()
    {
      return $this->hasMany(PeymentRecord::class);
    }

}
