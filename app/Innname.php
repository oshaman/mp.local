<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Innname extends Model
{
    protected $fillable = ['title', 'alias', 'name', 'uname'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medicines()
    {
        return $this->belongsToMany('Fresh\Medpravda\Medicine');
    }

    public function seo()
    {
        return $this->hasOne('Fresh\Medpravda\InnSeo');
    }
}
