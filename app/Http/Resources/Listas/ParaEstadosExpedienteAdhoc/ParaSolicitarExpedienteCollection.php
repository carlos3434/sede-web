<?php

namespace App\Http\Resources\Listas\ParaEstadosExpedienteAdhoc;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ParaSolicitarExpedienteCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($expediente) {
            return [
                'id' => $expediente->id,
                'nombre_comercial' => $expediente->nombre_comercial,
            ];
        });
    }
}
