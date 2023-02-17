<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conceptocobranza extends Model
{
    use HasFactory;
    protected $fillable = [
		'codclasificador', 'text_concepto', 'nomto_concepto','estado_concepto', ];


    protected $table = 'conceptocobranzas';
    protected $primaryKey = 'idconceptocobranza';
}
