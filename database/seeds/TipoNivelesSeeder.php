<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\TipoNiveles;
use Illuminate\Database\Eloquent\Model;

class TipoNivelesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' =>'0','nombre' =>'Sin nivel'],
            ['id' =>'1','nombre' =>'Piso'],
            ['id' =>'2','nombre' =>'Sotano']
        ];

        foreach ($items as $item)
        {
            TipoNiveles::updateOrCreate([
                'id' => $item['id'],
                'nombre' => $item['nombre']
        ], $item);
        }
    }
}
