<?php

namespace App\Models\Registros;

use Illuminate\Database\Eloquent\Model;
use App\Master;

class Seguidor extends Master{
	
    protected $table = 'seguidores';
    protected $class_name = 'Seguidor';

    public function validate_save($atributos){
       
    }
}