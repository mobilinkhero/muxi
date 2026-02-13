<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('service_name'); // e.g., "Crypto Signals", "Forex Mastery Course"
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('USD');
            $table->string('status')->default('pending'); // pending, completed, rejected
            $table->string('payment_method')->nullable(); // btc, eth, usdt, etc.
            $table->string('transaction_id')->nullable();
            $table->string('screenshot_path')->nullable(); // Store path for uploaded proof
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
