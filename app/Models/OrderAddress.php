<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $fillable = [
        'name',
        'firstname',
        'professionnal',
        'civility',
        'company',
        'address',
        'addressbis',
        'bp',
        'postal',
        'city',
        'phone',
        'country_id',
        'facturation',
    ];

    /**
     * Get the order.
     * Obtenir la commande.
     */
    public function country()
    {
        return $this->belongsTo(Country::class); // Une adresse de commande appartient à un pays
    }
}
