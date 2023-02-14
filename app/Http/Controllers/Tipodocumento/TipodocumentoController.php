<?php

namespace App\Http\Controllers\Tipodocumento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TipodocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos=DB::table('tram_tipodocumento')->orderBy('tdoc_descripcion','asc')->get();

      
        return ['listadoc'=>$datos];
    }

    public function buscatipodocumento($id,$tipotram)
    {
        $iduser=Auth::user()->id;//4295;// wilmer ochoa
        $idoficina=User::where('id',$iduser)->value('depe_id');
        //$idoficina=2;// sale del id usuario

        $anio=date('Y');
        $nombre_doc=DB::table('tram_tipodocumento')->where('idtdoc',$id)->value('tdoc_descripcion');
        if($tipotram=='false')// cuando el usuario no selecciona personal(se tramite desde la oficina)
        {

            $correlativo=DB::table('tram_tipodocumento_correl')->where(['tdco_idtipodocumento'=>$id,'tdco_periodo'=>$anio,'tdco_iddependencia'=>$idoficina])->whereNull('tdco_idusuario')->orderBy('id','DESC')->limit(1)->value('tdco_numero');
        }
        else
        {   
            $correlativo=DB::table('tram_tipodocumento_correl')->where(['tdco_idtipodocumento'=>$id,'tdco_idusuario'=>$iduser,'tdco_periodo'=>$anio])->orderBy('id','DESC')->limit(1)->value('tdco_numero');
        }

        $datos=['nombre_doc'=>$nombre_doc,'correlativo'=>$correlativo];
        //
        return $datos;
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
    public function prueba()
    {
        $iduser=Auth::user()->id;//4295;// wilmer ochoa
        $idoficina=User::where('id',$iduser)->value('depe_id');
        return $idoficina;
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
