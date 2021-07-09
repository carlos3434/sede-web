<?php
namespace App\Http\Controllers\Api\SeleccionAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SeleccionAdhoc\Puntaje;
use App\Http\Requests\SeleccionAdhoc\PuntajeAddRequest;
use App\Http\Requests\SeleccionAdhoc\PuntajeUpdateRequest;
use App\Repositories\SeleccionAdhoc\Interfaces\PuntajeRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Convocatoria;

class PuntajeController extends Controller
{
    private $repository;

    public function __construct(PuntajeRepositoryInterface $repository )
    {
        $this->repository = $repository;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|PUNTAJE_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|PUNTAJE_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|PUNTAJE_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|PUNTAJE_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|PUNTAJE_DESTROY'])->only('destroy');
        //mostrarPuntajeesUsuarioActual


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ( !empty($request->excel) ){
            return $this->repository->allToExport($request)
            ->downloadExcel(
                'Puntaje_'.date('m-d-Y_hia').'.xlsx',
                $writerType = null,
                $headings = true
            );
        }
        //solo de la convocatoria actual
        $request->request->add(['convocatoria_id' => (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id : false ]);
        return $this->repository->all($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(PuntajeAddRequest $request)
    {
        $all = $request->all();
        $all['usuario_id'] = Auth::id();
        $all = $this->storeFile($request, $all, 'Puntaje', 'archivo_titulo');
        $puntaje = $this->repository->create( $all );
        return response()->json($puntaje, 201);
    }*/
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Puntaje $puntaje)
    {
        return $this->repository->getOne($puntaje);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Puntaje  $puntaje
     * @return \Illuminate\Http\Response
     */
    /*public function update(PuntajeUpdateRequest $request, Puntaje $puntaje)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'Puntaje', 'archivo_titulo');
        $puntaje = $this->repository->updateOne($all, $puntaje);
        return response()->json($puntaje, 200);
    }*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puntaje  $puntaje
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(Puntaje $puntaje)
    {
        $this->repository->deleteOne($puntaje);
        return response()->json(null, 204);
    }*/

}