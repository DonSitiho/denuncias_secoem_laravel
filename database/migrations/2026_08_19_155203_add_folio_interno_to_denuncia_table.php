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
        Schema::table('denuncia', function (Blueprint $table) {
            $table->string('folio_interno', 25)->nullable()->unique('uk_folio_interno');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('denuncia', function (Blueprint $table) {
            //
            $table->dropColumn('folio_interno');
        });
    }
};
