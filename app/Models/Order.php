<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Get the adresses for the order.
     * Obtenez les adresses pour la commande.
     */
    public function adresses()
    {
        return $this->hasMany(OrderAddress::class); // Une commande peut avoir plusieurs adresses
    }

    /**
     * Get the products for the order.
     * Obtenez les produits pour la commande.
     */
    public function products()
    {
        return $this->hasMany(OrderProduct::class); // Une commande peut avoir plusieurs produits
    }

    /**
     * Get the state for the order.
     * Obtenez l'état pour la commande.
     */
    public function state()
    {
        return $this->belongsTo(State::class); // Une commande peut avoir un état
    }

    /**
     * Get the user for the order.
     * Obtenez l'utilisateur pour la commande.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Une commande appartient à un utilisateur
    }

    /**
     * Get the payment infos for the order.
     * Obtenez les informations de paiement pour la commande.
     */
    public function payment_infos()
    {
        return $this->hasOne(Payment::class); // Une commande peut avoir un paiement
    }

    // ============================================
    // ============== ACCESSORS ===================
    // ============================================
    // DOC -> https://laravel.com/docs/11.x/eloquent-mutators#accessors-and-mutators

    /**
     * Get the payment text for the order.
     * Obtenir le texte de paiement pour la commande.
     * 
     * @param string $value
     * @return string
     */
    public function getPaymentTextAttribute($value)
    {
        $texts = [
            'carte' => 'Carte bancaire',
            'virement' => 'Virement',
            'cheque' => 'Chèque',
            'mandat' => 'Mandat administratif',
        ];

        return $texts[$this->payment];
    }

    /**
     * Get the total order for the order.
     * Obtenir le total de la commande.
     */
    public function getTotalOrderAttribute()
    {
        return $this->total + $this->shipping;
    }

    /**
     * Get the tva for the order.
     * Obtenir la TVA pour la commande.
     */
    public function getTvaAttribute()
    {
        return $this->tax > 0 ? $this->total / (1 + $this->tax) * $this->tax : 0;
    }

    /**
     * Get the ht for the order.
     * Obtenir le HT pour la commande.
     */
    public function getHtAttribute()
    {
        return $this->total / (1 + $this->tax);
    }
    // ============================================
}
