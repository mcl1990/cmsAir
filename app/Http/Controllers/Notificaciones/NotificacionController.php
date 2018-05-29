<?php

namespace App\Http\Controllers\Notificaciones;

use App\Models\Notificaciones\TipoNotificacion;
use App\Models\Notificaciones\Notificacion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Master;
use Validator;
use Auth;

class NotificacionController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->recurso = new Notificacion;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('notificaciones/notificaciones/listar');
    }

    public function getListNotificaciones(){

        $user = Auth::user()->id;
        $notificaciones = DB::table('notificaciones AS n')
            ->join('tipos_notificaciones AS t', 'n.tipos_notificaciones_id', '=', 't.id')
            ->select('n.*', 't.tipo_notificacion AS tipo', 't.icono', 't.style',
                DB::raw("date_part('DAY', now()::timestamp - n.created_at) AS dias"))
            ->where('n.user_id', $user)
            ->orderBy('n.id', 'desc')
            ->get();

        return Datatables::of($notificaciones)
            ->addColumn('action', function ($notificaciones) {
                $modelo = 'notificaciones';
                return  "<a class='show' style='color: black' href='#' title='Ver' id=".$notificaciones->id." data-toggle='tooltip' data-placement='top' ><i class='material-icons'>visibility</i></a>";
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('notificaciones/notificaciones/registrar');
    }

    /**
     * Store a newly created recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
    }

    /**
     * Display the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $notificacion = DB::table('notificaciones AS n')
            ->join('tipos_notificaciones AS t', 'n.tipos_notificaciones_id', '=', 't.id')
            ->select('n.*', 't.tipo_notificacion AS tipo', 't.icono', 't.style',
                DB::raw("date_part('DAY', now()::timestamp - n.created_at) AS dias"))
            ->where('n.id', $id)
            ->orderBy('n.id', 'desc')
            ->get();
        return response($notificacion);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $tipo_notificacion = Notificacion::where('id', $id)->first();
        return view('notificaciones/notificaciones/edit')->with(['tipo_notificacion' => $tipo_notificacion]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Notificacion::find($id);

        $modulo->updated_at = date("Y/m/d H:i:s");
        $modulo->status = 1;
        $modulo->save();

        return 1;
    }

    /**
     * Remove the specified recurso from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $modulo = Notificacion::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->adminRegistro($modulo,3); //Manda a eliminar el registro a la bitacora general
        return 1;
    }


    public function up_notificaciones(){

        $user_id = Auth::user()->id;
        Notificacion::where('user_id',$user_id)->where('status', 1)->update(['status' => 2]);        
        
        return 1;
       
    }
}
