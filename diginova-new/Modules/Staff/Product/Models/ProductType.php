<?php

namespace Modules\Staff\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductType extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'type_id'];

    protected $table = 'product_type';
}

