<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorasTrabajadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horas_trabajadas', function (Blueprint $table) {
            $table->bigIncrements('id_horas_trabajadas');
            $table->dateTime('fecha_trabajada');
            $table->integer('horas_simples');
            $table->integer('horas_tiempo_medio');
            $table->integer('horas_extra');
            $table->unsignedBigInteger('id_empleado');
            $table->foreign('id_empleado')->references('id_empleado')->on('empleados')->onDelete('cascade');
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
        Schema::dropIfExists('horas_trabajadas');
    }
}
