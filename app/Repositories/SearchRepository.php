<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Classification;
use Fresh\Medpravda\Fabricator;
use Fresh\Medpravda\Innname;
use Fresh\Medpravda\Medicine;
use Fresh\Medpravda\Pharmagroup;
use Fresh\Medpravda\Substance;
use Validator;

class SearchRepository
{
    protected $med;
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
        Fabricator $fabricator,
        Innname $mnn,
        Classification $atx,
        Pharmagroup $pharmagroup,
        Substance $substance
    )
    {
        $this->med = $medicine;
        $this->fab = $fabricator;
        $this->mnn = $mnn;
        $this->atx = $atx;
        $this->pharma = $pharmagroup;
        $this->substance = $substance;
    }

    /**
     * @param $request
     * @return array|bool
     */
    public function get($request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'required|string|max:128',
//            'categories' => 'nullable|integer|min:1|max:4294967295',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        $data = $request->all();

        if (empty($data['search'])) {
            return false;
        }

        $medicines = $this->med->select('title', 'id', 'alias')->where('title', 'like', '%' . $data['search'] . '%')->get();
//        dd($medicines);

        return $medicines;

    }

    /**
     * @param $val
     * @return mixed
     */
    public function findByLetter($val)
    {
        return $this->med->select(['alias', 'title'])->where('title', 'like', $val . '%')->get();
    }

    /**
     * @param $val
     * @return mixed
     */
    public function findFabricator($val)
    {
        return $this->fab->select(['id', 'alias', 'title'])->where('title', 'like', $val . '%')->get();
    }

    /**
     * @param $val
     * @return null
     */
    public function findByFabricator($val)
    {
        $fabricator = $this->fab->select('id', 'title')->where('alias', $val)->first();
        $result = null;
        if (!empty($fabricator)) {
            $result['medicines'] = $this->med->select(['alias', 'title'])->where('fabricator_id', $fabricator->id)->get();
            $result['fabricator'] = $fabricator;
        }
        return $result;
    }

    public function findMnn($val)
    {
        return $this->mnn->select(['id', 'alias', 'title', 'name'])->where('title', 'like', $val . '%')->get();
    }

    /**
     * @param $val
     * @return null
     */
    public function findByMnn($val)
    {
        $mnn = $this->mnn->select('id', 'title')->where('alias', $val)->first();

        $result = null;
        if (!empty($mnn)) {
            $result['medicines'] = $this->med->select(['alias', 'title'])->where('innname_id', $mnn->id)->get();
            $result['mnn'] = $mnn;
        }
        return $result;
    }

    /**
     * @return mixed
     */
    public function findAtxParents()
    {
        return $this->atx->select('name', 'class')->where('parent', null)->get();
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
            $atx->load('medicines');
            $atx->load('parents');

            if (!empty($atx->medicines)) {
                foreach ($atx->medicines as $medicine) {
                    $this->medicines[$atx->class][] = $medicine;
                    $this->medicines[$atx->class]['name'] = $atx->name;
                }
            };

            if (!empty($atx->children)) {

                foreach ($atx->children as $child) {
                    $arr = [];
                    if (empty($child->medicines)) continue;
                    foreach ($child->medicines as $medicine) {
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

            if (empty($child->medicines)) continue;
            foreach ($child->medicines as $medicine) {
                $arr[] = $medicine;
            }
        }
        return $arr;
    }

    /**
     * @param $val
     * @return mixed
     */
    public function findPharmGroups($val)
    {
        return $this->pharma->select(['id', 'alias', 'title'])->where('title', 'like', $val . '%')->get();
    }

    /**
     * @param $val
     * @return null
     */
    public function findByPharma($val)
    {
        $pharma = $this->pharma->select('id', 'title')->where('alias', $val)->first();

        $result = null;
        if (!empty($pharma)) {
            $result['medicines'] = $this->med->select(['alias', 'title'])->where('pharmagroup_id', $pharma->id)->get();
            $result['pharma'] = $pharma;
        }
        return $result;
    }

    /**
     * @param $val
     * @return mixed
     */
    public function findSubstances($val)
    {
        return $this->substance->select(['id', 'alias', 'title'])->where('title', 'like', $val . '%')->get();
    }

    /**
     * @param $val
     * @return null
     */
    public function findBySubstance($val)
    {
        $substance = $this->substance->select('id', 'title')->where('alias', $val)->first();

        $result = null;
        if (!empty($substance)) {
            $result['medicines'] = $this->med->whereHas('substance', function ($q) use ($substance) {
                $q->where('substance_id', $substance->id)->select('title', 'alias');
            })->get();

            $result['substance'] = $substance;
        }
        return $result;
    }

}