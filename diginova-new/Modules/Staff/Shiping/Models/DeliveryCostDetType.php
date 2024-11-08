<?php

namespace Modules\Staff\Shiping\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Product\Models\ProductWeight;

class DeliveryCostDetType extends Model
{

    use HasFactory;

    protected $fillable = ['name', 'status'];


    public function weights()
    {
      return $this->morphToMany(ProductWeight::class, 'weightable', 'weightables', 'weightable_id', 'wheight_id');
    }

    public function deliveryMethod()
    {
      return $this->hasMany(DeliveryMethod::class);
    }

}
