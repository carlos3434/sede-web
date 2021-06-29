<?php
namespace App\Http\Controllers\Api\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\Grado;
use App\Http\Requests\Settings\GradoRequest;
use App\Repositories\Settings\Interfaces\GradoRepositoryInterface;

class GradoController extends Controller
{
    private $repository;

    public function __construct(GradoRepositoryInterface $repository)
    {
        $this->repository = $repository;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|GRADO_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|GRADO_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|GRADO_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|GRADO_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|GRADO_DESTROY'])->only('destroy');
        
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
    public function store(GradoRequest $request)
    {
        $grado = $this->repository->create($request->all());
        return response()->json($grado, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Grado $grado)
    {
        return $this->repository->getOne($grado);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function update(GradoRequest $request, Grado $grado)
    {
        $grado = $this->repository->updateOne($request->all(), $grado);
        return response()->json($grado, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grado $grado)
    {
        $this->repository->deleteOne($grado);
        return response()->json(null, 204);
    }
}