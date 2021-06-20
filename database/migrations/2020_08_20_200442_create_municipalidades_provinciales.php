<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipalidadesProvinciales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipalidades_provinciales', function (Blueprint $table) {
            $table->foreignId('institucion_id');
            $table->foreignId('provincia_id');

            $table->foreign('institucion_id')->references('id')->on('instituciones');
            $table->foreign('provincia_id')->references('id')->on('provincias');

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
        Schema::dropIfExists('municipalidades_provinciales');
    }
}
