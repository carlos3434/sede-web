<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('nombres');
            $table->foreignId('pais_id');
            $table->boolean('sexo');
            //$table->string('estado_civil')->nullable();
            $table->foreignId('estado_civil_id')->nullable();
            $table->foreignId('tipo_documento_id');
            $table->string('numero_documento');
            $table->string('direccion')->nullable();
            $table->foreignId('distrito_id');
            $table->string('telefono_fijo');
            $table->string('celular');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('colegio_profesional')->nullable();
            $table->string('numero_colegiatura')->nullable();
            $table->boolean('esta_habilitado')->nullable();
            $table->string('constancia_habilidad')->nullable();
            $table->string('declaracion_jurada')->nullable();
            $table->string('copia_dni')->nullable();
            $table->string('rj_itse')->nullable();
            $table->string('rj_verificador')->nullable();
            $table->string('anexo_1')->nullable();
            $table->string('foto')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
