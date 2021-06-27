<?php

namespace App\Http\Resources\Settings\Institucion;

use Illuminate\Http\Resources\Json\JsonResource;

class InstitucionResource extends JsonResource
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
            'etiqueta' => $this->etiqueta,
            'tipo_institucion_id' => $this->tipo_institucion_id,
            'pais_id' => $this->pais_id,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}