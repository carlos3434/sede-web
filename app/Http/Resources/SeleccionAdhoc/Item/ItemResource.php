<?php

namespace App\Http\Resources\SeleccionAdhoc\Item;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ItemResource extends JsonResource
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
            'id'                   => $this->id,
            'nombre'               => $this->nombre,
            'puntaje'              => $this->puntaje,
            'activo'               => $this->activo,
            'categoria_id'         => $this->categoria_id,

            'created_at'           => $this->created_at->toDateTimeString(),
            'updated_at'           => $this->updated_at->toDateTimeString(),
        ];
    }
}