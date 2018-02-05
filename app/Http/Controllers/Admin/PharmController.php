<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Http\Requests\PharmRequest;
use Fresh\Medpravda\Repositories\PharmRepository;
use Gate;

class PharmController extends AdminController
{
    protected $repository;

    public function __construct(PharmRepository $rep)
    {
        $this->repository = $rep;
        $this->template = 'admin.admin';
    }

    public function index(PharmRequest $request)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }
        $data = $request->except('_token');
        if (!empty($data['param'])) {
            $data['value'] = $data['value'] ?? null;
            switch ($data['param']) {
                case 1:
                    $pharms = $this->repository
                        ->get(['title', 'utitle', 'id'], false, 25, [['title', 'like', '%' . $data['value'] . '%']]);
                    if ($pharms) $pharms->appends(['param' => $data['param']])->links();
                    break;
                case 2:
                    $pharms[] = $this->repository->one($data['value']);
                    break;
                default:
                    $pharms = $this->repository
                        ->get(['title', 'utitle', 'id'], false, 25, ['title', 'like', '%' . $data['value'] . '%']);
                    if ($pharms) $pharms->appends(['param' => $data['param']])->links();
            }
        } else {
            $pharms = $this->repository->get(['title', 'utitle', 'id'], false, 25);
        }

        $this->content = view('admin.pharms.show')->with('pharms', $pharms)->render();
        return $this->renderOutput();
    }

    public function updatePharm(PharmRequest $request, $pharm)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->repository->updatePharm($request, $pharm);
            if ($result) {
                return redirect()->back()->with(['status' => 'Фармгруппа обновлена.']);
            } else {
                return redirect()->back()->withErrors(['message' => 'Ошибка изменения фармгруппы, повторите попытку позже.']);
            }
        }
        $this->mark = 'pharm_admin';

        $this->content = view('admin.pharms.edit')->with('pharm', $pharm);
        return $this->renderOutput();
    }
}
