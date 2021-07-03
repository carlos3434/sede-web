<?php

namespace App\Http\Resources\RegistroAdhoc\Capacitacion;

use Illuminate\Http\Resources\Json\JsonResource;

class CapacitacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,

            'nombre' => $this->nombre,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_termino' => $this->fecha_termino,
            'horas_lectivas' => $this->horas_lectivas,
            'ciudad' => $this->ciudad,
            'certificado' => $this->certificado,
            'archivo_tamano' => $this->archivo_tamano,
            'usuario_id' => $this->usuario_id,
            'institucion_id' => $this->institucion_id,
            'institucion' => $this->institucion->nombre,
            'tipo_capacitacion_id' => $this->tipo_capacitacion_id,
            'tipo_capacitacion' => $this->tipoCapacitacion->nombre,

            'created_at'       => $this->created_at->toDateTimeString(),
            'updated_at'       => $this->updated_at->toDateTimeString(),
        ];
    }
}