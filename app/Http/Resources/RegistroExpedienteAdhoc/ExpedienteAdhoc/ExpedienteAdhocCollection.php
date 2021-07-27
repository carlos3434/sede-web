<?php

namespace App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc;

use Illuminate\Http\Resources\Json\ResourceCollection;
//use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\RegistroExpedienteAdhoc\Archivo;

use App\Models\Settings\Convocatoria;

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
        $convocatoriaId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id: false;
        if ($convocatoriaId) {
            //traer todos los archivos de la actual convocatoria
            $archivos = Archivo::GetArchivosCategoriaByConvocatoriaId( $convocatoriaId );
        }
        $archivos = Archivo::GetArchivosCategoriaByConvocatoriaId( $convocatoriaId );

        foreach ($archivos as $key => $value) {

            $archivosParent[$value->slug] = [
                'nombre' => $value->nombre,
                'estadisticas' => [
                    //ir a los expedientes completados
                    'completados' => $value->expedienteadhoc_archivo->filter(function($item)
                        {
                            if($item['valor']) return $item;
                        })->count(),

                    'total' => $value->hijos->count(),
                ],
            ];
        }

        return $this->collection->transform(function ($expedienteAdhoc) use ($archivosParent) {

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
                'recibo_pago'                => $expedienteAdhoc->recibo_pago,
                'archivo_solicitud_ht'       => $expedienteAdhoc->archivo_solicitud_ht,

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

                'estadisticas'               => [
                    "completados" => $expedienteAdhoc->expedienteAdhocArchivos->filter(function($item)
                            {
                                if($item['valor']) return $item;
                            })->count(),
                    "total" => $expedienteAdhoc->expedienteAdhocArchivos->count(),
                ],

                'expedienteadhoc_archivo'    => $archivosParent,

                'created_at'                 => $expedienteAdhoc->created_at->toDateTimeString(),
                'updated_at'                 => $expedienteAdhoc->updated_at->toDateTimeString(),
            ];
        });
    }
}
