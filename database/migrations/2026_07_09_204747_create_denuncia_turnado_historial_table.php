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
        Schema::create('denuncia_turnado_historial', function (Blueprint $table) {
            $table->unsignedBigInteger('id_turnado')->autoIncrement()->primary();
            $table->unsignedInteger('id_denuncia');
            $table->unsignedInteger('id_area_origen');
            $table->unsignedInteger('id_area_destino');
            $table->unsignedInteger('id_responsable')->nullable();
            $table->timestamp('fecha_turnado')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncia_turnado_historial');
    }
};
