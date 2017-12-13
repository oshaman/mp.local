<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Toptheme extends Model
{
    protected $fillable = ['title', 'description', 'link', 'path', 'alt', 'imgtitle', 'priority', 'approved', 'loc'];
}
