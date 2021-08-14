<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\EstadoRevision;

class EstadoRevisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoRevision::create([
            'nombre'      => 'OBSERVADO',
        ]);
        EstadoRevision::create([
            'nombre'      => 'ADMITIDO',
        ]);
        EstadoRevision::create([
            'nombre'      => 'SUBSANADO',
        ]);
    }
}
