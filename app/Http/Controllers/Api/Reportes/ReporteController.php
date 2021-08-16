<?php

namespace App\Http\Controllers\Api\Reportes;

use App\Http\Controllers\Controller;
use App\Models\Settings\SedeRegistral;
use Illuminate\Http\Request;


use App\Exports\Anexo2Export;
use App\Exports\Anexo3Export;
use App\Exports\RequerimientoPagoExport;
use App\Exports\Anexo6Export;
use App\Exports\Anexo9Export;
use App\Exports\Cuadro1Export;
use App\Exports\Cuadro2Export;
use App\Exports\Cuadro3Export;
use App\Exports\Cuadro4Export;

use Maatwebsite\Excel\Facades\Excel;

use App\Repositories\Reportes\Interfaces\ReporteRepositoryInterface;
class ReporteController extends Controller
{
    private $repository;
    public function __construct(ReporteRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
    public function anexo2(Request $request )
    {
        if ( !empty($request->excel) || !empty($request->pdf) ){
            $name = 'anexo2_'.date('m-d-Y_hia');
            $type = '.xlsx';
            $query = $this->repository->anexo2Query( $request );
            return Excel::download( new Anexo2Export( $query ), $name. $type);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function anexo3(Request $request)
    {
        if ( !empty($request->excel) || !empty($request->pdf) ){
            $name = 'anexo3_'.date('m-d-Y_hia');
            $type = '.xlsx';
            $query = $this->repository->anexo3Query( $request );
            return Excel::download( new Anexo3Export($query), $name. $type);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function requerimientopago( Request $request )
    {
        if ( !empty($request->excel) || !empty($request->pdf) ){
            $name = 'requerimientopago_'.date('m-d-Y_hia');
            $type = '.xlsx';
            $query = $this->repository->requerimientoPagoQuery( $request );
            return Excel::download( new RequerimientoPagoExport($query), $name. $type);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function anexo6(Request $request )
    {
        if ( !empty($request->excel) || !empty($request->pdf) ){
            $name = 'anexo6_'.date('m-d-Y_hia');
            $type = '.xlsx';
            $query = $this->repository->anexo6Query( $request );
            return Excel::download( new Anexo6Export($query), $name. $type);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function anexo9(Request $request )
    {
        if ( !empty($request->excel) || !empty($request->pdf) ){
            $name = 'anexo9_'.date('m-d-Y_hia');
            $type = '.xlsx';
            $query = $this->repository->anexo9Query( $request );
            return Excel::download( new Anexo9Export($query), $name. $type);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cuadro1(Request $request )
    {
        if ( !empty($request->excel) || !empty($request->pdf) ){
            $name = 'cuadro1_'.date('m-d-Y_hia');
            $type = '.xlsx';
            $query = $this->repository->cuadro1Query( $request );
            return Excel::download( new Cuadro1Export($query), $name. $type);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cuadro2(Request $request )
    {
        if ( !empty($request->excel) || !empty($request->pdf) ){
            $name = 'cuadro2_'.date('m-d-Y_hia');
            $type = '.xlsx';
            $query = $this->repository->cuadro2Query( $request );
            return Excel::download( new Cuadro2Export($query), $name. $type);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cuadro3(Request $request )
    {
        if ( !empty($request->excel) || !empty($request->pdf) ){
            $name = 'cuadro3_'.date('m-d-Y_hia');
            $type = '.xlsx';
            $query = $this->repository->cuadro3Query( $request );
            return Excel::download( new Cuadro3Export($query), $name. $type);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cuadro4(Request $request )
    {
        if ( !empty($request->excel) || !empty($request->pdf) ){
            $name = 'cuadro4_'.date('m-d-Y_hia');
            $type = '.xlsx';
            $query = $this->repository->cuadro4Query( $request );
            return Excel::download( new Cuadro4Export($query), $name. $type);
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
