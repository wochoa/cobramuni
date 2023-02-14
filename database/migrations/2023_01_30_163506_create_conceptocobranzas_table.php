<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptocobranzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceptocobranzas', function (Blueprint $table) {
            $table->increments('idconceptocobranza');
            $table->text('text_concepto');//EXPEDIENCION DE PARTIDAS
            $table->decimal('nomto_concepto');//10.60
            $table->integer('estado_concepto');//activo 1: desactivado:0
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
        Schema::dropIfExists('conceptocobranzas');
    }
}
