<?php

namespace App\Http\Resources\DiligenciaVerificador\Diligencia;

use Illuminate\Http\Resources\Json\JsonResource;

class DiligenciaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                         => $this->id,

            'nombre_comercial'           => $this->nombre_comercial,
            'direccion'                  => $this->direccion,
            'area'                       => $this->area,

            'numero_operacion'           => $this->numero_operacion,
            'nombre_banco'               => $this->nombre_banco,
            'agencia'                    => $this->agencia,
            'fecha_operacion'            => $this->fecha_operacion,
            'monto'                      => $this->monto,

            'recibo_pago'                => $this->recibo_pago,
            'archivo_solicitud_ht'       => $this->archivo_solicitud_ht,
            'fecha_solicitud_ht'         => $this->fecha_solicitud_ht,
            'fecha_ingreso_ht'           => $this->fecha_ingreso_ht,
            'numero_hoja_tramite'        => $this->ht,

            'estado_expediente_nombre'   => $this->estado_expediente,
            'estado_expediente_id'       => $this->estado_id,
            'fecha_entrega'              => $this->fecha_entrega,
            'administrado_full_name'     => $this->administrado_full_name,
            'administrado_id'            => $this->administrado_id,

            'adhoc_full_name'            => $this->adhoc_full_name,
            'adhoc_id'                   => $this->adhoc_id,

            'distrito_id'                => $this->distrito_id,
            'ubigeo'                     => $this->ubigeo,
            'provincia_id'               => $this->provincia_id,
            'departamento_id'            => $this->departamento_id,
            'departamento_nombre'        => $this->departamento_nombre,
            'cenepred_full_name'         => $this->cenepred_full_name,
            'cenepred_id'                => $this->cenepred_id,
            'fecha_diligencia'           => $this->fecha_diligencia,
            'anexo8'                     => $this->anexo8,
            'anexo9'                     => $this->anexo9,
            'anexo10'                    => $this->anexo10,

        ];
    }
}