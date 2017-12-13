<?php

namespace Fresh\Medpravda\Http\Controllers;

use function foo\func;
use Fresh\Medpravda\MedicineStatistic;
use Fresh\Medpravda\Repositories\AmedicineRepository;
use Fresh\Medpravda\Repositories\ArticlesRepository;
use Fresh\Medpravda\Repositories\ClassificationRepository;
use Fresh\Medpravda\Repositories\MedicineRepository;
use Fresh\Medpravda\Repositories\UamedicineRepository;
use Fresh\Medpravda\Repositories\UarticlesRepository;
use Fresh\Medpravda\Repositories\UmedicineRepository;
use Illuminate\Http\Request;
use Cache;
use Crawler;

class MedicineController extends MainController
{
    protected $med_rep;
    protected $umed_rep;
    protected $med_stat;
    protected $amed_rep;
    protected $uamed_rep;
    protected $c_rep;
    protected $a_rep;
    protected $ua_rep;

    public function __construct(
        MedicineRepository $mrep,
        ClassificationRepository $classificationRepository,
        AmedicineRepository $amedicineRepository,
        UamedicineRepository $uamrep,
        UmedicineRepository $umed,
        MedicineStatistic $med_stat,
        ArticlesRepository $arep,
        UarticlesRepository $uarep
    )
    {
        $this->med_rep = $mrep;
        $this->a_rep = $arep;
        $this->ua_rep = $uarep;
        $this->umed_rep = $umed;
        $this->med_stat = $med_stat;
        $this->uamed_rep = $uamrep;
        $this->amed_rep = $amedicineRepository;
        $this->c_rep = $classificationRepository;
    }

    /**
     * @param $loc
     * @param $medicine
     * @param null $act
     * @return $this
     */
    public function medicine(Request $request, $medicine)
    {
        $res = Cache::store('file')->remember('medicine-' . $medicine, 24 * 60, function () use ($medicine) {
            $res = $this->amed_rep->one($medicine);
            if (empty($res)) {
                return false;
            }
            $res->load('image');
            $res->load('fabricator_name');
            $res->load('innname');
            $res->load('pharmagroup');
            $res->load('form');
            return $res;
        });

        if (empty($res)) {
            abort(404);
        }
        //            Last Modify
        $LastModified_unix = strtotime($res->updated_at); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }
//            Last Modify

        if (true !== session('medicine-' . $res->alias) && !Crawler::isCrawler()) {
            $res->timestamps = false;
            $res->increment('view');
            $res->timestamps = true;

            $this->med_stat->fill(['medicine_alias' => $res->alias, 'created_at' => date('Y-m-d H:i:s')]);
            $this->med_stat->save();
            session()->put('medicine-' . $res->alias, true);
        }


        $this->title = 'Адаптированная инструкция';

        $class = Cache::store('file')->remember('meddicine_atx_' . $res->classification_id, 24 * 60, function () use ($res) {
            return $this->c_rep->getParents($res->classification_id);
        });


        $this->content = view('medicines.adaptive')->with(['medicine' => $res, 'classes' => $class])->render();

        $this->seo = $this->med_rep->convertSeo($res->seo);

        if (empty($this->seo->og_image)) {
            if (isset($this->seo->og_image)) {
                $this->seo->og_image = asset('assets/images') . '/meta_pics/medicines_ru.jpg';
            } else {
                $obj = new \stdClass;
                $obj->og_image = asset('assets/images') . '/meta_pics/medicines_ru.jpg';
                $this->seo = $obj;
            }
        }

        $articles = $this->a_rep->get(['title', 'alias', 'description'], 8, false,
            [['approved', 1]], ['priority', 'desc'], ['image']);

        $medicines = $this->med_rep->get('*', 18, false, [['approved', 1], ['innname_id', $res->innname_id]]);
        $this->aside = view('medicines.aside')->with(['articles' => $articles, 'medicines' => $medicines])->render();
        $this->slider = view('medicines.slider')->with(['medicines' => $medicines])->render();

        return $this->renderOutput();
    }

    /**
     * @param $loc
     * @param $medicine
     * @param null $act
     * @return $this
     */
    public function analog(Request $request, $medicine)
    {
        $res = $this->med_rep->one($medicine);
        if (empty($res)) {
            abort(404);
        }

        //            Last Modify
        $LastModified_unix = strtotime($res->updated_at); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }
//            Last Modify

        $analogs = $this->med_rep->getAnalogs($res->substance);

        $this->content = view('medicines.analog')
            ->with(['medicine' => $res, 'analogs' => $analogs['medicines'], 'forms' => $analogs['forms']])->render();


        $this->jss = '<script type="text/javascript" src="' . asset('js') . '/analog.js"></script>';

        $this->title = 'Аналог';

        $articles = $this->a_rep->get(['title', 'alias', 'description'], 8, false,
            [['approved', 1]], ['priority', 'desc'], ['image']);
        $medicines = $this->med_rep->get('*', 18, false, [['approved', 1], ['innname_id', $res->innname_id]]);
        $this->aside = view('medicines.aside')->with(['articles' => $articles, 'medicines' => $medicines])->render();

        return $this->renderOutput();
    }

    /**
     * @param $loc
     * @param $medicine
     * @return $this
     */
    public function official(Request $request, $medicine)
    {
        $res = Cache::store('file')->remember('off-medicine-' . $medicine, 24 * 60, function () use ($medicine) {
            $res = $this->med_rep->one($medicine);
            if (empty($res)) {
                return false;
            }
            $res->load('image');
            $res->load('fabricator_name');
            $res->load('innname');
            $res->load('pharmagroup');
            $res->load('form');
            return $res;
        });

        if (empty($res)) {
            abort(404);
        }
        //            Last Modify
        $LastModified_unix = strtotime($res->updated_at); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }
//            Last Modify

        if (true !== session('medicine-' . $res->alias) && !Crawler::isCrawler()) {
            $res->timestamps = false;
            $res->increment('view');
            $res->timestamps = true;

            $this->med_stat->fill(['medicine_alias' => $res->alias, 'created_at' => date('Y-m-d H:i:s')]);
            $this->med_stat->save();
            session()->put('medicine-' . $res->alias, true);
        }

        $this->title = 'Официальная инструкция';

        $class = Cache::store('file')->remember('meddicine_atx_' . $res->classification_id, 24 * 60, function () use ($res) {
            return $this->c_rep->getParents($res->classification_id);
        });
        $this->seo = $this->med_rep->convertSeo($res->seo);

        if (empty($this->seo->og_image)) {
            if (isset($this->seo->og_image)) {
                $this->seo->og_image = asset('assets/images') . '/meta_pics/medicines_ru.jpg';
            } else {
                $obj = new \stdClass;
                $obj->og_image = asset('assets/images') . '/meta_pics/medicines_ru.jpg';
                $this->seo = $obj;
            }
        }

        $this->content = view('medicines.medicine')->with(['medicine' => $res, 'classes' => $class])->render();

        $articles = $this->a_rep->get(['title', 'alias', 'description'], 8, false,
            [['approved', 1]], ['priority', 'desc'], ['image']);

        $medicines = $this->med_rep->get('*', 18, false, [['approved', 1], ['innname_id', $res->innname_id]]);
        $this->aside = view('medicines.aside')->with(['articles' => $articles, 'medicines' => $medicines])->render();
        $this->slider = view('medicines.slider')->with(['medicines' => $medicines])->render();

        return $this->renderOutput();
    }

    /**
     * @param $loc
     * @param $medicine
     * @return $this
     */
    public function faq(Request $request, $medicine)
    {
        $this->title = 'Частые вопросы';

        $res = $this->med_rep->one($medicine);
        if (empty($res)) {
            abort(404);
        }
        //            Last Modify
        $LastModified_unix = strtotime($res->updated_at); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }
//            Last Modify

        $res->load('questions');

        $this->content = view('medicines.faq')->with(['medicine' => $res])->render();

        $articles = $this->a_rep->get(['title', 'alias', 'description'], 8, false,
            [['approved', 1]], ['priority', 'desc'], ['image']);
        $medicines = $this->med_rep->get('*', 18, false, [['approved', 1], ['innname_id', $res->innname_id]]);
        $this->aside = view('medicines.aside')->with(['articles' => $articles, 'medicines' => $medicines])->render();
        return $this->renderOutput();

    }

    /**
     * @param $medicine
     * @param $vr
     * @param null $loc
     * @return bool|string
     */
    public function toprint($medicine, $vr, $loc = null)
    {
        if ('ua' != $loc) {

            if ('main' == $vr) {
                $res = $this->med_rep->one($medicine);
            } else {
                $res = $this->amed_rep->one($medicine);
            }

            if (empty($res)) {
                abort(404);
            }

            $class = $this->c_rep->getParents($res->classification_id);

            $this->content = view('medicines.print')
                ->with(['medicine' => $res, 'classes' => $class])->render();
        } else {
            $this->content = view('medicines.print')->render();
        }
        $this->title = 'Частые вопросы';
        return $this->content;

    }
//      UA ==========================>

    /**
     * @param $medicine
     * @return $this
     */
    public function medicineUa(Request $request, $medicine)
    {
        $res = Cache::store('file')->remember('medicine-ua-' . $medicine, 24 * 60, function () use ($medicine) {
            $res = $this->uamed_rep->one($medicine);
            if (empty($res)) {
                return false;
            }
            $res->load('image');
            $res->load('fabricator_name');
            $res->load('innname');
            $res->load('pharmagroup');
            $res->load('form');
            return $res;
        });

        if (empty($res)) {
            abort(404);
        }

        //            Last Modify
        $LastModified_unix = strtotime($res->updated_at); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }
//            Last Modify

        if (true !== session('medicine-' . $res->alias) && !Crawler::isCrawler()) {
            $res->timestamps = false;
            $res->increment('view');
            $res->timestamps = true;

            $this->med_stat->fill(['medicine_alias' => $res->alias, 'created_at' => date('Y-m-d H:i:s')]);
            $this->med_stat->save();
            session()->put('medicine-' . $res->alias, true);
        }

        $this->title = 'Адаптована інструкція';
        $this->loc = 'ua';

        $class = Cache::store('file')->remember('meddicine_atx_' . $res->classification_id, 24 * 60, function () use ($res) {
            return $this->c_rep->getParents($res->classification_id);
        });

        $this->content = view('medicines.ua_adaptive')->with(['medicine' => $res, 'classes' => $class])->render();
        $this->seo = $this->med_rep->convertSeo($res->seo);

        if (empty($this->seo->og_image)) {
            if (isset($this->seo->og_image)) {
                $this->seo->og_image = asset('assets/images') . '/meta_pics/medicines_ukr.jpg';
            } else {
                $obj = new \stdClass;
                $obj->og_image = asset('assets/images') . '/meta_pics/medicines_ukr.jpg';
                $this->seo = $obj;
            }
        }

        $articles = $this->ua_rep->get(['title', 'alias', 'description'], 8, false,
            [['approved', 1]], ['priority', 'desc'], ['image']);

        $medicines = $this->umed_rep->get('*', 18, false, [['approved', 1], ['innname_id', $res->innname_id]]);

        $this->aside = view('medicines.ua_aside')->with(['articles' => $articles, 'medicines' => $medicines])->render();
        $this->slider = view('medicines.ua_slider')->with(['medicines' => $medicines])->render();
        return $this->renderOutput();
    }

    /**
     * @param $medicine
     * @return $this
     */
    public function analogUa(Request $request, $medicine)
    {
        $res = $this->umed_rep->one($medicine);
        if (empty($res)) {
            abort(404);
        }

        //            Last Modify
        $LastModified_unix = strtotime($res->updated_at); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }
//            Last Modify
        $this->loc = 'ua';

        $analogs = $this->umed_rep->getAnalogs($res->substance);

        $this->content = view('medicines.ua_analog')
            ->with(['medicine' => $res, 'analogs' => $analogs['medicines'], 'forms' => $analogs['forms']])->render();


        $this->jss = '<script type="text/javascript" src="' . asset('js') . '/analog.js"></script>';

        $this->title = 'Аналог';
        $articles = $this->ua_rep->get(['title', 'alias', 'description'], 8, false,
            [['approved', 1]], ['priority', 'desc'], ['image']);
        $medicines = $this->umed_rep->get('*', 18, false, [['approved', 1], ['innname_id', $res->innname_id]]);

        $this->aside = view('medicines.ua_aside')->with(['articles' => $articles, 'medicines' => $medicines])->render();
        return $this->renderOutput();

    }

    /**
     * @param $medicine
     * @return $this
     */
    public function officialUa(Request $request, $medicine)
    {
        $res = Cache::store('file')->remember('off-medicine-ua-' . $medicine, 24 * 60, function () use ($medicine) {
            $res = $this->umed_rep->one($medicine);
            if (empty($res)) {
                return false;
            }
            $res->load('image');
            $res->load('fabricator_name');
            $res->load('innname');
            $res->load('pharmagroup');
            $res->load('form');
            return $res;
        });

        if (empty($res)) {
            abort(404);
        }
        //            Last Modify
        $LastModified_unix = strtotime($res->updated_at); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }
//            Last Modify

        if (true !== session('medicine-' . $res->alias) && !Crawler::isCrawler()) {
            $res->timestamps = false;
            $res->increment('view');
            $res->timestamps = true;

            $this->med_stat->fill(['medicine_alias' => $res->alias, 'created_at' => date('Y-m-d H:i:s')]);
            $this->med_stat->save();
            session()->put('medicine-' . $res->alias, true);
        }

        $this->title = 'Офіційна інструкція';
        $this->loc = 'ua';

        $class = Cache::store('file')->remember('meddicine_atx_' . $res->classification_id, 24 * 60, function () use ($res) {
            return $this->c_rep->getParents($res->classification_id);
        });
        $this->seo = $this->med_rep->convertSeo($res->seo);
        if (empty($this->seo->og_image)) {
            if (isset($this->seo->og_image)) {
                $this->seo->og_image = asset('assets/images') . '/meta_pics/medicines_ukr.jpg';
            } else {
                $obj = new \stdClass;
                $obj->og_image = asset('assets/images') . '/meta_pics/medicines_ukr.jpg';
                $this->seo = $obj;
            }
        }

        $this->content = view('medicines.ua_medicine')->with(['medicine' => $res, 'classes' => $class])->render();

        $articles = $this->ua_rep->get(['title', 'alias', 'description'], 8, false,
            [['approved', 1]], ['priority', 'desc'], ['image']);
        $medicines = $this->umed_rep->get('*', 18, false, [['approved', 1], ['innname_id', $res->innname_id]]);

        $this->aside = view('medicines.ua_aside')->with(['articles' => $articles, 'medicines' => $medicines])->render();
        $this->slider = view('medicines.ua_slider')->with(['medicines' => $medicines])->render();
        return $this->renderOutput();
    }

    /**
     * @param $medicine
     * @return $this
     */
    public function faqUa(Request $request, $medicine)
    {
        $res = $this->umed_rep->one($medicine);
        if (empty($res)) {
            abort(404);
        }
//            Last Modify
        $LastModified_unix = strtotime($res->updated_at); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }
//            Last Modify
        $this->title = 'Запитання';
        $this->loc = 'ua';
        $res->load('questions');

        $this->content = view('medicines.ua_faq')->with(['medicine' => $res])->render();

        $articles = $this->ua_rep->get(['title', 'alias', 'description'], 8, false,
            [['approved', 1]], ['priority', 'desc'], ['image']);
        $medicines = $this->umed_rep->get('*', 18, false, [['approved', 1], ['innname_id', $res->innname_id]]);

        $this->aside = view('medicines.ua_aside')->with(['articles' => $articles, 'medicines' => $medicines])->render();
        return $this->renderOutput();
    }

    /**
     * @param $medicine
     * @param $vr
     * @return bool|string
     */
    public function toprintUa($medicine, $vr)
    {
        if ('main' == $vr) {
            $res = $this->umed_rep->one($medicine);
        } else {
            $res = $this->uamed_rep->one($medicine);
        }

        if (empty($res)) {
            abort(404);
        }

        $class = $this->c_rep->getParents($res->classification_id);

        $this->content = view('medicines.print')
            ->with(['medicine' => $res, 'classes' => $class])->render();

        $this->title = 'Частые вопросы';
        return $this->content;

    }
}
