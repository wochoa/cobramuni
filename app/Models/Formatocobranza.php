<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formatocobranza extends Model
{
    use HasFactory;

    protected $fillable = [
		'nomformato', 'numeracion','numeracion',];

    protected $table = 'formatocobranzas';
    protected $primaryKey = 'idformato';
}
