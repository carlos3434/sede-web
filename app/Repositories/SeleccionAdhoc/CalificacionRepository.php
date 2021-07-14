<?php
namespace App\Repositories\SeleccionAdhoc;

use App\Repositories\AbstractRepository;
use App\Repositories\SeleccionAdhoc\Interfaces\CalificacionRepositoryInterface;
use App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionExcelCollection;
use App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionWithDetailCollection;
use App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionWithPuntajeCollection;
use App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionWithAcreditacionCollection;
use App\Http\Resources\RegistroAdhoc\Postulacion\PostulacionCollection;
use App\Models\SeleccionAdhoc\Calificacion;
/**
 * 
 */
class CalificacionRepository extends AbstractRepository implements CalificacionRepositoryInterface
{

    protected $modelClassName = 'Calificacion';
    protected $modelClassNamePath = "App\Models\SeleccionAdhoc\Calificacion";
    protected $collectionNamePath = "App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionWithDetailCollection";
    protected $resourceNamePath = "App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionWithDetailResource";

    public function getByUserId( $userId ) {
        return new PostulacionCollection(
            Calificacion::where('usuario_id',$userId)
            ->get()
        );
    }

    public function countByUserIdAndConvocatoria( $userId, $convocatoriaId ) {
        return Calificacion::where('usuario_id',$userId)->where('convocatoria_id',$convocatoriaId)->count();
    }

    public function allWithPuntajes( $request ) {
        return new CalificacionWithPuntajeCollection(
            Calificacion::from('calificaciones as c')
            ->select('c.*', \DB::raw('coalesce(sum(p.puntaje),0)') )
            ->leftJoin('puntajes as p','c.id','=','p.calificacion_id')
            ->where('c.convocatoria_id',$request->convocatoria_id)
            ->having( \DB::raw('coalesce(sum(p.puntaje),0)'), $request->filtro, $request->puntaje )
            ->groupBy('c.id')
            ->paginate(config('sede.items_per_page'))
        )
        ;
    }


    public function getPendientes( $request ) {
        return new CalificacionWithPuntajeCollection(
            Calificacion::from('calificaciones as c')
            ->select('c.*', \DB::raw('coalesce(sum(p.puntaje),0)') )
            ->leftJoin('puntajes as p','c.id','=','p.calificacion_id')
            ->where('c.convocatoria_id',$request->convocatoria_id)
            ->whereNull('p.id')
            //->having( \DB::raw('coalesce(sum(p.puntaje),0)'), $request->filtro, $request->puntaje )
            ->groupBy('c.id')
            ->paginate(config('sede.items_per_page'))
        )
        ;
    }


    public function getResultados( $request ) {
        $query = Calificacion::from('calificaciones as c')
            ->select('c.*', \DB::raw('coalesce(sum(p.puntaje),0)') )
            ->join('puntajes as p','c.id','=','p.calificacion_id')
            ->where('c.convocatoria_id',$request->convocatoria_id)
            ->groupBy('c.id');
            
        if ($request->has('sede_registral_id')) {
            $query->where('c.sede_registral_id',$request->sede_registral_id);
        }
        return new CalificacionWithPuntajeCollection( $query->paginate() );
    }

    public function getAcreditaciones( $request ) {
        $query = Calificacion::from('calificaciones as c')
                ->select('c.*')
                ->join('acreditaciones as a','c.id','=','a.calificacion_id')
                ->where('c.convocatoria_id', $request->convocatoria_id);
            
        if ($request->has('sede_registral_id')) {
            $query->where('c.sede_registral_id',$request->sede_registral_id);
        }
        return new CalificacionWithAcreditacionCollection( $query->paginate() );
    }

    public function allToExport($request)
    {
        return new CalificacionExcelCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

}