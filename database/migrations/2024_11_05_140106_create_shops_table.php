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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // Nom de la boutique
            $table->string('address');                  // Adresse de la boutique
            $table->string('holder');                   // Nom officiel de la boutique
            $table->string('email');                    // Email de contact
            $table->string('bic');                      // BIC (pour les virements)
            $table->string('iban');                     // IBAN (pour les virements)
            $table->string('bank');                     // Nom de la banque
            $table->string('bank_address');             // Adresse de la banque
            $table->string('phone', 25);                // Téléphone de contact
            $table->string('facebook');                 // Lien vers la page Facebook
            $table->string('home');                     // Texte pour la page d'accueil
            $table->text('home_infos');                 // Texte d'information de la page d'accueil
            $table->text('home_shipping');              // Texte d'information sur la livraison de la page d'accueil
            $table->boolean('invoice')->default(true);  // Si la boutique génère les factures
            $table->boolean('card')->default(true);     // Si la boutique accepte les paiements par carte bancaire
            $table->boolean('transfer')->default(true); // Si la boutique va accepter les virements bancaires
            $table->boolean('check')->default(true);    // Si la boutique va accepter les chèques
            $table->boolean('mandat')->default(true);   // Si la boutique va accepter les mandats administratifs
        });
    }

    /**
     * Reverse the migrations.
     * Annule les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
