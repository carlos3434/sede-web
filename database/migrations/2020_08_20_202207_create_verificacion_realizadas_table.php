<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificacionRealizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verificacion_realizadas', function (Blueprint $table) {
            $table->id();
            $table->string('nro_expediente');
            $table->date('fecha');
            $table->string('nro_informe');

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
        Schema::dropIfExists('verificacion_realizadas');
    }
}
