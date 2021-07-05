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
        if ( !empty($request->excel) || !empty($request->pdf) ){
            $name = 'postulantes_'.date('m-d-Y_hia');
            $type = '.xlsx';
            return Excel::download($export, $name. $type);
        }
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
