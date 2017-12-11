<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['alias', 'question', 'answer'];
}
