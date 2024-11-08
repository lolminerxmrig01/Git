<?php

namespace Modules\Staff\Shiping\Models;

use App\Models\Media;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Product\Models\ProductWeight;
use Modules\Staff\Shiping\Models\DeliveryMethodValue;

class DeliveryMethod extends Model
{

    use HasFactory;

    protected $fillable = [
      'name',
      'status',
      'free_shipping_min_cost',
      'cost_det_type_id',
      'delivery_cost'
    ];


    public function media()
    {
      return $this->morphToMany(Media::class, 'mediable');
    }

    public function weights()
    {
      return $this->morphToMany(ProductWeight::class, 'weightable', 'weightables', 'weightable_id', 'wheight_id');
    }

    public function deliveryCostDetType()
    {
      return $this->belongsTo(DeliveryCostDetType::class, 'cost_det_type_id');
    }

    public function values()
    {
        return $this->hasMany(DeliveryMethodValue::class, 'delivery_method_id');
    }

    public function states()
    {
      return $this->morphToMany(State::class, 'zonable', 'zonables', 'zonable_id', 'zone_id');
    }

}
