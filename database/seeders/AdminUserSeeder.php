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
        $user = User::firstOrNew(['email' => 'admin@gsmtradinglab.com']);
        $user->name = 'Admin';
        // Only set password if it's a new user or explicitly needed. 
        // But for seeder, usually we want to ensure password. Let's keep it simple.
        if (!$user->exists) {
            $user->password = Hash::make('admin');
        }
        $user->is_admin = true;
        $user->save();
    }
}
