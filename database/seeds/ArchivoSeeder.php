<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\Convocatoria;
use App\Models\RegistroExpedienteAdhoc\Archivo;

class ArchivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $convId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id : false;
        if ( !$convId ) {
            $conv = Convocatoria::create([
                'nombre'      => 'CONVOCATORIA_2021_ACTUAL',
                'fecha_inicio'     => '2021-01-01',
                'fecha_final'     => '2021-12-30',
            ]);
            $convId = $conv->id;
        }

        $docPrinc  = Archivo::create([
            'nombre' => 'Documentos principales',
            'slug' => 'documentos_principales',
            'level' => '1',
            'parent_id' => null,
            'convocatoria_id' => $convId
        ]);

        $arquit = Archivo::create([
            'nombre' => 'Planos de arquitectura',
            'slug' => 'planos_arquitectura',
            'level' => '1',
            'parent_id' => null,
            'convocatoria_id' => $convId
        ]);
        
        $fabrica = Archivo::create([
            'nombre' => 'Planos de fábrica inscrita',
            'slug' => 'plans_fabrica_inscrita',
            'level' => '1',
            'parent_id' => null,
            'convocatoria_id' => $convId
        ]);
        
        $remodela = Archivo::create([
            'nombre' => 'Planos de remodelación',
            'slug' => 'planos_remodelacion',
            'level' => '1',
            'parent_id' => null,
            'convocatoria_id' => $convId
        ]);
        $ampli = Archivo::create([
            'nombre' => 'Planos de ampliación',
            'slug' => 'planos_ampliacion',
            'level' => '1',
            'parent_id' => null,
            'convocatoria_id' => $convId
        ]);
        $evac = Archivo::create([
            'nombre' => 'Planos de rutas de evacuación',
            'slug' => 'planos_rutas_evacuacion',
            'level' => '1',
            'parent_id' => null,
            'convocatoria_id' => $convId
        ]);
        $senal = Archivo::create([
            'nombre' => 'Planos de señalización',
            'slug' => 'planos_senalizacion',
            'level' => '1',
            'parent_id' => null,
            'convocatoria_id' => $convId
        ]);

        $child = [
            'carta_poder_simple'            => 'Carta poder simple en caso de no ser propietario.',
            'copia_vigencia_poder'          => 'Copia de vigencia de poder en caso de personas juridicas.',
            'copia_partida_registral'       => 'Copia simple de la partida registral del inmueble.',
            'copia_dni_propietario'         => 'Copia de dni del propietario.',
            'copia_formulario_for'          => 'Copia simple del formulario registral FOR ley 27157.',
            'informe_tecnico_verificador_responsable' => 'Informe tecnico verificador responsable.',
            'esquela_observacion_sunarp'    => 'Esquela de observacion emitida por la SUNARP.',
            'plano_ubicacion_01'            => 'Plano de ubicacion 01.',
            'plano_ubicacion_02'            => 'Plano de ubicacion 02.',
            'memoria_descriptiva_seguridad' => 'Memoria descriptiva de los sistemas de seguridad.',
            'certificado_pozo_tierra'       => 'Certificado de pozo a tierra.',
            'certificado_laminados'         => 'Certificado de laminados.',
            'certificado_sistema_electrico' => 'Certificado de sistema electrico.',
        ];

        foreach ($child as $key => $value) {
            Archivo::create([
                'nombre' => $value,
                'slug' => $key,
                'level' => '2',
                'parent_id' => $docPrinc->id,
                'convocatoria_id' => $convId
            ]);
        }

        $child = [
            'plano_arquitectura_1' => 'Plano de arquitectura 1.',
            'plano_arquitectura_2' => 'Plano de arquitectura 2.',
            'plano_arquitectura_3' => 'Plano de arquitectura 3.',
            'plano_arquitectura_4' => 'Plano de arquitectura 4.',
            'plano_arquitectura_5' => 'Plano de arquitectura 5.',
            'plano_arquitectura_6' => 'Plano de arquitectura 6.',
            'plano_arquitectura_7' => 'Plano de arquitectura 7.',
            'plano_arquitectura_8' => 'Plano de arquitectura 8.',
            'plano_arquitectura_9' => 'Plano de arquitectura 9.',
            'plano_arquitectura_10' => 'Plano de arquitectura 10.',
        ];

        foreach ($child as $key => $value) {
            Archivo::create([
                'nombre' => $value,
                'slug' => $key,
                'level' => '2',
                'parent_id' => $arquit->id,
                'convocatoria_id' => $convId
            ]);
        }

        $child = [
            'plano_fabrica_1' => 'Plano de fabrica inscrita 1.',
            'plano_fabrica_2' => 'Plano de fabrica inscrita 2.',
            'plano_fabrica_3' => 'Plano de fabrica inscrita 3.',
            'plano_fabrica_4' => 'Plano de fabrica inscrita 4.',
            'plano_fabrica_5' => 'Plano de fabrica inscrita 5.',
            'plano_fabrica_6' => 'Plano de fabrica inscrita 6.',
            'plano_fabrica_7' => 'Plano de fabrica inscrita 7.',
            'plano_fabrica_8' => 'Plano de fabrica inscrita 8.',
            'plano_fabrica_9' => 'Plano de fabrica inscrita 9.',
            'plano_fabrica_10' => 'Plano de fabrica inscrita 10.',
        ];
        foreach ($child as $key => $value) {
            Archivo::create([
                'nombre' => $value,
                'slug' => $key,
                'level' => '2',
                'parent_id' => $fabrica->id,
                'convocatoria_id' => $convId
            ]);
        }

        $child = [
            'plano_remodelacion_1' => 'Plano de remodelacion 1.',
            'plano_remodelacion_2' => 'Plano de remodelacion 2.',
            'plano_remodelacion_3' => 'Plano de remodelacion 3.',
            'plano_remodelacion_4' => 'Plano de remodelacion 4.',
            'plano_remodelacion_5' => 'Plano de remodelacion 5.',
            'plano_remodelacion_6' => 'Plano de remodelacion 6.',
            'plano_remodelacion_7' => 'Plano de remodelacion 7.',
            'plano_remodelacion_8' => 'Plano de remodelacion 8.',
            'plano_remodelacion_9' => 'Plano de remodelacion 9.',
            'plano_remodelacion_10' => 'Plano de remodelacion 10.',
        ];
        foreach ($child as $key => $value) {
            Archivo::create([
                'nombre' => $value,
                'slug' => $key,
                'level' => '2',
                'parent_id' => $remodela->id,
                'convocatoria_id' => $convId
            ]);
        }

        $child = [
            'plano_ampliacion_1' => 'Plano de ampliacion 1.',
            'plano_ampliacion_2' => 'Plano de ampliacion 2.',
            'plano_ampliacion_3' => 'Plano de ampliacion 3.',
            'plano_ampliacion_4' => 'Plano de ampliacion 4.',
            'plano_ampliacion_5' => 'Plano de ampliacion 5.',
            'plano_ampliacion_6' => 'Plano de ampliacion 6.',
            'plano_ampliacion_7' => 'Plano de ampliacion 7.',
            'plano_ampliacion_8' => 'Plano de ampliacion 8.',
            'plano_ampliacion_9' => 'Plano de ampliacion 9.',
            'plano_ampliacion_10' => 'Plano de ampliacion 10.',
        ];
        foreach ($child as $key => $value) {
            Archivo::create([
                'nombre' => $value,
                'slug' => $key,
                'level' => '2',
                'parent_id' => $ampli->id,
                'convocatoria_id' => $convId
            ]);
        }

        $child = [
            'plano_rutas_evacuacion_1' => 'Plano de rutas de evacuacion 1.',
            'plano_rutas_evacuacion_2' => 'Plano de rutas de evacuacion 2.',
            'plano_rutas_evacuacion_3' => 'Plano de rutas de evacuacion 3.',
            'plano_rutas_evacuacion_4' => 'Plano de rutas de evacuacion 4.',
            'plano_rutas_evacuacion_5' => 'Plano de rutas de evacuacion 5.',
            'plano_rutas_evacuacion_6' => 'Plano de rutas de evacuacion 6.',
            'plano_rutas_evacuacion_7' => 'Plano de rutas de evacuacion 7.',
            'plano_rutas_evacuacion_8' => 'Plano de rutas de evacuacion 8.',
            'plano_rutas_evacuacion_9' => 'Plano de rutas de evacuacion 9.',
            'plano_rutas_evacuacion_10' => 'Plano de rutas de evacuacion 10.',
        ];
        foreach ($child as $key => $value) {
            Archivo::create([
                'nombre' => $value,
                'slug' => $key,
                'level' => '2',
                'parent_id' => $evac->id,
                'convocatoria_id' => $convId
            ]);
        }

        $child = [
            'plano_senalizacion_1' => 'Plano de señalizacion 1.',
            'plano_senalizacion_2' => 'Plano de señalizacion 2.',
            'plano_senalizacion_3' => 'Plano de señalizacion 3.',
            'plano_senalizacion_4' => 'Plano de señalizacion 4.',
            'plano_senalizacion_5' => 'Plano de señalizacion 5.',
            'plano_senalizacion_6' => 'Plano de señalizacion 6.',
            'plano_senalizacion_7' => 'Plano de señalizacion 7.',
            'plano_senalizacion_8' => 'Plano de señalizacion 8.',
            'plano_senalizacion_9' => 'Plano de señalizacion 9.',
            'plano_senalizacion_10' => 'Plano de señalizacion 10.',
        ];
        foreach ($child as $key => $value) {
            Archivo::create([
                'nombre' => $value,
                'slug' => $key,
                'level' => '2',
                'parent_id' => $senal->id,
                'convocatoria_id' => $convId
            ]);
        }

    }
}
