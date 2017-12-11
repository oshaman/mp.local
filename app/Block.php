<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = ['id', 'title', 'utitle', 'first', 'second', 'third', 'fourth', 'fifth'];
    public $timestamps = false;
}
