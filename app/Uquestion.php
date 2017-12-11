<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Uquestion extends Model
{
    protected $fillable = ['alias', 'question', 'answer'];
}
