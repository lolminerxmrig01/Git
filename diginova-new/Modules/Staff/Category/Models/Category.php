<?php

namespace Modules\Staff\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Staff\Attribute\Models\AttributeGroup;
use Modules\Staff\Attribute\Models\Attribute;
use Modules\Staff\Brand\Models\Brand;
use Modules\Staff\Product\Models\Product;
use Modules\Staff\Product\Models\ProductHasVariant;
use Modules\Staff\Rating\Models\Rating;
use Modules\Staff\Type\Models\Type;
use App\Models\Media;
use Modules\Staff\Variant\Models\VariantGroup;
use Modules\Staff\Warranty\Models\Warranty;
use App\Traits\Searchable;


class Category extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'en_name',
        'parent_id',
        'slug',
        'description'
    ];

    public function scopeSearch($query, string $searchText)
    {
        $searchColumns = ['name'];

        return $this->search($query, $searchText, $searchColumns);
    }

    public function scopeDigiSearch($query, $column, string $searchText)
    {
        return $query->where($column, 'like', '%' . $searchText . '%');
    }

    public function scopeMain($query)
    {
        return $query->whereParentId(0);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function brands()
    {
        return $this->morphedByMany(Brand::class, 'categorizable');
    }

    public function attributeGroups()
    {
        return $this->morphedByMany(AttributeGroup::class, 'categorizable');
    }

    public function attributes()
    {
        return $this->morphedByMany(Attribute::class, 'categorizable');
    }

    public function types()
    {
        return $this->morphedByMany(Type::class, 'categorizable');
    }

    public function ratings()
    {
        return $this->morphedByMany(Rating::class, 'categorizable');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class,
            'categorizable', 'categorizables', 'category_id', 'categorizable_id');
    }

    public function media()
    {
        return $this->morphToMany(Media::class, 'mediable');
    }

    public function variantGroup()
    {
        return $this->morphedByMany(VariantGroup::class, 'categorizable');
    }

    public function warranties()
    {
        return $this->morphedByMany(Warranty::class, 'categorizable');
    }

    public function product_variants()
    {
        return $this->hasManyThrough(ProductHasVariant::class, Product::class)
            ->where('categorizable_type', array_search(static::class, Relation::morphMap())
                ?: static::class);
    }
}
