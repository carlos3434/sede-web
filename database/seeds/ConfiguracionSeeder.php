<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\Configuracion;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Configuracion::create([
            'nombre'      => 'CONVOCATORIA_ACTUAL',
            'valor'     => '1',
        ]);
        Configuracion::create([
            'nombre'      => 'CONVOCATORIA_ACTUAL',
            'valor'     => '2',
        ]);
        Configuracion::create([
            'nombre'      => 'CONVOCATORIA_ACTUAL',
            'valor'     => '3',
        ]);
        Configuracion::create([
            'nombre'      => 'CONVOCATORIA_ACTUAL',
            'valor'     => '4',
        ]);
    }
}
