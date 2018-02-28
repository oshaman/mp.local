<?php
/**
 * Created by PhpStorm.
 * User: ххх
 * Date: 21.02.2018
 * Time: 12:54
 */

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\FaqSeo;
use Validator;

class FaqRepository
{
    public function updateSeo($medicine, $request)
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
            'seo_text', 'useo_title', 'useo_text', 'useo_keywords', 'useo_description', 'uog_image', 'uog_title', 'uog_description');

        $result = FaqSeo::updateOrCreate(['medicine_id' => $medicine->id], $data)->save();

        if (false != $result) {
//            Cache::forget('article_' . $medicine->alias);
            return ['status' => 'Данные обновлены'];
        } else {
            return ['error' => 'Ошибка обновления'];
        }
    }
}