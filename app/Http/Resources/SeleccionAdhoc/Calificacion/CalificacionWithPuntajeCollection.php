<?php

namespace App\Http\Resources\SeleccionAdhoc\Calificacion;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Settings\Convocatoria;
use Carbon\Carbon;

class CalificacionWithPuntajeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($calificacion) {
            return [
                'id'                     => $calificacion->id,
                'fecha'                  => Carbon::parse($calificacion->fecha)->toDateString(),
                'usuario_id'             => $calificacion->usuario_id,
                'convocatoria_id'        => $calificacion->convocatoria_id,
                'puntaje_total'          => $calificacion->puntajeTotal(),
                'convocatoria_nombre'    => $calificacion->convocatoria->nombre,
                'sede_registral_id'      => $calificacion->sede_registral_id,
                'sede_registral_nombre'  => $calificacion->sedeRegistral->nombre,

                'created_at'             => $calificacion->created_at->toDateTimeString(),
                'updated_at'             => $calificacion->updated_at->toDateTimeString(),
            ];
            //return new CalificacionResource($calificacion);
        });
    }
    public function with($request)
    {
        return [
            'additional_data' => [
                'convocatoria_actual' => Convocatoria::GetActual() ,
            ],
        ];
    }
}
