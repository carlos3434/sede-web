<?php

namespace App\Http\Resources\SeleccionAdhoc\Calificacion;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Settings\Convocatoria;

class CalificacionWithDetailCollection extends ResourceCollection
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
            return new CalificacionResource($calificacion);
        });
    }
    public function with($request)
    {
        return [
            'additional_data' => [
                'convocatoria_actual' => Convocatoria::GetActual() ,
            ],
        ];
    }
}
