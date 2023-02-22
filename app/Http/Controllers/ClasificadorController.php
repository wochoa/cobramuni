<?php

namespace App\Http\Controllers;

use App\Models\Clasificador;
use Illuminate\Http\Request;

class ClasificadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos=Clasificador::orderBy('idclasificador','asc')->get();
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
    public function nuevoclasificador(Request $request)
    {
        $cla=new Clasificador();
        $cla->text_clasificador=strtoupper($request->Clasificador);
        $cla->codigoclasificador=strtoupper($request->codigo);
        $cla->save();
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clasificador  $clasificador
     * @return \Illuminate\Http\Response
     */
    public function show(Clasificador $clasificador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clasificador  $clasificador
     * @return \Illuminate\Http\Response
     */
    public function edit(Clasificador $clasificador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clasificador  $clasificador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clasificador $clasificador)
    {
        $post = Clasificador::find($request->idcla);
        $post->text_clasificador = $request->textclasificador;
        $post->codigoclasificador = $request->codigo;
        $post->save();
    }
    public function updateestado(Request $request)
    {
        $post = Clasificador::find($request->idcon);
        $post->estado_cla = $request->estado;
        $post->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clasificador  $clasificador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clasificador $clasificador)
    {
        //
    }
}
