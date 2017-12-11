<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Medtag;
use Validator;
use Cache;

class MedtagsRepository extends Repository
{
    public function __construct(Medtag $tag)
    {
        $this->model = $tag;
    }

    public function addTag($request)
    {
        $validator = Validator::make($request->all(), [
            'alias' => 'required|string|between:3,255|exists:medicines,alias',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        $this->model->alias = $request->get('alias');
//dd($this->model);
        try {
            $res = $this->model->save();
            Cache::forget('med-tags');
            if ($res) {
                return ['status' => 'Данные обновлены'];
            }

        } catch (Exception $e) {
            $result = ['error' => 'Ошибка записи.'];
            \Log::info('Ошибка записи тэга-преперата - ' . $e->getMessage());
        }

        return $result;
    }

    /**
     * @param $tag
     * @return array
     */
    public function deleteTag($tag)
    {
        if ($tag->delete()) {
            Cache::forget('med-tags');
            return ['status' => 'Тег удален'];
        }

    }
}