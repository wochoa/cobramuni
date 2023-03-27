<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Cobranzas;
use App\Models\Formatocobranza;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class Reportes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporfecha(Request $request)
    {
        $fec_i=$request->fechaini;
        $fec_f=$request->fechafin;

        $lista=Cobranzas::whereBetween('fechaemision',[$fec_i,$fec_f])->OrderBy('idcobrazas','DESC')->paginate(10);
        return response()->json($lista, 200);

        //return $datos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporfecha_des(Request $request)
    {
        $fec_i=$request->fechaini;
        $fec_f=$request->fechafin;
        //$sumas=$request->suma;
        $lista=Cobranzas::whereBetween('fechaemision',[$fec_i,$fec_f])->OrderBy('idcobrazas','DESC')->get();
        $anulacion=Cobranzas::whereBetween('fechaemision',[$fec_i,$fec_f])->where('anular',0)->OrderBy('idcobrazas','DESC')->sum('montonumero');
        if(empty($anulacion))
            {
                $anulacion="0.00"; 
            }
        $sumas=Cobranzas::whereBetween('fechaemision',[$fec_i,$fec_f])->OrderBy('idcobrazas','DESC')->sum('montonumero');


        $pdf = \PDF::loadView('reportefecha', compact('lista','fec_i','fec_f','sumas','anulacion'));
        // $paper_size = array(0,0,280,680);
        // $pdf->set_paper($paper_size);
        return $pdf->download('pdfview.pdf');  
        //return $pdf->stream();
        //return   $lista;
    }//
    public function repordniruc(Request $request)
    {
        $rucdni=$request->dniruc;
        if(strlen($rucdni)>8)
        {
            //ruc
            $lista=Cobranzas::where('ruc',$rucdni)->OrderBy('idcobrazas','DESC')->paginate(10);
        }
        else{
            //dni
            $lista=Cobranzas::where('dni',$rucdni)->OrderBy('idcobrazas','DESC')->paginate(10);
        }

       
        return response()->json($lista, 200);

        //return $datos;
    }//
    public function repordniruc_des(Request $request)
    {
        $rucdni=$request->dniruc;

        if(strlen($rucdni)>8)
        {
            //ruc
            $lista=Cobranzas::where('ruc',$rucdni)->OrderBy('idcobrazas','DESC')->get();
            $anulacion=Cobranzas::where(['ruc'=>$rucdni,'anular'=>0])->OrderBy('idcobrazas','DESC')->sum('montonumero');
            if(empty($anulacion))
            {
                $anulacion="0.00"; 
            }
            $sumas=Cobranzas::where('ruc',$rucdni)->OrderBy('idcobrazas','DESC')->sum('montonumero');
        }
        else{
            //dni
            $lista=Cobranzas::where('dni',$rucdni)->OrderBy('idcobrazas','DESC')->get();
            $anulacion=Cobranzas::where(['dni'=>$rucdni,'anular'=>0])->OrderBy('idcobrazas','DESC')->sum('montonumero');
            if(empty($anulacion))
            {
                $anulacion="0.00"; 
            }
            $sumas=Cobranzas::where('dni',$rucdni)->OrderBy('idcobrazas','DESC')->sum('montonumero');
        }

        


        $pdf = \PDF::loadView('reportedniruc', compact('lista','rucdni','sumas','anulacion'));
      
        return $pdf->download('pdfview.pdf');  

    }//

    public function reporformato(Request $request)
    {
        $ifecha=$request->fecha;
        $idformat=$request->formato;

        $lista=DB::table('vista_cobranzagral')->join('cobranzas','vista_cobranzagral.codcobranza','=','cobranzas.idcobrazas')->where(['idformat'=>$idformat,'fechaemision'=>$ifecha])->OrderBy('idcobrazas','DESC')->paginate(10);
        $anulacion=DB::table('vista_cobranzagral')->join('cobranzas','vista_cobranzagral.codcobranza','=','cobranzas.idcobrazas')->where(['idformat'=>$idformat,'fechaemision'=>$ifecha])->where('anular',0)->sum('monto');
        if(empty($anulacion))
        {
            $anulacion="0.00"; 
        }
        $sumas=DB::table('vista_cobranzagral')->join('cobranzas','vista_cobranzagral.codcobranza','=','cobranzas.idcobrazas')->where(['idformat'=>$idformat,'fechaemision'=>$ifecha])->OrderBy('idcobrazas','DESC')->sum('monto');
        return response()->json(['lista'=>$lista,'sumatotal'=>$sumas,'sumaanulacion'=>$anulacion], 200);

        //return $datos;
    }//
    public function reporformato_des(Request $request)
    {
        $ifecha=$request->fecha;
        $idformat=$request->formato;

        $nombreformato=Formatocobranza::where('idformato',$idformat)->value('nomformato');

         $lista=DB::table('vista_cobranzagral')->join('cobranzas','vista_cobranzagral.codcobranza','=','cobranzas.idcobrazas')->where(['idformat'=>$idformat,'fechaemision'=>$ifecha])->OrderBy('idcobrazas','DESC')->get();

         $anulacion=DB::table('vista_cobranzagral')->join('cobranzas','vista_cobranzagral.codcobranza','=','cobranzas.idcobrazas')->where(['idformat'=>$idformat,'fechaemision'=>$ifecha])->where('anular',0)->sum('monto');
        if(empty($anulacion))
        {
            $anulacion="0.00"; 
        }
         
         $sumas=DB::table('vista_cobranzagral')->join('cobranzas','vista_cobranzagral.codcobranza','=','cobranzas.idcobrazas')->where(['idformat'=>$idformat,'fechaemision'=>$ifecha])->OrderBy('idcobrazas','DESC')->sum('monto');


        $pdf = \PDF::loadView('reporteformato', compact('lista','ifecha','nombreformato','sumas','anulacion'));
        // $paper_size = array(0,0,280,680);
        // $pdf->set_paper($paper_size);
        return $pdf->download('pdfview.pdf');  
        //return $pdf->stream();
        //return   $lista;
    }//

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reporclasificador(Request $request)
    {
        $fechaini=$request->fechaini;// fecha inicio
        $fechafin=$request->fechafin;// fecha fin
        $idformat=$request->formato;

        $lista=DB::table('vista_cobranzagral')->join('cobranzas','vista_cobranzagral.codcobranza','=','cobranzas.idcobrazas')->whereBetween('fechaemision',[$fechaini,$fechafin])->where(['idformat'=>$idformat])->OrderBy('idcobrazas','DESC')->paginate(10);

        return response()->json(['lista'=>$lista], 200);
        
    }

    public function reporclasificador_des(Request $request)
    {
        $fechaini=$request->fechaini;// fecha inicio
        $fechafin=$request->fechafin;// fecha fin
        $idformat=$request->formato;

        $nombreformato=Formatocobranza::where('idformato',$idformat)->value('nomformato');

        $lista=DB::table('vista_cobranzagral')->join('cobranzas','vista_cobranzagral.codcobranza','=','cobranzas.idcobrazas')->whereBetween('fechaemision',[$fechaini,$fechafin])->where(['idformat'=>$idformat])->OrderBy('idcobrazas','DESC')->get();

        $anulacion=DB::table('vista_cobranzagral')->join('cobranzas','vista_cobranzagral.codcobranza','=','cobranzas.idcobrazas')->whereBetween('fechaemision',[$fechaini,$fechafin])->where(['idformat'=>$idformat,'anular'=>0])->sum('monto');

        if(empty($anulacion))
        {
            $anulacion="0.00"; 
        }
         
         $sumas=DB::table('vista_cobranzagral')->join('cobranzas','vista_cobranzagral.codcobranza','=','cobranzas.idcobrazas')->whereBetween('fechaemision',[$fechaini,$fechafin])->where(['idformat'=>$idformat])->OrderBy('idcobrazas','DESC')->sum('monto');

        $grupoclasificador=DB::table('vista_cobranzagral')->join('cobranzas','vista_cobranzagral.codcobranza','=','cobranzas.idcobrazas')
        ->select('idclasificador', DB::raw('count(*) as total'))->whereBetween('fechaemision',[$fechaini,$fechafin])->where(['idformat'=>$idformat])
        ->groupBy('idclasificador')
        ->get();

        $pdf = \PDF::loadView('reporteclasificador', compact('lista','fechaini','fechafin','nombreformato','sumas','anulacion','grupoclasificador'));
        // $paper_size = array(0,0,280,680);
        // $pdf->set_paper($paper_size);
        return $pdf->download('pdfview.pdf');  

        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
