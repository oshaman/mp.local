<?php

namespace Fresh\Medpravda\Http\Controllers;

use Fresh\Medpravda\ClassificationStatistic;
use Fresh\Medpravda\Medicinemap;
use Fresh\Medpravda\Repositories\ArticlesRepository;
use Fresh\Medpravda\Repositories\ClassificationRepository;
use Fresh\Medpravda\Repositories\SearchRepository;
use Fresh\Medpravda\Repositories\UarticlesRepository;
use Illuminate\Http\Request;
use Cache;

class SearchController extends MainController
{
    protected $search_rep;
    protected $c_rep;
    protected $a_rep;
    protected $ua_rep;

    /**
     * SearchController constructor.
     * @param SearchRepository $mrep
     * @param ClassificationRepository $classificationRepository
     */
    public function __construct(
        SearchRepository $mrep,
        ClassificationRepository $classificationRepository,
        ArticlesRepository $arep,
        UarticlesRepository $uarep
    )
    {
        $this->search_rep = $mrep;
        $this->c_rep = $classificationRepository;
        $this->a_rep = $arep;
        $this->ua_rep = $uarep;
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
            dd($result);
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
            $this->content = view('search.result')->render();
        }

        return $this->renderOutput();
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

        if (str_limit($val) < 2) {
            $list = config('search.' . $val);
        }

        if (!empty($list)) {
            $this->content = view('search.alpha')->with('letters', $list)->render();
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

        $this->content = Cache::remember('alpha-' . $letter, 24 * 60, function () use ($medicines, $letter) {
            return view('search.alpha')->with(['medicines' => $medicines, 'letter' => $letter])->render();
        });

        $this->getAside('ru');
        return $this->renderOutput();
    }

    /**
     *
     * @param null $val
     * @param null $fabricator
     * @return $this
     */
    public function fabricator($val = null, $fabricator = null)
    {

        $this->title = 'Поиск препаратов по производителю';

        $medicines = null;
        $fabricators = null;
        $fabricator_name = null;

        if (!empty($fabricator)) {

            $result = Cache::store('file')->remember('medicine-fabricator-' . $fabricator, 60, function () use ($fabricator) {
                return $this->search_rep->findByFabricator($fabricator);
            });

            $medicines = $result['medicines'] ?? null;
            $fabricator_name = $result['fabricator'] ?? null;
        } elseif (!empty($val)) {
            $fabricators = $this->search_rep->findFabricator($val);
        }

//        dd($fabricators);


        $this->content = view('search.fabricator')
            ->with(['medicines' => $medicines, 'fabricators' => $fabricators, 'fabricator' => $fabricator_name, 'val' => $val])
            ->render();
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

        $this->title = 'Поиск препаратов по международному названию';

        $mnns = null;
        $mnn = $request->get('mnn');
        if ($request->has('mnn') && 1 == strlen($mnn)) {
            $mnns = Cache::store('file')->remember('medicine-mnns-' . $mnn, 60, function () use ($mnn) {
                return $this->search_rep->findMnn($mnn);
            });
        }

        $result = null;
        if (!empty($val)) {
            $result = Cache::store('file')->remember('medicine-mnns-' . $val, 60, function () use ($val) {
                return $this->search_rep->findByMnn($val);
            });
        }

        $this->content = view('search.mnn')
            ->with(['medicines' => $result['medicines'], 'mnns' => $mnns, 'mnn' => $result['mnn']])
            ->render();
        $this->getAside('ru');

        return $this->renderOutput();

    }

    /**
     *
     * @param null $val
     * @return $this
     */
    public function atx($val = null)
    {
        $this->title = 'Сортування препаратів за АТХ-класифікацією';


        $classifications = null;
        $result = null;
        $parents = null;
        $atx = null;
        $classes = null;
        if (!empty($val)) {
            //        Cache only store('file')===========================>
            $result = $this->search_rep->findAtxChildren($val, true);
            $classifications = $result['medicines'] ?? null;
            $atx = $result['class'] ?? null;

            if (!empty($result['class']->id)) {
                $classes = $this->c_rep->getParents($result['class']->id);

                if (true !== session('class-view-' . $result['class']->class)) {
                    $stats = new ClassificationStatistic();

                    $stats->fill(['class_alias' => $result['class']->class, 'created_at' => date('Y-m-d H:i:s')]);
                    $stats->save();
                    session()->put('class-view-' . $result['class']->class, true);
                }
            }
        } else {
            $parents = $this->search_rep->findAtxParents();
        }

        $this->content = view('search.atx')
            ->with(
                ['classifications' => $classifications,
                    'atx' => $atx, 'parents' => $parents, 'classes' => $classes, 'letter' => $val])
            ->render();
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

        $this->title = 'Поиск препаратов по фармакологической группе';

        $farms = null;

        if ($request->has('farmgroup') && (2 >= strlen($request->get('farmgroup')))) {
            $farms = $this->search_rep->findPharmGroups($request->get('farmgroup'));
        }

        $result = null;
        if (!empty($val)) {
            $result = $this->search_rep->findByPharma($val);
        }

//        dd($farms);

        $this->content = view('search.pharmagroup')
            ->with(['medicines' => $result['medicines'], 'farms' => $farms, 'farm' => $result['pharma']])
            ->render();
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
        if (!empty($val)) {
            $result = $this->search_rep->findBySubstance($val);
        }

//        dd($result);

        $this->content = view('search.substance')
            ->with(['medicines' => $result['medicines'], 'substances' => $substances, 'substance' => $result['substance']])
            ->render();
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

        if (str_limit($val) < 2) {
            $list = config('search.' . $val);
        }

        if (!empty($list)) {
            $this->content = view('search.ua_alpha')->with('letters', $list)->render();
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

        $this->content = view('search.ua_alpha')->with(['medicines' => $medicines, 'letter' => $letter])->render();
        $this->getAside('ua');

        return $this->renderOutput();
    }

    /**
     * @param $loc
     * @param null $val
     * @param null $fabricator
     * @return $this
     */
    public function fabricatoru($val = null, $fabricator = null)
    {

        $this->title = 'Пошук препаратів за виробником';
        $this->loc = 'ua';

        $medicines = null;
        $fabricators = null;
        $fabricator_name = null;

        if (!empty($fabricator)) {
            $result = $this->search_rep->findByFabricator($fabricator);
            $medicines = $result['medicines'] ?? null;
            $fabricator_name = $result['fabricator'] ?? null;
        } elseif (!empty($val)) {
            $fabricators = $this->search_rep->findFabricator($val, true);
        }

//        dd($fabricators);


        $this->content = view('search.ua_fabricator')
            ->with(['medicines' => $medicines, 'fabricators' => $fabricators, 'fabricator' => $fabricator_name, 'val' => $val])
            ->render();
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

        $this->title = 'Пошук препаратів за міжнародною назвою';
        $this->loc = 'ua';

        $mnns = null;
        if ($request->has('mnn') && 1 == strlen($request->get('mnn'))) {
            $mnns = $this->search_rep->findMnn($request->get('mnn'));
        }

        $result = null;
        if (!empty($val)) {
            $result = $this->search_rep->findByMnn($val);
        }

        $this->content = view('search.ua_mnn')
            ->with(['medicines' => $result['medicines'], 'mnns' => $mnns, 'mnn' => $result['mnn']])
            ->render();
        $this->getAside('ua');

        return $this->renderOutput();

    }

    /**
     * @param $loc
     * @param null $val
     * @return $this
     */
    public function atxu($val = null)
    {
        $this->title = 'Пошук препаратів за АТХ-класифікацією';

        $this->loc = 'ua';

        $classifications = null;
        $result = null;
        $parents = null;
        $atx = null;
        $classes = null;
        if (!empty($val)) {
            //        Cache only store('file')===========================>
            $result = $this->search_rep->findUAtxChildren($val);
            $classifications = $result['medicines'] ?? null;
            $atx = $result['class'] ?? null;

            if (!empty($result['class']->id)) {
                $classes = $this->c_rep->getParents($result['class']->id);

//                dd($result['class']);
                if (true !== session('class-view-' . $result['class']->class)) {
                    $stats = new ClassificationStatistic();

                    $stats->fill(['class_alias' => $result['class']->class, 'created_at' => date('Y-m-d H:i:s')]);
                    $stats->save();
                    session()->put('class-view-' . $result['class']->class, true);
                }
            }
        } else {
            $parents = $this->search_rep->findAtxParents();
        }

        $this->content = view('search.ua_atx')
            ->with(
                ['classifications' => $classifications,
                    'atx' => $atx, 'parents' => $parents, 'classes' => $classes, 'letter' => $val])
            ->render();
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

        $this->title = 'Сортування за фармокологічною групою';

        $this->loc = 'ua';

        $farms = null;

        if ($request->has('farmgroup') && (2 >= strlen($request->get('farmgroup')))) {
            $farms = $this->search_rep->findPharmGroups($request->get('farmgroup'), true);
        }

        $result = null;
        if (!empty($val)) {
            $result = $this->search_rep->findByPharma($val, true);
        }

//        dd($result);

        $this->content = view('search.ua_pharmagroup')
            ->with(['medicines' => $result['medicines'], 'farms' => $farms, 'farm' => $result['pharma']])
            ->render();
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
        if (!empty($val)) {
            $result = $this->search_rep->findBySubstance($val, true);
        }

//        dd($substances[0]);

        $this->content = view('search.ua_substance')
            ->with(['medicines' => $result['medicines'], 'substances' => $substances, 'substance' => $result['substance']])
            ->render();
        $this->getAside('ua');

        return $this->renderOutput();

    }

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
