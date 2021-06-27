<?php

namespace App\Http\Resources\Settings\TipoCapacitacion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TipoCapacitacionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($TipoCapacitacion) {
            return new TipoCapacitacionResource($TipoCapacitacion);
        });
    }
}
