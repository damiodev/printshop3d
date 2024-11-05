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
}
