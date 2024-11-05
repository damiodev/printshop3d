<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * Les attributs qui sont massivement attribuables.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'firstname',
        'email',
        'password',
        'newsletter',
        'last_seen',
    ];

    /**
     * The attributes that should be mutated to dates.
     * L'attribut qui doit être converti en types natifs.
     * 
     * @description On déplace la propiété $dates pour bénéficier de Carbon (https://carbon.nesbot.com/docs/)
     *
     * @var array
     */
    protected $dates = [
        'last_seen',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Les attributs qui doivent être masqués pour les tableaux.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     * Obtenez les attributs qui doivent être convertis en types natifs.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the addresses for the user.
     * Obtenir les adresses pour l'utilisateur.
     */
    public function addresses()
    {
        return $this->hasMany(Address::class); // Un utilisateur peut avoir plusieurs adresses
    }

    /**
     * Get the orders for the user.
     * Obtenir les commandes pour l'utilisateur.
     */
    public function orders()
    {
        return $this->hasMany(Order::class); // Un utilisateur peut avoir plusieurs commandes
    }
}
