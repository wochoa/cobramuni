<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCobranzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobranzas', function (Blueprint $table) {
            $table->increments('idcobrazas');
            $table->integer('idusuario');
            $table->integer('idtipoformato');// formato 8, 9,etc -> de la tabla tipoformato
            $table->text('codigorecibo');// 2022--007454
            $table->date('fechaemision');// 02/11-2022
            $table->text('ruc');
            $table->text('dni');
            $table->text('nom_razonsocial');
            // $table->integer('iddetallecobranza');
            $table->decimal('montonumero');//10.00
            $table->text('montotexto');//SON: Diez con 60/100 soles
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
        Schema::dropIfExists('cobranzas');
    }
}
