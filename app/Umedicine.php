<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Umedicine extends Model
{
    protected $fillable = [
        'title',
        'alias',
        'fabricator_id',
        'innname_id',
        'pharmagroup_id',
        'classification_id',
        'approved',
        'view',
        'seo',
        'consist',
        'docs_form',
        'physicochemical_char',
        'fabricator',
        'addr_fabricator',
        'pharm_group',
        'indications',
        'pharm_prop',
        'contraindications',
        'security',
        'application_features',
        'pregnancy',
        'cars',
        'children',
        'app_mode',
        'overdose',
        'side_effects',
        'interaction',
        'shelf_life',
        'saving',
        'packaging',
        'leave_cat',
        'dose',
        'additionally',
        'reg',
        'form_id',
        'backcolor',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasMany('Fresh\Medpravda\Uimage');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function photo()
    {
        return $this->hasMany('Fresh\Medpravda\Uphoto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function substance()
    {
        return $this->belongsToMany('Fresh\Medpravda\Substance', 'umedicine_substance');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classification()
    {
        return $this->belongsTo('Fresh\Medpravda\Classification');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fabricator()
    {
        return $this->belongsTo('Fresh\Medpravda\Fabricator');
    }

    public function fabricator_name()
    {
        return $this->fabricator();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function innname()
    {
        return $this->belongsTo('Fresh\Medpravda\Innname');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pharmagroup()
    {
        return $this->belongsTo('Fresh\Medpravda\Pharmagroup');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form()
    {
        return $this->belongsTo('Fresh\Medpravda\Form');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('Fresh\Medpravda\Uquestion', 'alias', 'alias');
    }
}
