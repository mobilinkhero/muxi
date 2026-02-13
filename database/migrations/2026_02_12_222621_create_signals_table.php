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
        Schema::create('signals', function (Blueprint $table) {
            $table->id();
            $table->string('symbol');         // e.g. BTCUSD, EURUSD
            $table->string('type');           // e.g. BUY, SELL
            $table->string('entry_price');    // e.g. 1.0500 or 1.0500-1.0520
            $table->string('stop_loss');      // e.g. 1.0450
            $table->string('take_profit_1');  // e.g. 1.0550
            $table->string('take_profit_2')->nullable();
            $table->string('take_profit_3')->nullable();
            $table->string('status')->default('active'); // active, closed, cancelled
            $table->string('result')->nullable(); // profit, loss, breakeven
            $table->text('notes')->nullable();    // Analysis/Reasons
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signals');
    }
};
