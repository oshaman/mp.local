<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Fabricator;
use Cache;
use Validator;
use Fresh\Medpravda\FabricatorSeo;

class FabricatorsRepository extends Repository
{
    /**
     * ClassificationRepository constructor.
     * @param Pharmagroup $pharma
     */
    public function __construct(Fabricator $fabric)
    {
        $this->model = $fabric;
    }

    public function createFabricator($request)
    {
        $data = $request->only('title', 'utitle', 'alias');

        try {
            $result = $this->model->fill($data)->save();
        } catch (Exception $e) {
            \Log::info('Ошибка добавления производителя - ' . $e->getMessage());
            return ['error' => 'Ошибка добавления производителя.'];
        }

        if (!empty($result)) {
            return ['status' => 'Производитель добавлен', 'id' => $this->model->id];
        }

        return ['error' => 'Ошибка добавления производителя.'];
    }

    /**
     * @param $request
     * @param $pharm
     * @return mixed
     */
    public function updateFabricator($request, $fabric)
    {
        $fabric->title = $request->get('title');
        $fabric->utitle = $request->get('utitle');
        $res = $fabric->save();
        if ($res) {
            Cache::forget('ua-medicine-fabricators-' . $fabric->alias);
            Cache::forget('medicine-fabricators-' . $fabric->alias);
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

        $result = FabricatorSeo::updateOrCreate(['fabricator_id' => $model->id], $data)->save();

        if (false != $result) {
            Cache::forget('medicine-fabricator-' . $model->alias);
            Cache::forget('fabricator-seo-' . $model->alias);
            Cache::forget('ua-medicine-fabricator-' . $model->alias);
            Cache::forget('ua-fabricator-seo-' . $model->alias);
            return ['status' => 'Данные обновлены'];
        } else {
            return ['error' => 'Ошибка обновления'];
        }
    }
}