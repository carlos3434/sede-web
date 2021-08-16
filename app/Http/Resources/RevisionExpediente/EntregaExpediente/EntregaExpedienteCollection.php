<?php

namespace App\Http\Resources\RevisionExpediente\EntregaExpediente;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EntregaExpedienteCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform( function ($expedienteAdhoc) {

            return [
                "id"                         => $expedienteAdhoc->id,
                "nombre_comercial"           => $expedienteAdhoc->nombre_comercial,
                "direccion"                  => $expedienteAdhoc->direccion,
                "area"                       => $expedienteAdhoc->area,
                
                'numero_operacion'           => $expedienteAdhoc->numero_operacion,
                'nombre_banco'               => $expedienteAdhoc->nombre_banco,
                'agencia'                    => $expedienteAdhoc->agencia,
                'fecha_operacion'            => $expedienteAdhoc->fecha_operacion,
                'monto'                      => $expedienteAdhoc->monto,

                "estado_expediente_nombre"   => $expedienteAdhoc->estado_expediente,
                "estado_expediente_id"       => $expedienteAdhoc->estado_id,
                "fecha_entrega"              => $expedienteAdhoc->fecha_entrega,

                "adhoc_full_name"            => $expedienteAdhoc->adhoc_full_name,
                "adhoc_id"                   => $expedienteAdhoc->adhoc_id,
                "cenepred_full_name"         => $expedienteAdhoc->cenepred_full_name,
                "cenepred_id"                => $expedienteAdhoc->cenepred_id,
                "administrado_full_name"     => $expedienteAdhoc->administrado_full_name,
                "administrado_id"            => $expedienteAdhoc->administrado_id,

                "fecha_solicitud_ht"         => $expedienteAdhoc->fecha_solicitud_ht,
                "fecha_ingreso_ht"           => $expedienteAdhoc->fecha_ingreso_ht,
                "numero_hoja_tramite"        => $expedienteAdhoc->ht,
                "recibo_pago"                => $expedienteAdhoc->recibo_pago,
                "archivo_solicitud_ht"       => $expedienteAdhoc->archivo_solicitud_ht,

                "distrito_id"                => $expedienteAdhoc->distrito_id,
                "provincia_id"               => $expedienteAdhoc->provincia_id,
                "departamento_id"            => $expedienteAdhoc->departamento_id,
                "departamento_nombre"        => $expedienteAdhoc->departamento_nombre
            ];
        });
    }
}
