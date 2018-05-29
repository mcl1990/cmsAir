<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\BitacoraEditor;
use App\Models\BitacoraAdmin;
use Auth;

class Master extends Authenticatable{
    
    public $timestamps = false;
    /**
     * Obtener los nombres de las columnas de la tabla
     * @param Array
     */    
    public function getColumnNames(){
    	return \DB::getSchemaBuilder()
        ->getColumnListing($this->table);
    }

    
    /**
    * Obtiene el nombre de la clase (Modelo)
    * @return String
    */
    public function getClass(){
        return $this->class_name;
    }


    /**
    * Retorna el error en cada formulario
    * @param String
    */

    public function returnMessageCodeError($validator){

        $failed = $validator->failed();
        $fields = $validator->errors()->keys();
        
        $codes = [];
        $i = 0;
        foreach ($failed as $f) {

            $field = $fields[$i];

            if (array_key_exists('Required', $f)) {
                $codes[] = 'Campo '.$field.' Obligatorio';
            }
            if (array_key_exists('Unique', $f)) {
                $codes[] = 'Este valor para el campo '.$field.' ya esta registrado';
            }
            if (array_key_exists('Email', $f)) {
                $codes[] = 'Campo '.$field.' debe ser de tipo email';
            }
            if (array_key_exists('Integer', $f)) {
                $codes[] = 'Campo '.$field.' debe ser de tipo entero';
            }
            $i++;
        }
        return $codes;
    }
    /**
    * Retorna los iconos de accion de c/u de los DataTables
    * @return String
    */
    public function getAccionDataTable($query, $modelo){
        return "<a style='color: grey' title='Editar' href='/admin/".$modelo."/".$query->id."/edit' data-toggle='tooltip' data-placement='top' ><i class='material-icons'>edit</i></a> <a class='delet' style='color: black' href='' title='Eliminar' id=".$query->id." data-toggle='tooltip' data-placement='top' ><i class='material-icons'>delete</i></a>";
    }
    /**
    * Retorna las reglas de validacion dependiendo a si es un create o update
    * @return String
    */

    public function getUniqueRule($type, $rel, $field){   

        if($type) { /*POST*/
            $rule = 'bail|required|unique:'.$rel;
        } else { /*PUT*/
            $rule = 'sometimes|unique:'.$rel.','.$field.','.$this->getKey().','.$this->getKeyName();
        }
        return $rule;
    }

    /**
    * Verifica si el registro a eliminar posee registros (hijos) asociados
    * @return String
    */
    public function searchRelations($model){

        $list_methods = get_class_methods(get_class($model));

        foreach($list_methods as $method){
            if(preg_match('/^tree_/', $method)) {
                $namespace = get_class($model);
                $exist = call_user_func(array($namespace, $method), $model)->count();
                if($exist > 0) {
                    return true;
                }
            }else if(preg_match('/^to_/', $method) || preg_match('/^many_/', $method)) {
                $exist = $model->$method->count();
                 if($exist > 0) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
    * Ejecuta la funcion save de todos los modulos para consumo del administrador
    *  y se guarda en bitacora el cambio (create, update, delete o cambio de estatus)
    * @return String
    */
    public function adminRegistro($request, $accion){
        
        $bitacora = new BitacoraAdmin;
        $modelo = $request->getClass();
        $id_u = Auth::user()->id;

        if($accion === 3){
            $pk = $request->getKey();
            $request->delete();
        }else if($accion === 2){
            $request->updated_at = date("Y/m/d H:i:s");
            $request->save();
            $pk = $request->getKey();
        }else{
            $request->created_at = date("Y/m/d H:i:s");
            $request->save();
            $pk = $request->getKey();
        }

        $bitacora->registrar_accion_admin($modelo,$accion,$pk,$id_u); //(Modelo, Accion, pk, id_usuario)
        return true;
    }

    /**
    * Ejecuta la funcion save de todos los modulos para consumo del administrador
    *  y se guarda en bitacora el cambio (create, update, delete o cambio de estatus)
    * @return String
    */
    public function registrarConfiguraciones($modelo, $data, $accion){

        $bitacora = new BitacoraAdmin;

        if($accion != 3){
            $pk = $modelo->getKeyName(); //PrimaryKey
            $columnas = $modelo->getColumnNames(); //Colums

            foreach ($columnas as $col) { //Arma el Save
                if($col == $pk){
                    continue;
                }
                if(in_array($col, array_keys($data))){
                    $modelo->$col = $data[$col];
                }
            }
        }

        switch ($accion) {
            case 1: // CREAR
                $modelo->created_at = date("Y/m/d H:i:s");
                $guardo = $modelo->save();
                $pk = $modelo->getKey();
                break;
            case 2: // ACTUALIZAR
                $modelo->updated_at = date("Y/m/d H:i:s");
                $modelo->save();
                $pk = $modelo->getKey();
                break;
            case 3: // ELIMINAR
                $pk = $modelo->getKey();
                $modelo->delete();
                break;
        }

        
        $clase = $modelo->getClass();
        $id_u = Auth::user()->id;

        $bitacora->registrar_accion_admin($clase,$accion,$pk,$id_u); //(Modelo, Accion, pk, id_usuario)
        return true;
    }

    /**
    * Ejecuta la funcion save de todos los modulos para consumo de editores
    *  y se guarda en bitacora el cambio (create, update, delete o cambio de estatus)
    * @return String
    */
    public function aporteRegistro($request, $accion){

        $bitacora = new BitacoraEditor;
        $modelo = $request->getClass();
        $id_u = Auth::user()->id;

        if($accion === 3){ // Eliminar
            $pk = $request->getKey();
            $request->delete();
        }if($accion === 2){ // Actualizar
            $request->updated_at = date("Y/m/d H:i:s");
            $request->save();
        }else{ // Crear
            $request->created_at = date("Y/m/d H:i:s");
            $request->save();
            $pk = $request->getKey();
        }
        
        $bitacora->registrar_acion_editor($modelo,$accion,$pk,$id_u); //(Modelo, Accion, pk, id_usuario)
        return $pk;
    }

}
