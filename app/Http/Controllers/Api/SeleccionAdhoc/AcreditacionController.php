<?php
namespace App\Http\Controllers\Api\SeleccionAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SeleccionAdhoc\Interfaces\AcreditacionRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SeleccionAdhoc\AcreditacionRequest;
use App\Models\Auth\User;
use App\Models\Settings\Convocatoria;
use App\Rules\ConvocatoriaActual as ConvocatoriaActualRule;

class AcreditacionController extends Controller
{
    private $repository;

    public function __construct( AcreditacionRepositoryInterface $repository)
    {
        $this->repository = $repository;
        //$this->middleware(['role_or_permission:ADMINISTRADOR|Acreditacion_SHOW'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|ACREDITACION_CREATE'])->only('index');
    }

    /**
     * retorna la Acreditacion del usuario logueado
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        return $this->repository->getByUserId(Auth::id());
    }*/
    /**
     * guarda en la tabla Acreditaciones cuando el usuario adhoc postula a una convocatoria
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcreditacionRequest $request)
    {
        $all = $request->all();
        $all['convocatoria_id'] = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id : false;

        $validator = \Validator::make(
            $all,['convocatoria_id' => [new ConvocatoriaActualRule ]]
        )->validate();

        $all['usuario_id'] = Auth::id();
        $all['fecha'] = date("Y-m-d");
        //validar si tiene puntaje
        $puntaje = $this->repository->sumPuntajeByCalificacionId($request->calificacion_id);
        if ($puntaje==0) {
            return response()->json(['message' => "No se puede acreditar la postulacion cuando la suma de los puntajes es cero" ], 422);
        }
        //validar si ya se registro acreditacion
        $acreditacion = [];
        $acreditaionDB = $this->repository->countByCalificacionId($request->calificacion_id);
        if ($acreditaionDB==0) {
            $acreditacion = $this->repository->create( $all );
        } else {
            return response()->json(['message' => "Ya se han registrado acreditacion para esa calificacion" ], 422);
        }
        return response()->json($acreditacion, 201);
    }

}