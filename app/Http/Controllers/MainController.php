<?php

namespace Fresh\Medpravda\Http\Controllers;

use Fresh\Medpravda\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $template = 'main.index';
    protected $content = FALSE;
    protected $title;
    protected $vars;
    protected $css = null;
    protected $jss = null;
    protected $aside = null;

    /*public function index()
    {
        $user = User::where('id', 2)->with('role')->first();
        dd($user);
    }*/

    public function medicine($loc, $medicine, $act = null)
    {
        $act = $act ?? 'medicine';

        if ('ru' == $loc) {
            $content = 'RU-' . $act . '-' . $medicine;
        } else {
            $content = 'UA-' . $act . '-' . $medicine;
        }
        return view('test')->with('content', $content);
    }

    public function adv($loc = null)
    {
        $this->title = 'Реклама на сайте';
        $this->content = view('main.adv')->render();

        return $this->renderOutput();
    }

    public function about($loc = null)
    {
        $this->title = 'О нас';
        $this->content = view('main.about')->render();

        return $this->renderOutput();
    }
    /*public function analog($loc, $medicine=null)
    {
        if ('ru' == $loc) {
            $content = 'RU-analog-'.$medicine;
        } else {
            $content = 'UA-analog-'.$medicine;
        }
        return view('test')->with('content', $content);
    }

    public function adaptive($loc, $medicine=null)
    {
        if ('ru' == $loc) {
            $content = 'RU-adaptive-'.$medicine;
        } else {
            $content = 'UA-adaptive-'.$medicine;
        }
        return view('test')->with('content', $content);
    }

    public function faqMed($loc, $medicine=null)
    {
        if ('ru' == $loc) {
            $content = 'RU-faq-'.$medicine;
        } else {
            $content = 'UA-faq-'.$medicine;
        }
        return view('test')->with('content', $content);
    }*/
    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);
        $this->vars = array_add($this->vars, 'jss', $this->jss);
        $this->vars = array_add($this->vars, 'css', $this->jss);

        $header = view('layouts.header')->render();
        $this->vars = array_add($this->vars, 'header', $header);

        $footer = view('layouts.footer')->render();
        $this->vars = array_add($this->vars, 'footer', $footer);

        if ($this->content) {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        if ($this->aside) {
            $this->vars = array_add($this->vars, 'aside', $this->aside);
        }

        return view($this->template)->with($this->vars);
    }
}
