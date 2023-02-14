<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivos extends Model
{
    use HasFactory;
    protected $fillable = ['file_url','file_name','file_tipo','file_size','file_mostrar','file_principal','file_html','file_generado','id_documento','id_documento_externo','id_proy_informe','created_at','updated_at']; 
    protected $table='tram_file';
    protected $primaryKey = 'id';
}
