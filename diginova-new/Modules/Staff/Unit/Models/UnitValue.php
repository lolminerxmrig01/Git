<?php

namespace Modules\Staff\Unit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Category\Models\Category;


class UnitValue extends Model
{
    use HasFactory;

    protected $fillable = ['unit_id','value', 'position'];

    protected $table = 'unit_values';

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
