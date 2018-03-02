<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Http\Requests\SubstanceRequest;
use Fresh\Medpravda\Repositories\SubstanceRepository;
use Fresh\Medpravda\SubstanceSeo;
use Illuminate\Http\Request;
use Gate;

class SubstanceController extends AdminController
{
    protected $repository;

    /**
     * SubstanceController constructor.
     * @param SubstanceRepository $rep
     */
    public function __construct(SubstanceRepository $rep)
    {
        $this->repository = $rep;
        $this->template = 'admin.admin';
    }

    /**
     * @param SubstanceRequest $request
     * @return mixed
     */
    public function show(SubstanceRequest $request)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }
        $data = $request->except('_token');
        if (!empty($data['param'])) {
            $data['value'] = $data['value'] ?? null;
            switch ($data['param']) {
                case 1:
                    $substances = $this->repository
                        ->get(['title', 'utitle', 'id'], false, 25, [['title', 'like', '%' . $data['value'] . '%']]);
                    if ($substances) $substances->appends(['param' => $data['param']])->links();
                    break;
                case 2:
                    $substances[] = $this->repository->one($data['value']);
                    break;
                default:
                    $substances = $this->repository
                        ->get(['title', 'utitle', 'id'], false, 25, ['title', 'like', '%' . $data['value'] . '%']);
                    if ($substances) $substances->appends(['param' => $data['param']])->links();
            }
        } else {
            $substances = $this->repository->get(['title', 'utitle', 'id'], false, 25);
        }

        $this->content = view('admin.substances.show')->with('substances', $substances)->render();
        return $this->renderOutput();
    }

    /**
     * @param SubstanceRequest $request
     * @param $substance
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function update(SubstanceRequest $request, $substance)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->repository->updateSubstance($request, $substance);
            if ($result) {
                return redirect()->back()->with(['status' => 'Вещество обновлено.']);
            } else {
                return redirect()->back()->withErrors(['message' => 'Ошибка изменения вещества, повторите попытку позже.']);
            }
        }
        $this->mark = 'substance_admin';

        $this->content = view('admin.substances.edit')->with('substance', $substance);
        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @param $substance
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function updateSeo(Request $request, $substance)
    {
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $result = $this->repository->updateSeo($request, $substance);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }

            return redirect()->back()->with($result);
        }

        $this->title = 'Редактирование SEO-блоков для вещества.';
        $this->mark = 'substance_admin';

        $seo = SubstanceSeo::where('substance_id', $substance->id)->first();

        $this->content = view('admin.substances.seo')->with(compact(['seo', 'substance']))->render();

        $this->template = 'admin.admin';

        return $this->renderOutput();

    }
}
