<?php
namespace App\Http\Controllers\Api\RegistroAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SeleccionAdhoc\Interfaces\CalificacionRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistroAdhoc\PostulacionRequest;
use App\Models\Auth\User;
use \App\Models\Settings\Convocatoria;
class PostulacionController extends Controller
{
    private $repository;

    public function __construct( CalificacionRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware(['role_or_permission:ADMINISTRADOR|POSTULACION_SHOW'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|POSTULACION_CREATE'])->only('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->getOneForDocumento(Auth::id());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostulacionRequest $request)
    {
        $all = $request->all();
        $all['usuario_id'] = Auth::id();
        $all['convocatoria_id'] = Convocatoria::GetActual();
        //$all['convocatoria_id'] = false;
        $all['fecha'] = date('Ymd');
        //dd($all);
        $calificacion = $this->repository->create( $all );
        return response()->json($calificacion, 201);
    }

}