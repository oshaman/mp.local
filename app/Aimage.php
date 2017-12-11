<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Aimage extends Model
{
    protected $fillable = ['title', 'path', 'alt', 'amedicine_id'];
}
