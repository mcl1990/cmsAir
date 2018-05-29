<?php

namespace App\Http\Controllers\Configuraciones;

use App\Models\Configuraciones\Pais;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use App\Models\BitacoraAdmin;
use Illuminate\Http\Request;
use App\Master;
use Validator;
use Auth;

class PaisController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new Pais;
        $this->master = new Master;
    }
    
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        
        return view('configuraciones/paises/listar');
    }

    public function getListPais(){

        return Datatables::of(Pais::all())
            ->addColumn('action', function ($paises) {
                $icon = "success";
                $title = "Desactivar";
                if ($paises->status === 2){
                    $icon = "danger";
                    $title = "Activar";
                }
                return "<a class='activar_desactivar' href='' title='".$title."' id=".$paises->id." data-toggle='tooltip' data-placement='top' ><i class='material-icons text-".$icon."'>brightness_1</i></a> <a title='Editar' href='/admin/paises/".$paises->id."/edit' data-toggle='tooltip' data-placement='top' ><i class='material-icons'>edit</i></a> <a class='delet' href='' title='Eliminar' id=".$paises->id." data-toggle='tooltip' data-placement='top' ><i class='material-icons'>delete</i></a>";
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('configuraciones/paises/registrar');
    }

    /**
     * Store a newly created recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $modulo = $this->recurso;
        $rel = $modulo->getTable(); // Tabla
        $data = $request->all(); // Post recibido
        
        $validator = Validator::make($data, [
            'pais' => $modulo->getUniqueRule(True, $rel, 'pais').'|string|max:50',
        ]); // Validador del formulario

        // Se revisa si hubo algun campo o valor invalido
        if ($validator->fails()) {
            $codes = $modulo->returnMessageCodeError($validator);
            return array_values($codes); // Se envia mensaje con el error
        } 
        $modulo->status = 1;
        $this->master->registrarConfiguraciones($modulo,$data,1); //Guarda el registro y Notifica a la bitacora Admin
        return 1;
        
    }

    /**
     * Display the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $pais = Pais::where('id', $id)->get();
        return response($pais);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $pais = Pais::where('id', $id)->first();
        return view('configuraciones/paises/edit')->with(['pais' => $pais]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Pais::find($id); // Instancia el modelo
        $rel = $modulo->getTable(); // Tabla
        $data = $request->all(); // Post recibido

        $pk = $modulo->getKeyName(); //PrimaryKey
        $validator = Validator::make($data, [
            'pais' => $modulo->getUniqueRule(False, $rel, 'pais').'|string|max:50',
        ]);

        // Se revisa si hubo algun campo o valor invalido
        if ($validator->fails()) {
            $codes = $modulo->returnMessageCodeError($validator);
            return array_values($codes); // Se envia mensaje con el error
        }

        $this->master->registrarConfiguraciones($modulo,$data,2); //Guarda el registro y Notifica a la bitacora Admin
        return 1;
    }

    /**
     * Remove the specified recurso from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $modulo = Pais::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->registrarConfiguraciones($modulo,null,3); //Elimina el registro y Notifica a la bitacora Admin
        return 1;
    }

    public function act_des_pais($id, $status){

        $modulo = Pais::find($id);

        $s = 0;
        $a = 0; 
        switch ($status) {
            case '1': //Desactivar
                $s = 2; // Estatus
                $a = 5; // Accion
                break;
            case '2': //Activar
                $s = 1; // Estatus
                $a = 4; // Accion
                break;
        }

        $modulo->status = $s;
        $modulo->save();

        $clase = $modulo->getClass();
        $id_u = Auth::user()->id;
        $bitacora = new BitacoraAdmin;
        $bitacora->registrar_accion_admin($clase,2,$id,$id_u); //Notifica a bitacora admin
        return 1;
    }
}
