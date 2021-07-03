<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienciaInspectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencias_inspectores', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->foreignId('institucion_id');
            $table->foreignId('usuario_id');
            $table->string('archivo_constancia');
            $table->unsignedDouble('archivo_tamano')->nullable();

            $table->foreign('institucion_id')->references('id')->on('instituciones');
            $table->foreign('usuario_id')->references('id')->on('users');
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
        Schema::dropIfExists('experiencias_inspectores');
    }
}
