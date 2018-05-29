<?php

namespace App\Models\Registros;

use Illuminate\Database\Eloquent\Model;
use App\Master;
use Validator;

class Mensaje extends Master{
	
    protected $table = 'mensajes';
    protected $class_name = 'Mensaje';

}