<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\TipoDocumento;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['nombre' => 'DNI'],
            ['nombre' => 'Carnet de Extranjeria'],
            ['nombre' => 'Pasaporte'],
        ];

        foreach ($items as $item) {
            TipoDocumento::updateOrCreate(['nombre' => $item['nombre']], $item);
        }
    }
}
