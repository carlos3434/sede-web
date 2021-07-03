<?php

namespace App\Http\Resources\RegistroAdhoc\ExperienciaGeneral;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExperienciaGeneralCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($ExperienciaGeneral) {
            return new ExperienciaGeneralResource($ExperienciaGeneral);
        });
    }
}
