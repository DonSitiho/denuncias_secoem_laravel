<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla cat_municipios.
     */
    public function up(): void
    {
        Schema::create('cat_municipios', function (Blueprint $table) {
            $table->unsignedInteger('id_municipio')->autoIncrement()->primary();
            $table->string('nombre_municipio', 100)->unique('uk_nombre_municipio');
            $table->string('clave_municipio', 10)->unique('uk_clave_municipio');
            $table->boolean('is_active')->default(1)->comment('1 = activo, 0 = inactivo');
            $table->comment('Catálogo de Municipios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_municipios');
    }
};