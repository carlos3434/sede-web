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
            'nombre' => 'Formacion',
            'slug' => 'formaciones'
        ]);
        Categoria::create([
            'nombre' => 'Capacitacion',
            'slug' => 'capacitaciones'
        ]);
        Categoria::create([
            'nombre' => 'Experiencia General',
            'slug' => 'experiencias_generales'
        ]);
        Categoria::create([
            'nombre' => 'Experiencia Inspector',
            'slug' => 'experiencias_inspector'
        ]);
        Categoria::create([
            'nombre' => 'Verificaciones Realizadas',
            'slug' => 'verificaciones_realizadas'
        ]);

    }
}
