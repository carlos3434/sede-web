<?php
namespace App\Http\Controllers\Api\SeleccionAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SeleccionAdhoc\Calificacion;
use App\Http\Requests\SeleccionAdhoc\CalificacionAddRequest;
use App\Http\Requests\SeleccionAdhoc\CalificacionUpdateRequest;
use App\Repositories\SeleccionAdhoc\Interfaces\CalificacionRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Convocatoria;

class CalificacionController extends Controller
{
    private $repository;

    public function __construct(CalificacionRepositoryInterface $repository )
    {
        $this->repository = $repository;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|CALIFICACION_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|CALIFICACION_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|CALIFICACION_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|CALIFICACION_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|CALIFICACION_DESTROY'])->only('destroy');
        //mostrarCalificacionesUsuarioActual


    }

    /**
     * muestra el listado de posstulaciones de la convocatoria actual
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ( !empty($request->excel) ){
            return $this->repository->allToExport($request)
            ->downloadExcel(
                'Calificacion_'.date('m-d-Y_hia').'.xlsx',
                $writerType = null,
                $headings = true
            );
        }
        //por defecto traer todos las calificaciones con puntajes mayor a cero
        $request->request->add( ['puntaje' => $request->input('puntaje', 0) ]);
        $request->request->add( ['filtro'  => $request->input('filtro', '>=') ]);
        //solo de la convocatoria actual
        $request->request->add(['convocatoria_id' => (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id : false ]);
        return $this->repository->allWithPuntajes($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(CalificacionAddRequest $request)
    {
        $all = $request->all();
        $all['usuario_id'] = Auth::id();
        $all = $this->storeFile($request, $all, 'Calificacion', 'archivo_titulo');
        $calificacion = $this->repository->create( $all );
        return response()->json($calificacion, 201);
    }*/
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Calificacion $calificacion)
    {
        return $this->repository->getOne($calificacion);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calificacion  $calificacion
     * @return \Illuminate\Http\Response
     */
    /*public function update(CalificacionUpdateRequest $request, Calificacion $calificacion)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'Calificacion', 'archivo_titulo');
        $calificacion = $this->repository->updateOne($all, $calificacion);
        return response()->json($calificacion, 200);
    }*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Calificacion  $calificacion
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(Calificacion $calificacion)
    {
        $this->repository->deleteOne($calificacion);
        return response()->json(null, 204);
    }*/

}