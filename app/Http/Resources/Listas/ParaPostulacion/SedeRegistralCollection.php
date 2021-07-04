<?php

namespace App\Http\Resources\Listas\ParaPostulacion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SedeRegistralCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($sedeRegistral) {
            return [
                'id' => $sedeRegistral->id,
                'nombre' => $sedeRegistral->nombre,
            ]; //return new GradoResource($Grado);
        });
    }
}
