<?php

namespace App\Http\Resources\RegistroAdhoc\VerificacionRealizada;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VerificacionRealizadaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($VerificacionRealizada) {
            return new VerificacionRealizadaResource($VerificacionRealizada);
        });
    }
}
