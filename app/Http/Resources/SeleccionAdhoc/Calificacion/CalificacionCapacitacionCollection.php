<?php

namespace App\Http\Resources\SeleccionAdhoc\Calificacion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CalificacionCapacitacionCollection extends ResourceCollection
{
    private $calificacionId;
    public function __construct( $formaciones, $calificacionId)
    {
        parent::__construct($formaciones);
        $this->calificacionId = $calificacionId;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($calificacion) {
            $puntajes = $calificacion->puntaje( $this->calificacionId );
            $puntaje = isset($puntajes)? $puntajes->puntaje: null;

            return [
                'id'                    => $calificacion->id,
                'puntaje'               => $puntaje,

                'nombre'                => $calificacion->nombre,
                'fecha_inicio'          => $calificacion->fecha_inicio,
                'fecha_termino'         => $calificacion->fecha_termino,
                'horas_lectivas'        => $calificacion->horas_lectivas,
                'ciudad'                => $calificacion->ciudad,
                'certificado'           => $calificacion->certificado,
                'archivo_tamano'        => $calificacion->archivo_tamano,
                'usuario_id'            => $calificacion->usuario_id,
                'institucion_id'        => $calificacion->institucion_id,
                'institucion'           => $calificacion->institucion->nombre,
                'tipo_capacitacion_id'  => $calificacion->tipo_capacitacion_id,
                'tipo_capacitacion'     => $calificacion->tipoCapacitacion->nombre,

                'created_at'            => $calificacion->created_at->toDateTimeString(),
                'updated_at'            => $calificacion->updated_at->toDateTimeString(),
            ];
        });
    }
}
