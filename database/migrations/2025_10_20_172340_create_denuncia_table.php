<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla denuncia (Núcleo).
     */
    public function up(): void
    {
        Schema::create('denuncia', function (Blueprint $table) {
            $table->unsignedBigInteger('id_denuncia')->autoIncrement()->primary();
            $table->string('folio_seguimiento', 25)->unique('uk_folio_seguimiento');
            $table->boolean('es_anonima')->default(true);
            $table->dateTime('fecha_recepcion');
            $table->text('motivo_denuncia');
            $table->string('programa_publico', 255)->nullable();
            $table->decimal('dinero_solicitado', 10, 2)->default(0.00);

            //Nuevos campos para seguimiento
            $table->unsignedInteger('id_estado')->nullable();
            $table->string('no_expediente_inter', 50)->nullable();
            $table->unsignedInteger('id_dependencia_denunciada')->nullable();
            $table->unsignedInteger('id_area_responsable')->nullable();
            $table->unsignedInteger('id_responsable')->nullable();
            $table->string('token_validacion', 6)->nullable();
            $table->string('clave_denunciante', 120)->nullable();
            $table->dateTime('fecha_cierre')->nullable();

            // FK a la tabla de usuarios internos (temporalmente comentada)
            $table->unsignedInteger('id_denunciante')->nullable();
            // $table->foreign('id_denunciante')->references('id_usuario')->on('usuario_sistema')->onDelete('SET NULL');
            $table->unsignedTinyInteger('tipo_denuncia');

            $table->comment('Tabla principal de las denuncias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncia');
    }
};