<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Substance extends Model
{
    protected $fillable = ['title', 'alias'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medicine()
    {
        return $this->belongsToMany('Fresh\Medpravda\Medicine', 'medicine_substance');
    }

    public function seo()
    {
        return $this->hasOne('Fresh\Medpravda\SubstanceSeo');
    }
}
