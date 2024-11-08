<?php

namespace Modules\Staff\Customer\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
      'lan',
      'len',
      'address',
      'plaque',
      'unit',
      'postal_code',
      'is_recipient_self',
      'recipient_firstname',
      'recipient_lastname',
      'recipient_national_code',
      'recipient_mobile',
      'is_main',
      'customer_id',
      'state_id'
    ];

    public function state()
    {
      return $this->belongsTo(State::class);
    }

}
