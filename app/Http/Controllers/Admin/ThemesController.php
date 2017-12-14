<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Http\Requests\ThemeRequest;
use Fresh\Medpravda\Repositories\ThemesRepository;
use Gate;

class ThemesController extends AdminController
{
    protected $repository;

    public function __construct(ThemesRepository $themesRepository)
    {
        $this->repository = $themesRepository;
        $this->template = 'admin.admin';
    }

    /**
     * @param ThemeRequest $request
     * @return mixed
     */
    public function index(ThemeRequest $request)
    {
        $this->title = 'Редактирование тем';
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }
        /*==========================================================================================*/
        $data = $request->except('_token');
        if (!empty($data['value'])) {
            $data['value'] = $data['value'] ?? null;
            $themes = $this->repository->get(['title', 'id'], false, 25, ['title' => $data['value']]);
            if ($themes) $themes->appends(['param' => $data['value']])->links();
        } else {
            $themes = $this->repository->get(['title', 'id', 'loc'], false, 25);
        }

        $this->content = view('admin.themes.show')->with(['themes' => $themes])->render();

        return $this->renderOutput();

    }

    public function createTheme(ThemeRequest $request)
    {
        $this->title = 'Добавление темы';
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->repository->addTheme($request);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }
            return redirect()->route('themes_update', ['theme' => $result['id']])->with($result);
        }


        $this->content = view('admin.themes.add')->render();

        return $this->renderOutput();
    }

    public function edit(ThemeRequest $request, $theme)
    {
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

//        dd($theme);

        if ($request->isMethod('post')) {

            $result = $this->repository->updateTheme($request, $theme);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withInput()->withErrors($result);
            }
            return redirect()->back()->with($result);
        }

        $this->title = 'Редактирование темы:';

        if ('ru' == $theme->loc) {
            $theme->loc_id = 1;
        } else {
            $theme->loc_id = 2;
        }

        $this->content = view('admin.themes.edit')
            ->with(['theme' => $theme])
            ->render();

        return $this->renderOutput();

    }

    public function del($theme)
    {
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        $result = $this->repository->deleteTheme($theme);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect()->route('themes_admin')->with($result);
    }
}
