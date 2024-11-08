<?php

namespace Modules\Staff\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Shiping\Models\DeliveryMethod;


class ProductWeight extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function deliveryMethods()
    {
      return $this->morphedByMany(DeliveryMethod::class, 'weightable', 'weightables', 'wheight_id', 'weightable_id');
    }

}

