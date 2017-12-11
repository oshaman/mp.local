<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Umedicinemap extends Model
{
    public $timestamps = false;

    protected $table = 'umedicinemapsview';

    public function image()
    {
        return $this->hasMany('Fresh\Medpravda\Uimage', 'umedicine_id', 'id');
    }
}
