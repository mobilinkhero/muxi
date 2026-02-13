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
        // Table for Admin Wallets (Pools)
        Schema::create('p2p_pools', function (Blueprint $table) {
            $table->id();
            $table->string('asset'); // e.g., 'USDT', 'PKR'
            $table->decimal('balance', 20, 8)->default(0); // Current liquidity
            $table->decimal('buy_rate', 20, 8)->default(0); // Rate to buy FROM user
            $table->decimal('sell_rate', 20, 8)->default(0); // Rate to sell TO user
            $table->text('wallet_details')->nullable(); // Address or Bank Info
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Table for User Transactions
        Schema::create('p2p_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'buy' (User buys USDT), 'sell' (User sells USDT)
            $table->string('asset')->default('USDT');
            $table->string('fiat_currency')->default('PKR');

            $table->decimal('amount_asset', 20, 8); // USDT Amount
            $table->decimal('amount_fiat', 20, 8); // PKR Amount
            $table->decimal('rate', 20, 8); // Rate at time of transaction

            $table->string('status')->default('pending'); // pending, approved, rejected

            // For Buy Requests (User sends PKR proof)
            $table->string('proof_image')->nullable();

            // For Sell Requests (User provides bank/wallet details)
            $table->text('user_payment_details')->nullable();

            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p2p_transactions');
        Schema::dropIfExists('p2p_pools');
    }
};
