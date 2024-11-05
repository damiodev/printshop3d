<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'text',
    ];

    public $timestamps = false; // On désactive l'utilisation des timestamps
}
