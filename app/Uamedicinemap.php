<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Uamedicinemap extends Model
{
    public $timestamps = false;

    protected $table = 'uamedicinemapsview';

    public function image()
    {
        return $this->hasMany('Fresh\Medpravda\Uaimage', 'uamedicine_id', 'id');
    }
}
