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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id('id');
            $table->integer('año')->nullable();
            $table->unsignedBigInteger('marcaVehiculo');
            $table->string('modelo');
            $table->unsignedBigInteger('tipo_vehiculo_id');
            $table->string('patente')->unique();
            $table->longText('url_imagen')->nullable();
            $table->unsignedBigInteger('estado_vehiculo');         
            $table->foreign('marcaVehiculo')->references('id')->on('marcas'); 
            $table->foreign('tipo_vehiculo_id')->references('id')->on('tipo_vehiculos');
            $table->foreign('estado_vehiculo')->references('id')->on('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
