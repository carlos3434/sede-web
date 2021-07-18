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
            ['name' => 'ADMINISTRADOR','nombre'=>'Admin','guard_name' =>'web'],
            ['name' => 'USUARIO_CENEPRED','nombre'=>'Usuario Cenepred','guard_name' =>'web'],
            ['name' => 'USUARIO_ADHOC','nombre'=>'Usuario Ad Hoc','guard_name' =>'web'],
            ['name' => 'USUARIO_ADMINISTRADO','nombre'=>'Usuario Administrado','guard_name' =>'web'],
        ];

        foreach ($items as $item)
        {
            Rol::updateOrCreate(['name' => $item['name']], $item);
        }

    }
}
