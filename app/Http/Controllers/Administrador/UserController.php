<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos=User::whereNotNull('adm_inicial')->orderBy('id','asc')->paginate(10);

        return [
            'paginacion'=>[
                'total'=>$datos->total(),
                'current_page'=>$datos->currentPage(),// pagina actual
                'per_page'=>$datos->perPage(),// por pagina
                'last_page'=>$datos->lastPage(),//ultima pagina
                'from'=>$datos->firstItem(),// desde
                'to'=>$datos->total(),// hasta
            ],
            'listauser'=>$datos
        ];
    }
    public function alluser()
    {
        $datos=User::whereNotNull('adm_inicial')->orderBy('id','asc')->get();
        return response()->json($datos, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar($id)
    {

            $datos=User::whereNotNull('adm_inicial')->where('id',$id)->get();
            //return response()->json($datos);
            return $datos;
       
    }
    public function nombreuser($id)
    {
        $datos=User::whereNotNull('adm_inicial')->where('id',$id)->get();//value('adm_name');
        $nombre=$datos[0]->adm_name;
        $apellidos=$datos[0]->adm_lastname;//User::whereNotNull('adm_inicial')->where('id',$id)->value('adm_lastname');
        $nombresyape=$nombre.' '.$apellidos;
        
            return response()->json($nombresyape, 200);

    }

    public function listauserdepe($id)
   {
       $usuarios=User::where(['depe_id'=>$id,'adm_estado'=>1])->orderBy('adm_name','asc')->get();
       $representante=DB::table('tram_dependencia')->where('iddependencia',$id)->get();

       return ['usuarios'=>$usuarios,'representantes'=>$representante];
   }

   public function detalleuserderivacion($id)
   {
       $usuario=User::where(['id'=>$id,'adm_estado'=>1])->get();
       return response()->json(['detalleuser'=>$usuario]);
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
