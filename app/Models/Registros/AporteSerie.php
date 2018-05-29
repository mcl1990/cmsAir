<?php

namespace App\Models\Registros;

use Illuminate\Database\Eloquent\Model;
use App\Models\Registros\LinkSerie;
use App\Master;
use Validator;
use Auth;

class AporteSerie extends Master{
	
    protected $table = 'aportes_series';
    protected $class_name = 'AporteSerie';

    public function validate_save($atributos, $id_s){

        $modulo = $this;
        $rule = 'bail|required|';
        $validator = Validator::make($atributos, [
            'titulo' => $rule.'string',
            'duracion' => $rule.'string',
            'serie_id' => $rule.'integer',
            'resolucion_id' => $rule.'integer',
            'formato_audio_id' => $rule.'integer',
            'formato_video_id' => $rule.'integer',
            'peso' => $rule.'numeric',
            'tamano_archivo_id' => $rule.'integer',
            'idiomas_id' => $rule.'integer',
            'temporada' => $rule.'integer',
            'episodio' => $rule.'integer',

            // 'sub_titulos' => $rule,
        ]);

        // Se revisa si hubo algun campo o valor invalido
        if ($validator->fails()) {
            $codes = $modulo->returnMessageCodeError($validator);
            print_r("validator :".$codes." ");
            return array_values($codes); // Se envia mensaje con el error
        }

        $pk = $modulo->getKeyName(); //PrimaryKey
        $columnas = $modulo->getColumnNames(); //Colums
        foreach ($columnas as $col) { //Arma el Save
            if($col == $pk){
                continue;
            }
            if(in_array($col, array_keys($atributos))){
                $modulo->$col = $atributos[$col];
            }
        }

        $s = 1;
        if(Auth::user()->perfil_id === 3){
            $s = 3;
        }

        $modulo->serie_id = $id_s;
        $modulo->estatus = $s;
        $modulo->user_id = Auth::user()->id;
        $master = new Master;
        $pk = $master->aporteRegistro($modulo,1); //Manda a crea el registro a la bitacora general

        $link = new LinkSerie;
        $link->registrar_link_serie($atributos,$pk);

        return $validator;
    }

    public function links()
    {
        return $this->hasMany('App\Models\Registros\LinkSerie');
    }

    public function resolucion()
    {
        return $this->belongsTo('App\Models\Configuraciones\Resolucion')->withDefault();
    }

    public function serie()
    {
        return $this->belongsTo('App\Models\Registros\Serie','serie_id')->withDefault();
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
}