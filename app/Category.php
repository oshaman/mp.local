<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'utitle', 'alias'];
}
