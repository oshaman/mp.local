<?php

use Illuminate\Database\Seeder;

class SeosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seos')->insert(
            [
                ['uri' => '/'],
                ['uri' => '/ua'],
                ['uri' => 'onas'],
                ['uri' => 'onas/ua'],
                ['uri' => 'soglashenie'],
                ['uri' => 'soglashenie/ua'],
                ['uri' => 'usloviya'],
                ['uri' => 'usloviya/ua'],
                ['uri' => 'reklama'],
                ['uri' => 'reklama/ua'],
            ]
        );
    }
}
