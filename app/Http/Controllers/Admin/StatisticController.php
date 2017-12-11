<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Repositories\StatisticsRepository;
use Illuminate\Http\Request;
use Gate;

class StatisticController extends AdminController
{
    protected $repository;

    public function __construct(StatisticsRepository $repository)
    {
        $this->template = 'admin.admin';
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return $this|mixed
     */
    public function medicine(Request $request)
    {
        if (Gate::denies('STATIC_ADMIN')) {
            abort(404);
        }

        $this->title = 'Статистика препаратов';

        if ($request->isMethod('post')) {

            $result = $this->repository->getMed($request);
            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result['error']);
            }

            $this->content = view('admin.statistic.index')->with(['res' => $result, 'title' => $this->title])->render();

            return $this->renderOutput();
        }

        $this->content = view('admin.statistic.index')->with(['title' => $this->title])->render();

        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @return $this|mixed
     */
    public function class(Request $request)
    {
        if (Gate::denies('STATIC_ADMIN')) {
            abort(404);
        }
        $this->title = 'Статистика ATX';

        if ($request->isMethod('post')) {

            $result = $this->repository->getAtx($request);
            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result['error']);
            }

            $this->content = view('admin.statistic.index')->with(['res' => $result, 'title' => $this->title])->render();

            return $this->renderOutput();
        }

        $this->content = view('admin.statistic.index')->with(['title' => $this->title])->render();

        return $this->renderOutput();
    }
}
