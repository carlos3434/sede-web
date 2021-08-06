<?php

namespace App\Http\Resources\DiligenciaVerificador\Diligencia;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpedientesInformadosCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($expedienteAdhoc) {

            return [

                'expediente_adhoc_id'         => $expedienteAdhoc->expediente_adhoc_id,
                'estado_expediente_nombre'    => $expedienteAdhoc->entrega->expediente->estadoExpedienteAdhoc->nombre,
                'administrado_full_name'      => $expedienteAdhoc->entrega->expediente->usuario->full_name,
                'administrado_id'             => $expedienteAdhoc->entrega->expediente->usuario->id,
                'numero_hoja_tramite'         => $expedienteAdhoc->ht,
                'fecha_diligencia'            => $expedienteAdhoc->fecha,
                'nombre_comercial'            => $expedienteAdhoc->nombre_comercial,
                'direccion'                   => $expedienteAdhoc->direccion,
                'area'                        => $expedienteAdhoc->area,
                'fecha_recepcion'             => $expedienteAdhoc->fecha_recepcion,
                'fecha_entrega'               => $expedienteAdhoc->fecha_entrega,
                'anexo8'                      => $expedienteAdhoc->anexo8,
                'anexo9'                      => $expedienteAdhoc->anexo9,
                'anexo10'                     => $expedienteAdhoc->anexo10,
            ];
        });

    }
}
