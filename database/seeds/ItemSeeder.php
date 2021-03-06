<?php

use Illuminate\Database\Seeder;
use App\Models\SeleccionAdhoc\Item;
use App\Models\Settings\Convocatoria;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Formacion
        Item::create([
            'nombre' => 'Sin requisitos (0 Puntos)',
            'puntaje' => '0',
            'activo' => true,
            'categoria_id' => 1
        ]);
        Item::create([
            'nombre' => 'Titulado (03 Puntos)',
            'puntaje' => '3',
            'activo' => true,
            'categoria_id' => 1
        ]);
        Item::create([
            'nombre' => 'Postgrado (04 puntos)',
            'puntaje' => '4',
            'activo' => true,
            'categoria_id' => 1
        ]);
        Item::create([
            'nombre' => 'Magister o Doctorado (05 puntos)',
            'puntaje' => '5',
            'activo' => true,
            'categoria_id' => 1
        ]);

        //Capacitacion
        Item::create([
            'nombre' => 'Sin requisitos (0 Puntos)',
            'puntaje' => '0',
            'activo' => true,
            'categoria_id' => 2
        ]);
        Item::create([
            'nombre' => '20 horas lectivas (1 punto)',
            'puntaje' => '1',
            'activo' => true,
            'categoria_id' => 2
        ]);
        Item::create([
            'nombre' => '60 horas lectivas (2 puntos)',
            'puntaje' => '2',
            'activo' => true,
            'categoria_id' => 2
        ]);

        //ExperienciaGeneral
        Item::create([
            'nombre' => 'Sin requisitos (0 Puntos)',
            'puntaje' => '0',
            'activo' => true,
            'categoria_id' => 3
        ]);
        Item::create([
            'nombre' => '06 a 07 años (03 Puntos)',
            'puntaje' => '3',
            'activo' => true,
            'categoria_id' => 3
        ]);
        Item::create([
            'nombre' => '07 a 09 años (04 puntos)',
            'puntaje' => '4',
            'activo' => true,
            'categoria_id' => 3
        ]);
        Item::create([
            'nombre' => '10 años a más (05 puntos)',
            'puntaje' => '5',
            'activo' => true,
            'categoria_id' => 3
        ]);

        //ExperienciaInspector
        Item::create([
            'nombre' => 'Sin requisitos (0 Puntos)',
            'puntaje' => '0',
            'activo' => true,
            'categoria_id' => 4
        ]);
        Item::create([
            'nombre' => '05 a 10 años (01 Punto)',
            'puntaje' => '1',
            'activo' => true,
            'categoria_id' => 4
        ]);
        Item::create([
            'nombre' => 'más de 10 años (02 puntos)',
            'puntaje' => '2',
            'activo' => true,
            'categoria_id' => 4
        ]);

        //VerificacionesRealizadas
        Item::create([
            'nombre' => 'Sin requisitos (0 Puntos)',
            'puntaje' => '0',
            'activo' => true,
            'categoria_id' => 5
        ]);
        Item::create([
            'nombre' => '1 a 10 verificaciones (02 Punto)',
            'puntaje' => '2',
            'activo' => true,
            'categoria_id' => 5
        ]);
        Item::create([
            'nombre' => '11 a 15 verificaciones (04 puntos)',
            'puntaje' => '4',
            'activo' => true,
            'categoria_id' => 5
        ]);
        Item::create([
            'nombre' => 'más de 15 verificaciones (06 puntos)',
            'puntaje' => '6',
            'activo' => true,
            'categoria_id' => 5
        ]);
    }
}
