<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use App\Models\Formatocobranza;
use App\Models\Conceptocobranza;
use App\Models\Clasificador;
use Illuminate\Database\Seeder;

class Usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            [
                'adm_name'         => 'ADMINISTRADOR',
                'adm_lastname'     => 'ADMINISTRADOR',
                'adm_inicial'      => 'ADMIN',
                'adm_email'        => 'ADMIN',
                'adm_password'     => bcrypt('123456'),
                'adm_estado'       => 1,
                'adm_cargo'        => 'ADMINISTRADOR',
                'depe_id'          => 2,
                'adm_vigencia'     => '2021-12-09',
                'adm_caseta'       => 0,
                'adm_esjefe'       => 0,
                'adm_primer_logeo' => 1,
            ],
            [
                'adm_name'         => 'MUNICIPALIDAD',
                'adm_lastname'     => 'MUNICIPALIDAD',
                'adm_inicial'      => 'MUNI',
                'adm_email'        => 'MUNI',
                'adm_password'     => bcrypt('123456'),
                'adm_estado'       => 1,
                'adm_cargo'        => 'ESPECIALISTA',
                'depe_id'          => 2,
                'adm_vigencia'     => '2021-12-09',
                'adm_caseta'       => 0,
                'adm_esjefe'       => 0,
                'adm_primer_logeo' => 1,
            ],
            [
                'adm_name'         => 'WILMER',
                'adm_lastname'     => 'OCHOA ALVARADO',
                'adm_inicial'      => 'WOA',
                'adm_email'        => 'WOCHOA',
                'adm_password'     => bcrypt('123456'),
                'adm_estado'       => 1,
                'adm_cargo'        => 'PROGRAMADOR EN TI',
                'depe_id'          => 3,
                'adm_vigencia'     => '2021-12-09',
                'adm_caseta'       => 0,
                'adm_esjefe'       => 0,
                'adm_primer_logeo' => 1,
            ],
            
        ]);
        Formatocobranza::insert([
            ['nomformato'=>'FORMATO 8'],
            ['nomformato'=>'FORMATO 9']
        ]
            
        );
        Conceptocobranza::insert([
            ['text_concepto'=>'EXPEDICION DE PARTIDAS: EXPEDICION DE PARTIDA NACIOMIENTO',
             'codclasificador'=>1,
             'nomto_concepto'=>10.60,
             'estado_concepto'=>1
            ],
            ['text_concepto'=>'EXPEDICION DE PARTIDAS: EXPEDICION DE PARTIDA MATRIMONIO',
             'codclasificador'=>1,
             'nomto_concepto'=>20.60,
             'estado_concepto'=>1
            ],
        ]
            
        );

        Clasificador::insert([
            ['text_clasificador'=>'REGISTRO CIVIL',
             'codigoclasificador'=>'1.3.2.1.1.1',
             'estado_cla'=>1
            ],
            ['text_clasificador'=>'CERTIFICADOS DOMICILIARIOS',
             'codigoclasificador'=>'1.3.2.1.4.1',
             'estado_cla'=>1
            ],
            ['text_clasificador'=>'CERTIFICACIONES DIVERSAS',
             'codigoclasificador'=>'1.3.2.10.1.5',
             'estado_cla'=>1
            ],
        ]
            
        );

        

    }
}
