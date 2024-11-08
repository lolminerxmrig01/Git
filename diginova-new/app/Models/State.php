<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Customers\Auth\Models\Customer;
use Modules\Customers\Panel\Models\CustomerLegal;

class State extends Model
{
    use HasFactory;

    public function childs()
    {
      return $this->hasMany(self::class,'state_id', 'id');
    }

    public function parent()
    {
      return $this->belongsTo(self::class, 'state_id');
    }

}
