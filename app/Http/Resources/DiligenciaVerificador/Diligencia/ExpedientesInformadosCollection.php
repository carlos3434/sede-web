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
                'expediente_adhoc_id'         => $diligencia->entrega->expediente_adhoc_id,
                'estado_expediente_nombre'    => $diligencia->entrega->expediente->estadoExpedienteAdhoc->nombre,
                'administrado_full_name'      => $diligencia->entrega->expediente->usuario->full_name,
                'administrado_id'             => $diligencia->entrega->expediente->usuario->id,
                'numero_hoja_tramite'         => $diligencia->entrega->expediente->ht,
                'nombre_comercial'            => $diligencia->entrega->expediente->nombre_comercial,
                'direccion'                   => $diligencia->entrega->expediente->direccion,
                'area'                        => $diligencia->entrega->expediente->area,
                
                'fecha_recepcion'             => $diligencia->entrega->fecha_recepcion,
                'fecha_entrega'               => $diligencia->entrega->fecha_entrega,

                'fecha_diligencia'            => $diligencia->fecha,
                'anexo8'                      => $diligencia->anexo8,
                'anexo9'                      => $diligencia->anexo9,
                'anexo10'                     => $diligencia->anexo10,
            ];
        });

    }
}
