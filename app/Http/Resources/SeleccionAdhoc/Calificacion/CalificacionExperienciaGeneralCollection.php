<?php

namespace App\Http\Resources\SeleccionAdhoc\Calificacion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CalificacionExperienciaGeneralCollection extends ResourceCollection
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
                'cargo'            => $calificacion->cargo,
                'fecha_inicio'     => $calificacion->fecha_inicio,
                'fecha_fin'        => $calificacion->fecha_fin,
                'tiempo_total'     => $calificacion->tiempo_total,
                'archivo_constancia' => $calificacion->archivo_constancia,
                'institucion'      => $calificacion->institucion->nombre,
                'institucion_id'   => $calificacion->institucion_id,
                'usuario_id'       => $calificacion->usuario_id,
                
                'created_at'             => $calificacion->created_at->toDateTimeString(),
                'updated_at'             => $calificacion->updated_at->toDateTimeString(),
            ];
        });
    }
}
