<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $fillable = ['name', 'uname', 'class', 'parent'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medicines()
    {
        return $this->hasMany('Fresh\Medpravda\Medicine');
    }

    public function meds()
    {
        return $this->hasMany('Fresh\Medpravda\Medicine', 'classification_id', 'id')->where('approved', 1);
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
        return $this->hasMany('Fresh\Medpravda\Classification', 'parent', 'id')->with(['children', 'meds']);
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
