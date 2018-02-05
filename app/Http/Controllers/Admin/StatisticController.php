<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Repositories\StatisticsRepository;
use Illuminate\Http\Request;
use Gate;
use DB;

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

        $this->mark = 'stats_medicine';

        $this->content = view('admin.statistic.index')->with(['title' => $this->title])->render();

        return $this->renderOutput();
    }

    public function downloadClass(Request $request)
    {
        if (Gate::denies('STATIC_ADMIN')) {
            abort(404);
        }
        $this->title = 'Скачать файл ATX';

        if ($request->isMethod('post')) {

            $result = $this->repository->downloadAtx();

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result['error']);
            }

            return response()->download($result['filepath'], $result['filename'], $result['headers']);
        }
        $this->mark = 'stats_medicine';
        $this->content = view('admin.statistic.download')->with(['title' => $this->title])->render();

        return $this->renderOutput();
    }

    public function showCharts()
    {
        $this->title = 'ATX';
        $this->jss = '<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>';
        $charts = $this->repository->getAtxChart();
        $this->js = view('admin.statistic.chart_js')->with(['charts' => $charts])->render();
//        dd($charts);

        $this->content = view('admin.statistic.chart')->render();

        return $this->renderOutput();
    }
}
