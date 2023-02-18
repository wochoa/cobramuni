<?php

namespace App\Http\Controllers;

use App\Models\Conceptocobranza;
use Illuminate\Http\Request;

class ConceptocobranzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos=Conceptocobranza::join('clasificador','conceptocobranzas.codclasificador','=','clasificador.idclasificador')->get();
        return response()->json($datos, 200);
    }

    public function busqueda($id)
    {
        $datos=Conceptocobranza::where('idconceptocobranza',$id)->get();
        return response()->json($datos, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function nuevoconcepto(Request $request)
    {
        $datos=$request->all();
        $newconcepto=new Conceptocobranza();
        $newconcepto->text_concepto=strtoupper($request->concepto);
        $newconcepto->codclasificador=$request->clasificador;
        $newconcepto->nomto_concepto=$request->monto;
        $newconcepto->estado_concepto=1;
        $newconcepto->save();
        return $datos;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conceptocobranza  $conceptocobranza
     * @return \Illuminate\Http\Response
     */
    public function show(Conceptocobranza $conceptocobranza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conceptocobranza  $conceptocobranza
     * @return \Illuminate\Http\Response
     */
    public function edit(Conceptocobranza $conceptocobranza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conceptocobranza  $conceptocobranza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $post = Conceptocobranza::find($request->idconcepto);
        $post->codclasificador = $request->idclasificador;
        $post->text_concepto = $request->textconcepto;
        $post->nomto_concepto = $request->montoup;
        $post->save();

        // $affectedRows = Conceptocobranza::where('idconceptocobranza', $request->idconcepto)->update(array(
        //     ['codclasificador'=>$request->idclasificador,
        //     'text_concepto'=>$request->textconcepto,
        //     'nomto_concepto'=>$request->montoup,
        //     ]
        // ));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conceptocobranza  $conceptocobranza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conceptocobranza $conceptocobranza)
    {
        //
    }
}
