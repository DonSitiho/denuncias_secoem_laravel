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
        Schema::create('cat_estados', function (Blueprint $table) {
            $table->bigIncrements('id_estado');
            $table->unsignedBigInteger('id_tipo')->nullable();
            $table->string('nombre', 150);
            $table->boolean('is_active')->default(1)->comment('1 = activo, 0 = inactivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_estados');
    }
};


