<?php

namespace Modules\Staff\Voucher\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Category\Models\Category;


class Voucher extends Model
{

    protected $fillable = [
        'name',
        'status',
        'code',
        'percent',
        'up_to',
        'min_product_price',
        'start_at',
        'end_at',
        'max_usable',
        'type',
        'freeـshipping',
        'platform',
    ];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
}
