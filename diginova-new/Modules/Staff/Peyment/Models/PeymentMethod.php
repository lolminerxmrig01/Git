<?php

namespace Modules\Staff\Peyment\Models;

use App\Models\Media;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Product\Models\ProductWeight;
use Modules\Staff\Peyment\Models\PeymentMethodValue;

class PeymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'en_name',
      'status',
      'description',
      'username',
      'password',
      'merchantId',
      'terminalId',
      'key',
      'iv',
      'certificate',
      'paymentIdentity',
      'options'
    ];

    public function media()
    {
      return $this->morphToMany(Media::class, 'mediable');
    }

    public function states()
    {
      return $this->morphToMany(State::class, 'zonable', 'zonables', 'zonable_id', 'zone_id');
    }

    public function getRouteKeyName()
    {
      return parent::getRouteKeyName('en_name');
    }

}
