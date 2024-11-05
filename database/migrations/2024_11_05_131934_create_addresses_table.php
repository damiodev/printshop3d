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
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->boolean('professionnal')->default(false);                   // Si l'adresse est professionnelle
            $table->enum('civility', ['Mme', 'M.']);                            // Genre
            $table->string('name', 100)->nullable();                            // Nom
            $table->string('firstname', 100)->nullable();                       // Prénom
            $table->string('company', 100)->nullable();                         // Société
            $table->string('address');                                          // Adresse
            $table->string('addressbis')->nullable();                           // Complément d'adresse
            $table->string('bp', 100)->nullable();                              // Boîte postale
            $table->string('postal', 10);                                       // Code postal
            $table->string('city', 100);                                        // Ville
            $table->string('phone', 25);                                        // Téléphone
            $table->timestamps();                                               // Date de création et de modification
            $table->foreignId('user_id')->constrained()->onDelete('cascade');   // Clé étrangère de la table users
            $table->foreignId('country_id')->constrained()->onDelete('cascade');// Clé étrangère de la table countries
        });
    }

    /**
     * Reverse the migrations.
     * Annule les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
