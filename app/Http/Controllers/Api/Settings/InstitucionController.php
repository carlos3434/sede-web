<?php
namespace App\Http\Controllers\Api\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\Institucion;
use App\Http\Requests\Settings\InstitucionRequest;
use App\Repositories\Settings\Interfaces\InstitucionRepositoryInterface;

class InstitucionController extends Controller
{
    private $repository;

    public function __construct(InstitucionRepositoryInterface $repository)
    {
        $this->repository = $repository;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|INSTITUCION_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|INSTITUCION_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|INSTITUCION_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|INSTITUCION_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|INSTITUCION_DESTROY'])->only('destroy');
        
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
    public function store(InstitucionRequest $request)
    {
        $institucion = $this->repository->create($request->all());
        return response()->json($institucion, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Institucion $institucion)
    {
        return $this->repository->getOne($institucion);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function update(InstitucionRequest $request, Institucion $institucion)
    {
        $institucion = $this->repository->updateOne($request->all(), $institucion);
        return response()->json($institucion, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institucion $institucion)
    {
        try {
            $this->repository->deleteOne($institucion);
        } catch (\Exception $e) { 
            return response()->json(['message' => "No es posible borrar esta institucion" ], 422);
        }
        return response()->json(null, 204);
    }
}