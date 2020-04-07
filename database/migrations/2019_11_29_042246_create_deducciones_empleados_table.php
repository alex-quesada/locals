<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeduccionesEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deducciones_empleados', function (Blueprint $table) {
            $table->bigIncrements('id_deducciones_empleado');
            $table->decimal('deduccion', 15, 2);
            $table->unsignedBigInteger('id_deducciones');
            $table->foreign('id_deducciones')->references('id_deducciones')->on('deducciones')->onDelete('cascade');
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
        Schema::dropIfExists('deducciones_empleados');
    }
}
