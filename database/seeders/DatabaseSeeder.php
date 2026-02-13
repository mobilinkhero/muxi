<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@gsmtradinglab.com'],
            [
                'name' => 'GSM Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        // Demo Student User
        User::updateOrCreate(
            ['email' => 'student@gsmtradinglab.com'],
            [
                'name' => 'Demo Student',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );
    }
}
