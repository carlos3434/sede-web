<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\EstadoExpedienteAdhoc;

class EstadoExpedienteAdhocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoExpedienteAdhoc::create([
            'nombre'      => 'CREADO',
        ]);
        EstadoExpedienteAdhoc::create([
            'nombre'      => 'HOJA DE TRAMITE',
        ]);
        EstadoExpedienteAdhoc::create([
            'nombre'      => 'SOLICITUD VERIFICACION',
        ]);
        EstadoExpedienteAdhoc::create([
            'nombre'      => 'OBSERVADO',
        ]);
        EstadoExpedienteAdhoc::create([
            'nombre'      => 'ENTREGADO',
        ]);
        EstadoExpedienteAdhoc::create([
            'nombre'      => 'RECIBIDO',
        ]);
        EstadoExpedienteAdhoc::create([
            'nombre'      => 'PROGRAMADO',
        ]);
        EstadoExpedienteAdhoc::create([
            'nombre'      => 'INFORME ENTREGADO',
        ]);
        EstadoExpedienteAdhoc::create([
            'nombre'      => 'ADMINISTRADO NOTIFICADO',
        ]);
    }
}
