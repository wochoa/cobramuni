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
        //$lista=Cobranzas::join('formatocobranzas','cobranzas.idtipoformato','=','formatocobranzas.idformato')->paginate(10);
        $lista=Cobranzas::OrderBy('idcobrazas','DESC')->paginate(10);
        return response()->json($lista, 200);
    }

    public function listacobranzavista()
    {
        $lista=DB::table('vista_cobranzagral')->join('cobranzas','vista_cobranzagral.codcobranza','=','cobranzas.idcobrazas')->OrderBy('idcobrazas','DESC')->paginate(10);
        $suma=DB::table('vista_cobranzagral')->join('cobranzas','vista_cobranzagral.codcobranza','=','cobranzas.idcobrazas')->OrderBy('idcobrazas','DESC')->sum('monto');

        return response()->json(['lista'=>$lista,'sumatotal'=>$suma], 200);
    }

    public function buscarcobranza(Request $request)
    {
        $cod_recibo=$request->codrecibo;

        if($cod_recibo<>'')
        {
            $lista=Cobranzas::where(['codigorecibo'=>$cod_recibo])->OrderBy('idcobrazas','DESC')->paginate(10);
        }
        else{
            $lista=Cobranzas::OrderBy('idcobrazas','DESC')->paginate(10);
        }
        

        
        return response()->json($lista, 200);

    }
    public function buscarcobranzaid($id)
    {
        $cobra=Cobranzas::where('idcobrazas',$id)->get();
        $detalle=Detallecobranza::where('codcobranza',$id)->get();
        $datos=['dat_cobra'=>$cobra,'det_cobra'=>$detalle];
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
            // 'idtipoformato'=>$idtipoformato,
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

                $det->codcobranza = $idcobranza;//
                $det->idconcep=$objeto->idconcepto;
                $det->concepto = $objeto->textconcepto;
                $det->monto = $objeto->montoconcepto;
                $det->save();
            }

            // $numeracion=Formatocobranza::where('idformato',$idtipoformato)->value('numeracion');
            // $numeracion=$numeracion+1;
            // DB::update('update formatocobranzas set numeracion = '.$numeracion.' where idformato = ?', [$idtipoformato]);
        

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

        $pdf = \PDF::loadView('boleta', compact('cobra','detcobra','fechaimpresion'));
        $paper_size = array(0,0,280,680);
        $pdf->set_paper($paper_size);
        return $pdf->stream();
        
        // $pdf = \PDF::loadView('formato7', compact('resultados','datouser'))->setPaper('a4', 'landscape');
        // //return $pdf->download($dni.'.pdf');
        // //return $resultados;
        // // return view('formato7',compact('datouser'));
        // return $pdf->stream();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cobranzas  $cobranzas
     * @return \Illuminate\Http\Response
     */
    public function reniec($dni)//rruc
    {
        $url='http://app.regionhuanuco.gob.pe/soap_pruebas/reniec.php?cdni='.$dni;

        //$wsdl = file_get_contents($url);
        $wsdl = getRemoteFile($url);
        return $wsdl;
    }
    public function ruc($rruc)//
    {
        $url='http://app.regionhuanuco.gob.pe/soap_pruebas/sunat.php?ruc='.$rruc;

        //$wsdl = file_get_contents($url);
        $wsdl = getRemoteFile($url);
        return $wsdl;
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
