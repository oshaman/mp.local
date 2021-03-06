<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Pharmagroup;
use Cache;
use Fresh\Medpravda\PharmSeo;
use Validator;

class PharmRepository extends Repository
{
    /**
     * ClassificationRepository constructor.
     * @param Pharmagroup $pharma
     */
    public function __construct(Pharmagroup $pharma)
    {
        $this->model = $pharma;
    }

    /**
     * @param $request
     * @param $pharm
     * @return mixed
     */
    public function updatePharm($request, $pharm)
    {
        $pharm->title = $request->get('title');
        $pharm->utitle = $request->get('utitle');
        $res = $pharm->save();
        if ($res) {
            Cache::forget('ua-sort-farm-' . $pharm->alias);
        }
        return $res;

    }

    /**
     * @param $request
     * @param $pharm
     * @return array
     */
    public function updateSeo($request, $pharm)
    {
//        dd($request->all());
        $validator = Validator::make($request->all(), [
            'seo_title' => 'string|max:255|nullable',
            'seo_keywords' => 'string|max:255|nullable',
            'seo_description' => 'string|max:255|nullable',
            'og_image' => 'string|max:255|nullable',
            'og_title' => 'string|max:255|nullable',
            'og_description' => 'string|max:255|nullable',
            'seo_text' => 'string|nullable',

            'useo_title' => 'string|nullable',
            'useo_keywords' => 'string|nullable',
            'useo_description' => 'string|nullable',
            'useo_text' => 'string|nullable',
            'uog_image' => 'string|nullable',
            'uog_title' => 'string|nullable',
            'uog_description' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        $data = $request->only('seo_title', 'seo_keywords', 'seo_description', 'og_image', 'og_title', 'og_description',
            'seo_text', 'useo_title', 'useo_keywords', 'useo_description', 'uog_image', 'uog_title', 'uog_description', 'useo_text');

        $result = PharmSeo::updateOrCreate(['pharmagroup_id' => $pharm->id], $data)->save();

        if (false != $result) {
            Cache::forget('ua-sort-farms-' . $pharm->alias);
            Cache::forget('sort-farms-' . $pharm->alias);
            Cache::forget('farm-seo-ua-' . $pharm->alias);
            Cache::forget('farm-seo-' . $pharm->alias);
            return ['status' => 'Данные обновлены'];
        } else {
            return ['error' => 'Ошибка обновления'];
        }
    }
}