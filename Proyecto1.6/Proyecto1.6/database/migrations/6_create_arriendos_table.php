<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('arriendos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('vehiculo_id');
            $table->timestamp('fecha_arriendo')->nullable();
            $table->timestamp('fecha_entrega')->nullable();
            $table->unsignedBigInteger('estado_arriendo')->default(2);  //1.Finalizado 2.Vigente
            $table->integer('total')->nullable();
            $table->String('observaciones')->nullable();
            // Foreign key constraints
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arriendos');
    }
};
