<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallecobranza extends Model
{
    use HasFactory;

    protected $fillable = [
		'codcobranza', 'concepto', 'monto', ];

    protected $table = 'detallecobranzas';
    protected $primaryKey = 'iddetalle_cobra';
}
