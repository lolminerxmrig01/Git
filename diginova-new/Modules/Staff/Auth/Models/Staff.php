<?php

namespace Modules\Staff\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Staff extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'remember_token'];
}
