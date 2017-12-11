<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class ClassificationStatistic extends Model
{
    protected $fillable = ['class_alias', 'created_at'];
    public $timestamps = false;
}
