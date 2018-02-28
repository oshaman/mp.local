<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\FaqSeo;
use Fresh\Medpravda\Medicine;
use Fresh\Medpravda\Repositories\FaqRepository;
use Illuminate\Http\Request;
use Gate;

class FaqController extends AdminController
{
    protected $repository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->repository = $faqRepository;
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

        $this->title = 'Редактирование SEO-блоков для вопросов препаратов.';
        $this->mark = 'medicine_admin';

        $seo = FaqSeo::where('medicine_id', $medicine->id)->first();

        $this->content = view('admin.medicine.seo_faq')->with(compact(['seo', 'medicine']))->render();

        $this->template = 'admin.admin';

        return $this->renderOutput();
    }
}
