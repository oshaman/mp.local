<?php

use Illuminate\Database\Seeder;

class AmedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicines = Fresh\Medpravda\Medicine::select(
            'id', 'alias', 'title', 'fabricator_id', 'innname_id', 'pharmagroup_id', 'classification_id', 'form_id')
            ->get();
        $count = count($medicines);
        $i = 0;
        foreach ($medicines as $medicine) {
            try {
                $res = \Fresh\Medpravda\Uamedicine::create([
                    'id' => $medicine->id,
                    'title' => $medicine->title,
                    'alias' => $medicine->alias,

                    'fabricator_id' => $medicine->fabricator_id,
                    'innname_id' => $medicine->innname_id,
                    'pharmagroup_id' => $medicine->pharmagroup_id,
                    'reg' => $medicine->reg,
                    'classification_id' => $medicine->classification_id,
                    'form_id' => $medicine->form_id,
                    'approved' => 1,
                ]);
            } catch (Exception $e) {
                $this->command->info('Вещество - ' . $medicine->title . ' ошибка: ' . str_limit($e->getMessage(), 255));
                \Log::info('Ошибка записи вещества(Title): ' . $e->getMessage());
                $i++;
                continue;

            }
            $i++;
            $this->command->info('Препарат - ' . $i . ' из ' . $count . ' title => ' . $medicine->title . ' | ID: ' . $res->id);
        }
    }
}
