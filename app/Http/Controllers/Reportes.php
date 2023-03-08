<?php

namespace App\Http\Controllers;
use App\Models\Cobranzas;
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
        $sumas=$request->suma;
        $lista=Cobranzas::whereBetween('fechaemision',[$fec_i,$fec_f])->OrderBy('idcobrazas','DESC')->get();


        $pdf = \PDF::loadView('reportefecha', compact('lista','fec_i','fec_f','sumas'));
        // $paper_size = array(0,0,280,680);
        // $pdf->set_paper($paper_size);
        return $pdf->download('pdfview.pdf');  
        //return $pdf->stream();
        //return   $lista;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
