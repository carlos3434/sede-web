<?php

namespace App\Http\Resources\RegistroAdhoc\Formacion;

use Illuminate\Http\Resources\Json\JsonResource;

class FormacionResource extends JsonResource
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
            'grado_id'         => $this->grado->nombre,
            'institucion_id'   => $this->institucion->nombre,
            'usuario_id'       => $this->usuario_id,

            'created_at'       => $this->created_at->toDateTimeString(),
            'updated_at'       => $this->updated_at->toDateTimeString(),
        ];
    }
}