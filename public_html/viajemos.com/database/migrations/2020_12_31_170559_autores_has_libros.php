<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AutoresHasLibros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('autores_has_libros', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer("autores_id")->unsigned();
            $table->bigInteger("libros_ISBN")->unsigned();
            $table->foreign('autores_id')->references('id')->on('autores');
            $table->foreign('libros_ISBN')->references('ISBN')->on('libros');
            $table->timestamps();
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
        Schema::dropIfExists('autores_has_libros');
    }
}
