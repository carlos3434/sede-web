<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\Type;

class AddPagoExpedienteadhocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Type::hasType('double')) {
            Type::addType('double', FloatType::class);
        }
        Schema::table('expedientes_adhocs', function (Blueprint $table) {

            $table->string('numero_operacion')->nullable()->after('ht');
            $table->string('nombre_banco')->nullable()->after('numero_operacion');
            $table->string('agencia')->nullable()->after('nombre_banco');
            $table->date('fecha_operacion')->nullable()->after('agencia');

            $table->double('monto')->nullable()->after('fecha_operacion');
            $table->foreignId('distrito_id')->nullable()->after('monto');
            $table->foreign('distrito_id')->references('id')->on('distritos');
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
