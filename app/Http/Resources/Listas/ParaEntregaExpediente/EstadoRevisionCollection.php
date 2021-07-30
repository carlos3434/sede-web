<?php

namespace App\Http\Resources\Listas\ParaEntregaExpediente;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EstadoRevisionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($tipoCapacitacion) {
            return [
                'id' => $tipoCapacitacion->id,
                'nombre' => $tipoCapacitacion->nombre
            ];
        });
    }
}
