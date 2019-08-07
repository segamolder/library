<?php

use Illuminate\Database\Seeder;

class category_name extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_name')->insert([
            'name' => 'Фантастика',
        ]);
    }
}
