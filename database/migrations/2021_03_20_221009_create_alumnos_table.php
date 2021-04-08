<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('apellido_paterno');
            $table->string('nombre');
            $table->string('apellido_materno');
            $table->string('id_grupo')->nullable();
            $table->string('grupo')->nullable();
            $table->string('ciclo')->nullable();
            $table->dateTime('fecha_nacimiento')->nullable();
            $table->string('equipo')->nullable();//instituto
            $table->text('observacion')->nullable();
            $table->string('correo');
            $table->string('bandera');//Alumno, Maestro, Administrativo, Tutor
            $table->softDeletes();
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
        Schema::dropIfExists('alumnos');
    }
}
