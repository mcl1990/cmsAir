<?php
// Controlador para editores
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Configuraciones\Resolucion;
use App\Models\Registros\AportePelicula;
use App\Models\Registros\EtiquetaPelicula;
use App\Models\Registros\AporteSerie;
use App\Models\Configuraciones\Etiqueta;
use App\Models\Configuraciones\Formato;
use App\Models\Configuraciones\Idioma;
use App\Models\Configuraciones\Tamano;
use App\Models\Configuraciones\Audio;
use App\Http\Controllers\Controller;
use App\Models\Registros\LinkPelicula;
use App\Models\Registros\LinkSerie;
use App\Models\Registros\Pelicula;
use Illuminate\Support\Facades\DB;
use App\Models\Registros\Serie;
use App\Models\Configuraciones\Categoria;
use App\Models\Configuraciones\Servidor;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Master;
use Validator;
use Auth;

class AporteController extends Controller{

    public function __construct(){
        $this->middleware('auth')->except([
            'index','getData','show'
        ]);
        $this->serie = new Serie;
        $this->aporte_pelicula = new AportePelicula;
        $this->aporte_serie = new AporteSerie;
        $this->link_pelicula = new LinkPelicula;
        $this->link_serie = new LinkSerie;
        $this->master = new Master;
    }
    /**
     * Display a listing of the recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $categorias = Categoria::all();
        $servidores = Servidor::all();
        return view('aportes',[
            'categorias' => $categorias,
            'servidores' => $servidores,
        ]);
    }

    public function getListAportes(){

        $first = DB::table('aportes_peliculas')->where('estatus', 1);

        $aportes = DB::table('aportes_series')->where('estatus', 1)
                    ->union($first)
                    ->get();
        // Aporte::all()
        return Datatables::of($aportes)
            ->addColumn('action', function ($aportes) {
                $modelo = 'aportes';
                return  $this->master->getAccionDataTable($aportes, $modelo);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $resoluciones = Resolucion::all();
        $audios = Audio::all();
        $formatos = Formato::all();
        $tamanos =  Tamano::all();
        $idiomas = Idioma::all();
        $idiomas = Idioma::all();
        $categorias = Categoria::all();
        return view('crear-aporte')->with(['resoluciones' => $resoluciones, 'audios' => $audios, 'formatos' => $formatos, 'tamanos' => $tamanos, 'idiomas' => $idiomas, 'categorias' => $categorias]);
    }

    /**
     * Store a newly created recurso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = false;
        $this->validate($request,[
            'cat' => 'required',
            'codigo' => 'required',
            'calidad' => 'required',
            'idioma' => 'required',
            'subtitulo' => 'required',
            'acortador' => 'required',
            'enlaces' => 'required',
            'tituloAporte' => 'required',
            'tituloPelicula' => 'required',
            'generos' => 'required',
            'imdbID' => 'required',
            'peso' => 'required',
            'unidadPeso' => 'required',
            'formato' => 'required',
            'audio' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required',
            'duracion' => 'required',
            'calificacion' => 'required',
            'calidad' => 'required',
        ]);
        $data = $request->all();
        switch ($data['cat']) {
            case '2':
                
                break;
            
            default:
                $pelicula = Pelicula::firstOrNew(['titulo' => $data['tituloPelicula']]);
                $id = $pelicula->id;
                if($id === null){
                    $pelicula->fill([
                       'duracion' => $data['duracion'], 
                       'descripcion' => $data['descripcion'], 
                       'fecha' => $data['fecha'], 
                       'codigo' => $data['codigo'], 
                       'calificacion' => $data['calificacion'], 
                       'user_id' => Auth::user()->id, 
                       'status' => 1,
                    ]);
                    $id = $pelicula->validate_save($data);
                }
                foreach ($data['enlaces'] as $link) {
                    $servidor = Servidor::firstOrNew(['servidor' => parse_url($link,PHP_URL_HOST)]);
                    if($servidor->id === null){
                        $servidor->save();
                    }
                    $aporte = new AportePelicula;
                    $aporte->fill([
                        'titulo' => $data['tituloAporte'],
                        'enlace' => $link,
                        'categoria_id' => $data['cat'],
                        'resolucion_id' => $data['calidad'],
                        'audio_id' => $data['audio'],
                        'video_id' => $data['formato'],
                        'subtitulo_id' => $data['subtitulo'],
                        'idioma_id' => $data['idioma'],
                        'peso' => $data['peso'],
                        'tamano_archivo_id' => $data['unidadPeso'],
                        'pelicula_id' => $id,
                        'status' => 1,
                        'servidor_id' => $servidor->id,
                        'user_id' => Auth::user()->id,
                    ]);
                    $validator = $aporte->validate_save($link, $id);
                    if(($request->has('etiquetas')) && (strlen($request->input('etiquetas')) > 0)){
                        $etiquetas = explode(',',$data['etiquetas']);
                        foreach ($etiquetas as $str) {
                            $etiqueta = Etiqueta::firstOrNew([
                                'etiqueta' => $str,
                            ]);
                            if($etiqueta->id == null){
                                $etiqueta->status = 1;
                                $etiqueta->user_id = Auth::user()->id;
                                $etiqueta->save();
                            }
                            $pivote = new EtiquetaPelicula;
                            $pivote->aporte_pelicula_id = $validator;
                            $pivote->etiqueta_id = $etiqueta->id;
                            $pivote->save();
                        }
                    }
                }
                break;
        }
        if($validator) return redirect()->route('aportes.index');
    }

    /**
     * Display the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($categoria,$id){
        switch ($categoria) {
            case 's':
                
                break;
            
            default:
                try {
                    $aportePelicula = AportePelicula::findOrFail($id);
                    // $aportePelicula->visto = $aportePelicula->visto + 1;
                    // $aportePelicula->save();
                    $aportePelicula->increment('visto');
                    return view('aporte-detalles')->with('aporte',$aportePelicula);
                } catch (ModelNotFoundException $e) {
                    abort(404);
                }
                
                break;
        }
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
    public function destroy($id){

        $modulo = Aporte::find($id); // Instancia el modelo
        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->adminRegistro($modulo,3); //Manda a eliminar el registro a la bitacora general
        return 1;
    }

    public function getData(Request $request)
    {
        $aportesP = AportePelicula::orderBy('id','desc')->get();
        // $aportesS = AporteSerie::all();
        $todos = [];
        $data = $request->all();
        foreach ($aportesP as $aporte) {
            $fila = [
                'id' => $aporte->id,
                'etiquetas' => $aporte->etiquetas->pluck('etiqueta')->toArray(),
                'icono' => $aporte->enlace,
                'cid' => $aporte->categoria_id,
                'categoria' => 'movie',
                'titulo' => $aporte->titulo,
                'usuario' => $aporte->usuario->name,
                'vistas' => $aporte->visto,
                'peso' => $aporte->peso . ' ' . $aporte->tamano->tamano,
                'codigo' => $aporte->id,
                'servidor' => $aporte->servidor_id,
                'unidad_peso' => $aporte->tamano->tamano,
                'pesonro' => $aporte->peso,
            ];
            $todos[] = $fila;
        }
        // foreach ($aportesS as $aporte) {
        //     $fila = [
        //         'icono' => 'mega.png',
        //         'cid' => $aporte->categoria_id,
        //         'categoria' => 'movie',
        //         'titulo' => $aporte->titulo,
        //         'usuario' => $aporte->usuario->name,
        //         'vistas' => 7,
        //         'peso' => $aporte->peso . ' ' . $aporte->tamano->tamano,
        //         'unidad_peso' => $aporte->tamano->tamano,
        //         'codigo' => $aporte->id,
        //         'servidor' => $aporte->servidor_id,
        //         'peso_nro' => $aporte->peso,
        //     ];
        //     $todos[] = $fila;
        // }
        $coleccion = new Collection($todos); 
        return Datatables::of($coleccion)
            ->filter(function($instancia) use($request) {
                // Titulo
                if($request->get('search')['value'] != ''){
                    $instancia->collection = $instancia->collection->filter(function($row) use($request){
                        return str_contains($row['titulo'], $request->get('search')['value']) === false ? false : true;
                    });
                }
                // Categoria
                if($request->has('categoria')){
                    $instancia->collection = $instancia->collection->filter(function ($row) use ($request) {
                        return in_array($row['cid'], $request->get('categoria'));
                    });
                }
                if($request->has('usuario') && $request->get('usuario') != null){
                    $instancia->collection = $instancia->collection->filter(function ($row) use ($request) {
                        return str_contains($row['usuario'], $request->get('usuario')) ? true : false;
                    });
                }
                // Etiquetas
                if($request->get('etiquetas') != ''){
                    $eqtasArray = explode(',',$request->get('etiquetas'));
                    $instancia->collection = $instancia->collection->filter(function ($row) use ($request,$eqtasArray) {
                        $esta = false;
                        foreach ($eqtasArray as $tag) {
                            if(in_array($tag, $row['etiquetas'])) $esta = true;
                        }
                        return $esta;
                    });   
                }
                // Tamaño maximo
                if($request->has('tmax') && $request->get('tmax') != null){
                    $instancia->collection = $instancia->collection->filter(function ($row) use ($request) {
                        switch ($row['unidad_peso']) {
                            case 'GB':
                                $peso = intval($row['pesonro']) * 1024;
                                break;
                            
                            default:
                                $peso = intval($row['pesonro']);
                                break;
                        }
                        return intval($request->get('tmax')) > $peso;
                    });                        
                }
                // Tamaño minimo
                if($request->has('tmin') && $request->get('tmin') != null){
                    $instancia->collection = $instancia->collection->filter(function ($row) use ($request) {
                        switch ($row['unidad_peso']) {
                            case 'GB':
                                $peso = intval($row['pesonro']) * 1024;
                                break;
                            case 'TB':
                                $peso = intval($row['pesonro']) * 1024000;
                                break;
                            default:
                                $peso = intval($row['pesonro']);
                                break;
                        }
                        return intval($request->get('tmin')) < $peso;
                    });                        
                }
            })
            ->make(true);
    }
}
