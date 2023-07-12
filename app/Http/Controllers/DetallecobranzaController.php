<?php

namespace App\Http\Controllers;
use App\Models\Cobranzas;
use App\Models\Detallecobranza;
use Illuminate\Http\Request;

class DetallecobranzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function updatedetalleconcepto(Request $request)
    {

        $iddetalle=$request->iddetalle;
        $idconcepto=$request->idconcepto;
        


        $det = Detallecobranza::find($iddetalle);
        $det->idconcep=$idconcepto;

        $det->save();

        return $det;
    }
    public function updatedetalleconceptouser(Request $request)
    {

        // para modificar al usuario 
        $idrucdni=$request->ruc;
        $nombreorazon=$request->nombreorazon;
        $idcobranzas=$request->idcobranzas;
        // para contar carateres de numero doc// dni o ruc
        // if(strlen($idrucdni)>=11){$ruc=$idrucdni;$dni='null';}
        // else{$dni=$idrucdni;$ruc='null';}

        $cob = Cobranzas::find($idcobranzas);
        $cob->nom_razonsocial=$nombreorazon;
        // $cob->ruc=$ruc;
        // $cob->dni=$dni;
        $cob->save();
        return $cob;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detallecobranza  $detallecobranza
     * @return \Illuminate\Http\Response
     */
    public function show(Detallecobranza $detallecobranza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detallecobranza  $detallecobranza
     * @return \Illuminate\Http\Response
     */
    public function edit(Detallecobranza $detallecobranza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detallecobranza  $detallecobranza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallecobranza $detallecobranza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detallecobranza  $detallecobranza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detallecobranza $detallecobranza)
    {
        //
    }
}
