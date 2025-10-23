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
        Schema::create('cat_areas_gob', function (Blueprint $table) {
             $table->id('id_area');
             $table->unsignedBigInteger('id_area_padre')->nullable();
             $table->string('nombre');
             $table->string('siglas')->nullable();
             $table->string('categoria')->nullable();
             $table->boolean('is_active')->default(1);
             $table->timestamps();
             $table->foreign('id_area_padre')->references('id_area')->on('cat_areas_gob')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_areas_gob');
    }
};
