<?php

namespace Modules\Staff\Comment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Media;
use Modules\Customers\Auth\Models\Customer;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Product\Models\Product;
use Modules\Staff\Comment\Models\CommentHasRating;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'parent_id',
        'text',
        'title',
        'advantages',
        'disadvantages',
        'is_anonymous',
        'recommend_status',
        'publish_status',
        'product_id',
        'customer_id'
    ];

    public function media()
    {
        return $this->morphToMany(Media::class, 'mediable');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function feedback()
    {
      return $this->hasOne(CommentFeedback::class, 'comment_id');
    }

    public function ratings()
    {
        return $this->hasMany(CommentHasRating::class, 'comment_id');
    }

    public function scopeAccepted($query) {
        return $query->where('publish_status', 'accepted');
    }
}
