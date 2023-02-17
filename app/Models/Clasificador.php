<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clasificador extends Model
{
    use HasFactory;
    protected $fillable = [
		'text_clasificador', 'codigoclasificador', ];
    
        protected $table = 'clasificador';
    protected $primaryKey = 'idclasificador';
}
