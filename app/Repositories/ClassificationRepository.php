<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Classification;
use Cache;

class ClassificationRepository extends Repository
{
    protected $parents_array;

    /**
     * ClassificationRepository constructor.
     * @param Classification $classification
     */
    public function __construct(Classification $classification)
    {
        $this->model = $classification;
    }

    /**
     * @param $id
     * @return array
     */
    public function getParents($id)
    {
        $result = $this->model->where('id', $id)->first();

        $this->parents_array[$result->class] = ['name' => $result->name, 'uname' => $result->uname, 'class' => $result->class];
        if ($result->parent != 0) {
            $this->getParents($result->parent);
        }
        return array_reverse($this->parents_array);
    }

    /**
     * @param $class
     * @return mixed
     */
    public function atxIsset($class)
    {
        return $this->model->where('class', $class)->count();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getByClass($request)
    {
        return $this->model->where('class', $request->atx)->first();
    }

    /**
     * @param $val
     * @return mixed
     */
    public function getClass($val)
    {
        return $this->model->where('class', $val)->first();
    }

    /**
     * @param $request
     * @param $atx
     * @return mixed
     */
    public function updateAtx($request, $atx)
    {
        $atx->load('seo');

        if (null == $atx->seo) {
            $res = $atx->seo()->create([
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
            $res = $atx->seo()->update([
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
        if (!empty($res)) {
            Cache::store('file')->forget('atx-seo-' . $atx->class);
            Cache::store('file')->forget('ua-atx-seo-' . $atx->class);
            Cache::store('file')->forget('sort-atx-' . $atx->class);
            Cache::store('file')->forget('sort-ua-atx-' . $atx->class);
        }

        $atx->name = $request->get('name');
        $atx->uname = $request->get('uname');
        $atx->save();
        return $res;
    }
}