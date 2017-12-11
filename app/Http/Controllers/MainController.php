<?php

namespace Fresh\Medpravda\Http\Controllers;

use Fresh\Medpravda\About;
use Fresh\Medpravda\Adv;
use Fresh\Medpravda\Block;
use Fresh\Medpravda\Category;
use Fresh\Medpravda\Tag;
use Cache;

class MainController extends Controller
{
    protected $template = 'main.index';
    protected $content = false;
    protected $lastModified = false;
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

        $this->content = Cache::rememberForever('adv', function () {
            $advs = Adv::where(['approved' => 1])->get();
            return view('main.adv')->with(['advs' => $advs])->render();
        });

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
        $this->content = Cache::rememberForever('ua_adv', function () {
            $advs = Adv::where(['approved' => 1])->get();
            return view('main.adv')->with(['advs' => $advs, 'loc' => 'ua'])->render();
        });

        return $this->renderOutput();
    }

    /**
     * @param null $loc
     * @return $this
     */
    public function convention($loc = null)
    {
        $this->title = 'Соглашение о конфиденциальности';

        $this->content = Cache::rememberForever('convention', function () {
            $about = About::find(3);
            return view('main.about')->with(['about' => $about])->render();
        });

        return $this->renderOutput();
    }

    /**
     * @param null $loc
     * @return $this
     */
    public function uaConvention($loc = null)
    {
        $this->title = 'Угода про конфіденційність';
        $this->loc = 'ua';
        $this->content = Cache::rememberForever('ua_convention', function () {
            $about = About::find(4);
            return view('main.about')->with(['about' => $about])->render();
        });

        return $this->renderOutput();
    }

    /**
     * @param null $loc
     * @return $this
     */
    public function conditions($loc = null)
    {
        $this->title = 'Условия использования сайта';

        $this->content = Cache::rememberForever('conditions', function () {
            $about = About::find(5);
            return view('main.about')->with(['about' => $about])->render();
        });

        return $this->renderOutput();
    }

    /**
     * @param null $loc
     * @return $this
     */
    public function uaConditions($loc = null)
    {
        $this->title = 'Умови використання сайту';
        $this->loc = 'ua';

        $this->content = Cache::rememberForever('ua_conditions', function () {
            $about = About::find(6);
            return view('main.about')->with(['about' => $about])->render();
        });

        return $this->renderOutput();
    }

    /**
     * @param null $loc
     * @return $this
     */
    public function about()
    {
        $this->title = 'О нас';
        $this->content = Cache::rememberForever('about', function () {
            $about = About::find(1);
            return view('main.about')->with(['about' => $about])->render();
        });

        return $this->renderOutput();
    }

    /**
     * @param null $loc
     * @return $this
     */
    public function uaAbout()
    {
        $this->title = 'Про нас';
        $this->loc = 'ua';

        $this->content = Cache::rememberForever('ua_about', function () {
            $about = About::find(2);
            return view('main.about')->with(['about' => $about, 'loc' => $this->loc])->render();
        });

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

        $this->block = Cache::remember('blocks', 60, function () {
            return Block::where('id', 1)->first();
        });


        $cats = Cache::remember('main_cats', 60, function () {
            return Category::get();
        });

        if (empty($this->loc)) {
            $header = view('layouts.header.ru')
                ->with(['block' => $this->block, 'cats' => $cats])->render();
        } else {
            $header = view('layouts.header.ua')->with(['block' => $this->block, 'cats' => $cats])->render();
        }
        $this->vars = array_add($this->vars, 'header', $header);

        $tags = Cache::remember('tags_main', 60, function () {
            return Tag::select(['name', 'uname', 'alias'])->where(['approved' => 1])->skip(15)->take(15)->get();
        });

        if (empty($this->loc)) {
            $med_tags = Cache::remember('med-tags', 24 * 60, function () {
                $meds = \Fresh\Medpravda\Medtag::take(14)->get();
                return \Fresh\Medpravda\Medicine::select('title', 'alias')->whereIn('alias', $meds->toArray())->get();
            });
            $footer = view('layouts.footer.ru')
                ->with(['cats' => $cats, 'tags' => $tags, 'med_tags' => $med_tags])->render();
        } else {
            $med_tags = Cache::remember('med-tags', 24 * 60, function () {
                $meds = \Fresh\Medpravda\Medtag::take(14)->get();
                return \Fresh\Medpravda\Umedicine::select('title', 'alias')->whereIn('alias', $meds->toArray())->get();
            });
            $footer = view('layouts.footer.ua')
                ->with(['cats' => $cats, 'tags' => $tags, 'med_tags' => $med_tags])->render();
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

        if ($this->lastModified) {
            $content = view($this->template)->with($this->vars);
            return response($content)->header('Last-Modified', $this->lastModified);
        }
        return view($this->template)->with($this->vars);
    }
}
