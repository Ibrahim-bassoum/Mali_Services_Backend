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
            Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('mission_id')->constrained();
        $table->decimal('amount', 10, 2);
        $table->string('payment_method'); // ex: Orange Money, Moov, Cash
        $table->string('transaction_id')->unique()->nullable();
        $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
        $table->timestamps();
    });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payements');
    }
};
