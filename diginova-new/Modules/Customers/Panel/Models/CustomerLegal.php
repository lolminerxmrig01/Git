<?php

namespace Modules\Customers\Panel\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Panel\User as Panelenticatable;
use Modules\Customers\Auth\Models\Customer;
use Modules\Staff\Comment\Models\Comment;


class CustomerLegal extends Model
{

    use HasFactory;

    protected $table = 'customer_legal';

    protected $fillable = [
        'company_name',
        'economic_number',
        'nationalـidentity',
        'registration_number',
        'phone',
        'city_id',
        'customer_id',
    ];

    public function city()
    {
      return $this->belongsTo(State::class, 'city_id');
    }

}
