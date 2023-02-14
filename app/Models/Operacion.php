<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    use HasFactory;

    protected $fillable = [
        //'oper_iddocumento',
        'oper_iddependencia',
        'oper_idusuario',
        'oper_idarchivador',
        'oper_idtope',
        'oper_es_destino',
        'oper_forma',
        'oper_depeid_d',
        'oper_usuid_d',
        'oper_detalledestino',
        'oper_acciones',
        'oper_idprocesado',
        'oper_manual',
        'oper_persona',
        'oper_cargo',
        'oper_expeid_adj',
        'oper_procesado',
        'oper_tarchi_id',
        'created_at',
        'updated_at'
    ];
    protected $table = 'tram_operacion';
    protected $primaryKey = 'idoperacion';

    protected $casts = [
        'oper_idtope' => 'integer',
        'oper_manual' => 'boolean',
    ];

    public static function derivar($operacion, $derivaciones)
    {
        $retorno = true;
        $user    = \Auth::user();
        if ($operacion->oper_idtope == 2)
            $operacion = Operacion::find($operacion->oper_idprocesado);

            for($i=0;$i<count($derivaciones);$i++)
            {
                $objeto=json_decode($request->derivaciones[$i]);// ya lo tengo formato json
                $data                      = new Operacion();
                $data->oper_iddocumento=$operacion->oper_iddocumento;
                $data->oper_iddependencia  = $user->depe_id;
                $data->oper_idusuario      = $user->id;
                $data->oper_procesado      = false;//isset($derivacion->oper_manual)?$derivacion->oper_manual:false;//coincide con oper_manual, por que si es manual se toma como procesado
                $data->oper_idarchivador   = null;
                $data->oper_idtope         = 2;//default para derivacion
                $data->oper_idprocesado    = $operacion->idoperacion;
                $data->oper_forma=$objeto->forma;
                $data->oper_depeid_d=$objeto->vcodigoofcina;
                $data->oper_usuid_d=$objeto->vcoduser;
                $data->oper_detalledestino = mb_strtoupper($objeto->vdetalle);
                $data->oper_acciones       = mb_strtoupper($objeto->vproveido);
                $data->save();
            }

            


        return $retorno;
    }

}
