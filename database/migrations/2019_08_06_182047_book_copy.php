<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookCopy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_copy', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author')->unsigned();
            $table->text('title');
            $table->date('publishing_year');
            $table->timestamps();

            $table->foreign('author')->references('id')->on('author')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_copy');
    }
}
