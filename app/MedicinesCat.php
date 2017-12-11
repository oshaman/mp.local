<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class MedicinesCat extends Model
{
    protected $fillable = ['title', 'utitle', 'alias1', 'alias2', 'alias3', 'path', 'alt', 'imgtitle'];

    public function alias_1()
    {
        return $this->hasMany('Fresh\Medpravda\Medicine', 'alias', 'alias1')->with('image');
    }

    public function alias_2()
    {
        return $this->hasMany('Fresh\Medpravda\Medicine', 'alias', 'alias2');
    }

    public function alias_3()
    {
        return $this->hasMany('Fresh\Medpravda\Medicine', 'alias', 'alias3');
    }

}
