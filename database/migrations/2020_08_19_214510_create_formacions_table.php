<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formaciones', function (Blueprint $table) {
            $table->id();
            $table->string('especialidad');
            $table->date('fecha_expedicion');
            $table->string('ciudad');
            $table->string('archivo_titulo');
            $table->unsignedDouble('archivo_tamano');
            $table->foreignId('grado_id');
            $table->foreignId('institucion_id');
            $table->foreignId('usuario_id');

            $table->foreign('grado_id')->references('id')->on('grados');
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
        Schema::dropIfExists('formacions');
    }
}
