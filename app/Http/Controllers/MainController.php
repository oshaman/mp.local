<?php

namespace Fresh\Medpravda\Http\Controllers;

use Fresh\Medpravda\About;
use Fresh\Medpravda\Adv;
use Fresh\Medpravda\Block;
use Fresh\Medpravda\Menu as Menus;
use Fresh\Medpravda\Seo;
use Fresh\Medpravda\Tag;
use Cache;
use Menu;

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
        $this->getSeos('reklama');

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
        $this->getSeos('reklama/ua');
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
        $this->getSeos('soglashenie');

        $this->content = Cache::rememberForever('convention', function () {
            $about = About::find(3);
            return view('main.convention')->with(['about' => $about])->render();
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
        $this->getSeos('soglashenie/ua');

        $this->content = Cache::rememberForever('ua_convention', function () {
            $about = About::find(4);
            return view('main.convention')->with(['about' => $about, 'loc' => true])->render();
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
        $this->getSeos('usloviya');

        $this->content = Cache::rememberForever('conditions', function () {
            $about = About::find(5);
            return view('main.conditions')->with(['about' => $about])->render();
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
        $this->getSeos('usloviya/ua');

        $this->content = Cache::rememberForever('ua_conditions', function () {
            $about = About::find(6);
            return view('main.conditions')->with(['about' => $about, 'loc' => true])->render();
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
        $this->getSeos('onas');
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
        $this->getSeos('onas/ua');

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
//============================== Header =====================================
        if (empty($this->loc)) {
            $cats = Cache::remember('ru_menu', 60, function () {
                return $this->getMenu();
            });
            $themes = Cache::remember('header_themes', 24 * 60, function () {
                return $this->getThemes();
            });

            $header = view('layouts.header.ru')
                ->with(['block' => $this->block, 'cats' => $cats, 'themes' => $themes])->render();
        } else {
            $cats = Cache::remember('ua_menu', 60, function () {
                return $this->getMenu(true);
            });
            $themes = Cache::remember('header_themes_ua', 24 * 60, function () {
                return $this->getThemes(true);
            });

            $header = view('layouts.header.ua')
                ->with(['block' => $this->block, 'cats' => $cats, 'themes' => $themes])->render();
        }

        $this->vars = array_add($this->vars, 'header', $header);
//============================== Header =====================================
//============================== Footer =====================================

        $tags = Cache::remember('tags_main', 60, function () {
            return Tag::select(['name', 'uname', 'alias'])->where(['approved' => 1])->skip(15)->take(15)->get();
        });

        $all_cats = Cache::remember('main_cats', 24 * 60, function () {
            return \Fresh\Medpravda\Category::get();
        });
        if (empty($this->loc)) {
            $med_tags = Cache::remember('med-tags', 24 * 60, function () {
                $meds = \Fresh\Medpravda\Medtag::take(14)->get();
                return \Fresh\Medpravda\Medicine::select('title', 'alias')->whereIn('alias', $meds->toArray())->get();
            });

            $copyright = Cache::remember('copyright', 24 * 60, function () {
                return About::find(7);
            });
            $footer = view('layouts.footer.ru')
                ->with(['cats' => $all_cats, 'tags' => $tags, 'med_tags' => $med_tags, 'copyright' => $copyright])
                ->render();
        } else {
            $med_tags = Cache::remember('med-tags', 24 * 60, function () {
                $meds = \Fresh\Medpravda\Medtag::take(14)->get();
                return \Fresh\Medpravda\Umedicine::select('title', 'alias')->whereIn('alias', $meds->toArray())->get();
            });
            $copyright = Cache::remember('ua_copyright', 24 * 60, function () {
                return About::find(8);
            });
            $footer = view('layouts.footer.ua')
                ->with(['cats' => $all_cats, 'tags' => $tags, 'med_tags' => $med_tags, 'copyright' => $copyright])
                ->render();
        }
        $this->vars = array_add($this->vars, 'footer', $footer);
//============================== Footer =====================================
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

    /**
     * @param $uri
     */
    public function getSeos($uri)
    {
        $rep = new \Fresh\Medpravda\Repositories\SeoRepository(new Seo());
        $this->seo = $rep->oneSeo($uri);
    }

    /**
     * @param $status
     * @return mixed
     */
    public function getMenu($status = false)
    {
        if ($status) {
            $cats = Menus::with('category')->where('own', 'ua')->get();
        } else {
            $cats = Menus::with('category')->where('own', 'ru')->get();
        }

        return Menu::make('menu', function ($menu) use ($cats, $status) {
            foreach ($cats as $cat) {
                $route = $status ? 'ua_' : '';
                $title = $status ? 'u' : '';
                $menu->add(str_limit($cat->category->{$title . 'title'}, 32), ['route' => [$route . 'articles_cat', $cat->category->alias]]);
            }
        });
    }

    /**
     * @param bool $status
     * @return mixed
     */
    public function getThemes($status = false)
    {
        if ($status) {
            $themes = \Fresh\Medpravda\Toptheme::select('title', 'link')->where([['approved', 1], ['loc', 'ua']])
                ->orderBy('priority', 'asc')->take(8)->get();
        } else {
            $themes = \Fresh\Medpravda\Toptheme::select('title', 'link')->where([['approved', 1], ['loc', 'ru']])
                ->orderBy('priority', 'asc')->take(8)->get();
        }

        return Menu::make('themes', function ($menu) use ($themes) {
            foreach ($themes as $cat) {
                $menu->add(str_limit($cat->title, 32))->link->href($cat->link);;
            }
        });
    }
}
