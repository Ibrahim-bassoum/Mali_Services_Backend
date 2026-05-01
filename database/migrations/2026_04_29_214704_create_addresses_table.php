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
          Schema::create('addresses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        $table->string('label'); // ex: "Maison", "Bureau", "Chez maman"
        $table->string('city')->default('Bamako');
        $table->string('neighborhood'); // Quartier (ex: Hamdallaye, ACI 2000)
        $table->string('details')->nullable(); // Précisions (ex: "Près de la pharmacie")
        $table->decimal('latitude', 10, 8)->nullable(); // Pour la carte Google Maps
        $table->decimal('longitude', 11, 8)->nullable();
        
        $table->boolean('is_default')->default(false);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
