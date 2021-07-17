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
            'nombre'      => 'OBSERVADO',
        ]);
        EstadoExpedienteAdhoc::create([
            'nombre'      => 'PROGRAMADO',
        ]);
        EstadoExpedienteAdhoc::create([
            'nombre'      => 'ENTREGADO',
        ]);
        EstadoExpedienteAdhoc::create([
            'nombre'      => 'RECIBIDO',
        ]);
    }
}
