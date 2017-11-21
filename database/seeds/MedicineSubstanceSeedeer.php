<?php

use Illuminate\Database\Seeder;

include_once('lib/curl.php');
include_once('lib/simple_html_dom.php');

class MedicineSubstanceSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = curl::app('https://tabletki.ua')
            ->config_load('/var/www/html/database/seeds/wiki.cnf')
            ->follow(true);

        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        Eloquent::unguard();

//        $rus = include_once 'items/item_A.php';
//        $rus = include_once 'items/item_B.php';
//        $rus = include_once 'items/item_C.php';
//        $rus = include_once 'items/item_D.php';
//        $rus = include_once 'items/item_G.php';
//        $rus = include_once 'items/item_H.php';
//        $rus = include_once 'items/item_J.php';
//        $rus = include_once 'items/item_L.php';
//        $rus = include_once 'items/item_M.php';
//        $rus = include_once 'items/item_N.php';
//        $rus = include_once 'items/item_P.php';
//        $rus = include_once 'items/item_R.php';
//        $rus = include_once 'items/item_S.php';
        $rus = include_once 'items/item_V.php';
        $count = count($rus);
        dd($count);
        $i = 1;
        $k = 0;
        foreach ($rus as $medicine) {
            $k++;
//            if($k < 4) continue;
//            if($k > 40) continue;
//            if ('Пегферон' !== $medicine->title) continue;

            if (empty($medicine->title)) {
                $this->command->info('Ошибка записи вещества(Title): ' . $medicine->url);
                \Log::info('Ошибка записи вещества(Title): ' . $medicine->url);
                continue;
            }

            $alias = $this->transliterate($medicine->title);
            $model_medicine = \Fresh\Medpravda\Medicine::where('alias', $alias)->first();
            $umedicine = \Fresh\Medpravda\Umedicine::where('alias', $alias)->first();

            if (is_null($model_medicine) || is_null($umedicine)) continue;

            $data = $c->request(str_replace('https://tabletki.ua/', '', $medicine->url) . 'analogi/');
            $html = str_get_html($data['html']);
            if (empty($html)) continue;

            $dl = $html->find('dl', 0);
            if (empty($dl)) continue;
            $dt = $dl->find('dt');
            if (empty($dt)) continue;

            foreach ($dt as $d) {
                if ('Действующие вещества' != trim($d->innertext)) continue;
                if (empty($d->next_sibling()->find('a'))) continue;
                $substances = [];
                foreach ($d->next_sibling()->find('a') as $dd) {
                    $substances[] = $dd->innertext;
                }
            }

            foreach ($dt as $d) {
                if ('Форма выпуска' != trim(strip_tags($d->innertext))) continue;

                if (empty($d->next_sibling())) continue;
                $form = trim(strip_tags($d->next_sibling()->innertext));
            }


            if (!empty($form)) {
                $alias = $this->transliterate($form);
                $form_id = \Fresh\Medpravda\Form::firstOrCreate(
                    ['alias' => $alias], ['name' => $form, 'uname' => $form]
                );
            }

            if (empty($substances)) continue;

            $subs = [];

            foreach ($substances as $substance) {
                $id = \Fresh\Medpravda\Substance::where('title', $substance)->first();
                if (is_null($id)) continue;
                $subs[] = $id->id;
            }
            if (empty($subs)) continue;
            try {
                if (!empty($form_id)) {
                    $model_medicine->form_id = $form_id->id;
                    $model_medicine->save();
                    $umedicine->form_id = $form_id->id;
                    $umedicine->save();
                }
                $model_medicine->substance()->attach($subs);
                $umedicine->substance()->attach($subs);

            } catch (Exception $e) {
                $this->command->info('Вещество - ' . $medicine->title . ' ошибка: ' . str_limit($e->getMessage(), 255));
                \Log::info('Ошибка записи вещества(Title): ' . $e->getMessage());
                $i++;
                continue;
            }

//            content Images

            $this->command->info('Препарат - ' . $i . ' из ' . $count . ' title => ' . $medicine->title . ' | ID: ' . $model_medicine->id);
            $i++;
        }

    }


    public function transliterate($string)
    {
        $str = mb_strtolower($string, 'UTF-8');

        $leter_array = array(
            'a' => 'а',
            'b' => 'б',
            'v' => 'в',
            'g' => 'г,ґ',
            'd' => 'д',
            'e' => 'е,э',
            'jo' => 'ё',
            'zh' => 'ж',
            'z' => 'з',
            'i' => 'и',
            'j' => 'й',
            'k' => 'к',
            'l' => 'л',
            'm' => 'м',
            'n' => 'н',
            'o' => 'о',
            'p' => 'п',
            'r' => 'р',
            's' => 'с',
            't' => 'т',
            'u' => 'у',
            'f' => 'ф',
            'kh' => 'х',
            'ts' => 'ц',
            'ch' => 'ч',
            'sh' => 'ш',
            'shch' => 'щ',
            'j' => 'ъ',
            'y' => 'ы',
            'j' => 'ь',
            'yu' => 'ю',
            'ya' => 'я',
        );

        foreach ($leter_array as $leter => $kyr) {
            $kyr = explode(',', $kyr);

            $str = str_replace($kyr, $leter, $str);
        }

        //  A-Za-z0-9-
        $str = preg_replace('/(\s|[^A-Za-z0-9\-_])+/', '-', $str);

        $str = trim($str, '-');

        return $str;
    }
}
