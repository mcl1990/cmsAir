<?php

namespace App\Http\Controllers\Configuraciones;

use App\Models\Configuraciones\Genero;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Master;
use Validator;

class GeneroController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new Genero;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        return view('configuraciones/generos/listar');
    }

    public function getListGenero(){

        return Datatables::of(Genero::all())
            ->addColumn('action', function ($generos) {
                $modelo = 'generos';
                return  $this->master->getAccionDataTable($generos, $modelo);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('configuraciones/generos/registrar');
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
            'genero' => $modulo->getUniqueRule(True, $rel, 'genero').'|string|max:25',
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
        
        $genero = Genero::where('id', $id)->get();
        return response($genero);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $genero = Genero::where('id', $id)->first();
        return view('configuraciones/generos/edit')->with(['genero' => $genero]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Genero::find($id); // Instancia el modelo
        $rel = $modulo->getTable(); // Tabla
        $data = $request->all(); // Post recibido

        $validator = Validator::make($data, [
            'genero' => $modulo->getUniqueRule(False, $rel, 'genero').'|string|max:25',
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

        $modulo = Genero::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->registrarConfiguraciones($modulo,null,3); //Elimina el registro y Notifica a la bitacora Admin
        return 1;
    }
    /**
     * Remove the specified recurso from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function descargar_generos(Request $request){

        
        $data = $request->all();
        $generos = $data['val']['genres'];

        foreach ($generos as $gen) { //Arma el Save
            $modulo = new Genero; // Instancia el modelo
            if($modulo->where('codigo', $gen['id'])->count() === 0){
                $modulo->codigo = $gen['id'];
                $modulo->genero = $gen['name'];
                $modulo->save();
            }
        }
        return 1;
       
    }
}
