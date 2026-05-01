<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
          Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nom affiché : "Plomberie"
        $table->string('slug')->unique(); // Pour les URLs : "plomberie"
        
        // Très important pour ton app Flutter :
        // On stockera ici le nom de l'icône (ex: "water_drop" ou "bolt")
        $table->string('icon')->nullable(); 
        
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true); // Permet de masquer une catégorie si besoin
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
