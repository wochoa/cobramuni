<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cobranzas;
use App\Models\Detallecobranza;
use App\Models\Formatocobranza;
use App\Models\Conceptocobranza;
use App\Models\User;

class Resumen extends Controller
{
    
    public function index()
    {
        $cobranzas=Detallecobranza::sum('monto');
        $conceptos=Conceptocobranza::count();
        $formatos=Formatocobranza::count();
        $usuarios=User::count();

     return response()->json([
        'totalcobranza'=>$cobranzas,
        'totalconceptos'=>$conceptos,
        'totalformato'=>$formatos,
        'totalusuarios'=>$usuarios
     ], 200);
    }
}
