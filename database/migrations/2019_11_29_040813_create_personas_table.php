<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->string('id_persona')->primary();
            $table->string('nombre');
            $table->string('apellido_uno');
            $table->string('apellido_dos');
            $table->string('correo');
            $table->unsignedBigInteger('id_direccion');
            $table->foreign('id_direccion')->references('id_direccion')->on('direcciones')->onDelete('cascade');
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
        Schema::dropIfExists('personas');
    }
}
