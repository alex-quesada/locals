<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasDiariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_diarias', function (Blueprint $table) {
            $table->bigIncrements('id_ventas_diarias');
            $table->unsignedBigInteger('id_combo');
            $table->foreign('id_combo')->references('id_combo')->on('combos')->onDelete('cascade');
            $table->dateTime('fecha_venta');
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
        Schema::dropIfExists('ventas_diarias');
    }
}
