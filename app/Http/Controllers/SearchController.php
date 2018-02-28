<?php

namespace Fresh\Medpravda\Http\Controllers;

use Fresh\Medpravda\ClassificationStatistic;
use Fresh\Medpravda\Medicinemap;
use Fresh\Medpravda\Repositories\ArticlesRepository;
use Fresh\Medpravda\Repositories\ClassificationRepository;
use Fresh\Medpravda\Repositories\FabricatorsRepository;
use Fresh\Medpravda\Repositories\InnRepository;
use Fresh\Medpravda\Repositories\PharmRepository;
use Fresh\Medpravda\Repositories\SearchRepository;
use Fresh\Medpravda\Repositories\SubstanceRepository;
use Fresh\Medpravda\Repositories\UarticlesRepository;
use Fresh\Medpravda\Seo;
use Illuminate\Http\Request;
use Cache;
use DB;
use Crawler;

class SearchController extends MainController
{
    protected $search_rep;
    protected $c_rep;
    protected $a_rep;
    protected $ua_rep;
    protected $pharm_rep;
    protected $fabricator_rep;
    protected $substance_rep;
    protected $inn_rep;

    /**
     * SearchController constructor.
     * @param SearchRepository $mrep
     * @param ClassificationRepository $classificationRepository
     */
    public function __construct(
        SearchRepository $mrep,
        ClassificationRepository $classificationRepository,
        ArticlesRepository $arep,
        UarticlesRepository $uarep,
        PharmRepository $pharmRepository,
        FabricatorsRepository $fabricatorsRepository,
        SubstanceRepository $substanceRepository,
        InnRepository $innRepository
    )
    {
        $this->search_rep = $mrep;
        $this->c_rep = $classificationRepository;
        $this->a_rep = $arep;
        $this->ua_rep = $uarep;
        $this->pharm_rep = $pharmRepository;
        $this->fabricator_rep = $fabricatorsRepository;
        $this->substance_rep = $substanceRepository;
        $this->inn_rep = $innRepository;
    }

    /**
     * @param Request $request
     * @param null $val
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request, $val = null)
    {
        $this->title = 'Поиск препаратов';

        $this->getAside('ru');

        if ($request->isMethod('post')) {

            if ($request->filled('stats')) return redirect()->back();
            $result = $this->search_rep->get($request);

            if (is_array($result) && !empty($result['error'])) {
                return redirect()->route('search')->withErrors($result['error']);
            }
            $this->content = view('search.show')
                ->with(['titles' => $result, 'search' => $request->get('search')])
                ->render();
            return $this->renderOutput();
        }

        if (null != $val) {
            $result = $this->search_rep->getMedicine($val);

            if (is_array($result) && !empty($result['error'])) {
                return redirect()->route('search')->withErrors($result['error']);
            }
            $meds['medicines'] = $result;

            $this->content = view('search.show')
                ->with(['titles' => $meds, 'search' => $val])
                ->render();
            return $this->renderOutput();
        }

        $rep = new \Fresh\Medpravda\Repositories\SeoRepository(new Seo());
        $this->seo = $rep->oneSeo('poisk');
        $this->content = view('search.show')->render();
        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function presearch(Request $request)
    {
        if ($request->isMethod('post')) {
            $result = $this->search_rep->getSearch($request);

//            var_dump($result);die;
            return $this->content = view('search.result')->with(['result' => $result])->render();
        } else {
            return $this->content = view('search.result')->render();
        }
    }

    /**
     * @param Request $request
     * @return $this|view
     */
    public function show(Request $request)
    {
        return redirect(route('search_alpha'), 301);
    }

    /**
     * @param null $val
     * @return $this
     */
    public function alpha($val = null)
    {
        $this->title = 'Поиск препаратов по алфавиту';

        $alphabet = Cache::remember('alphabet', 24 * 60, function () {
            return $this->search_rep->getFirstLetters();
        });

        if (mb_strlen($val) == 1) {
            $list = Cache::remember('second-alphabet-' . $val, 24 * 60, function () use ($val) {
                return $this->search_rep->getSecondLetters($val);
            });
        }
        if (!empty($list)) {
            $this->content = view('search.alpha')->with(['letters' => $list, 'alphabet' => $alphabet])->render();
            $this->getAside('ru');
            return $this->renderOutput();
        }
        $medicines = null;
        $letter = null;
        if (!empty($val)) {
            $medicines = $this->search_rep->findByLetter($val);

            if ($medicines->isNotEmpty()) {
                $letter = $val;
            }
        }

        $this->content = Cache::remember('alpha-' . $letter, 24 * 60, function () use ($medicines, $letter, $alphabet) {
            return view('search.alpha')
                ->with(['medicines' => $medicines, 'letter' => $letter, 'alphabet' => $alphabet])
                ->render();
        });

        $this->getAside('ru');
        $this->getSeos('sort/alfavit');
        return $this->renderOutput();
    }

    /**
     *
     * @param null $val
     * @param null $fabricator
     * @return $this
     */
    public function fabricator(Request $request, $val = null, $fabricator = null)
    {
        //          Last Modified
        $lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `medicines` WHERE `approved`=1');

        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix && !$request->session()->has('new_csrf')) {
            return response('304 Not Modified', 304);
        }
//           Last Modified
        $this->title = 'Поиск препаратов по производителю';

        $alphabet = Cache::remember('alpha_fabricator', 60, function () {
            return $this->search_rep->getFabricatorLetters();
        });

        if (!empty($fabricator)) {

            $model = $this->fabricator_rep->one($fabricator);
//            dd($pharm);
            if (null == $model) {
                abort(404);
            }

            $this->seo = Cache::store('file')->remember('fabricator-seo-' . $fabricator, 24 * 60, function () use ($model) {
                return $this->pharm_rep->obtainSeo($model);
            });

            $this->content = Cache::store('file')
                ->remember('medicine-fabricator-' . $fabricator, 60, function () use ($model, $val, $alphabet) {
                    $result = $this->search_rep->findByFabricator($model);
                    $medicines = $result['medicines'] ?? null;

                    return view('search.fabricator')
                        ->with(['medicines' => $medicines, 'fabricator' => $model, 'val' => $val, 'alphabet' => $alphabet])
                        ->render();
                });
        } elseif (!empty($val)) {

            $this->content = Cache::store('file')
                ->remember('medicine-fabricators-' . $val, 60, function () use ($val, $alphabet) {
                    $fabricators = $this->search_rep->findFabricator($val);
                    return view('search.fabricator')->with(['fabricators' => $fabricators, 'val' => $val, 'alphabet' => $alphabet])
                        ->render();
                });
        } else {
            $this->content = Cache::remember('sort-fabricators', 24 * 60, function () use ($alphabet) {
                return view('search.fabricator')->with(['alphabet' => $alphabet])->render();
            });
        }

        $this->getAside('ru');
        return $this->renderOutput();

    }

    /**
     * @param Request $request
     *
     * @param null $val
     * @return $this
     */
    public function mnn(Request $request, $val = null)
    {
        //          Last Modified
        $lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `umedicines` WHERE `approved`=1');

        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix && !$request->session()->has('new_csrf')) {
            return response('304 Not Modified', 304);
        }
//           Last Modified
        $this->title = 'Поиск препаратов по международному названию';

        $mnns = null;
        $mnn = $request->get('mnn');

        $alphabet = Cache::remember('mnn_alpha', 24 * 60, function () {
            return $this->search_rep->getMnnLetters();
        });

        if ($request->has('mnn') && 1 == strlen($mnn)) {

            $this->content = Cache::store('file')->remember('medicine-mnns-' . $mnn, 60, function () use ($mnn, $alphabet) {
                $mnns = $this->search_rep->findMnn($mnn);


                return view('search.mnn')->with(['mnns' => $mnns, 'alphabet' => $alphabet])->render();
            });

        } elseif (!empty($val)) {

            $model = $this->inn_rep->one($val);
            if (null == $model) {
                abort(404);
            }

            $this->seo = Cache::store('file')->remember('inn-seo-' . $val, 24 * 60, function () use ($model) {
                return $this->inn_rep->obtainSeo($model);
            });

            $this->content = Cache::store('file')->remember('medicine-mnns-' . $val, 60, function () use ($model, $alphabet) {
                $result = $this->search_rep->findByMnn($model);

                return view('search.mnn')
                    ->with(['medicines' => $result['medicines'], 'mnn' => $model, 'alphabet' => $alphabet])
                    ->render();
            });
        } else {

            $this->content = view('search.mnn')->with(['alphabet' => $alphabet])->render();
        }

        $this->getAside('ru');

        return $this->renderOutput();

    }

    /**
     *
     * @param null $val
     * @return $this
     */
    public function atx(Request $request, $val = null)
    {
        $this->title = 'Сортировка препаратов по АТХ-классификации';

        if (!empty($val)) {

            $count = $this->c_rep->atxIsset($val);

            if ($count > 0) {
                if (!Crawler::isCrawler()) {
                    $stats = new ClassificationStatistic();

                    $stats->fill(['class_alias' => $val, 'created_at' => date('Y-m-d H:i:s')]);
                    $stats->save();
                }
//          Last Modified
                $lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `medicines` WHERE `approved`=1');

                $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
                $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
                $IfModifiedSince = false;
                if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
                    $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
                }
                if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix && !$request->session()->has('new_csrf')) {
                    return response('304 Not Modified', 304);
                }
//           Last Modified

                $this->seo = Cache::store('file')->remember('atx-seo-' . $val, 24 * 60, function () use ($val) {
                    $model = $this->c_rep->getClass($val);
                    return $this->c_rep->obtainSeo($model);
                });

                $this->content = Cache::store('file')->remember('sort-atx-' . $val, 24 * 60, function () use ($val) {

                    $result = $this->search_rep->findAtxChildren($val, true);
                    $classifications = $result['medicines'] ?? null;
                    $atx = $result['class'] ?? null;

                    if (!empty($result['class']->id)) {
                        $classes = $this->c_rep->getParents($result['class']->id);

                        return view('search.atx')->with(
                            ['classifications' => $classifications,
                                'atx' => $atx, 'classes' => $classes, 'letter' => $val])
                            ->render();
                    }
                });
            } else {
                return redirect()->back();
            }

        } else {
            $parents = $this->search_rep->findAtxParents();
            $this->content = view('search.atx')
                ->with(
                    ['parents' => $parents, 'letter' => $val])
                ->render();
        }

        $this->getAside('ru');
        return $this->renderOutput();

    }

    /**
     * @param Request $request
     *
     * @param null $val
     * @return $this
     */
    public function farm(Request $request, $val = null)
    {
        //          Last Modified
        $lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `pharmagroups`');

        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix && !$request->session()->has('new_csrf')) {
            return response('304 Not Modified', 304);
        }
//           Last Modified
        $this->title = 'Поиск препаратов по фармакологической группе';

        $alphabet = Cache::remember('alpha_pharma', 60, function () {
            return $this->search_rep->getPharmLetters();
        });

        if ($request->has('farmgroup') && (2 >= strlen($request->get('farmgroup')))) {

            $farm = $request->get('farmgroup');
            $this->content = Cache::store('file')->remember('sort-farm-' . $farm, 60, function () use ($farm, $alphabet) {
                $farms = $this->search_rep->findPharmGroups($farm);
                return view('search.pharmagroup')->with(['farms' => $farms, 'alphabet' => $alphabet])->render();
            });
        } elseif (!empty($val)) {

            $pharm = $this->pharm_rep->one($val);
//            dd($pharm);
            if (null == $pharm) {
                abort(404);
            }

            $this->seo = Cache::store('file')->remember('farm-seo-' . $val, 24 * 60, function () use ($pharm) {
                return $this->pharm_rep->obtainSeo($pharm);
            });
            $this->content = Cache::store('file')->remember('sort-farms-' . $val, 60, function () use ($pharm, $alphabet) {
                $result = $this->search_rep->findByPharma($pharm);
                return view('search.pharmagroup')
                    ->with(['medicines' => $result['medicines'], 'farm' => $result['pharma'], 'alphabet' => $alphabet])
                    ->render();
            });
        } else {
            $this->content = view('search.pharmagroup')->with(['alphabet' => $alphabet])->render();
        }

        $this->getAside('ru');

        return $this->renderOutput();

    }

    /**
     * @param Request $request
     *
     * @param null $val
     * @return $this
     */
    public function substance(Request $request, $val = null)
    {

        $this->title = 'Поиск препаратов по действующему веществу';

        $substances = null;

        if ($request->has('substance') && (2 >= strlen($request->get('substance')))) {
            $substances = $this->search_rep->findSubstances($request->get('substance'));
        }

        $result = null;
        $model = null;
        if (!empty($val)) {

            $model = $this->substance_rep->one($val);
//            dd($pharm);
            if (null == $model) {
                abort(404);
            }

            $this->seo = Cache::store('file')->remember('substance-seo-' . $val, 24 * 60, function () use ($model) {
                return $this->substance_rep->obtainSeo($model);
            });

            $result = Cache::remember('substance-sort-' . $val, 24 * 60, function () use ($model) {
                return $this->search_rep->findBySubstance($model);
            });
        }

        $alphabet = Cache::remember('alpha_substance', 60, function () {
            return $this->search_rep->getSubstanceLetters();
        });

        $this->content = view('search.substance')
            ->with([
                'medicines' => $result['medicines'],
                'substances' => $substances,
                'substance' => $model,
                'alphabet' => $alphabet
            ])->render();
        $this->getAside('ru');

        return $this->renderOutput();

    }

    /*************************************************************/
    /**
     * @param $loc
     * @param null $val
     * @return $this
     */
    public function alphau($val = null)
    {
        $this->loc = 'ua';
        $this->title = 'Пошук препаратів за алфавітом';
        $alphabet = Cache::remember('alphabet-ua', 24 * 60, function () {
            return $this->search_rep->getFirstLetters(true);
        });

        if (mb_strlen($val) == 1) {
            $list = Cache::remember('second-alphabet-ua-' . $val, 24 * 60, function () use ($val) {
                return $this->search_rep->getSecondLetters($val, true);
            });
        }

        if (!empty($list)) {
            $this->content = view('search.ua_alpha')->with(['letters' => $list, 'alphabet' => $alphabet])->render();

            $this->getAside('ua');
            return $this->renderOutput();
        }
        $medicines = null;
        $letter = null;
        if (!empty($val)) {
            $medicines = $this->search_rep->findByLetter($val, true);

            if ($medicines->isNotEmpty()) {
                $letter = $val;
            }
        }

        $this->content = Cache::remember('alpha-ua-' . $letter, 24 * 60, function () use ($medicines, $letter, $alphabet) {
            return view('search.ua_alpha')
                ->with(['medicines' => $medicines, 'letter' => $letter, 'alphabet' => $alphabet])
                ->render();
        });

        $this->getAside('ua');
        $this->getSeos('ua/sort/alfavit');

        return $this->renderOutput();
    }

    /**
     * @param $loc
     * @param null $val
     * @param null $fabricator
     * @return $this
     */
    public function fabricatoru(Request $request, $val = null, $fabricator = null)
    {

//          Last Modified
        $lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `medicines` WHERE `approved`=1');

        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix && !$request->session()->has('new_csrf')) {
            return response('304 Not Modified', 304);
        }
//           Last Modified
        $this->title = 'Пошук препаратів за виробником';
        $this->loc = 'ua';

        $alphabet = Cache::remember('alpha_fabricator_ua', 60, function () {
            return $this->search_rep->getFabricatorLetters(true);
        });

        if (!empty($fabricator)) {

            $model = $this->fabricator_rep->one($fabricator);

            if (null == $model) {
                abort(404);
            }

            $this->seo = Cache::store('file')->remember('ua-fabricator-seo-' . $fabricator, 24 * 60, function () use ($model) {
                return $this->pharm_rep->obtainSeo($model, true);
            });

            $this->content = Cache::store('file')
                ->remember('ua-medicine-fabricator-' . $fabricator, 60, function () use ($model, $val, $alphabet) {
                    $result = $this->search_rep->findByFabricator($model, true);
                    $medicines = $result['medicines'] ?? null;

                    return view('search.ua_fabricator')
                        ->with(['medicines' => $medicines, 'fabricator' => $model, 'val' => $val, 'alphabet' => $alphabet])
                        ->render();
                });
        } elseif (!empty($val)) {
            $this->content = Cache::store('file')
                ->remember('ua-medicine-fabricators-' . $val, 60, function () use ($val, $alphabet) {
                    $fabricators = $this->search_rep->findFabricator($val, true);
                    return view('search.ua_fabricator')->with(['fabricators' => $fabricators, 'val' => $val, 'alphabet' => $alphabet])
                        ->render();
                });
        } else {
            $this->content = Cache::remember('ua-sort-fabricators', 24 * 60, function () use ($alphabet) {
                return view('search.ua_fabricator')->with(['alphabet' => $alphabet])->render();
            });
        }

        $this->getAside('ua');
        return $this->renderOutput();

    }

    /**
     * @param Request $request
     * @param $loc
     * @param null $val
     * @return $this
     */
    public function mnnu(Request $request, $val = null)
    {
//          Last Modified
        $lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `umedicines` WHERE `approved`=1');

        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix && !$request->session()->has('new_csrf')) {
            return response('304 Not Modified', 304);
        }
//           Last Modified
        $this->title = 'Пошук препаратів за міжнародною назвою';
        $this->loc = 'ua';
        $mnns = null;
        $mnn = $request->get('mnn');

        $alphabet = Cache::remember('mnn_alpha', 24 * 60, function () {
            return $this->search_rep->getMnnLetters();
        });

        if ($request->has('mnn') && 1 == strlen($mnn)) {
            $this->content = Cache::store('file')->remember('ua-medicine-mnns-' . $mnn, 60, function () use ($mnn, $alphabet) {
                $mnns = $this->search_rep->findMnn($mnn);

                return view('search.ua_mnn')->with(['mnns' => $mnns, 'alphabet' => $alphabet])->render();
            });

        } elseif (!empty($val)) {

            $model = $this->inn_rep->one($val);
//            dd($pharm);
            if (null == $model) {
                abort(404);
            }

            $this->seo = Cache::store('file')->remember('ua-inn-seo-' . $val, 24 * 60, function () use ($model) {
                return $this->inn_rep->obtainSeo($model, true);
            });

            $this->content = Cache::store('file')->remember('ua-medicine-mnns-' . $val, 60, function () use ($model, $alphabet) {
                $result = $this->search_rep->findByMnn($model);

                return view('search.ua_mnn')
                    ->with(['medicines' => $result['medicines'], 'mnn' => $model, 'alphabet' => $alphabet])
                    ->render();
            });
        } else {
            $this->content = view('search.ua_mnn')->with(['alphabet' => $alphabet])->render();
        }

        $this->getAside('ua');

        return $this->renderOutput();

    }

    /**
     * @param $loc
     * @param null $val
     * @return $this
     */
    public function atxu(Request $request, $val = null)
    {
        $this->title = 'Сортування препаратів за АТХ-класифікацією';

        $count = $this->c_rep->atxIsset($val);
        $this->loc = 'ua';

        if ($count > 0) {
            if (!Crawler::isCrawler()) {
                $stats = new ClassificationStatistic();

                $stats->fill(['class_alias' => $val, 'created_at' => date('Y-m-d H:i:s')]);
                $stats->save();
            }
//          Last Modified
            $lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `medicines` WHERE `approved`=1');

            $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
            $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
            $IfModifiedSince = false;
            if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
                $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
            }
            if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix && !$request->session()->has('new_csrf')) {
                return response('304 Not Modified', 304);
            }
//           Last Modified

            $this->seo = Cache::store('file')->remember('ua-atx-seo-' . $val, 24 * 60, function () use ($val) {
                $model = $this->c_rep->getClass($val);
                return $this->c_rep->obtainSeo($model, true);
            });

            $this->content = Cache::store('file')->remember('sort-ua-atx-' . $val, 24 * 60, function () use ($val) {

                $result = $this->search_rep->findAtxChildren($val, true);
                $classifications = $result['medicines'] ?? null;
                $atx = $result['class'] ?? null;

                if (!empty($result['class']->id)) {
                    $classes = $this->c_rep->getParents($result['class']->id);

                    return view('search.ua_atx')->with(
                        ['classifications' => $classifications,
                            'atx' => $atx, 'classes' => $classes, 'letter' => $val])
                        ->render();
                }
            });
        } else {
            $parents = $this->search_rep->findAtxParents();
            $this->content = view('search.ua_atx')
                ->with(
                    ['parents' => $parents, 'letter' => $val])
                ->render();
        }


        $this->getAside('ua');

        return $this->renderOutput();

    }

    /**
     * @param Request $request
     * @param $loc
     * @param null $val
     * @return $this
     */
    public function farmu(Request $request, $val = null)
    {
        //          Last Modified
        $lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `medicines` WHERE `approved`=1');

        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix && !$request->session()->has('new_csrf')) {
            return response('304 Not Modified', 304);
        }
//           Last Modified
        $this->title = 'Сортування за фармокологічною групою';

        $this->loc = 'ua';

        $alphabet = Cache::remember('alpha_pharma_ua', 60, function () {
            return $this->search_rep->getPharmLetters(true);
        });

        if ($request->has('farmgroup') && (2 >= strlen($request->get('farmgroup')))) {
            $farm = $request->get('farmgroup');
            $this->content = Cache::store('file')->remember('ua-sort-farm-' . $farm, 60, function () use ($farm, $alphabet) {
                $farms = $this->search_rep->findPharmGroups($farm, true);
                return view('search.ua_pharmagroup')->with(['farms' => $farms, 'alphabet' => $alphabet])->render();
            });
        } elseif (!empty($val)) {
            $pharm = $this->pharm_rep->one($val);

            if (null == $pharm) {
                abort(404);
            }

            $this->seo = Cache::store('file')->remember('farm-seo-ua-' . $val, 24 * 60, function () use ($pharm) {
                return $this->pharm_rep->obtainSeo($pharm, true);
            });

            $this->content = Cache::store('file')->remember('ua-sort-farms-' . $val, 60, function () use ($pharm, $alphabet) {
                $result = $this->search_rep->findByPharma($pharm, true);
                return view('search.ua_pharmagroup')
                    ->with(['medicines' => $result['medicines'], 'farm' => $result['pharma'], 'alphabet' => $alphabet])
                    ->render();
            });
        } else {
            $this->content = view('search.ua_pharmagroup')->with(['alphabet' => $alphabet])->render();
        }

        $this->getAside('ua');

        return $this->renderOutput();

    }

    /**
     * @param Request $request
     * @param $loc
     * @param null $val
     * @return $this
     */
    public function substanceu(Request $request, $val = null)
    {

        $this->title = 'Сортування за діючою речовиною';

        $this->loc = 'ua';

        $substances = null;

        if ($request->has('substance') && (2 >= strlen($request->get('substance')))) {
            $substances = $this->search_rep->findSubstances($request->get('substance'), true);
        }

        $result = null;
        $model = null;
        if (!empty($val)) {
            $model = $this->substance_rep->one($val);
//            dd($pharm);
            if (null == $model) {
                abort(404);
            }

            $this->seo = Cache::store('file')->remember('ua-substance-seo-' . $val, 24 * 60, function () use ($model) {
                return $this->substance_rep->obtainSeo($model, true);
            });

            $result = Cache::remember('ua-substance-sort-' . $val, 24 * 60, function () use ($model) {
                return $this->search_rep->findBySubstance($model, true);
            });
        }

        $alphabet = Cache::remember('alpha_substance_ua', 60, function () {
            return $this->search_rep->getSubstanceLetters(true);
        });

//        dd($substances[0]);

        $this->content = view('search.ua_substance')
            ->with([
                'medicines' => $result['medicines'],
                'substances' => $substances,
                'substance' => $model,
                'alphabet' => $alphabet
            ])
            ->render();
        $this->getAside('ua');

        return $this->renderOutput();

    }

    /**
     * @param $loc
     */
    public function getAside($loc)
    {
        if ('ru' == $loc) {
            $this->aside = Cache::remember('sort-aside-ru', 60, function () {
                $articles = $this->a_rep->get(['title', 'alias', 'description'], 8, false,
                    [['approved', 1]], ['priority', 'desc'], ['image']);
                return view('medicines.aside')->with(['articles' => $articles])->render();
            });
        } else {
            $this->aside = Cache::remember('sort-aside-ua', 60, function () {
                $articles = $this->ua_rep->get(['title', 'alias', 'description'], 8, false,
                    [['approved', 1]], ['priority', 'desc'], ['image']);
                return view('medicines.ua_aside')->with(['articles' => $articles])->render();
            });
        }

    }
}
