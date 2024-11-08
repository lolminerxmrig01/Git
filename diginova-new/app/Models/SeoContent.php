<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoContent extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'keyword', 'description', 'custom_code', 'seoable_type', 'seoable_id'];

    public function seoable() {
        return $this->morphTo();
    }
}
