<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsExpedienteAdhocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expedientes_adhocs', function (Blueprint $table) {

            $table->dropColumn('carta_poder_simple');
            $table->dropColumn('copia_vigencia_poder');
            $table->dropColumn('copia_partida_registral');
            $table->dropColumn('copia_dni_propietario');
            $table->dropColumn('copia_formulario_for');
            $table->dropColumn('informe_tecnico_verificador_responsable');
            $table->dropColumn('esquela_observacion_sunarp');
            $table->dropColumn('plano_ubicacion_01');
            $table->dropColumn('plano_ubicacion_02');
            $table->dropColumn('memoria_descriptiva_seguridad');
            $table->dropColumn('certificado_pozo_tierra');
            $table->dropColumn('certificado_laminados');
            $table->dropColumn('certificado_sistema_electrico');

            $table->dropColumn('plano_arquitectura_1');
            $table->dropColumn('plano_arquitectura_2');
            $table->dropColumn('plano_arquitectura_3');
            $table->dropColumn('plano_arquitectura_4');
            $table->dropColumn('plano_arquitectura_5');
            $table->dropColumn('plano_arquitectura_6');
            $table->dropColumn('plano_arquitectura_7');
            $table->dropColumn('plano_arquitectura_8');
            $table->dropColumn('plano_arquitectura_9');
            $table->dropColumn('plano_arquitectura_10');

            $table->dropColumn('plano_fabrica_1');
            $table->dropColumn('plano_fabrica_2');
            $table->dropColumn('plano_fabrica_3');
            $table->dropColumn('plano_fabrica_4');
            $table->dropColumn('plano_fabrica_5');
            $table->dropColumn('plano_fabrica_6');
            $table->dropColumn('plano_fabrica_7');
            $table->dropColumn('plano_fabrica_8');
            $table->dropColumn('plano_fabrica_9');
            $table->dropColumn('plano_fabrica_10');

            $table->dropColumn('plano_remodelacion_1');
            $table->dropColumn('plano_remodelacion_2');
            $table->dropColumn('plano_remodelacion_3');
            $table->dropColumn('plano_remodelacion_4');
            $table->dropColumn('plano_remodelacion_5');
            $table->dropColumn('plano_remodelacion_6');
            $table->dropColumn('plano_remodelacion_7');
            $table->dropColumn('plano_remodelacion_8');
            $table->dropColumn('plano_remodelacion_9');
            $table->dropColumn('plano_remodelacion_10');

            $table->dropColumn('plano_ampliacion_1');
            $table->dropColumn('plano_ampliacion_2');
            $table->dropColumn('plano_ampliacion_3');
            $table->dropColumn('plano_ampliacion_4');
            $table->dropColumn('plano_ampliacion_5');
            $table->dropColumn('plano_ampliacion_6');
            $table->dropColumn('plano_ampliacion_7');
            $table->dropColumn('plano_ampliacion_8');
            $table->dropColumn('plano_ampliacion_9');
            $table->dropColumn('plano_ampliacion_10');

            $table->dropColumn('plano_rutas_evacuacion_1');
            $table->dropColumn('plano_rutas_evacuacion_2');
            $table->dropColumn('plano_rutas_evacuacion_3');
            $table->dropColumn('plano_rutas_evacuacion_4');
            $table->dropColumn('plano_rutas_evacuacion_5');
            $table->dropColumn('plano_rutas_evacuacion_6');
            $table->dropColumn('plano_rutas_evacuacion_7');
            $table->dropColumn('plano_rutas_evacuacion_8');
            $table->dropColumn('plano_rutas_evacuacion_9');
            $table->dropColumn('plano_rutas_evacuacion_10');

            $table->dropColumn('plano_senalizacion_1');
            $table->dropColumn('plano_senalizacion_2');
            $table->dropColumn('plano_senalizacion_3');
            $table->dropColumn('plano_senalizacion_4');
            $table->dropColumn('plano_senalizacion_5');
            $table->dropColumn('plano_senalizacion_6');
            $table->dropColumn('plano_senalizacion_7');
            $table->dropColumn('plano_senalizacion_8');
            $table->dropColumn('plano_senalizacion_9');
            $table->dropColumn('plano_senalizacion_10');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expedientes_adhocs', function (Blueprint $table) {

            $table->string('carta_poder_simple');
            $table->string('copia_vigencia_poder');
            $table->string('copia_partida_registral');
            $table->string('copia_dni_propietario');
            $table->string('copia_formulario_for');
            $table->string('informe_tecnico_verificador_responsable');
            $table->string('esquela_observacion_sunarp');
            $table->string('plano_ubicacion_01');
            $table->string('plano_ubicacion_02')->nullable();
            $table->string('memoria_descriptiva_seguridad');
            $table->string('certificado_pozo_tierra');
            $table->string('certificado_laminados');
            $table->string('certificado_sistema_electrico');

            $table->string('plano_arquitectura_1')->nullable();
            $table->string('plano_arquitectura_2')->nullable();
            $table->string('plano_arquitectura_3')->nullable();
            $table->string('plano_arquitectura_4')->nullable();
            $table->string('plano_arquitectura_5')->nullable();
            $table->string('plano_arquitectura_6')->nullable();
            $table->string('plano_arquitectura_7')->nullable();
            $table->string('plano_arquitectura_8')->nullable();
            $table->string('plano_arquitectura_9')->nullable();
            $table->string('plano_arquitectura_10')->nullable();

            $table->string('plano_fabrica_1')->nullable();
            $table->string('plano_fabrica_2')->nullable();
            $table->string('plano_fabrica_3')->nullable();
            $table->string('plano_fabrica_4')->nullable();
            $table->string('plano_fabrica_5')->nullable();
            $table->string('plano_fabrica_6')->nullable();
            $table->string('plano_fabrica_7')->nullable();
            $table->string('plano_fabrica_8')->nullable();
            $table->string('plano_fabrica_9')->nullable();
            $table->string('plano_fabrica_10')->nullable();

            $table->string('plano_remodelacion_1')->nullable();
            $table->string('plano_remodelacion_2')->nullable();
            $table->string('plano_remodelacion_3')->nullable();
            $table->string('plano_remodelacion_4')->nullable();
            $table->string('plano_remodelacion_5')->nullable();
            $table->string('plano_remodelacion_6')->nullable();
            $table->string('plano_remodelacion_7')->nullable();
            $table->string('plano_remodelacion_8')->nullable();
            $table->string('plano_remodelacion_9')->nullable();
            $table->string('plano_remodelacion_10')->nullable();

            $table->string('plano_ampliacion_1')->nullable();
            $table->string('plano_ampliacion_2')->nullable();
            $table->string('plano_ampliacion_3')->nullable();
            $table->string('plano_ampliacion_4')->nullable();
            $table->string('plano_ampliacion_5')->nullable();
            $table->string('plano_ampliacion_6')->nullable();
            $table->string('plano_ampliacion_7')->nullable();
            $table->string('plano_ampliacion_8')->nullable();
            $table->string('plano_ampliacion_9')->nullable();
            $table->string('plano_ampliacion_10')->nullable();

            $table->string('plano_rutas_evacuacion_1')->nullable();
            $table->string('plano_rutas_evacuacion_2')->nullable();
            $table->string('plano_rutas_evacuacion_3')->nullable();
            $table->string('plano_rutas_evacuacion_4')->nullable();
            $table->string('plano_rutas_evacuacion_5')->nullable();
            $table->string('plano_rutas_evacuacion_6')->nullable();
            $table->string('plano_rutas_evacuacion_7')->nullable();
            $table->string('plano_rutas_evacuacion_8')->nullable();
            $table->string('plano_rutas_evacuacion_9')->nullable();
            $table->string('plano_rutas_evacuacion_10')->nullable();

            $table->string('plano_senalizacion_1')->nullable();
            $table->string('plano_senalizacion_2')->nullable();
            $table->string('plano_senalizacion_3')->nullable();
            $table->string('plano_senalizacion_4')->nullable();
            $table->string('plano_senalizacion_5')->nullable();
            $table->string('plano_senalizacion_6')->nullable();
            $table->string('plano_senalizacion_7')->nullable();
            $table->string('plano_senalizacion_8')->nullable();
            $table->string('plano_senalizacion_9')->nullable();
            $table->string('plano_senalizacion_10')->nullable();

        });
    }
}
