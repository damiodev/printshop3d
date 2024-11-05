<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color',
        'indice',
    ];

    public $timestamps = false; // On désactive les timestamps dans la table

    /**
     * Get the orders for the state.
     * Obtenir les commandes pour l'état.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
