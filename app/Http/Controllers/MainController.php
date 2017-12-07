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
    protected $slider = null;
    protected $seo = null;
    protected $loc = '';

    /**
     * @param null $loc
     * @return $this
     */
    public function adv()
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
    public function uaAdv()
    {
        $this->title = 'Реклама на сайті';

        $this->loc = 'ua';

        $advs = Adv::where(['approved' => 1])->get();
        $this->content = view('main.adv')->with(['advs' => $advs, 'loc' => 'ua'])->render();

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
    public function about()
    {
        $this->title = 'О нас';
        $about = About::find(1);
        $this->content = view('main.about')->with(['about' => $about])->render();

        return $this->renderOutput();
    }

    /**
     * @param null $loc
     * @return $this
     */
    public function uaAbout()
    {
        $this->title = 'Про нас';
        $about = About::find(2);
        $this->loc = 'ua';
        $this->content = view('main.about')->with(['about' => $about, 'loc' => $this->loc])->render();

        return $this->renderOutput();
    }

    /**
     * @return $this
     */
    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);
        $this->vars = array_add($this->vars, 'jss', $this->jss);
        $this->vars = array_add($this->vars, 'css', $this->jss);

        $this->block = Block::where('id', 1)->first();
        $cats = Category::get();

        if (empty($this->loc)) {
            $header = view('layouts.header.ru')
                ->with(['block' => $this->block, 'cats' => $cats])->render();
        } else {
            $header = view('layouts.header.ua')->with(['block' => $this->block, 'cats' => $cats])->render();
        }
        $this->vars = array_add($this->vars, 'header', $header);

        $tags = Tag::select(['name', 'uname', 'alias'])->where(['approved' => 1])->skip(15)->take(15)->get();
        if (empty($this->loc)) {
            $footer = view('layouts.footer.ru')->with(['cats' => $cats, 'tags' => $tags])->render();
        } else {
            $footer = view('layouts.footer.ua')->with(['cats' => $cats, 'tags' => $tags])->render();
        }
        $this->vars = array_add($this->vars, 'footer', $footer);

        if ($this->content) {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        if ($this->slider) {
            $this->vars = array_add($this->vars, 'slider', $this->slider);
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
