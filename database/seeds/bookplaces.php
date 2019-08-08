<?php

use Illuminate\Database\Seeder;

class bookplaces extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 21; $i++) {
            for ($j = 1; $j < 16; $j++) {
                for ($k = 1; $k < 11; $k++) {
                    DB::table('bookplaces')->insert([
                        'is_busy' => false,
                        'is_free' => true,
                        'case' => $i,
                        'shelve' => $j,
                        'place' => $k
                    ]);
                }
            }
        }

    }
}
