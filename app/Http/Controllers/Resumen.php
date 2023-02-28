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
        $cobranzas=Detallecobranza::sum('monto');
        $totalcobranzaformato8=Cobranzas::where('idtipoformato',1)->sum('montonumero');
        $totalcobranzaformato9=Cobranzas::where('idtipoformato',2)->sum('montonumero');
        $conceptos=Conceptocobranza::count();
        $formatos=Formatocobranza::count();
        $clasificador=Clasificador::count();
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
