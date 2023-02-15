<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Cobranzas;
use App\Models\Detallecobranza;
use App\Models\Formatocobranza;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Luecano\NumeroALetras\NumeroALetras;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CobranzasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listacobranza()
    {
        $lista=Cobranzas::get();
        return response()->json($lista, 200);
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
    public function generarcobranza(Request $request)
    {
        // $datos=$request->all();
        $formatter = new NumeroALetras();

        $iduser=Auth::user()->id;

        $idtipoformato=$request->idtipoformato;
        $codigorecibo=$request->codigorecibo;
        $fechaemision=$request->fechaemision;
        $ruc=$request->ruc;
        $dni=$request->dni;
        $nom_razonsocial=$request->nom_razonsocial;
        $montonumero=$request->montonumero;
        $montotexto=$formatter->toInvoice($montonumero, 2, 'soles');

        

        $tram_cobramza=Cobranzas::create([
            'idusuario'=>$iduser,
            'idtipoformato'=>$idtipoformato,
            'codigorecibo'=>$codigorecibo,
            'fechaemision'=>$fechaemision,
            'ruc'=>$ruc,
            'dni'=>$dni,
            'nom_razonsocial'=>$nom_razonsocial,
            'montonumero'=>$montonumero,
            'montotexto'=>$montotexto
        ]);

        $idcobranza=$tram_cobramza->idcobrazas;
        
        $fconceptos=$request->conceptos;

        for($i=0;$i<count($fconceptos);$i++)
            {
                $objeto=json_decode($request->conceptos[$i]);// ya lo tengo formato json

                $det = new Detallecobranza();

                $det->codcobranza = $idcobranza;
                $det->concepto = $objeto->textconcepto;
                $det->monto = $objeto->montoconcepto;
                $det->save();
            }

            $numeracion=Formatocobranza::where('idformato',$idtipoformato)->value('numeracion');
            $numeracion=$numeracion+1;
            DB::update('update formatocobranzas set numeracion = '.$numeracion.' where idformato = ?', [$idtipoformato]);
        

        return $idcobranza;
    }

    public function comprasxid($id)
    {

    }

    public function imprimecobranza($id)
    {
        $date = Carbon::now();
        $fechaimpresion = $date->format('d-m-Y H:i:s');

        $cobra=Cobranzas::where('idcobrazas',$id)->get();
        $detcobra=Detallecobranza::where('codcobranza',$id)->get();

        $pdf = PDF::loadView('boleta', compact('cobra','detcobra','fechaimpresion'));
        return $pdf->stream('archivo-pdf.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cobranzas  $cobranzas
     * @return \Illuminate\Http\Response
     */
    public function show(Cobranzas $cobranzas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cobranzas  $cobranzas
     * @return \Illuminate\Http\Response
     */
    public function edit(Cobranzas $cobranzas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cobranzas  $cobranzas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cobranzas $cobranzas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cobranzas  $cobranzas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cobranzas $cobranzas)
    {
        //
    }
}
