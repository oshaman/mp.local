<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class UArticle extends Model
{
    protected $fillable = ['id', 'title', 'alias', 'category_id', 'approved', 'created_at', 'content',
        'seo', 'view', 'priority', 'description'];
    public $incrementing = false;

    /**
     *  Get the category associated with the blog.
     */
    public function category()
    {
        return $this->belongsTo('Fresh\Medpravda\Category');
    }

    /**
     *  Get the main_img associated with the blog.
     */
    public function image()
    {
        return $this->hasOne('Fresh\Medpravda\UArticleImage', 'article_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('Fresh\Medpravda\Tag', 'article_tag', 'id');
    }

    public function hasTag($id)
    {
        foreach ($this->tags as $tag) {
            if ($tag->id == $id) {
                return true;
            }
        }
        return false;
    }
}
