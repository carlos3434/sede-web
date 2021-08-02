<?php

namespace App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhocArchivo;

//use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpedienteAdhocArchivoResource extends JsonResource
{
    private $result;
    public function __construct($result)
    {
        $this->result = $result;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (!isset($this->result[0])) {
            return [];
        }
        return [
            'id'                          => $this->result[0]->id,
            'nombre_comercial'            => $this->result[0]->nombre_comercial,
            'direccion'                   => $this->result[0]->direccion,
            'area'                        => $this->result[0]->area,

            'monto'                       => $this->result[0]->monto,
            'nombre_banco'                => $this->result[0]->nombre_banco,
            'numero_operacion'            => $this->result[0]->numero_operacion,
            'fecha_operacion'             => $this->result[0]->fecha_operacion,
            'agencia'                     => $this->result[0]->agencia,
            'distrito_id'                 => $this->result[0]->distrito_id,

            'recibo_pago'                 => $this->result[0]->recibo_pago,
            'archivo_solicitud_ht'        => $this->result[0]->archivo_solicitud_ht,
            'fecha_solicitud_ht'          => $this->result[0]->fecha_solicitud_ht,
            'fecha_ingreso_ht'            => $this->result[0]->fecha_ingreso_ht,
            'numero_hoja_tramite'         => $this->result[0]->ht,

            'estado_expediente_id'        => $this->result[0]->estado_expediente_id,
            'estado_expediente_nombre'    => $this->result[0]->estado_expediente_nombre,
            'departamento_nombre'         => $this->result[0]->departamento_nombre,
            'expedienteadhoc_archivo'     => new ExpedienteAdhocArchivoCollection( $this->result ),
        ];
    }
}
