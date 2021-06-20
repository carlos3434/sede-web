<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id');
            $table->foreignId('convocatoria_id');
            $table->foreignId('sede_registral_id');
            $table->dateTime('fecha');
            $table->timestamps();
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificaciones');
    }
}
