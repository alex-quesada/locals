<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoCombosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_combos', function (Blueprint $table) {
            $table->bigIncrements('id_producto_combo');
            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->unsignedBigInteger('id_combo');
            $table->foreign('id_combo')->references('id_combo')->on('combos')->onDelete('cascade');
            $table->decimal('precio_combo', 15, 2);
            $table->boolean('acompaniamiento');
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
        Schema::dropIfExists('producto_combos');
    }
}
