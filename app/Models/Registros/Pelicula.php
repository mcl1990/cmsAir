<?php

namespace App\Models\Registros;

use Illuminate\Database\Eloquent\Model;
use App\Master;
use Validator;

class Pelicula extends Master{
	
    protected $table = 'peliculas';
    protected $class_name = 'Pelicula';
    protected $fillable = [
        'titulo', 'duracion', 'descripcion', 'fecha', 'imagen', 'codigo', 'calificacion', 'user_id', 'status',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function validate_save($atributos){

    	$modulo = $this; // Modelo instanciado
        $modulo->save(); // Guarda el registro
        $pk = $modulo->getKey(); // Captura el id del registro

        ///// GUARDADO DE LA IMAGEN (de la url en la api)
        $imagen = file_get_contents('https://image.tmdb.org/t/p/original' . $atributos['imagen']); //Se captura el contenido de la imagen
        file_put_contents('images/peliculas/'.$pk.'.jpg', $imagen); //Guarda la imagen en la carpeta
        $modulo->imagen = $pk.'.jpg'; //Se actualiza el nombre de la imagen en la BD

        $master = new Master;
        $master->aporteRegistro($modulo,1);
        return $pk;
    }

    public function aportes()
    {
        return $this->hasMany('App\Models\Registros\AportePelicula');
    }

    public function usuario()
    {
        return $this->hasOne('App\User')->withDefault();
    }

    public function generos()
    {
        return $this->belongsToMany('App\Models\Configuraciones\Genero','generos_peliculas');
    }
}