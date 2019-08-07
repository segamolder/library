<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bookshelves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookshelves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('free_book_places');
            $table->bigInteger('bookcase')->unsigned();
            $table->integer('shelve_number');
            $table->timestamps();

            $table->foreign('bookcase')->references('id')->on('bookcases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookshelves');
    }
}
