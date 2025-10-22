// database/migrations/xxxx_xx_xx_create_areas_table.php

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
        Schema::create('areas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_area')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_area_padre')->nullable()->comment('Relación jerárquica con otra área.');
            $table->string('nombre_area', 200);
            $table->unsignedInteger('nivel')->comment('Nivel jerárquico dentro de la estructura.');
            $table->string('siglas', 20);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Clave foránea auto-referenciada para la jerarquía
            $table->foreign('id_area_padre')->references('id_area')->on('areas')->onDelete('SET NULL');
            
            $table->comment('Catálogo de Áreas responsables');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};