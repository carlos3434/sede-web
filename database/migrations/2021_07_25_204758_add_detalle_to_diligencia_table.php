<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetalleToDiligenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diligencias', function (Blueprint $table) {
            $table->dropColumn('resultado');
            $table->dropColumn('determinacion');
            $table->dropColumn('observaciones_subsanables');
            $table->dropColumn('atendido_por');

            $table->string('anexo8')->nullable();
            $table->string('anexo9')->nullable();
            $table->string('anexo10')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diligencias', function (Blueprint $table) {
            $table->string('resultado');
            $table->text('determinacion');
            $table->text('observaciones_subsanables');
            $table->string('atendido_por');

            $table->dropColumn('anexo8')->nullable();
            $table->dropColumn('anexo9')->nullable();
            $table->dropColumn('anexo10')->nullable();
        });
    }
}
