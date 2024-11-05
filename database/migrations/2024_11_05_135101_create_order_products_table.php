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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');                                             // Nom du produit
            $table->decimal('total_price_gross');                               // Prix total
            $table->integer('quantity');                                        // Quantité
            $table->timestamps();                                               // Date de création et de modification
            $table->foreignId('order_id')->constrained()->onDelete('cascade');  // Clé étrangère vers la table orders
        });
    }

    /**
     * Reverse the migrations.
     * Annule les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
