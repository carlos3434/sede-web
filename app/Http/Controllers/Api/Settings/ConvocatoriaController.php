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
        $convocatoria = $this->repository->create($request->all());
        //crear items para esta convocatoria
        Item::create([
            'nombre' => 'Titulado (03 Puntos)',
            'puntaje' => '3',
            'categoria_id' => 1,
            'convocatoria_id' => $convocatoria->id,
        ]);
        Item::create([
            'nombre' => 'Postgrado (04 puntos)',
            'puntaje' => '4',
            'categoria_id' => 1,
            'convocatoria_id' => $convocatoria->id,
        ]);
        Item::create([
            'nombre' => 'Magister o Doctorado (05 puntos)',
            'puntaje' => '5',
            'categoria_id' => 1,
            'convocatoria_id' => $convocatoria->id,
        ]);

        //Capacitacion
        Item::create([
            'nombre' => '20 horas lectivas (1 punto)',
            'puntaje' => '1',
            'categoria_id' => 2,
            'convocatoria_id' => $convocatoria->id,
        ]);
        Item::create([
            'nombre' => '60 horas lectivas (2 puntos)',
            'puntaje' => '2',
            'categoria_id' => 2,
            'convocatoria_id' => $convocatoria->id,
        ]);

        //ExperienciaGeneral
        Item::create([
            'nombre' => '06 a 07 años (03 Puntos)',
            'puntaje' => '3',
            'categoria_id' => 3,
            'convocatoria_id' => $convocatoria->id,
        ]);
        Item::create([
            'nombre' => '07 a 09 años (04 puntos)',
            'puntaje' => '4',
            'categoria_id' => 3,
            'convocatoria_id' => $convocatoria->id,
        ]);
        Item::create([
            'nombre' => '10 años a más (05 puntos)',
            'puntaje' => '5',
            'categoria_id' => 3,
            'convocatoria_id' => $convocatoria->id,
        ]);

        //ExperienciaInspector
        Item::create([
            'nombre' => '05 a 10 años (01 Punto)',
            'puntaje' => '1',
            'categoria_id' => 4,
            'convocatoria_id' => $convocatoria->id,
        ]);
        Item::create([
            'nombre' => 'más de 10 años (02 puntos)',
            'puntaje' => '2',
            'categoria_id' => 4,
            'convocatoria_id' => $convocatoria->id,
        ]);

        //VerificacionesRealizadas
        Item::create([
            'nombre' => '1 a 10 verificaciones (02 Punto)',
            'puntaje' => '2',
            'categoria_id' => 5,
            'convocatoria_id' => $convocatoria->id,
        ]);
        Item::create([
            'nombre' => '11 a 15 verificaciones (04 puntos)',
            'puntaje' => '4',
            'categoria_id' => 5,
            'convocatoria_id' => $convocatoria->id,
        ]);
        Item::create([
            'nombre' => 'más de 15 verificaciones (06 puntos)',
            'puntaje' => '6',
            'categoria_id' => 5,
            'convocatoria_id' => $convocatoria->id,
        ]);
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
        $this->repository->deleteOne($convocatoria);
        return response()->json(null, 204);
    }
}