<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Repositories\ClassificationRepository;
use Fresh\Medpravda\Http\Requests\AtxRequest;
use Gate;

class ClassificationsController extends AdminController
{
    protected $repository;

    /**
     * ClassificationsController constructor.
     * @param ClassificationRepository $rep
     */
    public function __construct(ClassificationRepository $rep)
    {
        $this->repository = $rep;
        $this->template = 'admin.admin';
    }

    /**
     * @param AtxRequest $request
     * @return mixed
     */
    public function index(AtxRequest $request)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        $atx = null;
        if ($request->isMethod('post')) {
            $atx = $this->repository->getByClass($request);
        }

        $this->content = view('admin.atx.show')->with('class', $atx)->render();
        return $this->renderOutput();
    }

    /**
     * @param AtxRequest $request
     * @param $atx
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function updateAtx(AtxRequest $request, $atx)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->repository->updateAtx($request, $atx);
            if ($result) {
                return redirect()->back()->with(['status' => 'ATX обновлен.']);
            } else {
                return redirect()->back()->withErrors(['message' => 'Ошибка изменения ATX, повторите попытку позже.']);
            }
        }
        $this->mark = 'atx_admin';

        $this->content = view('admin.atx.edit')->with('class', $atx);
        return $this->renderOutput();
    }
}
