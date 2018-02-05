<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Repositories\SlidersRepository;
use Illuminate\Http\Request;
use Gate;

class SlidersController extends AdminController
{
    protected $rep;

    public function __construct(SlidersRepository $slider)
    {
        $this->rep = $slider;
    }

    public function updateSlider(Request $request, $mainslider = null)
    {
        if (Gate::denies('STATIC_ADMIN')) {
            abort(404);
        }


        if ($request->isMethod('post')) {
            $result = $this->rep->updateSlider($request, $mainslider);

            if (is_array($result) && !empty($result['error'])) {
                return redirect()->back()->withErrors($result['error']);
            }
            return back()->with(['status' => 'Данные обновлены.']);
        }


        $sliders = $this->rep->get();
        $this->content = view('admin.main.sliders')->with(['sliders' => $sliders])->render();

        $this->title = 'Редактирование главного слайдера';
        $this->mark = 'main_admin';

        $this->template = 'admin.admin';
        return $this->renderOutput();
    }
}
