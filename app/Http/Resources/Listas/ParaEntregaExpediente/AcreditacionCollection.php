<?php

namespace App\Http\Resources\Listas\ParaEntregaExpediente;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AcreditacionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($acreditacion) {
            return [
                'acreditacion_id' => $acreditacion->id,
                //'usuario_id' => $acreditacion->calificacion->user->id,
                'usuario_nombres' => $acreditacion->calificacion->user->full_name
            ];
        });
    }
}
