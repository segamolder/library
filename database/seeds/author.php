<?php

use Illuminate\Database\Seeder;

class author extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('author')->insert([
            'name' => 'Сергей Лукьяненко'
        ]);
    }
}
