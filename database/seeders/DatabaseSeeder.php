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
        // Admin User
        $admin = User::firstOrNew(['email' => 'admin@gsmtradinglab.com']);
        $admin->name = 'GSM Admin';
        $admin->is_admin = true;
        if (!$admin->exists) {
            $admin->password = Hash::make('password');
        }
        $admin->save();

        // Demo Student User
        $student = User::firstOrNew(['email' => 'student@gsmtradinglab.com']);
        $student->name = 'Demo Student';
        $student->is_admin = false;
        if (!$student->exists) {
            $student->password = Hash::make('password');
        }
        $student->save();

        $this->call([
            BrokerSeeder::class,
            PaymentMethodSeeder::class,
        ]);
    }
}
