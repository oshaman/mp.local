<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Gate;

class MainController extends AdminController
{
    public function show()
    {
        if (Gate::denies('STATIC_ADMIN')) {
            abort(404);
        }
        $this->title = 'Главная страница';
        $this->template = 'admin.admin';
        $this->content = view('admin.main.index')->render();
        return $this->renderOutput();
    }
}
