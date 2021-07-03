<?php

namespace App\Http\Resources\RegistroAdhoc\ExperienciaInspector;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExperienciaInspectorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($ExperienciaInspector) {
            return new ExperienciaInspectorResource($ExperienciaInspector);
        });
    }
}
