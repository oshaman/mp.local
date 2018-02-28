<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\AlphaUaView;
use Fresh\Medpravda\AlphaView;
use Fresh\Medpravda\Classification;
use Fresh\Medpravda\Fabricator;
use Fresh\Medpravda\Innname;
use Fresh\Medpravda\Medicine;
use Fresh\Medpravda\Pharmagroup;
use Fresh\Medpravda\Substance;
use Fresh\Medpravda\Umedicine;
use Fresh\Medpravda\Article;
use Fresh\Medpravda\UArticle;
use Validator;
use Fresh\Medpravda\MedicineTitle;
use DB;

class SearchRepository
{
    protected $med;
    protected $umed;
    protected $fab;
    protected $mnn;
    protected $atx;
    protected $medicines;
    protected $pharma;
    protected $substance;

    /**
     * SearchRepository constructor.
     * @param Medicine $medicine
     * @param Fabricator $fabricator
     * @param Innname $mnn
     */
    public function __construct(
        Medicine $medicine,
        Umedicine $umed,
        Fabricator $fabricator,
        Innname $mnn,
        Classification $atx,
        Pharmagroup $pharmagroup,
        Substance $substance
    )
    {
        $this->med = $medicine;
        $this->umed = $umed;
        $this->fab = $fabricator;
        $this->mnn = $mnn;
        $this->atx = $atx;
        $this->pharma = $pharmagroup;
        $this->substance = $substance;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getSearch($request)
    {
        $re = '#[^\w\'\sа-яА-ЯёЁіІїЇЄє\-]+#u';

        $query = preg_replace($re, '', $request->get('search'));
        $query = substr(preg_replace('#[\s{2,}]#', ' ', $query), 0, 96);

        $result['medicines'] = $this->getSearchMedicines($query);
        $result['fabricators'] = $this->getSearchFabricators($query);
        $result['innnames'] = $this->getSearchInnnames($query);
        $result['pharma'] = $this->getPharmas($query);
        $result['substances'] = $this->getSubstances($query);
        $result['articles'] = $this->getArticles($query);

        $result = array_filter($result);

        if (count($result) < 1) {
            $result['def'] = $this->byPercent($query);
        }

        return $result;
    }

    public function byPercent($query)
    {
        $data = file_get_contents(asset('asset/titles.txt'));
        $titles = unserialize($data);
        $result = [];
        foreach ($titles as $title) {
            similar_text($query, $title['title'], $percent);
            similar_text($query, $title['utitle'], $upercent);

//                    var_dump($percent);die;
            if (($percent >= 70) || ($upercent >= 70)) {
                $result[] = $title;
            };
        }
        if (count($result) < 1) {
            $result = array_filter($result);
        }
        return $result;
    }

    public function fullTextSearch($query)
    {
        $articles = Article::with(['image'])->where([['approved', 1], ['content', 'like', '%' . $query . '%']])
            ->take(8)->get();

        $result['articles'] = $articles->isNotEmpty() ? $articles : null;

        $medicies = $this->med->select('title', 'alias')->where([['title', 'like', '%' . $query . '%'], ['approved', 1]])->get();

        if ($medicies->isNotEmpty()) {
            $result['medicines'] = $medicies;
        } else {
            $query_f = '"' . $query . '"';
            $match = 'consist, physicochemical_char, pharm_group, additionally, indications, pharm_prop, contraindications, security, application_features, pregnancy, cars, children, app_mode, overdose, side_effects, interaction';
            $medicies = $this->med->select('title', 'alias', 'approved')->where('approved', 1)->whereRaw(
                "MATCH($match) AGAINST(? IN BOOLEAN MODE) LIMIT 50",
                array($query_f)
            )->get();

            $result['medicines'] = $medicies->isNotEmpty() ? $medicies : null;
        }


        return $result;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function getSearchMedicines($query)
    {
        $meds = MedicineTitle::where('title', 'like', $query . '%')
            ->orWhere('utitle', 'like', $query . '%')->take(5)->take(5)->get();

        if ($meds->isEmpty()) {
            $meds = MedicineTitle::where('title', 'like', '%' . $query . '%')
                ->orWhere('utitle', 'like', '%' . $query . '%')->take(5)->get();
        }

        return $meds->isNotEmpty() ? $meds : null;

    }

    /**
     * @param $query
     * @return mixed
     */
    public function getArticles($query)
    {
        $articles = Article::select('title', 'alias')->where('title', 'like', '%' . $query . '%')->take(5)->get();

        if ($articles->isEmpty()) {
            $articles = UArticle::select('title', 'alias')->where('title', 'like', '%' . $query . '%')->take(5)->get();
        }

        return $articles->isNotEmpty() ? $articles : null;

    }

    /**
     * @param $query
     * @return mixed
     */
    public function getSearchFabricators($query)
    {
        $fabricators = $this->fab->where('title', 'like', $query . '%')
            ->orWhere('utitle', 'like', $query . '%')->take(5)->get();

        if ($fabricators->isEmpty()) {
            $fabricators = $this->fab->where('title', 'like', '%' . $query . '%')
                ->orWhere('utitle', 'like', '%' . $query . '%')->take(5)->get();
        }

        return $fabricators->isNotEmpty() ? $fabricators : null;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function getSubstances($query)
    {
        $substances = $this->substance->where('title', 'like', $query . '%')
            ->orWhere('utitle', 'like', $query . '%')->take(5)->get();

        if ($substances->isEmpty()) {
            $substances = $this->substance->where('title', 'like', '%' . $query . '%')
                ->orWhere('utitle', 'like', '%' . $query . '%')->take(5)->get();
        }

        return $substances->isNotEmpty() ? $substances : null;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function getPharmas($query)
    {
        $pharmas = $this->pharma->where('title', 'like', $query . '%')
            ->orWhere('utitle', 'like', $query . '%')->take(5)->get();

        if ($pharmas->isEmpty()) {
            $pharmas = $this->pharma->where('title', 'like', '%' . $query . '%')
                ->orWhere('utitle', 'like', '%' . $query . '%')->take(5)->get();
        }

        return $pharmas->isNotEmpty() ? $pharmas : null;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function getSearchInnnames($query)
    {
        $inns = $this->mnn->where('title', 'like', $query . '%')
            ->orWhere('name', 'like', $query . '%')
            ->orWhere('uname', 'like', $query . '%')
            ->take(5)->get();

        if ($inns->isEmpty()) {
            $inns = $this->mnn->where('title', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->orWhere('uname', 'like', '%' . $query . '%')
                ->take(5)->get();
        }

        return $inns->isNotEmpty() ? $inns : null;
    }

    /**
     * @param $request
     * @return array|bool
     */
    public function get($request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'required|string|max:128',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        $query = $request->get('search');

//        dd($query);
        $full = $this->fullTextSearch($query);
        $full = array_filter($full);

        if (empty($full['medicines']) || count($full) < 1) {
            $full['medicines'] = $this->byPercent($query);
        }
        return $full;

    }

    public function getMedicine($val)
    {
        $medicines = $this->med->select('title', 'id', 'alias')
            ->where([['title', 'like', '%' . $val . '%'], ['approved', 1]])->get();
//        dd($medicines);

        if (null == $medicines) {
            return ['error' => ['error' => 'Ошибка поиска.']];
        }

        return $medicines;
    }

    /**
     * @param $val
     * @return mixed
     */
    public function findByLetter($val, $loc = null)
    {
        if (null == $loc) {
            return $this->med->select(['alias', 'title'])->where([['title', 'like', $val . '%'], ['approved', 1]])->get();
        }
        return $this->umed->select(['alias', 'title'])->where([['title', 'like', $val . '%'], ['approved', 1]])->get();
    }

    /**
     * @param $val
     * @return mixed
     */
    public function findFabricator($val, $loc = null)
    {
        if (null === $loc) return $this->fab->select(['id', 'alias', 'title'])->where('title', 'like', $val . '%')->get();

        return $this->fab->select(['id', 'alias', 'utitle'])->where('utitle', 'like', $val . '%')->get();
    }

    /**
     * @param $val
     * @return null
     */
    public function findByFabricator($model, $loc = null)
    {
        if (null == $loc) {
            $result['medicines'] = $this->med->select(['alias', 'title'])
                ->where([['fabricator_id', $model->id], ['approved', 1]])->get();
        } else {
            $result['medicines'] = $this->umed->select(['alias', 'title'])
                ->where([['fabricator_id', $model->id], ['approved', 1]])->get();
        }

        $result['fabricator'] = $model;

        return $result;
    }

    /**
     * @param $val
     * @return mixed
     */
    public function findMnn($val)
    {
        return $this->mnn->select(['id', 'alias', 'title', 'name', 'uname'])->where('title', 'like', $val . '%')->get();
    }

    /**
     * @param $val
     * @return null
     */
    public function findByMnn($mnn)
    {
        $result['medicines'] = $this->med->select(['alias', 'title'])
            ->where([['innname_id', $mnn->id], ['approved', 1]])->get();

        return $result;
    }

    /**
     * @return mixed
     */
    public function findAtxParents()
    {
        return $this->atx->select('name', 'uname', 'class')->where('parent', null)->get();
    }

    /**
     * @param $val
     * @return null
     */
    public function findAtxChildren($val)
    {
        $atx = $this->atx->select('id', 'class', 'name', 'parent')->where('class', $val)->first();

        $result = null;
        if (!empty($atx)) {

            $atx->load('children');
            $atx->load('meds');
            $atx->load('parents');

            if (!empty($atx->meds)) {
                foreach ($atx->meds as $medicine) {
//                    if (1 != $medicine->approved) continue;
                    $this->medicines[$atx->class][] = $medicine;
                    $this->medicines[$atx->class]['name'] = $atx->name;
                }
            };

            if (!empty($atx->children)) {

                foreach ($atx->children as $child) {
                    $arr = [];
                    if (empty($child->meds)) continue;
                    foreach ($child->meds as $medicine) {
                        $arr[] = $medicine;
                    }

                    $res = $this->getAtxMedicines($child->children, $arr);
                    if (!empty($res)) {
                        $this->medicines[$child->class] = $res;
                        $this->medicines[$child->class]['name'] = $child->name;
                    }
                }
            }

            $result['medicines'] = $this->medicines;
            $result['class'] = $atx;
        }

        return $result;
    }

    /**
     * @param $children
     * @param $arr
     * @return array|bool
     */
    public function getAtxMedicines($children, $arr)
    {
        if (null == $children) return false;

        foreach ($children as $child) {
            $carr = [];
            if (!empty($child->children)) {
                $carr = $this->getAtxMedicines($child->children, $carr);
            }

            if (!empty($carr)) {
                $arr = array_merge($arr, $carr);
            }

            if (empty($child->meds)) continue;
            foreach ($child->meds as $medicine) {
//                if (1 != $medicine->approved) continue;
                $arr[] = $medicine;
            }
        }
        return $arr;
    }

    /**
     * @param $val
     * @return mixed
     */
    public function findPharmGroups($val, $loc = null)
    {
        if (null == $loc) return $this->pharma->select(['id', 'alias', 'title'])->where('title', 'like', $val . '%')->get();

        return $this->pharma->select(['id', 'alias', 'utitle'])->where('utitle', 'like', $val . '%')->get();
    }

    /**
     * @param $val
     * @return null
     */
    public function findByPharma($pharma, $loc = null)
    {
        $result = null;
        if (!empty($pharma)) {
            if (null == $loc) {
                $result['medicines'] = $this->med->select(['alias', 'title'])->where([['pharmagroup_id', $pharma->id], ['approved', 1]])->get();
            } else {
                $result['medicines'] = $this->umed->select(['alias', 'title'])->where([['pharmagroup_id', $pharma->id], ['approved', 1]])->get();
            }
            $result['pharma'] = $pharma;
        }
        return $result;
    }

    /**
     * @param $val
     * @return mixed
     */
    public function findSubstances($val, $loc = null)
    {
        if (null == $loc) {
            return $this->substance->select(['id', 'alias', 'title'])->where('title', 'like', $val . '%')->get();
        } else {
            return $this->substance->select(['id', 'alias', 'utitle'])->where('utitle', 'like', $val . '%')->get();
        }
    }

    /**
     * @param $val
     * @return null
     */
    public function findBySubstance($substance, $loc = null)
    {
        if (null == $loc) {
            $result['medicines'] = $this->med->whereHas('substance', function ($q) use ($substance) {
                $q->where([['substance_id', $substance->id], ['approved', 1]])->select('title', 'alias');
            })->get();
        } else {
            $result['medicines'] = $this->umed->whereHas('substance', function ($q) use ($substance) {
                $q->where([['substance_id', $substance->id], ['approved', 1]])->select('title', 'alias');
            })->get();
        }

        return $result;
    }

    /**
     * @param $val
     * @return null
     */
    public function findUAtxChildren($val)
    {
        $atx = $this->atx->select('id', 'class', 'uname', 'parent')->where('class', $val)->first();

        $result = null;

        if (!empty($atx)) {

            $atx->load('children');
            $atx->load('umedicines');
            $atx->load('parents');

            if (!empty($atx->umedicines)) {
                foreach ($atx->umedicines as $medicine) {
                    $this->medicines[$atx->class][] = $medicine;
                    $this->medicines[$atx->class]['name'] = $atx->uname;
                }
            };

            if (!empty($atx->children)) {

                foreach ($atx->children as $child) {
                    $arr = [];
                    if (empty($child->umedicines)) continue;
                    foreach ($child->umedicines as $umedicine) {
                        $arr[] = $umedicine;
                    }

                    $res = $this->getAtxMedicines($child->children, $arr);
                    if (!empty($res)) {
                        $this->medicines[$child->class] = $res;
                        $this->medicines[$child->class]['name'] = $child->uname;
                    }
                }
            }

            $result['medicines'] = $this->medicines;
            $result['class'] = $atx;
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getFirstLetters($loc = false)
    {
        if (true === $loc) {
            $letters = AlphaUaView::groupBy('firstletter')->get();
        } else {
            $letters = AlphaView::groupBy('firstletter')->get();
        }

        $alphabet = [];

        foreach ($letters as $letter) {
            if (preg_match('/[a-zA-Z0-9]/', $letter->firstletter, $x)) {
                $alphabet['en'][] = $letter->firstletter;
            } else {
                $alphabet['ru'][] = $letter->firstletter;
            }
        }

        return $alphabet;
    }

    /**
     * @param $letter
     * @param bool $loc
     * @return mixed
     */
    public function getSecondLetters($letter, $loc = false)
    {
        if (true === $loc) {
            $list = DB::table('umedicines')
                ->select(DB::raw('DISTINCT SUBSTRING(`title`,1,2) AS FIRSTLETTER'))
                ->where([['title', 'like', $letter . '%'], ['approved', true]])
                ->get();
        } else {
            $list = DB::table('medicines')
                ->select(DB::raw('DISTINCT SUBSTRING(`title`,1,2) AS FIRSTLETTER'))
                ->where([['title', 'like', $letter . '%'], ['approved', true]])
                ->get();
        }

        return $list;
    }

    /**
     * @param bool $loc
     * @return array
     */
    public function getSubstanceLetters($loc = false)
    {
        if (true === $loc) {
            $letters = DB::table('substances')
                ->select(DB::raw('DISTINCT SUBSTRING(`utitle`,1,1) AS first'))
                ->groupBy('utitle')
                ->get();
        } else {
            $letters = DB::table('substances')
                ->select(DB::raw('DISTINCT SUBSTRING(`title`,1,1) AS first'))
                ->get();
        }

        $alphabet = [];

        foreach ($letters as $letter) {
            if (preg_match('/[a-zA-Z0-9]/', $letter->first, $x)) {
                $alphabet['en'][] = $letter->first;
            } else {
                $alphabet['ru'][] = $letter->first;
            }
        }

        return $alphabet;
    }

    /**
     * @return mixed
     */
    public function getMnnLetters()
    {
        $letters = DB::table('innnames')
            ->select(DB::raw('DISTINCT SUBSTRING(`title`,1,1) AS first'))
            ->get();

        return $letters;
    }

    /**
     * @return mixed
     */
    public function getPharmLetters($loc = true)
    {
        if (true === $loc) {
            $letters = DB::table('pharmagroups')
                ->select(DB::raw('DISTINCT SUBSTRING(`utitle`,1,1) AS first'))
                ->get();
        } else {
            $letters = DB::table('pharmagroups')
                ->select(DB::raw('DISTINCT SUBSTRING(`title`,1,1) AS first'))
                ->get();
        }

        return $letters;
    }

    public function getFabricatorLetters($loc = false)
    {
        if (true === $loc) {
            $letters = DB::table('fabricators')
                ->select(DB::raw('DISTINCT SUBSTRING(`utitle`,1,1) AS first'))
                ->groupBy('utitle')
                ->get();
        } else {
            $letters = DB::table('fabricators')
                ->select(DB::raw('DISTINCT SUBSTRING(`title`,1,1) AS first'))
                ->get();
        }

        $alphabet = [];

        foreach ($letters as $letter) {
            if (preg_match('/[a-zA-Z0-9]/', $letter->first, $x)) {
                $alphabet['en'][] = $letter->first;
            } else {
                $alphabet['ru'][] = $letter->first;
            }
        }

        return $alphabet;
    }
}