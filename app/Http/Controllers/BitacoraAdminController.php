<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\BitacoraAdmin;
use App\Master;
use Validator;

class BitacoraAdminController extends Controller{


    public function __construct(){
        $this->middleware('auth');
        $this->resource = new BitacoraAdmin;
        $this->master = new Master;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        
        return view('bitacora/administradores');
    }

    public function getListBitacoraAdmin(){
        $bitacoras_admin = DB::table('bitacoras_admin AS b')
            ->join('users AS u', 'b.user_id', '=', 'u.id')
            ->select('b.id', 'b.modulo', 'b.registro_id', 'b.created_at', 'u.name',
                DB::raw("(CASE WHEN b.accion_id = 1 THEN 'Creó' WHEN b.accion_id = 2 THEN 'Actualizó' WHEN b.accion_id = 3 THEN 'Eliminó' WHEN b.accion_id = 4 THEN 'Aprobó' ELSE 'Innactivó' END) AS accion"))
            ->orderBy('b.id')
            ->get();

        return Datatables::of($bitacoras_admin)
            ->addColumn('action', function ($bitacoras_admin) {
                $modelo = 'BitacoraAdmin';
                return  $this->master->getAccionDataTable($bitacoras_admin, $modelo);
            })
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $formato = BitacoraAdmin::where('id', $id)->get();
        return response($formato);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id){

    //     $modulo = BitacoraAdmin::find($id);

    //     $relations = $modulo->searchRelations($modulo);

    //     if($relations === True) {
    //     	return 99;
    //     }

    //     $modulo->delete();
    //     return 1;
    // }
}
