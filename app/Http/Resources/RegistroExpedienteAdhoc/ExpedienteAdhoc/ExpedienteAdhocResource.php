<?php

namespace App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhocArchivo\ExpedienteAdhocArchivoCollection;
use App\Http\Resources\RegistroExpedienteAdhoc\Archivo\ArchivoParentCollection;

class ExpedienteAdhocResource extends JsonResource
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
            'id' => $this->id,
            'nombre_comercial' => $this->nombre_comercial,
            'direccion' => $this->direccion,
            'area' => $this->area,
            'monto' => $this->monto,
            'nombre_banco' => $this->nombre_banco,
            'numero_operacion' => $this->numero_operacion,
            'fecha_operacion' => $this->fecha_operacion,
            'agencia' => $this->agencia,
            'distrito_id' => $this->distrito_id,
            'recibo_pago' => $this->recibo_pago,
            'archivo_solicitud_ht' => $this->archivo_solicitud_ht,
            //'expedienteadhoc_archivo' => new ExpedienteAdhocArchivoCollection( $this->result ),
        ];
    }
}