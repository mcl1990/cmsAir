<?php

namespace App\Models\Registros;

use Illuminate\Database\Eloquent\Model;
use App\Master;

class Aporte extends Master{
	
    protected $table = 'aportes_animes';
    protected $class_name = 'Aporte';

    public function validate_save($atributos){
        return $validator;
    }
}