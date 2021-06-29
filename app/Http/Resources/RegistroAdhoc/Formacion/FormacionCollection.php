<?php

namespace App\Http\Resources\RegistroAdhoc\Formacion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FormacionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($Formacion) {
            return new FormacionResource($Formacion);
        });
    }
}
