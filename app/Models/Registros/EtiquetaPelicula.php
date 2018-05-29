<?php

namespace App\Models\Registros;

use Illuminate\Database\Eloquent\Model;

class EtiquetaPelicula extends Model
{
    protected $table = 'etiquetas_aporte_pelicula';
    protected $fillable = [
    	'etiqueta_id', 'pelicula_id',
    ];
}
