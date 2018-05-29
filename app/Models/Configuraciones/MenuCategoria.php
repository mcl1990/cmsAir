<?php

namespace App\Models\Configuraciones;

use Illuminate\Database\Eloquent\Model;

class MenuCategoria extends Model
{
    protected $table = 'menus_categorias';
    protected $fillable = [
    	'categoria_id','icono','titulo','url',
    ];

    public function lista()
    {
    	return $this->hasMany('App\Models\Configuraciones\ElementoMenu');
    }

}
