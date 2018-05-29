<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Usuarios\Perfiles;
use App\Models\Configuraciones\Pais;
use App\Master;
use Validator;
use App\User;
use Auth;

class UserController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new User;
        $this->master = new Master;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        return view('usuarios/usuarios/listar');
    }

    public function getListUser(){


        $string = "SELECT u.id, row_number() over(), u.name, u.email, u.password, p.perfil ";
        $string .= " FROM users AS u INNER JOIN perfiles AS p ON u.perfil_id=p.id";
        $usuarios = DB::select($string);

        return Datatables::of($usuarios)
            ->addColumn('action', function ($usuarios) {
                $modelo = 'usuarios';
                return  $this->master->getAccionDataTable($usuarios, $modelo);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        $perfiles = Perfiles::orderBy('id', 'asc')->get();
        return view('usuarios/usuarios/registrar')->with(['list_perfiles' => $perfiles]);
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

        $rule = 'bail|required|';
        $validator = Validator::make($data, [
            'name' => $modulo->getUniqueRule(True, $rel, 'name').'|string|max:50',
            'email' => $modulo->getUniqueRule(True, $rel, 'email').'|string|max:100',
            'password' => $rule.'confirmed',
            'perfil_id' => $rule.'integer',
        ]); // Validador del formulario

        if ($validator->fails()) {
            $codes = $this->resource->returnMessageCodeError($validator);
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
        $modulo->password = bcrypt($data['password']);
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
        
        $bombona = User::where('id', $id)->get();
        return response($bombona);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $usuario = User::where('id', $id)->first();
        $perfiles = Perfiles::orderBy('id', 'asc')->get();
        return view('usuarios/usuarios/edit')->with(['list_perfiles' => $perfiles, 'usuario' => $usuario]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
       
        $modulo = User::find($id);
        $rel = $modulo->getTable();
        $data = $request->all();

        $pk = $modulo->getKeyName(); //PrimaryKey
        $rule = 'sometimes|';
        $validator = Validator::make($data, [
            'name' => $modulo->getUniqueRule(False, $rel, 'name').'|string|max:50',
            'email' => $modulo->getUniqueRule(False, $rel, 'email').'|string|max:100',
            'password' => $rule.'confirmed',
            'perfil_id' => $rule.'integer',
        ]); // Validador del formulario

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

        $modulo->password = bcrypt($data['password']);
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

        $modulo = User::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->adminRegistro($modulo,3); //Manda a eliminar el registro a la bitacora general
        return 1;

    }



    /**
     * Show the form for editing the specified resource (Perfiles de editores)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perfiles(){

        $usuario = User::where('id', Auth::user()->id)->first();
        $perfiles = Perfiles::orderBy('id', 'asc')->get();
        $paises = Pais::orderBy('id', 'asc')->get();
        return view('usuarios/usuarios/perfil_editores')->with(['list_perfiles' => $perfiles, 'list_paises' => $paises, 'usuario' => $usuario]);


    }
}
