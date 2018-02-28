<?php
/**
 * Created by PhpStorm.
 * User: ххх
 * Date: 28.02.2018
 * Time: 11:34
 */

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Innname;
use Cache;
//use Fresh\Medpravda\SubstanceSeo;
use Fresh\Medpravda\InnSeo;
use Validator;

class InnRepository extends Repository
{
    public function __construct(Innname $inn)
    {
        $this->model = $inn;
    }

    public function updateInn($request, $inn)
    {
        $inn->title = $request->get('title');
        $inn->name = $request->get('name');
        $inn->uname = $request->get('uname');
        $res = $inn->save();
        if ($res) {
            Cache::forget('mnn_alpha' . $inn->alias);
            Cache::forget('medicine-mnns-' . $inn->alias);
            Cache::forget('ua-medicine-mnns-' . $inn->alias);

            Cache::forget('inn-seo-' . $inn->alias);
            Cache::forget('ua-inn-seo-' . $inn->alias);
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

        $result = InnSeo::updateOrCreate(['innname_id' => $model->id], $data)->save();

        if (false != $result) {
            Cache::forget('inn-seo-' . $model->alias);
            Cache::forget('ua-inn-seo-' . $model->alias);
            return ['status' => 'Данные обновлены'];
        } else {
            return ['error' => 'Ошибка обновления'];
        }
    }
}