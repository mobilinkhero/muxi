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
        Schema::table('job_postings', function (Blueprint $table) {
            $table->string('salary')->nullable()->after('type'); // "50k-70k", "Competitive"
            $table->string('experience_level')->nullable()->after('salary'); // "Senior", "Junior"
            $table->date('deadline')->nullable()->after('experience_level');
            $table->text('requirements')->nullable()->after('description');
            $table->text('benefits')->nullable()->after('requirements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            //
        });
    }
};
