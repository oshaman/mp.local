<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['title', 'text', 'path', 'alt', 'img_title'];
}
