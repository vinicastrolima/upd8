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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cpf', 14)->unique();
            $table->string('nome', 100);
            $table->date('data_nascimento');
            $table->enum('sexo', ['homem', 'mulher']);
            $table->string('endereco', 300);
            $table->string('estado', 50);
            $table->string('cidade', 50);
            $table->timestamps(); // Adiciona created_at e updated_at automaticamente
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
