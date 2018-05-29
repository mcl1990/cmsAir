<?php

namespace App\Http\Controllers\Registros;

use App\Models\Notificaciones\Notificacion;
use App\Models\Configuraciones\Motivo;
use App\Http\Controllers\Controller;
use App\Models\Registros\Mensaje;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\Registros\Serie;
use Illuminate\Http\Request;
use App\Master;
use Validator;
use Auth;

class MensajeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->notificacion = new Notificacion;
        $this->recurso = new Mensaje;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        return view('registros/mensajes/listar');
    }

    public function getListMensajes(){

        $mensajes = DB::table('mensajes AS m')
            ->join('motivos AS mo', 'm.motivo_id', '=', 'mo.id')
            ->select('m.*', 'mo.motivo', DB::raw("(CASE WHEN m.status = 1 THEN 'Pendiente' ELSE 'Canalizado' END) AS status"))
            ->orderBy('id')
            ->get();

        return Datatables::of($mensajes)
            ->addColumn('action', function ($mensajes) {

                if($mensajes->status === 'Pendiente'){
                    $td= "<a style='color: grey' title='Editar' href='/admin/mensajes/".$mensajes->id."/edit' data-toggle='tooltip' data-placement='top' ><i class='material-icons'>edit</i></a>";
                }else{
                    $td= "<i title='Cerrado' style='color: black' class='material-icons'>verified_user</i>";
                }
                return  $td;
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $motivos = Motivo::orderBy('id', 'asc')->get();
        return view('registros/mensajes/registrar')->with(['list_motivos' => $motivos]);
    }

    public function getListMisMensajes(){

        $mensajes = DB::table('mensajes AS m')
            ->join('motivos AS mo', 'm.motivo_id', '=', 'mo.id')
            ->select('m.*', 'mo.motivo', DB::raw("(CASE WHEN m.status = 1 THEN 'Enviado' ELSE 'Canalizado' END) AS status"))
            ->orderBy('id')
            ->get();

        return Datatables::of($mensajes)
            ->addColumn('action', function ($mensajes) {
                $modelo = 'mensajes';
                return  $this->master->getAccionDataTable($mensajes, $modelo);
            })
            ->make(true);
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
            'motivo_id'  => $rule.'|integer',
            'mensaje' => $rule.'|string',
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

        $modulo->status = 1;
        $modulo->user_id = Auth::user()->id;

        $this->master->aporteRegistro($modulo,1); //Manda a crea el registro y la bitacora administrador

        return 1;
    }

    /**
     * Display the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $temporada = Mensaje::where('id', $id)->get();
        return response($temporada);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
 
        $mensaje = Mensaje::where('id', $id)->first();
        return view('registros/mensajes/edit')->with(['mensaje' => $mensaje]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Mensaje::find($id);
        $rel = $modulo->getTable();
        $data = $request->all();

        $rule = 'bail|required';
        $validator = Validator::make($data, [
            'respuesta'  => $rule.'|string',
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

        $modulo->status = 2;
        $modulo->admin_id = Auth::user()->id;

        $this->master->adminRegistro($modulo,2); //Manda a crea el registro y la bitacora administrador

        $user = $modulo->user_id;
        $this->notificacion->validate_save($user,1); //Manda a crear Notifiacion de mensaje respondido

        return 1;
    }

    /**
     * Remove the specified recurso from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $modulo = Mensaje::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->adminRegistro($modulo,3); //Manda a eliminar el registro y la bitacora administrador
        return 1;
    }
}
