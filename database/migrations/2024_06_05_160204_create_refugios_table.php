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
            $table->string('nombreCompleto')->unique();
            $table->text('descripcion')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('provincia')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('direccion')->nullable();
            $table->string('fotosUrl')->nullable();
            $table->text('horarios');
            $table->string('celular')->nullable();
            $table->boolean('celularVerificado')->default(false);
            $table->string('token_verificacion')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
