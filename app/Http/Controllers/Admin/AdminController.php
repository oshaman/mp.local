<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fresh\Medpravda\Http\Controllers\Controller;
use Menu;
use Gate;
use Auth;

class AdminController extends Controller
{
    protected $template;
    protected $content = FALSE;
    protected $title;
    protected $vars;
    protected $mark = false;
    protected $jss = null;
    protected $js = null;
    protected $css = null;
    protected $tiny = false;
    protected $areaH = false;
    protected $areaW = false;

    /**
     * @return mixed
     */
    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);
        $this->vars = array_add($this->vars, 'jss', $this->jss);
        $this->vars = array_add($this->vars, 'js', $this->js);
        $this->vars = array_add($this->vars, 'tiny', $this->tiny);
        $this->vars = array_add($this->vars, 'css', $this->css);
        $this->vars = array_add($this->vars, 'mark', $this->mark);
        if (!empty($this->areaH)) $this->vars = array_add($this->vars, 'areaH', $this->areaH);
        if (!empty($this->areaW)) $this->vars = array_add($this->vars, 'areaW', $this->areaW);

        $menu = $this->getMenu();
        $navigation = view('admin.navigation')->with('menu', $menu)->render();
        $this->vars = array_add($this->vars, 'nav', $navigation);

        if ($this->content) {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        return view($this->template)->with($this->vars);
    }

    /**
     * @return mixed
     */
    public function getMenu()
    {
        return Menu::make('adminMenu', function ($menu) {

            if (Gate::allows('USERS_ADMIN')) {
                $menu->add('Пользователи', array('route' => 'users_admin', 'class' => 'users'));
            }

            if (Gate::allows('UPDATE_MEDICINE')) {
                $menu->add('Препараты', array('route' => 'medicine_admin', 'class' => 'medicine_admin'));
            }

            if (Gate::allows('UPDATE_MEDICINE')) {
                $menu->add('ATX', array('route' => 'atx_admin', 'class' => 'atx_admin'));
            }

            if (Gate::allows('UPDATE_MEDICINE')) {
                $menu->add('Фармгруппа', array('route' => 'pharm_admin', 'class' => 'pharm_admin'));
            }

            if (Gate::allows('UPDATE_MEDICINE')) {
                $menu->add('Производители', array('route' => 'fabricator_admin', 'class' => 'fabricator_admin'));
            }

            if (Gate::allows('UPDATE_ARTICLES')) {
                $menu->add('Редактирование статей', array('route' => 'articles_admin', 'class' => 'articles_admin'));
            }

            if (Gate::allows('UPDATE_ARTICLES')) {
                $menu->add('Темы', array('route' => 'themes_admin', 'class' => 'themes_admin'));
            }

            if (Gate::allows('MAIN_ADMIN')) {
                $menu->add('Главная страница', array('route' => 'main_admin', 'class' => 'main_admin'));
            }

            if (Gate::allows('STATIC_ADMIN')) {
                $menu->add('Статичные страницы', ['url' => 'admin/static', 'class' => 'static']);
            }

            if (Gate::allows('STATIC_ADMIN')) {
                $menu->add('Статистика', array('route' => 'stats_medicine', 'class' => 'stats_medicine'));
            }

            /*if (Gate::allows('USERS_ADMIN')) {
                $menu->add('test', array('route' => 'presearch'));
            }*/
        });
    }
}
