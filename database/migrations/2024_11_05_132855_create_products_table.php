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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // Nom du produit
            $table->decimal('price');                       // Prix du produit
            $table->decimal('weight');                      // Poids du produit
            $table->boolean('active')->default(false);      // Produit actif ou non
            $table->integer('quantity')->defaut(0);         // Quantité en stock
            $table->integer('quantity_alert')->default(10); // Alerte de stock (déclenche une alerte si la quantité est inférieure à 10)
            $table->string('image')->nullable();            // Image du produit
            $table->text('description');                    // Description du produit
            $table->timestamps();                           // Date de création et de modification
        });
    }

    /**
     * Reverse the migrations.
     * Annule les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
