<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->bigIncrements('id_inventario');
            $table->integer('cantidad_min');
            $table->integer('cantidad');
            $table->unsignedBigInteger('id_lista_productos');
            $table->foreign('id_lista_productos')->references('id_lista_productos')->on('lista_productos')->onDelete('cascade');
            $table->unsignedBigInteger('id_restaurante');
            $table->foreign('id_restaurante')->references('id_restaurante')->on('restaurantes')->onDelete('cascade');
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
        Schema::dropIfExists('inventarios');
    }
}
