<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class UArticleImage extends Model
{
    protected $fillable = ['title', 'path', 'alt', 'article_id'];
    public $timestamps = false;
}
