<?php

namespace Fresh\Medpravda\Http\Controllers;

use Fresh\Medpravda\About;
use Fresh\Medpravda\Adv;
use Fresh\Medpravda\Block;
use Fresh\Medpravda\Category;
use Fresh\Medpravda\Tag;

class MainController extends Controller
{
    protected $template = 'main.index';
    protected $content = FALSE;
    protected $title;
    protected $vars;
    protected $css = null;
    protected $jss = null;
    protected $aside = null;
    protected $block = null;
    protected $spec = 'ru';
    protected $seo = null;

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

    /**
     * @param null $loc
     * @return $this
     */
    public function adv($loc = null)
    {
        $this->title = 'Реклама на сайте';

        $advs = Adv::where(['approved' => 1])->get();
        $this->content = view('main.adv')->with(['advs' => $advs])->render();

        return $this->renderOutput();
    }

    /**
     * @param null $loc
     * @return $this
     */
    public function convention($loc = null)
    {
        $this->title = 'Соглашение о конфиденциальности';

//        $advs = Adv::where(['approved' => 1])->get();
        $convention = '';
        $this->content = view('main.convention')->with(['convention' => $convention])->render();

        return $this->renderOutput();
    }

    /**
     * @param null $loc
     * @return $this
     */
    public function conditions($loc = null)
    {
        $this->title = 'Условия использования сайта';

//        $advs = Adv::where(['approved' => 1])->get();
        $conditions = '';
        $this->content = view('main.conditions')->with(['conditions' => $conditions])->render();

        return $this->renderOutput();
    }

    /**
     * @param null $loc
     * @return $this
     */
    public function about($loc = null)
    {
        $this->title = 'О нас';
        $about = About::find(1);
        $this->content = view('main.about')->with(['about' => $about])->render();

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

        $this->block = Block::where('id', 1)->first();
        $cats = Category::get();
        $header = view('layouts.header.' . $this->spec)->with(['block' => $this->block, 'cats' => $cats])->render();
        $this->vars = array_add($this->vars, 'header', $header);

        $tags = Tag::get();
        $footer = view('layouts.footer')->with(['cats' => $cats, 'tags' => $tags])->render();
        $this->vars = array_add($this->vars, 'footer', $footer);

        if ($this->content) {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        if (empty($this->seo)) {
            $this->seo = new \stdClass();
            $this->seo->seo_keywords = 'Медправда';
            $this->seo->seo_description = 'Медправда';
            $this->seo->og_title = 'Медправда';
            $this->seo->og_description = 'Медправда';
            $this->seo->seo_title = 'Медправда';
        }
        $this->vars = array_add($this->vars, 'seo', $this->seo);

        if ($this->aside) {
            $this->vars = array_add($this->vars, 'aside', $this->aside);
        }

        return view($this->template)->with($this->vars);
    }
}
