<?php

namespace App\Http\Resources\RegistroAdhoc\ExperienciaGeneral;

use Illuminate\Http\Resources\Json\JsonResource;

class ExperienciaGeneralResource extends JsonResource
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

            'especialidad'     => $this->especialidad,
            'fecha_expedicion' => $this->fecha_expedicion,
            'ciudad'           => $this->ciudad,
            'archivo_titulo'   => $this->archivo_titulo,
            //'archivo_tamano'   => $this->archivo_tamano,
            'grado'            => $this->grado->nombre,
            'grado_id'         => $this->grado_id,
            'institucion'      => $this->institucion->nombre,
            'institucion_id'   => $this->institucion_id,
            'usuario_id'       => $this->usuario_id,

            'created_at'       => $this->created_at->toDateTimeString(),
            'updated_at'       => $this->updated_at->toDateTimeString(),
        ];
    }
}