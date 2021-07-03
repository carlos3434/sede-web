<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencias_generales', function (Blueprint $table) {
            $table->id();
            $table->string('cargo');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedInteger('tiempo_total');
            $table->string('archivo_constancia');
            $table->unsignedDouble('archivo_tamano')->nullable();

            $table->foreignId('usuario_id');
            $table->foreignId('institucion_id');

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('institucion_id')->references('id')->on('instituciones');

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
        Schema::dropIfExists('experiencias_generales');
    }
}
