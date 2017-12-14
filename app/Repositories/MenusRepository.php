<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Menu;
use Cache;

class MenusRepository extends Repository
{
    /**
     * MenusRepository constructor.
     * @param Menu $menu
     */
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    /**
     * @param $request
     * @return array
     */
    public function updateMenus($request)
    {
        $data = $request->except('_token');

        if (!empty($data['cats'])) {

            $this->model->where('own', 'ru')->delete();
            foreach ($data['cats'] as $cat) {
                $this->model->create(['category_id' => $cat, 'own' => 'ru']);
            }
            Cache::forget('ru_menu');
            return ['status' => 'Меню обновлено'];
        } elseif (!empty($data['ua_cats'])) {
            $this->model->where('own', 'ua')->delete();
            foreach ($data['ua_cats'] as $cat) {
                $this->model->create(['category_id' => $cat, 'own' => 'ua']);
            }
            Cache::forget('ua_menu');
            return ['status' => 'Меню обновлено'];
        } else {
            return ['error' => 'Нет данных'];
        }
    }
}