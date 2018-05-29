<?php

namespace App\Models\Configuraciones;

use Illuminate\Database\Eloquent\Model;
use App\Master;

class Etiqueta extends Master{
	
    protected $table = 'etiquetas';
    protected $class_name = 'Etiqueta';
    protected $fillable = [
    	'etiqueta','status','user_id',
    ];
}
