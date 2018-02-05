<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Repositories\MedicinesCatsRepository;
use Illuminate\Http\Request;
use Gate;

class MedicinesCatsController extends AdminController
{
    protected $repo;

    /**
     * MedicinesCatsController constructor.
     * @param MedicinesCatsRepository $cat
     */
    public function __construct(MedicinesCatsRepository $cat)
    {
        $this->repo = $cat;
    }

    /**
     * @param Request $request
     * @param null $cat
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function updateCats(Request $request, $cat = null)
    {
        if (Gate::denies('UPDATE_MEDICINES_CATS')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|string|between:3,24',
                'utitle' => 'required|string|between:3,24',
                'alias1' => 'nullable|alpha_dash|exists:medicines,alias',
                'alias2' => 'nullable|alpha_dash|exists:medicines,alias',
                'alias3' => 'nullable|alpha_dash|exists:medicines,alias',
                'img' => 'sometimes|mimes:png|max:30',
                'alt' => 'nullable|string|between:,255',
                'imgtitle' => 'nullable|string|between:,255',
            ]);

            $result = $this->repo->updateCat($request, $cat);

//            dd($result);
            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }
            return back()->with($result);
        }

        $this->title = 'Редактирование категорий препаратов';
        $this->mark = 'main_admin';
        $this->template = 'admin.admin';
        $cats = $this->repo->get();
        $this->content = view('admin.main.med_cats')->with('cats', $cats)->render();

        return $this->renderOutput();
    }
}
