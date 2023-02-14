<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepedendenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos=DB::table('tram_dependencia')->whereNull('depe_sigla')->where('depe_tipo',0)->orderBy('iddependencia','asc')->paginate(10);

        return [
            'paginacion'=>[
                'total'=>$datos->total(),
                'current_page'=>$datos->currentPage(),// pagina actual
                'per_page'=>$datos->perPage(),// por pagina
                'last_page'=>$datos->lastPage(),//ultima pagina
                'from'=>$datos->firstItem(),// desde
                'to'=>$datos->total(),// hasta
            ],
            'listadepe'=>$datos
        ];
    }

    public function oficinas($coddepe)
    {
        $datos=DB::table('tram_dependencia')->where('depe_depende',$coddepe)->orderBy('iddependencia','asc')->paginate(10);
        $nomdepe=DB::table('tram_dependencia')->where('iddependencia',$coddepe)->value('depe_nombre');

        return [
            'paginacion'=>[
                'total'=>$datos->total(),
                'current_page'=>$datos->currentPage(),// pagina actual
                'per_page'=>$datos->perPage(),// por pagina
                'last_page'=>$datos->lastPage(),//ultima pagina
                'from'=>$datos->firstItem(),// desde
                'to'=>$datos->total(),// hasta
            ],
            'listadepe'=>$datos,
            'nombre_dependencia'=>$nomdepe
        ];
    }

    public function unidad($coddepe)
    {
        $nomdepe=DB::table('tram_dependencia')->where('iddependencia',$coddepe)->get();
        return response()->json($nomdepe);
    }

    public function nombredepe($coddepe)
    {
        $nomdepe=DB::table('tram_dependencia')->where('iddependencia',$coddepe)->value('depe_nombre');
        return $nomdepe;
    }

    public function alldependencia()
    {
        $datos=DB::table('tram_dependencia')->whereNotNull('depe_depende')->where('depe_tipo',1)->orderBy('iddependencia','asc')->get();
        return  response()->json(['datos'=>$datos], 200);
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
