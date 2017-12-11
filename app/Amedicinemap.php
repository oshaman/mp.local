<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Amedicinemap extends Model
{
    public $timestamps = false;

    protected $table = 'amedicinemapsview';

    public function image()
    {
        return $this->hasMany('Fresh\Medpravda\Aimage', 'amedicine_id', 'id');
    }
}
