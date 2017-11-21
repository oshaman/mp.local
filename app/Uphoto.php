<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Uphoto extends Model
{
    protected $fillable = ['umedicine_id', 'path'];
    public $timestamps = false;
}
