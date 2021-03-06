<?php

namespace App\Http\Resources\RegistroExpedienteAdhoc\Archivo;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArchivoParentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($archivo) {
            return [
                'id'             => $archivo->id,
                'nombre'         => $archivo->nombre,
                'slug'           => $archivo->slug,
                'activo'         => $archivo->activo,
                //'estadisticas'   => ['completados'=> 0, 'total'=> 13],
                'archivos'       => new ArchivoCollection($archivo->hijos)
            ];
        });
    }
}
