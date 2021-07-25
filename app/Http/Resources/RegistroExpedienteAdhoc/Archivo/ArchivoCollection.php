<?php

namespace App\Http\Resources\RegistroExpedienteAdhoc\Archivo;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArchivoCollection extends ResourceCollection
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
                //'estadisticas'   => ['completados'=> 0, 'total'=> 13],
                //'archivos'       => $archivo->hijos,
                ///'s' => $archivo->GetChild(),

               // 'created_at'                 => $archivo->created_at->toDateTimeString(),
               // 'updated_at'                 => $archivo->updated_at->toDateTimeString(),
            ];
        });
    }
}
