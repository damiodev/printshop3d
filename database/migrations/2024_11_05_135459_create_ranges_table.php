<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Exécute les migrations.
     */
    public function up(): void
    {
        Schema::create('ranges', function (Blueprint $table) {
            $table->id();
            $table->decimal('max');
        });
    }

    /**
     * Reverse the migrations.
     * Annule les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranges');
    }
};
