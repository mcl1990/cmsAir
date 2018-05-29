<?php

namespace App\Http\Controllers\Registros;

use App\Models\Registros\Pelicula;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Master;
use Validator;
use Auth;

class PeliculaController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new Pelicula;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        
        return view('registros/peliculas/listar');
    }

    public function getListPeliculas(){

        $peliculas = DB::table('peliculas')
            ->select('peliculas.*', 
                DB::raw("(titulo||' ('||fecha||')') AS titulo"))
            ->orderBy('id')->get();

        return Datatables::of($peliculas)
            ->addColumn('action', function ($peliculas) {
                $modelo = 'peliculas';
                return  $this->master->getAccionDataTable($peliculas, $modelo);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('registros/peliculas/registrar');
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
            'titulo'       => $modulo->getUniqueRule(True, $rel, 'servidor').'|string',
            'descripcion'  => 'bail|required|string',
            'fecha'        => 'bail|required|string',
            'codigo'       => 'sometimes|integer',
            'calificacion' => 'bail|required',
            'pre_imagen'   => 'bail|required',
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
        $modulo->save();
        $pk = $modulo->getKey();

        /////// GUARDADO DE IMAGEN
        $baseFromJavascript = $data['pre_imagen'];
        $base_to_php = explode(',', $baseFromJavascript);
        $data = base64_decode($base_to_php[1]);
        file_put_contents('images/peliculas/'.$pk.'.jpg', $data); 
        $modulo->imagen = $pk.'.jpg';

        $this->master->adminRegistro($modulo,1); //Manda a crea el registro y la bitacora administrador

        return view('registros/peliculas/listar');
    }

    /**
     * Display the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $servidor = Pelicula::where('id', $id)->get();
        return response($servidor);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $pelicula = Pelicula::where('id', $id)->first();
        return view('registros/peliculas/edit')->with(['pelicula' => $pelicula]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Pelicula::find($id);
        $rel = $modulo->getTable();
        $data = $request->all();

        if($data['pre_imagen'] === null){
            $img = $modulo->imagen;
        }
        
        $validator = Validator::make($data, [
            'titulo'      => $modulo->getUniqueRule(False, $rel, 'titulo').'|string',
            'descripcion' => 'bail|required|string',
            'fecha'        => 'bail|required|string',
            'calificacion' => 'bail|required',
            'codigo'      => 'sometimes|integer',
            'pre_imagen' => 'sometimes',
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

        $modulo = Pelicula::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->adminRegistro($modulo,3); //Manda a eliminar el registro y la bitacora administrador
        return 1;
    }
}
