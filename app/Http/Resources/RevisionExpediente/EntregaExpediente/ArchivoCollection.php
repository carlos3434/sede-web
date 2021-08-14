<?php

namespace App\Http\Resources\RevisionExpediente\EntregaExpediente;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Settings\EstadoRevision;
class ArchivoCollection extends ResourceCollection
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
                    "valor_archivo"               => $archivo->valor_archivo,
                    "id_archivo"                  => $archivo->archivo_id,
                    "nombre_archivo"              => $archivo->nombre_archivo,
                    "expedienteadhoc_archivo_id"  => $archivo->expedienteadhoc_archivo_id,
                    "revision_id"                 => $archivo->revision_id,
                    "estado_revision_id"          => $archivo->estado_revision_id,
                    "estado_revision_nombre"      => $archivo->estado_revision_nombre,
                    "slug_archivo"                => $archivo->slug_archivo,
                    "nombre_padre"                => $archivo->nombre_padre,
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
                    'observados' => $grouped->get( $key )->filter(function($item)
                        {
                            if($item['estado_revision_id']==EstadoRevision::OBSERVADO) return $item;
                        })->count(),
                    'admitidos' => $grouped->get( $key )->filter(function($item)
                        {
                            if($item['estado_revision_id']==EstadoRevision::ADMITIDO) return $item;
                        })->count(),
                    'subsanados' => $grouped->get( $key )->filter(function($item)
                        {
                            if($item['estado_revision_id']==EstadoRevision::SUBSANADO) return $item;
                        })->count(),
                ],
                'archivos' => $grouped->get( $key )->all(),
            ];

        }
        return  $response ;
    }
}
