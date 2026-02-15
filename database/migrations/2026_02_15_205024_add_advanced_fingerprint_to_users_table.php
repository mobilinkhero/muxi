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
        Schema::table('users', function (Blueprint $table) {
            $table->string('device_model')->nullable();
            $table->string('browser_fingerprint')->nullable();
            $table->string('cpu_cores')->nullable();
            $table->string('gpu_info')->nullable();
            $table->string('timezone')->nullable();
            $table->string('language')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['device_model', 'browser_fingerprint', 'cpu_cores', 'gpu_info', 'timezone', 'language']);
        });
    }
};
