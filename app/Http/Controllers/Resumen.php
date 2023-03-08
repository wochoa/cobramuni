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

     return response()->json([
        'totalcobranza'=>$cobranzas,
        'totalconceptos'=>$conceptos,
        'totalformato'=>$formatos,
        'totalclasificador'=>$clasificador,
        'totalusuarios'=>$usuarios,
        'totalformato8'=>$totalcobranzaformato8,
        'totalformato9'=>$totalcobranzaformato9
     ], 200);
    }
}
