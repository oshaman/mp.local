<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Gate;

class MedicineController extends AdminController
{
    public function index()
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }


        $this->template = 'admin.admin';

        $drug = new \stdClass();
        $drug->id = 3;
        $drug->alias = 'aspirin';
        $drug->title = 'Аспирин';
        $drugs[0] = $drug;
        $this->content = view('admin.medicine.content')->with('drugs', $drugs)->render();
        $this->title = 'MEDICINE';

        return $this->renderOutput();
    }

    public function create()
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        echo 'create';
        /*
        $medicine = 'medicine';
        $this->content = view('admin.medicine.content')->with('medicine', $medicine)->render();
        $this->title = 'MEDICINE';

        return $this->renderOutput();*/
    }

    public function del($medicine)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }
        echo 'del';
    }

    public function edit($medicine)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }
        echo 'edit';
    }
}
