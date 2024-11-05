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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);    // Nom de l'état à afficher
            $table->string('slug', 50);     // Référencer l'état hors affichage
            $table->string('color', 20);    // Code couleur pour renforcer l'affichage de l'état
            $table->integer('indice');      // Le degré d’un état détermine les autres états possibles. Par exemple, si le paiement a déjà été confirmé, il ne sera plus possible de modifier le mode de paiement.
        });
    }

    /**
     * Reverse the migrations.
     * Annule les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
