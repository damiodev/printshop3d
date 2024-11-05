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
        Schema::create('colissimos', function (Blueprint $table) {
            $table->id();
            $table->decimal('price');                                           // Prix
            $table->foreignId('country_id')->constrained()->onDelete('cascade');// Clé étrangère vers la table countries
            $table->foreignId('range_id')->constrained()->onDelete('cascade');  // Clé étrangère vers la table ranges
        });
    }

    /**
     * Reverse the migrations.
     * Annule les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colissimos');
    }
};
