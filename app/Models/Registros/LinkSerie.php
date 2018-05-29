<?php

namespace App\Models\Registros;

use Illuminate\Database\Eloquent\Model;
use App\Master;
use Validator;
use Auth;
class LinkSerie extends Master{
	
    protected $table = 'links_series';
    protected $class_name = 'LinkSerie';

    public function registrar_link_serie($request, $id){
        
        $urls = $request['url'];
        $serie_id = $request['serie_id'];
        $aporte_serie_id = $id;
        $id_u = Auth::user()->id;

        foreach ($urls as $url) {
            $modulo = new LinkSerie;
	        $modulo->url = $url;
	        $modulo->serie_id = $serie_id;
	        $modulo->aporte_serie_id = $aporte_serie_id;
	        $modulo->user_id = $id_u;
	        $master = new Master;
        	$master->aporteRegistro($modulo,1); //Manda a actualizar el registro a la bitacora general
	        
        }
        return 1;
    }
}