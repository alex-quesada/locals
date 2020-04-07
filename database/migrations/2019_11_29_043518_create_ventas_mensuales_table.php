<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasMensualesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_mensuales', function (Blueprint $table) {
            $table->bigIncrements('id_ventas_mensuales');
            $table->integer('mes');
            $table->integer('anio');
            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->unsignedBigInteger('id_restaurante');
            $table->foreign('id_restaurante')->references('id_restaurante')->on('restaurantes')->onDelete('cascade');
            $table->integer('cantidad');
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
        Schema::dropIfExists('ventas_mensuales');
    }
}
