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

    public function downloadAtx()
    {
        $classes = DB::table('download_classes')->get();
        $tot_record_found = 0;
        if (count($classes) > 0) {
            $tot_record_found = 1;

            $CsvData = array('ATX|Год|Полугодие|Квартал|Месяц|Неделя');
            foreach ($classes as $value) {
                $CsvData[] = $value->class_alias . '|' . $value->yearCount . '|' . $value->semesterCount
                    . '|' . $value->quarterCount . '|' . $value->monthCount . '|' . $value->weekCount;
            }

            $filename = date('Y-m-d') . ".csv";
            $file_path = base_path() . '/' . $filename;
            $file = fopen($file_path, "w+");
            foreach ($CsvData as $exp_data) {
                fputcsv($file, explode('|', $exp_data));
            }
            fclose($file);

            $headers = ['Content-Type' => 'application/csv'];
            return ['filepath' => $file_path, 'filename' => $filename, 'headers' => $headers];
        }
        return ['error' => 'Записей не найдено.'];

    }

    public function getAtxChart()
    {
        $data = ['A', 'B', 'C', 'D', 'G', 'H', 'J', 'L', 'M', 'N', 'P', 'R', 'S', 'V'];

        $quarter = [];
        foreach ($data as $class) {
            $classification = QuarterClass::select(DB::raw('(\'' . $class . '\') AS alias, count(class_alias) AS nums'))
                ->where('class_alias', 'like', $class . '%')->first();

            array_push($quarter, array("y" => $classification->nums, "label" => $classification->alias));

        }
        $month = [];
        foreach ($data as $class) {
            $classification = MonthClass::select(DB::raw('(\'' . $class . '\') AS alias, count(class_alias) AS nums'))
                ->where('class_alias', 'like', $class . '%')->first();

            array_push($month, array("y" => $classification->nums, "label" => $classification->alias));

        }

        $res['quarter'] = json_encode($quarter, JSON_NUMERIC_CHECK);
        $res['month'] = json_encode($month, JSON_NUMERIC_CHECK);
        return $res;
    }
}