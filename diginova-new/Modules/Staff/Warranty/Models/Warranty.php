<?php

namespace Modules\Staff\Warranty\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Media;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Product\Models\Product;
use Modules\Staff\Product\Models\ProductHasVariant;


class  Warranty extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'warranties';
    
    protected $fillable = ['name', 'month', 'has_insurance'];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function product_variants()
    {
      return $this->hasMany(ProductHasVariant::class, 'warranty_id');
    }
}
