<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobranzas extends Model
{
    use HasFactory;
    protected $fillable = [
		'idusuario', 'idtipoformato', 'codigorecibo', 'fechaemision', 'ruc', 'dni', 'nom_razonsocial', 'montonumero', 'montotexto', ];

    protected $table = 'cobranzas';
    protected $primaryKey = 'idcobrazas';
}
