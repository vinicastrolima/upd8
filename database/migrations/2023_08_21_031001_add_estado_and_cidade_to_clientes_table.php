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
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn(['estado', 'cidade']);

            $table->unsignedBigInteger('estado_id')->after('endereco');
            $table->foreign('estado_id')->references('id')->on('estados');

            $table->unsignedBigInteger('cidade_id')->after('estado_id');
            $table->foreign('cidade_id')->references('id')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            //
        });
    }
};
