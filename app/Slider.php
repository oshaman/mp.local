<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['description', 'text', 'link', 'path', 'alt', 'title', 'approved'];
}
