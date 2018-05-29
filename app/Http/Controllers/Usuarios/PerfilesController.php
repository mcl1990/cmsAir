<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\Usuarios\Perfiles;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Master;
use Validator;

class PerfilesController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new Perfiles;
        $this->master = new Master;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        return view('usuarios/perfiles/listar');
    }

    
    public function getListPerfiles(){

        return Datatables::of(Perfiles::all())
            ->addColumn('action', function ($perfiles) {
                $modelo = 'perfiles';
                return  $this->master->getAccionDataTable($perfiles, $modelo);
            })
            ->make(true);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('usuarios/perfiles/registrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        $modulo = $this->recurso;
        $rel = $modulo->getTable(); // Tabla
        $data = $request->all(); // Post recibido
        
        $validator = Validator::make($data, [
            'perfil' => $modulo->getUniqueRule(True, $rel, 'perfil').'|string|max:25',
        ]); // Validador del formulario

        // Se revisa si hubo algun campo o valor invalido
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

        $this->master->adminRegistro($modulo,1); //Manda a crea el registro a la bitacora general
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $perfil = Perfiles::where('id', $id)->get();
        return response($perfil);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $perfil = Perfiles::where('id', $id)->first();
        return view('usuarios/perfiles/edit')->with(['perfil' => $perfil]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Perfiles::find($id);
        $rel = $modulo->getTable();
        $data = $request->all();

        $pk = $modulo->getKeyName(); //PrimaryKey
        $validator = Validator::make($data, [
            'perfil' => $modulo->getUniqueRule(True, $rel, 'perfil').'|string|max:25',
        ]); // Validador del formulario

        // Se revisa si hubo algun campo o valor invalido
        if ($validator->fails()) {
            $codes = $modulo->returnMessageCodeError($validator);
            return array_values($codes);
        }

        $columnas = $modulo->getColumnNames(); //Colums
        foreach ($columnas as $col) { //Arma el Save
            if($col == $pk){
                continue;
            }
            if(in_array($col, array_keys($data))){
                $modulo->$col = $data[$col];
            }
        }

        $this->master->adminRegistro($modulo,2); //Manda a actualizar el registro a la bitacora
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $modulo = Perfiles::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->adminRegistro($modulo,3); //Manda a eliminar el registro a la bitacora general
        return 1;

    }
}
