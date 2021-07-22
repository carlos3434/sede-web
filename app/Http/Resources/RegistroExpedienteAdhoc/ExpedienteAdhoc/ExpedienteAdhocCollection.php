<?php

namespace App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpedienteAdhocCollection extends ResourceCollection
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
                'id'                         => $expedienteAdhoc->id,

                'nombre_comercial'           => $expedienteAdhoc->nombre_comercial,
                'direccion'                  => $expedienteAdhoc->direccion,
                'area'                       => $expedienteAdhoc->area,

                //'observaciones'              => $expedienteAdhoc->observaciones,
                //'x'                          => $expedienteAdhoc->x,
                //'y'                          => $expedienteAdhoc->y,
                'fecha_solicitud_ht'         => $expedienteAdhoc->fecha_solicitud_ht,
                'fecha_ingreso_ht'           => $expedienteAdhoc->fecha_ingreso_ht,
                'numero_hoja_tramite'        => $expedienteAdhoc->ht,

                'numero_operacion'           => $expedienteAdhoc->numero_operacion,
                'nombre_banco'               => $expedienteAdhoc->nombre_banco,
                'agencia'                    => $expedienteAdhoc->agencia,
                'fecha_operacion'            => $expedienteAdhoc->fecha_operacion ,
                'monto'                      => $expedienteAdhoc->monto,
                'distrito_id'                => $expedienteAdhoc->distrito_id,

                'usuario_id'                 => $expedienteAdhoc->usuario_id,
                'usuario_full_name'          => $expedienteAdhoc->usuario->full_name,
                'estado_expediente_id'       => $expedienteAdhoc->estado_expediente_id,
                'estado_expediente_nombre'   => $expedienteAdhoc->estadoExpedienteAdhoc->nombre,
                'usuario_revisor_id'         => $expedienteAdhoc->usuario_revisor_id,
                'usuario_revisor_full_name'  => (isset($expedienteAdhoc->usuarioRevisor))?
                                                $expedienteAdhoc->usuarioRevisor->full_name:null,

                'Archivos'                   => $expedienteAdhoc->archivos,

                'Documentos_principales'     => $expedienteAdhoc->documentos_principales,
                'Planos_de_arquitectura'     => $expedienteAdhoc->planos_arquitectura,
                'Planos_de_fábrica inscrita' => $expedienteAdhoc->planos_fabrica_excrita,
                'Planos_de_remodelación'     => $expedienteAdhoc->planos_remodelacion,
                'Planos_de_ampliación'       => $expedienteAdhoc->planos_ampliacion,
                'Planos_de_rutas_de_evacuación' => $expedienteAdhoc->planos_rutas_evacuacion,
                'Planos_de_señalización'     => $expedienteAdhoc->planos_senalizacion,

                'created_at'                 => $expedienteAdhoc->created_at->toDateTimeString(),
                'updated_at'                 => $expedienteAdhoc->updated_at->toDateTimeString(),
            ];
        });
    }
}
