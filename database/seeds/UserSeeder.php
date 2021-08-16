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
                'nombres' =>'JOSE LUIS',
                'apellido_paterno'=>'CODARLUPO',
                'apellido_materno'=>'ALEJOS',
                'pais_id'=>133,
                'sexo'=>FALSE,
                'estado_civil_id'=>1,
                'tipo_documento_id'=>2,
                'numero_documento'=>'41930191',
                'direccion'=>'CALLE DIAGONAL 123',
                'distrito_id'=>1685,
                'telefono_fijo'=>'234534',
                'celular'=>'984257856',
                'email'=>'jcodarlupo@cenepred.gob.pe',
                'password'=>bcrypt('12345678'),
                'colegio_profesional'=>'CIP',
                'profesion'=>'Ingeniero',
                'numero_colegiatura'=>'2345',
                'esta_habilitado'=>TRUE,
                'constancia_habilidad'=>'',
                'role_id'=>'1'//ADMINISTRADOR
            ],

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
                'profesion'=>'Arquitecto',
                'numero_colegiatura'=>'2345',
                'esta_habilitado'=>TRUE,
                'constancia_habilidad'=>'',
                'role_id'=>'2'//ADMINISTRADOR
            ],

            [
                'nombres' =>'cenepred1',
                'apellido_paterno'=>'uno',
                'apellido_materno'=>'uno',
                'pais_id'=>133,
                'sexo'=>FALSE,
                'estado_civil_id'=>1,
                'tipo_documento_id'=>2,
                'numero_documento'=>'41000001',
                'direccion'=>'CALLE DIAGONAL 123',
                'distrito_id'=>1685,
                'telefono_fijo'=>'234534',
                'celular'=>'984257856',
                'email'=>'cenepred1@gmail.com',
                'password'=>bcrypt('12345678'),
                'colegio_profesional'=>'CIP',
                'profesion'=>'Arquitecto',
                'numero_colegiatura'=>'2345',
                'esta_habilitado'=>TRUE,
                'constancia_habilidad'=>'',
                'role_id'=>'2'//USUARIO_CENEPRED
            ],

            [
                'nombres' =>'cenepred2',
                'apellido_paterno'=>'uno',
                'apellido_materno'=>'uno',
                'pais_id'=>133,
                'sexo'=>FALSE,
                'estado_civil_id'=>1,
                'tipo_documento_id'=>2,
                'numero_documento'=>'41000002',
                'direccion'=>'CALLE DIAGONAL 123',
                'distrito_id'=>1685,
                'telefono_fijo'=>'234534',
                'celular'=>'984257856',
                'email'=>'cenepred2@gmail.com',
                'password'=>bcrypt('12345678'),
                'colegio_profesional'=>'CIP',
                'profesion'=>'Arquitecto',
                'numero_colegiatura'=>'2345',
                'esta_habilitado'=>TRUE,
                'constancia_habilidad'=>'',
                'role_id'=>'2'//USUARIO_CENEPRED
            ],

            [
                'nombres' =>'adhoc1',
                'apellido_paterno'=>'uno',
                'apellido_materno'=>'uno',
                'pais_id'=>133,
                'sexo'=>FALSE,
                'estado_civil_id'=>1,
                'tipo_documento_id'=>2,
                'numero_documento'=>'41000003',
                'direccion'=>'CALLE DIAGONAL 123',
                'distrito_id'=>1685,
                'telefono_fijo'=>'234534',
                'celular'=>'984257856',
                'email'=>'adhoc1@gmail.com',
                'password'=>bcrypt('12345678'),
                'colegio_profesional'=>'CIP',
                'profesion'=>'Arquitecto',
                'numero_colegiatura'=>'2345',
                'esta_habilitado'=>TRUE,
                'constancia_habilidad'=>'',
                'role_id'=>'3'//USUARIO_ADHOC
            ],
            [
                'nombres' =>'adhoc2',
                'apellido_paterno'=>'uno',
                'apellido_materno'=>'uno',
                'pais_id'=>133,
                'sexo'=>FALSE,
                'estado_civil_id'=>1,
                'tipo_documento_id'=>2,
                'numero_documento'=>'41000004',
                'direccion'=>'CALLE DIAGONAL 123',
                'distrito_id'=>1685,
                'telefono_fijo'=>'234534',
                'celular'=>'984257856',
                'email'=>'adhoc2@gmail.com',
                'password'=>bcrypt('12345678'),
                'colegio_profesional'=>'CIP',
                'profesion'=>'Arquitecto',
                'numero_colegiatura'=>'2345',
                'esta_habilitado'=>TRUE,
                'constancia_habilidad'=>'',
                'role_id'=>'3'//USUARIO_ADHOC
            ],

            [
                'nombres' =>'administrado1',
                'apellido_paterno'=>'uno',
                'apellido_materno'=>'uno',
                'pais_id'=>133,
                'sexo'=>FALSE,
                'estado_civil_id'=>1,
                'tipo_documento_id'=>2,
                'numero_documento'=>'41000005',
                'direccion'=>'CALLE DIAGONAL 123',
                'distrito_id'=>1685,
                'telefono_fijo'=>'234534',
                'celular'=>'984257856',
                'email'=>'administrado1@gmail.com',
                'password'=>bcrypt('12345678'),
                'colegio_profesional'=>'CIP',
                'profesion'=>'Arquitecto',
                'numero_colegiatura'=>'2345',
                'esta_habilitado'=>TRUE,
                'constancia_habilidad'=>'',
                'role_id'=>'4'//USUARIO_ADMINISTRADO
            ],

            [
                'nombres' =>'administrado2',
                'apellido_paterno'=>'uno',
                'apellido_materno'=>'uno',
                'pais_id'=>133,
                'sexo'=>FALSE,
                'estado_civil_id'=>1,
                'tipo_documento_id'=>2,
                'numero_documento'=>'41000006',
                'direccion'=>'CALLE DIAGONAL 123',
                'distrito_id'=>1685,
                'telefono_fijo'=>'234534',
                'celular'=>'984257856',
                'email'=>'administrado2@gmail.com',
                'password'=>bcrypt('12345678'),
                'colegio_profesional'=>'CIP',
                'profesion'=>'Arquitecto',
                'numero_colegiatura'=>'2345',
                'esta_habilitado'=>TRUE,
                'constancia_habilidad'=>'',
                'role_id'=>'4'//USUARIO_ADMINISTRADO
            ],

        ];

        $administrador = Role::where('name','ADMINISTRADOR')->first();
        $cenepred = Role::where('name','USUARIO_CENEPRED')->first();
        $adhoc = Role::where('name','USUARIO_ADHOC')->first();
        $administrado = Role::where('name','USUARIO_ADMINISTRADO')->first();

        foreach ($items as $item) {
            if ($item['role_id']==1) {
                $role = $administrador;
            } elseif ($item['role_id']==2) {
                $role = $cenepred;
            } elseif ($item['role_id']==3) {
                $role = $adhoc;
            } elseif ($item['role_id']==4) {
                $role = $administrado;
            }
            unset($item['role_id']);
            $user = User::updateOrCreate(['email' => $item['email']], $item);
            $user->assignRole($role);
        }




    }
}
