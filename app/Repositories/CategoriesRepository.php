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

}