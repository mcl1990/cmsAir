<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Master;

class Perfiles extends Master{
	
    protected $table = 'perfiles';
    protected $class_name = 'Perfiles';
    public $timestamps = false;

    //Relaciones
    public function usuarios(){
        return $this->hasMany(User::class, 'perfil_id', 'id');
    }

}
