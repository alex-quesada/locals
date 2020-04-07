<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasDiariasAcompaniamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_diarias_acompaniamientos', function (Blueprint $table) {
            $table->bigIncrements('id_ventas_diarias_acompaniamientos');
            $table->unsignedBigInteger('id_ventas_diarias');
            $table->foreign('id_ventas_diarias')->references('id_ventas_diarias')->on('ventas_diarias')->onDelete('cascade');
            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
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
        Schema::dropIfExists('ventas_diarias_acompaniamientos');
    }
}
