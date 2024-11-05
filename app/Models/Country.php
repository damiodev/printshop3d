<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'tax',
    ];

    public $timestamps = false; // On désactive les timestamps dans la table

    /**
     * Get the ranges for the country.
     * Obtenir les plages pour le pays.
     */
    public function ranges()
    {
        return $this->belongsToMany(Range::class, 'colissimos')->withPivot('id', 'price'); // Un pays a plusieurs plage de poids
    }

    /**
     * Get the addresses for the country.
     * Obtenir les adresses pour le pays.
     */
    public function addresses()
    {
        return $this->hasMany(Address::class); // Un pays a plusieurs adresses
    }

    /**
     * Get the order addresses for the country.
     * Obtenir les adresses de commande pour le pays.
     */
    public function order_addresses()
    {
        return $this->hasMany(OrderAddress::class); // Un pays a plusieurs adresses de commande
    }
}
