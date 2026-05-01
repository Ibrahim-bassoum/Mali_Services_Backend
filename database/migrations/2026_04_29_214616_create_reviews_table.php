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
          Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('mission_id')->constrained()->onDelete('cascade');
        $table->foreignId('client_id')->constrained('users');
        $table->foreignId('pro_id')->constrained('users');
        
        $table->integer('rating'); // Note de 1 à 5
        $table->text('comment')->nullable();
        $table->timestamps();
    });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
