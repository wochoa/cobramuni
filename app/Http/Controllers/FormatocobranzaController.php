<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Formatocobranza;
use Illuminate\Http\Request;

class FormatocobranzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos=Formatocobranza::get();
        return response()->json($datos, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar($id)
    {
        //
        $datos=Formatocobranza::where('idformato',$id)->get();
        //return $datos;
        return response()->json($datos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function nuevoformato(Request $request)
    {
        $dat=$request->all();
        $datos=new Formatocobranza();
        $datos->nomformato=$request->formato;
        $datos->numeracion=$request->numeracion;
        $datos->save();
        return $dat;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formatocobranza  $formatocobranza
     * @return \Illuminate\Http\Response
     */
    public function show(Formatocobranza $formatocobranza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formatocobranza  $formatocobranza
     * @return \Illuminate\Http\Response
     */
    public function edit(Formatocobranza $formatocobranza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formatocobranza  $formatocobranza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formatocobranza $formatocobranza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formatocobranza  $formatocobranza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formatocobranza $formatocobranza)
    {
        //
    }
}
