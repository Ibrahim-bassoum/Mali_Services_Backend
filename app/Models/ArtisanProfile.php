<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtisanProfile extends Model
{
    use HasFactory;

    // Cette partie autorise Laravel à remplir ces colonnes dans la base de données
    protected $fillable = [
        'user_id',
        'category_id',
        'bio',
        'is_available',
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