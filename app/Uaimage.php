<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Uaimage extends Model
{
    protected $fillable = ['title', 'path', 'alt', 'uamedicine_id'];
}
