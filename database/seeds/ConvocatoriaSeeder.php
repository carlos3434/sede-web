<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\Convocatoria;

class ConvocatoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Convocatoria::create([
            'nombre'        => 'CONVOCATORIA_2020',
            'activo'        => false,
            'fecha_inicio'  => '2020-12-01',
            'fecha_final'   => '2020-12-30',
        ]);
        Convocatoria::create([
            'nombre'        => 'CONVOCATORIA_2021',
            'activo'        => true,
            'fecha_inicio'  => '2021-01-01',
            'fecha_final'   => '2021-12-30',
        ]);
        Convocatoria::create([
            'nombre'        => 'CONVOCATORIA_2022',
            'activo'        => false,
            'fecha_inicio'  => '2022-12-01',
            'fecha_final'   => '2022-12-30',
        ]);
        Convocatoria::create([
            'nombre'        => 'CONVOCATORIA_2023',
            'activo'        => false,
            'fecha_inicio'  => '2023-12-01',
            'fecha_final'   => '2023-12-30',
        ]);
    }
}
