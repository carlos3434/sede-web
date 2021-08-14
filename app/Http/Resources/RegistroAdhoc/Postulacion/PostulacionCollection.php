<?php

namespace App\Http\Resources\RegistroAdhoc\Postulacion;

use Illuminate\Http\Resources\Json\ResourceCollection;


class PostulacionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($calificacion) {
            return new PostulacionResource($calificacion);
        });
    }
}
