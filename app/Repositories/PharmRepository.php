<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Pharmagroup;
use Cache;

class PharmRepository extends Repository
{
    /**
     * ClassificationRepository constructor.
     * @param Pharmagroup $pharma
     */
    public function __construct(Pharmagroup $pharma)
    {
        $this->model = $pharma;
    }

    /**
     * @param $request
     * @param $pharm
     * @return mixed
     */
    public function updatePharm($request, $pharm)
    {
        $pharm->title = $request->get('title');
        $pharm->utitle = $request->get('utitle');
        $res = $pharm->save();
        if ($res) {
            Cache::forget('ua-sort-farm-' . $pharm->alias);
        }
        return $res;

    }
}