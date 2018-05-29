<?php

namespace App\Http\Controllers\Registros;

use App\Models\Registros\Serie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Master;
use Validator;
use Auth;

class SerieController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new Serie;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        
        return view('registros/series/listar');
    }

    public function getListSeries(){

        $series = DB::table('series')
            ->select('series.*', 
                DB::raw("(CASE WHEN estado = 1 THEN 'En Emisión' ELSE 'Finalizada' END) AS estado"))
            ->orderBy('id')->get();

        return Datatables::of($series)
            ->addColumn('action', function ($series) {
                $modelo = 'series';
                return  $this->master->getAccionDataTable($series, $modelo);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('registros/series/registrar');
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
        
        $rule = 'bail|required';
        $validator = Validator::make($data, [
            'titulo'           => $modulo->getUniqueRule(True, $rel, 'servidor').'|string',
            'descripcion'      => $rule.'|string',
            'primera_emision'  => $rule.'|string',
            'calificacion'     => $rule,
            'codigo'           => 'sometimes|integer',
            'pre_imagen'       => $rule,
            'temporadas'       => $rule.'|integer',
            'episodios'        => $rule.'|integer',
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

        $modulo->user_id = Auth::user()->id;
        $modulo->imagen = 'pre.jpg';
        $modulo->estatus = 1;
        $modulo->save(); //Pre Guardo el registro
        $pk = $modulo->getKey();

        /////// GUARDADO DE IMAGEN
        $baseFromJavascript = $data['pre_imagen'];
        $base_to_php = explode(',', $baseFromJavascript);
        $data = base64_decode($base_to_php[1]);
        file_put_contents('images/series/'.$pk.'.jpg', $data); 
        $modulo->imagen = $pk.'.jpg';
        $this->master->adminRegistro($modulo,1); //Manda a crea el registro y la bitacora administrador

        return view('registros/series/listar');
    }

    /**
     * Display the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $servidor = Serie::where('id', $id)->get();
        return response($servidor);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $serie = Serie::where('id', $id)->first();
        return view('registros/series/edit')->with(['serie' => $serie]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Serie::find($id);
        $rel = $modulo->getTable();
        $data = $request->all();

        if($data['pre_imagen'] === null){
            $img = $modulo->imagen;
        }
        $rule = 'bail|required';
        $validator = Validator::make($data, [
            'titulo'           => $modulo->getUniqueRule(false, $rel, 'titulo').'|string',
            'descripcion'      => $rule.'|string',
            'primera_emision'  => $rule.'|string',
            'calificacion'     => $rule,
            'codigo'           => 'sometimes|integer',
            'pre_imagen'       => 'sometimes',
            'temporadas'       => $rule.'|integer',
            'episodios'        => $rule.'|integer',
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
        if($data['pre_imagen'] != null){
            /////// ACTUALIZACION DE IMAGEN
            $baseFromJavascript = $data['pre_imagen'];
            $base_to_php = explode(',', $baseFromJavascript);
            $imagen = base64_decode($base_to_php[1]);
            file_put_contents('images/peliculas/'.$pk.'.jpg', $imagen); 
            $modulo->imagen = $pk.'.jpg';
        }else{
            $modulo->imagen = $img;
        }


        $this->master->adminRegistro($modulo,2); //Manda a crea el registro y la bitacora administrador

        return 1;
    }

    /**
     * Remove the specified recurso from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $modulo = Serie::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->adminRegistro($modulo,3); //Manda a eliminar el registro y la bitacora administrador
        return 1;
    }
}
