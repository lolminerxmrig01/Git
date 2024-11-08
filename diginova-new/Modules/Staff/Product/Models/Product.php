<?php

namespace Modules\Staff\Product\Models;

use App\Models\SeoContent;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Modules\Customers\Front\Models\CustomerFavorite;
use Modules\Staff\Attribute\Models\Attribute;
use Modules\Staff\Attribute\Models\AttributeGroup;
use Modules\Staff\Attribute\Models\AttributeProduct;
use Modules\Staff\Attribute\Models\ProductAttributes;
use Modules\Staff\Brand\Models\Brand;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Comment\Models\Comment;
use Modules\Staff\Comment\Models\CommentHasRating;
use Modules\Staff\Type\Models\Type;
use App\Models\Media;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $fillable = [
      'status',
      'title_fa',
      'title_en',
      'nature',
      'advantages',
      'disadvantages',
      'brand_id',
      'model',
      'is_iranian',
      'length',
      'width',
      'height',
      'weight',
      'description',
      'product_code',
      'slug',
      'has_stock',
      'sales_count',
      'min_price',
    ];

    protected $casts = [
        'advantages' => 'array',
        'disadvantages' => 'array',
    ];

    public function scopeSearch($query, string $searchText)
    {
      $searchColumns = ['title_fa'];
  //      $relationColumns = [];
      return $this->search($query, $searchText, $searchColumns);
    }

    public function scopeDigiSearch($query, $column,  string $searchText)
    {
      $query->where($column, 'like', '%' .$searchText. '%');

      return $query;
    }

    public function getRouteKeyName()
    {
        return 'product_code';
    }

    public function category()
    {
      return $this->morphToMany(Category::class, 'categorizable');
    }

    public function media()
    {
        return $this->morphToMany(Media::class, 'mediable', 'mediables')->withPivot('is_main');
    }

    public function brand()
    {
      return $this->belongsTo(Brand::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    /**
     * The types that belong to the products.
     */
    public function type()
    {
        return $this->belongsToMany(Type::class, 'product_type');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product')
            ->withPivot('value_id', 'value', 'unit_id', 'unit_value_id');
    }

    public function seo()
    {
        return $this->morphOne(SeoContent::class, 'seoable');
    }

    public function variants(){
        return $this->hasMany(ProductHasVariant::class)->orderBy('stock_count', 'desc');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorite()
    {
      return $this->hasOne(CustomerFavorite::class);
    }

    public function ratings()
    {
      return $this->hasMany(CommentHasRating::class);
    }

    public function weight()
    {
      return $this->morphToMany(ProductWeight::class, 'weightable', 'weightables', 'weightable_id', 'wheight_id');
    }
}
