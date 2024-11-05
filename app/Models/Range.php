<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    protected $fillable = ['max'];

    public $timestamps = false;

    /**
     * Get the countries for the range of weight.
     * Obtenir les pays pour la plage de poids.
     */
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'colissimos')->withPivot('price'); // Une plage de poids a plusieurs pays
    }
}
