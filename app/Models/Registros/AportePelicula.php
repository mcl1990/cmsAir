<?php

namespace App\Models\Registros;

use Illuminate\Database\Eloquent\Model;
use App\Models\Registros\LinkPelicula;
use App\Master;
use Validator;

class AportePelicula extends Master{
	
    protected $table = 'aportes_peliculas';
    protected $class_name = 'AportePelicula';
    protected $fillable = [
        'titulo','enlace','visto','pelicula_id','resolucion_id','audio_id','video_id','user_id','subtitulo_id','idioma_id','peso','tamano_archivo_id','status', 'servidor_id','categoria_id'
    ];

    public function validate_save($enlace, $id_p){

    	// $modulo = $this;
        // $master = new Master;
        // $pk = $master->aporteRegistro($modulo,1); //Manda a crea el registro a la bitacora general
        $pk = $this->aporteRegistro($this,1); //Manda a crea el registro a la bitacora general
        // $link = new LinkPelicula;
        // $link->registrar_link_pelicula($enlace,$pk);

        return $pk;
    }

    protected $casts = [
        'status' => 'boolean',
    ];

    public function links()
    {
        return $this->hasMany('App\Models\Registros\LinkPelicula');
    }

    public function resolucion()
    {
        return $this->belongsTo('App\Models\Configuraciones\Resolucion')->withDefault();
    }

    public function pelicula()
    {
        return $this->belongsTo('App\Models\Registros\Pelicula','pelicula_id')->withDefault();
    }

    public function audio()
    {
        return $this->belongsTo('App\Models\Configuraciones\Audio')->withDefault();
    }

    public function video()
    {
        return $this->belongsTo('App\Models\Configuraciones\Video')->withDefault();
    }

    public function usuario()
    {
        return $this->belongsTo('App\User','user_id')->withDefault();
    }

    public function subtitulo()
    {
        return $this->belongsTo('App\Models\Configuraciones\Subtitulo')->withDefault();
    }

    public function idioma()
    {
        return $this->belongsTo('App\Models\Configuraciones\Idioma')->withDefault();
    }

    public function tamano()
    {
        return $this->belongsTo('App\Models\Configuraciones\Tamano','tamano_archivo_id')->withDefault();
    }

    public function servidor()
    {
        return $this->belongsTo('App\Models\Configuraciones\Servidor')->withDefault();
    }

    public function etiquetas()
    {
        return $this->belongsToMany('App\Models\Configuraciones\Etiqueta','etiquetas_aporte_pelicula');
    }
}