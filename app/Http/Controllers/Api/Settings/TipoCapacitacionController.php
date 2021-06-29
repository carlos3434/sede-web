<?php
namespace App\Http\Controllers\Api\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\TipoCapacitacion;
use App\Http\Requests\Settings\TipoCapacitacionRequest;
use App\Repositories\Settings\Interfaces\TipoCapacitacionRepositoryInterface;

class TipoCapacitacionController extends Controller
{
    private $repository;

    public function __construct(TipoCapacitacionRepositoryInterface $repository)
    {
        $this->repository = $repository;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|TIPO_CAPACITACION_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|TIPO_CAPACITACION_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|TIPO_CAPACITACION_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|TIPO_CAPACITACION_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|TIPO_CAPACITACION_DESTROY'])->only('destroy');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $filters)
    {
        return  $this->repository->all($filters);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoCapacitacionRequest $request)
    {
        $tipoCapacitacion = $this->repository->create($request->all());
        return response()->json($tipoCapacitacion, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TipoCapacitacion $tipoCapacitacion)
    {
        return $this->repository->getOne($tipoCapacitacion);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoCapacitacion  $tipoCapacitacion
     * @return \Illuminate\Http\Response
     */
    public function update(TipoCapacitacionRequest $request, TipoCapacitacion $tipoCapacitacion)
    {
        $tipoCapacitacion = $this->repository->updateOne($request->all(), $tipoCapacitacion);
        return response()->json($tipoCapacitacion, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoCapacitacion  $tipoCapacitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoCapacitacion $tipoCapacitacion)
    {
        $this->repository->deleteOne($tipoCapacitacion);
        return response()->json(null, 204);
    }
}