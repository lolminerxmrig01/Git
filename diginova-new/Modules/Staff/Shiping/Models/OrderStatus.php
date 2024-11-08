<?php

namespace Modules\Staff\Shiping\Models;

use App\Models\Media;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Product\Models\ProductWeight;
use Modules\Staff\Shiping\Models\DeliveryMethodValue;

class OrderStatus extends Model
{

    use HasFactory;

    protected $fillable = ['name', 'en_name'];

    protected $table = 'order_status';

    public function scopeAwaiting($query)
    {
        return $query->where('en_name', 'awaiting_payment');
    }
}
