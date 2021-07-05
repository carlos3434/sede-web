<?php

namespace App\Http\Controllers\Api\Reportes;

use App\Http\Controllers\Controller;
use App\Models\Settings\SedeRegistral;
use Illuminate\Http\Request;


use App\Exports\PostulantesAdhocExport;
use Maatwebsite\Excel\Facades\Excel;

class PostulantesAdhocController extends Controller
{
    public function __construct()
    {
        /*
        $this->middleware('can:CREATE_TIPOOPERACION')->only(['create','store']);
        $this->middleware('can:READ_TIPOOPERACION')->only('index');
        $this->middleware('can:UPDATE_TIPOOPERACION')->only(['edit','update']);
        $this->middleware('can:DETAIL_TIPOOPERACION')->only('show');
        $this->middleware('can:DELETE_TIPOOPERACION')->only('destroy');*/
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporte(Request $request, PostulantesAdhocExport $export)
    {
        $sql = 'SELECT u.id, u.apellido_paterno , u.apellido_materno , u.nombres ,
                   u.colegio_profesional , u.numero_colegiatura , dep.nombre as departamento_postulacion,
                   f.especialidad , f.fecha_expedicion, f.ciudad , gf.nombre , iff.nombre , 
                   c.nombre , c.fecha_inicio , c.fecha_termino , c.horas_lectivas , c.ciudad, tpc.nombre, ic.nombre,
                   eg.cargo, eg.fecha_inicio , eg.fecha_fin , eg.tiempo_total , ieg.nombre,
                   
                   ei.fecha_inicio , ei.fecha_fin , iei.nombre,
                   
                   vr.nro_expediente , vr.fecha , vr.nro_informe , ivr.nombre,
                   
                   cal.fecha , srcal.nombre , con.nombre

            from users u

            left join model_has_roles ur on ur.model_type = \'App\Models\Auth\User\' and u.id = ur.model_id
            left join distritos dis on u.distrito_id = dis.id
            left join provincias pro on dis.provincia_id = pro.id 
            left join departamentos dep on pro.departamento_id = dep.id

            left join formaciones f on u.id = f.usuario_id
            left join grados gf on f.grado_id = gf.id
            left join instituciones iff on f.institucion_id= iff.id

            left join capacitaciones c on u.id = c.usuario_id
            left join tipos_capacitaciones tpc on c.tipo_capacitacion_id = tpc.id
            left join instituciones ic on c.institucion_id= ic.id

            left join experiencias_generales eg on u.id = eg.usuario_id
            left join instituciones ieg on eg.institucion_id= ieg.id

            left join experiencias_inspectores ei on u.id = ei.usuario_id
            left join instituciones iei on ei.institucion_id= iei.id

            left join verificacion_realizadas vr on u.id = vr.usuario_id
            left join instituciones ivr on vr.institucion_id= ivr.id

            left join calificaciones cal on u.id = cal.usuario_id
            left join convocatorias con on cal.convocatoria_id = con.id
            left join sedes_registrales srcal on cal.sede_registral_id = srcal.id

            left join sedes_registrales sr on cal.sede_registral_id = sr.id

            where ur.role_id = 3';

        $query = \DB::select($sql);

//dd($query);

        //$query = TipoOperacion::filter($request);
        if ( !empty($request->excel) || !empty($request->pdf) ){
            if ( count( $query ) > 0) { //dd("");
                $name = 'postulantes_'.date('m-d-Y_hia');
                $type = '.xlsx';
                return Excel::download($export, $name. $type);
            }
        }
        //return new TipoOperacionCollection($query->sort()->paginate());
    }


    /**
     * listas para reporte
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listas( Request $request)
    {
        $response = [
            'sedes_registrales' => SedeRegistral::all()
        ];
        return response()->json($response, 200);
    }
}
