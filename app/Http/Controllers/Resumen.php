<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cobranzas;
use App\Models\Detallecobranza;
use App\Models\Formatocobranza;
use App\Models\Clasificador;
use App\Models\Conceptocobranza;

use App\Models\User;

class Resumen extends Controller
{
    
    public function index()
    {
        $cobranzas=Cobranzas::sum('montonumero');

        $totalcobranzaformato8=Detallecobranza::join('conceptocobranzas','detallecobranzas.idconcep','=','conceptocobranzas.idconceptocobranza')->join('clasificador','conceptocobranzas.codclasificador','=','clasificador.idclasificador')->where('idformat',1)->sum('monto');
        $totalcobranzaformato9=Detallecobranza::join('conceptocobranzas','detallecobranzas.idconcep','=','conceptocobranzas.idconceptocobranza')->join('clasificador','conceptocobranzas.codclasificador','=','clasificador.idclasificador')->where('idformat',2)->sum('monto');
        $conceptos=Conceptocobranza::where('estado_concepto',1)->count();
        $formatos=Formatocobranza::count();
        $clasificador=Clasificador::where('estado_cla',1)->count();
        $usuarios=User::count();
        $nimimo=Cobranzas::min('montonumero');
        $maximo=Cobranzas::max('montonumero');
        $anuladas=Cobranzas::where('anular',0)->sum('montonumero');
     return response()->json([
        'totalcobranza'=>$cobranzas,
        'totalconceptos'=>$conceptos,
        'totalformato'=>$formatos,
        'totalclasificador'=>$clasificador,
        'totalusuarios'=>$usuarios,
        'totalformato8'=>$totalcobranzaformato8,
        'totalformato9'=>$totalcobranzaformato9,
        'minimo_monto'=>$nimimo,
        'maximo_monto'=>$maximo,
        'anulada'=>$anuladas

     ], 200);
    }

    public function sumamontopormes($formato)
    {
        $mese=['01','02','03','04','05','06','07','08','09','10','11','12'];

        if($formato=='8')// formato 8
        {
            for($i=0;$i<12;$i++)
            {
                
            }
            $totalcobranzaformato8=Detallecobranza::join('conceptocobranzas','detallecobranzas.idconcep','=','conceptocobranzas.idconceptocobranza')->join('clasificador','conceptocobranzas.codclasificador','=','clasificador.idclasificador')->where('idformat',1)->sum('monto');

        }
        else{// formato 9
            $totalcobranzaformato9=Detallecobranza::join('conceptocobranzas','detallecobranzas.idconcep','=','conceptocobranzas.idconceptocobranza')->join('clasificador','conceptocobranzas.codclasificador','=','clasificador.idclasificador')->where('idformat',2)->sum('monto');
        }
    }
}
