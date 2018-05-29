<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use Closure;
use Auth;
class NotificacionesUser{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next){

    	$user = Auth::user()->id;
        $notificaciones = DB::connection('primaria')->table('notificaciones AS n')
            ->join('tipos_notificaciones AS t', 'n.tipos_notificaciones_id', '=', 't.id')
            ->select('n.*', 't.icono', 't.style', DB::raw("now()::date - n.created_at::date AS dias"))
            ->where('n.user_id', $user)->orderBy('n.id', 'desc')->get();

            $cantidad = $notificaciones->where('status',1)->count();

        	session(['notificaciones' => $notificaciones, 'cantidad' => $cantidad]);

        return $next($request);
    	
    }

}
