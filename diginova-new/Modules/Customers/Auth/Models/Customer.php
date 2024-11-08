<?php

namespace Modules\Customers\Auth\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Customers\Front\Models\Cart;
use Modules\Customers\Front\Models\CustomerFavorite;
use Modules\Customers\Front\Models\CustomerHistory;
use Modules\Customers\Panel\Models\CustomerLegal;
use Modules\Staff\Comment\Models\Comment;
use Modules\Staff\Customer\Models\CustomerAddress;
use Modules\Staff\Order\Models\ConsignmentHasProductVariants;
use Modules\Staff\Order\Models\Order;


class Customer extends Authenticatable
{

    use HasFactory;

    protected $fillable = [
      'mobile',
      'email',
      'password',
      'verify_token',
      'first_name',
      'last_name',
      'national_code',
      'birthdate',
      'bank_card_number',
      'job_id',
      'newsletters',
      'return_money_method',
      'address_type',
      'address_id',
      'status',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function legal()
    {
        return $this->hasOne(CustomerLegal::class);
    }

    public function addresses()
    {
      return $this->hasMany(CustomerAddress::class);
    }

    public function state()
    {
      return $this->hasOne(State::class);
    }

    public function orders()
    {
      return $this->hasMany(Order::class);
    }

    public function carts()
    {
      return $this->hasMany(Cart::class);
    }

    public function delivery_address()
    {
      return $this->morphTo('address', 'address_type', 'address_id');
    }

    public function favorites()
    {
      return $this->hasMany(CustomerFavorite::class);
    }

    public function order_variants()
    {
      return $this->hasMany(ConsignmentHasProductVariants::class);
    }

    public function histories()
    {
      return $this->hasMany(CustomerHistory::class);
    }

    public function getDisplayNameAttribute()
    {
      return !is_null($this->first_name)
        ? $this->first_name . ' ' . $this->last_name
        : $this->mobile;
    }

    public function getFullNameAttribute()
    {
      return $this->first_name . ' ' . $this->last_name;
    }
}
