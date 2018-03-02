<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Http\Requests\InnRequest;
//use Fresh\Medpravda\innseo;
use Fresh\Medpravda\InnSeo;
use Fresh\Medpravda\Repositories\InnRepository;
use Illuminate\Http\Request;
use Gate;

class InnController extends AdminController
{
    protected $repository;

    /**
     * innController constructor.
     * @param innRepository $rep
     */
    public function __construct(InnRepository $rep)
    {
        $this->repository = $rep;
        $this->template = 'admin.admin';
    }

    /**
     * @param innRequest $request
     * @return mixed
     */
    public function show(InnRequest $request)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }
        $data = $request->except('_token');
        if (!empty($data['param'])) {
            $data['value'] = $data['value'] ?? null;
            switch ($data['param']) {
                case 1:
                    $inns = $this->repository
                        ->get(['title', 'name', 'uname', 'id'], false, 25, [['title', 'like', '%' . $data['value'] . '%']]);
                    if ($inns) $inns->appends(['param' => $data['param']])->links();
                    break;
                case 2:
                    $inns[] = $this->repository->one($data['value']);
                    break;
                default:
                    $inns = $this->repository
                        ->get(['title', 'name', 'uname', 'id'], false, 25, ['title', 'like', '%' . $data['value'] . '%']);
                    if ($inns) $inns->appends(['param' => $data['param']])->links();
            }
        } else {
            $inns = $this->repository->get(['title', 'name', 'uname', 'id'], false, 25);
        }

        $this->content = view('admin.inns.show')->with('inns', $inns)->render();
        return $this->renderOutput();
    }

    /**
     * @param innRequest $request
     * @param $inn
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function update(innRequest $request, $inn)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->repository->updateInn($request, $inn);
            if ($result) {
                return redirect()->back()->with(['status' => 'Международное название обновлено.']);
            } else {
                return redirect()->back()->withErrors(['message' => 'Ошибка международного названия, повторите попытку позже.']);
            }
        }
        $this->mark = 'inn_admin';

        $this->content = view('admin.inns.edit')->with('inn', $inn);
        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @param $inn
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function updateSeo(Request $request, $inn)
    {

        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $result = $this->repository->updateSeo($request, $inn);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }

            return redirect()->back()->with($result);
        }

        $this->title = 'Редактирование SEO-блоков для вещества.';
        $this->mark = 'inn_admin';

        $seo = InnSeo::where('innname_id', $inn->id)->first();

        $this->content = view('admin.inns.seo')->with(compact(['seo', 'inn']))->render();

        $this->template = 'admin.admin';

        return $this->renderOutput();

    }
}
