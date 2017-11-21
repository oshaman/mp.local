<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Innname extends Model
{
    protected $fillable = ['title', 'alias', 'name', 'uname'];

    public function medicines()
    {
        return $this->belongsToMany('Fresh\Medpravda\Medicine');
    }
}
