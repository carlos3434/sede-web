<?php

namespace App\Http\Resources\RegistroAdhoc\Capacitacion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CapacitacionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($Capacitacion) {
            return new CapacitacionResource($Capacitacion);
        });
    }
}
