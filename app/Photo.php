<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['medicine_id', 'path'];
    public $timestamps = false;
}
