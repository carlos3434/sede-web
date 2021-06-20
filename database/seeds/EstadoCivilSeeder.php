<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\EstadoCivil;

class EstadoCivilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoCivil::create([
            'nombre'      => 'soltero',
            'sigla'     => 'S',
        ]);
        EstadoCivil::create([
            'nombre'      => 'casado',
            'sigla'     => 'C',
        ]);
        EstadoCivil::create([
            'nombre'      => 'viudo',
            'sigla'     => 'V',
        ]);
        EstadoCivil::create([
            'nombre'      => 'divorciado',
            'sigla'     => 'D',
        ]);
    }
}
