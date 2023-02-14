<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Depedencias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ///dependencia
        DB::table('tram_dependencia')->insert([
            [
                'depe_nombre'     => 'SEDE CENTRAL',
                'depe_abreviado'  => 'SEDE',
                'depe_tipo'       => 0,
                'depe_proyectado' => 0,
                'depe_estado'     => 1,
                'depe_agente'     => 0,
            ],
        ]);
        DB::table('tram_dependencia')->insert([
            [
                'depe_nombre'           => 'OFICINA INFORMÁTICA',
                'depe_abreviado'        => 'INFO',
                'depe_sigla'            => 'OF',
                'depe_representante'    => 'REPRESENTANTE',
                'depe_cargo'            => 'DIRECTOR',
                'depe_dni'              => '46181970',
                'depe_depende'          => 1,
                'depe_superior'         => '{"dependencia":2,"nombre":"SUB GERENCIA DE DESARROLLO INSTITUCIONAL Y SISTEMAS"}',
                'depe_tipo'             => 1,
                'depe_proyectado'       => 1,
                'depe_estado'           => 1,
                'depe_idusuario'        => 1,
                'depe_recibetramite'    => 1,
                'depe_agente'           => 0,
                'depe_mesa_virtual'     => 1,
                'depe_diasmaxenproceso' => 100,
            ],
            [
                'depe_nombre'           => 'OFICINA INFRAESTRUCTURA',
                'depe_abreviado'        => 'GRI',
                'depe_sigla'            => 'GRI',
                'depe_representante'    => 'REPRESENTANTE',
                'depe_cargo'            => 'GERENTE',
                'depe_dni'              => '46181975',
                'depe_depende'          => 1,
                'depe_superior'         => '{"dependencia":3,"nombre":"GERENCIA DE INFRAESTRUCTURA"}',
                'depe_tipo'             => 1,
                'depe_proyectado'       => 1,
                'depe_estado'           => 1,
                'depe_idusuario'        => 1,
                'depe_recibetramite'    => 1,
                'depe_agente'           => 0,
                'depe_mesa_virtual'     => 0,
                'depe_diasmaxenproceso' => 100,
            ],
        ]);
        DB::table('tram_dependencia')->insert([
            [

                'depe_nombre'           => 'PERSONA NATURAL',
                'depe_abreviado'        => 'PN',
                'depe_tipo'             => 2,
                'depe_proyectado'       => 0,
                'depe_estado'           => 1,
                'depe_idusuario'        => 1,
                'depe_recibetramite'    => 0,
                'depe_agente'           => 0,
                'depe_mesa_virtual'     => 0,
                'depe_diasmaxenproceso' => 100,
            ],
            [
                'depe_nombre'           => 'OTRAS EMPRESAS',
                'depe_abreviado'        => 'OE',
                'depe_tipo'             => 2,
                'depe_proyectado'       => 0,
                'depe_estado'           => 1,
                'depe_idusuario'        => 1,
                'depe_recibetramite'    => 0,
                'depe_agente'           => 0,
                'depe_mesa_virtual'     => 0,
                'depe_diasmaxenproceso' => 100,
            ],
            [
                'depe_nombre'           => 'OTRAS ENTIDADES',
                'depe_abreviado'        => 'OE',
                'depe_tipo'             => 2,
                'depe_proyectado'       => 0,
                'depe_estado'           => 1,
                'depe_idusuario'        => 1,
                'depe_recibetramite'    => 0,
                'depe_agente'           => 0,
                'depe_mesa_virtual'     => 0,
                'depe_diasmaxenproceso' => 100,
            ],
        ]);
    }
}
