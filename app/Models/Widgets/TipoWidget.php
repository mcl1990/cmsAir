<?php

namespace App\Models\Widgets;

use Illuminate\Database\Eloquent\Model;
use App\Master;
use Validator;

class TipoWidget extends Master{
	
    protected $table = 'tipos_widgets';
    protected $class_name = 'TipoWidget';

    // public function validate_save($atributos){

    //     $modulo = $this; // Modelo instanciado
    //     $pk = $modulo->getKeyName(); //PrimaryKey
    //     $columnas = $modulo->getColumnNames(); //Colums

    //     foreach ($columnas as $col) { //Arma el Save
    //         if($col == $pk){
    //             continue;
    //         }
    //         if(in_array($col, array_keys($atributos))){
    //             $modulo->$col = $atributos[$col];
    //         }
    //     }
        
    //     $modulo->save(); // Guarda el registro
    //     $pk = $modulo->getKey(); // Captura el id del registro

    //     ///// GUARDADO DE LA IMAGEN (de la url en la api)
    //     $imagen = file_get_contents($atributos['imagen']); //Se captura el contenido de la imagen
    //     file_put_contents('images/series/'.$pk.'.jpg', $imagen); //Guarda la imagen en la carpeta
    //     $modulo->imagen = $pk.'.jpg'; //Se actualiza el nombre de la imagen en la BD

    //     $master = new Master;
    //     $master->aporteRegistro($modulo,1);
    //     return $pk;
    // }
}