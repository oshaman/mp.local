<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = ['alias', 'name', 'uname'];
}
