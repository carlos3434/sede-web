<?php
namespace App\Http\Controllers\Api\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\Convocatoria;
use App\Http\Requests\Settings\ConvocatoriaRequest;
use App\Repositories\Settings\Interfaces\ConvocatoriaRepositoryInterface;
use App\Models\SeleccionAdhoc\Item;

class ConvocatoriaController extends Controller
{
    private $repository;

    public function __construct(ConvocatoriaRepositoryInterface $repository)
    {
        $this->repository = $repository;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|CONVOCATORIA_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|CONVOCATORIA_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|CONVOCATORIA_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|CONVOCATORIA_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|CONVOCATORIA_DESTROY'])->only('destroy');
        
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
    public function store(ConvocatoriaRequest $request)
    {
        //validar  fechas no deberian intersectarse fecha_inicio fecha_final
        //Convocatoria::all();
        $count = Convocatoria::where('fecha_inicio','<=',$request->fecha_inicio)
        ->where('fecha_final','>=',$request->fecha_final)
        ->count();

        if ($count>0) {
            return response()->json(['message' => "No es posible crear una convocatoria en este rango de fechas" ], 422);
        }
        $count = Convocatoria::where('activo',true)->count();
        if ($count>0) {
            //valildar solo una convocatoria activa
            return response()->json(['message' => "No es posible crear una convocatoria activa mientras hay otra activa" ], 422);
        }

        $convocatoria = $this->repository->create($request->all());
        return response()->json($convocatoria, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Convocatoria $convocatoria)
    {
        return $this->repository->getOne($convocatoria);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Convocatoria  $convocatoria
     * @return \Illuminate\Http\Response
     */
    public function update(ConvocatoriaRequest $request, Convocatoria $convocatoria)
    {
        $count = Convocatoria::where('fecha_inicio','<=',$request->fecha_inicio)
        ->where('fecha_final','>=',$request->fecha_final)
        ->where('id', '<>', $request->id )
        ->count();

        if ($count>0) {
            return response()->json(['message' => "No es posible modificar una convocatoria en este rango de fechas" ], 422);
        }
        $count = Convocatoria::where('activo', true)->where('id', '<>', $request->id )->count();
        if ($count>0) {
            //valildar solo una convocatoria activa
            return response()->json(['message' => "No es posible modificar una convocatoria activa mientras hay otra activa" ], 422);
        }

        $convocatoria = $this->repository->updateOne($request->all(), $convocatoria);
        return response()->json($convocatoria, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Convocatoria  $convocatoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Convocatoria $convocatoria)
    {
        try {
            $this->repository->deleteOne($convocatoria);
        } catch (\Exception $e) { 
            return response()->json(['message' => "No es posible borrar esta convocatoria" ], 422);
        }
        return response()->json(null, 204);
    }
}