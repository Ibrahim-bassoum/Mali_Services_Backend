<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtisanProfile extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être remplis massivement.
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'bio',
        'experience_years', // La virgule a été ajoutée ici
        'skills',           // Ajouté pour correspondre à ta migration et au design
        'base_location',    // Vérifie bien qu'il n'y a qu'un seul "o"
        'is_available',
        'is_verified',
        'rating_average',
    ];

    /**
     * Relation avec l'utilisateur (Un profil appartient à un utilisateur)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec la catégorie (Un artisan appartient à une catégorie)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}