<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\BitacoraEditor;
use Validator;

class BitacoraEditorController extends Controller{


    public function __construct(){
        $this->middleware('auth');
        $this->resource = new BitacoraEditor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        
        return view('bitacora/editores');
    }

    public function getListBitacoraEditor(){

        $bitacoras_editor = DB::table('bitacoras_editor AS b')
            ->join('users AS u', 'b.user_id', '=', 'u.id')
            ->select('b.id', 'b.modulo', 'b.registro_id', 'b.created_at', 'u.name',
                DB::raw("(CASE WHEN b.accion_id = 1 THEN 'Creó' WHEN b.accion_id = 2 THEN 'Actualizó' ELSE 'Eliminó' END) AS accion"))
            ->orderBy('b.id')
            ->get();

        return Datatables::of($bitacoras_editor)
            ->addColumn('action', function ($bitacoras_editor) {
                $modelo = 'BitacoraEditor';
                return  $this->master->getAccionDataTable($bitacoras_editor, $modelo);
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
        
        $formato = Bitacora::where('id', $id)->get();
        return response($formato);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id){

    //     $modulo = Bitacora::find($id);

    //     $relations = $modulo->searchRelations($modulo);

    //     if($relations === True) {
    //     	return 99;
    //     }

    //     $modulo->delete();
    //     return 1;
    // }
}
