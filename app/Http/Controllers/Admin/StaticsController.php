<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\About;
use Fresh\Medpravda\Repositories\AboutRepository;
use Gate;
use Fresh\Medpravda\Repositories\AdvsRepository;
use Illuminate\Http\Request;

class StaticsController extends AdminController
{
    protected $adv_rep;
    protected $about_rep;

    /**
     * StaticsController constructor.
     */
    public function __construct(AdvsRepository $adv, AboutRepository $aboutRepository)
    {
        $this->template = 'admin.admin';
        $this->adv_rep = $adv;
        $this->about_rep = $aboutRepository;
    }

    /**
     * @return mixed
     */
    public function show()
    {
        if (Gate::denies('STATIC_ADMIN')) {
            abort(404);
        }

        $this->title = 'Статичные страницы';

        $this->content = view('admin.static.index')->render();

        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function updateAbout(Request $request)
    {
        if (Gate::denies('STATIC_ADMIN')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $result = $this->about_rep->updateAbout($request);

            if (is_array($result) && !empty($result['error'])) {
                return redirect()->back()->withErrors($result['error']);
            }
            return back()->with(['status' => 'Данные обновлены.']);
        }

        $this->title = 'Страница О Нас';

        $abouts = About::whereIn('id', [1, 2])->get();

        $this->tiny = true;
        $this->content = view('admin.static.about')->with(['abouts' => $abouts])->render();

        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function updateConditions(Request $request)
    {
        if (Gate::denies('STATIC_ADMIN')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $result = $this->about_rep->updateConditions($request);

            if (is_array($result) && !empty($result['error'])) {
                return redirect()->back()->withErrors($result['error']);
            }
            return back()->with(['status' => 'Данные обновлены.']);
        }

        $this->title = 'Условия использования сайта';

        $abouts = About::whereIn('id', [5, 6])->get();

        $this->tiny = true;
        $this->content = view('admin.static.about')->with(['abouts' => $abouts])->render();

        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @param null $adv
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function updateAdv(Request $request, $adv = null)
    {
        if (Gate::denies('STATIC_ADMIN')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $result = $this->adv_rep->updateAdv($request, $adv);

            if (is_array($result) && !empty($result['error'])) {
                return redirect()->back()->withErrors($result['error']);
            }
            return back()->with(['status' => 'Данные обновлены.']);
        }


        $this->title = 'Страница рекламы';

        $advs = $this->adv_rep->get();
        $this->jss = '
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="' . asset('js/translate.js') . '"></script>
            ';

        $this->tiny = true;
        $this->areaH = true;
        $this->areaW = 550;
        $this->content = view('admin.static.adv')->with(['advs' => $advs])->render();

        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function delimg(Request $request)
    {
        if (Gate::denies('STATIC_ADMIN')) {
            abort(404);
        }

        $request->validate([
            'data-img' => 'integer|required',
        ]);

        $result = $this->adv_rep->delImg($request);

        return \Response::json($result);
    }

    public function updateConvention(Request $request)
    {
        if (Gate::denies('STATIC_ADMIN')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $result = $this->about_rep->updateСonvention($request);

            if (is_array($result) && !empty($result['error'])) {
                return redirect()->back()->withErrors($result['error']);
            }
            return back()->with(['status' => 'Данные обновлены.']);
        }

        $this->title = 'Страница конфиденциальности';

        $abouts = About::whereIn('id', [3, 4])->get();

        $this->tiny = true;
        $this->content = view('admin.static.about')->with(['abouts' => $abouts])->render();

        return $this->renderOutput();
    }
}
