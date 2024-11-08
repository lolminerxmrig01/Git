<?php

namespace Modules\Staff\Variant\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Category\Models\Category;


class VariantGroup extends Model
{
    protected $fillable = ['name', 'description', 'type', 'status', 'position'];

    public function variants()
    {
        return $this->hasMany(Variant::class, 'group_id');
    }

    public function categories()
    {
        return $this->morphTo(Category::class, 'categorizable');
    }
}
