<?php

namespace App\Models\Configuraciones;

use Illuminate\Database\Eloquent\Model;
use App\Master;

class Categoria extends Master
{
    protected $table = 'categorias';
    protected $class_name = 'categoria';
    protected $fillable = [
    	'nombre', 'icono', 'status',
    ];

    protected $casts = [
    	'status' => 'boolean',
    ];

    public function menus()
    {
    	return $this->hasMany('App\Models\Configuraciones\MenuCategoria');
    }

}
