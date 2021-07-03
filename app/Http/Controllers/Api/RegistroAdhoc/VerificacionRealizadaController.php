<?php
namespace App\Http\Controllers\Api\RegistroAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegistroAdhoc\VerificacionRealizada;
use App\Http\Requests\RegistroAdhoc\VerificacionRealizadaAddRequest;
use App\Http\Requests\RegistroAdhoc\VerificacionRealizadaUpdateRequest;
use App\Repositories\RegistroAdhoc\Interfaces\VerificacionRealizadaRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class VerificacionRealizadaController extends Controller
{
    private $repository;

    public function __construct(VerificacionRealizadaRepositoryInterface $repository )
    {
        $this->repository = $repository;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|VERIFICACION_REALIZADA_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|VERIFICACION_REALIZADA_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|VERIFICACION_REALIZADA_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|VERIFICACION_REALIZADA_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|VERIFICACION_REALIZADA_DESTROY'])->only('destroy');
        //mostrarVerificacionRealizadaesUsuarioActual


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
                'VerificacionRealizada_'.date('m-d-Y_hia').'.xlsx',
                $writerType = null,
                $headings = true
            );
        }
        //$request['user_id'] = Auth::id();
        $request->request->add(['usuario_id' => Auth::id() ]);
        //$request->merge(["usuario_id" => Auth::id()]);
        return $this->repository->all($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VerificacionRealizadaAddRequest $request)
    {
        $all = $request->all();
        $all['usuario_id'] = Auth::id();
        $verificacionRealizada = $this->repository->create( $all );
        return response()->json($verificacionRealizada, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(VerificacionRealizada $verificacionRealizada)
    {
        return $this->repository->getOne($verificacionRealizada);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VerificacionRealizada  $verificacionRealizada
     * @return \Illuminate\Http\Response
     */
    public function update(VerificacionRealizadaUpdateRequest $request, VerificacionRealizada $verificacionRealizada)
    {
        $all = $request->all();
        $verificacionRealizada = $this->repository->updateOne($all, $verificacionRealizada);
        return response()->json($verificacionRealizada, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VerificacionRealizada  $verificacionRealizada
     * @return \Illuminate\Http\Response
     */
    public function destroy(VerificacionRealizada $verificacionRealizada)
    {
        $this->repository->deleteOne($verificacionRealizada);
        return response()->json(null, 204);
    }

}