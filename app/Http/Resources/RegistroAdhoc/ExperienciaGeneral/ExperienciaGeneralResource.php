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
            'id'               => $this->id,

            'cargo'            => $this->cargo,
            'fecha_inicio'     => $this->fecha_inicio,
            'fecha_fin'        => $this->fecha_fin,
            'tiempo_total'     => $this->tiempo_total,
            'archivo_constancia' => $this->archivo_constancia,
            'institucion'      => $this->institucion->nombre,
            'institucion_id'   => $this->institucion_id,
            'usuario_id'       => $this->usuario_id,

            'created_at'       => $this->created_at->toDateTimeString(),
            'updated_at'       => $this->updated_at->toDateTimeString(),
        ];
    }
}