<?php

namespace App\Http\Resources\SeleccionAdhoc\Calificacion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CalificacionVerificacionRealizadaCollection extends ResourceCollection
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
                'id'               => $calificacion->id,
                'puntaje'          => $puntaje,

                'nro_informe'     => $calificacion->nro_informe,
                'fecha' => $calificacion->fecha,
                'nro_expediente'           => $calificacion->nro_expediente,

                'institucion'      => $calificacion->institucion->nombre,
                'institucion_id'   => $calificacion->institucion_id,
                'usuario_id'       => $calificacion->usuario_id,

                'created_at'             => $calificacion->created_at->toDateTimeString(),
                'updated_at'             => $calificacion->updated_at->toDateTimeString(),
            ];
        });
    }
}
