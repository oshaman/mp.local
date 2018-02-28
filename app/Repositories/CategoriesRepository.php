<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Category;
use Cache;

class CategoriesRepository extends Repository
{
    public function __construct(Category $cat)
    {
        $this->model = $cat;
    }

    /**
     * Create new Category
     * @param $request
     * @return bool
     */
    public function addCat($request)
    {
        $data = $request->except('_token');

        $res = $this->model->fill($data)->save();
        Cache::forget('main_cats');
        return $res;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateCat($request, $cat)
    {

        $cat->load('seo');

        $seo = $this->updateSeo($request, $cat);

        if ($cat->title != $request->title) {
            $cat->title = $request->title;
        }

        if ($cat->utitle != $request->utitle) {
            $cat->utitle = $request->utitle;
        }

        if ($request->alias != $cat->alias) {
            $cat->alias = $request->alias;
        }
        $res = $cat->save();
        Cache::forget('main_cats');
        Cache::forget('article-cat-' . $cat->id);
        Cache::forget('ua-article-cat-' . $cat->id);
        return $res;
    }

    /**
     * @return array
     */
    public function catSelect()
    {
        $cats = $this->model->select(['title', 'id'])->get();
        $lists = array();
        foreach ($cats as $category) {
            $lists[$category->id] = $category->title;
        }
        return $lists;
    }

    /**
     * @param $cat
     * @param $request
     * @return mixed
     */
    public function updateSeo($request, $cat)
    {
        if (null == $cat->seo) {
            $seo = $cat->seo()->create([
                'seo_title' => $request->get('seo_title'),
                'seo_keywords' => $request->get('seo_keywords'),
                'seo_description' => $request->get('seo_description'),
                'seo_text' => $request->get('seo_text'),
                'og_image' => $request->get('og_image'),
                'og_title' => $request->get('og_title'),
                'og_description' => $request->get('og_description'),

                'useo_title' => $request->get('useo_title'),
                'useo_keywords' => $request->get('useo_keywords'),
                'useo_description' => $request->get('useo_description'),
                'useo_text' => $request->get('useo_text'),
                'uog_image' => $request->get('uog_image'),
                'uog_title' => $request->get('uog_title'),
                'uog_description' => $request->get('uog_description'),
            ]);
        } else {
            $seo = $cat->seo()->update([
                'seo_title' => $request->get('seo_title'),
                'seo_keywords' => $request->get('seo_keywords'),
                'seo_description' => $request->get('seo_description'),
                'seo_text' => $request->get('seo_text'),
                'og_image' => $request->get('og_image'),
                'og_title' => $request->get('og_title'),
                'og_description' => $request->get('og_description'),

                'useo_title' => $request->get('useo_title'),
                'useo_keywords' => $request->get('useo_keywords'),
                'useo_description' => $request->get('useo_description'),
                'useo_text' => $request->get('useo_text'),
                'uog_image' => $request->get('uog_image'),
                'uog_title' => $request->get('uog_title'),
                'uog_description' => $request->get('uog_description'),
            ]);
        }

        return $seo;
    }

    /**
     * @param $class
     * @param bool $loc
     * @return \stdClass
     */
    public function getSeo($cat, $loc = false)
    {
        $cat->load('seo');
        $obj = new \stdClass;

        if (false == $loc) {
            $obj->seo_title = $cat->seo->seo_title ?? '';
            $obj->seo_keywords = $cat->seo->seo_keywords ?? '';
            $obj->seo_description = $cat->seo->seo_description ?? '';
            $obj->seo_text = $cat->seo->seo_text ?? '';
            $obj->og_image = $cat->seo->og_image ?? '';
            $obj->og_title = $cat->seo->og_title ?? '';
            $obj->og_description = $cat->seo->og_description ?? '';
        } else {
            $obj->seo_title = $cat->seo->useo_title ?? '';
            $obj->seo_keywords = $cat->seo->useo_keywords ?? '';
            $obj->seo_description = $cat->useo->useo_description ?? '';
            $obj->seo_text = $cat->seo->useo_text ?? '';
            $obj->og_image = $cat->seo->uog_image ?? '';
            $obj->og_title = $cat->seo->uog_title ?? '';
            $obj->og_description = $cat->seo->uog_description ?? '';
        }
        return $obj;
    }
}