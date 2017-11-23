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
    protected $jss = null;
    protected $css = null;
    protected $tiny = false;

    /**
     * @return mixed
     */
    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);
        $this->vars = array_add($this->vars, 'jss', $this->jss);
        $this->vars = array_add($this->vars, 'tiny', $this->tiny);
        $this->vars = array_add($this->vars, 'css', $this->css);

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
                $menu->add('Редактирование пользователей', array('route' => 'users_admin'));
            }

            if (Gate::allows('UPDATE_MEDICINE')) {
                $menu->add('Редактирование препаратов', array('route' => 'medicine_admin'));
            }

            if (Gate::allows('UPDATE_MEDICINE')) {
                $menu->add('Блоки заголовков', array('route' => 'blocks'));
            }

            if (Gate::allows('UPDATE_ARTICLES')) {
                $menu->add('Редактирование статей',array('route' => 'articles_admin'));
            }

            if (Gate::allows('UPDATE_MEDICINES_CATS')) {
                $menu->add('Редактирование категорий препаратов', array('route' => 'medicine_cats'));
            }

        });
    }
}
