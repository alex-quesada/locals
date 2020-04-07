<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('id_empleado');
            $table->timestamp('fecha_ingreso');
            $table->string('id_persona');
            $table->foreign('id_persona')->references('id_persona')->on('personas')->onDelete('cascade');
            $table->unsignedBigInteger('id_tipo_empleado');
            $table->foreign('id_tipo_empleado')->references('id_tipo_empleado')->on('tipo_empleados')->onDelete('cascade');
            $table->unsignedBigInteger('id_restaurante');
            $table->foreign('id_restaurante')->references('id_restaurante')->on('restaurantes')->onDelete('cascade');
            $table->decimal('salario_por_hora', 15, 2);
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
        Schema::dropIfExists('empleados');
    }
}
