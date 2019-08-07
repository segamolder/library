<?php

use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => '4@4.ru',
            'password' => '$2y$10$pqkvRZPxBgAXF2OpDovgDuW7V1bEXUYZ/fUma/wR/eDB6xSv4l4Xy',
            'is_librarian' => '0',
            'remember_token' => null
        ]);
    }
}
