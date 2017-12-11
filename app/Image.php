<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['title', 'path', 'alt', 'medicine_id'];
}
