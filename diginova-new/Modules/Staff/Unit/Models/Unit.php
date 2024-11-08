<?php

namespace Modules\Staff\Unit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Attribute\Models\Attribute;


class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'value', 'position'];

    public function values()
    {
        return $this->hasMany(UnitValue::class)
            ->select('id', 'value', 'unit_id');
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'unit_id');
    }
}
