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
        Schema::create('solventar_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_denuncia');
            $table->unsignedBigInteger('id_usuario_solicito');
            $table->unsignedBigInteger('id_area_responsable');
            $table->text('observacion_responsable');
            //ENUM 
            $table->enum('tipo_campo', [
                'text',
                'date',
                'archivo',
                'entero'
            ]);
            $table->string('info_solicitada', 500)->nullable();
            $table->date('fecha_solicitud_info');
            $table->date('fecha_respuesta_info')->nullable();
            $table->boolean('is_complete')->default(false);
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solventar_info');
    }
};
