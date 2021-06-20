<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapacitacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capacitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->unsignedInteger('horas_lectivas');
            $table->string('ciudad');
            $table->string('certificado');
            $table->unsignedDouble('archivo_tamano');
            $table->foreignId('usuario_id');
            $table->foreignId('institucion_id');
            $table->foreignId('tipo_capacitacion_id');

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('institucion_id')->references('id')->on('instituciones');
            $table->foreign('tipo_capacitacion_id')->references('id')->on('tipos_capacitaciones');

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
        Schema::dropIfExists('capacitaciones');
    }
}
