<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedienteArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediente_archivos', function (Blueprint $table) {
            $table->id();
            $table->string('archivo');
            $table->string('etiqueta_archivo');
            $table->string('extension');
            $table->string('tamanio');
            $table->string('sector',20)->unsigned();
            $table->integer('numero_nivel')->unsigned();
            $table->boolean('activo')->default(0);
            $table->foreignId('tipo_niveles_id');
            $table->foreignId('expedientes_adhocs_id');

            $table->timestamps();

            $table->foreign('tipo_niveles_id')->references('id')->on('tipo_niveles');
            $table->foreign('expedientes_adhocs_id')->references('id')->on('expedientes_adhocs');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expediente_archivos');
    }
}
