<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\Grado;

class GradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['nombre' => 'Titulo'],
            ['nombre' => 'Maestría'],
            ['nombre' => 'Doctorado'],
        ];

        foreach ($items as $item) {
            Grado::updateOrCreate(['nombre' => $item['nombre']], $item);
        }
    }
}
