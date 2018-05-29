<?php

namespace App\Http\Controllers\Configuraciones;

use App\Models\Configuraciones\Avatar;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\BitacoraAdmin;
use Illuminate\Http\Request;
use App\Master;
use Validator;
use Auth;

class AvatarController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new Avatar;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        
        return view('configuraciones/avatares/listar');
    }

    public function getListAvatares(){

        return Datatables::of(Avatar::all())
            ->addColumn('action', function ($avatares) {
                $modelo = 'avatares';
                return  $this->master->getAccionDataTable($avatares, $modelo);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('configuraciones/avatares/registrar');
    }

    /**
     * Store a newly created recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        $modulo = $this->recurso;
        $rel = $modulo->getTable();
        $data = $request->all();

        $validator = Validator::make($data, [
            'avatar' => $modulo->getUniqueRule(True, $rel, 'avatar').'|string',
            'pre_icono' => 'bail|required',
        ]);

        if ($validator->fails()) {
            $codes = $modulo->returnMessageCodeError($validator);
            return array_values($codes);
        }

        $pk = $modulo->getKeyName(); //PrimaryKey
        $columnas = $modulo->getColumnNames(); //Colums

        foreach ($columnas as $col) { //Arma el Save
            if($col == $pk){
                continue;
            }
            if(in_array($col, array_keys($data))){
                $modulo->$col = $data[$col];
            }
        }
        $modulo->icono = 'pre.jpg';
        $modulo->save();
        $pk = $modulo->getKey();
        /////// GUARDADO DE IMAGEN
        $baseFromJavascript = $data['pre_icono'];
        $base_to_php = explode(',', $baseFromJavascript);
        $imagen = base64_decode($base_to_php[1]);
        file_put_contents('images/avatares/'.$pk.'.jpg', $imagen); 
        $modulo->icono = $pk.'.jpg';
        $modulo->save();

        $clase = $modulo->getClass();
        $id_u = Auth::user()->id;
        $bitacora = new BitacoraAdmin;
        $bitacora->registrar_accion_admin($clase,1,$pk,$id_u); //Notifica a bitacora admin
        return 1;
    }

    /**
     * Display the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $servidor = Avatar::where('id', $id)->get();
        return response($servidor);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $avatar = Avatar::where('id', $id)->first();
        return view('configuraciones/avatares/edit')->with(['avatar' => $avatar]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Avatar::find($id);
        $rel = $modulo->getTable();
        $data = $request->all();

        if($data['pre_icono'] === null){
            $img = $modulo->icono;
        }

        $validator = Validator::make($data, [
            'avatar' => $modulo->getUniqueRule(False, $rel, 'avatar').'|string',
            'pre_icono' => 'sometimes',
        ]);

        if ($validator->fails()) {
            $codes = $modulo->returnMessageCodeError($validator);
            return array_values($codes);
        }

        $pk = $modulo->getKeyName(); //PrimaryKey
        $columnas = $modulo->getColumnNames(); //Colums

        foreach ($columnas as $col) { //Arma el Save
            if($col == $pk){
                continue;
            }
            if(in_array($col, array_keys($data))){
                $modulo->$col = $data[$col];
            }
        }
        
        $pk = $modulo->getKey();
        if($data['pre_icono'] != null){
            /////// ACTUALIZACION DE IMAGEN
            $baseFromJavascript = $data['pre_icono'];
            $base_to_php = explode(',', $baseFromJavascript);
            $imagen = base64_decode($base_to_php[1]);
            file_put_contents('images/avatares/'.$pk.'.jpg', $imagen); 
            $modulo->icono = $pk.'.jpg';
        }else{
            $modulo->icono = $img;
        }
        $modulo->save();

        $clase = $modulo->getClass();
        $id_u = Auth::user()->id;
        $bitacora = new BitacoraAdmin;
        $bitacora->registrar_accion_admin($clase,2,$pk,$id_u); //Notifica a bitacora admin

        return 1;
    }

    /**
     * Remove the specified recurso from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $modulo = Avatar::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->registrarConfiguraciones($modulo,null,3); //Elimina el registro y Notifica a la bitacora Admin
        return 1;
    }
}
