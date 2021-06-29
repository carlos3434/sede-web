<?php
namespace App\Http\Controllers\Api\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\TipoDocumento;
use App\Http\Requests\Settings\TipoDocumentoRequest;
use App\Repositories\Settings\Interfaces\TipoDocumentoRepositoryInterface;

class TipoDocumentoController extends Controller
{
    private $repository;

    public function __construct(TipoDocumentoRepositoryInterface $repository)
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
    public function store(TipoDocumentoRequest $request)
    {
        $tipoDocumento = $this->repository->create($request->all());
        return response()->json($tipoDocumento, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TipoDocumento $tipoDocumento)
    {
        return $this->repository->getOne($tipoDocumento);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function update(TipoDocumentoRequest $request, TipoDocumento $tipoDocumento)
    {
        $tipoDocumento = $this->repository->updateOne($request->all(), $tipoDocumento);
        return response()->json($tipoDocumento, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoDocumento $tipoDocumento)
    {
        $this->repository->deleteOne($tipoDocumento);
        return response()->json(null, 204);
    }
}