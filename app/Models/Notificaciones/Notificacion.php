<?php

namespace App\Models\Notificaciones;

use Illuminate\Database\Eloquent\Model;
use App\Models\Configuraciones\Sancion; 
use App\Models\Notificaciones\TipoNotificacion; 
use App\Models\BitacoraAdmin;
use App\Master;
use Validator;

class Notificacion extends Master{
	
    protected $table = 'notificaciones';
    protected $class_name = 'Notificacion';

    public function validate_save($user, $tipo, $sub_user=null, $extra=null){

    	$modulo = $this;

        switch ($tipo) {
            case 1: //Mensaje Respondido
                $texto = TipoNotificacion::where('id', 1)->pluck('mensaje')[0];
                break;
            case 2: //Aporte Eliminado
                $mensaje = TipoNotificacion::where('id', 2)->pluck('mensaje')[0];
                $sancion = Sancion::where('id', $extra)->pluck('sancion')[0];
                $texto = "Aporte Eliminado por : ".$sancion." - ".$mensaje;
                break;
            case 3: //Cuenta Inabilitada
                $mensaje = TipoNotificacion::where('id', 3)->pluck('mensaje')[0];
                $sancion = Sancion::where('id', $extra)->pluck('sancion')[0];
                $texto = "Cuenta Inabilitada por : ".$sancion." ".$mensaje;
            case 4: //Nuevo Seguidor
                $mensaje = TipoNotificacion::where('id', 4)->pluck('mensaje')[0];
                $texto = $sub_user." ".$mensaje;
                break;
            case 5: //Nuevo Aporte
                $mensaje = TipoNotificacion::where('id', 5)->pluck('mensaje')[0];
                $texto = $sub_user." ".$mensaje." ".$extra;
                break;
            case 6: //Informacion (de parte del staff)
                $mensaje = $extra;
                break;
            case 7: //Le gusto tu publicacion
                $texto = "El usuario ".$sub_user." le gustó tu aporte ".$extra;
                break;
            case 8: //No le gusto tu publicacion
                $texto = "El usuario ".$sub_user." no le gustó tu aporte ".$extra;
                break;
        }

        $modulo->tipos_notificaciones_id = $tipo;
        $modulo->mensaje = $texto;
        $modulo->status = 1;
        $modulo->user_id = $user;
        $modulo->created_at = date("Y/m/d H:i:s");
        $modulo->save();
        $pk = $modulo->getKey();

        //Bitacora
        $bitacora = new BitacoraAdmin;
        $clase = $modulo->getClass();
        $bitacora->registrar_accion_admin($clase,1,$pk,$user); //(Modelo, Accion, pk, id_usuario)

        return $pk;
    }

    static function get_notificaciones(){

        $user = Auth::user()->id;
        $notificaciones = DB::table('notificaciones AS n')
            ->join('tipos_notificaciones AS t', 'n.tipos_notificaciones_id', '=', 't.id')
            ->select('n.*', 't.tipo_notificacion AS tipo', 't.icono', 't.style',
                DB::raw("date_part('DAY', now()::timestamp - n.created_at) AS dias"))
            ->where('n.user_id', $user)
            ->orderBy('n.id', 'desc')
            ->get();

        return $notificaciones;
    }
}
