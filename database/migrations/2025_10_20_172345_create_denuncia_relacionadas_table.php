<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea las tablas de Circunstancias, Involucrados, Testigos, Archivos y Contacto.
     */
    public function up(): void
    {
        
        Schema::create('denuncia_circunstancia', function (Blueprint $table) {
            $table->unsignedInteger('id_circunstancia')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_denuncia')->unique('uk_circunstancia_denuncia');
            
            $table->date('fecha_hechos');
            $table->time('hora_hechos')->nullable();
            
            $table->unsignedInteger('id_municipio')->nullable(); // ¡CAMBIO AQUÍ!
            $table->string('localidad', 255)->nullable();
            $table->string('direccion_exacta', 500);
            
            $table->string('dependencia_involucrada', 255)->nullable();
            $table->text('tramite_solicitado')->nullable();
            $table->text('circunstancias_detalladas');

            $table->foreign('id_denuncia')->references('id_denuncia')->on('denuncia')->onDelete('CASCADE');
            // CLAVE FORÁNEA ACTUALIZADA A 'cat_municipios'
            $table->foreign('id_municipio')->references('id_municipio')->on('cat_municipios')->onDelete('SET NULL'); 
            
            $table->index('id_municipio', 'idx_circunstancia_municipio');
            $table->index('fecha_hechos', 'idx_circunstancia_fecha_hechos');
            $table->comment('Detalles de ubicación y tiempo de los hechos denunciados');
        });

        
        Schema::create('denuncia_involucrado', function (Blueprint $table) {
            $table->unsignedInteger('id_involucrado')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_denuncia');
            
            $table->boolean('es_servidor_publico')->default(false);
            $table->string('nombre_denunciado', 255)->nullable();
            $table->string('puesto_denunciado', 255)->nullable();
            
            // Características Físicas
            $table->enum('sexo', ['H', 'M', 'N/I'])->nullable();
            $table->string('tez', 50)->nullable();
            $table->decimal('estatura_aprox', 3, 2)->nullable();
            $table->integer('edad_aprox')->nullable();
            $table->string('complexion', 50)->nullable();
            $table->string('color_ojos', 50)->nullable();
            $table->string('tipo_cabello', 50)->nullable();
            $table->text('senas_particulares')->nullable();
            $table->text('descripcion_fisica')->nullable();

            $table->foreign('id_denuncia')->references('id_denuncia')->on('denuncia')->onDelete('CASCADE');
            $table->index('nombre_denunciado', 'idx_involucrado_nombre');
            $table->comment('Información y descripción física de los servidores públicos o personas involucradas');
        });

        
        Schema::create('denuncia_testigo', function (Blueprint $table) {
            $table->unsignedInteger('id_testigo')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_denuncia');
            
            $table->boolean('tiene_testigos')->default(false);
            $table->string('nombre_testigo', 255)->nullable();
            $table->string('datos_contacto', 500)->nullable();
            $table->text('observaciones')->nullable();

            $table->foreign('id_denuncia')->references('id_denuncia')->on('denuncia')->onDelete('CASCADE');
            $table->comment('Información de los testigos de los hechos');
        });

        
        Schema::create('archivo_adjunto', function (Blueprint $table) {
            $table->unsignedInteger('id_archivo')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_denuncia');
            
            $table->string('nombre_original', 255);
            $table->string('ruta_cifrada', 500)->unique('uk_ruta_cifrada');
            $table->enum('tipo_archivo', ['imagen', 'video', 'audio', 'documento', 'otro']);
            $table->dateTime('fecha_carga');

            $table->foreign('id_denuncia')->references('id_denuncia')->on('denuncia')->onDelete('CASCADE');
            $table->index('tipo_archivo', 'idx_archivo_tipo');
            $table->comment('Metadatos de las evidencias digitales (archivos subidos)');
        });

        
        Schema::create('datos_contacto_denunciante', function (Blueprint $table) {
            $table->unsignedInteger('id_contacto')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_denuncia')->unique('uk_contacto_denuncia');
            
            $table->string('nombre_completo', 255);
            $table->string('telefono', 20)->nullable();
            $table->string('correo_electronico', 255)->nullable();

            $table->foreign('id_denuncia')->references('id_denuncia')->on('denuncia')->onDelete('CASCADE');
            $table->comment('Datos de contacto del denunciante (si no es anónimo)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_contacto_denunciante');
        Schema::dropIfExists('archivo_adjunto');
        Schema::dropIfExists('denuncia_testigo');
        Schema::dropIfExists('denuncia_involucrado');
        Schema::dropIfExists('denuncia_circunstancia');
    }
};