<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\EstadoObservacion;

class EstadoObservacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoObservacion::create([
            'nombre'      => 'GENERADO',
        ]);
        EstadoObservacion::create([
            'nombre'      => 'COMPLETADO',
        ]);
    }
}
