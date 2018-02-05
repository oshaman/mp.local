<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fresh\Medpravda\Repositories\SeoRepository;
use Gate;

class SeoController extends AdminController
{
    /**
     * SeoController constructor.
     */
    public function __construct()
    {

        $this->template = 'admin.admin';
        $this->title = 'SEO';
        $this->tiny = true;
        $this->mark = 'static';
    }

    /**
     * @param SeoRepository $repository
     * @return mixed
     */
    public function index(SeoRepository $repository)
    {
        if (Gate::denies('SEO_ADMIN')) {
            abort(404);
        }
        $seos = $repository->get(['id', 'uri']);
        $this->content = view('admin.seo.show')->with(['seos' => $seos])->render();
        return $this->renderOutput();
    }

    /**
     * @param SeoRepository $repository
     * @param Request $request
     * @param bool $seo
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function edit(SeoRepository $repository, Request $request, $seo = false)
    {
        if (Gate::denies('SEO_ADMIN')) {
            abort(404);
        }
        if ($request->isMethod('post')) {
            $result = $repository->updateSeo($request, $seo);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result['error']);
            }
            return redirect()->route('seo_admin')->with($result);
        }

        $this->content = view('admin.seo.edit')->with(['seo' => $seo])->render();
        return $this->renderOutput();

    }
}
