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
        Schema::create('refugios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('provincia');
            $table->string('ciudad');
            $table->string('direccion');
            $table->text('horario')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('fotoUrl')->nullable();
            $table->text('galeriaFotos')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('token_verification')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refugios');
    }
};
