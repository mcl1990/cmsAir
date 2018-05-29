<?php

namespace App\Http\Controllers\Widgets;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\Widgets\TipoWidget;
use App\Models\Widgets\Widget;
use Illuminate\Http\Request;
use App\Master;
use Validator;

class WidgetController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new Widget;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        
        return view('widgets/widgets/listar');
    }

    public function getListWidgets(){

        return Datatables::of(Widget::all())
            ->addColumn('action', function ($widgets) {
                $modelo = 'widgets';
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
        $tipos = TipoWidget::orderBy('id', 'asc')->get();
        return view('widgets/widgets/registrar')->with(['list_tipos' => $tipos]);

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
            'titulo'         => $modulo->getUniqueRule(True, $rel, 'titulo').'|string',
            'descripcion'    => $rule,
            'tipo_widget_id' => $rule,
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
        
        $this->master->adminRegistro($modulo,1); //Manda a crea el registro y la bitacora administrador

        return view('widgets/widgets/listar');
    }

    /**
     * Display the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $servidor = Widget::where('id', $id)->get();
        return response($servidor);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $servidor = Widget::where('id', $id)->first();
        return view('widgets/widgets/edit')->with(['servidor' => $servidor]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Widget::find($id);
        $rel = $modulo->getTable();
        $data = $request->all();

        if($data['icono'] === null){
            $img = $modulo->icono;
        }

        $validator = Validator::make($data, [
            'servidor' => $modulo->getUniqueRule(False, $rel, 'servidor').'|string',
            'icono' => 'sometimes',
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
        if($data['icono'] != null){
            /////// ACTUALIZACION DE IMAGEN
            $baseFromJavascript = $data['icono'];
            $base_to_php = explode(',', $baseFromJavascript);
            $imagen = base64_decode($base_to_php[1]);
            file_put_contents('images/iconos/'.$pk.'.jpg', $imagen); 
            $modulo->icono = $pk.'.jpg';
        }else{
            $modulo->icono = $img;
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

        $modulo = Widget::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->adminRegistro($modulo,3); //Manda a eliminar el registro a la bitacora general
        return 1;
    }
}
