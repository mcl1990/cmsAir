<?php

namespace App\Http\Controllers\Widgets;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\Widgets\TipoWidget;
use Illuminate\Http\Request;
use App\Master;
use Validator;

class TipoWidgetController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new TipoWidget;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        
        return view('widgets/tipos_widgets/listar');
    }

    public function getListTipoWidgets(){

        return Datatables::of(TipoWidget::all())
            ->addColumn('action', function ($widgets) {
                $modelo = 'tipos_widgets';
                return  $this->master->getAccionDataTable($widgets, $modelo);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('widgets/tipos_widgets/registrar');
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
            'titulo'      => $modulo->getUniqueRule(True, $rel, 'titulo').'|string',
            'descripcion' => $rule,
            'icono'       => $rule,
            'estructura'  => $rule,
        ]);

        if ($validator->fails()) {
            $codes = $modulo->returnMessageCodeError($validator);
            return array_values($codes);
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
        
        $servidor = TipoWidget::where('id', $id)->get();
        return response($servidor);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $tipo = TipoWidget::where('id', $id)->first();
        return view('widgets/tipos_widgets/edit')->with(['tipo' => $tipo]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = TipoWidget::find($id);
        $rel = $modulo->getTable();
        $data = $request->all();

        $rule = 'bail|required|string';
        $validator = Validator::make($data, [
            'titulo'      => $modulo->getUniqueRule(True, $rel, 'titulo').'|string',
            'descripcion' => $rule,
            'icono'       => $rule,
            'estructura'  => $rule,
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

        $modulo = TipoWidget::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->registrarConfiguraciones($modulo,null,3); //Guarda el registro y Notifica a la bitacora Admin
        return 1;
    }
}
