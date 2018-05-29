<?php

namespace App\Http\Controllers\Notificaciones;

use App\Models\Notificaciones\TipoNotificacion;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Master;
use Validator;
use Auth;

class TipoNotificacionController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new TipoNotificacion;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        return view('notificaciones/tipos_notificaciones/listar');
    }

    public function getListTipoNotificaciones(){

        return Datatables::of(TipoNotificacion::all())
            ->addColumn('action', function ($notificaciones) {
                $modelo = 'tipos_notificaciones';
                return  $this->master->getAccionDataTable($notificaciones, $modelo);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('notificaciones/tipos_notificaciones/registrar');
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

        $rule = 'bail|required|string';
        $validator = Validator::make($data, [
            'tipo_notificacion'  => $modulo->getUniqueRule(True, $rel, 'tipo_notificacion').'|string',
            'style'              => $rule,
            'icono'              => $rule,
        ]);

        if ($validator->fails()) {
            $codes = $modulo->returnMessageCodeError($validator);
            return array_values($codes);
        }
        
        $modulo->user_id = Auth::user()->id;
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
        
        $tipo_notificacion = TipoNotificacion::where('id', $id)->get();
        return response($tipo_notificacion);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $tipo_notificacion = TipoNotificacion::where('id', $id)->first();
        return view('notificaciones/tipos_notificaciones/edit')->with(['tipo_notificacion' => $tipo_notificacion]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = TipoNotificacion::find($id);
        $rel = $modulo->getTable();
        $data = $request->all();

        $rule = 'bail|required|string';
        $validator = Validator::make($data, [
            'tipo_notificacion'      => $modulo->getUniqueRule(False, $rel, 'tipo_notificacion').'|string',
            'style'                  => $rule,
            'icono'                  => $rule,
        ]);

        if ($validator->fails()) {
            $codes = $modulo->returnMessageCodeError($validator);
            return array_values($codes);
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

        $modulo = TipoNotificacion::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->registrarConfiguraciones($modulo,null,3); //Elimina el registro y Notifica a la bitacora Admin
        return 1;
    }
}
