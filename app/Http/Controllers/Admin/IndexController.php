<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Illuminate\Http\Request;

class IndexController extends AdminController
{
    public function show()
    {
        $this->content = 'IndexC';
        $this->template = 'admin.admin';
        $this->title = 'ADMIN';

        return $this->renderOutput();
    }
}
