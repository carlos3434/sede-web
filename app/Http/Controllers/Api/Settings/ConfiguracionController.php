<?php
namespace App\Http\Controllers\Api\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting\Configuracion;
use App\Http\Requests\Setting\ConfiguracionRequest;
use App\Repositories\Settings\Interfaces\ConfiguracionRepositoryInterface;

class ConfiguracionController extends Controller
{
    private $repository;

    public function __construct(ConfiguracionRepositoryInterface $repository)
    {
        $this->repository = $repository;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|CONFIGURACION_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|CONFIGURACION_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|CONFIGURACION_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|CONFIGURACION_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|CONFIGURACION_DESTROY'])->only('destroy');
        
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
    public function store(ConfiguracionRequest $request)
    {
        $configuracion = $this->repository->create($request->all());
        return response()->json($configuracion, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Configuracion $configuracion)
    {
        return $this->repository->getOne($configuracion);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function update(ConfiguracionRequest $request, Configuracion $configuracion)
    {
        $configuracion = $this->repository->updateOne($request, $configuracion);
        return response()->json($configuracion, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuracion $configuracion)
    {
        $this->repository->deleteOne($configuracion);
        return response()->json(null, 204);
    }
}