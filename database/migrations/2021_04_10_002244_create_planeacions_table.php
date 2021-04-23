<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaneacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planeaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->dateTime('fecha')->nullable();
            $table->text('observacion')->nullable();
            $table->string('id_asignatura')->nullable();
            $table->string('asignatura')->nullable();
            $table->string('id_grupo')->nullable();
            $table->string('grupo')->nullable();
            $table->string('id_profesor')->nullable();
            $table->string('profesor')->nullable();
            $table->string('equipo')->nullable();
            $table->string('material')->nullable();
            $table->string('estatus')->nullable();
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
        Schema::dropIfExists('planeacions');
    }
}
