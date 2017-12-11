<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Adv extends Model
{
    protected $fillable = ['title', 'path', 'img_alt', 'img_title', 'approved',
        'utext', 'upath', 'uimg_alt', 'uimg_title', 'utext'];
}
