<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->string('id_alumno')->nullable();
            $table->string('alumno')->nullable();
            $table->string('id_asignatura')->nullable();
            $table->string('asignatura')->nullable();
            $table->string('id_grupo')->nullable();
            $table->string('grupo')->nullable();
            $table->string('ciclo')->nullable();
            $table->text('observacion')->nullable();
            $table->string('data')->nullable();
            $table->string('equipo');
            //campos poosibles en clase o en caso de asignacion de clase.
            $table->string('id_profesor')->nullable();//Solo para asignar la clase al profesor
            $table->string('profesor')->nullable();// solo para asignar la clase de al profesor
            $table->string('bandera');
            //Campos para sesion.
            $table->string('id_planeacion')->nullable();
            $table->string('id_clase')->nullable();
            $table->string('periodo')->nullable();
            $table->string('puntos')->nullable();
            $table->string('titulo')->nullable();
            $table->string('fecha')->nullable();
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
        Schema::dropIfExists('clases');
    }
}
