<?php

namespace App\Http\Controllers\Registros;

use App\Models\Notificaciones\Notificacion;
use App\Models\Registros\AportePelicula;
use App\Models\Configuraciones\Formato;
use App\Models\Configuraciones\Idioma;
use App\Models\Configuraciones\Tamano;
use App\Models\Configuraciones\Resolucion;
use App\Models\Configuraciones\Audio;
use App\Http\Controllers\Controller;
use App\Models\Registros\LinkPelicula;
use App\Models\Registros\LinkSerie;
use App\Models\Registros\Pelicula;
use Illuminate\Support\Facades\DB;
use App\Models\Registros\Serie;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Master;
use Validator;
use Auth;

class AportePeliculaController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->master = new Master;
    }

    /**
     * Display the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $servidor = AportePelicula::where('id', $id)->get();
        return response($servidor);
    }

    /**
     * Show the form for editing the specified recurso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $aporte = AportePelicula::where('id', $id)->first();
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

        $modulo = AportePelicula::find($id); // Instancia el modelo
        $rel = $modulo->getTable(); // Tabla
        $data = $request->all(); // Post recibido

        $pk = $modulo->getKeyName(); //PrimaryKey

        $rule = 'sometimes|';
        $validator = Validator::make($data, [
            'titulo' => $rule.'string',
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
    public function destroy($cate,$id){

        $modulo = AportePelicula::find($id); // Instancia el modelo

        $relations = $modulo->searchRelations($modulo); // Verifica que no tenga registros asociados

        if($relations === True) { // Si posee retorna una excepcion
            return 99;
        }

        $this->master->adminRegistro($modulo,3); //Manda a eliminar el registro a la bitacora general

        $notificacion = new Notificacion;
        $user = $modulo->user_id;
        $notificacion->validate_save($user,2,null,$cate); //Manda a crear Notifiacion aporte eliminado y el motivo
        return 1;
    }
}
