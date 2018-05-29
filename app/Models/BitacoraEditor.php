<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Master;

class BitacoraEditor extends Master{
	
    protected $table = 'bitacoras_editor';

    public function registrar_acion_editor($modulo,$accion_id,$registro_id,$usuario_id){
        
        $this->modulo = $modulo;
        $this->accion_id = $accion_id;
        $this->registro_id = $registro_id;
        $this->user_id = $usuario_id;
        $this->created_at = date("Y/m/d H:i:s");
        parent::save();
        return 1;
    }
}