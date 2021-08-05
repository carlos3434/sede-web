<?php

namespace App\Http\Resources\DiligenciaVerificador\Diligencia;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Settings\Convocatoria;
use App\Models\RegistroExpedienteAdhoc\Archivo;

class DiligenciaCollection extends ResourceCollection
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

                'id'                          => $expedienteAdhoc->id,
                'nombre_comercial'            => $expedienteAdhoc->nombre_comercial,
                'direccion'                   => $expedienteAdhoc->direccion,
                'area'                        => $expedienteAdhoc->area,

                'monto'                       => $expedienteAdhoc->monto,
                'nombre_banco'                => $expedienteAdhoc->nombre_banco,
                'numero_operacion'            => $expedienteAdhoc->numero_operacion,
                'fecha_operacion'             => $expedienteAdhoc->fecha_operacion,
                'agencia'                     => $expedienteAdhoc->agencia,
                'distrito_id'                 => $expedienteAdhoc->distrito_id,

                'recibo_pago'                 => $expedienteAdhoc->recibo_pago,
                'archivo_solicitud_ht'        => $expedienteAdhoc->archivo_solicitud_ht,
                'fecha_solicitud_ht'          => $expedienteAdhoc->fecha_solicitud_ht,
                'fecha_ingreso_ht'            => $expedienteAdhoc->fecha_ingreso_ht,
                'numero_hoja_tramite'         => $expedienteAdhoc->ht,

                'estado_expediente_id'        => $expedienteAdhoc->estado_expediente_id,
                'estado_expediente_nombre'    => $expedienteAdhoc->estado_expediente_nombre,

                'entrega_expediente_id'       => $expedienteAdhoc->entrega_expediente_id,
                'fecha_entrega'               => $expedienteAdhoc->fecha_entrega,
                'administrado_full_name'      => $expedienteAdhoc->administrado_full_name,
                'administrado_id'             => $expedienteAdhoc->administrado_id,

                'departamento_nombre'         => $expedienteAdhoc->departamento_nombre,

                'fecha_recepcion'             => $expedienteAdhoc->fecha_recepcion,
                'diligencia_id'               => $expedienteAdhoc->diligencia_id,
                'fecha_diligencia'            => $expedienteAdhoc->fecha_diligencia,
                'anexo8'                      => $expedienteAdhoc->anexo8,
                'anexo9'                      => $expedienteAdhoc->anexo9,
                'anexo10'                     => $expedienteAdhoc->anexo10,
            ];
        });
    }
}
