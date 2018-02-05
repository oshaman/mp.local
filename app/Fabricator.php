<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Fabricator extends Model
{
    protected $fillable = ['title', 'utitle', 'alias'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medicines()
    {
        return $this->belongsToMany('Fresh\Medpravda\Medicine');
    }
}
