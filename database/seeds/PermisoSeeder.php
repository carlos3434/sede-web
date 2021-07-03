<?php

use App\Models\Auth\Permiso;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'ACREDITACION_INDEX','guard_name' =>'web'],
            ['name' => 'ACREDITACION_CREATE','guard_name' =>'web'],
            ['name' => 'ACREDITACION_EDIT','guard_name' =>'web'],
            ['name' => 'ACREDITACION_DESTROY','guard_name' =>'web'],
            ['name' => 'ACREDITACION_SHOW','guard_name' =>'web'],
            ['name' => 'ACREDITACION_INDEX_DATA','guard_name' =>'web'],
            ['name' => 'ACREDITACION_ACREDITAR','guard_name' =>'web'],

            ['name' => 'CALIFICACION_INDEX','guard_name' =>'web'],
            ['name' => 'CALIFICACION_CREATE','guard_name' =>'web'],
            ['name' => 'CALIFICACION_EDIT','guard_name' =>'web'],
            ['name' => 'CALIFICACION_DESTROY','guard_name' =>'web'],
            ['name' => 'CALIFICACION_SHOW','guard_name' =>'web'],
            ['name' => 'CALIFICACION_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'CAPACITACION_INDEX','guard_name' =>'web'],
            ['name' => 'CAPACITACION_CREATE','guard_name' =>'web'],
            ['name' => 'CAPACITACION_EDIT','guard_name' =>'web'],
            ['name' => 'CAPACITACION_DESTROY','guard_name' =>'web'],
            ['name' => 'CAPACITACION_SHOW','guard_name' =>'web'],
            ['name' => 'CAPACITACION_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'CONFIGURACION_INDEX','guard_name' =>'web'],
            ['name' => 'CONFIGURACION_CREATE','guard_name' =>'web'],
            ['name' => 'CONFIGURACION_EDIT','guard_name' =>'web'],
            ['name' => 'CONFIGURACION_DESTROY','guard_name' =>'web'],
            ['name' => 'CONFIGURACION_SHOW','guard_name' =>'web'],
            ['name' => 'CONFIGURACION_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'CONVOCATORIA_INDEX','guard_name' =>'web'],
            ['name' => 'CONVOCATORIA_CREATE','guard_name' =>'web'],
            ['name' => 'CONVOCATORIA_EDIT','guard_name' =>'web'],
            ['name' => 'CONVOCATORIA_DESTROY','guard_name' =>'web'],
            ['name' => 'CONVOCATORIA_SHOW','guard_name' =>'web'],
            ['name' => 'CONVOCATORIA_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'DEPARTAMENTO_INDEX','guard_name' =>'web'],
            ['name' => 'DEPARTAMENTO_CREATE','guard_name' =>'web'],
            ['name' => 'DEPARTAMENTO_EDIT','guard_name' =>'web'],
            ['name' => 'DEPARTAMENTO_DESTROY','guard_name' =>'web'],
            ['name' => 'DEPARTAMENTO_SHOW','guard_name' =>'web'],
            ['name' => 'DEPARTAMENTO_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'DILIGENCIA_INDEX','guard_name' =>'web'],
            ['name' => 'DILIGENCIA_CREATE','guard_name' =>'web'],
            ['name' => 'DILIGENCIA_EDIT','guard_name' =>'web'],
            ['name' => 'DILIGENCIA_DESTROY','guard_name' =>'web'],
            ['name' => 'DILIGENCIA_SHOW','guard_name' =>'web'],
            ['name' => 'DILIGENCIA_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'DISTRITO_INDEX','guard_name' =>'web'],
            ['name' => 'DISTRITO_CREATE','guard_name' =>'web'],
            ['name' => 'DISTRITO_EDIT','guard_name' =>'web'],
            ['name' => 'DISTRITO_DESTROY','guard_name' =>'web'],
            ['name' => 'DISTRITO_SHOW','guard_name' =>'web'],
            ['name' => 'DISTRITO_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'USUARIO_DOCUMENTO_SHOW','guard_name' =>'web'],            

            ['name' => 'ENTREGA_EXPEDIENTE_INDEX','guard_name' =>'web'],
            ['name' => 'ENTREGA_EXPEDIENTE_CREATE','guard_name' =>'web'],
            ['name' => 'ENTREGA_EXPEDIENTE_EDIT','guard_name' =>'web'],
            ['name' => 'ENTREGA_EXPEDIENTE_DESTROY','guard_name' =>'web'],
            ['name' => 'ENTREGA_EXPEDIENTE_SHOW','guard_name' =>'web'],
            ['name' => 'ENTREGA_EXPEDIENTE_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'EXPEDIENTE_ADHOC_INDEX','guard_name' =>'web'],
            ['name' => 'EXPEDIENTE_ADHOC_CREATE','guard_name' =>'web'],
            ['name' => 'EXPEDIENTE_ADHOC_EDIT','guard_name' =>'web'],
            ['name' => 'EXPEDIENTE_ADHOC_DESTROY','guard_name' =>'web'],
            ['name' => 'EXPEDIENTE_ADHOC_SHOW','guard_name' =>'web'],
            ['name' => 'EXPEDIENTE_ADHOC_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'EXPERIENCIA_INDEX','guard_name' =>'web'],
            ['name' => 'EXPERIENCIA_CREATE','guard_name' =>'web'],
            ['name' => 'EXPERIENCIA_EDIT','guard_name' =>'web'],
            ['name' => 'EXPERIENCIA_DESTROY','guard_name' =>'web'],
            ['name' => 'EXPERIENCIA_SHOW','guard_name' =>'web'],
            ['name' => 'EXPERIENCIA_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'EXPERIENCIA_INSPECTOR_INDEX','guard_name' =>'web'],
            ['name' => 'EXPERIENCIA_INSPECTOR_CREATE','guard_name' =>'web'],
            ['name' => 'EXPERIENCIA_INSPECTOR_EDIT','guard_name' =>'web'],
            ['name' => 'EXPERIENCIA_INSPECTOR_DESTROY','guard_name' =>'web'],
            ['name' => 'EXPERIENCIA_INSPECTOR_SHOW','guard_name' =>'web'],
            ['name' => 'EXPERIENCIA_INSPECTOR_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'FORMACION_INDEX','guard_name' =>'web'],
            ['name' => 'FORMACION_CREATE','guard_name' =>'web'],
            ['name' => 'FORMACION_EDIT','guard_name' =>'web'],
            ['name' => 'FORMACION_DESTROY','guard_name' =>'web'],
            ['name' => 'FORMACION_SHOW','guard_name' =>'web'],
            ['name' => 'FORMACION_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'GRADO_INDEX','guard_name' =>'web'],
            ['name' => 'GRADO_CREATE','guard_name' =>'web'],
            ['name' => 'GRADO_EDIT','guard_name' =>'web'],
            ['name' => 'GRADO_DESTROY','guard_name' =>'web'],
            ['name' => 'GRADO_SHOW','guard_name' =>'web'],
            ['name' => 'GRADO_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'INSTITUCION_INDEX','guard_name' =>'web'],
            ['name' => 'INSTITUCION_CREATE','guard_name' =>'web'],
            ['name' => 'INSTITUCION_EDIT','guard_name' =>'web'],
            ['name' => 'INSTITUCION_DESTROY','guard_name' =>'web'],
            ['name' => 'INSTITUCION_SHOW','guard_name' =>'web'],
            ['name' => 'INSTITUCION_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'ITEM_INDEX','guard_name' =>'web'],
            ['name' => 'ITEM_CREATE','guard_name' =>'web'],
            ['name' => 'ITEM_EDIT','guard_name' =>'web'],
            ['name' => 'ITEM_DESTROY','guard_name' =>'web'],
            ['name' => 'ITEM_SHOW','guard_name' =>'web'],
            ['name' => 'ITEM_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'OBSERVACION_INDEX','guard_name' =>'web'],
            ['name' => 'OBSERVACION_CREATE','guard_name' =>'web'],
            ['name' => 'OBSERVACION_EDIT','guard_name' =>'web'],
            ['name' => 'OBSERVACION_DESTROY','guard_name' =>'web'],
            ['name' => 'OBSERVACION_SHOW','guard_name' =>'web'],
            ['name' => 'OBSERVACION_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'PAIS_INDEX','guard_name' =>'web'],
            ['name' => 'PAIS_CREATE','guard_name' =>'web'],
            ['name' => 'PAIS_EDIT','guard_name' =>'web'],
            ['name' => 'PAIS_DESTROY','guard_name' =>'web'],
            ['name' => 'PAIS_SHOW','guard_name' =>'web'],
            ['name' => 'PAIS_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'PROVINCIA_INDEX','guard_name' =>'web'],
            ['name' => 'PROVINCIA_CREATE','guard_name' =>'web'],
            ['name' => 'PROVINCIA_EDIT','guard_name' =>'web'],
            ['name' => 'PROVINCIA_DESTROY','guard_name' =>'web'],
            ['name' => 'PROVINCIA_SHOW','guard_name' =>'web'],
            ['name' => 'PROVINCIA_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'PUNTAJE_INDEX','guard_name' =>'web'],
            ['name' => 'PUNTAJE_CREATE','guard_name' =>'web'],
            ['name' => 'PUNTAJE_EDIT','guard_name' =>'web'],
            ['name' => 'PUNTAJE_DESTROY','guard_name' =>'web'],
            ['name' => 'PUNTAJE_SHOW','guard_name' =>'web'],
            ['name' => 'PUNTAJE_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'SEDE_REGISTRAL_INDEX','guard_name' =>'web'],
            ['name' => 'SEDE_REGISTRAL_CREATE','guard_name' =>'web'],
            ['name' => 'SEDE_REGISTRAL_EDIT','guard_name' =>'web'],
            ['name' => 'SEDE_REGISTRAL_DESTROY','guard_name' =>'web'],
            ['name' => 'SEDE_REGISTRAL_SHOW','guard_name' =>'web'],
            ['name' => 'SEDE_REGISTRAL_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'SELECCION_INDEX','guard_name' =>'web'],
            ['name' => 'SELECCION_CREATE','guard_name' =>'web'],
            ['name' => 'SELECCION_EDIT','guard_name' =>'web'],
            ['name' => 'SELECCION_DESTROY','guard_name' =>'web'],
            ['name' => 'SELECCION_SHOW','guard_name' =>'web'],
            ['name' => 'SELECCION_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'TIPO_CAPACITACION_INDEX','guard_name' =>'web'],
            ['name' => 'TIPO_CAPACITACION_CREATE','guard_name' =>'web'],
            ['name' => 'TIPO_CAPACITACION_EDIT','guard_name' =>'web'],
            ['name' => 'TIPO_CAPACITACION_DESTROY','guard_name' =>'web'],
            ['name' => 'TIPO_CAPACITACION_SHOW','guard_name' =>'web'],
            ['name' => 'TIPO_CAPACITACION_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'TIPO_DOCUMENTO_INDEX','guard_name' =>'web'],
            ['name' => 'TIPO_DOCUMENTO_CREATE','guard_name' =>'web'],
            ['name' => 'TIPO_DOCUMENTO_EDIT','guard_name' =>'web'],
            ['name' => 'TIPO_DOCUMENTO_DESTROY','guard_name' =>'web'],
            ['name' => 'TIPO_DOCUMENTO_SHOW','guard_name' =>'web'],
            ['name' => 'TIPO_DOCUMENTO_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'TIPO_INSTITUCION_INDEX','guard_name' =>'web'],
            ['name' => 'TIPO_INSTITUCION_CREATE','guard_name' =>'web'],
            ['name' => 'TIPO_INSTITUCION_EDIT','guard_name' =>'web'],
            ['name' => 'TIPO_INSTITUCION_DESTROY','guard_name' =>'web'],
            ['name' => 'TIPO_INSTITUCION_SHOW','guard_name' =>'web'],
            ['name' => 'TIPO_INSTITUCION_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'USER_INDEX','guard_name' =>'web'],
            ['name' => 'USER_CREATE','guard_name' =>'web'],
            ['name' => 'USER_EDIT','guard_name' =>'web'],
            ['name' => 'USER_DESTROY','guard_name' =>'web'],
            ['name' => 'USER_SHOW','guard_name' =>'web'],
            ['name' => 'USER_INDEX_DATA','guard_name' =>'web'],            

            ['name' => 'VERIFICACION_REALIZADA_INDEX','guard_name' =>'web'],
            ['name' => 'VERIFICACION_REALIZADA_CREATE','guard_name' =>'web'],
            ['name' => 'VERIFICACION_REALIZADA_EDIT','guard_name' =>'web'],
            ['name' => 'VERIFICACION_REALIZADA_DESTROY','guard_name' =>'web'],
            ['name' => 'VERIFICACION_REALIZADA_SHOW','guard_name' =>'web'],
            ['name' => 'VERIFICACION_REALIZADA_INDEX_DATA','guard_name' =>'web'],

            ['name' => 'USUARIO_DOCUMENTO_SHOW','guard_name' =>'web'],


            ];

        foreach ($items as $item)
        {
            Permission::create(['name' => $item['name']], $item);
        }

        //asignanado permisos a roles
        $administrador = Role::where('name','ADMINISTRADOR')->first();
        $administrador->syncPermissions( 
            Permission::whereIn(
                'name',
                [
                    'ACREDITACION_ACREDITAR',
                    'ACREDITACION_CREATE',
                    'ACREDITACION_DESTROY',
                    'ACREDITACION_EDIT',
                    'ACREDITACION_INDEX',
                    'ACREDITACION_INDEX_DATA',
                    'ACREDITACION_SHOW',
                    'CALIFICACION_CREATE',
                    'CALIFICACION_DESTROY',
                    'CALIFICACION_EDIT',
                    'CALIFICACION_INDEX',
                    'CALIFICACION_INDEX_DATA',
                    'CALIFICACION_SHOW',
                    'CAPACITACION_CREATE',
                    'CAPACITACION_DESTROY',
                    'CAPACITACION_EDIT',
                    'CAPACITACION_INDEX',
                    'CAPACITACION_INDEX_DATA',
                    'CAPACITACION_SHOW',
                    'CONFIGURACION_CREATE',
                    'CONFIGURACION_DESTROY',
                    'CONFIGURACION_EDIT',
                    'CONFIGURACION_INDEX',
                    'CONFIGURACION_INDEX_DATA',
                    'CONFIGURACION_SHOW',
                    'CONVOCATORIA_CREATE',
                    'CONVOCATORIA_DESTROY',
                    'CONVOCATORIA_EDIT',
                    'CONVOCATORIA_INDEX',
                    'CONVOCATORIA_INDEX_DATA',
                    'CONVOCATORIA_SHOW',
                    'DEPARTAMENTO_CREATE',
                    'DEPARTAMENTO_DESTROY',
                    'DEPARTAMENTO_EDIT',
                    'DEPARTAMENTO_INDEX',
                    'DEPARTAMENTO_INDEX_DATA',
                    'DEPARTAMENTO_SHOW',
                    'DILIGENCIA_CREATE',
                    'DILIGENCIA_DESTROY',
                    'DILIGENCIA_EDIT',
                    'DILIGENCIA_INDEX',
                    'DILIGENCIA_INDEX_DATA',
                    'DILIGENCIA_SHOW',
                    'DISTRITO_CREATE',
                    'DISTRITO_DESTROY',
                    'DISTRITO_EDIT',
                    'DISTRITO_INDEX',
                    'DISTRITO_INDEX_DATA',
                    'DISTRITO_SHOW',
                    'ENTREGA_EXPEDIENTE_CREATE',
                    'ENTREGA_EXPEDIENTE_DESTROY',
                    'ENTREGA_EXPEDIENTE_EDIT',
                    'ENTREGA_EXPEDIENTE_INDEX',
                    'ENTREGA_EXPEDIENTE_INDEX_DATA',
                    'ENTREGA_EXPEDIENTE_SHOW',
                    'EXPEDIENTE_ADHOC_CREATE',
                    'EXPEDIENTE_ADHOC_DESTROY',
                    'EXPEDIENTE_ADHOC_EDIT',
                    'EXPEDIENTE_ADHOC_INDEX',
                    'EXPEDIENTE_ADHOC_INDEX_DATA',
                    'EXPEDIENTE_ADHOC_SHOW',
                    'EXPERIENCIA_CREATE',
                    'EXPERIENCIA_DESTROY',
                    'EXPERIENCIA_EDIT',
                    'EXPERIENCIA_INDEX',
                    'EXPERIENCIA_INDEX_DATA',
                    'EXPERIENCIA_INSPECTOR_CREATE',
                    'EXPERIENCIA_INSPECTOR_DESTROY',
                    'EXPERIENCIA_INSPECTOR_EDIT',
                    'EXPERIENCIA_INSPECTOR_INDEX',
                    'EXPERIENCIA_INSPECTOR_INDEX_DATA',
                    'EXPERIENCIA_INSPECTOR_SHOW',
                    'EXPERIENCIA_SHOW',
                    'FORMACION_CREATE',
                    'FORMACION_DESTROY',
                    'FORMACION_EDIT',
                    'FORMACION_INDEX',
                    'FORMACION_INDEX_DATA',
                    'FORMACION_SHOW',
                    'GRADO_CREATE',
                    'GRADO_DESTROY',
                    'GRADO_EDIT',
                    'GRADO_INDEX',
                    'GRADO_INDEX_DATA',
                    'GRADO_SHOW',
                    'INSTITUCION_CREATE',
                    'INSTITUCION_DESTROY',
                    'INSTITUCION_EDIT',
                    'INSTITUCION_INDEX',
                    'INSTITUCION_INDEX_DATA',
                    'INSTITUCION_SHOW',
                    'ITEM_CREATE',
                    'ITEM_DESTROY',
                    'ITEM_EDIT',
                    'ITEM_INDEX',
                    'ITEM_INDEX_DATA',
                    'ITEM_SHOW',
                    'OBSERVACION_CREATE',
                    'OBSERVACION_DESTROY',
                    'OBSERVACION_EDIT',
                    'OBSERVACION_INDEX',
                    'OBSERVACION_INDEX_DATA',
                    'OBSERVACION_SHOW',
                    'PAIS_CREATE',
                    'PAIS_DESTROY',
                    'PAIS_EDIT',
                    'PAIS_INDEX',
                    'PAIS_INDEX_DATA',
                    'PAIS_SHOW',
                    'PROVINCIA_CREATE',
                    'PROVINCIA_DESTROY',
                    'PROVINCIA_EDIT',
                    'PROVINCIA_INDEX',
                    'PROVINCIA_INDEX_DATA',
                    'PROVINCIA_SHOW',
                    'PUNTAJE_CREATE',
                    'PUNTAJE_DESTROY',
                    'PUNTAJE_EDIT',
                    'PUNTAJE_INDEX',
                    'PUNTAJE_INDEX_DATA',
                    'PUNTAJE_SHOW',
                    'SEDE_REGISTRAL_CREATE',
                    'SEDE_REGISTRAL_DESTROY',
                    'SEDE_REGISTRAL_EDIT',
                    'SEDE_REGISTRAL_INDEX',
                    'SEDE_REGISTRAL_INDEX_DATA',
                    'SEDE_REGISTRAL_SHOW',
                    'SELECCION_CREATE',
                    'SELECCION_DESTROY',
                    'SELECCION_EDIT',
                    'SELECCION_INDEX',
                    'SELECCION_INDEX_DATA',
                    'SELECCION_SHOW',
                    'TIPO_CAPACITACION_CREATE',
                    'TIPO_CAPACITACION_DESTROY',
                    'TIPO_CAPACITACION_EDIT',
                    'TIPO_CAPACITACION_INDEX',
                    'TIPO_CAPACITACION_INDEX_DATA',
                    'TIPO_CAPACITACION_SHOW',
                    'TIPO_DOCUMENTO_CREATE',
                    'TIPO_DOCUMENTO_DESTROY',
                    'TIPO_DOCUMENTO_EDIT',
                    'TIPO_DOCUMENTO_INDEX',
                    'TIPO_DOCUMENTO_INDEX_DATA',
                    'TIPO_DOCUMENTO_SHOW',
                    'TIPO_INSTITUCION_CREATE',
                    'TIPO_INSTITUCION_DESTROY',
                    'TIPO_INSTITUCION_EDIT',
                    'TIPO_INSTITUCION_INDEX',
                    'TIPO_INSTITUCION_INDEX_DATA',
                    'TIPO_INSTITUCION_SHOW',
                    'USER_CREATE',
                    'USER_DESTROY',
                    'USER_EDIT',
                    'USER_INDEX',
                    'USER_INDEX_DATA',
                    'USER_SHOW',
                    'VERIFICACION_REALIZADA_CREATE',
                    'VERIFICACION_REALIZADA_DESTROY',
                    'VERIFICACION_REALIZADA_EDIT',
                    'VERIFICACION_REALIZADA_INDEX',
                    'VERIFICACION_REALIZADA_INDEX_DATA',
                    'VERIFICACION_REALIZADA_SHOW',

                    'USUARIO_DOCUMENTO_CREATE',
                    'USUARIO_DOCUMENTO_DESTROY',
                    'USUARIO_DOCUMENTO_EDIT',
                    'USUARIO_DOCUMENTO_INDEX',
                    'USUARIO_DOCUMENTO_INDEX_DATA',
                    'USUARIO_DOCUMENTO_SHOW'
                ]
            )->get() 
        );



        $cenepred = Role::where('name','USUARIO_CENEPRED')->first();
        $cenepred->syncPermissions( 
            Permission::whereIn(
                'name',
                [
                    'ACREDITACION_INDEX',
                    'ACREDITACION_CREATE',
                    'ACREDITACION_EDIT',
                    'ACREDITACION_DESTROY',
                    'ACREDITACION_SHOW',
                    'ACREDITACION_INDEX_DATA',
                    'ACREDITACION_ACREDITAR',
                    'CALIFICACION_INDEX',
                    'CALIFICACION_CREATE',
                    'CALIFICACION_EDIT',
                    'CALIFICACION_DESTROY',
                    'CALIFICACION_SHOW',
                    'CALIFICACION_INDEX_DATA',
                    'INSTITUCION_CREATE',
                    'INSTITUCION_EDIT',
                    'INSTITUCION_SHOW',
                    'PUNTAJE_INDEX',
                    'PUNTAJE_CREATE',
                    'PUNTAJE_EDIT',
                    'PUNTAJE_DESTROY',
                    'PUNTAJE_SHOW',
                    'PUNTAJE_INDEX_DATA'

                ]
            )->get() 
        );

        $adhoc = Role::where('name','USUARIO_ADHOC')->first();
        $adhoc->syncPermissions( 
            Permission::whereIn(
                'name',
                [
                    'DILIGENCIA_EDIT',
                    'DILIGENCIA_SHOW',
                    'ENTREGA_EXPEDIENTE_SHOW',
                    'INSTITUCION_CREATE',
                    'INSTITUCION_SHOW',

                    'FORMACION_CREATE',
                    'FORMACION_DESTROY',
                    'FORMACION_EDIT',
                    'FORMACION_INDEX',
                    'FORMACION_INDEX_DATA',
                    'FORMACION_SHOW',

                    'CAPACITACION_CREATE',
                    'CAPACITACION_DESTROY',
                    'CAPACITACION_EDIT',
                    'CAPACITACION_INDEX',
                    'CAPACITACION_INDEX_DATA',
                    'CAPACITACION_SHOW',

                    'EXPERIENCIA_CREATE',
                    'EXPERIENCIA_DESTROY',
                    'EXPERIENCIA_EDIT',
                    'EXPERIENCIA_INDEX',
                    'EXPERIENCIA_INDEX_DATA',
                    'EXPERIENCIA_SHOW',

                    'EXPERIENCIA_INSPECTOR_CREATE',
                    'EXPERIENCIA_INSPECTOR_DESTROY',
                    'EXPERIENCIA_INSPECTOR_EDIT',
                    'EXPERIENCIA_INSPECTOR_INDEX',
                    'EXPERIENCIA_INSPECTOR_INDEX_DATA',
                    'EXPERIENCIA_INSPECTOR_SHOW',

                    'VERIFICACION_REALIZADA_CREATE',
                    'VERIFICACION_REALIZADA_DESTROY',
                    'VERIFICACION_REALIZADA_EDIT',
                    'VERIFICACION_REALIZADA_INDEX',
                    'VERIFICACION_REALIZADA_INDEX_DATA',
                    'VERIFICACION_REALIZADA_SHOW',

                    'USUARIO_DOCUMENTO_CREATE',
                    'USUARIO_DOCUMENTO_DESTROY',
                    'USUARIO_DOCUMENTO_EDIT',
                    'USUARIO_DOCUMENTO_INDEX',
                    'USUARIO_DOCUMENTO_INDEX_DATA',
                    'USUARIO_DOCUMENTO_SHOW'
                ]
            )->get() 
        );

        $administrado = Role::where('name','USUARIO_ADMINISTRADO')->first();
        $administrado->syncPermissions( 
            Permission::whereIn(
                'name',
                [
                    'EXPEDIENTE_ADHOC_INDEX',
                    'EXPEDIENTE_ADHOC_CREATE',
                    'EXPEDIENTE_ADHOC_EDIT',
                    'EXPEDIENTE_ADHOC_DESTROY',
                    'EXPEDIENTE_ADHOC_SHOW',
                    'EXPEDIENTE_ADHOC_INDEX_DATA',
                    'INSTITUCION_CREATE',
                    'INSTITUCION_SHOW',

                ]
            )->get() 
        );

    }
}
