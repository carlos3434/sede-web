<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisiones', function (Blueprint $table) {
            $table->id();
            $table->text('observacion');
            $table->dateTime('fecha_revision');
            $table->dateTime('fecha_subsanacion');

            $table->foreignId('estado_revision_id');
            $table->foreignId('expedienteadhoc_archivo_id');
            $table->timestamps();

            $table->foreign('estado_revision_id')->references('id')->on('estado_revision');

            $table->foreign('expedienteadhoc_archivo_id')->references('id')->on('expedienteadhoc_archivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revisiones');
    }
}
