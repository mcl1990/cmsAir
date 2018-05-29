<?php

namespace App\Http\Controllers\Registros;

use App\Http\Controllers\Controller;
use App\Models\Registros\Temporada;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\Registros\Serie;
use Illuminate\Http\Request;
use App\Master;
use Validator;

class TemporadaController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new Temporada;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        
        return view('registros/temporadas/listar');
    }

    public function getListTemporadas(){

        $temporadas = DB::table('temporadas')
            ->join('series', 'temporadas.serie_id', '=', 'series.id')
            ->select('temporadas.*', 'series.titulo AS serie')
            ->orderBy('id')
            ->get();

        // Temporada::all()

        return Datatables::of($temporadas)
            ->addColumn('action', function ($temporadas) {
                $modelo = 'temporadas';
                return  $this->master->getAccionDataTable($temporadas, $modelo);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $series = Serie::orderBy('id', 'asc')->get();
        return view('registros/temporadas/registrar')->with(['list_series' => $series]);
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
            'codigo'           => $rule.'|integer',
            'serie_id'         => $rule.'|integer',
            'temporada'        => $rule.'|integer',
            'episodios'        => $rule.'|integer',
            'fecha_estreno'    => $rule.'|string',
            'titulo' => $rule.'|string',
            'descripcion'      => $rule.'|string',
            'pre_imagen'       => $rule,
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

        $modulo->imagen = 'pre.jpg';
        $modulo->save();
        $pk = $modulo->getKey();
        /////// GUARDADO DE IMAGEN
        $baseFromJavascript = $data['pre_imagen'];
        $base_to_php = explode(',', $baseFromJavascript);
        $data = base64_decode($base_to_php[1]);
        file_put_contents('images/temporadas/'.$pk.'.jpg', $data); 
        $modulo->imagen = $pk.'.jpg';
        $this->master->adminRegistro($modulo,1); //Manda a crea el registro y la bitacora administrador

        return view('registros/temporadas/listar');
    }

    /**
     * Display the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $temporada = Temporada::where('id', $id)->get();
        return response($temporada);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $series = Serie::orderBy('id', 'asc')->get();
        $temporada = Temporada::where('id', $id)->first();
        return view('registros/temporadas/edit')->with(['temporada' => $temporada, 'list_series' => $series]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Temporada::find($id);
        $rel = $modulo->getTable();
        $data = $request->all();

        if($data['pre_imagen'] === null){
            $img = $modulo->imagen;
        }
        
        $validator = Validator::make($data, [
            'codigo'        => 'bail|required|integer',
            'serie_id'      => 'bail|required|integer',
            'temporada'     => 'bail|required|integer',
            'episodios'     => 'bail|required|integer',
            'fecha_estreno' => 'bail|required|string',
            'titulo'        => 'bail|required|string',
            'descripcion'   => 'bail|required|string',
            'pre_imagen'    => 'sometimes',
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
            file_put_contents('images/temporadas/'.$pk.'.jpg', $imagen); 
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

        $modulo = Temporada::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->adminRegistro($modulo,3); //Manda a eliminar el registro y la bitacora administrador
        return 1;
    }
}
