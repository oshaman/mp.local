<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class MedicineStatistic extends Model
{
    protected $fillable = ['medicine_alias', 'created_at'];
    public $timestamps = false;
}
