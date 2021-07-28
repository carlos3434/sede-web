<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropObservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('observaciones');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('observaciones', function (Blueprint $table) {
            $table->id();
            $table->text('observacion');
            $table->dateTime('fecha');
            $table->string('estado');
            $table->foreignId('expediente_adhoc_id');
            $table->timestamps();

            $table->foreign('expediente_adhoc_id')->references('id')->on('expedientes_adhocs');

        });
    }
}
