<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateObservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observaciones', function (Blueprint $table) {
            
            $table->dropColumn('observacion');
            $table->dropColumn('estado');
            $table->dropColumn('expediente_adhoc_id');

            $table->string('descripcion');

            $table->foreignId('estado_observacion_id');
            $table->foreign('estado_observacion_id')->references('id')->on('estado_observacion');
            
            $table->foreignId('expedienteadhoc_archivo_id');
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
        //
    }
}
