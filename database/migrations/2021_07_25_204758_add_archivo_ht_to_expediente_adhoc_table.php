<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArchivoHtToExpedienteAdhocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expedientes_adhocs', function (Blueprint $table) {
            $table->string('archivo_solicitud_ht')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expedientes_adhocs', function (Blueprint $table) {
            $table->dropColumn('archivo_solicitud_ht');
        });
    }
}
