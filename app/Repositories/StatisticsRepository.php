<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\MonthClass;
use Fresh\Medpravda\MonthMedicine;
use Fresh\Medpravda\QuarterClass;
use Fresh\Medpravda\QuarterMedicine;
use Fresh\Medpravda\SemesterClass;
use Fresh\Medpravda\SemesterMedicine;
use Fresh\Medpravda\WeekClass;
use Fresh\Medpravda\WeekMedicine;
use Fresh\Medpravda\YearClass;
use Fresh\Medpravda\YearMedicine;
use Validator;
use DB;

class StatisticsRepository
{
    /**
     * @param $request
     * @return array
     */
    public function getMed($request)
    {
        $validator = Validator::make($request->all(), [
            'alias' => ['required', 'regex:#^[\w-]#', 'between:3,255'],
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        $data = $request->except('_token');

        switch ($data['period']) {
            case 1:
                $res = MonthMedicine::select(DB::raw('(\'' . $data['alias'] . '\') AS alias, count(medicine_alias) AS nums'))
                    ->where('medicine_alias', $data['alias'])->first();
                break;
            case 2:
                $res = QuarterMedicine::select(DB::raw('(\'' . $data['alias'] . '\') AS alias, count(medicine_alias) AS nums'))
                    ->where('medicine_alias', $data['alias'])->first();
                break;
            case 3:
                $res = SemesterMedicine::select(DB::raw('(\'' . $data['alias'] . '\') AS alias, count(medicine_alias) AS nums'))
                    ->where('medicine_alias', $data['alias'])->first();
                break;
            case 4:
                $res = YearMedicine::select(DB::raw('(\'' . $data['alias'] . '\') AS alias, count(medicine_alias) AS nums'))
                    ->where('medicine_alias', $data['alias'])->first();
                break;
            default:
                $res = WeekMedicine::select(DB::raw('(\'' . $data['alias'] . '\') AS alias, count(medicine_alias) AS nums'))
                    ->where('medicine_alias', $data['alias'])->first();
        }
        return $res;
    }

    /**
     * @param $request
     * @return array
     */
    public function getAtx($request)
    {
        $validator = Validator::make($request->all(), [
            'alias' => ['required', 'regex:#^[\w-]#', 'between:1,255'],
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        $data = $request->except('_token');

        switch ($data['period']) {
            case 1:
                $res = MonthClass::select(DB::raw('(\'' . $data['alias'] . '\') AS alias, count(class_alias) AS nums'))
                    ->where('class_alias', 'like', $data['alias'] . '%')->first();
                break;
            case 2:
                $res = QuarterClass::select(DB::raw('(\'' . $data['alias'] . '\') AS alias, count(class_alias) AS nums'))
                    ->where('class_alias', 'like', $data['alias'] . '%')->first();
                break;
            case 3:
                $res = SemesterClass::select(DB::raw('(\'' . $data['alias'] . '\') AS alias, count(class_alias) AS nums'))
                    ->where('class_alias', 'like', $data['alias'] . '%')->first();
                break;
            case 4:
                $res = YearClass::select(DB::raw('(\'' . $data['alias'] . '\') AS alias, count(class_alias) AS nums'))
                    ->where('class_alias', 'like', $data['alias'] . '%')->first();
                break;
            default:
                $res = WeekClass::select(DB::raw('(\'' . $data['alias'] . '\') AS alias, count(class_alias) AS nums'))
                    ->where('class_alias', 'like', $data['alias'] . '%')->first();
        }
        return $res;
    }
}