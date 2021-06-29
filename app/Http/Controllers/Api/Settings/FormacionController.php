<?php
namespace App\Http\Controllers\Api\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\Formacion;
use App\Http\Requests\Settings\FormacionRequest;
use App\Repositories\Settings\Interfaces\FormacionRepositoryInterface;
use App\Http\Resources\Settings\Formacion\FormacionExcelCollection;

class FormacionController extends Controller
{
    private $repository;

    public function __construct(FormacionRepositoryInterface $repository)
    {
        $this->repository = $repository;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_DESTROY'])->only('destroy');
        //mostrarFormacionesUsuarioActual
        

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
                'Formacion_'.date('m-d-Y_hia').'.xlsx',
                $writerType = null,
                $headings = true
            );
        }
        return $this->repository->all($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormacionRequest $request)
    {
        $formacion = $this->repository->create($request->all());
        return response()->json($formacion, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Formacion $formacion)
    {
        return $this->repository->getOne($formacion);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Formacion  $formacion
     * @return \Illuminate\Http\Response
     */
    public function update(FormacionRequest $request, Formacion $formacion)
    {
        $formacion = $this->repository->updateOne($request, $formacion);
        return response()->json($formacion, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Formacion  $formacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formacion $formacion)
    {
        $this->repository->deleteOne($formacion);
        return response()->json(null, 204);
    }

    public function mostrarFormacionesUsuarioActual()
    {
        
        $datos['institucion'] = Institucion::select([
            'instituciones.id',
            'instituciones.nombre'
        ])
            ->leftjoin('tipos_instituciones', 'tipos_instituciones.id', '=', 'instituciones.tipo_institucion_id')
            //id=1 tipo de institucion es academica
            ->whereIn('tipos_instituciones.id', [1])
            ->orderBy('instituciones.nombre', 'asc')->get();
        $datos['grado_academico']=Grado::all();
        $usuario=Auth::user();
        $datos['user']=$usuario;
        return view('cvitae.formacion-academica',$datos);
        
    }

}