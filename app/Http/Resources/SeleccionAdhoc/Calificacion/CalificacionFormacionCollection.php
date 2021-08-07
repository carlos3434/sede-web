<?php

namespace App\Http\Resources\SeleccionAdhoc\Calificacion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CalificacionFormacionCollection extends ResourceCollection
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
            //buscar puntaje de categoria 1 (formaciones) y calificacion_id
            $puntajes = $calificacion->puntaje( $this->calificacionId );
            $puntaje = isset($puntajes)? $puntajes->puntaje: null;

            return [
                'id'               => $calificacion->id,
                'puntaje'          => $puntaje,

                'especialidad'     => $calificacion->especialidad,
                'fecha_expedicion' => $calificacion->fecha_expedicion,
                'ciudad'           => $calificacion->ciudad,
                'archivo_titulo'   => $calificacion->archivo_titulo,
                //'archivo_tamano'   => $calificacion->archivo_tamano,
                'grado'            => $calificacion->grado->nombre,
                'grado_id'         => $calificacion->grado_id,
                'institucion'      => $calificacion->institucion->nombre,
                'institucion_id'   => $calificacion->institucion_id,
                'usuario_id'       => $calificacion->usuario_id,

                'created_at'             => $calificacion->created_at->toDateTimeString(),
                'updated_at'             => $calificacion->updated_at->toDateTimeString(),
            ];
        });
    }
}
