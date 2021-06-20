<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcreditacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acreditaciones', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->foreignId('calificacion_id');
            $table->timestamps();
            $table->foreign('calificacion_id')->references('id')->on('calificaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acreditaciones');
    }
}
