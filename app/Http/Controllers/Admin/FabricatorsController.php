<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Http\Requests\FabricatorRequest;
use Fresh\Medpravda\Repositories\FabricatorsRepository;
use Gate;
use Illuminate\Http\Request;
use Fresh\Medpravda\FabricatorSeo;

class FabricatorsController extends AdminController
{
    protected $repository;

    /**
     * FabricatorsController constructor.
     * @param FabricatorsRepository $rep
     */
    public function __construct(FabricatorsRepository $rep)
    {
        $this->repository = $rep;
        $this->template = 'admin.admin';
    }

    /**
     * @param FabricatorRequest $request
     * @return mixed
     */
    public function index(FabricatorRequest $request)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }
        $data = $request->except('_token');
        if (!empty($data['param'])) {
            $data['value'] = $data['value'] ?? null;
            switch ($data['param']) {
                case 1:
                    $fabricators = $this->repository
                        ->get(['title', 'utitle', 'id'], false, 25, [['title', 'like', '%' . $data['value'] . '%']]);
                    if ($fabricators) $fabricators->appends(['param' => $data['param']])->links();
                    break;
                case 2:
                    $fabricators[] = $this->repository->one($data['value']);
                    break;
                default:
                    $fabricators = $this->repository
                        ->get(['title', 'utitle', 'id'], false, 25, ['title', 'like', '%' . $data['value'] . '%']);
                    if ($fabricators) $fabricators->appends(['param' => $data['param']])->links();
            }
        } else {
            $fabricators = $this->repository->get(['title', 'utitle', 'id'], false, 25);
        }

        $this->content = view('admin.fabricators.show')->with('fabricators', $fabricators)->render();
        return $this->renderOutput();
    }

    public function store(FabricatorRequest $request)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
//            dd($request);

            $result = $this->repository->createFabricator($request);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }
            return redirect()->route('fabricator_update', ['fabricator' => $result['id']])->with($result);

        }

        $this->title = 'Добавление производителя.';
        $this->mark = 'fabricator_admin';

        $this->jss = '
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="' . asset('js/translate.js') . '"></script>
            ';

        $this->template = 'admin.admin';
        $this->tiny = true;
        $this->content = view('admin.fabricators.create')->with(['title' => $this->title])->render();

        return $this->renderOutput();

    }

    /**
     * @param FabricatorRequest $request
     * @param $fabricator
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function updateFabricator(FabricatorRequest $request, $fabricator)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->repository->updateFabricator($request, $fabricator);
            if ($result) {
                return redirect()->back()->with(['status' => 'Производитель обновлен.']);
            } else {
                return redirect()->back()->withErrors(['message' => 'Ошибка изменения производителя, повторите попытку позже.']);
            }
        }
        $this->mark = 'fabricator_admin';

        $this->content = view('admin.fabricators.edit')->with('fabricator', $fabricator);
        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @param $fabricator
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function updateSeo(Request $request, $fabricator)
    {
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $result = $this->repository->updateSeo($request, $fabricator);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }

            return redirect()->back()->with($result);
        }

        $this->title = 'Редактирование SEO-блоков для производителя.';
        $this->mark = 'fabricator_admin';

        $seo = FabricatorSeo::where('fabricator_id', $fabricator->id)->first();

        $this->content = view('admin.fabricators.seo')->with(compact(['seo', 'fabricator']))->render();

        $this->template = 'admin.admin';

        return $this->renderOutput();
    }
}
