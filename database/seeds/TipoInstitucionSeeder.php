<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\TipoInstitucion;

class TipoInstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['nombre' =>'Institucion Academica'],
            ['nombre' =>'Gobierno Local'],
            ['nombre' =>'Gobierno Departamental']
        ];

        foreach ($items as $item)
        {
            TipoInstitucion::updateOrCreate(['nombre' => $item['nombre']], $item);
        }
    }
}
