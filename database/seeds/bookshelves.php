<?php

use Illuminate\Database\Seeder;

class bookshelves extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($j = 1; $j < 21; $j++) {
            for ($i = 0; $i < 15; $i++) {
                DB::table('bookshelves')->insert([
                    'free_book_places' => 10,
                    'shelve_number' => $i,
                    'bookcase' => $j,
                ]);
            }
        }
    }
}
