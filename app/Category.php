<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'utitle', 'alias'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function seo()
    {
        return $this->hasOne('Fresh\Medpravda\CatSeo');
    }
}
