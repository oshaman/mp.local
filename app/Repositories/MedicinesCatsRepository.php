<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\MedicinesCat;

class MedicinesCatsRepository extends Repository
{
    /**
     * MedicinesCatsRepository constructor.
     * @param MedicinesCat $cats
     */
    public function __construct(MedicinesCat $cats)
    {
        $this->model = $cats;
    }

    public function updateCat($data, $cat)
    {
        try {
            $result = $cat->fill($data)->save();
        } catch (Exception $e) {
            $result = ['error' => 'Ошибка записи'];
            \Log::info('Ошибка записи категории препарата: ' . $e->getMessage());
        }

        if (true === $result) {
            $result = ['status' => 'Данные обновлены'];
        }

        return $result;
    }
}