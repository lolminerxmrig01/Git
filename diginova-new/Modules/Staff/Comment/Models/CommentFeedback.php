<?php

namespace Modules\Staff\Comment\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Media;
use Modules\Customers\Auth\Models\Customer;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Product\Models\Product;


class CommentFeedback extends Model
{

    protected $table = 'comments_feedbacks';

    protected $fillable = ['status', 'comment_id', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function scopeLike($query)
    {
        return $query->where('status', 'like');
    }

    public function scopeDislike($query)
    {
        return $query->where('status', 'dislike');
    }
}
