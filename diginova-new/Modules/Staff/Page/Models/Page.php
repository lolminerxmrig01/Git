<?php

namespace Modules\Staff\Page\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Media;


class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'text', 'status'];

    public function media()
    {
        return $this->morphToMany(Media::class, 'mediable');
    }
}
