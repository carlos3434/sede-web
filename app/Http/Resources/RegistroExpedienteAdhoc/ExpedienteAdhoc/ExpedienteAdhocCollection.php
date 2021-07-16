<?php

namespace App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpedienteAdhocCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($expedienteAdhoc) {
            return new ExpedienteAdhocResource($expedienteAdhoc);
        });
    }
}
