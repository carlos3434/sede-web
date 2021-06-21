<?php

use App\Models\Auth\Permiso;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
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


            ];

        $role = Role::find(2);

        foreach ($items as $item)
        {
            Permiso::updateOrCreate(['name' => $item['name']], $item);
            $role->givePermissionTo($item['name']);
        }
    }
}
