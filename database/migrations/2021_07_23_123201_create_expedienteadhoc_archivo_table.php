<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedienteadhocArchivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedienteadhoc_archivo', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('archivo_id');
            $table->string('valor')->nullable();
            $table->foreign('archivo_id')->references('id')->on('archivos');

            $table->foreignId('expedienteadhoc_id');
            $table->foreign('expedienteadhoc_id')->references('id')->on('expedientes_adhocs');
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
        Schema::dropIfExists('expedienteadhoc_archivo');
    }
}
