<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallecobranzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallecobranzas', function (Blueprint $table) {
            $table->increments('iddetalle_cobra');
            $table->integer('codcobranza');
            $table->integer('idconcep')->nullable();//
            $table->text('concepto');// expdedicion de partidas: expediecion de partidas
            $table->decimal('monto');//10.60
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
        Schema::dropIfExists('detallecobranzas');
    }
}
