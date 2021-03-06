<?php

namespace App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhocArchivo;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpedienteAdhocArchivoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $grouped = $this->collection->mapToGroups(function ($archivo, $key) {
            return [
                $archivo->slug_padre  => 
                [
                    "valor_archivo"   => $archivo->valor_archivo,
                    "id_archivo"      => $archivo->archivo_id,
                    "nombre_archivo"  => $archivo->nombre_archivo,
                    "slug_archivo"    => $archivo->slug_archivo,
                    "nombre_padre"    => $archivo->nombre_padre,
                    "revision_id"                => $archivo->revision_id,
                    "observacion"                => $archivo->observacion,
                    "fecha_revision"             => $archivo->fecha_revision,
                    "fecha_subsanacion"          => $archivo->fecha_subsanacion,
                    "estado_revision_id"         => $archivo->estado_revision_id,
                    "estado_revision_nombre"     => $archivo->estado_revision_nombre,
                ]
            ];
        });

        foreach ($grouped as $key => $value) {
            $nombre ='';
            if (isset($value[0]['nombre_padre'])) {
                $nombre = $value[0]['nombre_padre'];
            }
            $response[$key] = [
                'nombre' => $nombre,
                'estadisticas' => [
                    'completados' => $grouped->get( $key )->filter(function($item)
                        {
                            if($item['valor_archivo']) return $item;
                        })->count(),
                    'total' => $grouped->get( $key )->count(),
                ],
                'archivos' => $grouped->get( $key )->all(),
            ];

        }
        return  $response ;
    }
}
