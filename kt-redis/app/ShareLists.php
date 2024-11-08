<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShareLists extends Model
{
    protected $table = "user_lists";
	public $timestamps = false;
}
