<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'uname', 'alias', 'approved', 'seo', 'useo'];
}
