<?php

namespace App\Http\Resources\Settings\Configuracion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ConfiguracionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($configuracion) {
            return new ConfiguracionResource($configuracion);
        });
    }
}
