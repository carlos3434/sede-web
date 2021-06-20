<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calificacion_id');
            $table->foreignId('item_id');
            $table->unsignedFloat('puntaje');
            $table->timestamps();

            $table->foreign('calificacion_id')->references('id')->on('calificaciones');
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puntajes');
    }
}
