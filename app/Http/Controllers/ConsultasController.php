<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reportes;
use App\Models\Usuarios\Perfiles;
use App\User;
use Auth;

class ConsultasController extends Controller{

    public function getPerfil(){
        $id_p = Auth::user()->perfil_id;
        return response()->json($id_p);
    }
    // public function getEstados($id){
 //        $estados = Estados::where('pais_id', $id)->orderBy('codigo', 'asc')->get();
 //        return response()->json($estados);
 //    }

 //    public function getMunicipios($id){
 //        $municipios = Municipios::where('estado_id', $id)->orderBy('codigo', 'asc')->get();
 //        return response()->json($municipios);
 //    }

 //    public function getParroquias($id){
 //        $parroquias = Parroquias::where('municipio_id', $id)->orderBy('codigo', 'asc')->get();
 //        return response()->json($parroquias);
 //    }

 //    public function getEmpleados($id){
 //        $empleados = Empleados::where('ubicacion_id', $id)->orderBy('id', 'asc')->get();
 //        return response()->json($empleados);
 //    }
 //    public function getVisitante($data){
 //        $datos = explode("-", $data); //Separo la cadena
 //        $nit = $datos[0]; //cedula
 //        $t_doc = $datos[1]; //tipo de documento
 //        $visitante = Visitas::where('nit', $nit)->where('t_doc', $t_doc)->orderBy('id', 'desc')->limit(1)->get();    
 //        return response()->json($visitante);
 //    }

 //    public function getInformacionReporte($codigo){
 //        $reporte = Reportes::where('codigo', $codigo)->first();
 //        return response()->json($reporte);
 //    }
    // public function getCategoriasReporte($tipo){

    //     switch ($tipo) {
    //         case '101': //Genero
    //             $lista = [['id'=> '1', 'genero'=>'Femenino'],['id'=> '2', 'genero'=>'Masculino']];
    //             break;
    //         case '102': //Motivos
    //             $lista = Motivos::orderBy('id', 'asc')->get();
    //             break;
    //         case '103': //Ocupacion
    //             $lista = Ocupaciones::orderBy('id', 'asc')->get();
    //             break;
    //         case '104': //Tipo de visitante
    //             $lista = [['id'=> '1', 't_visitante'=>'Persona Natural'],['id'=> '2', 't_visitante'=>'Empresa']];
    //             break;
    //         case '105': //Estado
    //             $lista = Estados::orderBy('id', 'asc')->get();
    //             break;
    //         case '106': //Municipio
    //             $estados = Estados::all();
    //             $lista2 = [];
    //             foreach ($estados as $estado) {
    //                 $lista2[] = ['grupo'=> $estado->estado, 'sub_grupo'=>$estado->municipios];
    //             }
    //             $lista = $lista2;
    //             break;
    //         case '107': //Parroquia
    //             $estados = Estados::all();
    //             $lista2 = [];
    //             foreach ($estados as $estado) {
    //                 $lista2[] = ['grupo'=> $estado->estado, 'sub_grupo'=>$estado->parroquias];
    //             }
    //             $lista = $lista2;
    //             break;
    //         case '108': //Ubicacion
    //             $lista = Ubicaciones::orderBy('id', 'asc')->get();
    //             break;
    //         case '109': //Empleado
    //             $ubicaciones = Ubicaciones::all();
    //             $lista2 = [];
    //             $empleado = [];
    //             foreach ($ubicaciones as $ubicacion) {
    //                 $empleados = $ubicacion->empleados;
    //                 foreach ($empleados as $emp) {
    //                     $empleado[] = ['codigo'=> $emp->id, 'nombre'=>$emp->nombre.' '.$emp->apellido];
    //                 }
    //                 $lista2[] = ['grupo'=> $ubicacion->ubicacion, 'sub_grupo'=>$empleado];
    //                  $empleado = [];
    //             }
    //             $lista = $lista2;
    //             break;
    //         case '110': //Estatus
    //             $lista = [['id'=> '1', 'estatus'=>'En Proceso'],['id'=> '2', 'estatus'=>'Finalizada']];
    //             break;
    //         case '111': //Operador(a)
    //             // $lista = User::Where('perfil_id', 2)->orderBy('id', 'asc')->get();
    //             $perfiles = Perfiles::all();
    //             $lista2 = [];
    //             foreach ($perfiles as $perfil) {
    //                 $lista2[] = ['grupo'=> $perfil->perfil, 'sub_grupo'=>$perfil->usuarios];
    //             }
    //             $lista = $lista2;
    //             break;
    //     }
    //     return response()->json($lista);
    // }
}
