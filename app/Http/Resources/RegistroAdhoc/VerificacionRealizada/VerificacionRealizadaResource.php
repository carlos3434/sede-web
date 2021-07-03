<?php

namespace App\Http\Resources\RegistroAdhoc\VerificacionRealizada;

use Illuminate\Http\Resources\Json\JsonResource;

class VerificacionRealizadaResource extends JsonResource
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

            'nro_informe'     => $this->nro_informe,
            'fecha' => $this->fecha,
            'nro_expediente'           => $this->nro_expediente,

            'institucion'      => $this->institucion->nombre,
            'institucion_id'   => $this->institucion_id,
            'usuario_id'       => $this->usuario_id,

            'created_at'       => $this->created_at->toDateTimeString(),
            'updated_at'       => $this->updated_at->toDateTimeString(),
        ];
    }
}