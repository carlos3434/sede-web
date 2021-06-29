<?php
namespace App\Http\Controllers\Api\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\TipoInstitucion;
use App\Http\Requests\Settings\TipoInstitucionRequest;
use App\Repositories\Settings\Interfaces\TipoInstitucionRepositoryInterface;

class TipoInstitucionController extends Controller
{
    private $repository;

    public function __construct(TipoInstitucionRepositoryInterface $repository)
    {
        $this->repository = $repository;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|TIPO_INSTITUCION_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|TIPO_INSTITUCION_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|TIPO_INSTITUCION_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|TIPO_INSTITUCION_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|TIPO_INSTITUCION_DESTROY'])->only('destroy');
        
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
    public function store(TipoInstitucionRequest $request)
    {
        $tipoInstitucion = $this->repository->create($request->all());
        return response()->json($tipoInstitucion, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TipoInstitucion $tipoInstitucion)
    {
        return $this->repository->getOne($tipoInstitucion);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoInstitucion  $tipoInstitucion
     * @return \Illuminate\Http\Response
     */
    public function update(TipoInstitucionRequest $request, TipoInstitucion $tipoInstitucion)
    {
        $tipoInstitucion = $this->repository->updateOne($request->all(), $tipoInstitucion);
        return response()->json($tipoInstitucion, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoInstitucion  $tipoInstitucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoInstitucion $tipoInstitucion)
    {
        $this->repository->deleteOne($tipoInstitucion);
        return response()->json(null, 204);
    }
}