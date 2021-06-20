<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\TipoCapacitacion;

class TipoCapacitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['nombre' => 'Curso'],
            ['nombre' => 'Taller'],
            ['nombre' => 'Diplomado o Programa de Especialización'],
            ['nombre' => 'Curso de Especialización'],
        ];

        foreach ($items as $item) {
            TipoCapacitacion::updateOrCreate(['nombre' => $item['nombre']], $item);
        }
    }
}
