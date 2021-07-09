<?php

use Illuminate\Database\Seeder;
use App\Models\SeleccionAdhoc\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre' => 'Formacion'
        ]);
        Categoria::create([
            'nombre' => 'Capacitacion'
        ]);
        Categoria::create([
            'nombre' => 'Experiencia General'
        ]);
        Categoria::create([
            'nombre' => 'Experiencia Inspector'
        ]);
        Categoria::create([
            'nombre' => 'Verificaciones Realizadas'
        ]);

    }
}
