<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('reference')->unique(); // ID ya muamala wetu
            $table->string('transaction_id')->nullable(); // ID kutoka AzamPay
            $table->string('phone_number');
            $table->decimal('amount', 10, 2);
            $table->string('provider'); // Mfano: Airtel, Tigo, AzamPesa, Mpesa
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};