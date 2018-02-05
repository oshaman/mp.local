<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Category;

use Fresh\Medpravda\Repositories\MenusRepository;
use Fresh\Medpravda\Menu;
use Fresh\Medpravda\Http\Requests\MenusRequest;
use Gate;
use Cache;

class MenusController extends AdminController
{
    protected $m_rep;

    public function __construct(MenusRepository $rep)
    {
        $this->m_rep = $rep;
        $this->mark = 'articles_admin';
    }

    public function index(MenusRequest $request)
    {
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $result = $this->m_rep->updateMenus($request);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }
            /*Cache::forget('patientMenu');
            Cache::forget('patientMenu_main');
            Cache::forget('docsMenu');*/
            return back()->with($result);
        }
        $this->template = 'admin.admin';

        $cats = Category::select('id', 'title', 'utitle')->get();

        $menus = Menu::all();

        $this->content = view('admin.menu.menu')->with(['cats' => $cats, 'menus' => $menus])->render();
        return $this->renderOutput();
    }

}
