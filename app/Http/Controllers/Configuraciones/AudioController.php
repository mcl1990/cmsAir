<?php

namespace App\Http\Controllers\Configuraciones;

use App\Models\Configuraciones\Audio;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Master;
use Validator;

class AudioController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new Audio;
        $this->master = new Master;
    
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        
        return view('configuraciones/audios/listar');
    }

    public function getListAudio(){

        return Datatables::of(Audio::all())
            ->addColumn('action', function ($audios) {
                $modelo = 'audios';
                return  $this->master->getAccionDataTable($audios, $modelo);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('configuraciones/audios/registrar');
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
            'audio' => $modulo->getUniqueRule(True, $rel, 'audio').'|string|max:8',
        ]); // Validador del formulario

        // Se revisa si hubo algun campo o valor invalido
        if ($validator->fails()) {
            $codes = $modulo->returnMessageCodeError($validator);
            return array_values($codes); // Se envia mensaje con el error
        } 

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
        
        $audio = Audio::where('id', $id)->get();
        return response($audio);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $audio = Audio::where('id', $id)->first();
        return view('configuraciones/audios/edit')->with(['audio' => $audio]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Audio::find($id); // Instancia el modelo
        $rel = $modulo->getTable(); // Tabla
        $data = $request->all(); // Post recibido

        $validator = Validator::make($data, [
        	'audio' => $modulo->getUniqueRule(False, $rel, 'audio').'|string|max:8',
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

        $modulo = Audio::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
        	return 99;
        }

        $this->master->registrarConfiguraciones($modulo,null,3); //Elimina el registro y Notifica a la bitacora Admin
        return 1;
    }
}
