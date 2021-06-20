<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedienteAdhocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('expedientes_adhocs', function (Blueprint $table) {
                $table->id();
                $table->string('nombre_comercial');
                $table->string('direccion');
                $table->unsignedFloat('area',8,2);

                $table->string('carta_poder_simple');
                $table->string('copia_vigencia_poder');
                $table->string('copia_partida_registral');
                $table->string('copia_dni_propietario');
                $table->string('recibo_pago');
                $table->string('copia_formulario_for');
                $table->string('informe_tecnico_verificador_responsable');
                $table->string('esquela_observacion_sunarp');

                $table->string('plano_ubicacion_01');
                $table->string('plano_ubicacion_02')->nullable();

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

                $table->string('memoria_descriptiva_seguridad');
                $table->string('certificado_pozo_tierra');
                $table->string('certificado_laminados');
                $table->string('certificado_sistema_electrico');

                $table->foreignId('usuario_id');
                $table->string('observaciones');
                $table->string('estado');
                $table->foreignId('usuario_revisor_id');
                $table->double('x');
                $table->double('y');

                $table->datetime('fecha_solicitud_ht')->nullable();
                $table->datetime('fecha_ingreso_ht')->nullable();
                $table->string('ht',250)->nullable();

                $table->foreign('usuario_id')->references('id')->on('users');
                $table->foreign('usuario_revisor_id')->references('id')->on('users');

                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expedientes_adhocs');
    }
}
