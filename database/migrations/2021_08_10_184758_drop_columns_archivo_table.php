<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsArchivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archivos', function (Blueprint $table) {

            $table->dropColumn('convocatoria_id');
            $table->boolean('activo')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('archivos', function (Blueprint $table) {

            $table->foreignId('convocatoria_id');
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias');
            $table->dropColumn('activo');

        });
    }
}
