<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->timestamps();
        });
        Schema::create('movies', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 191);
            $table->integer('genre_id')->unsigned();
            $table->year('year');
            $table->integer('duration')->unsigned();
            $table->string('image');
            $table->timestamps();

            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
