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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();                                               // Date de création et de modification
            $table->string('reference', 8);                                     // Référence unique de la commande
            $table->decimal('shipping');                                        // Les frais de port
            $table->decimal('total');                                           // Le coût total des produits (TTC)
            $table->decimal('tax');                                             // Le taux de TVA
            $table->enum('payment', [                                           // Mode de paiement
                'carte',
                'mandat',
                'virement',
                'cheque'
            ]);
            $table->string('purchase_order', 100)->nullable();                  // Numéro de bon de commande
            $table->boolean('pick')->default(false);                            // Produit est récupéré en magasin
            $table->integer('invoice_id')->nullable();                          // L'identifiant de la facture
            $table->string('invoice_number', 40)->nullable();                   // Le numéro de la facture
            $table->foreignId('state_id')->constrained()->onDelete('cascade');  // Clé étrangère de l'état de la commande
            $table->foreignId('user_id')->constrained()->onDelete('cascade');   // Clé étrangère de l'utilisateur
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models_orders');
    }
};
