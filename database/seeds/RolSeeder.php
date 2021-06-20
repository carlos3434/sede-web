<?php

use App\Models\Auth\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'ADMINISTRADOR','guard_name' =>'web'],
            ['name' => 'USUARIO_CENEPRED','guard_name' =>'web'],
            ['name' => 'USUARIO_ADHOC','guard_name' =>'web'],
            ['name' => 'USUARIO_ADMINISTRADO','guard_name' =>'web'],
        ];

        foreach ($items as $item)
        {
            Rol::updateOrCreate(['name' => $item['name']], $item);
        }

    }
}
