<?php
namespace App\Http\Controllers\Api\SeleccionAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SeleccionAdhoc\Puntaje;
use App\Http\Requests\SeleccionAdhoc\PuntajeRequest;
use App\Repositories\SeleccionAdhoc\Interfaces\PuntajeRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Convocatoria;
use App\Models\SeleccionAdhoc\Item;
use App\Models\SeleccionAdhoc\Categoria;
use App\Models\SeleccionAdhoc\Calificacion;

class PuntajeController extends Controller
{
    private $repository;

    public function __construct(PuntajeRepositoryInterface $repository )
    {
        $this->repository = $repository;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|PUNTAJE_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|PUNTAJE_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|PUNTAJE_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|PUNTAJE_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|PUNTAJE_DESTROY'])->only('destroy');
        //mostrarPuntajeesUsuarioActual


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index(Request $request)
    {
        if ( !empty($request->excel) ){
            return $this->repository->allToExport($request)
            ->downloadExcel(
                'Puntaje_'.date('m-d-Y_hia').'.xlsx',
                $writerType = null,
                $headings = true
            );
        }
        //solo de la convocatoria actual
        $request->request->add(['convocatoria_id' => (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id : false ]);
        return $this->repository->all($request);
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PuntajeRequest $request)
    {
        $calificacion_id = $request->calificacion_id;
        $puntajes = $request->puntajes;
        //validar si una calificacion ya tiene puntaje
        $calificacion = Calificacion::find($request->calificacion_id);
        if ( $calificacion->puntajeToTal() > 0) {
            return response()->json(['message' => "Ya se ha resigstrado puntaje para esta postulacion." ], 422);
        }

        //validar que se envie puntaje de todas las categorias
        $categorias = Categoria::all()->count();
        foreach($puntajes as $puntaje){
            $catArray[] = $puntaje['categoria_id'];
            //validar si algun item no pertenece a esa categoria
            $item = Item::find($puntaje['item_id']);
            $item->categoria_id;
            if ($item->categoria_id <> $puntaje['categoria_id']) {
                return response()->json(['message' => "El item ".$puntaje['item_id']." No pertenece a la categoria ".$puntaje['categoria_id'] ], 422);
            }
        }
        if ($categorias <> count(array_unique($catArray))) {
            return response()->json(['message' => "Se tiene que enviar el puntaje de un total de ".$categorias." categorias" ], 422);
        }


        $puntajeSaved =[];
        foreach($puntajes as $puntaje){
            $puntaje['calificacion_id'] = $calificacion_id;
            $puntaje['puntaje'] = Item::find($puntaje['item_id'])->puntaje;

            //validar si el puntaje ya se registro en el itemId y calificacion
            $cantidad = $this->repository->countByCalificacionAndItem($calificacion_id , $puntaje['item_id']);
            if ($cantidad==0)
            {
                $puntajeSaved[] = $this->repository->create( $puntaje );
            }
        }
        if (count($puntajeSaved)==0) {
            return response()->json(['message' => "Ya se han registrado puntajes para esos items en esa calificacion" ], 422);
        }
            
        return response()->json($puntajeSaved, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show(Puntaje $puntaje)
    {
        return $this->repository->getOne($puntaje);
    }*/
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Puntaje  $puntaje
     * @return \Illuminate\Http\Response
     */
    /*public function update(PuntajeUpdateRequest $request, Puntaje $puntaje)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'Puntaje', 'archivo_titulo');
        $puntaje = $this->repository->updateOne($all, $puntaje);
        return response()->json($puntaje, 200);
    }*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puntaje  $puntaje
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(Puntaje $puntaje)
    {
        $this->repository->deleteOne($puntaje);
        return response()->json(null, 204);
    }*/

}