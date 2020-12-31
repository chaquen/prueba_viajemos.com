<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class libros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('libros', function (Blueprint $table) {
            $table->id("id");
            $table->bigInteger("ISBN")->index()->unsigned();
            $table->bigInteger('editoriales_id')->index()->unsigned();
            $table->string('titulo');
            $table->text('sinopsis');
            $table->string('n_paginas');
            $table->timestamps();
            $table->foreign('editoriales_id')->references('id')->on('editoriales');
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
        Schema::dropIfExists('libros');
    }
}
