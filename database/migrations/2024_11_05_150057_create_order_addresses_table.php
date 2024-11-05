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
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->boolean('facturation')->default(true);                      // Adresse de facturation
            $table->boolean('professionnal')->default(false);                   // Adresse professionnelle
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
            $table->foreignId('order_id')->constrained()->onDelete('cascade');  // Clé étrangère de la commande
            $table->foreignId('country_id')->constrained()->onDelete('cascade'); // Clé étrangère du pays
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models_order_addresses');
    }
};
