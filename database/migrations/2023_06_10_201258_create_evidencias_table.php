<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenciasTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencias', function (Blueprint $table) {
            $table->id();
            $table->string('credito');
            $table->string('tipo_evidencia')->nullable();
            $table->string('nombre_archivo')->nullable();
            $table->string('ubicacion_archivo')->nullable();
            $table->string('ubicacion_carpeta')->nullable();
            $table->integer('horas_asignadas')->nullable();
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_alumno');
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_alumno')->references('id')->on('alumnos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evidencias');
    }
}
