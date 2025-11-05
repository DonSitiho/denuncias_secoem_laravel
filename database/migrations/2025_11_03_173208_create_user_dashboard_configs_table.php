<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_dashboard_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->unique(); // FK a la tabla 'users'
            $table->json('widget_order')->comment('Almacena el orden y visibilidad de los widgets.');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_dashboard_configs');
    }
};