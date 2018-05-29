<?php

namespace App\Http\Controllers\Registros;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Configuraciones\Resolucion;
use App\Models\Registros\AportePelicula;
use App\Models\Registros\AporteSerie;
use App\Models\Configuraciones\Sancion;
use App\Models\Configuraciones\Formato;
use App\Models\Configuraciones\Idioma;
use App\Models\Configuraciones\Tamano;
use App\Models\Configuraciones\Audio;
use App\Http\Controllers\Controller;
use App\Models\Registros\AporteLikeNoLike;
use App\Models\Registros\Seguidor;
use App\Models\Registros\Pelicula;
use Illuminate\Support\Facades\DB;
use App\Models\Registros\Serie;
use Yajra\Datatables\Datatables;
use App\Models\Notificaciones\Notificacion;
use Illuminate\Http\Request;
use App\Master;
use App\User;
use Validator;
use Auth;

class AporteController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->pelicula = new Pelicula;
        $this->serie = new Serie;
        $this->aporte_pelicula = new AportePelicula;
        $this->aporte_serie = new AporteSerie;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        if(Auth::user()->perfil_id === 3){
            return view('registros/aportes/listar');
        }else{
            $sanciones = Sancion::orderBy('id', 'asc')->get();
            return view('registros/aportes/admin/listar')->with(['list_sanciones' => $sanciones]);
        }
    }

    public function getListAportes(){
        $aportes = [];
        if(DB::table('aportes_peliculas')->count() > 0){
            AportePelicula::chunk(20, function($lote) use (&$aportes) {
                foreach ($lote as $aporte) {
                    $aportes[] = [
                        'id' => $aporte->id,
                        'titulo' => $aporte->titulo,
                        'categoria_id' => $aporte->categoria_id,
                        'imagen' => $aporte->pelicula->imagen,
                        'enlace' => $aporte->enlace,
                        'etiquetas' => $aporte->etiquetas->pluck('etiqueta')->toArray(),
                        'cid' => $aporte->categoria_id,
                        'peso' => $aporte->peso . ' ' . $aporte->tamano->tamano,
                        'servidor' => $aporte->servidor->icono,
                    ];
                }
            });            
        }
        if(DB::table('aportes_series')->count() > 0){
            AporteSerie::chunk(20, function($lote) use (&$aportes){
                foreach ($lote as $aporte) {
                    $aportes[] = [
                        'id' => $aporte->id,
                        'titulo' => $aporte->titulo,
                        'categoria_id' => $aporte->categoria_id,
                        'imagen' => $aporte->pelicula->imagen,
                        'enlace' => $aporte->enlace,
                        'etiquetas' => $aporte->etiquetas->pluck('etiqueta')->toArray(),
                        'cid' => $aporte->categoria_id,
                        'peso' => $aporte->peso . ' ' . $aporte->tamano->tamano,
                        'servidor' => $aporte->servidor_id,
                    ];
                }
                
            });            
        }

        $col = new Collection($aportes);
        return Datatables::of($col)
            ->addColumn('action', function ($col) {
                switch ($col['categoria_id']) {
                    case 2:
                        $ruta = 'aportes_serie';
                        $t = 's';
                        break;
                    
                    default:
                        $ruta = 'aportes_pelis';
                        $t = 'p';
                        break;
                }
                return  "<a class='delet_".$t."' style='color: black' href='javascript:void(0)' title='Eliminar' id=".$col['id']." data-toggle='tooltip' data-placement='top'><i class='material-icons'>delete</i></a>";
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $peliculas = Pelicula::orderBy('id', 'asc')->get();
        $resoluciones = Resolucion::orderBy('id', 'asc')->get();
        $audios = Audio::orderBy('id', 'asc')->get();
        $formatos = Formato::orderBy('id', 'asc')->get();
        $tamanos =  Tamano::orderBy('id', 'asc')->get();
        $idiomas = Idioma::orderBy('id', 'asc')->get();
        return view('registros/aportes/registrar')->with(['list_peliculas' => $peliculas, 'list_resoluciones' => $resoluciones, 'list_audios' => $audios, 'list_formatos' => $formatos, 'list_tamanos' => $tamanos, 'list_idiomas' => $idiomas]);
    }

    /**
     * Store a newly created recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        $data = $request->all();
        ////////////////////// Peliculas
        if($data['categoria'] === '1'){ 
            $peliculas = $this->pelicula;
            $existe = $peliculas->where('codigo', $data['codigo'])->count(); // Si ya existe en la BD

            if($existe === 0){ // Si es > 0 Se guarda la pelicula en la tabla peliculas pricipal
                $id_p = $peliculas->validate_save($data);
            }else{
                $id = $series->where('codigo', $data['codigo'])->pluck('codigo');
                $id_p =$id[0];
            }

            $modulo = $this->aporte_pelicula;
            $validator = $modulo->validate_save($data, $id_p);

        ////////////////////// Series y Animes
        }else if($data['categoria'] === '2'){

            $series = $this->serie;
            $existe = $series->where('codigo', $data['codigo'])->count(); // Si ya existe en la BD

            if($existe === 0){ // Si es > 0 Se guarda la pelicula en la tabla peliculas pricipal
                $id_s = $series->validate_save($data);
            }else{
                $id = $series->where('codigo', $data['codigo'])->pluck('codigo');
                $id_s =$id[0];
            }

            $modulo = $this->aporte_serie;
            $validator = $modulo->validate_save($data, $id_s);
        }
         
        return 1;
    }

    /**
     * Display the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cat, $id){
        switch ($cat) {
            case 2:
                $aporte = AportePelicula::where('id', $id)->get();                
                break;
            
            default:
                $aporte = AportePelicula::where('id', $id)->get();
                break;
        }
        return response($aporte);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $aporte = Aporte::where('id', $id)->first();
        $peliculas = Pelicula::orderBy('id', 'asc')->get();
        $resoluciones = Resolucion::orderBy('id', 'asc')->get();
        $audios = Audio::orderBy('id', 'asc')->get();
        $formatos = Formato::orderBy('id', 'asc')->get();
        $tamanos =  Tamano::orderBy('id', 'asc')->get();
        $idiomas = Idioma::orderBy('id', 'asc')->get();
        return view('registros/aportes/edit')->with(['aporte' => $aporte, 'list_peliculas' => $peliculas, 'list_resoluciones' => $resoluciones, 'list_audios' => $audios, 'list_formatos' => $formatos, 'list_tamanos' => $tamanos, 'list_idiomas' => $idiomas]);
    }

    /**
     * Update the specified recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $modulo = Aporte::find($id); // Instancia el modelo
        $rel = $modulo->getTable(); // Tabla
        $data = $request->all(); // Post recibido

        $pk = $modulo->getKeyName(); //PrimaryKey

        $rule = 'sometimes|';
        $validator = Validator::make($data, [
            'titulo' => $rule.'string',
            'duracion' => $rule.'string',
            'pelicula_id' => $rule.'integer',
            'resolucion_id' => $rule.'integer',
            'formato_audio_id' => $rule.'integer',
            'formato_video_id' => $rule.'integer',
            'peso' => $rule.'numeric',
            'tamano_archivo_id' => $rule.'integer',
            'idiomas' => $rule.'string',
            // 'subtitulos' => $rule.'string',
        ]);

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
        $modulo->save();
        return 1;
    }

    /**
     * Remove the specified recurso from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cat, $id){

        switch ($cat) {
            case 2:
                
                break;
            
            default:
                $modulo = AportePelicula::find($id); // Instancia el modelo                
                break;
        }
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->adminRegistro($modulo,3); //Manda a eliminar el registro a la bitacora general
        return 1;
    }

    public function like_no_like_aporte($cate, $id_aporte, $tipo){

        ///Valida el tipo de opinion sobre el aporte (por defecto Like)
        $status = 1; //Me gusta
        $incrementable = 'likes'; //Variable para que autoincremente el campo de acuerdo al tipo recibido
        $t = 7; //tipo
        if($tipo === 'no_like'){//Si le dio No me gusta
            $status = 2; //No me gusta
            $incrementable = 'no_likes';
            $t = 8;
        }

        switch ($cate) {//Categorias
            case '1': //Pelicuas
                AportePelicula::where('id',$id_aporte)->increment($incrementable); //Incrementa el val del aporte
                $aporte = AportePelicula::where('id',$id_aporte)->get()[0]; //Captura el Id del aportador
                break;
            case '2': //Series y Animes
                AporteSerie::where('id',$id_aporte)->increment($incrementable); //Incrementa el val del aporte
                $aporte = AportePelicula::where('id',$id_aporte)->pluck('user_id')[0]; //Captura el Id del aportador
                break;
        }

        $id_u = Auth::user()->id; //Id del usuario que ejecuto la accion.

        //////////////
        ////////Modelo Aportes a los que se les dio like o no_like
        $ap_likes = new AporteLikeNoLike;
        $ap_likes->aporte_id = $id_aporte;
        $ap_likes->categoria_id = $cate;
        $ap_likes->user_id = $id_u;
        $ap_likes->status = $status;
        $ap_likes->created_at = date("Y/m/d H:i:s");
        $ap_likes->save();

        //////////////
        /// Incrementa el total de likes o no_likes totales del usuario
        User::where('id',$aporte['user_id'])->increment($incrementable);

        //////////////
        /// Notifica al creador del aporte que fue "calificado" su aporte
        $username = User::where('id',$id_u)->pluck('name')[0];
        $notificacion = new Notificacion;
        $notificacion->validate_save($aporte['user_id'],$t,$username,$aporte['titulo']); //Manda a crear Notifiacion de mensaje respondido
        // $clase = $ap_likes->getClass();
        // $bitacora = new BitacoraEditor;
        // $bitacora->registrar_acion_editor($clase,2,$id,$id_u); //Notifica a bitacora admin
        return 1;
    }

    public function nuevo_seguidor($cate, $id_aporte){

        switch ($cate) {
            case '1': //Pelicuas
                $id_user_a = AportePelicula::where('id',$id_aporte)->pluck('user_id')[0];
                break;
            case '2': //Series y Animes
                $id_user_a = AporteSerie::where('id',$id_aporte)->pluck('user_id')[0];

                break;
        }

        $id_seguidor = Auth::user()->id; //Id del seguidor

        //////////////
        ////////Modelo Seguidores 
        $seguidores = new Seguidor;
        $seguidores->user_seguido_id = $id_user_a; //A quien siguen
        $seguidores->user_id = $id_seguidor; //Quien lo sigue
        $seguidores->created_at = date("Y/m/d H:i:s"); //fecha
        $seguidores->save();

        //////////////
        /// Incrementa el total de seguidores de un usuario
        User::where('id',$id_user_a)->increment('seguidores');

        //////////////
        /// Notifica al usuario quien lo comenzo a seguir
        $nombre = User::where('id',$id_user_a)->pluck('name')[0];
        $notificacion = new Notificacion;
        $notificacion->validate_save($id_user_a,4,$nombre); //Manda a crear Notifiacion de mensaje respondido

        // $clase = $modulo->getClass();
        // $bitacora = new BitacoraEditor;
        // $bitacora->registrar_acion_editor($clase,2,$id,$id_u); //Notifica a bitacora admin
        return $nombre;
    }
}
