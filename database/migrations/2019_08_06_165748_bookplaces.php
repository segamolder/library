<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bookplaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookplaces', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_busy');
            $table->boolean('is_free');
            $table->integer('shelve')->unsigned();
            $table->integer('place_number');
            $table->timestamps();

            $table->foreign('shelve')->references('id')->on('bookshelves')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookplaces');
    }
}
