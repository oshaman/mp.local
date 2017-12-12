<?php

namespace Fresh\Medpravda\Http\Controllers;

use Fresh\Medpravda\Repositories\ArticlesRepository;
use Fresh\Medpravda\Repositories\BlockRepository;
use Fresh\Medpravda\Repositories\MedicinesCatsRepository;
use Fresh\Medpravda\Repositories\SeoRepository;
use Fresh\Medpravda\Repositories\SlidersRepository;
use Fresh\Medpravda\Repositories\TagsRepository;
use Fresh\Medpravda\Repositories\UarticlesRepository;
use Illuminate\Http\Request;
use Cache;
use DB;

class IndexController extends MainController
{
    protected $med_cat;
    protected $block_rep;
    protected $seo_rep;
    protected $a_rep;
    protected $ua_rep;
    protected $s_rep;
    protected $t_rep;

    public function __construct(
        MedicinesCatsRepository $medicinesCat,
        BlockRepository $blockRepository,
        SeoRepository $seo,
        ArticlesRepository $arep,
        SlidersRepository $srep,
        TagsRepository $trep,
        UarticlesRepository $uarep
    )
    {
        $this->med_cat = $medicinesCat;
        $this->block_rep = $blockRepository;
        $this->seo_rep = $seo;
        $this->a_rep = $arep;
        $this->s_rep = $srep;
        $this->t_rep = $trep;
        $this->ua_rep = $uarep;
    }

    public function main(Request $request, $loc = null)
    {
        //  Last Modified
        $lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `articles` WHERE `approved`=1');
        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);

        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }
//  Last Modified

        if ($loc) {
            $this->loc = $loc;
            $this->seo = $this->seo_rep->oneSeo('/ua');

            $this->content = Cache::remember('ua-main', 60, function () {

                $articles = [
                    'tops' => $this->ua_rep->getMain(5, 8),
                    'diets' => $this->ua_rep->getMain(3, 5),
                    'delusions' => $this->ua_rep->getMain(2, 5),
                    'intims' => $this->ua_rep->getMain(4, 8),
                    'fitotherapy' => $this->ua_rep->getMain(1, 4),
                ];

                $sliders = $this->s_rep->get(
                    ['description', 'text', 'path', 'alt', 'title', 'link'],
                    false, false,
                    ['approved' => 1, 'loc' => 'ua']
                );

                $tags = $this->t_rep->get(['name', 'uname', 'alias'], 15, false, ['approved' => 1]);

                $med_cats = $this->med_cat->get('*', false, false,
                    false, false, ['alias_1', 'alias_2', 'alias_3']);
                $blocks = $this->block_rep->get();

                return view('main.ua_content')
                    ->with([
                        'med_cats' => $med_cats, 'blocks' => $blocks, 'seo' => $this->seo, 'loc' => $this->loc,
                        'articles' => $articles, 'sliders' => $sliders, 'tags' => $tags,
                    ])
                    ->render();
            });
        } else {
            $this->seo = $this->seo_rep->oneSeo('/');

            $this->content = Cache::remember('main', 60, function () {

                $articles = [
                    'tops' => $this->a_rep->getMain(5, 8),
                    'diets' => $this->a_rep->getMain(3, 5),
                    'delusions' => $this->a_rep->getMain(2, 5),
                    'intims' => $this->a_rep->getMain(4, 8),
                    'fitotherapy' => $this->a_rep->getMain(1, 4),
                ];

                $sliders = $this->s_rep->get(
                    ['description', 'text', 'path', 'alt', 'title', 'link'],
                    false, false,
                    ['approved' => 1]
                );

                $tags = $this->t_rep->get(['name', 'alias'], 15, false, ['approved' => 1]);

                $med_cats = $this->med_cat->get('*', false, false,
                    false, false, ['alias_1', 'alias_2', 'alias_3']);
                $blocks = $this->block_rep->get();

                return view('main.content')
                    ->with([
                        'med_cats' => $med_cats, 'blocks' => $blocks, 'seo' => $this->seo, 'loc' => null,
                        'articles' => $articles, 'sliders' => $sliders, 'tags' => $tags,
                    ])
                    ->render();
            });
        }

        return $this->renderOutput();
    }
}
