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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function children()
    {
        return $this->hasMany('Fresh\Medpravda\Classification', 'parent', 'id')->with(['children', 'medicines']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('Fresh\Medpravda\Classification', 'parent');
    }

    public function getChildren()
    {
        return $this->hasMany('Fresh\Medpravda\Classification', 'parent', 'id');
    }
}
