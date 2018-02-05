<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Fabricator;
use Cache;

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
}