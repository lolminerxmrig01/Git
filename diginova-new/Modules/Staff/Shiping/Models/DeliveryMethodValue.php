<?php

namespace Modules\Staff\Shiping\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Shiping\Models\DeliveryMethod;

class DeliveryMethodValue extends Model
{

    use HasFactory;

    protected $fillable = [
      'name',
      'status',
      'intra_province',
      'extra_province',
      'neighboring_provinces',
      'delivery_method_id'
    ];

    protected $table = 'delivery_method_values';

    public function deliveryMethods()
    {
      return $this->belongsToMany(DeliveryMethod::class);
    }

}
