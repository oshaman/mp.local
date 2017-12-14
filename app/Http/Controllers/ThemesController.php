<?php

namespace Fresh\Medpravda\Http\Controllers;

use Fresh\Medpravda\Repositories\ArticlesRepository;
use Fresh\Medpravda\Repositories\TagsRepository;
use Fresh\Medpravda\Repositories\ThemesRepository;
use Fresh\Medpravda\Repositories\UarticlesRepository;
use Illuminate\Http\Request;
use Cache;

class ThemesController extends MainController
{
    protected $repository;
    protected $rua_rep;
    protected $uaa_rep;
    protected $t_rep;

    public function __construct(
        ThemesRepository $themesRepository,
        ArticlesRepository $repository,
        UarticlesRepository $urepository,
        TagsRepository $trep
    )
    {
        $this->repository = $themesRepository;
        $this->rua_rep = $repository;
        $this->uaa_rep = $urepository;
        $this->t_rep = $trep;
    }

    public function uaThemes(Request $request)
    {
//       Last Modified
        /*$lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `topthemes` WHERE `loc`=\'ua\'');
        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);

        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }*/
//      Last Modified

        $this->loc = 'ua';
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $this->content = Cache::remember('ua-themes' . $currentPage, 60, function () {
            $themes = $this->repository->get('*', false, 8,
                [['approved', 1], ['loc', 'ua']], ['priority', 'asc']);
            return view('themes.show')->with(['themes' => $themes, 'loc' => true])
                ->render();
        });

        $this->title = 'Популярні теми';
        $this->getAside('ua');

        return $this->renderOutput();
    }

    public function themes(Request $request)
    {
        //       Last Modified
        /*$lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `topthemes` WHERE `loc`=\'ru\'');
        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);

        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }*/
//      Last Modified
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        Cache::flush();
        $this->content = Cache::remember('themes' . $currentPage, 60, function () {
            $themes = $this->repository->get('*', false, 8,
                [['approved', 1], ['loc', 'ru']], ['priority', 'asc']);
            return view('themes.show')->with(['themes' => $themes])
                ->render();
        });

        $this->title = 'Популярные темы';
        $this->getAside('ru');

        return $this->renderOutput();
    }

    /**
     * @param $loc
     * @param bool $cat
     */
    public function getAside($loc)
    {
        $where = [['approved', 1]];

        $tags = $this->t_rep->get(['name', 'uname', 'alias'], 15, false, ['approved' => 1]);
        if ('ru' == $loc) {
            $articles = $this->rua_rep->get(['title', 'alias', 'description', 'category_id'], 8, false,
                $where, ['priority', 'desc'], ['image']);
            $this->aside = view('articles.aside')->with(['articles' => $articles, 'tags' => $tags])->render();
        } else {
            $articles = $this->uaa_rep->get(['title', 'alias', 'description', 'category_id'], 8, false,
                $where, ['priority', 'desc'], ['image']);
            $this->aside = view('articles.ua_aside')->with(['articles' => $articles, 'tags' => $tags])->render();
        }

    }
}
