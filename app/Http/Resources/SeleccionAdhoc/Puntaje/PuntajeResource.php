<?php

namespace App\Http\Resources\SeleccionAdhoc\Puntaje;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PuntajeResource extends JsonResource
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
            'puntaje'              => $this->puntaje,
            'item_id'              => $this->item_id,
            'item'                 => $this->item->nombre,
            'categoria_id'         => $this->categoria_id,
            'categoria'            => $this->categoria->nombre,
            'calificacion'         => $this->calificacion->nombre,
            'calificacion_id'      => $this->calificacion_id,

            'created_at'           => $this->created_at->toDateTimeString(),
            'updated_at'           => $this->updated_at->toDateTimeString(),
        ];
    }
}