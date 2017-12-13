<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Medtag extends Model
{
    protected $fillable = ['alias'];
    public $timestamps = false;
}
