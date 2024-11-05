<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

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
    ];

    /**
     * Get the country.
     * Obtenir le pays.
     */
    public function country()
    {
        return $this->belongsTo(Country::class); // Une adresse appartient à un pays
    }
}
