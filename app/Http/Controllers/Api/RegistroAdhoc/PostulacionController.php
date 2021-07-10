<?php
namespace App\Http\Controllers\Api\RegistroAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SeleccionAdhoc\Interfaces\CalificacionRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistroAdhoc\PostulacionRequest;
use App\Models\Auth\User;
use App\Models\Settings\Convocatoria;
use App\Rules\ConvocatoriaActual as ConvocatoriaActualRule;

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
     * retorna la postulacion del usuario logueado
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->getByUserId(Auth::id());
    }
    /**
     * guarda en la tabla calificaciones cuando el usuario adhoc postula a una convocatoria
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostulacionRequest $request)
    {
        $all = $request->all();
        $all['convocatoria_id'] = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id : false;

        $validator = \Validator::make(
            $all,['convocatoria_id' => [new ConvocatoriaActualRule ]]
        )->validate();

        $all['usuario_id'] = Auth::id();
        $all['fecha'] = date("Y-m-d");

        $calificacion = $this->repository->create( $all );
        return response()->json($calificacion, 201);
    }

}