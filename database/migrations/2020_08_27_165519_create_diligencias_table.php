<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiligenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diligencias', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->string('resultado');
            $table->text('determinacion');
            $table->text('observaciones_subsanables');
            $table->string('atendido_por');
            $table->foreignId('entrega_expediente_id');
            $table->timestamps();

            $table->foreign('entrega_expediente_id')->references('id')->on('entregas_expedientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diligencias');
    }
}
