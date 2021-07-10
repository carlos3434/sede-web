<?php

namespace App\Http\Resources\SeleccionAdhoc\Puntaje;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PuntajeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($puntaje) {
            return new PuntajeResource($puntaje);
        });
    }
}
