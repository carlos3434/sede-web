<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipalidadesDistritales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipalidades_distritales', function (Blueprint $table) {
            $table->foreignId('institucion_id');
            $table->foreignId('distrito_id');

            $table->foreign('institucion_id')->references('id')->on('instituciones');
            $table->foreign('distrito_id')->references('id')->on('distritos');

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
        Schema::dropIfExists('municipalidades_distritales');
    }
}
