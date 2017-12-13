<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Classseo extends Model
{
    protected $fillable = [
        'classificatiob_id',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'seo_text',
        'og_image',
        'og_title',
        'og_description',

        'useo_title',
        'useo_keywords',
        'useo_description',
        'useo_text',
        'uog_image',
        'uog_title',
        'uog_description',
    ];
}
