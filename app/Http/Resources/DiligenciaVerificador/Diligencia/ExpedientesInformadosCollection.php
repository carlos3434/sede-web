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
        return $this->collection->transform(function ($diligencia) {

            return [

                'diligencia_id'               => $diligencia->id,
                'expediente_adhoc_id'         => $diligencia->expediente_adhoc_id,
                'estado_expediente_nombre'    => $diligencia->entrega->expediente->estadoExpedienteAdhoc->nombre,
                'administrado_full_name'      => $diligencia->entrega->expediente->usuario->full_name,
                'administrado_id'             => $diligencia->entrega->expediente->usuario->id,
                'numero_hoja_tramite'         => $diligencia->ht,
                'fecha_diligencia'            => $diligencia->fecha,
                'nombre_comercial'            => $diligencia->nombre_comercial,
                'direccion'                   => $diligencia->direccion,
                'area'                        => $diligencia->area,
                'fecha_recepcion'             => $diligencia->fecha_recepcion,
                'fecha_entrega'               => $diligencia->fecha_entrega,
                'anexo8'                      => $diligencia->anexo8,
                'anexo9'                      => $diligencia->anexo9,
                'anexo10'                     => $diligencia->anexo10,
            ];
        });

    }
}
