<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Block;
use Validator;

class BlockRepository extends Repository
{
    /**
     * BlockRepository constructor.
     * @param Block $block
     */
    public function __construct(Block $block)
    {
        $this->model = $block;
    }

    public function updateBlock($request, $block)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:3,255',
            'utitle' => 'required|string|between:3,255',
            'first' => 'nullable|string|between:3,255',
            'second' => 'nullable|string|between:3,255',
            'third' => 'nullable|string|between:3,255',
            'fourth' => 'nullable|string|between:3,255',
            'fifth' => 'nullable|string|between:3,255',
            'sixth' => 'nullable|string|between:3,255',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        $data = $request->except('_token');

        try {
            $result = $block->fill($data)->save();
        } catch (Exception $e) {
            $result = ['error' => 'Ошибка записи.'];
            \Log::info('Ошибка записи блока - ' . $e->getMessage());
        }

        return $result;
    }

}