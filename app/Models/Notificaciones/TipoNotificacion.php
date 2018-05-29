<?php

namespace App\Models\Notificaciones;

use Illuminate\Database\Eloquent\Model;
use App\Master;
use Validator;

class TipoNotificacion extends Master{
	
    protected $table = 'tipos_notificaciones';
    protected $class_name = 'TipoNotificacion';

}