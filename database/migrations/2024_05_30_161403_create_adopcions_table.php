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
        Schema::create('adopcions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idMascota');
            $table->unsignedBigInteger('idNuevoDuenio');
            $table->unsignedBigInteger('idAntiguoDuenio');
            $table->text('descripcion');
            $table->timestamp('fechaAdopcion');
            $table->text('fotosTestigo');
            $table->timestamps();


            $table->foreign('idMascota')->references('id')->on('mascotas');
            $table->foreign('idNuevoDuenio')->references('id')->on('users');
            $table->foreign('idAntiguoDuenio')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adopcions');
    }
};
