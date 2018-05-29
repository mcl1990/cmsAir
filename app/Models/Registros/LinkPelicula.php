<?php

namespace App\Models\Registros;

use Illuminate\Database\Eloquent\Model;
use App\Master;
use Validator;
use Auth;
class LinkPelicula extends Master{
	
    protected $connection = 'secundaria';
    protected $table = 'link_peliculas';
    protected $class_name = 'LinkPelicula';

    public function registrar_link_pelicula($enlace, $aporteID){

        // $urls = $data['enlaces'];
        $id_u = Auth::user()->id;
        // foreach ($urls as $url) {
        $modulo = new LinkPelicula;
        $modulo->url = $enlace;
        $modulo->aporte_pelicula_id = $aporteID;
        $modulo->user_id = $id_u;
        // dd($modulo);
        $master = new Master;
    	return $master->aporteRegistro($modulo,1); //Manda a actualizar el registro a la bitacora general
        // }
        // return 1;
    }

    public function aporte()
    {
        return $this->belongsTo('App\AportePelicula')->withDefault();
    }

    public function usuario()
    {
        return $this->belongsTo('App\User')->withDefault();
    }
}