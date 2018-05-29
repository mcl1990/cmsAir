<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Reportes;
use App\Margenes;
use App\Visitas;
use App\Campos;
use Validator;

class ReportesController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->resource = new Visitas;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	$reportes = Reportes::orderBy('id', 'asc')->get();
        $columnas = Campos::orderBy('id', 'asc')->get();
        return view('reportes/reporteador')->with(['list_reportes' => $reportes, 'list_columnas' => $columnas]);
    }

    public function get_Margenes($val){
        $list_datos = explode("@@", $val);
        $ori = $list_datos[1]; //Orientacion del Reporte
        $f_pag = $list_datos[0]; //formato del Reporte
        $conf_rep = Margenes::where('formato', $f_pag)->where('orientacion', $ori)->get();
        
        return response()->json($conf_rep);
    }

    public function get_Longitud_Campo($val){

        $conf_rep = Campos::where('codigo', $val)->sum('longitud'); //Sumatoria total de la longitud de todos los campos
        
        return response()->json($conf_rep);
    }

    public function verificar_reporte($reporte, $categoria, $desde, $hasta){

        $string = "SELECT vi.id, vi.codigo, vi.nombre, vi.apellido, mo.motivo, vi.email, ";

        $string .= "tu.abreviatura||'. '||ub.ubicacion ubicacion, vi.edad, ";
        $string .= "ca.cargo, direccion, oc.ocupacion, es.estado, mu.municipio, pa.parroquia,";
        $string .= " em.nombre nom_emp, em.apellido ape_emp, vi.tlf_fijo, vi.celular, ";
        $string .= "(CASE WHEN vi.sexo = 1 THEN 'Femenino' ELSE 'Masculino' END) sexo, ";
        $string .= "(CASE WHEN vi.t_visitante = '1' THEN 'P. Natural' ELSE 'Empresa' END) t_visitante, ";
        $string .= "(CASE WHEN vi.status = 1 THEN 'En Proceso' ELSE 'Finalizada' END) estatus, ";
        $string .= "(CASE WHEN vi.t_doc = 1 THEN 'V'  WHEN vi.t_doc = 2 THEN 'E' ELSE 'J' END)||'-'||vi.nit nit, ";
        $string .= "to_char(vi.created_at, 'DD/MM/YYYY HH12:MI:SS AM') AS fecha_entrada, ";
        $string .= "to_char(vi.updated_at, 'DD/MM/YYYY HH12:MI:SS AM') AS fecha_salida ";
        $string .= "FROM visitas AS vi ";
        $string .= "INNER JOIN ubicaciones AS ub ON vi.ubicacion_id=ub.codigo ";
        $string .= "INNER JOIN empleados AS em ON vi.empleado_id=em.id ";
        $string .= "INNER JOIN motivos AS mo ON vi.motivo_id=mo.id ";
        $string .= "INNER JOIN cargos AS ca ON em.cargo_id=ca.id ";
        $string .= "INNER JOIN ocupaciones AS oc ON vi.ocupacion_id=oc.id ";
        $string .= "INNER JOIN estados AS es ON vi.estado_id=es.codigo ";
        $string .= "INNER JOIN municipios AS mu ON vi.municipio_id=mu.codigo ";
        $string .= "INNER JOIN parroquias AS pa ON vi.parroquia_id=pa.codigo ";
        $string .= "INNER JOIN tipos_ubicacion AS tu ON ub.tipo_ubicacion_id=tu.id ";
        switch ($reporte) {
            case '101': //Genero
                $string .= "WHERE vi.sexo=".$categoria;
                break;
            case '102': //Motivos
                $string .= "WHERE vi.motivo_id=".$categoria;
                break;
            case '103': //Ocupacion
                $string .= "WHERE vi.ocupacion_id=".$categoria;
                break;
            case '104':
                $string .= "WHERE vi.t_visitante='".$categoria."'";
                break;
            case '105':
                $string .= "WHERE vi.estado_id=".$categoria;
                break;
            case '106':
                $string .= "WHERE vi.municipio_id=".$categoria;
                break;
            case '107':
                $string .= "WHERE vi.parroquia_id=".$categoria;
                break;
            case '108':
                $string .= "WHERE vi.ubicacion_id=".$categoria;
                break;
            case '109':
                $string .= "WHERE vi.empleado_id=".$categoria;
                break;
            case '110':
                $string .= "WHERE vi.status=".$categoria;
                break;
            case '111':
                $string .= "WHERE vi.user_create=".$categoria;
                break;
        }
        if($reporte == '100'){
            $string .= " WHERE vi.created_at::date between '".$desde."' and '".$hasta."'";
        }else{
            $string .= " AND vi.created_at::date between '".$desde."' and '".$hasta."'";
        }

        $visitas = DB::select($string);
        $cant_reg = count($visitas);
        
        if ($cant_reg === 0){
            return 404;
        }else{
            return $visitas;
        }
    }
 
}
