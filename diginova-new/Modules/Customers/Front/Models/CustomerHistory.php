<?php

namespace Modules\Customers\Front\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Customers\Auth\Models\Customer;
use Modules\Customers\Panel\Models\CustomerLegal;
use Modules\Staff\Comment\Models\Comment;
use Modules\Staff\Customer\Models\CustomerAddress;
use Modules\Staff\Product\Models\Product;


class CustomerHistory extends Authenticatable
{

    use HasFactory;

    protected $fillable = [
      'customer_id',
      'product_id',
    ];

    public function customer()
    {
      return $this->belongsTo(Customer::class);
    }

    public function product()
    {
      return $this->belongsTo(Product::class);
    }

}
