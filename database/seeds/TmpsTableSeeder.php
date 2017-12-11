<?php

use Illuminate\Database\Seeder;

class TmpsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = \Fresh\Medpravda\Tmp::select('id', 'alias')->get();

        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        Eloquent::unguard();

        $count = $data->count();
        dd($count);
        $i = 1;
        foreach ($data as $alias) {

            $article = \Fresh\Medpravda\Innname::where(['id' => $alias->id])->first();

            try {
                $article->alias = $alias->alias;
                $article->save();
            } catch (PDOException $e) {
                \Log::info('Ошибка записи: ' . $e->getMessage());
                continue;
            }

            $this->command->info('Статья - ' . $i . ' из ' . $count . ' ID => ' . $alias->id . ' | Новый ID=>' . $article->id);
            $i++;
        }


//        Events
        /*$data = \Fresh\Medpravda\Innname::select('id', 'alias')->get();

        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        Eloquent::unguard();

        $count = $data->count();
//        dd($count);
        $i = 1;
        foreach ($data as $alias) {

            $res = $this->transliterate($alias->alias);

            try {
                $article = \Fresh\Medpravda\Tmp::create([
                    'id' => $alias->id,
                    'alias' => $res,
                ]);
            } catch (PDOException $e) {
                \Log::info('Ошибка записи: ' . $e->getMessage());
                continue;
            }

            $this->command->info('Статья - ' . $i .' из '. $count .' ID => '.$alias->id . ' | Новый ID=>' . $article->id);
            $i++;
        }*/
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
            '' => 'ъ',
            'y' => 'ы',
            '' => 'ь',
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
