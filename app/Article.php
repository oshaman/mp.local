<?php

namespace Fresh\Medpravda;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'alias', 'category_id', 'approved', 'created_at', 'content',
        'seo', 'view', 'priority', 'description'];


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
        return $this->hasOne('Fresh\Medpravda\ArticleImage');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('Fresh\Medpravda\Tag', 'article_tag');
    }

    /**
     * @param $id
     * @return bool
     */
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
