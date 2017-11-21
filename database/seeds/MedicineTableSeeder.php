<?php

use Illuminate\Database\Seeder;

include_once('lib/curl.php');
include_once('lib/simple_html_dom.php');

class MedicineTableSeeder extends Seeder
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
        $k = 1;
        foreach ($rus as $medicine) {
            $k++;
//            if($k < 384) continue;
//            if($k > 40) continue;
//            if ('Пегферон' !== $medicine->title) continue;


            if (empty($medicine->title)) {
                $this->command->info('Ошибка записи вещества(Title): ' . $medicine->url);
                \Log::info('Ошибка записи вещества(Title): ' . $medicine->url);
                continue;
            }
            $alias = $this->transliterate($medicine->title);

            $data = $this->getItems($medicine->url, $alias, $c);

            if (false == $data) {
                $this->command->info('Ошибка записи вещества: ' . $medicine->url);
                continue;
            }

            $data = array_map(function ($v) {
                if (is_array($v)) return $v;

                $v = strip_tags($v, '<img><table><tbody><tr><td><th><h2>');

                $v = str_replace('«', '', $v);
                $v = str_replace('»', '', $v);

                $reg = '/<(td|tr|div|th|h2|table|p) [^>]+/';

                return preg_replace($reg, '<$1', $v);

            }, $data);

            if (!empty($data['fabricator'])) {
                $res = \Fresh\Medpravda\Fabricator::select('id')->where('title', $data['fabricator_name'])->first();
                if (!empty($res->id)) {
                    $fabricator = $res->id;
                } else {
                    $fabricator = 10000;
                }
            } else {
                $fabricator = 10000;
            }

            if (!empty($data['farm'])) {
                $res = \Fresh\Medpravda\Pharmagroup::select('id')->where('title', $data['farm'])->first();
                if (!empty($res->id)) {
                    $pharm = $res->id;
                } else {
                    $pharm = 10000;
                }
            } else {
                $pharm = 10000;
            }

            if (!empty($data['mnn'])) {
                $res = \Fresh\Medpravda\Innname::select('id')->where('title', $data['mnn'])->first();

                if (!empty($res->id)) {
                    $inn = $res->id;
                } else {
                    $inn = 10000;
                }
            } else {
                $inn = 10000;
            }

            if (!empty($data['atx'])) {
                $res = \Fresh\Medpravda\Classification::select('id')->where('class', $data['atx'])->first();
                if (!empty($res->id)) {
                    $atx = $res->id;
                } else {
                    $atx = 10000;
                }
            } else {
                $atx = 10000;
            }

            try {
                $res = \Fresh\Medpravda\Medicine::create([
                    'title' => $medicine->title,
                    'alias' => $alias,

                    'fabricator_id' => $fabricator,
                    'innname_id' => $inn,
                    'pharmagroup_id' => $pharm,
                    'reg' => $data['reg'],
                    'classification_id' => $atx,

                    'consist' => $data['consist'] ?? null,
                    'docs_form' => $data['docs_form'] ?? null,
                    'physicochemical_char' => $data['physicochemical_char'] ?? null,
                    'fabricator' => $data['fabricator'] ?? null,
                    'addr_fabricator' => $data['addr_fabricator'] ?? null,
                    'pharm_group' => $data['pharm_group'] ?? null,
                    'indications' => $data['indications'] ?? null,
                    'pharm_prop' => $data['pharm_prop'] ?? null,
                    'contraindications' => $data['contraindications'] ?? null,
                    'security' => $data['security'] ?? null,
                    'application_features' => $data['application_features'] ?? null,
                    'pregnancy' => $data['pregnancy'] ?? null,
                    'cars' => $data['cars'] ?? null,
                    'children' => $data['children'] ?? null,
                    'app_mode' => $data['app_mode'] ?? null,
                    'overdose' => $data['overdose'] ?? null,
                    'side_effects' => $data['side_effects'] ?? null,
                    'interaction' => $data['interaction'] ?? null,
                    'shelf_life' => $data['shelf_life'] ?? null,
                    'saving' => $data['saving'] ?? null,
                    'packaging' => $data['packaging'] ?? null,
                    'leave_cat' => $data['leave_cat'] ?? null,
                    'additionally' => $data['additionally'] ?? null,
                    'dose' => $data['dose'] ?? null,

                ]);
            } catch (Exception $e) {
                $this->command->info('Вещество - ' . $medicine->title . ' ошибка: ' . str_limit($e->getMessage(), 255));
                \Log::info('Ошибка записи вещества(Title): ' . $e->getMessage());
                $i++;
                continue;
            }

            //            Main Image
            if (empty($data['img'])) {
                $path = null;
            } else {
                $path = $this->mainImg('https:' . $data['img']['src'], $res->alias);
            }

            if (!empty($path)) {
                try {
                    $res->image()->create(['path' => $path, 'alt' => $data['img']['alt'], 'title' => $data['img']['title']]);
                } catch (Exception $e) {
                    \Log::info('Ошибка записи картинки: ' . $e->getMessage());
                }
            }

//            Main Image
//            content Images
            if (!empty($data['path'])) {
                try {
                    $res->photo()->createMany($data['path']);
                } catch (Exception $e) {
                    \Log::info('Ошибка записи фотографий: ', $e->getMessage());
                    $error[] = ['tag' => 'Ошибка записи фотографий'];
                }
            }
//            content Images

            $this->command->info('Препарат - ' . $i . ' из ' . $count . ' title => ' . $medicine->title . ' | ID: ' . $res->id);
            $i++;
        }

    }

    public function getAlias($title)
    {
        $alias = $this->transliterate($title);
        $res = \Fresh\Medpravda\Medicine::select('id')->where('alias', $alias)->first();
        if (!empty($res->id)) {
            $alias = str_random(4) . $alias;
        }
        return $alias;
    }

    public function getItems($url, $alias, $c)
    {
        $data = $c->request(str_replace('https://tabletki.ua/', '', $url));
        $html = str_get_html($data['html']);
        if (empty($html)) return false;

//        MainImage
        $mainimg = $html->getElementById("ctl00_MAIN_ContentPlaceHolder_InstructionPanel");
        if (is_null($mainimg)) return false;

        if ($mainimg->find('div#ctl00_MAIN_ContentPlaceHolder_PhotoPanel_ImagePanel', 0)) {
            $img['src'] = $mainimg->find('div#ctl00_MAIN_ContentPlaceHolder_PhotoPanel_ImagePanel img', 0)->src;
            $img['alt'] = $mainimg->find('div#ctl00_MAIN_ContentPlaceHolder_PhotoPanel_ImagePanel img', 0)->alt;
            $img['title'] = $mainimg->find('div#ctl00_MAIN_ContentPlaceHolder_PhotoPanel_ImagePanel img', 0)->title;
        } else {
            $img = null;
        }
        $res['img'] = $img;
//        MainImage

        $maindiv = $html->getElementById("ctl00_MAIN_ContentPlaceHolder_NeedTranslatePanel");

        if (!is_null($maindiv)) {
            $content = $this->contentHandler($maindiv, $alias);

            $res['consist'] = ' ';
            $res['docs_form'] = ' ';
            $res['physicochemical_char'] = ' ';
            $res['fabricator'] = ' ';
            $res['addr_fabricator'] = ' ';
            $res['pharm_group'] = ' ';
            $res['indications'] = ' ';
            $res['pharm_prop'] = ' ';
            $res['contraindications'] = ' ';
            $res['security'] = ' ';
            $res['application_features'] = ' ';
            $res['pregnancy'] = ' ';
            $res['cars'] = ' ';
            $res['children'] = ' ';
            $res['app_mode'] = ' ';
            $res['overdose'] = ' ';
            $res['side_effects'] = ' ';
            $res['interaction'] = ' ';
            $res['shelf_life'] = ' ';
            $res['saving'] = ' ';
            $res['packaging'] = ' ';
            $res['leave_cat'] = ' ';
            $res['additionally'] = ' ';

            if ($content['content']->find('h2')) {

                $h = $content['content']->find('h2');
                foreach ($h as $v) {
                    switch ($v->innertext) {
                        case 'Склад':
                            $res['consist'] .= $this->getContent($v);
                            break;
                        case 'Склад лікарського засобу':
                            $res['consist'] .= $this->getContent($v);
                            break;
                        case 'Якісний та кількісний склад':
                            $res['consist'] .= $this->getContent($v);
                            break;
                        case 'Состав':
                            $res['consist'] .= $this->getContent($v);
                            break;
//                        Лекарственная форма
                        case 'Лікарська форма':
                            $res['docs_form'] .= $this->getContent($v);
                            break;
//                        Основные физико-химические свойства
                        case 'Основні фізико-хімічні властивості':
                            $res['physicochemical_char'] .= $this->getContent($v);
                            break;
//                      Производитель
                        case 'Назва і місцезнаходження виробника':
                            $res['fabricator'] .= $this->getContent($v);
                            break;
                        case 'Виробник':
                            $res['fabricator'] .= $this->getContent($v);
                            break;
                        case 'Производитель':
                            $res['fabricator'] .= $this->getContent($v);
                            break;
                        case 'Назва та адреса виробника':
                            $res['fabricator'] .= $this->getContent($v);
                            break;
                        case 'Виробники':
                            $res['fabricator'] .= $this->getContent($v);
                            break;
                        case 'Виробник/заявник':
                            $res['fabricator'] .= $this->getContent($v);
                            break;
//                        Местонахождение производителя
                        case 'Місцезнаходження виробника та його адреса місця провадження діяльності':
                            $res['addr_fabricator'] .= $this->getContent($v);
                            break;
                        case 'Місцезнаходження виробника та адреса місця провадження його діяльності':
                            $res['addr_fabricator'] .= $this->getContent($v);
                            break;
                        case 'Назва і місце знаходження виробника':
                            $res['addr_fabricator'] .= $this->getContent($v);
                            break;
                        case 'Назва та місцезнаходження виробника':
                            $res['addr_fabricator'] .= $this->getContent($v);
                            break;
                        case 'Місцезнаходження виробників та їх адреси місць провадження діяльності':
                            $res['addr_fabricator'] .= $this->getContent($v);
                            break;
//                        Фармакотерапевтическая группа
                        case 'Фармакотерапевтична група':
                            $res['pharm_group'] .= $this->getContent($v);
                            break;
//                        Фармакологические свойства
                        case 'Фармакологічні властивості':
                            $res['pharm_prop'] .= $this->getContent($v);
                            break;
                        case 'Фармакологические свойства':
                            $res['pharm_prop'] .= $this->getContent($v);
                            break;
                        case 'Фармакологічні характеристики':
                            $res['pharm_prop'] .= $this->getContent($v);
                            break;
//                        Показания к применению
                        case 'Показання для застосування':
                            $res['indications'] .= $this->getContent($v);
                            break;
                        case 'Показання до застосування':
                            $res['indications'] .= $this->getContent($v);
                            break;
                        case 'Показания к применению':
                            $res['indications'] .= $this->getContent($v);
                            break;
                        case 'Показання':
                            $res['indications'] .= $this->getContent($v);
                            break;
                        case 'Показания':
                            $res['indications'] .= $this->getContent($v);
                            break;
//                        Противопоказания
                        case 'Протипоказання':
                            $res['contraindications'] .= $this->getContent($v);
                            break;
                        case 'Противопоказания':
                            $res['contraindications'] .= $this->getContent($v);
                            break;
//                        Надлежащие меры безопасности при применении
                        case 'Належні заходи безпеки при застосуванні':
                            $res['security'] .= $this->getContent($v);
                            break;
                        case 'Належні засоби безпеки при застосуванні':
                            $res['security'] .= $this->getContent($v);
                            break;
                        case 'Особливі заходи безпеки':
                            $res['security'] .= $this->getContent($v);
                            break;
                        case 'Особые меры безопасности':
                            $res['security'] .= $this->getContent($v);
                            break;
//                        Особенности применения
                        case 'Особливості застосування':
                            $res['application_features'] .= $this->getContent($v);
                            break;
                        case 'Особенности применения':
                            $res['application_features'] .= $this->getContent($v);
                            break;
//                        Применение в период беременности или кормления грудью
                        case 'Застосування у період вагітності або годування груддю':
                            $res['pregnancy'] .= $this->getContent($v);
                            break;
                        case 'Застосування у період вагітності та годування груддю':
                            $res['pregnancy'] .= $this->getContent($v);
                            break;
                        case 'Застосування в період вагітності або годування груддю':
                            $res['pregnancy'] .= $this->getContent($v);
                            break;
                        case 'Застосування в період вагітності та годування груддю':
                            $res['pregnancy'] .= $this->getContent($v);
                            break;
                        case 'Применение в период беременности или кормления грудью':
                            $res['pregnancy'] .= $this->getContent($v);
                            break;
//                        Способность влиять на скорость реакции при управлении автотранспортом или другими механизмами
                        case 'Здатність впливати на швидкість реакції при керуванні автотранспортом або роботі з іншими механізмами':
                            $res['cars'] .= $this->getContent($v);
                            break;
                        case 'Здатність впливати на швидкість реакції при керуванні автотранспортом або іншими механізмами':
                            $res['cars'] .= $this->getContent($v);
                            break;
                        case 'Здатність впливати на швидкість реакцій при керуванні автотранспортом або іншими механізмами':
                            $res['cars'] .= $this->getContent($v);
                            break;
                        case 'Здатність впливати на швидкість реакцій при керуванні автотранспортом або роботі з іншими механізмами':
                            $res['cars'] .= $this->getContent($v);
                            break;
                        case 'Здатність впливати на швидкість реакції при керуванні автотранспортом або з іншими механізмами':
                            $res['cars'] .= $this->getContent($v);
                            break;
                        case 'Здатність впливати на швидкість реакції при керуванні автотранспортом або під час роботи з іншими механізмами':
                            $res['cars'] .= $this->getContent($v);
                            break;
                        case 'Вплив на здатність керувати транспортними засобами і механізмами':
                            $res['cars'] .= $this->getContent($v);
                            break;
                        case 'Вплив на здатність керування автотранспортом':
                            $res['cars'] .= $this->getContent($v);
                            break;
//                        Дети
                        case 'Діти':
                            $res['children'] .= $this->getContent($v);
                            break;
//                        Способ применения и дозы
                        case 'Спосіб застосування та дози':
                            $res['app_mode'] .= $this->getContent($v);
                            break;
                        case 'Способ применения и дозы':
                            $res['app_mode'] .= $this->getContent($v);
                            break;
                        case 'Частота застосування':
                            $res['app_mode'] .= $this->getContent($v);
                            break;
                        case 'Спосіб застосування і дози':
                            $res['app_mode'] .= $this->getContent($v);
                            break;
                        case 'Спосіб вживання':
                            $res['app_mode'] .= $this->getContent($v);
                            break;
                        case 'Спосіб застосування':
                            $res['app_mode'] .= $this->getContent($v);
                            break;
                        case 'Рекомендації до вживання':
                            $res['app_mode'] .= $this->getContent($v);
                            break;
//                        Передозировка
                        case 'Передозування':
                            $res['overdose'] .= $this->getContent($v);
                            break;
                        case 'Передозировка':
                            $res['overdose'] .= $this->getContent($v);
                            break;
//                        Побочные действия
                        case 'Побічні ефекти':
                            $res['side_effects'] .= $this->getContent($v);
                            break;
                        case 'Побічні реакції':
                            $res['side_effects'] .= $this->getContent($v);
                            break;
                        case 'Побічна дія':
                            $res['side_effects'] .= $this->getContent($v);
                            break;
                        case 'Побочные реакции':
                            $res['side_effects'] .= $this->getContent($v);
                            break;
                        case 'Побочные эффекты':
                            $res['side_effects'] .= $this->getContent($v);
                            break;
//                        Взаимодействие с другими лекарственными средствами и другие виды взаимодействий
                        case 'Взаємодія з іншими лікарськими засобами та інші види взаємодій':
                            $res['interaction'] .= $this->getContent($v);
                            break;
                        case 'Взаємодія з іншими лікарськими засобами':
                            $res['interaction'] .= $this->getContent($v);
                            break;
                        case 'Взаємодія з іншими лікарськими засобами та інші види взаємодії':
                            $res['interaction'] .= $this->getContent($v);
                            break;
                        case 'Взаємодія з іншими лікарськими засобами та інші форми взаємодій':
                            $res['interaction'] .= $this->getContent($v);
                            break;
//                        Срок годности
                        case 'Термін придатності':
                            $res['shelf_life'] .= $this->getContent($v);
                            break;
                        case 'Умови та термін зберігання':
                            $res['shelf_life'] .= $this->getContent($v);
                            break;
                        case 'Срок годности':
                            $res['shelf_life'] .= $this->getContent($v);
                            break;
                        case 'Умови зберігання та строк придатності':
                            $res['shelf_life'] .= $this->getContent($v);
                            break;
//                        Условия хранения
                        case 'Умови зберігання':
                            $res['saving'] .= $this->getContent($v);
                            break;
                        case 'Условия хранения':
                            $res['saving'] .= $this->getContent($v);
                            break;
                        case 'Термін зберігання':
                            $res['saving'] .= $this->getContent($v);
                            break;
//                        Упаковка
                        case 'Упаковка':
                            $res['packaging'] .= $this->getContent($v);
                            break;
                        case 'Пакування':
                            $res['packaging'] .= $this->getContent($v);
                            break;
//                        Категория отпуска
                        case 'Категорія відпуску':
                            $res['leave_cat'] .= $this->getContent($v);
                            break;
                        case 'Категорія відпустку':
                            $res['leave_cat'] .= $this->getContent($v);
                            break;
                        case 'Умови відпуску':
                            $res['leave_cat'] .= $this->getContent($v);
                            break;
                        default:
                            $res['additionally'] .= $v->outertext . $this->getContent($v);
                    }
                }
            }
        }
        //            table
        $maindiv = $html->getElementById("ctl00_MAIN_ContentPlaceHolder_InstructionPanel");
        $dose = null;
        $fabricator = null;
        $farm = null;
        $reg = null;
        $mnn = null;
        $atx = null;

        if ($maindiv->find('table.table', 0)) {
            $table = $maindiv->find('table.table', 0);
            if ($table->find('tr', 0)) {
                $trs = $table->find('tr');
                foreach ($trs as $tr) {
                    switch (trim($tr->firstChild()->innertext)) {
                        case 'Дозировка':
                            $dose = trim($tr->lastChild()->innertext ?? null);
                            break;
                        case 'Производитель':
                            $fabricator = trim($tr->lastChild()->innertext ?? null);
                            break;
                        case 'МНН':
                            $mnn = trim($tr->lastChild()->innertext ?? null);
                            break;
                        case 'Фарм. группа':
                            $farm = trim($tr->lastChild()->innertext ?? null);
                            break;
                        case 'Регистрация':
                            $reg = trim($tr->lastChild()->innertext ?? null);
                            break;
                        case 'Код АТХ':
                            $atx = trim($tr->lastChild()->lastChild()->firstChild()->plaintext ?? null);
                            break;
                        default:
                            false;
                    }
                }
            }
        }
        $res['dose'] = $dose ?? null;
        $res['fabricator_name'] = $fabricator ?? null;
        $res['farm'] = $farm ?? null;
        $res['reg'] = $reg ?? null;
        $res['mnn'] = $mnn ?? null;
        $res['atx'] = $atx ?? null;
        $res['path'] = $content['path'] ?? '';
//            table
        return $res;
    }

    public function getContent($v)
    {
        $content = '';
        while (!empty($v->next_sibling()) && ('h2' != $v->next_sibling()->tag)) {
            $content .= $v->next_sibling()->outertext;
            $v = $v->next_sibling();
        }
        return $content;
    }

    public function mainImg($image, $alias)
    {
        $path = substr($alias, 0, 64) . '-' . time() . '.jpeg';

        try {
            $img = Image::make($image);
        } catch (Intervention\Image\Exception\NotReadableException $e) {
            return null;
        }

        $img->resize(Config::get('settings.medicine_img')['main']['width'], null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path() . '/asset/images/medicine/main/' . $path, 100);;

        return $path;

    }

    public function contentHandler($imgs, $alias)
    {
        if (!empty($imgs->find('img')[0])) {
            $p = [];
            foreach ($imgs->find('img') as $img) {
                $path = substr($alias, 0, 64) . '-' . str_random(4) . time() . '.jpeg';
                $src = $img->src ?? null;

                if ($img->width > 712) {
                    $width = 712;
                } else {
                    $width = $img->width ?? 356;
                }

                $result = $this->contentImg($src, $path, $width);

                if (is_null($result)) {
                    $img->outertext = '';
                } else {
                    $img->src = $result;
                }
                $p[] = $path;
            }
        }

        if (isset($p)) {
            $p = array_map(function ($v) {
                return ['path' => $v];
            }, $p);
            $res['path'] = $p;
        }

        $res['content'] = $imgs;
        return $res;
    }

    public function contentImg($src, $path, $width)
    {
        try {
            $img = Image::make('http:' . $src);
        } catch (Intervention\Image\Exception\NotReadableException $e) {
            return null;
        }

        $img->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path() . '/asset/images/medicine/content/' . $path, 100);;

        return '/asset/images/medicine/content/' . $path;

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
