<?php

namespace App\Http\Resources\DiligenciaVerificador\Diligencia;

use Illuminate\Http\Resources\Json\JsonResource;
//use App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhocArchivo\ExpedienteAdhocArchivoCollection;

class DiligenciaResource extends JsonResource
{
    private $result;
    public function __construct($result)
    {
        $this->result = $result;
    }
    /**
     * Transform the resource into an array.
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

            'entrega_expediente_id'       => $this->result[0]->entrega_expediente_id,
            'fecha_entrega'               => $this->result[0]->fecha_entrega,
            'administrado_full_name'      => $this->result[0]->administrado_full_name,
            'administrado_id'             => $this->result[0]->administrado_id,

            'departamento_nombre'         => $this->result[0]->departamento_nombre,

            'fecha_recepcion'             => $this->result[0]->fecha_recepcion,
            'diligencia_id'               => $this->result[0]->diligencia_id,
            'fecha_diligencia'            => $this->result[0]->fecha_diligencia,
            'anexo8'                      => $this->result[0]->anexo8,
            'anexo9'                      => $this->result[0]->anexo9,
            'anexo10'                     => $this->result[0]->anexo10,

            'expedienteadhoc_archivo'     => new DiligenciaArchivoCollection( $this->result ),
        ];
    }
}