<?php

namespace App\Http\Controllers\Configuraciones;

use App\Models\Configuraciones\Categoria;
use App\Models\Configuraciones\Etiqueta;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\BitacoraAdmin;
use Illuminate\Http\Request;
use App\Master;
use Validator;
use Auth;

class EtiquetaController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new Etiqueta;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        return view('configuraciones/etiquetas/listar');
    }

    public function getListEtiquetas(){

        return Datatables::of(Etiqueta::all())
            ->addColumn('action', function ($etiquetas) {
                
                $icon = "success";
                $title = "Desactivar";
                if ($etiquetas->status === 3){
                    $icon = "warning";
                    $title = "Aprobar/Desaprobar";
                }else if ($etiquetas->status === 2){
                    $icon = "danger";
                    $title = "Activar";
                }
                return "<a class='activar_desactivar' href='' title='".$title."' id=".$etiquetas->id." data-toggle='tooltip' data-placement='top' ><i class='material-icons text-".$icon."'>brightness_1</i></a> <a title='Editar' href='/admin/etiquetas/".$etiquetas->id."/edit' data-toggle='tooltip' data-placement='top' ><i class='material-icons'>edit</i></a> <a class='delet' href='' title='Eliminar' id=".$etiquetas->id." data-toggle='tooltip' data-placement='top' ><i class='material-icons'>delete</i></a>";
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categorias = Categoria::orderBy('id', 'asc')->get();
        return view('configuraciones/etiquetas/registrar')->with(['list_categorias' => $categorias]);
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
            'etiqueta' => $modulo->getUniqueRule(True, $rel, 'etiqueta').'|string|max:25',
        ]); // Validador del formulario

        // Se revisa si hubo algun campo o valor invalido
        if ($validator->fails()) {
            $codes = $modulo->returnMessageCodeError($validator);
            return array_values($codes); // Se envia mensaje con el error
        } 
  
        $modulo->user_id = Auth::user()->id;
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
        
        $etiqueta = Etiqueta::where('id', $id)->get();
        return response($etiqueta);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $etiqueta = Etiqueta::where('id', $id)->first();
        return view('configuraciones/etiquetas/edit')->with(['etiqueta' => $etiqueta]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Etiqueta::find($id); // Instancia el modelo
        $rel = $modulo->getTable(); // Tabla
        $data = $request->all(); // Post recibido

        $validator = Validator::make($data, [
            'etiqueta' => $modulo->getUniqueRule(False, $rel, 'etiqueta').'|string|max:25',
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

        $modulo = Etiqueta::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->registrarConfiguraciones($modulo,null,3); //Guarda el registro y Notifica a la bitacora Admin
        return 1;
    }
    public function estatus_etiqueta($id, $estatus){

        $modulo = Etiqueta::find($id);

        switch ($estatus) {
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
