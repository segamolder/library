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
//        DB::table('bookplaces')->insert([
//            'is_busy' => false,
//            'is_free' => false,
//            'shelve' => 1
//        ]);
//        for ($k = 0; $k < 9; $k++) {
//            DB::table('bookplaces')->insert([
//                'is_busy' => false,
//                'is_free' => true,
//                'shelve' => 1
//            ]);
//        }
//        for ($j = 2; $j < 15; $j++) {
//            for ($i = 0; $i < 10; $i++) {
//                DB::table('bookplaces')->insert([
//                    'is_busy' => false,
//                    'is_free' => true,
//                    'shelve' => $j
//                ]);
//            }
//        }
        for ($i = 1; $i < 16; $i++) {
            for ($j = 1; $j < 11; $j++) {
                DB::table('bookplaces')->insert([
                    'is_busy' => false,
                    'is_free' => true,
                    'shelve' => $j,
                    'place_number' => $j
                ]);
            }
        }

    }
}
