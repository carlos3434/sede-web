<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\Type;

class UpdateEstadoExpedienteAdhocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Type::hasType('double')) {
            Type::addType('double', FloatType::class);
        }
        Schema::table('expedientes_adhocs', function (Blueprint $table) {
            $table->string('carta_poder_simple')->nullable()->change();
            $table->string('copia_vigencia_poder')->nullable()->change();
            $table->string('copia_partida_registral')->nullable()->change();
            $table->string('copia_dni_propietario')->nullable()->change();
            $table->string('recibo_pago')->nullable()->change();
            $table->string('copia_formulario_for')->nullable()->change();
            $table->string('informe_tecnico_verificador_responsable')->nullable()->change();
            $table->string('esquela_observacion_sunarp')->nullable()->change();
            $table->string('plano_ubicacion_01')->nullable()->change();
            $table->string('memoria_descriptiva_seguridad')->nullable()->change();
            $table->string('certificado_pozo_tierra')->nullable()->change();
            $table->string('certificado_laminados')->nullable()->change();
            $table->string('certificado_sistema_electrico')->nullable()->change();
            $table->string('observaciones')->nullable()->change();
            $table->foreignId('usuario_revisor_id')->nullable()->change();
            $table->double('x')->nullable()->change();
            $table->double('y')->nullable()->change();

            $table->dropColumn('estado');
            $table->foreignId('estado_expediente_id')->after('observaciones');
            $table->foreign('estado_expediente_id')->references('id')->on('estado_expediente');

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
            $table->string('carta_poder_simple')->change();
            $table->string('copia_vigencia_poder')->change();
            $table->string('copia_partida_registral')->change();
            $table->string('copia_dni_propietario')->change();
            $table->string('recibo_pago')->change();
            $table->string('copia_formulario_for')->change();
            $table->string('informe_tecnico_verificador_responsable')->change();
            $table->string('esquela_observacion_sunarp')->change();
            $table->string('plano_ubicacion_01')->change();
            $table->string('memoria_descriptiva_seguridad')->change();
            $table->string('certificado_pozo_tierra')->change();
            $table->string('certificado_laminados')->change();
            $table->string('certificado_sistema_electrico')->change();
            $table->string('observaciones')->change();
            $table->string('estado')->change();
            $table->foreignId('usuario_revisor_id')->change();
            $table->double('x')->change();
            $table->double('y')->change();

            $table->string('estado')->after('observaciones');
            $table->dropForeign('estado_expediente_id');
            $table->dropColumn('estado_expediente_id');
        });
    }
}
