<?php
/**
 * Created by PhpStorm.
 * User: ххх
 * Date: 28.02.2018
 * Time: 10:29
 */

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Substance;
use Cache;
use Fresh\Medpravda\SubstanceSeo;
use Validator;

class SubstanceRepository extends Repository
{

    public function __construct(Substance $substance)
    {
        $this->model = $substance;
    }

    public function updateSubstance($request, $substance)
    {
        $substance->title = $request->get('title');
        $substance->utitle = $request->get('utitle');
        $res = $substance->save();
        if ($res) {
            Cache::forget('alpha_substance' . $substance->alias);
            Cache::forget('alpha_substance_ua' . $substance->alias);
            Cache::forget('substance-sort-' . $substance->alias);
            Cache::forget('substance-seo-' . $substance->alias);
            Cache::forget('ua-substance-sort-' . $substance->alias);
            Cache::forget('ua-substance-seo-' . $substance->alias);
        }
        return $res;

    }

    /**
     * @param $request
     * @param $model
     * @return array
     */
    public function updateSeo($request, $model)
    {
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

        $result = SubstanceSeo::updateOrCreate(['substance_id' => $model->id], $data)->save();

        if (false != $result) {
            Cache::forget('substance-seo-' . $model->alias);
            Cache::forget('ua-substance-seo-' . $model->alias);
            return ['status' => 'Данные обновлены'];
        } else {
            return ['error' => 'Ошибка обновления'];
        }
    }
}