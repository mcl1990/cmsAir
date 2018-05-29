<?php

namespace App\Http\Controllers\Configuraciones;

use App\Models\Configuraciones\Servidor;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\BitacoraAdmin;
use Illuminate\Http\Request;
use App\Master;
use Validator;
use Auth;

class ServidorController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new Servidor;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        
        return view('configuraciones/servidores/listar');
    }

    public function getListServidores(){

        return Datatables::of(Servidor::all())
            ->addColumn('action', function ($servidores) {
                $modelo = 'servidores';
                return  $this->master->getAccionDataTable($servidores, $modelo);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('configuraciones/servidores/registrar');
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
            'servidor' => $modulo->getUniqueRule(True, $rel, 'servidor').'|string',
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
        file_put_contents('images/servidores/'.$pk.'.jpg', $imagen); 
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
        
        $servidor = Servidor::where('id', $id)->get();
        return response($servidor);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $servidor = Servidor::where('id', $id)->first();
        return view('configuraciones/servidores/edit')->with(['servidor' => $servidor]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Servidor::find($id);
        $rel = $modulo->getTable();
        $data = $request->all();

        if($data['pre_icono'] === null){
            $img = $modulo->icono;
        }

        $validator = Validator::make($data, [
            'servidor' => $modulo->getUniqueRule(False, $rel, 'servidor').'|string',
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
            file_put_contents('images/servidores/'.$pk.'.jpg', $imagen); 
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

        $modulo = Servidor::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->registrarConfiguraciones($modulo,null,3); //Elimina el registro y Notifica a la bitacora Admin
        return 1;
    }
}
