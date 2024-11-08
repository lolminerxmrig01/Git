<?php

namespace Modules\Staff\Setting\Models;

use App\Models\Media;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    public function states()
    {
      return $this->morphToMany(State::class, 'zonable', 'zonables', null, 'zone_id');
    }

    public function media()
    {
      return $this->morphToMany(Media::class, 'mediable', 'mediables', null, 'media_id');
    }
}
