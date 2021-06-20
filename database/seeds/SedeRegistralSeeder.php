<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\SedeRegistral;
class SedeRegistralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['nombre' => 'SEDE CENTRAL'],
            ['nombre' => 'ZONA REGISTRAL N° I - SEDE PIURA'],
            ['nombre' => 'ZONA REGISTRAL N° II - SEDE CHICLAYO'],
            ['nombre' => 'ZONA REGISTRAL N° III - SEDE MOYOBAMBA'],
            ['nombre' => 'ZONA REGISTRAL N° IV - SEDE IQUITOS'],
            ['nombre' => 'ZONA REGISTRAL N° V - SEDE TRUJILLO'],
            ['nombre' => 'ZONA REGISTRAL N° VI - SEDE PUCALLPA'],
            ['nombre' => 'ZONA REGISTRAL N° VII - SEDE HUARAZ'],
            ['nombre' => 'ZONA REGISTRAL N° VIII - SEDE HUANCAYO'],
            ['nombre' => 'ZONA REGISTRAL N° IX - SEDE LIMA'],
            ['nombre' => 'ZONA REGISTRAL N° X - SEDE CUSCO'],
            ['nombre' => 'ZONA REGISTRAL N° XI - SEDE ICA'],
            ['nombre' => 'ZONA REGISTRAL N° XII - SEDE AREQUIPA'],
            ['nombre' => 'ZONA REGISTRAL N° XIII - SEDE TACNA'],
            ['nombre' => 'ZONA REGISTRAL N° XIV - SEDE AYACUCHO'],
        ];

        foreach ($items as $item) {
            SedeRegistral::updateOrCreate(['nombre' => $item['nombre']], $item);
        }
    }
}
