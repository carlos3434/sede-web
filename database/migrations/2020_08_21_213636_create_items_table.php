<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedFloat('puntaje_minimo');
            $table->unsignedFloat('puntaje_maximo');
            $table->foreignId('convocatoria_id');
            $table->timestamps();
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
        Schema::dropIfExists('items');
    }
}
