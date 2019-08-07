<?php

use Illuminate\Database\Seeder;

class book_copy extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_copy')->insert([
            'author' => 1,
            'title' => 'Порог',
            'publishing_year' => '2019-06-24',
        ]);
    }
}
