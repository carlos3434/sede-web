<?php

use Illuminate\Database\Seeder;

use App\Models\Auth\User;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items =
        [
            [
                'nombres' =>'KELLY',
                'apellido_paterno'=>'MONTOYA',
                'apellido_materno'=>'JARA',
                'pais_id'=>133,
                'sexo'=>FALSE,
                'estado_civil_id'=>1,
                'tipo_documento_id'=>2,
                'numero_documento'=>'41930190',
                'direccion'=>'CALLE DIAGONAL 123',
                'distrito_id'=>1685,
                'telefono_fijo'=>'234534',
                'celular'=>'984257856',
                'email'=>'kmontoya@cenepred.gob.pe',
                'password'=>bcrypt('12345678'),
                'colegio_profesional'=>'CIP',
                'numero_colegiatura'=>'2345',
                'esta_habilitado'=>TRUE,
                'constancia_habilidad'=>''
            ],

            [
                'nombres' =>'JOSE LUIS',
                'apellido_paterno'=>'EPIQUIEN',
                'apellido_materno'=>'RIVERA',
                'pais_id'=>133,
                'sexo'=>FALSE,
                'estado_civil_id'=>1,
                'tipo_documento_id'=>2,
                'numero_documento'=>'41930191',
                'direccion'=>'CALLE DIAGONAL 123',
                'distrito_id'=>1685,
                'telefono_fijo'=>'234534',
                'celular'=>'984257856',
                'email'=>'kobregon@cenepred.gob.pe',
                'password'=>bcrypt('12345678'),
                'colegio_profesional'=>'CIP',
                'numero_colegiatura'=>'2345',
                'esta_habilitado'=>TRUE,
                'constancia_habilidad'=>''
            ],

            [
                'nombres' =>'JOSE LUIS',
                'apellido_paterno'=>'EPIQUIEN',
                'apellido_materno'=>'RIVERA',
                'pais_id'=>133,
                'sexo'=>FALSE,
                'estado_civil_id'=>1,
                'tipo_documento_id'=>2,
                'numero_documento'=>'41930191',
                'direccion'=>'CALLE DIAGONAL 123',
                'distrito_id'=>1685,
                'telefono_fijo'=>'234534',
                'celular'=>'984257856',
                'email'=>'kobregon@cenepred.gob.pe',
                'password'=>bcrypt('12345678'),
                'colegio_profesional'=>'CIP',
                'numero_colegiatura'=>'2345',
                'esta_habilitado'=>TRUE,
                'constancia_habilidad'=>''
            ],

        ];

        $role = Role::find(2);
        foreach ($items as $item) {
            $user = User::updateOrCreate(['email' => $item['email']], $item);
            $user->assignRole($role);
        }

    }
}
