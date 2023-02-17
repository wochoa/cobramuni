<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasificadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clasificador', function (Blueprint $table) {
            $table->increments('idclasificador');
            $table->text('text_clasificador');//texto clasificador
            $table->text('codigoclasificador');//codigo clasificador
            $table->integer('estado_cla')->default(1);//activo 1: desactivado:0
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
        Schema::dropIfExists('clasificador');
    }
}
