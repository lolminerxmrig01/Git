<?php

namespace Modules\Staff\ProductSwiper\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Category\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class ProductSwiper extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'sort_by',
        'status',
        'position'
    ];

    /**
     * Get the category that owns the ProductSwiper
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The "position" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('position', function (Builder $builder) {
            $builder->orderBy('position','asc');
        });
    }

}

