<?php

namespace App\Models\Registros;

use Illuminate\Database\Eloquent\Model;
use App\Master;
use Validator;
use Auth;
class Serie extends Master{
	
    protected $table = 'series';
    protected $class_name = 'Serie';

    public function validate_save($atributos){

        $modulo = $this; // Modelo instanciado
        $pk = $modulo->getKeyName(); //PrimaryKey
        $columnas = $modulo->getColumnNames(); //Colums

        foreach ($columnas as $col) { //Arma el Save
            if($col == $pk){
                continue;
            }
            if(in_array($col, array_keys($atributos))){
                $modulo->$col = $atributos[$col];
            }
        }
        $estatus = 1;
        if($atributos['status'] === 'Ended'){
            $estatus =2;
        }
        $estado = 1;
        if(Auth::user()->perfil_id === 3){
            $estado = 3;
        }

        $modulo->estatus = $estatus; //Estatus de la serie (En emison o terminada)
        $modulo->estado = $estado; //Estato del post (aprobado=1, inactivo=2, validando=3)
        $modulo->save(); // Guarda el registro
        $pk = $modulo->getKey(); // Captura el id del registro

        ///// GUARDADO DE LA IMAGEN (de la url en la api)
        $imagen = file_get_contents($atributos['imagen']); //Se captura el contenido de la imagen
        file_put_contents('images/series/'.$pk.'.jpg', $imagen); //Guarda la imagen en la carpeta
        $modulo->imagen = $pk.'.jpg'; //Se actualiza el nombre de la imagen en la BD

        $master = new Master;
        $master->aporteRegistro($modulo,1);
        
        return $pk;
    }
}