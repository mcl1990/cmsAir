<?php

namespace App\Models\Configuraciones;

use Illuminate\Database\Eloquent\Model;
use App\Master;

class Servidor extends Master{
	
    protected $table = 'servidores';
    protected $class_name = 'Servidor';
    protected $fillable = ['servidor'];

}