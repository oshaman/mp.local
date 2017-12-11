<?php

namespace Fresh\Medpravda\Http\Controllers;

use Fresh\Medpravda\Category;
use Fresh\Medpravda\Repositories\ArticlesRepository;
use Fresh\Medpravda\Repositories\TagsRepository;
use Fresh\Medpravda\Repositories\UarticlesRepository;
use Fresh\Medpravda\Tag;
use Illuminate\Http\Request;
use Cache;

class ArticlesController extends MainController
{
    protected $rua_rep;
    protected $uaa_rep;
    protected $t_rep;

    public function __construct(ArticlesRepository $repository, UarticlesRepository $urepository, TagsRepository $trep)
    {
        $this->rua_rep = $repository;
        $this->uaa_rep = $urepository;
        $this->t_rep = $trep;
    }

    public function show(Request $request, $article = null, $loc = null)
    {
        Cache::store('file')->flush();

        if ($article) {
            //            Last Modify
            /*$LastModified_unix = strtotime($article->updated_at); // время последнего изменения страницы
            $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
            $IfModifiedSince = false;
            if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
                $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
            }
            if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
                return response('304 Not Modified', 304);
            }*/
//            Last Modify
            $article->increment('view');

            $cat_id = $article->category_id;

            $article = Cache::store('file')->remember('ru_article-' . $article->id, 60, function () use ($article) {
                if (!empty($article->seo)) {
                    $article->seo = $this->rua_rep->convertSeo($article->seo);
                } else {
                    $article->seo = new \stdClass();
                }
                $article->created = $this->rua_rep->convertDate($article->created_at);
                $article->load('category');
                $article->load('tags');
                $article->load('image');
                $article->seo->og_image = asset('/asset/images/articles/ru/main') . '/' . ($article->image->path ?? '../../../mp.png');

                if (empty($article->seo->og_description)) {
                    $article->seo->og_description = str_limit(strip_tags($article->content), 240);
                }

                if (empty($article->seo->og_title)) {
                    $article->seo->og_title = str_limit(strip_tags($article->title), 240);
                }

                return $article;
            });


//            dd($article);
            $where = ['category_id' => $article->category_id, 'approved' => 1];
            $same = $this->rua_rep->get('*', 5, false, $where, false, ['image']);
//            dd($same[0]);
            if (5 == $cat_id) {
                $this->getAside('ru', true);
            } else {
                $this->getAside('ru');
            }
            $this->content = view('articles.article')->with(['article' => $article, 'same' => $same])
                ->render();
            return $this->renderOutput();
        }

        $cat = Category::where('id', 5)->first();
        $articles = $this->rua_rep->get('*', false, 9, ['category_id' => 5, 'approved' => 1],
            ['created_at', 'desc'], ['image', 'tags']);

        $this->getAside('ru');
        $this->content = view('articles.show')->with(['articles' => $articles, 'cat' => $cat])
            ->render();
        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @param $cat_alias
     * @param $loc
     * @return $this
     */
    public function cats(Request $request, $cat_alias)
    {
//  Last Modified
        /*$lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `articles` WHERE `approved`=1');

        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }*/
//  Last Modified
        if (empty($cat_alias)) {
            $cat_alias = 'top-stati';
        }

        $cat = Category::where('alias', $cat_alias)->first();

        if (null == $cat) {
            abort(404);
        }
        $this->title = $cat->name;

        $articles = $this->rua_rep->get('*', false, 9, ['category_id' => $cat->id, 'approved' => 1], ['created_at', 'desc'], ['image', 'tags']);

        if (5 == $cat->id) {
            $this->getAside('ru', true);
        } else {
            $this->getAside('ru');
        }

        $this->content = view('articles.show')->with(['articles' => $articles, 'cat' => $cat])
            ->render();
        return $this->renderOutput();

    }

    public function tag(Request $request, $tag_alias)
    {
        //  Last Modified
        /*$lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `articles` WHERE `approved`=1');

        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }*/
//  Last Modified
        Cache::flush();
        $tag = Tag::where('alias', $tag_alias)->first();

        if (null == $tag) {
            abort(404);
        }

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $this->content = Cache::remember('articles_tags' . $tag->alias . $currentPage, 60, function () use ($tag) {
            $articles = $this->rua_rep->getByTag($tag->id);
            return view('articles.show')
                ->with(['articles' => $articles, 'tag' => $tag])
                ->render();
        });
//        $this->getSeo('statyi/teg');
        $this->title = $tag->name;

        $this->getAside('ru');

        return $this->renderOutput();
    }


//    UA================================================>
    public function uaShow(Request $request, $article = null)
    {
        Cache::store('file')->flush();

        if ($article) {
            //            Last Modify
            /*$LastModified_unix = strtotime($article->updated_at); // время последнего изменения страницы
            $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
            $IfModifiedSince = false;
            if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
                $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
            }
            if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
                return response('304 Not Modified', 304);
            }*/
//            Last Modify
            $this->loc = 'ua';

            $article->increment('view');
            $cat_id = $article->category_id;
//dd($article);

            $article = Cache::store('file')->remember('ua_article-' . $article->id, 60, function () use ($article) {
                if (!empty($article->seo)) {
                    $article->seo = $this->uaa_rep->convertSeo($article->seo);
                } else {
                    $article->seo = new \stdClass();
                }
                $article->created = $this->uaa_rep->convertDate($article->created_at);
                $article->load('category');
                $article->load('tags');
                $article->load('image');
                $article->seo->og_image = asset('/asset/images/articles/ua/main') . '/' . ($article->image->path ?? '../../../mp.png');

                if (empty($article->seo->og_description)) {
                    $article->seo->og_description = str_limit(strip_tags($article->content), 240);
                }

                if (empty($article->seo->og_title)) {
                    $article->seo->og_title = str_limit(strip_tags($article->title), 240);
                }

                return $article;
            });


//            dd($article);
            $where = ['category_id' => $article->category_id, 'approved' => 1];
            $same = $this->uaa_rep->get('*', 5, false, $where, false, ['image']);
//            dd($same[0]);

            if (5 == $cat_id) {
                $this->getAside('ua', true);
            } else {
                $this->getAside('ua');
            }

            $this->content = view('articles.ua_article')->with(['article' => $article, 'same' => $same])
                ->render();
            return $this->renderOutput();
        }
        $this->loc = 'ua';

        $cat = Category::where('id', 1)->first();
        $articles = $this->uaa_rep->get('*', false, 9, ['category_id' => 4, 'approved' => 1],
            ['created_at', 'desc'], ['image', 'tags']);

//        dd($articles);
        $this->getAside('ua');
        $this->content = view('articles.ua_show')->with(['articles' => $articles, 'cat' => $cat])
            ->render();
        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @param $cat_alias
     * @param $loc
     * @return $this
     */
    public function uaCats(Request $request, $cat_alias)
    {
//  Last Modified
        /*$lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `articles` WHERE `approved`=1');

        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }*/
//  Last Modified
        $this->loc = 'ua';

        $cat = Category::where('alias', $cat_alias)->first();

        if (null == $cat) {
            abort(404);
        }

        $articles = $this->uaa_rep->get('*', false, 9,
            ['category_id' => $cat->id, 'approved' => 1], ['created_at', 'desc'], ['image', 'tags']);

//        dd($articles);
        if (5 == $cat->id) {
            $this->getAside('ua', true);
        } else {
            $this->getAside('ua');
        }
        $this->content = view('articles.ua_show')->with(['articles' => $articles, 'cat' => $cat])
            ->render();
        return $this->renderOutput();

    }

    public function uaTag(Request $request, $tag_alias, $loc = null)
    {
        //  Last Modified
        /*$lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `articles` WHERE `approved`=1');

        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }*/
//  Last Modified
        $this->loc = 'ua';

        $tag = Tag::where('alias', $tag_alias)->first();

        if (null == $tag) {
            abort(404);
        }

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $this->content = Cache::remember('articles_tags' . $tag->alias . $currentPage, 60, function () use ($tag) {
            $articles = $this->uaa_rep->getByTag($tag->id);
            return view('articles.ua_show')
                ->with(['articles' => $articles, 'tag' => $tag])
                ->render();
        });
//        $this->getSeo('statyi/teg');
        $this->title = $tag->uname;
        $this->getAside('ua');

        return $this->renderOutput();
    }


    public function getAside($loc, $cat = false)
    {
        if ($cat) {
            $where = [['approved', 1], ['category_id', '<>', 5]];
        } else {
            $where = [['approved', 1], ['category_id', 5]];
        }

        $tags = $this->t_rep->get(['name', 'uname', 'alias'], 15, false, ['approved' => 1]);
        if ('ru' == $loc) {
            $articles = $this->rua_rep->get(['title', 'alias', 'description', 'category_id'], 8, false,
                $where, ['priority', 'desc'], ['image']);
            $this->aside = view('articles.aside')->with(['articles' => $articles, 'tags' => $tags])->render();
        } else {
            $articles = $this->uaa_rep->get(['title', 'alias', 'description'], 8, false,
                $where, ['priority', 'desc'], ['image']);
            $this->aside = view('articles.ua_aside')->with(['articles' => $articles, 'tags' => $tags])->render();
        }

    }
}
