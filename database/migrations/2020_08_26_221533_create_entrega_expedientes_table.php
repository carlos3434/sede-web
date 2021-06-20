<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregaExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregas_expedientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expediente_adhoc_id');
            $table->dateTime('fecha_entrega');
            $table->dateTime('fecha_recepcion')->nullable();
            $table->foreignId('usuario_asignador_id');
            $table->foreignId('acreditacion_id');

            $table->foreign('expediente_adhoc_id')->references('id')->on('expedientes_adhocs');
            $table->foreign('usuario_asignador_id')->references('id')->on('users');
            $table->foreign('acreditacion_id')->references('id')->on('acreditaciones');

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
        Schema::dropIfExists('entregas_expedientes');
    }
}
