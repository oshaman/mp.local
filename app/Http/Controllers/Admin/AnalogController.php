<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\AnalogSeo;
use Fresh\Medpravda\Medicine;
use Fresh\Medpravda\Repositories\AnalogRepository;
use Illuminate\Http\Request;
use Gate;

class AnalogController extends AdminController
{
    protected $repository;

    public function __construct(AnalogRepository $analogRepository)
    {
        $this->repository = $analogRepository;
    }

    public function updateSeo(Request $request, $medicine)
    {
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        $medicine = Medicine::find($medicine);

        if (!$medicine) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $result = $this->repository->updateSeo($medicine, $request);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }

            return redirect()->back()->with($result);
        }

        $this->title = 'Редактирование SEO-блоков для аналогов препаратов.';
        $this->mark = 'medicine_admin';

        $seo = AnalogSeo::where('medicine_id', $medicine->id)->first();

        $this->content = view('admin.medicine.seo_analog')->with(compact(['seo', 'medicine']))->render();

        $this->template = 'admin.admin';

        return $this->renderOutput();
    }
}
