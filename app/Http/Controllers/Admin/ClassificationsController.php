<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Repositories\ClassificationRepository;
use Fresh\Medpravda\Http\Requests\AtxRequest;
use Gate;

class ClassificationsController extends AdminController
{
    protected $repository;

    public function __construct(ClassificationRepository $rep)
    {
        $this->repository = $rep;
    }

    public function index(AtxRequest $request)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        $this->template = 'admin.admin';

        $atx = null;
        if ($request->isMethod('post')) {
            $atx = $this->repository->getByClass($request);
        }

        $this->content = view('admin.atx.show')->with('class', $atx)->render();
        return $this->renderOutput();
    }

    public function updateAtx(AtxRequest $request, $atx)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }
        $this->template = 'admin.admin';


        if ($request->isMethod('post')) {

            $result = $this->repository->updateAtx($request, $atx);
            if ($result) {
                return redirect()->back()->with(['status' => 'ATX обновлен.']);
            } else {
                return redirect()->back()->withErrors(['message' => 'Ошибка изменения ATX, повторите попытку позже.']);
            }
        }

        $this->content = view('admin.atx.edit')->with('class', $atx);
        return $this->renderOutput();
    }
}
