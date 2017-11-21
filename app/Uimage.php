<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Uimage extends Model
{
    protected $fillable = ['title', 'path', 'alt', 'umedicine_id'];
}
