<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $fillable = ['name', 'class', 'parent'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medicines()
    {
        return $this->hasMany('Fresh\Medpravda\Medicine');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function umedicines()
    {
        return $this->hasMany('Fresh\Medpravda\Umedicine');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function children()
    {
        return $this->hasMany('Fresh\Medpravda\Classification', 'parent', 'id')->with(['children', 'medicines']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parents()
    {
        return $this->belongsTo('Fresh\Medpravda\Classification', 'parent', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getChildren()
    {
        return $this->hasMany('Fresh\Medpravda\Classification', 'parent', 'id');
    }

    public function seo()
    {
        return $this->hasOne('Fresh\Medpravda\Classseo');
    }
}
