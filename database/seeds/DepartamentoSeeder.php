<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\Departamento;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $items = [
            ['ubigeo' => '01','nombre' =>'AMAZONAS'],
            ['ubigeo' => '02','nombre' =>'ANCASH'],
            ['ubigeo' => '03','nombre' =>'APURIMAC'],
            ['ubigeo' => '04','nombre' =>'AREQUIPA'],
            ['ubigeo' => '05','nombre' =>'AYACUCHO'],
            ['ubigeo' => '06','nombre' =>'CAJAMARCA'],
            ['ubigeo' => '07','nombre' =>'CALLAO'],
            ['ubigeo' => '08','nombre' =>'CUSCO'],
            ['ubigeo' => '09','nombre' =>'HUANCAVELICA'],
            ['ubigeo' => '10','nombre' =>'HUANUCO'],
            ['ubigeo' => '11','nombre' =>'ICA'],
            ['ubigeo' => '12','nombre' =>'JUNIN'],
            ['ubigeo' => '13','nombre' =>'LA LIBERTAD'],
            ['ubigeo' => '14','nombre' =>'LAMBAYEQUE'],
            ['ubigeo' => '15','nombre' =>'LIMA'],
            ['ubigeo' => '16','nombre' =>'LORETO'],
            ['ubigeo' => '17','nombre' =>'MADRE DE DIOS'],
            ['ubigeo' => '18','nombre' =>'MOQUEGUA'],
            ['ubigeo' => '19','nombre' =>'PASCO'],
            ['ubigeo' => '20','nombre' =>'PIURA'],
            ['ubigeo' => '21','nombre' =>'PUNO'],
            ['ubigeo' => '22','nombre' =>'SAN MARTIN'],
            ['ubigeo' => '23','nombre' =>'TACNA'],
            ['ubigeo' => '24','nombre' =>'TUMBES'],
            ['ubigeo' => '25','nombre' =>'UCAYALI'],

        ];

        foreach ($items as $item)
        {
            Departamento::updateOrCreate(['nombre' => $item['nombre']], $item);
        }

    }
}
