<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gsmtradinglab.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin'), // Default password
                'is_admin' => true,
            ]
        );
    }
}
