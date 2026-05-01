<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    /**
     * Les attributs qui peuvent être remplis massivement.
     * C'est ici qu'on autorise Laravel à enregistrer ces colonnes en base de données.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',     // Nom de l'utilisateur
        'phone',    // Numéro de téléphone (ton identifiant principal)
        'email',    // Optionnel pour ton projet MaliServices
        'password', // Mot de passe (sera haché automatiquement)
        'role',     // 'client' ou 'pro'
    ];

    /**
     * Les attributs qui doivent être cachés dans les réponses API.
     * Par sécurité, on ne renvoie jamais le mot de passe dans le JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
       


    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
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
}
